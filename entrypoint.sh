#!/bin/bash

composer install
php artisan key:generate --force
php artisan migrate --force
