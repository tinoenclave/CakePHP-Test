## Get Started

This guide will walk you through the steps needed to get this project up and running on your local machine.

### Prerequisites

Before you begin, ensure you have the following installed:

- Docker
- Docker Compose

### Building the Docker Environment

Build and start the containers:

```
docker-compose up -d --build
```

### Installing Dependencies

```
docker-compose exec app sh
composer install
```

### Database Setup

Set up the database:

```
bin/cake migrations migrate
```

### Accessing the Application

The application should now be accessible at http://localhost:34251

## How to check
In this source code, I have also implemented a simple admin template. If you are interested, you can explore it by accessing the URL instead of the API

### Authentication
We are using 2 packages to support authentication:
```
composer require "cakephp/authentication:^2.4"
```
```
composer require rrd108/api-token-authenticator:0.4
```
You can log in/log out/create/edit/update/view/delete users through the API or by accessing the URL

**To use the API, please ensure that you set the header with ```Accept: application/json``` for each endpoint requested**

+ Here is the list of supported API/endpoints for the users module.
 1.  Create Users: /users/add
 2.  Login: /users/login
 3.  User View: /users/view/{user_id}
 4.  Edit User: /users/edit/{user_id}
 5.  Logout: /users/logout
        
### Article Management

You can manage the articles through the API or by accessing the URL

+ Here is the list of supported API/endpoints for the article module.
 1.  Create an Article: /articles.json (POST)
 2.  Retrieve All Articles: /articles.json (GET)
 3.  Retrieve a Single Article: /articles/{article_id}.json (GET)
 4.  Update an Article: /articles/{article_id}.json
 5.  Delete an Article: /articles/{article_id}.json

### Like Feature

I have created a migration to support the 'likes' feature, so please run the ```bin/cake migrations migrate``` command before checking it

+ Here is the list of supported API/endpoints for the article module.
1. Likes: /articles/like/{article_id}.json