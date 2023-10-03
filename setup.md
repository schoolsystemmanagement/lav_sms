# Laravel Project Setup Guide

This guide provides step-by-step instructions to set up a Laravel project on your local environment using XAMPP. If you encounter any issues, please refer to the version details provided below for context and troubleshooting.

## Version Details
> from xammp installation
- **PHP Version:** PHP 8.2.4 (cli) (built: Mar 14 2023)
- **XAMPP Control Panel Version:** XAMPP for Windows 8.2.4
- **MySQL Version:** MariaDB 10.4.28, for Win64 (AMD64)
> from composer intallation
- **Composer Version:** Composer version 2.6.2 (2023-09-03)
> from node intallation
- **Node Version:** Node version v20.5.1 (2023-09-03)

## Installation Steps

1. **Install XAMPP**
   - download from the website: https://www.apachefriends.org/download.html
   - put the folder `C:\xampp\php` (or equivalent) in the variables environment

2. **Install Composer (PHP Dependency Manager):**
    ```bash
    # Download the Composer installer for Windows: link found at https://getcomposer.org/doc/00-intro.md
    curl -O https://getcomposer.org/Composer-Setup.exe

    # Run the Composer installer (this will open a GUI installer)
    start Composer-Setup.exe
    ```

3. **Install Node.js and npm (Node Package Manager):**
    - Download the Node.js (`node 20` preferably) installer for Windows from the official website: https://nodejs.org/
    - Run the Node.js installer (this will also install npm).

4. **Run XAMPP:**
   - Start the XAMPP GUI application.
   - Launch the Apache web server and MySQL database server.
   - Create a new database named `lavsms` using phpMyAdmin or another MySQL client.

5. **Database Configuration:**
   - Create an environment (`.env`) file by making a copy of the example file:
     ```bash
     cp .env.example .env
     ```
   - Modify the database connection settings in the `.env` file to match your XAMPP setup:
     ```dotenv
     DB_DATABASE=lavsms
     DB_USERNAME=root
     DB_PASSWORD=
     ```

6. **Install Project Dependencies:**
   ```bash
   # Navigate to the project directory
   cd path/to/project

   # Update Composer dependencies (if needed)
   composer update

   # Install Composer dependencies
   composer install

   # Install Node.js dependencies
   npm install
   ```

7. **Build:**
   ```bash
   # Generate an application key
   php artisan key:generate

   # Clear the configuration cache
   php artisan config:clear
   ```

8. **Build Db:**
   ```bash
   # Run database migrations to create database tables
   php artisan migrate

   # Seed the database with initial data (if needed)
   php artisan db:seed   
   ```

9. **Run Development:**
   ```bash
   # Start the Laravel development server
   php artisan serve
   ```

10. **laravel pattern: MVC like django**
   - routes/web.php (php) --> routes 
      - call controllers (php)
      - call resources\views\partials\js\custom_js.blade.php (js) on form submission: he writes on the console
   - app/http/requests (php) --> serializers (used in controllers for data validation)
   - app/http/controllers (php) --> controllers (use serializers automatiq for data validation; use models for crud; return parse(a_view, data_for_client) like in django)
   - app/models (php) --> models (used in controllers for crud)
   - ressources/views (blade: php-client like) --> views (like in django)

