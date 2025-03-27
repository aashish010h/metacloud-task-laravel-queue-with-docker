# Laravel Project With Docker

Please procced with the following step to setup this project

## Setup Instructions

Follow these steps to set up the project:

### 1. Clone the Repository

```
git clone <repository-url>
```
### 2. Configure Environment

Duplicate the `.env.example` file and rename it to `.env`. Then, generate an application key:

```
cd laravel-queue-with-docker
cp .env.example .env
```

### 3. Install Dependencies

```

docker-compose build
docker-compose up -d
```



### 4. Goto termial of the laravel-app container then

```
composer install
php artisan key:generate
php artisan migrate

```
### 5. To start the queue worker

```
php artisan queue:work

```

The endpoint to test the file upload is  `http://localhost:8012/api/upload-excel-file` Make sure the header of column is mobile_number for csv or excel.

## Additional Information

- Laravel documentation: [https://laravel.com/docs](https://laravel.com/docs)
- Laravel Forge: [https://forge.laravel.com](https://forge.laravel.com) (for deployment)
- Laravel GitHub Repository: [https://github.com/laravel/laravel](https://github.com/laravel/laravel)
