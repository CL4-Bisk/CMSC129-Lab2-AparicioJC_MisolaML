# CMSC 129 Lab 2 — Laravel MVC CRUD Application

## Description

This Laravel application manages borrowed books. It allows users to create, view, update, and soft-delete borrowed books. The app also includes search and filter functionality, a trash page for soft-deleted items, and a global modal for user notification messages.

## Tech Stack

- Laravel
- PHP
- PostgreSQL
- Blade templates
- Tailwind CSS
- Vite

## Features

- Full **CRUD** for borrowed books
- **Search** across title and description
- **Filter** by genre
- **Soft delete** with a trash page and restore functionality
- **Permanent delete** from trash
- **Form validation** for create/update actions
- **Global modal notifications** for success, error, warning, and info messages
- Responsive Blade view layout with reusable components

## Borrowed Book Fields

- Title
- Genre
- Description
- Borrower name
- Borrowed date
- Due date

## MVC Architecture

- **Models**: `app/Models/BorrowedBooks.php`
    - Uses `SoftDeletes`
    - Casts `borrowed_at` and `due_at` to datetime
- **Controllers**: `app/Http/Controllers/BorrowedBooksController.php`
    - Handles all resource actions
    - Implements search, filter, pagination, soft delete, restore, and force delete
- **Views**: `resources/views/`
    - `layouts/app.blade.php` for the shared layout
    - `borrowed-books/*.blade.php` for listing, create, edit, show, and trash pages
    - `components/message-modal.blade.php` for global modal alerts
- **Routes**: `routes/web.php`
    - `Route::resource('borrowed-books', BorrowedBooksController::class)`
    - Custom trash, restore, and force-delete routes

## Requirements Covered

- ✅ Laravel MVC structure
- ✅ PostgreSQL database with migrations
- ✅ CRUD operations
- ✅ Search and filter functionality with pagination
- ✅ Soft delete + trash view + restore
- ✅ Blade views with reusable layout/component
- ✅ Flash notifications displayed as modals
- ✅ Hidden environment variables stored in `.env`

## Installation

1. Clone the repository
2. Install PHP dependencies:
    ```bash
    composer install
    ```
3. Install Node dependencies:
    ```bash
    npm install
    ```
4. Copy `.env.example` to `.env` and configure PostgreSQL settings
5. Generate app key:
    ```bash
    php artisan key:generate
    ```
6. Run migrations:
    ```bash
    php artisan migrate
    ```
7. Build frontend assets:
    ```bash
    npm run build
    ```
8. Start the server:
    ```bash
    php artisan serve
    ```

## Usage

- Visit `http://localhost:8000`
- Use the navigation to add new borrowed book records
- Apply search and genre filter on the index page
- Move books to trash and restore or permanently delete them
- Notifications appear in a modal after actions

## Notes

- The `.env` file should not be committed to GitHub.
- The project uses PostgreSQL, so ensure the `pdo_pgsql` extension is enabled.

## Future Improvements

- Add user authentication
- Add categories or tags as related models
- Add database seeders for test data
- Add file upload support for book covers or receipts
