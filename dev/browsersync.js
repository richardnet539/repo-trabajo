const browserSync = require('browser-sync').create();
const fs = require('fs');
const chokidar = require('chokidar');

const CONFIG_FILE = './dev/config.json';

// Function to read the server name from the config file
function getServerName() {
    if (fs.existsSync(CONFIG_FILE)) {
        const config = JSON.parse(fs.readFileSync(CONFIG_FILE, 'utf-8'));
        return config.serverName;
    } else {
        throw new Error(`Config file not found: ${CONFIG_FILE}`);
    }
}

// Initialize BrowserSync
(async () => {
    try {
        const serverName = getServerName();
        const PROXY_URL = `http://${serverName}`;

        browserSync.init({
            proxy: PROXY_URL,
            files: [
                '**/*.php',
                '**/*.html',
                './style.css'
            ],
            injectChanges: true,
            open: false,
            notify: true,
            reloadOnRestart: true,
            ghostMode: false,
            cors: true,
            serveStatic: ['./']
        });

        // Watch styles.css file and inject changes without a full reload
        chokidar.watch('./style.css').on('change', () => {
            browserSync.reload('styles.css');
        });
    } catch (error) {
        console.error('Error initializing BrowserSync:', error);
    }
})();
