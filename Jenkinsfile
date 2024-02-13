pipeline{
    agent any
    environment {
            THEME_NAME = "ligaDebate-blog"

            /** WEB SERVER **/
            WORKING_DIRECTORY = "~/services-dev/${THEME_NAME}"
            SSH_PASS = credentials('ssh-pass-web')
            SSH_HOST = "172.22.4.24"
            SSH_USER = "cts-deus"

            /** CONTAINER REGISTRY **/
            SERVER_REG = "registry.ctdesarrollo-sdr.org"
            DOCKER_USER = "docker"
            DOCKER_PASS = credentials('registry-pass-docker')
            
        }

    tools {nodejs "npm"}
    stages{
        stage('Build Docker Image') {
            steps { 
                echo '==== BUILD & UPDATE DOCKER IMAGE ===='
                sh 'docker login ${SERVER_REG} -u ${DOCKER_USER} -p ${DOCKER_PASS}'
                sh 'docker build --pull --no-cache . -t ${SERVER_REG}/${THEME_NAME}:latest'
                sh 'docker push ${SERVER_REG}/${THEME_NAME}:latest'
                sh 'docker image rm -f ${SERVER_REG}/${THEME_NAME}'
                echo '==== FINISHED DOCKER IMAGE ===='
            }
        }
        stage('Remote SSH Deploy') {
            steps {
                echo '==== REMOTE DEVELOPMENT DEPLOY ===='
                script {
                    def remote = [:]
                    remote.name = 'SERVICES'
                    remote.host = SSH_HOST
                    remote.user = SSH_USER
                    remote.password = SSH_PASS
                    remote.allowAnyHosts = true
                    remote.pty = true // to enable sudo usage in sshCommand

                    sshCommand remote: remote, sudo:true ,command: "docker cp ${THEME_NAME}:/var/www/html/wp-content ${WORKING_DIRECTORY}/wp-content"                                   // Get wp-content folder form running container with assets (uploads, videos, etc)
                    sshCommand remote: remote, sudo:true ,command: "rm -rf ${WORKING_DIRECTORY}/wp-content/themes/${THEME_NAME}"                                                        // Delete old theme from wp-content folder
                    sshCommand remote: remote, sudo:true ,command: "docker rm -f ${THEME_NAME}"                                                                                         // Remove running container with old image
                    sshCommand remote: remote, sudo:true ,command: "docker pull registry.ctdesarrollo-sdr.org/${THEME_NAME}:latest"                                                     // Pull the updated image constructed at the begining from the registry
                    sshCommand remote: remote, sudo:true ,command: "docker compose -f /home/cts-deus/services-dev/docker-compose.yaml up -d"                                            // Run the new Wordpress container image by using the docker compose file on the services folder
                    sshCommand remote: remote, sudo:true ,command: "docker cp ${THEME_NAME}:/var/www/html/wp-content/themes/${THEME_NAME} ${WORKING_DIRECTORY}/wp-content/themes/"      // Update the theme from the wp-content that we pulled from the old container by copying the theme form the new running container
                    sshCommand remote: remote, sudo:true ,command: "docker exec -i ${THEME_NAME} rm -rf /var/www/html/wp-content"                                                       // Delete wp-content folder from running container
                    sshCommand remote: remote, sudo:true ,command: "docker cp ${WORKING_DIRECTORY}/wp-content/ ${THEME_NAME}:/var/www/html/"                                            // Copy new wp-content folder with updated theme and assets
                    sshCommand remote: remote, sudo:true ,command: "rm -rf ${WORKING_DIRECTORY}/wp-content_backup"                                                                      // Delete old backup in case it exist 
                    sshCommand remote: remote, sudo:true ,command: "mv ${WORKING_DIRECTORY}/wp-content ${WORKING_DIRECTORY}/wp-content_backup"                                          // Rename folder to bakcup
                }
                echo '==== FINISHED DEPLOYMENT ===='
            }
        }
    }
}
