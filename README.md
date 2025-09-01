# Restaurant Menu Application

This is a full-stack restaurant menu application built with Vue.js frontend and Laravel backend.

## Project Structure

- **Frontend**: Vue.js application located in the root directory and `src/` folder
- **Backend**: Laravel API application located in the `backend/` folder

## Features

- Browse restaurant menu by categories
- Search and filter menu items
- Shopping cart functionality
- Responsive design

## Frontend Technologies

- Vue.js 3
- Vite (build tool)
- CSS3

## Backend Technologies

- Laravel 11
- PHP
- SQLite database
- RESTful API

## Setup Instructions

### Backend Setup

1. Navigate to the backend directory:
   ```bash
   cd backend
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Copy environment file:
   ```bash
   cp .env.example .env
   ```

4. Generate application key:
   ```bash
   php artisan key:generate
   ```

5. Run database migrations:
   ```bash
   php artisan migrate
   ```

6. Seed the database:
   ```bash
   php artisan db:seed
   ```

7. Start the Laravel development server:
   ```bash
   php artisan serve
   ```

### Frontend Setup

1. In the root directory, install Node.js dependencies:
   ```bash
   npm install
   ```

2. Start the development server:
   ```bash
   npm run dev
   ```

## API Endpoints

- `GET /api/v1/categories` - Get all categories
- `GET /api/v1/menu-items` - Get all menu items
- `GET /api/v1/menu-items/by-category/{categoryId}` - Get menu items by category

## Development

The application uses:
- Vite for hot module replacement during development
- Laravel API for backend data management
- Vue.js components for modular frontend development

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Submit a pull request

## License

This project is open source and available under the MIT License.
