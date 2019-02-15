# PHP-Blog
A blog webpage build mainly with PHP


CTI PHP UNIT 3 PROJECT 
Online trading blog.

*************************************************************
* Author:				Toby Swart
* Date: 					2018-11-27
* Description:				Create trading blog database	
* Project Number			Project 1A		
*Project code				MLPB185-01
*************************************************************
DOCUMENTITON INDEX

+ Description of application
+ Setting up the website
+ Setting up the Database
+ Directions of use
•	Signup
•	login
•	Create post
•	Change password
•	Search Friends
•	Add Friend
•	Remove Friend
•	Search all posts
•	Read a post
•	Create comment
•	Upload/Update/Delete a profile pic
+ Handling errors
•	Incorrect signup info
•	Incorrect password/username on login
•	Please login
•	Trying to upload the wrong file
•	Incorrect password match
•	Incorrect user profile name
•	Incorrect  comment on article

Description of application.
This webpage is an online trading blog system that allows users to sign up and then login to the website to browse the blog posts from other users or create their own posts if they want to.

When signing up to the website, an email is sent to the user with their username and password.

The website also allow users to comment on the articles they read and make friend with other users that have signed up to the website.

Both users and articles on the website allow filtering with a search feature.

Once the user is signed up and logged in the user can set their profile picture and their personal information.

The user password can also be updated if the user so desires. 

Home page screenshot is below:
 

Setting up the website

Before the website can be launched XAMPP needs to be running properly.

1.	Launch XAMPP Control panel 
2.	Start the Apache service 
3.	Start the MySQL service 
4.	Copy the project folder into C:\xampp\htdocs
5.	Now proceed with setting up the MySQL database















Setting up the Database

Before the website can be launched and operate successfully the MySQL database need to be set up first.

1.	Open PHPMyAdmin at http://localhost/phpmyadmin/index.php 
2.	Navigate the project folder to and find the create_db.txt file.  
3.	Copy its contents and go back to PHPMyAdmin
4.	Inside the PHPmyAdmin control navigate into the SQL tab 
5.	paste everything into the SQL tab  and press the GO button
 
6.	The query should will run without errors and look like this:  








Directions of use

These instructions show how to do the various functions that are possible on the website.

Go to the URL below in your browser:
http://localhost/Project/Project%20Recources/index.php

•	Signup
To sign up the user presses the signup button inside the header.    After signing up an email like this is sent to the users email address  

•	Login
To login the user presses the login button inside the header after the filled their username and password in.  


•	Create post
The user can Click on My Posts button and are all their post. There will be a button create new post.  

When pressed the user will be taken to a create post form where they can formulate there article for the website.  

•	Change password

If the user is unhappy with their password on want to add a new one they can do so on the Profile page,   after pressing the Change password button.    


•	Search Friends
Once several users are created, friends can searched on the friends page.   In the screen shot below another user called Admin and another user called User123 were created.
Then the name admin was searched and the results are displayed  
•	Add Friend
After this the friend can be added by pressing the add friend button  



•	Remove Friend
Remove the friends on the friends list buy pressing remove friend button    








•	Search all posts
On the browse page, the user can search a keyword,  in this case the word trade was searched.
Once the search is completed, the total number of results is displayed and the results are shown.  

•	Read a post
To read a post click on continue reading.  

•	Create comment
To create a comment on an article wite it in the comment field and press the post comment button.    


•	Upload/Update/Delete a profile pic
Press choose a file button and  Navigate to C:\xampp\htdocs\Project\sample profile images 
And choose profile picture press upload  
Press the delete button to remove the profile picture  


















Handling Errors

•	LOGIN ERROR HANDLERS


Incorrect username/email  
Incorrect password 
 
All fields are not filled in  









•	TRYING TO BROWSE WITHOUT LOGIN
When user press continue browsing site button without being logged in the get redirected to:  


•	TRYING TO UPLOAD INCORRECT FILE
Upload wrong file type  
Uploaded file is too large  
Trying to upload without choosing an image  

•	PASSWORD ARE NOT MATCHING
When the user changes their password and the passwords don’ t match.  

The users password is not filled in  
The users password is incorrect.   

Whe












•	WHEN THE USER UPDATE THEIR PROFILE

And fills in an invalid name such as a number  
