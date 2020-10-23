# Real time group chat using laravel and pusher

Before installing this app, you need to get  app_id, key and secret from pusher.com.  Register on pusher.com and create an app to get these info. <br><br>

<b>Installation</b>

git clone https://github.com/icodeweb/real-time-group-chat-using-laravel-and-pusher <br>
cd real-time-group-chat-using-laravel-and-pusher <br>
composer install <br>
cp .env.example .env <br>
open .env file and add values for the following pusher variables (you can get the values from the app you created at pusher.com)<br><br>
PUSHER_APP_ID=<br>
PUSHER_KEY=<br>
PUSHER_SECRET=<br>
<br>
php artisan key:generate <br>

Open the application in browser 


