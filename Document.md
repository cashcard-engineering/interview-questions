## Irrigation App Project

### Description


### Version
Version 1.0

### Author
David Adediji <davidadediji@gmail.com>

### Installation
#### Stacks Used
1. PHP 8.2
2. Composer
3. Laravel 10
4. MySQL

#### Steps
1. Clone the repository:
```sh
git clone https://github.com/cashcard-engineering/interview-questions.git
```

2. Navigate into the project directory:
```sh
cd interview-questions/irrigation-app
```
3. Install dependencies:
```sh
composer install
```

4. Configuration
Copy the .env.example file to .env:
```sh
cp .env.example .env
```

5. Generate an application key:
```sh
php artisan key:generate
```
6. Configure your database and other services in the .env file by populating this values with the right details
~~~
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
~~~

### Running the Application
1. Run the migration for database
```sh
php artisan migrate
```
2. No Database seed class was created for adding users but a custom command was created. seed the Users table with custom command and follow the prompts
```sh
php artisan users:create
```
3. Now run the application with
```sh
php artisan serve
```

optionally you can also use the link to a virtual host by accessing the index file on the public directory to run your app

### API Documentation

#### Authentication
All endpoints save for login requires the addition of a Bearer token generate from login endpoint

#### Endpoints
##### User Endpoints
<strong>Login</strong>

URL: `{BASE_URL}/api/v1/login`

Method: POST

Description: Authenticate a user and retrieve a token.

Request Body:

```json
{
  "email":"david@admin.com",
  "password":"password"
}
```
Response:

```json
{
  "accessToken": "2|ZUkPI6KNjD8RpHbmyyeoWZadTH2LJMKCEz6Cmj8C1a70ecca"
}
```
##### Zone Endpoints
<strong> Create a zone</strong>
URL: `{BASE_URL}/api/v1/login`

Method: POST

Description: Create a zone

Request Body:

```json
{
  "name":"zone H",
  "area":"Fairway May 5"
}
```
Response:

```json
{
  "status": true,
  "0": {
    "name": "zone H",
    "area": "Fairway May 5",
    "id": "9c17d4cc-d121-463a-b30d-b67e4a6282a5",
    "updated_at": "2024-05-21T03:21:23.000000Z",
    "created_at": "2024-05-21T03:21:23.000000Z"
  }
}
```

<strong>Get All zones</strong>
URL: `{BASE_URL}/api/v1/irrigation/zones`

Method: GET

Description: Get all zones

Response:

```json
[
  {
    "id": "9c17d4cc-d121-463a-b30d-b67e4a6282a5",
    "name": "zone H",
    "area": "Fairway May 5",
    "watering_status": null,
    "created_at": "2024-05-21T03:21:23.000000Z",
    "updated_at": "2024-05-21T03:21:23.000000Z"
  },
  {
    "id": "9c169f63-f297-4440-b383-75003073a280",
    "name": "zone D",
    "area": "Fairway May",
    "watering_status": null,
    "created_at": "2024-05-20T12:56:13.000000Z",
    "updated_at": "2024-05-20T12:56:13.000000Z"
  },
  {
    "id": "9c161317-7300-406c-a426-1c9db1ddcccb",
    "name": "zone Z",
    "area": "garwick",
    "watering_status": "started",
    "created_at": "2024-05-20T06:23:55.000000Z",
    "updated_at": "2024-05-20T06:40:40.000000Z"
  }
]
```

<strong>Get a Zone By Id </strong>
URL: `{BASE_URL}/api/v1/irrigation/zones/:zoneId`
Method: GET

Description: Get a zone by Id

Response:

```json
{
  "status": true,
  "0": {
    "id": "9c17d4cc-d121-463a-b30d-b67e4a6282a5",
    "name": "zone H",
    "area": "Fairway May 5",
    "watering_status": null,
    "created_at": "2024-05-21T03:21:23.000000Z",
    "updated_at": "2024-05-21T03:21:23.000000Z"
  }
}
```

<strong>Update Zone Details </strong>
URL: `{BASE_URL}/api/v1/irrigation/zones/:zoneId`

Method: PUT

Description: Create zone details

Request Body:

```json
{
  "name":"zone Z",
  "area":"garwick",
  "watering_status":"started"
}
```

<strong>Delete a zone </strong>

URL: `{BASE_URL}/api/v1/irrigation/zones/:zoneId`

Method: DELETE

Description: Delete a zone and all associated schedules

<strong>Get watering status </strong>

URL: `{BASE_URL}/api/v1/irrigation/zones/zoneId/status`

Method: GET

Description: Get the watering status of a specific zone

Response
```json
{
  "zone_name": "zone Z",
  "watering_status": "started"
}
```

#### Schedule Endpoints

<strong>Create a schedule </strong>

URL: `{BASE_URL}/api/v1/irrigation/zones/:zoneId/schedules`

Method: POST

Description: Create a schedule under a zone

Request
```json
{
  "start_time": "06:00:00",
  "duration": 30,
  "days_of_week": ["Tuesday", "Wednesday", "Thursday"]
}
```

Response
```json
{
  "start_time": "06:00:00",
  "duration": 30,
  "days_of_week": [
    "Tuesday",
    "Wednesday",
    "Thursday"
  ],
  "zone_id": "9c161317-7300-406c-a426-1c9db1ddcccb",
  "id": "9c17df7f-a8f3-4c31-900f-bde93d8b9231",
  "updated_at": "2024-05-21T03:51:18.000000Z",
  "created_at": "2024-05-21T03:51:18.000000Z"
}
```

<strong>Get all zone schedules </strong>
URL: `{BASE_URL}/api/v1/irrigation/zones/:zoneId/schedules`

Method: GET

Description: Get all schedules under a zone

Response
```json
[
  {
    "id": "9c166f33-e3c0-481d-91f5-a8700a5dd632",
    "zone_id": "9c161317-7300-406c-a426-1c9db1ddcccb",
    "start_time": "07:00:00",
    "duration": 30,
    "days_of_week": [
      "Tuesday",
      "Wednesday"
    ],
    "created_at": "2024-05-20T10:41:28.000000Z",
    "updated_at": "2024-05-20T10:41:28.000000Z"
  }
]
```


<strong>Get a specific zone schedule by Id </strong>

URL: `{BASE_URL}/api/v1/irrigation/zones/:zoneId`

Method: GET

Description: Get a specific schedule from a zone


Response
```json
{
  "id": "9c166f33-e3c0-481d-91f5-a8700a5dd632",
  "zone_id": "9c161317-7300-406c-a426-1c9db1ddcccb",
  "start_time": "07:00:00",
  "duration": 30,
  "days_of_week": [
    "Tuesday",
    "Wednesday"
  ],
  "created_at": "2024-05-20T10:41:28.000000Z",
  "updated_at": "2024-05-20T10:41:28.000000Z"
}
```

<strong>Update a schedule </strong>

URL: `{BASE_URL}/api/v1/irrigation/zones/:zoneId/schedules/:scheduleId`

Method: PUT

Description: Update a zone schedule

Request
```json
{
  "start_time": "04:00:00",
  "duration": 30,
  "days_of_week": ["Monday", "Wednesday", "Thursday"]
}
```

Response
```json
```

<strong>Delete a schedule </strong>

URL: `{BASE_URL}/api/v1/irrigation/zones/:zoneId/schedules/:scheduleId`

Method: DELETE

Description: Delete a zone and all associated schedules


