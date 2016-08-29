git pull origin 
git checkout development
composer update
create .env
create .htaccess
mkdir public/dump_images
mkdir public /app_images
chmod -R 777 storage , public, bootstrap
set up env file
php artisan migrate
php artisan db:seed
done!
