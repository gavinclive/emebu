# emebu
A tryhard thesis from a bunch of lazy students :)
 
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

Copy & paste .env.sample to your .env; then adjust local environment config like DB name, username, and password.
For macOS user preferably use [**Valet**](https://laravel.com/docs/5.8/valet) for local server, [**Postgres.app**](https://postgresapp.com/downloads.html), and [**pgadmin**](https://www.pgadmin.org/download/pgadmin-4-macos/).

To create table in your database, run command below.
```
php artisan migration
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
