# Weather forecast API

![](https://travis-ci.org/Sunsetboy/weather-forecast.svg?branch=master)
[![Maintainability](https://api.codeclimate.com/v1/badges/ca33fdcf637716975db7/maintainability)](https://codeclimate.com/github/Sunsetboy/weather-forecast/maintainability)

## Requirements
PHP 7.2+\
Composer

## Installation
Clone repository\
Run ```composer install```\
Copy the .env.example file to .env, set up configurations in .env file

## Usage
Run ```php -S localhost:8000 -t public/``` to use built-in PHP web server

To get a forecast for today make a request:\
```GET /forecast/Amsterdam```\
or specify a date:\
```GET /forecast/Amsterdam/2020-03-01```

Date should be today or up to 10 days in future
Town could be any (now the API don't has towns base and gives mocked results)

You can also specify a temperature scale as a GET parameter
```GET /forecast/Amsterdam/2020-03-01?scale=fahrenheit```
Supported scales: celsius (default), fahrenheit

In case of incorrect date you will receive a response with status code 400.\
In case of correct request you will receive a response with status code 200 and a forecast in JSON format

## Running tests
Without test coverage\
```vendor/bin/phpunit tests```

With coverage\
```vendor/bin/phpunit tests --coverage-html tests/output/coverage```
