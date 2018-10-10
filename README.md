# OAuth-Web-Application-for-Facebook
This web app can be used to Log in with your Facebook account using OAuth 2.0 Framework. By using this web app a user can log into their own Facebook account and retrieve some general details of their account. For an example it can be the Profile picture, Name, Email or ID for the account.

So once you logged into your account you can download your profile picture to your machine by this web app.

In order to deploy and run this web app in your machine please follow these steps below.

The above web application should be deployed in the WampServer in order to run perfectly.Please follow these steps,

1). First download this repository folder to your pc. Then copy all the files in the repository folder.

2). Then create a folder named "fbapp" in your wampserver localhost folder (C:\wamp\www) and paste above copied files in there.

3). After that you have to open up 2 .php files in your notepad, named login.php and callback.php.

4). Then you have to replace the app_id and the app_secret with your own facebook application in both of the above files.

5). After that there are some other paths and links that you need to replace with your own. All of them are commented so please do things       carefully.

6). So once you done all this you are now good to go. Open up your browser and type the URL for your login.php. It should be look like this     (https://localhost/fbapp/login.php) if you follow all the above steps. Also make sure that your domain uses https:// rather than           http://. Because the Facebook will refuse insecure sites.

7). After all this if your page loaded up with no errors then you can continue.

Enjoy.

Please follow these simple 7 steps for the application in order to deploy it and run it perfectly.
