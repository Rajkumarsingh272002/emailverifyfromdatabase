Nmae of Project  =>"email verify from database"
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Aim:-
"To build a web-based system that verifies user email and password from a database during login and allows account creation, login, and password management using (Vue.js3 composition + PHP-APi + axios + vue-router + pinia + bootstrap + javascript + html + css + mysql"). this project is 'CORS( Cross-Origin Resource Sharing)' . We using Rest-Api for backend and using "mysql" for manage database

                            this project are "cors" type project we using Tech Stack=> (HTML, css3, bootstrap5, javascript,vue.js3-composition-api, vue-router, pinia, xampp, php-Api,mysql,Axios))
                          (in this project you found login and sign-up and dashboard. you do regsiterd through signup-page and then you can do login . during signup if you alraedy signup by email then this show message your "email id" alreday exit into database means  this email-id as you giving this match from "database" if  "did not match" then you resgister "successfully" and you can do login. during registration type you give passowrd , you password secure keep in database by incrypt mode. when you go into login page asked to you fillup "email" and "password" if "eamil and "password" did match from database then you found dashboard if did not match "email" and "password" from database you found alert message that check "email" and "passsword". after successfully login you jum to dashboard . into dashboard you found more module such that(profile,change password,logout) will be show. into profile you  can do update profile(such that -change "email-id",change"username",change"mobile". into change password you can do change(update) password. finally you logout in easy way. this is simple "email verify project from database".)
                          
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

SCREENSHOT=>

![Image](https://github.com/user-attachments/assets/c364333c-ea62-475b-9d76-cc1051e9c4d5)
![Image](https://github.com/user-attachments/assets/54920569-0340-4912-b605-9e18173f6003)
![Image](https://github.com/user-attachments/assets/df14e0e6-1452-4271-9d3e-8d75b2760792)
![Image](https://github.com/user-attachments/assets/98ee0af3-2c0d-4f36-82dd-0ffe2a3eb5f8)
![Image](https://github.com/user-attachments/assets/c55e122a-70ed-4b4e-8343-2ec512864275)
![Image](https://github.com/user-attachments/assets/d143ccce-e35e-4618-874f-2b146a98dea5)
![Image](https://github.com/user-attachments/assets/b8f03a4b-c0bb-413a-b50e-81e43619c87e)
![Image](https://github.com/user-attachments/assets/4c1e31f9-f632-41aa-b2d7-8ea39fe55c05)

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 1. Login Page
URL: /emailverifyfromdatabase/
This page allows users to log in using their email and password.
When the user enters valid credentials and clicks Login Now, the frontend sends a request to the backend (PHP) to verify the login.
If login is successful, the user is redirected to their dashboard.
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
📝 2. Registration Page
URL: /emailverifyfromdatabase/registered
New users can create an account by filling:
Full Name
Email
Phone Number
Password
Repeat Password
After clicking Create Account, the form sends user data to a backend script that stores it in the MySQL database.
On success, it shows the message:
✅ “successfull create account plz login”
/////////////////////////////////////////////////////////////////////////////////////////////////
🧑‍💼 3. User Dashboard
URL: /dashboardshow
After logging in, the user sees a dashboard with options:
Dashboard
Profile
Change Password
Logout
The top welcome message confirms login:
“Welcome: rajkumar singh”
///////////////////////////////////////////////////////////////////////////////////////////////////
🔒 4. Change Password Page
URL: /dashboardshow/changePassword
This page lets users change their password securely.
Fields:
Current Password
New Password
Confirm Password
User ID (from database) is shown as well.
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
🛠 5. Console Debug Info
Shows success message and user details on login:
{
  message: "success",
  id: 3,
  username: "rajkumar singh",
  email: "rks@gmail.com",
  mobile: "7898098987"
}
///////////////////////////////////////////////////////////////////////////////
Also confirms:
auth.isAuthenticated: true
This means the user is logged in and authenticated.
///////////////////////////////////////////////////////////////////////////////////////
💡 Technology Used
Frontend: Vue.js
Backend: PHP
Database: MySQL (via phpMyAdmin)
Hosting: InfinityFree (free PHP hosting with SSL)
////////////////////////////////////////////////////////////////////////////////////////////////
✅ What You Have Successfully Built
User Authentication System (Register, Login, Logout)
Frontend & Backend Integration using Vue.js + PHP-APi + axios + vue-router + pinia + bootstrap + javascript + html + css
Database Connection with MySQL
Form Handling & Validation
Session/Auth Logic
Live Deployment on InfinityFree
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

FEATURES:-
Signup- you registed in easy way this convenient with "email verify from database"
login-you goto dushboard by login if your "email" and "password" verify from database successful
dashboard-more module(profile,change password,logout)
          profile-you can do update profile
          change password-yes change password in easy way , this password save into database in secure way
          logut-in easy way you can do logout
note:-this "cors" project(email verify from database)

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
5-note-: we used php-Api(Rest-Api) as communicate with vue.js-project(this is "cors" system type project).
  and in this folder((pro1_Api_emailVerFromDatabase) you found again one folder (projectFolderAllmainFolder)  when open this (projectFolderAllmainFolder)folder you found php-APi ALL 

.............................................................................................................................................................................................
DATABAE WORK:-
 1-goto xampp->start (mysql)->admin(click)-you found(http://localhost/phpmyadmin/)-see browser
 2-make new database(signup) into http://localhost/phpmyadmin/
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
   note:-this project "cors" type project
   .............................................................................................................
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  Tech Stack=> (HTML, css3, bootstrap5, javascript,vue.js3-composition-api, vue-router, pinia, xampp, php-Api,mysql,Axios)
    
