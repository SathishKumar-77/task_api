# Task Management API

A RESTful API built with Laravel for managing tasks. This API allows users to create, view, update, and delete tasks, with features like validation, pagination, and soft deletes.

## Requirements

- PHP >= 8.0
- Composer
- MySQL (or another supported database)
- Laravel 12.x

## Setup Instructions

1. Clone the Repository using this command "git clone https://github.com/SathishKumar-77/task_api.git"
2. change the directory `cd todo-api`
3. install composer to work with larawel `composer install`
4. Edit .env file inside the project root directory
`DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todo_api_db
DB_USERNAME=root
DB_PASSWORD=your_password`


5. setup database(Here I'm using MySQL)
`mysql -u root -p
CREATE DATABASE todo_api_db;
EXIT;`

8. now run migrate `php artisan migrate`
9. now you can run or start the server using `php artisan serve`

Now the server and our api is running on `http://localhost:8000`


API Documentation
=================

***All endpoints are prefixed with /api. so use tool Postman to test the API(also you can use curl).***

Endpoints
=========

| Method | Endpoint      | Action  | Description            |
|--------|---------------|---------|------------------------|
| POST   | `/tasks`      | Store   | Create a new task      |
| GET    | `/tasks`      | Index   | List all tasks (paginated) |
| GET    | `/tasks/{id}` | Show    | View a specific task   |
| PUT    | `/tasks/{id}` | Update  | Update a task          |
| DELETE | `/tasks/{id}` | Destroy | Delete a task (soft)   |

Example Requests
================

POST/tasks
==========
Req: http://localhost:8000/api/tasks

Header: Content-Type: application/json

Body: 
{    
    "title": "Morning Work",
    "description": "Read News",
    "status": "pending",
    "due_date": "2025-03-10"
}

Res:

{
    "id": 1,
    "title": "Morning Work",
    "description": "Read News",
    "status": "pending",
    "due_date": "2025-03-10",
    "created_at": "2025-03-01T12:00:00.000000Z",
    "updated_at": "2025-03-01T12:00:00.000000Z"
}


Validation Rules:
================

title: Required, string, max 255 characters
description: Optional, string
status: Required, pending or completed
due_date: Required, valid date, after today

GET/tasks
=========

Req: http://localhost:8000/api/tasks

Res:

{
    "data": [
        {
            "id": 1,
            "title": "Morning Work",
            "description": "Read News",
            "status": "pending",
            "due_date": "2025-03-10",
            "created_at": "2025-03-01T12:00:00.000000Z",
            "updated_at": "2025-03-01T12:00:00.000000Z"
        }
    ],
    "links": {...},
    "meta": {"per_page": 10, ...}
}


GET/tasks/{id}
==============

Req: http://localhost:8000/api/tasks/1

Res: 
{
    "id": 1,
    "title": "Morning Work",
    "description": "Read News",
    "status": "pending",
    "due_date": "2025-03-10",
    "created_at": "2025-03-01T12:00:00.000000Z",
    "updated_at": "2025-03-01T12:00:00.000000Z"
}


PUT /tasks/{id}
===============

Req: http://localhost:8000/api/tasks/1

Header: Content-Type: application/json

Body: 
{    
    "title": "Morning Work",
    "description": "Read News",
    "status": "completed",
    "due_date": "2025-03-11"
}

Res:
{
    "id": 1,
    "title": "Morning Work",
    "description": "Read News",
    "status": "completed",
    "due_date": "2025-03-11",
    "created_at": "2025-03-01T12:00:00.000000Z",
    "updated_at": "2025-03-01T12:10:00.000000Z"
}


DELETE /tasks/{id}
==================

Req: http://localhost:8000/api/tasks/1

Res: (204 No Content) No body returned.


Additional Features
===================

**Soft Deletes:** Tasks are soft-deleted (marked with a deleted_at timestamp) instead of permanently removed. We can use Task::withTrashed() to include deleted tasks in queries if needed.
**Pagination:** Here I've added pagination to ensure messy data while have more data but now each page should have only 10 data.








