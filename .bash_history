ls
sudo apt update
sudo apt install curl php-cli php-mbstring git unzip
cd ~
curl -sS https://getcomposer.org/installer -o composer-setup.php
cd~
cd
curl -sS https://getcomposer.org/installer -o composer-setup.php
HASH=544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061
php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061
 
M') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
HASH=544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061
php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
cd ~
curl -sS https://getcomposer.org/installer -o composer-setup.php
HASH=544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061
php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
sudo apt update
sudo apt install php-cli unzip
cd ~
curl -sS https://getcomposer.org/installer -o composer-setup.php
HASH=`curl -sS https://composer.github.io/installer.sig`
echo $HASH
php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
composer
sudo apt update
sudo apt install nodejs
nodejs -v
sudo apt install npm
cd ~
curl -sL https://deb.nodesource.com/setup_14.x -o nodesource_setup.sh
nano nodesource_setup.sh
sudo bash nodesource_setup.sh
node -v
sudo bash nodesource_setup.sh
sudo apt install nodejs
node -v
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.35.3/install.sh
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.35.3/install.sh | bash
source ~/.bashrc
nvm list-remote
nvm install v13.6.0
nvm install lts/erbium
node -v
sudo apt update
sudo apt install mysql-server
sudo mysql_secure_installation
sudo mysql
mysql
mysql -u root -p
use mysql;
update user set authentication_string=PASSWORD("") where User='root';
update user set plugin="mysql_native_password" where User='root';  # THIS LINE
flush privileges;
quit;sudo /etc/init.d/mysql stop # stop mysql service
sudo mysqld_safe --skip-grant-tables & # start mysql without password
# enter -> go
mysql -uroot # connect to mysql
use mysql; # use mysql table
update user set authentication_string=PASSWORD("") where User='root'; # update password to nothing
update user set plugin="mysql_native_password" where User='root'; # set password resolving to default mechanism for root user
flush privileges;
quit;sudo /etc/init.d/mysql stop 
sudo /etc/init.d/mysql start # reset mysql
# try login to database, just press enter at password prompt because your password is now blank
mysql -u root -p 
sudo mkdir -p /var/run/mysqld; sudo chown mysql /var/run/mysqld
sudo mysqld_safe --skip-grant-tables &
mkdir -p /var/run/mysqld && chown mysql:mysql /var/run/mysqld  
mysql -uroot # "-hlocalhost" is default
sudo service mysql start
mysql
mysql -u root -p
sudo apt-get install zip unzip
ls
unzip chargebee.zip 
printenv
nano .env
ls
nano .env
php artisan key:generate
php artisan key:generator
php artisan key:generate
php artisan migrate
ls
rm -r vendor
rm -r node_modules/
ls
composer einstall
composer install
php -v
composer install
ssh root@104.236.34.13
ls
composer install
sudo apt-get intall php5-curl
/etc/init.d/apache2 restart
ls
cd ..
sudo apt-get install php-7.4-curl
sudo apt-get install curl
sudo apt update
sudo apt upgrade
sudo apt install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt install php 7.4
sudo apt install php7.4
php -v
sudo apt install php7.4-fpm
sudo nano /etc/php/7.4/fpm/php.ini
composer install
ls
cd root
ls
composer install
sudo service apache2 restart
composer install
sudo apt-get install php7.4-curl
sudo service apache2 restart
composer install
composer update
sudo apt install php7.4-extension_name
sudo apt install php7.4-common php7.4-mysql php7.4-xml php7.4-xmlrpc php7.4-curl php7.4-gd php7.4-imagick php7.4-cli php7.4-dev php7.4-imap php7.4-mbstring php7.4-opcache php7.4-soap php7.4-zip php7.4-intl -y
composer install
npm install
php atisan migrate
php artisan migrate
nano .env
php artisan migrate
php artisan
php artisan key:generate
php artisan migrate
mysql
nano .env
php artisan migrate
nano .env
mysql -u root -p
sudo service mysql start
php artisan migrate
ls
php artisan config:clear
php artisan cache:clear
php artisan migrate
php artisan migrate --force
ls
cd ..
cd /
cd /etc
ls
cd /
ls
