#!/bin/bash

 
# **************************************************************************************************** #
#                                     Web App for IITG Hospital                                        #
#                                     -------------------------                                        #
#             The software intends at automating the working of the IITG hospital to ensure            #
#             that the patient can be given a great experience while visiting the hospital             #
#             and is given medicines which correspond to the diagnosis.                                #
#             Copyright © 2016, team1cs243.                                                            #
# **************************************************************************************************** #

clear
echo "                                            *******************************";
echo "                                              Test for Receptionist Login"
echo "                                            *******************************";

echo
echo "Test 1: username = vistaar and password = v"
echo "*******************************************"
curl -s --data "username=vistaar&password=v&&post=receptionist" http://localhost/team1cs243/login.php --dump-header nx.txt > /dev/null
echo
echo "Output:";
cat nx.txt | grep -i location

echo
echo "Test 2: username = abhishek and password = v"
echo "*********************************************"
curl -s --data "username=abhishek&password=v&&post=receptionist" http://localhost/team1cs243/login.php --dump-header nx.txt > /dev/null
echo
echo "Output:";
cat nx.txt | grep -i location

echo
echo "Test 3: username = vistaar and password = wow"
echo "*********************************************"
curl -s --data "username=vistaar&password=wow&&post=receptionist" http://localhost/team1cs243/login.php --dump-header nx.txt > /dev/null
echo
echo "Output:";
cat nx.txt | grep -i location

echo
echo "Test 4: username = abhishek and password = wow"
echo "***********************************************"
curl -s --data "username=abhishek&password=wow&&post=receptionist" http://localhost/team1cs243/login.php --dump-header nx.txt > /dev/null
echo
echo "Output:";
cat nx.txt | grep -i location
echo



echo "                                            *******************************";
echo "                                              	Test for Doctor Login"
echo "                                            *******************************";

echo
echo "Test 1: username = abhishek.cse and password = a"
echo "************************************************"
curl -s --data "username=abhishek.cse&password=a&&post=doctor" http://localhost/team1cs243/login.php --dump-header nx.txt > /dev/null
echo
echo "Output:";
cat nx.txt | grep -i location

echo
echo "Test 2: username = abhishek and password = v"
echo "*********************************************"
curl -s --data "username=abhishek&password=v&&post=doctor" http://localhost/team1cs243/login.php --dump-header nx.txt > /dev/null
echo
echo "Output:";
cat nx.txt | grep -i location

echo
echo "Test 3: username = vistaar and password = wow"
echo "*********************************************"
curl -s --data "username=vistaar&password=wow&&post=doctor" http://localhost/team1cs243/login.php --dump-header nx.txt > /dev/null
echo
echo "Output:";
cat nx.txt | grep -i location

echo
echo "Test 4: username = abhishek and password = wow"
echo "***********************************************"
curl -s --data "username=abhishek&password=wow&&post=doctor" http://localhost/team1cs243/login.php --dump-header nx.txt > /dev/null
echo
echo "Output:";
cat nx.txt | grep -i location
echo

echo "                                            *******************************";
echo "                                              Test for Pharmacist Login"
echo "                                            *******************************";

echo
echo "Test 1: username = arpan and password = a"
echo "******************************************"
curl -s --data "username=arpan&password=a&&post=pharmacist" http://localhost/team1cs243/login.php --dump-header nx.txt > /dev/null
echo
echo "Output:";
cat nx.txt | grep -i location

echo
echo "Test 2: username = abhishek and password = v"
echo "*********************************************"
curl -s --data "username=abhishek&password=v&&post=pharmacist" http://localhost/team1cs243/login.php --dump-header nx.txt > /dev/null
echo
echo "Output:";
cat nx.txt | grep -i location

echo
echo "Test 3: username = vistaar and password = wow"
echo "*********************************************"
curl -s --data "username=vistaar&password=wow&&post=pharmacist" http://localhost/team1cs243/login.php --dump-header nx.txt > /dev/null
echo
echo "Output:";
cat nx.txt | grep -i location

echo
echo "Test 4: username = abhishek and password = wow"
echo "***********************************************"
curl -s --data "username=abhishek&password=wow&&post=pharmacist" http://localhost/team1cs243/login.php --dump-header nx.txt > /dev/null
echo
echo "Output:";
cat nx.txt | grep -i location
echo

echo "                                            *******************************";
echo "                                                 Test for Patient Login"
echo "                                            *******************************";

echo
echo "Test 1: username = jayesh and password = j"
echo "*******************************************"
curl -s --data "username=jayesh&password=j&&post=patient" http://localhost/team1cs243/login.php --dump-header nx.txt > /dev/null
echo
echo "Output:";
cat nx.txt | grep -i location

echo
echo "Test 2: username = abhishek and password = v"
echo "*********************************************"
curl -s --data "username=abhishek&password=v&&post=patient" http://localhost/team1cs243/login.php --dump-header nx.txt > /dev/null
echo
echo "Output:";
cat nx.txt | grep -i location

echo
echo "Test 3: username = vistaar and password = wow"
echo "*********************************************"
curl -s --data "username=vistaar&password=wow&&post=patient" http://localhost/team1cs243/login.php --dump-header nx.txt > /dev/null
echo
echo "Output:";
cat nx.txt | grep -i location

echo
echo "Test 4: username = abhishek and password = wow"
echo "***********************************************"
curl -s --data "username=abhishek&password=wow&&post=patient" http://localhost/team1cs243/login.php --dump-header nx.txt > /dev/null
echo
echo "Output:";
cat nx.txt | grep -i location
echo


echo "                                            *******************************";
echo "                                              	Test for Admin Login"
echo "                                            *******************************";

echo
echo "Test 1: admin_key = admin"
echo "*******************************************"
curl -s --data "admin_key=admin&&post=admin" http://localhost/team1cs243/login.php --dump-header nx.txt > /dev/null
echo
echo "Output:";
cat nx.txt | grep -i location

echo
echo "Test 2: admin_key = abhishek"
echo "*********************************************"
curl -s --data "admin_key=abhishek&&post=admin" http://localhost/team1cs243/login.php --dump-header nx.txt > /dev/null
echo
echo "Output:";
cat nx.txt | grep -i location

echo
echo "Test 3: admin_key = vistaar"
echo "*********************************************"
curl -s --data "admin_key=vistaar&&post=admin" http://localhost/team1cs243/login.php --dump-header nx.txt > /dev/null
echo
echo "Output:";
cat nx.txt | grep -i location

echo
echo "Test 4: admin_key = admin123"
echo "***********************************************"
curl -s --data "admin_key=admin123&&post=admin" http://localhost/team1cs243/login.php --dump-header nx.txt > /dev/null
echo
echo "Output:";
cat nx.txt | grep -i location
echo
exit 1