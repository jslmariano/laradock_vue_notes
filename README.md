# PHP Laravel Developer Challenge
Programming Skill Assessment Questions

## Objective

This assessment contains 5 PHP related questions, and 3 SQL related questions.

You may use any tools at your disposal to complete these questions.

You should consider cases where different inputs other than that of the question for
each of the questions, we expect different scenarios to be handled and the function
will still working accordingly.
Usage of search engines and reference books for code references and syntax is
allowed;

However, you are not allowed to search for the direct solution to the questions. You
will be disqualified if you are found cheating (and believe me, we know).

## Instructions

You are going to use a pre-configured dockerized application to to load the said solutions within a  **LINUX MACHINE**

_Note: There is already JWT authentication implemented for the app._

**TODO:** The application should show solutions regarding on the requirements below

Requirements in : `requirements/Senior Backend Developer Assessment.pdf`

## Setup

The project comes with a dockerized development environment and should include everything you need to get working right away.

This setup requires that you have docker and docker-compose installed on your system **LINUX MACHINE**.

**Docker installation instructions here:**
[https://docs.docker.com/compose/install/](https://docs.docker.com/compose/install/)

**Extract laravel aiodin** (as your project root)
```
tar -xvf laravel_aiodin.tar -C /var/www/html/
cd /var/www/html/ ( <-- Your Projecy Root)

```

**Focus of scripts**
```
SOLUTIONS : packages\jslmariano\aiodin\src\Models\Solutions.php
UNITTEST  : packages\jslmariano\aiodin\tests\AiodinFunctionTest.php
```

**Copy Laravel environment file**
(While in project root)

```
cp .env.example .env
```

**Copy Laradock environment files**

```
cd laradock

cp env-example .env
```


**Run docker containers**
((recommended) if w/o database)
```
docker-compose up -d nginx workspace
```

**Enter workspace container**

```
docker-compose exec --user=laradock workspace bash
```

**Install dependencies and build existing database**
((recommended) if w/o database)
```
rm -rf vendor
rm -rf composer.lock
composer install
composer dump-autoload
npm install --no-bin-links
npm install cross-env --no-bin-links
php artisan key:generate
```

**Testing the custom package**

```
phpunit  packages/jslmariano/aiodin
```

**Refresh jslmariano/aiodin package IF after code modifications**

```
rm -rf vendor/jslmariano
composer update jslmariano/aiodin
```

## Technical Question

You can reach me at SKYPE EMAIL : sel@jslmariano.com