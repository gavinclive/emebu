# emebu
Emebu is our project that aims to become an event sharing platform with ticketing platform and P2P approach between attendees and event organizers. Emebu comes in the form of web app and mobile app.

[Link to the mobile app repository](https://github.com/gavinclive/emebu-native)
 
### Installation
---

Install Laravel in root folder.
```
composer install
```

Install node in root folder.
```
npm install
```

Copy & paste .env.example to your .env; then adjust local environment config like DB name, username, and password.
For macOS user preferably use [**Valet**](https://laravel.com/docs/5.8/valet) for local server, [**Postgres.app**](https://postgresapp.com/downloads.html), and [**pgadmin**](https://www.pgadmin.org/download/pgadmin-4-macos/).

To create tables in your database and seed the datas, run command below.
```
php artisan migrate --seed
```

If you previously already have old tables in your database, run command below.
```
php artisan migrate:fresh --seed
```

Go to `storage/app/public` and run command below.
```
php artisan storage:link
```

### Usage
---
##### Development
Once you make some development on Vue, CSS and JS files, please run below command before reviewing it in the browser.
```
npm run dev
```

For hot reloading use command below.
```
npm run hot
```

##### Production
```
npm run production
```

Credits to [cretueusebiu](https://github.com/cretueusebiu) for the template.
