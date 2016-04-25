#!/bin/bash
sudo apt-get install apache2
sudo service apache2 restart
sudo apt-get install libapache2-mod-php5
sudo service apache2 restart
sudo apt-get install mysql-server
sudo apt-get install phpmyadmin 
sudo mkdir /var/www/html/patients/
sudo chmod 777 /var/www/html/patients/
mysql -u root -p < iitghospital.sql
exit 1