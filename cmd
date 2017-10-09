sudo yum update

sudo service httpd stop

sudo yum remove php*

sudo yum remove httpd*

sudo yum clean all

sudo yum upgrade -y

sudo yum install httpd24

sudo yum install mod24_ssl

service httpd start

sudo su
apt-get update
apt-get upgrade -y
apt-get dist-upgrade -y
apt-get autoremove -y
apt-get install apache2 php7.0 php7.0-cli php7.0-fpm php7.0-gd php-ssh2 libapache2-mod-php7.0 php7.0-mcrypt mysql-server php7.0-mysql git unzip zip postfix php7.0-curl mailutils php7.0-json phpmyadmin -y
php5enmod mcrypt

nano /etc/apache2/sites-enabled/000-default.conf
--ADD LINE-- 
Include /etc/phpmyadmin/apache.conf

service apache2 restart

nano /etc/phpmyadmin/config.inc.php
--ADD LINES BELOW THE PMA CONFIG AREA AND FILL IN DETAILS--
$i++;
$cfg['Servers'][$i]['host']          = '__FILL_IN_DETAILS__';
$cfg['Servers'][$i]['port']          = '3306';
$cfg['Servers'][$i]['socket']        = '';
$cfg['Servers'][$i]['connect_type']  = 'tcp';
$cfg['Servers'][$i]['extension']     = 'mysql';
$cfg['Servers'][$i]['compress']      = FALSE;
$cfg['Servers'][$i]['auth_type']     = 'config';
$cfg['Servers'][$i]['user']          = '__FILL_IN_DETAILS__';
$cfg['Servers'][$i]['password']      = '__FILL_IN_DETAILS__';







rm -rf var/di var/generation
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento cache:clean
php bin/magento cache:flush
php bin/magento indexer:reindex
php bin/magento setup:static-content:deploy en_US
chmod 777 -R var

















