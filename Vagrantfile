# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

    config.vm.box = "scotch/box"
    config.vm.network "private_network", ip: "192.168.33.10"
    config.vm.hostname = "scotchbox"
    config.vm.synced_folder ".", "/var/www", :mount_options => ["dmode=770", "fmode=660"]

    config.vm.provision "shell", inline: <<-SHELL
      # Set missing language envs
      echo "export LC_CTYPE=en_US.UTF-8" >> ~/.profile
      echo "export LC_ALL=en_US.UTF-8" >> ~/.profile

      # Go by default to /var/www where the OwnCloud resides
      echo "cd /var/www" >> ~/.profile

      su --login -c "mysql scotchbox < /var/www/src/create_tables.sql" vagrant
    SHELL
end
