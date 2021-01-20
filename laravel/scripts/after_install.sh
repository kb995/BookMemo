#!/bin/bash

set -eux

cd ~/BookQuote/laravel
php artisan migrate --force
php artisan config:cache
