# Nike Clone - PHP 8 + MySQL MVC Project

A comprehensive Nike-style e-commerce catalog featuring SNKRS-lite functionality (launch schedule + raffle/notify system). Built with PHP 8, MySQL, Bootstrap 5, and jQuery.

## Features

- **MVC Architecture**: Clean separation of concerns with PHP 8
- **Product Catalog**: Browse shoes by categories with grid layout and pagination
- **Advanced Search**: AJAX-powered product search with real-time suggestions
- **Product Details**: Detailed product pages with image galleries and size selection
- **Store Locator**: Google Maps integration for finding nearby stores and checking inventory
- **SNKRS Launches**: Launch calendar with countdown timers and notification system
- **Authentication**: User registration and login system
- **Responsive Design**: Bootstrap 5 with mobile-first approach
- **SEO Friendly**: Proper meta tags, breadcrumbs, and URL structure

## Tech Stack

- **Backend**: PHP 8 with MVC pattern
- **Database**: MySQL with comprehensive schema
- **Frontend**: Bootstrap 5 + jQuery (CDN)
- **Maps**: Google Maps API for store locator
- **Styling**: Custom CSS with Nike-inspired design

## Installation

### Prerequisites

- PHP 8.0 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx) or PHP built-in server
- Composer (optional, for future enhancements)

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/cornel05/Nike-Clone.git
   cd Nike-Clone
   ```

2. **Configure environment**
   ```bash
   cp .env.example .env
   ```
   Edit `.env` file with your database credentials:
   ```
   DB_HOST=localhost
   DB_PORT=3306
   DB_NAME=nike_clone
   DB_USER=your_username
   DB_PASSWORD=your_password
   ```

3. **Create database and import schema**
   ```bash
   mysql -u your_username -p -e "CREATE DATABASE nike_clone CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
   mysql -u your_username -p nike_clone < db/schema.sql
   mysql -u your_username -p nike_clone < db/seed.sql
   ```

4. **Configure Google Maps (Optional)**
   - Get a Google Maps API key from [Google Cloud Console](https://console.cloud.google.com/)
   - Update `GOOGLE_MAPS_API_KEY` in your `.env` file
   - Enable Maps JavaScript API and Geocoding API

5. **Set up web server**

   **Option A: PHP Built-in Server (Development)**
   ```bash
   cd public
   php -S localhost:8000
   ```

   **Option B: Apache/Nginx**
   - Point document root to `/public` directory
   - Ensure `.htaccess` is enabled (Apache) or configure URL rewriting (Nginx)

6. **Access the application**
   - Open http://localhost:8000 (or your configured domain)
   - Demo login credentials:
     - Email: `john@example.com`
     - Password: `password`

## Project Structure

```
├── app/
│   ├── controllers/          # MVC Controllers
│   │   ├── BaseController.php
│   │   ├── HomeController.php
│   │   ├── ProductsController.php
│   │   ├── ProductController.php
│   │   ├── LaunchesController.php
│   │   ├── AuthController.php
│   │   ├── StoresController.php
│   │   └── ApiController.php
│   ├── models/              # Database models (future enhancement)
│   └── views/               # View templates
│       ├── layouts/         # Main layout templates
│       ├── partials/        # Reusable components
│       ├── home/           # Homepage views
│       ├── products/       # Product listing and search
│       ├── product/        # Product detail pages
│       ├── launches/       # SNKRS launch pages
│       ├── auth/           # Authentication pages
│       └── stores/         # Store locator pages
├── assets/
│   ├── css/                # Custom stylesheets
│   ├── js/                 # Custom JavaScript
│   └── images/             # Product and category images
├── config/
│   ├── config.php          # Application configuration
│   ├── Database.php        # Database connection
│   └── Router.php          # URL routing
├── db/
│   ├── schema.sql          # Database schema
│   └── seed.sql            # Sample data
├── public/
│   └── index.php           # Application entry point
├── .env                    # Environment configuration
└── README.md
```

## Database Schema

The database includes the following main tables:

- **categories**: Product categories (Men's, Women's, Kids, etc.)
- **products**: Product catalog with details and pricing
- **product_images**: Multiple images per product
- **sizes**: Available shoe sizes
- **product_sizes**: Inventory tracking per size
- **users**: User accounts and authentication
- **stores**: Physical store locations
- **store_availability**: Product inventory per store
- **launches**: SNKRS launch events
- **launch_notifications**: User notification preferences
- **launch_entries**: Draw/raffle entries

## API Endpoints

- `GET /api/products/search` - AJAX product search
- `GET /api/stores/nearby` - Find nearby stores
- `POST /api/launch/notify` - Launch notification signup

## Key Features Explained

### SNKRS Launches
- **FCFS**: First Come, First Served launches
- **Draw**: Raffle-style entry system
- **LEO**: Let Everyone Order during launch window
- Real-time countdown timers
- Email notification system

### Store Locator
- Google Maps integration
- Location-based store search
- Real-time inventory checking
- Store details and contact information

### Search & Browse
- Category-based filtering
- AJAX live search with suggestions
- Sorting options (name, price, date)
- Pagination for large result sets

## Development Notes

- **Security**: Prepared statements prevent SQL injection
- **Sessions**: Secure session management for authentication
- **Responsive**: Mobile-first design with Bootstrap 5
- **SEO**: Proper meta tags, breadcrumbs, and semantic HTML
- **Performance**: Optimized database queries and image loading

## Future Enhancements

- Shopping cart and checkout system
- User profiles and order history
- Admin panel for content management
- Product reviews and ratings
- Email notifications for launches
- Inventory management system
- Advanced filtering (price range, brand, etc.)
- Wishlist functionality

## Contributing

This is an educational project demonstrating PHP MVC architecture and e-commerce concepts. Contributions are welcome for:

- Bug fixes
- Feature enhancements
- Documentation improvements
- Code optimization

## License

This project is for educational purposes only. Nike and related trademarks are property of Nike, Inc. This project is not affiliated with or endorsed by Nike, Inc.

## Disclaimer

This is a demonstration project created for educational purposes. It is not intended for commercial use and is not affiliated with Nike, Inc. All Nike trademarks and imagery are property of their respective owners.
