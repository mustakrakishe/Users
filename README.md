# Users
[![version](https://img.shields.io/badge/php->=5.4.0-blue.svg)](https://www.php.net/downloads.php)
[![version](https://img.shields.io/badge/bootstrap-v5.1.3-blue.svg)](https://getbootstrap.com/docs/5.1/getting-started/introduction/)
[![version](https://img.shields.io/badge/elasticsearch-7.15.1-blue.svg)](https://www.elastic.co/downloads/elasticsearch)
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

## Usage
1. Clone a repository.
2. In a prompt access a project dir and run
```
composer install
```
3. Run PHP server.
4. Download and run [Elasticsearch](https://www.elastic.co/downloads/elasticsearch) server.
5. Browse _127.0.0.1_ or _localhost_.