# Mylibrary

Mylibrary is a web application built using Laravel that allows users to manage a collection of books.

## Features

### **Authentication**

-   Login/signup form.
-   Uses local authentication (username/password).

### **List of Books**

-   Page with list of all books available.
-   The user can add or remove the book.
-   The user can checked the book out.
-   Page showed the description of the book.

## Installation

1. Clone the repository from GitHub
2. Install dependencies using Composer:

```sh
composer install
```

3. Create a new MySQL database and update the `.env` file with your database credentials
4. Migrate the database tables:

```sh
php artisan migrate
```

5. Start the local development server:

```sh
php artisan serve
```
