# Shopware Learning

> Shopware repo based on dockware

## Installation
### Using Dockware(M1 architecture compatible)
```shell
$ git clone git@github.com:shiftenterdev/shopware-learning.git
$ cd shopware-learning
$ docker-compose up -d
```

For volume mapping - After first run we need to uncomment volume node in `shopware` container.
```shell
...
container_name: shopware
volumes: # First time this volumes node will commented
  - "./src:/var/www/html"
ports:
  - "80:80"
...
```

And copy file from source container to host
```shell
# Now copy file from source to host
$ docker cp {container_name}:{path} {source_directory}
# Example
$ docker cp shopware:/var/www/html/. ./src
```

Finally, restart the docker-compose by
```shell
# Now restart the docker compose by
docker-compose down;docker-compose up -d
```

## Setup

### Configuration

```yml
version: "3"

services:

    shopware:
      # use either tag "latest" or any other version like "6.1.5", ...
      image: dockware/dev:latest
      container_name: shopware
      ports:
         - "8001:80"
         - "3307:3306"
         - "22:22"
         - "8888:8888"
         - "9999:9999"
      volumes:
         - "db_volume:/var/lib/mysql"
         - "shop_volume:/var/www/html"
      networks:
         - web
      environment:
         # default = 0, recommended to be OFF for frontend devs
         - XDEBUG_ENABLED=1
         # default = latest PHP, optional = specific version
         - PHP_VERSION=7.4

volumes:
  db_volume:
    driver: local
  shop_volume:
    driver: local

networks:
  web:
    external: false
```

> To update the port please up it `.env` file also and after restart the container.

#### Elastic search

To enable elasticsearch add following node in the `docker-compose.yml` file.

```
elasticsearch:
  image: elasticsearch:7.5.2
  container_name: elasticsearch
  networks:
    - web
  environment:
    - "EA_JAVA_OPTS=-Xms512m -Xms512m"
    - discovery.type=single-node
```

And in the `.env` file.

```
SHOPWARE_ES_HOSTS=elasticsearch:9200
SHOPWARE_ES_ENABLED=1
SHOPWARE_ES_INDEXING_ENABLED=1
SHOPWARE_ES_INDEX_PREFIX=abc
```

### Redis

To enable redis in Shopware we need following node in `docker-compose.yml` file.

```
redis:
  image: redis:5.0.6
  container_name: redis
  networks:
    - web
```

And in the `.env` file

```
REDIS_SESSION_HOST=redis
REDIS_SESSION_PORT=6379
REDIS_CACHE_HOST=redis
REDIS_CACHE_PORT=6379
```

#### Default Credentials

__Admin:__
- User: admin
- Password: shopware

__Mysql:__
- User: root
- Password: root
- Port: 3306

__SSH/SFTP credentials:__
- User: dockware
- Password: dockware
- Port: 22

__Mailcatcher:__
- Host: localhost
- Port: 1025

## Development

### Enter docker container
To enter the docker container
```shell
$ docker exec -it {container_name} {shell}

# Example
$ docker exec -it shopware bash
```
Then a new docker container shell will open like

`www-data@673fe6749366:~/html$`

### Run shopware-shell command
To run shopware shell command
```shell
# To clear the cache
$ php bin/console cache:clear

# To create a new plugin skeleton
$ php bin/console plugin:create --config -- SWTesting
```
To check all commands list
```shell
$ php bin/console
```
For command help
```shell
$ php bin/console help plugin:create
```
