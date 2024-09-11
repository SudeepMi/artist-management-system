# Artist Management System

## Overview

This Laravel project is a web application designed for managing users, artists, and songs. It features role-based access control (UAC roles), CRUD operations, and detailed functionality for managing data. The application is built with Laravel and utilizes Tailwind CSS for a modern design.

## Features

- **User Management**: Admins can perform CRUD operations on user records.
- **Artist Management**: Admins and artist managers can manage artist profiles, including CRUD operations and CSV import/export.
- **Song Management**: Artists can manage their own songs, including CRUD operations.
- **Role-Based Access Control**: Different roles (super_admin, artist_manager, artist) have specific permissions.
- **Statistics**: Generate statistics for total users, artist managers, artists, songs, and more.
- **Responsive Design**: Built with Tailwind CSS for a modern and responsive user interface.

## UAC Roles

1. **Super Admin**
   - Access to all user, artist, and song management functionalities.
   - Can perform CRUD operations on all records.
   - Can view and manage all statistics.

2. **Artist Manager**
   - Can manage artist profiles and songs.
   - Can perform CRUD operations on artists and their songs.
   - Can import/export artist data via CSV.

3. **Artist**
   - Can manage their own song records.
   - Can perform CRUD operations on their own songs.

## Installation

### Prerequisites

- PHP >= 7.4
- Composer
- Laravel 9.x or higher
- MySQL or SQLite (for testing)

### Setup

1. **Clone the Repository**

   ```bash
   git clone https://github.com/SudeepMi/artist-management-system.git
   cd artist-management-system
   ```

2. **Install Dependencies**

   ```bash
   composer install
   ```

3. **Configure Environment**

   Copy the `.env.example` file to `.env` and set up your environment variables:

   ```bash
   cp .env.example .env
   ```

   Update your `.env` file with the appropriate database and other configuration settings.

4. **Generate Application Key**

   ```bash
   php artisan key:generate
   ```

5. **Run Migrations**

   ```bash
   php artisan migrate
   ```

6. **Install Passport**

   ```bash
   php artisan passport:install
   ```

7. **Serve the Application**

   ```bash
   php artisan serve
   ```

   Visit `http://localhost:8000` in your web browser.

## Core Functionality

### 1. Initial Landing Page

- **Login Screen**: Admin users land on a login screen with an option for new registration.
- **Registration**: New admin users are redirected to the login page upon successful registration.
- **Redirection**: Logged-in admin users are redirected to the dashboard page.

### 2. Dashboard Page

- **CRUD Operations**: Admin can perform CRUD operations for users, artists, and songs.
- **Logout**: A logout button is present.

#### Tabs

1. **User**
   - **List Users**: List user records with pagination (Role: super_admin).
   - **Create User**: Create a new user record (Role: super_admin).
   - **Update/Delete User**: Update or delete existing user records (Role: super_admin).

2. **Artist**
   - **List Artists**: List artist records with pagination (Roles: super_admin, artist_manager).
   - **Create Artist**: Create a new artist record (Role: artist_manager).
   - **Update/Delete Artist**: Update or delete existing artist records (Role: artist_manager).
   - **CSV Import/Export**: Import and export artist data via CSV (Role: artist_manager).
   - **Songs List**: Redirect to a screen with a list of songs for a particular artist (Roles: super_admin, artist_manager).

   - **Songs for Artist**
     - **List Songs**: List songs for the artist (Roles: super_admin, artist_manager, artist).
     - **Create Song**: Create a new song record for the artist (Role: artist).
     - **Update/Delete Song**: Update or delete existing song records for the artist (Role: artist).


## Code Structure

- **Routes**: Defined in `routes/web.php`.
- **Controllers**: Located in the `app/Http/Controllers` directory.
- **Models**: Located in the `app/Models` directory.
- **Views**: Located in the `resources/views` directory.
- **Migrations**: Located in the `database/migrations` directory.
- **Seeders**: Located in the `database/seeders` directory.

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request with your changes. For major changes, please open an issue first to discuss what you would like to change.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

- Laravel for the robust framework.
- Tailwind CSS for a modern and responsive design.
- PHP and Composer for dependency management.
---