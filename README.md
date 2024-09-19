<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Event Project Management API

## Overview
The Event Management API is designed to facilitate the planning and coordination of events. It provides a robust platform for managing events, attendees, and user relationships efficiently. Key features include event creation, attendee tracking, and notification functionalities.

## Authentication
This API uses token-based authentication with Laravel Sanctum. To authenticate, users must log in to receive a token, which should be included in the `Authorization` header for subsequent requests.


## Features

- **User Management**: Login for user authentication and authorization.
- **Event Creation & Management**: Users can create and manage events, providing details such as date, location, and description.
- **Attendee Management**: Allows tracking and managing attendees for events. Users can register (attend) for events or be unregistered (unattend).
- **Dynamic Relationships**: Leverage eager loading to retrieve complex relationships between events, users, and attendees.
- **Notifications**: Send automated email reminders to attendees before the event (requires configuration).

## API Endpoints

### Events
- GET /events: Retrieve a list of events with optional relationship loading.
- GET /events/{id}: Retrieve a specific event by ID.
- POST /events: Create a new event.
- PUT /events/{id}: Update a specific event by ID.
- DELETE /events/{id}: Delete a specific event by ID.

### Attendees
- GET /events/{event}/attendees: Get All Attendees of an Event
- POST /events/{event}/attendees: Attend and event
- DELETE /events/{event}/attendees/{attendee}: Unattend an event.

### Auth
- POST /login: Login user with email and password.
- POST /logout: Logout current logged user.

### Users
- GET /user: Get current user.

## Relationship Loading
To dynamically load relationships, include the include query parameter in your requests. For example:

```
{{BASE_URL}}/events?include=user,attendees,attendees.user
```

## Technologies Used

- Laravel PHP Framework
- MySQL Database

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
