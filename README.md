# Laravel Task v11

```shell
# To start the database, adminer, redis, mailhog
docker compose up -d

# To setup database
php artisan migrate

# To seed database
php artisan db:seed

# To run the project
php artisan serve


# And to test the entire project ....
# I have setup some tests to check sanity / quality of code
php artisan test
```

You can access the project on:

http://localhost:8000

You can access the database using adminer on:

http://localhost:8080

# Task Items

**MUST:-**

- [x] Use PHP 7.* or 8.*
- [x] Write migrations for the required tables.
- [x] Endpoint to create a "post" for a "particular website".
- [x] Endpoint to make a user subscribe to a "particular website" with all the tiny validations included in it.
- [ ] Use of command to send email to the subscribers (command must check all websites and send all new posts to
  subscribers which haven't been sent yet).
- [ ] Use of queues to schedule sending in background.
- [ ] No duplicate stories should get sent to subscribers.
- [x] Deploy the code on a public github repository.

**OPTIONAL:-**

- [x] Seeded data of the websites.
- [x] Open API documentation (or) Postman collection demonstrating available APIs & their usage.
- [ ] Use of contracts & services.
- [ ] Use of caching wherever applicable.
- [ ] Use of events/listeners.

# Database Model

![Database Model](/docs/diagams.jpg)
