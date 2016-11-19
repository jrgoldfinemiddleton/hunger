[[ -z $1 ]] && { echo "!!! Hostname not set. Check the Vagrant file."; exit 1; }

# http://serverfault.com/a/670688
export DEBIAN_FRONTEND=noninteractive

debconf-set-selections <<< "mysql-server-5.5 mysql-server/root_password password 123"
debconf-set-selections <<< "mysql-server-5.5 mysql-server/root_password_again password 123"

echo "$2 $1" >> /etc/hosts

echo -e "\nRunning Update"
apt-get -y update > /dev/null 2>&1

echo -e "\nRunning Upgrade"
apt-get -y upgrade > /dev/null 2>&1

echo -e "\nInstalling Packages"
apt-get -y -q install python-software-properties build-essential apache2 mysql-server libapache2-mod-auth-mysql libapache2-mod-php5 php5 php5-mysql php5-mcrypt php5-memcached php5-curl php5-sqlite php5-gd memcached libmemcached-tools libmemcached-dev libcurl3 libcurl4-gnutls-dev curl vim wget git default-jre expect pkg-php-tools 
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
#gem install sass

echo -e "\nSecuring MySQL install."
/vagrant/config/secure_mysql

echo -e "\nConfiguring Packages"
mysql -uroot -p123 -e 'CREATE DATABASE IF NOT EXISTS `site`;CREATE USER `site`@`localhost` IDENTIFIED BY "123";GRANT ALL ON `site`.* TO `site`@`localhost`;CREATE USER `site`@"%" IDENTIFIED BY "123";GRANT ALL ON `site`.* TO `site`@"%";FLUSH PRIVILEGES;'

sed -i '/display_errors = Off/c display_errors = On' /etc/php5/apache2/php.ini
sed -i '/display_errors = Off/c display_errors = On' /etc/php5/cli/php.ini
sed -i '/short_open_tag = Off/c short_open_tag = On' /etc/php5/apache2/php.ini
sed -i '/short_open_tag = Off/c short_open_tag = On' /etc/php5/cli/php.ini
sed -i '/error_reporting = E_ALL & ~E_DEPRECATED/c error_reporting = E_ALL | E_STRICT' /etc/php5/apache2/php.ini
sed -i "s/bind-address.*/#bind-address = 127.0.0.1/" /etc/mysql/my.cnf
echo "<VirtualHost *:80>
    ServerName $1
    DocumentRoot $3
    <Directory $3>
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
    LogLevel debug
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf
echo "User vagrant" >> /etc/apache2/apache2.conf
echo "Group vagrant" >> /etc/apache2/apache2.conf
chown vagrant: /var/www

echo -e "\nEnabling Site"
a2enmod rewrite > /dev/null 2>&1
a2ensite 000-default.conf > /dev/null 2>&1
service apache2 reload > /dev/null 2>&1
service mysql restart > /dev/null 2>&1

echo -e "\nInstalling vimrc to home directory"
cp /vagrant/config/vimrc ~/.vimrc
mkdir -p ~/.vim/backups

echo -e "\nInstalling basic bashrc"
cp /vagrant/config/bashrc ~/.bashrc

echo -e "\nInitializing the locate DB"
sudo updatedb

echo -e '\n================================================================================='
echo -e '\nDear user, run "vagrant ssh" to login to Ubuntu on this VM.  Never'
echo 'start the VM from within VirtualBox.  Always use "vagrant up" to recreate'
echo 'the machine and "vagrant halt" to shut it down.'
echo -e '\nYou can also use "vagrant destroy" to completely remove it and then'
echo '"vagrant up" to recreate it again.'
echo -e '\nAfter logging in with "vagrant ssh", please cd to /var/www/site to find the'
echo 'Symfony project.  It is synced via a shared folder with your host OS repo'
echo 'that you cloned.  Run "composer install" from within /var/www/site.  This is'
echo 'a one-time step.'
echo -e '\nDone!'
echo -e '\n=================================================================================\n'
