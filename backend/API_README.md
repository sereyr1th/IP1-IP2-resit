# Restaurant Menu API Backend

A Laravel-based REST API for managing restaurant menu items and categories.

## Features

- **Categories Management**: Create, read, update, and delete menu categories
- **Menu Items Management**: Full CRUD operations for menu items
- **SQLite Database**: Lightweight database perfect for development
- **RESTful API**: Clean, standardized API endpoints
- **Data Relationships**: Menu items belong to categories
- **Validation**: Request validation for all endpoints
- **Seeded Data**: Sample menu data for testing

## Database Schema

### Categories Table
- `id` - Primary key
- `name` - Category name (unique)
- `description` - Category description
- `icon` - Emoji or icon representation
- `is_active` - Boolean for active/inactive status
- `sort_order` - Integer for ordering categories
- `timestamps` - Created and updated timestamps

### Menu Items Table
- `id` - Primary key
- `name` - Item name
- `description` - Item description
- `price` - Decimal price (8,2 precision)
- `icon` - Emoji or icon representation
- `category_id` - Foreign key to categories table
- `is_available` - Boolean for availability status
- `sort_order` - Integer for ordering items
- `timestamps` - Created and updated timestamps

## API Endpoints

### Categories
```
GET    /api/v1/categories           # List all categories
POST   /api/v1/categories           # Create new category
GET    /api/v1/categories/{id}      # Get specific category
PUT    /api/v1/categories/{id}      # Update category
DELETE /api/v1/categories/{id}      # Delete category
```

### Menu Items
```
GET    /api/v1/menu-items           # List all menu items
POST   /api/v1/menu-items           # Create new menu item
GET    /api/v1/menu-items/{id}      # Get specific menu item
PUT    /api/v1/menu-items/{id}      # Update menu item
DELETE /api/v1/menu-items/{id}      # Delete menu item
```

### Special Endpoints
```
GET    /api/v1/menu                 # Get formatted menu for frontend
GET    /api/v1/categories/{id}/menu-items  # Get items by category
```

## Installation & Setup

1. **Install Dependencies**
   ```bash
   composer install
   ```

2. **Configure Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Setup Database**
   ```bash
   touch database/database.sqlite
   php artisan migrate
   php artisan db:seed
   ```

4. **Start Server**
   ```bash
   # Option 1: Use the convenience script
   ./start-server.sh
   
   # Option 2: Start manually
   php artisan serve --port=8000
   ```

## Sample Data

The database comes pre-seeded with sample categories and menu items for testing.

## Technology Stack

- **Laravel 11** - PHP framework
- **SQLite** - Database
- **Sanctum** - API authentication (ready for future use)
- **Eloquent ORM** - Database relationships and queries
