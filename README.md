# E-commerce Web
An e-commerce website that consist of two parts, admin and user page. Providing simple admin utilization and shopping experience as the implementation of basic fullstack development

## How to Run
If you just cloned the project, open terminal and execute:
```Bash
cp .env.example .env
composer install
npm install
php artisan key:generate
php artisan migrate:fresh --seed
```