FRONTEND WORK:-
0-Node.js Install  (अगर पहले से नहीं है)
Node.js download : https://nodejs.org
for check node install or not:- open cmd-command and type (node -v) then enter  .you will see v22.11.0

1-download all folder(backend_phpApi,database,frontend) from github
2-frontend=>
  ---1-open fronend folder and then will be show vue.js3-project then you open this vue.js3-project with  visual-studio-code .
  ---2-opend cmd-command and type (cd ..) then enter like this you continue (cd ..) when till you will not found c:\ and in last you cmd-command look like this c:/
  ---3-you cmd-command look like this: c:/ and open visual-studio-code goto file-menu click(open-folder) then select (frontend) this folder where you download this frontend from github after open frontend folder you   will see vue.js project.
  --4- goto view-menu select (terminal) . from terminal you find path then you copy only just example like this:(\Users\Rajkumar\Desktop\project1\emailVerificationFromDatabaseLocalhost\emailVerify_FromDatabase-main\frontend) . same as your computer do like this but your computer will be your path you copy and you used own path, do not use my path ok.
  --5-paste(\Users\Rajkumar\Desktop\project1\emailVerificationFromDatabaseLocalhost\emailVerify_FromDatabase-main\frontend) into cmd.
      same as you paste own path like this ok, not my path ok.
     cmd:-
       C:  \Users\Rajkumar\Desktop\project1\emailVerificationFromDatabaseLocalhost\emailVerify_FromDatabase-main\frontend>
          then you do enter and agin type (npm run dev) in last 
          C:  \Users\Rajkumar\Desktop\project1\emailVerificationFromDatabaseLocalhost\emailVerify_FromDatabase-main\frontend>npm run dev
          then enter your vue.js project will be run .
          you type http://localhost:5173/ into browser.

................................................................................................................................................
BACEND WORK:-
1-install LOCAL  SERVER ENVIRONMENT YOU INSTALL XAMPP(X (Cross-platform) + Apache + MySQL/MariaDB + PHP + Perl)  FROM OFFICAL WEBSITE https://www.apachefriends.org
2-open dowload folder(backend_phpApi) inside this folder you found htdocs folder then again doubile clik on htdocs folder you found one folder which name are(pro1_Api_emailVerFromDatabase). and copy of
this folder (pro1_Api_emailVerFromDatabase) .
3-goto c-drive ->xampp->htdocs->paste(pro1_Api_emailVerFromDatabase)
   means look like this:-c-drive ->xampp->htdocs->(pro1_Api_emailVerFromDatabase)
4-plz you open xampp local environment server so that vue.js and php-api communicate one to another.
    start-Apache
    start-mysql
5-note-: we used php-Api(Rest-Api) as communicate with vue.js-project(this is "cors" system).
  and in this folder((pro1_Api_emailVerFromDatabase) you found again one folder (projectFolderAllmainFolder)  when open this (projectFolderAllmainFolder)folder you found php-APi ALL 

.............................................................................................................................................................................................
DATABAE WORK:-
 1-goto xampp->start (mysql)->admin(click)-you found(http://localhost/phpmyadmin/)
 2-make new database(signup)
 3-when you make database name(signup) then select (signup) database name 
 4-goto import and click import 
 5-choose file(signup.sql) as you alreday download done from github open download folder name(database) and select (signup.sql)
 6-after select(signup.sql) finally click "import" button.
 7-all table show of (signup.sql) into your database as you make(signup)
 ........................................................................................
 finally:-
 goto browser :-
  type:- http://localhost:5173/
   you project(email verifaction from database) run successfully.
   note:-this project "cors" project
   .............................................................................................................

  
    
