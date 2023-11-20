const { app, BrowserWindow } = require('electron');
const express = require('express');
const { exec } = require('child_process');
const path = require('path');

const appServer = express();
const port = 3000;

appServer.use(express.static(path.join(__dirname, 'public')));

appServer.get('/execute-php', (req, res) => {
  const phpScriptPath = '';
  exec(`php ${phpScriptPath}`, (error, stdout, stderr) => {
    if (error) {
      console.error(`Error: ${error.message}`);
      return res.status(500).send('Internal Server Error');
    }
    console.log(`Output: ${stdout}`);
    return res.send('PHP script executed successfully');
  });
});

app.on('ready', () => {
  const mainWindow = new BrowserWindow({
    width: 800,
    height: 600,
    webPreferences: {
      nodeIntegration: true,
      enableRemoteModule: true,
      webSecurity: true,
    },
  });

  mainWindow.loadURL('http://localhost/HHLayB/src/Login.php');


  appServer.listen(port, () => {
    console.log(`Local server is running on port ${port}`);
  });
});
