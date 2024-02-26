pipeline{
    agent any
    environment {
            /** GENERAL CONFIG **/
            THEME_NAME = "liga-de-debate"

            /** WEB SERVER **/
            SSH_HOST = "172.22.4.24"
            SSH_USER = "cts-deus"
            SSH_PASS = credentials('ssh-pass-web')
            
            /** WORKING DIRECTOY **/
            SERVICES_DIRECTORY = "/home/cts-deus/services"
            WORKING_DIRECTORY  = "${SERVICES_DIRECTORY}/${THEME_NAME}"
            
            /** CONTAINER REGISTRY **/
            SERVER_REG         = "registry.ctdesarrollo-sdr.org"
            DOCKER_USER        = "docker"
            DOCKER_PASS        = credentials('registry-pass-docker')
            LATEST_THEME_IMAGE = "${SERVER_REG}/${THEME_NAME}:latest"
            
        }

    stages{
        stage('Build & Push Docker Image') {
            steps { 
                echo '==== BUILD & PUSH DOCKER IMAGE ===='
                sh 'docker login ${SERVER_REG} -u ${DOCKER_USER} -p ${DOCKER_PASS}'
                sh 'docker build \
                        --no-cache \
                        -t ${LATEST_THEME_IMAGE} \
                        .'
                sh 'docker push ${LATEST_THEME_IMAGE}'
                sh 'docker image tag ${LATEST_THEME_IMAGE} ${SERVER_REG}/${THEME_NAME}:${BRANCH_NAME}-${BUILD_ID}'
                sh 'docker push ${SERVER_REG}/${THEME_NAME}:${BRANCH_NAME}-${BUILD_ID}'
                echo '==== FINISHED DOCKER IMAGE ===='
            }
        }
        stage('Remote SSH Deploy') {
            steps {
                echo '==== REMOTE DEVELOPMENT DEPLOY ===='
                script {
                sh 'sshpass -p "${SSH_PASS}" ssh -o StrictHostKeyChecking=no ${SSH_USER}@${SSH_HOST} "docker login ${SERVER_REG} -u ${DOCKER_USER} -p ${DOCKER_PASS}"'
                sh 'sshpass -p "${SSH_PASS}" ssh -o StrictHostKeyChecking=no ${SSH_USER}@${SSH_HOST} "docker kill ${THEME_NAME}"'
                sh 'sshpass -p "${SSH_PASS}" ssh -o StrictHostKeyChecking=no ${SSH_USER}@${SSH_HOST} "docker rm ${THEME_NAME}"'
                sh 'sshpass -p "${SSH_PASS}" ssh -o StrictHostKeyChecking=no ${SSH_USER}@${SSH_HOST} "docker run -d --name ${THEME_NAME} -dit --restart always -v ${SERVICES_DIRECTORY}/${THEME_NAME}:/var/www/html/wp-content/uploads -p 8132:80 -e WORDPRESS_DB_HOST=172.22.4.33:6033 -e WORDPRESS_DB_USER=ligaDeDebateAdmin -e WORDPRESS_DB_PASSWORD=cPkJPy3V9BGiLuskpGWF -e WORDPRESS_DB_NAME=liga_de_debate ${SERVER_REG}/${THEME_NAME}:${BRANCH_NAME}-${BUILD_ID}"'
                }
                echo '==== FINISHED DEPLOYMENT ===='
            }
        }
    }
}