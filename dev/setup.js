const fs = require('fs');
const readline = require('readline');

const CONFIG_FILE = './dev/config.json';

// Function to prompt the user for input
function askQuestion(query) {
    const rl = readline.createInterface({
        input: process.stdin,
        output: process.stdout,
    });

    return new Promise(resolve => rl.question(query, answer => {
        rl.close();
        resolve(answer);
    }));
}

async function setup() {
    if (fs.existsSync(CONFIG_FILE)) {
        const config = JSON.parse(fs.readFileSync(CONFIG_FILE, 'utf-8'));
        console.log(`Configuration already exists. Using server name: ${config.serverName}`);
    } else {
        const serverName = await askQuestion('Please enter the server name (e.g., localhost:8000 or wordpress.local): ');
        
        // Save the server name to a configuration file
        const config = { serverName };
        fs.writeFileSync(CONFIG_FILE, JSON.stringify(config, null, 2), 'utf-8');
        
        console.log(`Server name saved to ${CONFIG_FILE}`);
    }
}

setup();
