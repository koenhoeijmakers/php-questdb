# PHP QuestDB
> This package is work in progress.

A QuestDB client for PHP.

## Usage
```shell script
$ composer require koenhoeijmakers/questdb
```

## Contributing
### Tests
To run the test suite, run a `docker-compose up -d` then get into the interactive shell of the `app` container with `docker exec -it app bash`.
```shell script
$ docker-compose up -d
$ docker exec -it app bash
$ phpunit
```
