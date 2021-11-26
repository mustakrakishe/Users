# Users

[![version](https://img.shields.io/badge/php->=_v5.4.0-blue.svg)](https://www.php.net/downloads.php)
[![version](https://img.shields.io/badge/jquery-v3.6.0-blue.svg)](https://www.php.net/downloads.php)
[![version](https://img.shields.io/badge/bootstrap-v5.1.3-blue.svg)](https://getbootstrap.com/docs/5.1/getting-started/introduction/)
[![version](https://img.shields.io/badge/elasticsearch-v7.15.1-blue.svg)](https://www.elastic.co/downloads/elasticsearch)
[![dependecy](https://img.shields.io/badge/elasticsearch--php-v7.15.0-yellow.svg)](https://github.com/elastic/elasticsearch-php)
[![dependecy](https://img.shields.io/badge/fakerphp-v1.16.0-yellow.svg)](https://github.com/FakerPHP/Faker/)

An Elasticsearch index filter form.

## Description

A web application which allows to seed and search users by a few filters.

## Provided possibilities and UI features

- Seed a setable amount of the documents (DB entries) that represent users;
- Each user has the follow fields:
    - age;
    - name;
    - email;
    - phone.
- View a table of the existing documents;
- Search documents by a filter complex:
    - age - by range;
    - name - by the first letters;
    - email - full matching;
    - phone - by operator code.
- A user table displays "No results." in case documents miss or don't match filters.
- Dinamic status string.
- All actions don't require a page reload.

## Technical features

- Used default elasticsearch connection configuration:
    - host: 127.0.0.1;
    - port: 9200.
- Not existing index will be created in case  first user documents indexing.
- Bulk index of the new documents.
- It will display "No results." in case DB connection error insead of the exception.
- Ajax using.

## Installing

1. Clone a repository.
2. Install composer dependencies:
```
composer install
```
3. Download an [Elasticsearch](https://www.elastic.co/downloads/elasticsearch) server.

## Running

1. Run Elasticsearch server:
```
elasticsearch_folder\bin\elasticsearch.bat
```
2. Run PHP server.
3. Browse your site.

## Screenshots

Initial state:

![Init state](screenshots\screenshot_001_-_init_state.jpg "Init state")

Search example:

![Search example](screenshots\screenshot_002_-_search_example.jpg "Search example")