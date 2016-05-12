Photographer REST API

Photographer is a REST API for photographers, which helps them to work with their clients, share photos and make orders.

Software description
API is written on PHP using CodeIgniter framework, Symphony Console, Swiftmailer.  

For now there are implemented the following objects:
users,
albums,
album/images,
resized photos,
reset password,
cache viewer.

Installation
To install api you should download it from the source https://github.com/osovskaya/photographer.
Unpack all files into root directory of your web site. 

You should get the following file structure:
apidoc
app
application  
src
system
vendor
apidoc.json      
composer.json 
composer.lock   
index.php    
photographer.sql 
license.txt  
readme.rst             
readme.txt 

To create a database see file photographer.sql.
1. Create a database for application.
2. Import file  photographer.sql to created database.

Configuration
You can find main config file in /application/config/config.php.
What should be configured:
1. $config['base_url'] = 'http://hostname/'; (write here your host name)

You can find database config file in /application/config/database.php
What should be configured:
1. $db['default'] = array(
	'hostname' => 'localhost', (write here your hostname for connection to database)
	'username' => 'root', (write here your username for connection to mysql)
	'password' => 'password', (write here your password for connection to mysql)
	'database' => 'database name', (write here your database name)
All other fields in database.php should be unchanged.

You can find config file for console command in /src/Console/Command/config.php.
What should be configured:
1. 'root' =>'/var/www/' (write here path to your web site)
2. 'base_url' => 'http://mysite.com/' (write here URL to your web site)

For running console command for resizing images you should edit crontab file with the following settings:
'*/01 * * * * /var/www/app/console resize'.
Instead of '/var/www/' should be written path to your web directory, where application installed.

To run apidoc correctly edit apidoc.json file in the root directory of your application:
"url" : "https://mysite.com" (write here URL to your web site)

Usage
Documentation about how to use api is available on a link http://hostname/apidoc, where 'hostname' is your host name.

Structure
Controllers
In /application/core there is MY_Controller.php for main controller which implement all methods.
In application/controllers there are other controllers which extend main controller, load model and set table name.

Models
In /application/core there is MY_model.php for main model which implement all methods.
In /application/models there are other models which extend Main model, load database, configuration files and set table name. 

Routes
In /application/config/routes.php you can find all possible routes.

Authentication
Authentication works before any of the controllers are loaded.
First it checks token in cookies, if there is no token it checks parameters in authorization 
header with the one that are in database, if it is OK it generates token and saves it in cookies and database.
Authentication is not needed for adding new user.
Authentication controller can be found in /application/hooks/Authentication.php.
Authentication can be disabled by setting config parameter to false in /application/config/config.php:
'$config['enable_hooks'] = FALSE;'.

Cache
Response from GET and POST requests is cached with the help of memcached module.
Memcache viewer is available on a link http://hostname/memcached.
Cache can be deleted by a key through GET request or by pressing delete link in a cache viewer.
Cache controller can be found in /application/controllers/Cache.php, model - /application/models/Cache_model.php, view -
/application/views/cache.php.

Resized
After adding new image to the database Album_Images Controller add two new records in resized table.
All images are resized by console ResizeCommand which is run every minute by cron, one image per minute.
Resized images are stored on a server side in directory /application/data/images/resized.

To get more information please see Codeigniter official documentation.
