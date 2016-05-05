Photographer REST API

Photographer is a REST API for photographers, which helps them to work with their clients, share photos and make orders.

Software description
API is written on PHP using CodeIgniter framework.

Installation
To install api you should download it from the source 
Unpack all files into root directory of your website. 

You should get the following file structure:
apidoc
application  
system
user_guide
apidoc.json      
composer.json    
index.php    
photographer.sql  
contributing.md  
license.txt  
readme.rst             
readme.txt 

To create a database see file photographer.sql.
1. Create a database for application.
2. import file  photographer.sql to created database.


Additional software for using API:
npm package to install nodejs
nodejs to use apiDoc
apiDoc
composer
mysql
PHP module memcached 

Configuration
You can find main config file in /application/config/config.php.
What should be configured:
1. $config['base_url'] = 'http://domainname/'; (write here your domain name)
2. $config['enable_hooks'] = TRUE; (you can change it to FALSE in order to disable authentication)

You can find database config file in /application/config/database.php
What should be configured:
1. $db['default'] = array(
	'hostname' => 'localhost', (write here your hostname for connection to database)
	'username' => 'root', (write here your username for connection to mysql)
	'password' => 'password', (write here your password for connection to mysql)
	'database' => 'database name', (write here your database name)

All other fields in database.php should be unchanged.

You can find fields validation config file in /application/config/config_validation.php
It contains list of fields for user and album tables, which should be passed in POST request.
Also it contains validation rules.


Usage
Documentation about how to use api is available on a link http://domainname/apidoc, where 'domainname' is your domain name.

Structure
Controllers
In /application/controllers there is Main.php for main controller which implement all methods both for users and albums.
User and Album controllers extend Main controller, load model and set table name.

Models
In /application/models there is Main_model.php for main model which implement all methods both for users and albums.
User and Album models extend Main model, load database, configuration files and set table name. 
In Album model methods add and update are overrided.

Routes
In /application/config/routes.php you can find all possible routes.

Authentication
Authentication works before any of the controllers are loaded.
First it checks token in cookies, if there is no token it checks parameters in authorization 
header with the one that are in database, if it is OK it generates token and saves it in cookies and database.
Authentication is not needed for POST request.
Authentication controller can be found in /application/hooks/Authentication.php.

Cache
Response from GET and POST requests is cached with the help of memcached module.
Memcache viewer is available on a link http://domainname/memcached.
Cache can be deleted by a key through GET request or by pressing delete link in a cache viewer.
Cache controller can be found in /application/controllers/Cache.php, model - /application/models/Cache_model.php, view -
/application/views/cache.php.

To get more information please see Codeigniter official documentation
