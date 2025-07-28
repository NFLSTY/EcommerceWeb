# E-commerce Web
An e-commerce website that consist of two parts, admin and user page. Providing simple admin utilization and shopping experience as the implementation of basic fullstack development

## How to Configure
If you just cloned the project, open terminal and execute:
```Bash
cp .env.example .env
composer install
npm install
php artisan key:generate
php artisan migrate:fresh --seed
```

## How to Run
```Bash
composer run dev
```

## Important Notes
If there's a problem:
```Bash
# If image not showing
php artisan storage:link
# Uncommon bug/too many caches
php artisan cache:clear && php artisan config:clear && php artisan route:clear && php artisan view:clear
# For anyone who wants to try the admin side
npm install sweetalert2
```