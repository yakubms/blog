#!/bin/sh

# If you would like to do some extra provisioning you may
# add any commands you wish to this file and they will
# be run after the Homestead machine is provisioned.
#
# If you have user-specific configurations you would like
# to apply, you may also create user-customizations.sh,
# which will be run after this script.

# mysql
# set timezone to JTC
sudo mysql_tzinfo_to_sql /usr/share/zoneinfo | mysql -u root mysql
sudo sh -c "echo \"default-time-zone = 'Asia/Tokyo'\" >> /etc/mysql/mysql.conf.d/mysqld.cnf"
sudo service mysql restart
