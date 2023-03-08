## About The Project
This is a Basic Todo List project which focus on desmostrating the concept of CRUD operation.
I Try to keep everything simple and direct, the client is created with Angular 15 while it is powered by a laravel 10 application.

## Tools and Tech Stack
- The Backend was built with [Laravel 10](https://demo-api.simplensmart.com/api) and MySQL database, you can click the link to interact with the APIs and a basic [postman documentation](https://documenter.getpostman.com/view/9683241/2s93JqRjVH) for easy interaction with the backend.

- The frontend is pretty basic and it is built with [Angular 15](https://todo-app.simplensmart.com/list) you can click on this link to checkout the live demo. Bootstrap 5.2 was also used for sytling and icons, it is a simple app so no state management was used.
This [video](https://www.loom.com/share/e25af651a57f4b47b0bf420269aa0245) shows the working demo pf the application.

## getting Started

To set up this project on you local you will have to do the following:

**1.** `git clone https://github.com/shiftback3/todo-list-beeproger.git` you will notice that you have to folders, `client` and `server` folder.

**2.** Run `cd server` to get access to the server files.

**3.** Run `compser install` when every dependecies are loaded you need to create a file `.env` file and copy the content of `.env.example`.

**4.** Run the follow comands in this order 
```
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan serve
```
You can check your browser or use postman on [Localhost:8000](http://localhost:8000).
Now that the application is running you can run `php artisan test` to test the features of the APIs.

