<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


## Task

Build a Quiz web application, the user should be presented with the quiz questions on page visit, user should only see 1 question at a time, it can be either on separate pages or 1 page and load questions dynamically using JavaScript.

After the user completed the Quiz, they will be presented with their score and a form that will accept their username to be stored into the database.

* Build the application with PHP language (use of PHP framework such as Laravel, CodeIgniter, Symfony, Slim, etc. are allowed)
* On client side, use JQuery
* Use MySQL, MariaDB, PostgreSQL, SQL Server or SQLite as the database
* Simple UI is okay as long as its functional and decent UX (i.e. user should be able to take the quiz intuitively when looking at the page)
Please use the data set provided in the SQL dump in this repo as a base. You can change original database data or structure that you think will make the solution better. You are allowed to use any library or framework to help you with the task.


## My solution
I have used the following technologies to built the system: Laravel framework, PHP, JQuery, HTML, CSS, Bootstrap, and MySQL. As I used VueJS for the login/register system.


Users must Register/Login initially using their unique username
### Users level access
I have created two access level of uesrs:

**Administrator** - Who can control the platform (when 'role' in the 'users' table is 1)

**Normal users** - Who can submit answers (when 'role' in the 'users' table is 0)

As an administrator on the app,
* I can see all users;
* I can see all admin users;
* I can see all questions;
* I can add a new question.

As a nomal user on the app,
* I can submit my answers for the asked questions.
* I can see my score.

## Setting Up
Make sure that you have composer installed
```
composer install
```

Also make sure that you have laravel installed in you local machine 
```
composer global require laravel/installer
```

Clone my repo into you local machine, and then start Laravel's local development server using the Laravel's Artisan CLI serve command:
```
cd quiz
 
php artisan serve
```

**Note:** you might also need to install `npm` as I have used `VueJs` for the login system
```
npm install
npm run dev
```

## Test
If I have an extra time I'll built unit tests, however, now you can test the functionality of the system as follow:
1. Go to `.env` file to initialize your local environment. For example, change the following variables `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`.
2. Let say your local DB is named `quiz`. So create manually a new DB named `quiz`.
3. Now go to your directory through the terminal, and then migrate tables into the local DB by `php artisan migrate  `
4. And then run the server: ` php artisan serve `
5. Go to your browser, and then open the development server, for example, `http://127.0.0.1:8000`
6. Create 3 accounts (admin, user1, user2)
7. In your local DB, change manually the `admin` account by changing the `role` field from `0` to `1`
8. Now, through the admin account, you can add a new question, and also control the platform. From the other side, normal users (`user1` and `user2`) will submit their answers.

## Authors and acknowledgment
Omran ALhaddad - omranalhaddad22@gmail.com
