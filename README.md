# Save and Read JSON Data

## Overview

[![Minimum PHP Version1](https://img.shields.io/badge/php-%3E%3D%207.4.0-8892BF.svg?style=flat-square12)](https://php.net/)


This App can save any JSON data in database and read, update, or delete by admin panel.
Admin can read JSON data in comfortable nested tree view.

## How to install

1. Clone a given git repository to a working directory.
2. Run `composer update` within the project directory.
2. Create database named `testapp` in your mysql server or change db name in config file `/common/config/db.php`.
3. Run command in the project directory: `php yii migrate`.
4. Now you need to configure local server.
   Settings for NGINX you can find in the file <a href="https://github.com/astraliq/testApp/blob/master/nginx_settings">nginx_settings</a>.
5. Enjoy!

## How to use it

1. Register in frontend app.
2. Go to terminal, enter `php yii cron/get-token <login> <password>`, copy token. 
3. Go to `JSON` link at the top menu. 
4. Past the token load JSON file and send. 
5. Go to the backend app, follow `JsonData` link at the top menu. 
6. You can read, update or delete saved json data.