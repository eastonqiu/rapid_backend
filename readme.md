# Setup
- copy .env.example to .env, modify db settings.
- modify permission
```
sudo chmod -R www-data:www-data storage bootstrap/cache
```
- create database in your mysql.
```
php artisam migrate:refresh --seed
```
- enable rewrite module
```
sudo ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/

# virtual machine setting
<Directory app/public>
    Options Indexes FollowSymLinks
    Require all granted
    AllowOverride All
</Directory>
```

use llum https://github.com/acacha/llum to speed up laravel development
```
composer global require "acacha/llum=~0.1"
llum devtools
llum serve
```

- sidebar menu active
https://laracasts.com/discuss/channels/general-discussion/requestis-active-links-woes
'''
Request::is('user/*');
Request::is('user/*/edit');
Request::is('user/*/etc...');
<li class="treeview {{ (Request::is('*users*show*')) ? 'active':'' }}">
'''

- JWT
https://github.com/tymondesigns/jwt-auth/issues/513#issuecomment-186087297