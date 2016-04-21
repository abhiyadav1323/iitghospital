# Web App for IITG Hospital

v2.0 25/04/2016

Copyright © 2016, team1cs243.



--------------------------------------------------------------------------------

CONTENTS OF THIS FILE
---------------------
   
 * Introduction
 * Features
 * Requirements
 * Bugs
 * Authors
 * Copyright And Licensing
 
--------------------------------------------------------------------------------
--------------------------------------------------------------------------------

Introduction
------------

The software intends at automating the working of the IITG hospital to
ensure that the patient can be given a great experience while visiting the
hospital and is given medicines which correspond to the diagnosis.

The software is not only limited to the IITG hospital – due to its generic
nature, it can be implemented in other places as well.

The removal of paperwork, efficiency and speed of diagnostic process,
and proper and responsible maintenance of a patient's medical history are
the key areas affected by this project.

--------------------------------------------------------------------------------

Features
--------

The system can broadly be broken down into the following features:

  * Registration:
  ---------------

    Staff members can only be registered by admin to avoid counterfeits
    with the software by providing their details – which gives them access 
    to the system with certain privileges, depending on the designation 
    of the person. Once the staff memeber is registered, 
    he/she may sign in with their user details.
    
    A patient can easily register on the web app by providing its details and
    profile picture and can login using the credentials to the patient portal.

  * Receptionist Module:
  ----------------------

    Receptionist will be able to make an appointment for patients to the
    doctors of their choice. As many doctors are available in the hospital,
    patient can schedule an appointment with any doctor of his/her personal
    preference.
    
    There will be different queues for different doctors and the
    receptionist will be able to add the patient to the specified
    doctor's queue and can also delete a specified patient if he/she wants 
    to cancel his/her appointment.

  * Doctor's Module:
  ------------------

    The doctor will have the benefit of writing the medicine only once
    in the computer (in the present scenario, the doctor writes the
    medicine with hand in 2 different sheets of paper which is tedious for
    doctors and consumes a lot of time).
    
    The doctor will be able to determine through our portal whether
    the medicine is available in the pharmacy or not in real time so that if
    the prescribed medicine is not there he/she can change the medicine.
    
    The doctor will have the ability to check the medical history of the
    patient in order to provide a more accurate diagnosis. Doctor can search 
    for information on any medicine using the api we have integrated 
    in our system.


  * Pharmacist Module:
  --------------------
    
    When giving medicines to the patients, the module will automatically
    decrement the quantity of that particular medicine so that medicine 
    inventory remains up to date at any point of time without 
    explicitly updating such type of information.
    
    This module has the feature of printing medicine receipts which can be
    easily read by anyone opposed to the handwritten medicine receipt we get
    from IITG hospital now.
    
    
  * Patient Module:
  --------------------
    
    This module offers the patient to view their past medical records 
    without coming to hospital by accesing the web app from their room.
    They can also update their information from this portal.

--------------------------------------------------------------------------------

Requirements
------------

The main server where the web apps will be hosted will simply require a
XAMPP installation, and the software which will be used in the hospital
can be run on a platform with any specifications.

We will also be requiring a medical inventory for our web app to function 
correctly and efficiently.

--------------------------------------------------------------------------------

Bugs
----

All the issues yet to be completed or resolved are listed in the "Issues"
tab of Gitlab.

To report any bugs please contact the developers of the software.
The detais of the same are available in the Authors section.

--------------------------------------------------------------------------------

Authors
-------

The project is updated and maintained by-

Abhishek Yadav https://gitlab.com/abhiyadav1323/
Vistaar Juneja https://gitlab.com/VistaarJ/
Abhishek Tyagi https://gitlab.com/tyagiabhishek13/
Jayesh Mathur https://gitlab.com/jayeshmathur123/

--------------------------------------------------------------------------------

Copyright And Licensing
-----------------------

This file is part of software - Web App for IITG Hospital.

This web app is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, version 3 of the License.

This software is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this web app.(See LICENSE.md).

If not, see <http://www.gnu.org/licenses/>.


