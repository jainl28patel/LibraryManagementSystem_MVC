# LibraryManagementSystem_MVC

# About

* It is a basic Library Management System made using MVC Architecture and PHP

# Build Using
* PHP 7.4.30
* MySQL 8.0.29
* TWIG for frontend file 
* Apache2 
* Composer version 2.3.9 
* TORO PHP for request handling 

# SETUP Guide

* Clone the repository using the following command
* ``$ git clone git@github.com:jainl28patel/LibraryManagementSystem_MVC.git``
* Open the terminal and run following command 
* ``$ cd <pathofFolder>``
* Replace <pathofFolder> with the path of the folder
* Make sure you have installed composer and TORO PHP.
 ```
 $ composer install
 $ composer dumpautoload
 ```
 * Now run `$ ./setup.sh` which will setup the config file and required database

# SETUP V-host [For MAC-M1]
* install nginx using `$ brew install nginx`
* Run the following commands
```bash
$ sudo vim /opt/homebrew/etc/nginx/nginx.conf
```
* Enter the line `$ include /opt/homebrew/etc/nginx/sites-enabled/*;` at the end .
* Run
```bash
$ cd /opt/homebrew/etc/nginx
$ mkdir sites-enabled
$ sudo vim lib.mvc.local.conf 
```
* Paste the following in this file and change the server name
```bash
server {
        #listen 443;
        server_name <Enter_server_name>;

        location / {
                client_max_body_size 300M;
                proxy_pass http://127.0.0.1:8000;
                proxy_http_version 1.1;
                proxy_set_header Upgrade $http_upgrade;
                proxy_set_header Connection "upgrade";
                proxy_read_timeout 86400;
                proxy_set_header X-Forwarded-Proto $scheme;
        }
}
```
* Open `$ sudo vim /etc/hosts` and add 
```bash
127.0.0.1      <name_of_server>
```
