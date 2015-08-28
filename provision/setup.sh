#!/bin/bash
 
echo "Provisioning virtual machine..."

sudo adduser vagrant sudo
chmod -R 777 /var/*




echo "Adding & updating repositories..."
wget -q -O - http://pkg.jenkins-ci.org/debian/jenkins-ci.org.key | sudo apt-key add - > /dev/null 2> /dev/null
curl --silent --location https://deb.nodesource.com/setup_0.12 | sudo bash - > /dev/null 2> /dev/null
add-apt-repository ppa:cwchien/gradle -y > /dev/null 2> /dev/null
add-apt-repository ppa:ondrej/php5 -y > /dev/null 2> /dev/null
sh -c 'echo deb http://pkg.jenkins-ci.org/debian binary/ > /etc/apt/sources.list.d/jenkins.list' > /dev/null 2> /dev/null

apt-get update > /dev/null 2> /dev/null
apt-get upgrade - y > /dev/null 2> /dev/null

echo "Installing MySQL..."
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password '
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password '
sudo apt-get install mysql-server -y > /dev/null 2> /dev/null
#apt-get install mysql-client -y  
#apt-get install php5-mysql -y 
#service mysql stop
#rm /var/lib/mysql/ib_logfile0
#rm /var/lib/mysql/ib_logfile1
#service mysql restart
sudo mysql -u root -e "create database karteikarten"
sudo mysql -u root -e "GRANT ALL PRIVILEGES ON karteikarten.* TO jenkins@localhost IDENTIFIED BY ''"


echo "Installing JDK..."
apt-get install default-jdk -y > /dev/null 2> /dev/null

echo "Installing Node.js..."
apt-get install nodejs -y > /dev/null 2> /dev/null

echo "Installing Cordova..."
npm install -g cordova -y > /dev/null 2> /dev/null

echo "Installing Ant..."
apt-get install ant -y > /dev/null 2> /dev/null

echo "Installing Gradle..."
apt-get install gradle -y > /dev/null 2> /dev/null

echo "Installing Git..."
apt-get install git -y > /dev/null 2> /dev/null

echo "Installing Jenkins..."
apt-get install jenkins -y > /dev/null 2> /dev/null
sudo chmod -R 755 /var/lib/jenkins/
sudo cp -r /var/www/src/jobs/ /var/lib/jenkins/

echo "Installing Nginx..."
apt-get install nginx -y > /dev/null 2> /dev/null

echo "clearing tmp..."
cd /tmp
rm -r *

echo "Installing Android SDK..."
wget http://dl.google.com/android/android-sdk_r24.3.3-linux.tgz > /dev/null 2> /dev/null
tar -xzvf android-sdk_r22.0.5-linux.tgz > /dev/null 2> /dev/null
tools/android update sdk --no-ui -y > /dev/null 2> /dev/null
mv android-sdk-linux/ /opt/ > /dev/null 2> /dev/null
apt-get install lib32stdc++6 lib32z1 > /dev/null 2> /dev/null



echo "Installing PHP..."
apt-get install python-software-properties build-essential -y > /dev/null 2> /dev/null
apt-get install php5-common php5-dev php5-cli php5-fpm -y > /dev/null 2> /dev/null
 
echo "Installing PHP extensions..."
apt-get install curl php5-curl php5-gd php5-mcrypt php5-mysql -y > /dev/null 2> /dev/null
apt-get install debconf-utils -y > /dev/null 2> /dev/null
debconf-set-selections <<< "mysql-server mysql-server/root_password password vagrant"
debconf-set-selections <<< "mysql-server mysql-server/root_password_again password vagrant"
apt-get install mysql-server -y > /dev/null 2> /dev/null

echo "Configuring Nginx..."
cp /var/www/provision/config/nginx_vhost /etc/nginx/sites-available/nginx_vhost > /dev/null 2> /dev/null
ln -s /etc/nginx/sites-available/nginx_vhost /etc/nginx/sites-enabled/ > /dev/null 2> /dev/null
rm -rf /etc/nginx/sites-available/default > /dev/null 2> /dev/null
service nginx restart > /dev/null 2> /dev/null

echo "Configuring Jenkins..."
cp jars/ /var/lib/jenkins/ > /dev/null 2> /dev/null

echo "Restarting Server..."
reboot