<div align="center" id="top"> 
  <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/1200px-Laravel.svg.png" height="64px" alt="To Do List" />

&#xa0;
<h4 align="center">
    <a href="https://to-do-list-u3q0.onrender.com">API NO AR</a> 
</h4>

</div>

<h1 align="center">To Do List - PHP</h1>

<p align="center">
  <img alt="Github top language" src="https://img.shields.io/github/languages/top/felicio-almd/to-do-list?color=56BEB8">

  <img alt="Github language count" src="https://img.shields.io/github/languages/count/felicio-almd/to-do-list?color=56BEB8">

  <img alt="Repository size" src="https://img.shields.io/github/repo-size/felicio-almd/to-do-list?color=56BEB8">
</p>


<hr>

<p align="center">
  <a href="#dart-about">About</a> &#xa0; | &#xa0; 
  <a href="#sparkles-features">Features</a> &#xa0; | &#xa0;
  <a href="#rocket-technologies">Technologies</a> &#xa0; | &#xa0;
  <a href="#white_check_mark-requirements">Requirements</a> &#xa0; | &#xa0;
  <a href="#checkered_flag-starting">Starting</a> &#xa0; | &#xa0;
  <a href="https://github.com/felicio-almd" target="_blank">Author</a>
</p>

<br>

## :dart: About

Part 1 - Building the back-end of a to-do list application with pure PHP, using Laravel concepts.\
Part 2 - Integrating with a database using modern SQL tools.\
Part 3 - Use Docker and Render for deploy the API.

## :sparkles: Features

:heavy_check_mark: Feature 1 - PHP\
:heavy_check_mark: Feature 2 - Laravel RestFul API\
:heavy_check_mark: Feature 3 - Postgres\
:heavy_check_mark: Feature 4 - Deploy on Render\

## :rocket: Technologies

The following tools were used in this project:

-   [Laravel](https://laravel.com/)

## :white_check_mark: Requirements

Before starting, you need to have [Git](https://git-scm.com), [PHP](), [Composer]() and [Database]() installed.

## :checkered_flag: Starting

```bash
# Clone this project
$ git clone https://github.com/felicio-almd/to-do-list

# Access the project folder
$ cd to-do-list

$ composer install

# IT WILL ONLY BE STARTED IF THE COMPOSER IS INSTALLED
# REQUIRED DATABASE OPEN AND STARTED
# NEED TO CHANGE .env TO EACH DB

# Install dependencies
$ php artisan migrate:fresh
$ php artisan key:generate

# Run the project
$ php artisan serve

# The server will initialize at <http://localhost:8000/api/tasks>
```

Made with ❤️ by Felicio

<a href="#top">Back to top</a>
