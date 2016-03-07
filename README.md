# Automation of IITG Hospital

v1.0 22/02/2016

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

    Staff members have to explicitly register with the software and provide
    their details – which gives them access to the system with certain
    privileges, depending on the designation of the person. Once the staff
    memeber is registered, he/she may sign in with their user details.

  * Receptionist Module:
  ----------------------

    Receptionist will be able to make an appointment for patients to the
    doctors of their choice. As many doctors are available in the hospital,
    patient can schedule an appointment with any doctor of his/her personal
    preference, provided that the doctor is not too busy/doesn't have a
    large queue.
    
    The registration of new patients can be easily done by the
    receptionist. On registering a patient, the receptionist will be given
    a unique ID which can be given to the patient for future use. This ID
    can be used when the patient comes to the hospital in the future and
    wants to schedule an appointment.
    
    The receptionist will be able to handle emergency cases where he/she
    can give higher priority to emergency patients while making an appointment
    to the doctor. The decision as to who is considered an emergency case is
    given to the receptionist, and the doctor can revoke the 'emergency'
    status of a patient if the claim is found to be fraudulent.
    
    There will be different queues for different doctors and the
    receptionist will be able to add the patient to the specified
    doctor's queue.

  * Doctor's Module:
  ------------------

    The doctor will have the benefit of writing the medicine only once
    in the computer (in the present scenario, the doctor writes the
    medicine with hand in 2 different sheets of paper which is tedious for
    doctors and consumes a lot of time).
    
    Auto completion to ease the process of prescribing medicines to patients.
    
    The doctor will be able to determine through our portal whether
    the medicine is available in the pharmacy or not in real time so that if
    the prescribed medicine is not there he/she can change the medicine.
    
    The doctor will have the ability to check the medical history of the
    patient (to some extent) in order to provide a more accurate diagnosis.
    
    The above feature helps in claiming reimbursement as well. As if the
    medicine is not available in the pharmacy then this will be noted and
    stored in the database so when the patient claims for reimbursement its
    correctness can be checked with the database and will remove any delay of
    verifying it with the receipts. With the current system, receipts can be
    lost (which will be a problem while claiming for the reimbursement), but
    with this software the solution to this problems comes handy.

  * Pharmacist Module:
  --------------------

    This module will provide the feature of altering the medicine inventory
    to the pharmacist.
    
    He/ She can add/delete medicines in the inventory as and when a change
    occurs (a medicine stock is bought or a stock is depleted).
    
    When giving medicines to the patients, the module will automatically
    decrement the quantity of that particular medicine so that medicine inventory
    remains up to date at any point of time without explicitly updating such
    type of information.
    
    This module has the feature of printing medicine receipts which can be
    easily read by anyone opposed to the handwritten medicine receipt we get
    from IITG hospital now.

--------------------------------------------------------------------------------

Requirements
------------

The main server where the web apps will be hosted will simply require a
XAMPP installation, and the software which will be used in the hospital
can be run on a platform with any specifications.

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

This file is part of software - Automatiion of IITG Hospital.

Automatiion of IITG Hospital is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, version 3 of the License.

This software is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Automation of IITG Hospital.(See LICENSE.md).

If not, see <http://www.gnu.org/licenses/>.


