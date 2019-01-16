# ELearning API - Admin

[![N|Solid](https://api-platform.com/logo.png)](https://api-platform.com/docs/core/)


### Installation

Install the dependencies and devDependencies and start the server.
##### Required packages

* [Docker] - software platform designed to make it easier to create, deploy, and run applications by using containers
* [Composer] - package manager for the PHP 
* [Git] - duh?
* [MySQL Workbench] - for database debugging

##### Other option
* [XAMPP] - if too lazy

##### Preferred starting up the server
Follow theses steps...

```sh
$ git clone https://github.com/jeromeregulado/elearning-admin.git
$ cd elearning-admin
$ composer install -o --prefer-dist
$ docker-compose up --build -d
```

if done, go to your browser then hit ``http://localhost``

**else** copy your `elearning-admin` directory to your XAMPP directory then access it 

   [Docker]: <https://docs.docker.com/install/>
   [Composer]: <https://getcomposer.org/download/>
   [Git]: <https://git-scm.com/downloads>
   [MySQL Workbench]: <https://dev.mysql.com/downloads/workbench/>
   [XAMPP]: <https://www.apachefriends.org/download.html>
