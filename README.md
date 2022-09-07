# Laravel Task v11

Project runs using PHP 8.1. Before running the project, rename sample `.env.example` to `.env`.

```shell
# To start the database, adminer, redis, mailhog
# you need to have docker and docker compose installed
# from https://docs.docker.com/get-docker/
docker compose up -d

# Run package manager
composer install

# To setup database
php artisan migrate

# To seed database
php artisan db:seed

# To run the project
php artisan serve

# To process the email queues open up a new terminal
# and run from the project directory
php artisan queue:listen

# To process and send new emails
php artisan emails:send


# And to test the entire project ....
# I have setup some tests to check sanity / quality of code
php artisan test
```

You can access the project on:

http://localhost:8000

You can access the database using adminer on:

http://localhost:8080

You can access the test email inbox on:
http://localhost:8025/

```shell
# Test credentials
username: root
password: example
```

# Task Items

**MUST:-**

- [x] Use PHP 7.* or 8.*
- [x] Write migrations for the required tables.
- [x] Endpoint to create a "post" for a "particular website".
- [x] Endpoint to make a user subscribe to a "particular website" with all the tiny validations included in it.
- [x] Use of command to send email to the subscribers (command must check all websites and send all new posts to
  subscribers which haven't been sent yet).
- [x] Use of queues to schedule sending in background.
- [x] No duplicate stories should get sent to subscribers.
- [x] Deploy the code on a public github repository.

**OPTIONAL:-**

- [x] Seeded data of the websites.
- [x] Open API documentation (or) Postman collection demonstrating available APIs & their usage.
- [ ] Use of contracts & services.
- [ ] Use of caching wherever applicable.
- [ ] Use of events/listeners.

# Database Model

![Database Model](/docs/diagams.jpg)
