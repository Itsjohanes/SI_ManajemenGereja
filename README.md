# Laravel Project Installation Guide

## Prerequisites

Ensure you have the following installed on your system:
- **PHP** (>= 8.0 recommended)
- **Composer** (Dependency Manager for PHP)
- **MySQL / MariaDB** (Database Management System)
- **Node.js & NPM** (For front-end assets, optional)
- **Git** (Version Control, optional but recommended)

## Installation Steps

### 1. Clone the Repository
```sh
git clone https://github.com/your-repo-name.git
cd your-repo-name
```

### 2. Install Dependencies
```sh
composer install
```

### 3. Copy Environment File
```sh
cp .env.example .env
```

### 4. Generate Application Key
```sh
php artisan key:generate
```

### 5. Configure Database
Edit `.env` file and update the following details:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 6. Run Database Migrations
```sh
php artisan migrate
```

### 7. Seed the Database (Optional)
If your project has seeders, you can populate the database with sample data:
```sh
php artisan db:seed
```

### 8. Serve the Application
Run the development server:
```sh
php artisan serve
```
Your application will be accessible at [http://127.0.0.1:8000](http://127.0.0.1:8000).

### 9. Set File Permissions (Linux / Mac Only)
```sh
chmod -R 775 storage bootstrap/cache
```

## Additional Steps

### Install NPM Dependencies (If Required)
If your project uses front-end assets:
```sh
npm install
npm run dev
```

### Clear Cache & Config (If Facing Issues)
```sh
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

## API Documentation (If Applicable)
If your project has an API, check the API documentation at:
```
http://127.0.0.1:8000/api/docs
```

## Deployment Notes
For deploying to a live server:
1. Set up a web server (Apache/Nginx)
2. Use `.env` for production database credentials
3. Run `php artisan config:cache`
4. Run `php artisan migrate --force`
5. Set permissions for `storage/` and `bootstrap/cache/`
6. Use a queue worker if background jobs are needed: `php artisan queue:work`

## Contributing
Feel free to contribute! Fork the repository, create a new branch, and submit a pull request.

## License
This project is open-source and available under the [MIT License](LICENSE).

