# Laravel 9 Application Setup Guide

This repository contains a Laravel 9 application with user registration, login, and a To-Do list functionality. Follow these instructions to set up and run the application on your local machine.

## Requirements

- PHP >= 8.0
- Composer
- MySQL or another database
- Node.js & npm (for frontend assets)
- Git

## Installation

1. **Clone the repository:**

    ```bash
    git clone https://github.com/your-username/your-repo-name.git
    cd your-repo-name
    ```

2. **Install PHP dependencies:**

    ```bash
    composer install
    ```

3. **Install Node.js dependencies:**

    ```bash
    npm install
    ```

4. **Copy the `.env.example` file to `.env` and configure the environment variables:**

    ```bash
    cp .env.example .env
    ```

    - Update the `.env` file with your database credentials and other necessary configurations.

5. **Generate the application key:**

    ```bash
    php artisan key:generate
    ```

6. **Run database migrations and seeders:**

    ```bash
    php artisan migrate --seed
    ```

    This will create the necessary tables and populate them with dummy data.

7. **Compile the frontend assets:**

    ```bash
    npm run dev
    ```

    For production, use:

    ```bash
    npm run build
    ```

8. **Start the development server:**

    ```bash
    php artisan serve
    ```

    The application will be available at `http://localhost:8000`.

## Usage

### User Registration and Login

- Visit `http://localhost:8000/register` to create a new user account.
- Visit `http://localhost:8000/login` to log in with your credentials.

### To-Do List Functionality

- After logging in, you can manage your to-do tasks:
  - Add new tasks.
  - Edit existing tasks.
  - Soft-delete tasks.
  - Restore soft-deleted tasks from the "Trashed Tasks" view.
  - Filter tasks by status (e.g., completed, pending).
  - Assign tasks to categories.
  - Set due dates for tasks.

## Factories and Seeders

### User and Category Factories

- **User Factory:** Generates fake user data.
- **Category Factory:** Generates fake category data.

### Seeders

- **UserSeeder:** Seeds the database with user data.
- **CategorySeeder:** Seeds the database with category data.
- **TaskSeeder:** Seeds the database with task data (assuming you have this seeder as well).

## Running Tests

To run the tests, use the following command:

```bash
php artisan test
