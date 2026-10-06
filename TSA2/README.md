# Tasks for Today Management System

Tasks for Today is an IT0049 TSA2 project built using CodeIgniter 4 and MySQL. It provides public task viewing and protected task-management actions.

## Features

- Public Welcome page
- Public Task List page
- Public Profile page
- Public About page
- Staff login and logout
- Password hashing and verification
- Session-based authentication
- Authentication filter
- Create new tasks
- Edit and update tasks
- Form validation
- Soft deletion through task archiving
- Archived tasks excluded from public pages

## Access Control

Anyone can access:

- `/`
- `/tasks`
- `/profile`
- `/about`
- `/login`

Logged-in users can access:

- `/tasks/new`
- `/tasks/{id}/edit`
- Task creation
- Task updating
- Task archiving

Logged-out visitors who open a protected page are redirected to the login page.

## Demo Login

```text
Username: admin.jolo
Password: Tasks123