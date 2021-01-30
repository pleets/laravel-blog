# Laravel Blog

This is a simple microblogging app.

![DASHBOARD](https://blog.pleets.org/img/articles/blog-dashboard-example.png)

You can download this project as follows.

```bash
git clone https://github.com/pleets/laravel-blog
```

# 1. Installation

This application was developed with Laravel 6x, most of the following steps are related to laravel
installation and configuration.

## 1.1 Requirements

As any Laravel application, you will need to make sure your server meets the following requirements.

- PHP >= 7.2.5
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

In addition, you need the following dependencies.

- MySQL >= 5.7

## 1.2 Set up

Set up permission of `storeage` and `bootstrap/cache` directories.

```bash
chmod -R a+w storage
chmod a+w bootstrap/cache
```

Let's copy the `.env.example` to `.env`.

```bash
cp .env.example .env
```
### 1.2.1 Env Vars

Set up `DB_` and other env vars as you need. 

| Variable                 | Description                              |
|--------------------------|------------------------------------------|
| APP_PAGE_TITLE           |  Title of this Blog                      |
| APP_PAGE_DESCRIPTION     |  Description of this Blog                |

## 1.3 Step by Step Installation

Make sure you have composer installed in your machine and execute the following command to install the
dependencies.

```bash
composer install
```

Then generate the key for the application.

```bash
php artisan key:generate
```

Finally, create the database schema and basic data executing the following command.

```bash
php artisan migrate --seed
```
## 1.3.1 Creating admin user

To create the admin user and its role with all related permissions you could run the following seeder

```bash
php artisan db:seed --class=AdminUserSeeder
```

Then you can use the following user credentials to log in

```text
email: admin@admin.com
pass:  password
```

## 1.3.2 Creating sample data

For non-production environments maybe you would like to get some sample data prepared for you. To do that,
Let's execute the following seeders.

Example tags:

```bash
php artisan db:seed --class=TagsTableSeeder
```

Example categories:

```bash
php artisan db:seed --class=CategoriesTableSeeder
```

Writer user:

```bash
php artisan db:seed --class=WriterSeeder
```

Once you have executed the `WriterSeeder` you can log in with the following credentials

```text
email: writer@writer.com
pass:  password
```
