cd /var/www/site/ && php bin/console assets:install --relative && cd ~

sudo sed -i 's/<\/Directory>/DirectoryIndex app_dev.php\nRewriteEngine On\nRewriteCond %{REQUEST_FILENAME} !-f\nRewriteRule ^(.*)$ app_dev.php [QSA,L]\n<\/Directory>/' /etc/apache2/sites-available/000-default.conf
sudo service apache2 reload