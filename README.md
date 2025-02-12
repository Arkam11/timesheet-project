# Timesheet Project

This is a backend application built with **Laravel 9.x** and **Laravel Passport** for authentication. It allows users to manage projects, timesheets, and dynamic attributes using an Entity-Attribute-Value (EAV) system.

---

## Table of Contents
1. [Setup Instructions](#setup-instructions)
2. [API Documentation](#api-documentation)
3. [Example Requests/Responses](#example-requestsresponses)
4. [Test Credentials](#test-credentials)
5. [Database Schema](#database-schema)
6. [Technologies Used](#technologies-used)
7. [License](#license)

---

## Setup Instructions

### Prerequisites
- PHP 8.2.x
- Composer
- MySQL
- Laravel 9.x
- Laravel Passport 10.x

### Steps to Set Up
1. Clone the repository:
   ```bash
   git clone https://github.com/Arkam11/timesheet-project.git

   
2. Navigate to the project folder:
    cd timesheet-project

3. Install dependencies:
    composer install

4. Create the .env file and configure  database:
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=timesheet_project
    DB_USERNAME=root
    DB_PASSWORD=
5. Run migrations and seeders:
    php artisan migrate --seed

6. Install Laravel Passport:
    php artisan passport:install

7. Start the development server:
    php artisan serve

8. Access the API at http://127.0.0.1:8000.

### API Documentation
1. Authentication
    Register: POST /api/register
    Login: POST /api/login
    Logout: POST /api/logout

2. Users
    List Users: GET /api/users
    Create User: POST /api/users
    Get User: GET /api/users/{id}
    Update User: PUT /api/users/{id}
    Delete User: DELETE /api/users/{id}

3. Projects
    List Projects: GET /api/projects
    Create Project: POST /api/projects
    Get Project: GET /api/projects/{id}
    Update Project: PUT /api/projects/{id}
    Delete Project: DELETE /api/projects/{id}

4. Timesheets
    List Timesheets: GET /api/timesheets
    Create Timesheet: POST /api/timesheets
    Get Timesheet: GET /api/timesheets/{id}
    Update Timesheet: PUT /api/timesheets/{id}
    Delete Timesheet: DELETE /api/timesheets/{id}

5. Attributes
    List Attributes: GET /api/attributes
    Create Attribute: POST /api/attributes
    Get Attribute: GET /api/attributes/{id}
    Update Attribute: PUT /api/attributes/{id}
    Delete Attribute: DELETE /api/attributes/{id}

6. Filtering
    Filter Projects:
        By regular fields: GET /api/projects?filters[name]=ProjectA
        By dynamic attributes: GET /api/projects?attribute_filters[department]=IT
        Combined filters: GET /api/projects?filters[status]=Active&attribute_filters[department]=IT
        Operators: =, >, <, LIKE (e.g., filters[start_date>]=2024-01-01)


### Example Requests/Responses
1. Register a User
    Request:
        {
            "first_name": "John",
            "last_name": "Doe",
            "email": "john@example.com",
            "password": "password",
            "password_confirmation": "password"
        }

Response:
        {
            "user": {
                "id": 1,
                "first_name": "John",
                "last_name": "Doe",
                "email": "john@example.com",
                "created_at": "2025-02-12T08:06:39.000000Z",
                "updated_at": "2025-02-12T08:06:39.000000Z"
            },
            "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9..."
        }

2. Filter Projects
    Request: GET /api/projects?filters[name]=ProjectA
    Response:
        [
            {
                "id": 1,
                "name": "ProjectA",
                "status": "active",
                "created_at": "2025-02-12T08:06:39.000000Z",
                "updated_at": "2025-02-12T08:06:39.000000Z"
            }
        ]

### Test Credentials        
Email: john@example.com
Password: password

### Database Schema
The database schema includes the following tables:

    users: Stores user information.
    projects: Stores project details.
    timesheets: Tracks timesheet entries.
    attributes: Stores dynamic attributes.
    attribute_values: Stores values for dynamic attributes.

### Technologies Used
1. PHP 8.2.x
2. Laravel 9.x
3. Laravel Passport 10.x
4. MySQL
5. Postman (for API testing)