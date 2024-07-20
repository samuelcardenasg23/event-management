<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Event Project Management

The Event Management App is a web application designed to streamline the process of organizing and managing events. It allows users to create events, manage attendees, and track event-related data seamlessly.

## Features

- User Management: Register, login, and manage user profiles.
- Event Creation: Create and manage events with detailed information.
- Attendee Management: Track and manage event attendees.
- Relationships: Load and manage relationships between users, events, and attendees dynamically.

## API Endpoints
- GET /events: Retrieve a list of events with optional relationship loading.
- POST /events: Create a new event.
- GET /events/{id}: Retrieve a specific event by ID.
- PUT /events/{id}: Update a specific event by ID.
- DELETE /events/{id}: Delete a specific event by ID.

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
