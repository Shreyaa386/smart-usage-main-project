# Water and Electricity Tracker

A Laravel-based web application for monitoring and tracking water and electricity consumption. Built with modern UI using Tailwind CSS and Chart.js for data visualization.

## Features

- **Dashboard**: Real-time overview of water and electricity usage with interactive charts
- **Usage Logging**: Add new consumption records for different devices and locations
- **History**: View detailed usage history with filtering by time period
- **Analytics**: Analyze consumption patterns across devices with insights
- **Alerts**: Get notified when consumption exceeds threshold levels
- **User Management**: Admin can view all users and their consumption data
- **Dark Mode**: Toggle between light and dark themes
- **Responsive Design**: Works seamlessly on desktop and mobile devices

## Tech Stack

- **Backend**: Laravel 10.x
- **Frontend**: Blade Templates
- **Styling**: Tailwind CSS
- **Charts**: Chart.js
- **Icons**: Font Awesome
- **Database**: MySQL

## Installation

1. Clone the repository
2. Install dependencies:
   ```bash
   composer install
   npm install
   ```

3. Copy environment file:
   ```bash
   cp .env.example .env
   ```

4. Generate application key:
   ```bash
   php artisan key:generate
   ```

5. Configure database in `.env` file

6. Run migrations:
   ```bash
   php artisan migrate
   ```

7. Start development server:
   ```bash
   php artisan serve
   ```

8. Visit `http://localhost:8000`

## Default Credentials

- **Admin**: admin@gmail.com / admin123
- **Regular User**: Register through signup page

## Project Structure

```
├── app/
│   ├── Http/
│   │   └── Controllers/
│   └── Models/
├── resources/
│   └── views/
│       ├── auth/
│       ├── layout.blade.php
│       ├── dashboard.blade.php
│       ├── add-usage.blade.php
│       ├── usage-history.blade.php
│       ├── analytics.blade.php
│       └── alerts.blade.php
├── public/
│   └── images/
└── routes/
```

## Usage

1. Login with your credentials
2. Navigate to Dashboard to view overall consumption
3. Use "Add Usage" to log new readings
4. Check "History" for detailed records
5. View "Analytics" for device-wise consumption patterns
6. Monitor "Alerts" for high usage warnings

## License

This project is open-sourced software licensed under the MIT license.
