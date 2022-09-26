# Shopware Learning

## Installation
### Using Dockware(ARM(Apple M1/M2) architecture compatible)
```shell
$ git clone git@github.com:shiftenterdev/shopware-learning.git
$ cd shopware-learning
$ docker-compose up -d
```

For volume mapping - After first run we need to uncomment volume node in `shopware` container.
```shell
...
container_name: shopware
#volumes:
#  - "./src:/var/www/html"
ports:
  - "80:80"
...
```
> Uncomment volume node after first run

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
