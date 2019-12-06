
# Mise à jour de la bibliothèque des logiciels
sudo apt-get update
sudo apt-get -y upgrade

# Variables de l'installation
PASSWORD='123'
PHPVERSION='7.2'

# Apache et PHP
sudo apt-get install -y apache2
sudo apt-get install -y php
sudo apt-get install -y libapache2-mod-php

# Mysql
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password $PASSWORD"
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $PASSWORD"
sudo apt-get install -y mysql-server php-mysql

# Hôte virtuel
VHOST=$(cat <<EOF
<VirtualHost *:80>
  DocumentRoot "/vagrant_data/public"
  <Directory "/vagrant_data/public">
    Options All
    AllowOverride All
    Require all granted
  </Directory>
</VirtualHost>
EOF
)

echo "${VHOST}" > /etc/apache2/sites-available/000-default.conf

# Redémarrage d'Apache
service apache2 restart
