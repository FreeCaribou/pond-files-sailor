# Pond Files Sailor

A little app to store files

And I love word joke (yeah, pond != cloud and sailor != drive ... and I just like pond with duck)

## TODO for the base app

- Add some files in a folder
- Possibility to have a share key for a file
- Change user info
- Show what amount of mega bites it's used
- i18n
- Color and icon change for type of file, and for folder, is file present or not (or sub folder)
- Have some text area that we can just save
- Make verification of size of the file
- Error management (for 404 too)
- Clean the app (delete useless route and component ! see what to refactor and re use)

## TODO for better app

- Share files by email
- Systems to have folder managed by multiple users (analyse that too ...)
- Admin mode ?
- Share folder ?
- Easily move a file to a folder to another folder
- Preview mode for some kind of file ? Like picture and pdf
- Dark mode ?
- Other thing probably

## Tech

### Laravel with React starter kit

https://laravel.com/starter-kits

### PostgreSQL

## Launch for dev

Install PHP and composer

"podman compose -f docker-compose.yaml -p pondfilessailor_pg up" or equivalent will create the docker DB

"php artisan migrate:fresh --seed" to refresh the DB with mock data

"composer run dev" will run the project in localhost

## Some command

php artisan db:show - see the db stade

php artisan db:table <x> - see the info details of a table

php artisan make:migration create\_<x>\_table - create a migration file (php artisan make:migration <x> - work too)

php artisan migrate - execute the migration file

php artisan db:seed - seed the database with mock data (php artisan migrate:fresh --seed - the same but with refresh all)

composer run dev - run the project in localhost

php artisan app:create-user - cmd to create a new user, usefull in prod

podman compose -f docker-compose.yaml -p pondfilessailor_pg up - launch with podman the docker and name it pondfilessailor_pg

## Production

- Most of the information are there, https://laravel.com/docs/12.x/deployment

- composer install --no-dev --optimize-autoloader - install the base package

- (needed for the first deploy) php artisan key:generate - usefull to create the APP_KEY env var

- php artisan migrate - to make the migration of the db schema in case of new thing

- php artisan optimize

- npm i && npm run build - to launch the frontend part

- php artisan app:create-user - to create a new user, the only way to add it

## Language in the app

- English
- Français
- Nederland (min of meer... behulp met google trad...)
