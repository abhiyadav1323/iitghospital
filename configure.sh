#!/bin/bash

 
# **************************************************************************************************** #
#                                     Web App for IITG Hospital                                        #
#                                     -------------------------                                        #
#             The software intends at automating the working of the IITG hospital to ensure            #
#             that the patient can be given a great experience while visiting the hospital             #
#             and is given medicines which correspond to the diagnosis.                                #
#             Copyright © 2016, team1cs243.                                                            #
# **************************************************************************************************** #



# Configuration file for Linux OS

# install apache web server
echo "Installing apache web server...";
echo
sudo apt-get install apache2 
# restart web server
sudo service apache2 restart

echo
echo

# installs php5
echo "Installing php5 web server...";
echo
sudo apt-get install libapache2-mod-php5
# restart web server
sudo service apache2 restart

echo 
echo

# installs mysql server
echo "Installing mysql...";
echo
sudo apt-get install mysql-server

echo
echo

# installs phpmyadmin
echo "Installing phpmyadmin...";
echo
sudo apt-get install phpmyadmin 

echo
echo

# create patients folder in web server's root directory
echo "Creating patients folder in webserver's root directory...";
echo
sudo mkdir ../patients/

echo
echo

# giving permission 
echo "Giving permission to patients folder...";
echo
sudo chmod 777 ../patients/

echo
echo

# creates database
echo "Creating database for the project...";
echo
mysql -u root -p < iitghospital.sql
exit 1

#########################################################################################
#                                                                                       #
# change these settings in your php.ini file so that file upload works correctly.       # 
# -------------------------------------------------------------------------------       #
# file_uploads = On                                                                     #
# memory_limit = 128M                                                                   #
# upload_max_filesize = 20M                                                             #
# post_max_size = 30M                                                                   #
# -------------------------------------------------------------------------------       # 
#########################################################################################