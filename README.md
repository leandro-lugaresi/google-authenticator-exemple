google-authenticator-exemple
====================

Introduction
------------

This is an example of implementation of login with Google Authenticator.

Requirements
------------

* [Google Authenticator](https://github.com/leandro-lugaresi/google-authenticator) (1.0.)
* [zendframework/zend-math](https://github.com/zendframework/zf2) (>2.2.*)

Installation
------------

1. Clone the repository and install the dependencies:

```bash
    cd my/project/dir
    git clone git@github.com:leandro-lugaresi/google-authenticator-exemple.git
    cd google-authenticator-exemple
    php composer.phar self-update
    php composer.phar install
```

Web Service Setup
-----------------

###PHP CLI Server

The simplest way to get started if you are using PHP 5.4 or above is to start the internal PHP cli-server in the root directory:

```bash
    php -S 0.0.0.0:8080 -t public/ public/index.php
```

This will start the cli-server on port 8080, and bind it to all network interfaces.


###Apache Setup

To setup apache, setup a virtual host to point to the public/ directory of the project and you should be ready to go! It should look something like below:

```
<VirtualHost *:80>
    ServerName google-authenticator.local
    DocumentRoot /path/to/google-authenticator-exemple/public
    SetEnv APPLICATION_ENV "development"
    <Directory /path/to/google-authenticator-exemple/public>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
```