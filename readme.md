## fcms 

### dependencies

#### install php5

```bash
sudo apt-get install php5-sqlite php-pear php-db php5-cli php5
```
#### install composer

```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

```bash
git clone git@github.com:zhxrain/fcms.git
composer install -vvv --prefer-dist --profile
```
### use debugbar

```bash
php artisan debugbar:publish
```
### init database

```bash
php artisan migrate
php artisan db:seed 
```

### start server

```bash
php -S localhost:9000 -t public/ server.php
```


