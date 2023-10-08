# laravel-multi-tenant

This template provides a boilerplate for developing multi-tenant Laravel applications. It includes support for both
multi-database and single-database tenancy, as well as a file system for storing tenant-specific data.

### Requirements

- **php** `^8.1` [Download](https://www.php.net/downloads.php#v8.1.24)
- **composer** `^2.6.5` [Download](https://getcomposer.org/download/)
- **nodejs** `^18.18.0` [Download](https://nodejs.org/en/download)

### Installation

```shell
# nodejs requirement
npm install

# Run system migrations
php artisan system:migrate
```

### Run Application

```shell
# Server side
npm run backend

# Front end
npm start

# Build app
npm run build
```

### Information

- you will find database plan in `public/database-plan.drawio`
- [permissions & roles documentation](https://spatie.be/docs/laravel-permission/v5/introduction)
- **Tenancy documentation** `app/Services/README.md`


