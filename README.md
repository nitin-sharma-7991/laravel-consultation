# Laravel Consultation Management System

## Overview

This project is a comprehensive Consultation Management System built using Laravel. It provides functionalities for managing consultations, user authentication, profile management, and real-time notifications using Laravel Echo and WebSockets.

## Features

- **User Authentication**: Registration, login, and logout functionalities using Laravel's built-in authentication.
- **Consultation Management**: Create, retrieve, update, and delete consultations with Eloquent ORM.
- **User Profile Management**: Update and manage user profiles.
- **Real-time Notifications**: Receive real-time updates and reminders about consultations using Laravel Echo and WebSockets.
- **Search Functionality**: Search for consultations by date, professional name, or specialty.
- **Responsive UI**: User-friendly and responsive interface built with Laravel Blade templates and Bootstrap.

## Installation

### Prerequisites

- PHP >= 8.0
- Composer
- Node.js & npm
- MySQL or any other supported database
- Redis (for broadcasting with Laravel Echo)
- Pusher (for real-time notifications)

### Setup

1. **Clone the Repository**
   ```bash
   git clone https://github.com/your-username/consultation-management.git
   cd consultation-management

2. Install Dependencies


   composer install
   npm install
   npm run dev

3. Environment Configuration

   Copy the `.env.example` file to `.env`
   cp .env.example .env

   Update the .env file with your database, mail, and Pusher credentials.

4. Database Migration
   php artisan migrate --seed

5. Run the Application
   php artisan serve



   Usage
   -User Authentication: Access the login and registration pages via /login and /register.
   -Dashboard: Once logged in, users can manage their consultations and profile through the dashboard.
   -Real-time Notifications: Users will receive live updates about their consultations.


   Frontend
   The frontend is developed using Laravel Blade templates with Bootstrap for responsive design. All dynamic interactions are handled using jQuery and Laravel Echo for real-time features.

   API Endpoints
   The project includes RESTful API endpoints for managing consultations and user profiles. You can explore the API using tools like Postman.

   Authentication
   POST /api/login - User login
   POST /api/register - User registration
   POST /api/logout - User logout
   Consultations
   GET /api/consultations - List all consultations
   POST /api/consultations - Create a new consultation
   GET /api/consultations/{id} - Retrieve a specific consultation
   PUT /api/consultations/{id} - Update a consultation
   DELETE /api/consultations/{id} - Delete a consultation
   User Profile
   GET /api/profile - Retrieve user profile
   PUT /api/profile - Update user profile


   Contributing
   Contributions are welcome! Please fork the repository and create a pull request with your changes.

   License
   This project is licensed under the MIT License.

   Acknowledgments
   -Laravel Framework
   -Bootstrap for the UI
   -Pusher for real-time notifications



  
