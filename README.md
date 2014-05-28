## Simple and dummy 


## httpd-vhosts.conf 

		<VirtualHost *:80>
    		ServerName booksZend1.localhost
    		DocumentRoot /path/to/project/public
    		<Directory "/path/to/project/public">
       			Options Indexes FollowSymLinks MultiViews
       			AllowOverride All
       			Order allow,deny
       			allow from all
    		</Directory>
		</VirtualHost>


## /etc/hosts

127.0.0.1 booksZend1.localhost
