# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|
  # The most common configuration options are documented and commented below.
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  # Every Vagrant development environment requires a box. You can search for
  # boxes at https://vagrantcloud.com/search.
  config.vm.box = "ubuntu/xenial64"

  # Disable automatic box update checking. If you disable this, then
  # boxes will only be checked for updates when the user runs
  # `vagrant box outdated`. This is not recommended.
  # config.vm.box_check_update = false

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine. In the example below,
  # accessing "localhost:8080" will access port 80 on the guest machine.
  # NOTE: This will enable public access to the opened port
  #config.vm.network "forwarded_port", guest: 80, host: 8080

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine and only allow access
  # via 127.0.0.1 to disable public access
  #config.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1" //OLD LINES
  #config.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"] //OLD LINES

  #Creates a web server on startup which is a particular type of VM that will be used to interconnect between our different VM's. 
  config.vm.define "webserver" do |webserver|
    #The following options are about the current webserver VM.
    webserver.vm.hostname = "webserver" #specifies the current webservers hostname.
    webserver.vm.network "forwarded_port",guest: 80,host: 8080,host_ip: "127.0.0.1"
    webserver.vm.network "private_network", ip: "192.168.2.11"
    webserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]

    webserver.vm.provision "shell", inline: <<-SHELL
     apt-get update
     apt-get install -y apache2 php libapache2-mod-php php-mysql
     cp /vagrant/job-form.conf /etc/apache2/sites-available/
     a2ensite job-form
     a2dissite 000-default
     service apache2 reload
    SHELL
  end

  config.vm.define "webserver2" do |webserver|
    #The following options are about the current webserver VM.
    webserver.vm.hostname = "webserver2" #specifies the current webservers hostname.
    webserver.vm.network "forwarded_port",guest: 80,host: 8081,host_ip: "127.0.0.1"
    webserver.vm.network "private_network", ip: "192.168.2.12"
    webserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]

    webserver.vm.provision "shell", inline: <<-SHELL
     apt-get update
     apt-get install -y apache2 php libapache2-mod-php php-mysql
     cp /vagrant/job-listings.conf /etc/apache2/sites-available/
     a2ensite job-listings
     a2dissite 000-default
     service apache2 reload
    SHELL
  end

  # Section for the database VM
  config.vm.define "dbserver" do |dbserver|
    #next is exclusive to the dbserver settings
    dbserver.vm.hostname = "dbserver"
    dbserver.vm.network "private_network", ip:"192.168.2.13"
    dbserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]
    dbserver.vm.provision "shell", inline: <<-SHELL
     apt-get update
     export MYSQL_PWD='joblisting20'
     echo "mysql-server mysql-server/root_password password $MYSQL_PWD" | debconf-set-selections
     echo "mysql-server mysql-server/root_password_again password $MYSQL_PWD" | debconf-set-selections
     apt-get -y install mysql-server
     echo "CREATE DATABASE joblistingdb;" | mysql
     echo "CREATE USER 'dbuser'@'%' IDENTIFIED BY 'joblisting20';" |mysql
     echo "GRANT ALL PRIVILEGES ON joblistingdb.* TO 'dbuser'@'%'" | mysql
     export MYSQL_PWD='joblisting20'
     cat /vagrant/setup-database.sql | mysql -u dbuser joblistingdb
     sed -i'' -e '/bind-address/s/127.0.0.1/0.0.0.0/' /etc/mysql/mysql.conf.d/mysqld.cnf
     service mysql restart
   SHELL
  end
end
