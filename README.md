# CSE3330_Database_Project
Description

This project is the final phase of a 3 phase project that was done over the summer for CSE3330 Database Systems and File Structures. The overall project helped students understand databases and create tables using the information from a database. The 3rd phase of the project required students to create a web interface that allows users to insert new instructors into the DOCTORAL database, update existing instructors from the database, and remove students who are graduate research assistants (GRA) who didn’t pass any milestones. The 3rd phase also includes view-based queries where students are required to create a View table that lists PhD students and the type of scholarship they have.   

Installation

The following softwares was installed on a Linux operating system; however, it is possible to install the softwares on Windows and macOs. The method to install the softwares for Linux systems will be discussed

XAMPP - A web server that allows users to create websites that shows off their projects and applications
  1. Open up terminal and type “sudo apt update”
``2. Go to the following website: https://www.apachefriends.org/index.html and download the .run file.
  3. Open up terminal and find where the .run file was installed
  4. Type “chmod +x xampp-linux-x64-<version>.run” into the terminal to make the installer executable
  5. Start the .run file by typing “sudo ./xampp-linux-x64-<version>.run” into the terminal
  6. Once the .run file is finished, XAMPP can be started by typing “sudo /opt/lampp/lampp start” into the terminal
  7. Test XAMPP by typing in localhost or your operating system’s ip address into the web search bar
      A XAMPP website should appear if XAMPP was installed correctly
     
phpMyAdmin - A software tool that allows users to upload data to create and edit databases, tables and views on the web
  1. Open up terminal and type “sudo apt update”
  2. Install phpMyAdmin by typing in “sudo apt install phpmyadmin” into the terminal
  3. A different window may pop up to set up settings for phpmyadmin
  4. Enable phpMyAdmin in Apache
  5. Type in the following to access Apache’s configuration file
    “sudo ln -s/etc/phpmyadmin/apache.conf/etc/apache2/conf-available/phpmyadmin.conf”
  6. Enable the configuration by typing “sudo a2enconf phpmyadmin
  7. Reset Apache by typing “sudo systemctl restart apache2”
  8. Type in either “localhost/phpmyadmin” or “(ipaddress)/phpmyadmin” to verify if phpmyadmin was installed correctly

