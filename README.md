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

Step 1:
```
bin/cake migrations migrate
```

Step 2:
```
bin/cake migrations seed
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
 ```
 POST /users/add HTTP/1.1
 Host: localhost:8765
 Accept: application/json
 Content-Type: application/json
 Content-Length: 67
 {
     "email": "tino15@enclave.vn",
     "password": "12345678"
 }
```
 2.  Login: /users/login
 ```
 POST /users/login HTTP/1.1
 Host: localhost:8765
 Accept: application/json
 Content-Type: application/json
 Content-Length: 65
 {
     "email": "tino1@enclave.vn",
     "password": "123456"
 }
```
 3.  User View: /users/view/{user_id}
 ```
 GET /users/view/1 HTTP/1.1
 Host: localhost:8765
 Accept: application/json
 ```
 4.  Edit User: /users/edit/{user_id}
 ```
 PUT /users/edit/1 HTTP/1.1
 Host: localhost:8765
 Accept: application/json
 Content-Type: application/json
 Content-Length: 65
 {
     "email": "tino1@enclave.vn",
     "password": "123456"
 }
 ```
 5.  Logout: /users/logout
 ```
 GET /users/logout HTTP/1.1
 Host: localhost:8765
 Accept: application/json
 Content-Type: application/json
 Content-Length: 65
 {
     "email": "tino1@enclave.vn",
     "password": "123456"
 }
 ```
6. Delete User: /users/delete/{user_id}
```
POST /users/delete/1 HTTP/1.1
Host: localhost:8765
Accept: application/json
```
        
### Article Management

You can manage the articles through the API or by accessing the URL

+ Here is the list of supported API/endpoints for the article module.
 1.  Create an Article: /articles.json (POST)
 ```
 POST /articles.json HTTP/1.1
 Host: localhost:8765
 Content-Type: application/json
 Content-Length: 86
 {
     "title": "Article 00000000000000010",
     "body": "Article 00000000000000010"
 }
 ```
 2.  Retrieve All Articles: /articles.json (GET)
 ```
 GET /articles.json HTTP/1.1
 Host: localhost:8765
 Content-Type: application/json
 ```
 3.  Retrieve a Single Article: /articles/{article_id}.json (GET)
 ```
 GET /articles/1.json HTTP/1.1
 Host: localhost:8765
 ```
 4.  Update an Article: /articles/{article_id}.json
 ```
 PUT /articles/1.json HTTP/1.1
 Host: localhost:8765
 Content-Type: application/json
 Content-Length: 
 {
     "title": "Article 000000000000000 tino",
     "body": "Article 0000000000000009 tino"
 }
 ```
 5.  Delete an Article: /articles/{article_id}.json
 ```
 DELETE /articles/1.json HTTP/1.1
 Host: localhost:8765
 Content-Type: application/json
 ```

### Like Feature

I have created a migration to support the 'likes' feature, so please run the ```bin/cake migrations migrate``` command before checking it

+ Here is the list of supported API/endpoints for the article module.
1. Likes: /articles/like/{article_id}.json
```
POST /articles/like/1.json HTTP/1.1
Host: localhost:8765
Content-Type: application/json
Content-Length: 86
{
    "title": "Article 0000000000000008",
    "body": "Article 0000000000000008"
}
```

bin/cake migrations seed