<p align="center"><a href="https://shaonmajumder.github.io" target="_blank"><img src="links.jpg" width="400"></a></p>


<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## Build
helpeful links -

[create laravel project](https://laravel.com/docs/8.x/installation)  <br /> 
[check laravel version](https://laravel.com/docs/4.2/artisan)  <br /> 
[auth scaffolding laravel 8 login does not show anything,
laravel login not found](https://stackoverflow.com/questions/30154016/laravel-5-auth-login-not-found/38733535)  <br /> 
[install npm ubuntu](https://linuxize.com/post/how-to-install-node-js-on-ubuntu-18.04/)  <br /> 
[login register scaffolding laravel](https://laravel.com/docs/6.x/authentication)  <br /> 
[how to disable a config file in apache2](https://www.digitalocean.com/community/tutorials/apache-basics-installation-and-configuration-troubleshooting)  <br /> 
[foreach laravel](https://stackoverflow.com/questions/24277443/laravel-foreach-loop-in-controller)  <br /> 
[The stream or file "laravel.log" could not be opened in append mode: failed to open stream: Permission denied](https://stackoverflow.com/questions/23411520/how-to-fix-error-laravel-log-could-not-be-opened) 

## Error

vhost forbidden -

check vhost is pointed to corrected folder and hosts file

**Rewrite mod**

>  sudo a2enmod rewrite

>  sudo service apache2 restart

page expired 419 laravel -

> php artisan cache:clear

pagination button laravel broken -
https://stackoverflow.com/questions/63840416/how-to-fix-laravel-8-ui-paginate-problem

### Preparation

#### LAMP
#### PHPMYADMIN
#### composer
#### nodejs with npm
##### install curl
> sudo apt  install curl
##### Enable the NodeSource repository
> curl -sL (https://deb.nodesource.com/setup_12.x | sudo -E bash -
##### Installing Nodejs
> sudo apt-get install -y nodejs
##### Installing Typora
###### get
> wget -qO - (https://typora.io/linux/public-key.asc | sudo apt-key add -
###### add Typora's repository
> sudo add-apt-repository 'deb (https://typora.io/linux ./'
> sudo apt-get update
###### install typora
> sudo apt-get install typora


### Install
(Installation Via Composer)
> composer create-project laravel/laravel links


### check version
> php artisan --version


### Run
> php artisan serve
check at http://127.0.0.1:8000/
 // should up and running


### create link for app
#### add the host link for app
> sudo nano /etc/hosts
or
> code /etc/hosts


Then add line :
127.0.1.1   links.test
and save as sudo


#### create virtual host
##### add configuration
###### edit config file


> sudo nano /etc/apache2/sites-available/links.test.conf
add lines :
""""
<VirtualHost *:80>
    ServerAdmin admin@links.test
    ServerName links.test
    DocumentRoot /home/shaon/Projects/links/public/
    DirectoryIndex index.php
    <Directory /home/shaon/Projects/links/public/>
            Options -Indexes +FollowSymLinks +MultiViews
            AllowOverride All
            Require all granted
            <FilesMatch \.php$>
            # Change this "proxy:unix:/path/to/fpm.socket"
            # if using a Unix socket
     ​       #SetHandler "proxy:fcgi://127.0.0.1:9000"
     ​       </FilesMatch>
    </Directory>
    ErrorLog ${APACHE_LOG_DIR}/links.test-error.log
    # Possible values include: debug, info, notice, warn, error, crit,
    # alert, emerg.
    LogLevel warn
</VirtualHost>
""""


###### enable custom and disable default server config
> cd /etc/apache2/sites-available/
> sudo a2dissite 000-default.conf
> sudo a2ensite links.test.conf


###### restart apache2 server
> sudo service apache2 restart
> cd ~/Projects/links/..
> cd links
browse at http://links.test now


##### If Error UnexpectedValueException
The stream or file "/home/shaon/Projects/links/storage/logs/laravel.log" could not be opened in append mode: failed to open stream: Permission denied 

sudo chmod -R 777 links

##### Exception
Unable to create lockable file: /home/shaon/Projects/links/storage/framework
ls -l storage
sudo chmod -R 777 storage/

**Give permission to project folder**
(Change the permission to secured permission in live server else, you will be vulnerable to security attacks)
> sudo chmod -R 777 links


##### Browse Test
browse at http://links.test now


### login register scaffolding laravel
#### installing laravel ui composer package
> composer require laravel/ui
#### installing vuejs scaffolding for authorization
> php artisan ui vue --auth
#### install npm package
> npm install
#### enable change of the js
> npm run dev
(if does not work for the first time, repeat > npm run dev)
If build successful then go next step
browse at http://links.test/login now


#### If Not Found
##### enable mod rewrite
sudo a2enmod rewrite
##### restart apache
sudo service apache2 restart


### Enabling Login/Register
#### Creating Database
Login to myadmin with your app mysql user
create a database with naming "links" and collation "utf8_general_ci"


#### Edit .env
APP_NAME=Links
APP_URL=http://links.test
DB_DATABASE=links
DB_USERNAME=mysql-username-for-app
DB_PASSWORD=mysql-password-for-that-username


#### Run migrations
> php artisan migrate


#### Register a user
Browse at http://links.test/register


## Errors


> php artisan tinker
> Link::factory()->count(500)->create()
### solve
> sudo php artisan tinker


stop giving password repeatedly github -
> git config --global credential.helper cache 

## How to clone this project 
git clone <repo_link>
composer update
cp .env.example
vhost
php artisan migrate:fresh --seed


Exception
Unable to create lockable file:

Exception
Unable to create lockable file:


## About Laravel


Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:


- [Simple, fast routing engine]((https://laravel.com/docs/routing).
- [Powerful dependency injection container]((https://laravel.com/docs/container).
- Multiple back-ends for [session]((https://laravel.com/docs/session) and [cache]((https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM]((https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations]((https://laravel.com/docs/migrations).
- [Robust background job processing]((https://laravel.com/docs/queues).
- [Real-time event broadcasting]((https://laravel.com/docs/broadcasting).


Laravel is accessible, powerful, and provides tools required for large, robust applications.


## Learning Laravel


Laravel has the most extensive and thorough [documentation]((https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.


If you don't feel like reading, [Laracasts]((https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.


## Laravel Sponsors


We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page]((https://patreon.com/taylorotwell).


### Premium Partners


- **[Vehikl]((https://vehikl.com/)**
- **[Tighten Co.]((https://tighten.co)**
- **[Kirschbaum Development Group]((https://kirschbaumdevelopment.com)**
- **[64 Robots]((https://64robots.com)**
- **[Cubet Techno Labs]((https://cubettech.com)**
- **[Cyber-Duck]((https://cyber-duck.co.uk)**
- **[Many]((https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting]((https://www.webdock.io/en)**
- **[DevSquad]((https://devsquad.com)**
- **[Curotec]((https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG]((https://op.gg)**
- **[CMS Max]((https://www.cmsmax.com/)**
- **[WebReinvent]((https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**


## Contributing


Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation]((https://laravel.com/docs/contributions).


## Code of Conduct


In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct]((https://laravel.com/docs/contributions#code-of-conduct).


## Security Vulnerabilities


If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.


## License


The Laravel framework is open-sourced software licensed under the [MIT license]((https://opensource.org/licenses/MIT).