# CrudKit

A tiny package that wraps up a generic CRUD controller and form so you can scaffold
simple resources in seconds.

```
composer require kaung/crudkit
php artisan vendor:publish --tag=crudkit-views
php artisan vendor:publish --tag=crudkit-config

# 1. Copy fonts, CSS, JS, favicon … to public/vendor/crudkit
php artisan vendor:publish --tag=crudkit-assets --force

# 2. (Optional) Overwrite your app layout with the package one
php artisan vendor:publish --tag=crudkit-app-layout --force