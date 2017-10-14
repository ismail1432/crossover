CrossOver
=========

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/bbd2141f-6f78-41d9-901c-91d2ba88117b/big.png)](https://insight.sensiolabs.com/projects/bbd2141f-6f78-41d9-901c-91d2ba88117b)

A Symfony project created on October 13, 2017, 6:08 pm.

# Technical Test Step #2

### See assignment [here](Assignment.pdf)

#### [D.R.Y](https://en.wikipedia.org/wiki/Don%27t_repeat_yourself) I used 3rd Party Bundles
- [FosUserBundle](https://symfony.com/doc/current/bundles/FOSUserBundle/index.html)
- [KnpSnappyBundle](https://github.com/KnpLabs/KnpSnappyBundle)
- [FeedBundle](https://github.com/eko/FeedBundle)

## Prerequisite
- [Wkhtmltopdf](https://wkhtmltopdf.org/downloads.html)
- [PHP 7](http://php.net/downloads.php)
- [MySQL](https://www.mysql.com/fr/downloads/)
- [Apache](https://httpd.apache.org/download.cgi) or [IIS](https://www.iis.net/) depend of your OS

More easy, you can download [MAMP](https://www.mamp.info/en/downloads/) or [WAMP](http://www.wampserver.com/) depend of your OS

## Installation

[Download](https://github.com/ismail1432/crossover/archive/master.zip) project or [clone it](https://github.com/ismail1432/crossover.git)

Inside the directory project run

```sh
$ php composer.phar update
```
Open the folder app/config/parameters.yml and put your parameters like this

```sh
parameters:
    database_host: 127.0.0.1
    database_port: your port
    database_name: crossover
    database_user: your database user
    database_password: your database password
    mailer_transport: your mailer transport
    mailer_host: 127.0.0.1
    mailer_user: your email
    mailer_password: your email password
```

Now create the database run 

```sh
$ php bin/console d:d:c //shortcut for doctrine:databse:create
```
Create tables/entities run
```sh
php bin/console d:s:u -f //shortcut for doctrine:schema:update --force
```

Load fixtures to have some datas run
```sh
php bin/console d:f:l --append //shorcut for doctrine:fixtures:load --append
```

At this time you can go on the url (remove "_dev" to switch in the prod environment):

http://localhost:8888/crossover/web/app_dev.php/

and you can login here : 

http://localhost:8888/crossover/web/app_dev.php/login

credentials :
- username : admin 
- password : admin 

## Run Tests 
### Be aware that you launch tests after followed the setup process !

```sh
$ ./vendor/bin/phpunit tests

```

If you have any question [contact me](mailto:contac@smaine.me)

Have fun ;-)
