## Installation

Clone the repo locally:

```sh
git clone https://github.com/Manuel-kl/contacts-ms.git
cd contacts-ms
```

Install PHP dependencies:

```sh
composer install
```

Install NPM dependencies:

```sh
npm install
```

Build assets:

```sh
npm run dev
```

Setup configuration:

```sh
cp .env.example .env
```

Open the `.env` file and setup your database username and password

```
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

Generate application key:

```sh
php artisan key:generate
```

Run database migrations:

```sh
php artisan migrate
```

Run database seeder (To seed contacts categories):

```sh
php artisan db:seed
```

Run the development server:

```sh
php artisan serve
```
