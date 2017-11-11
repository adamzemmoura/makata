# Local development

Download and install Docker

[Mac](https://www.docker.com/docker-mac)

[Windows](https://www.docker.com/docker-windows)

## Initial setup

Create a project folder
```
mkdir agileclass
```

Change directory to that folder
```
cd agileclass
```

Create a docker network:
```
docker network create makatanet
```

#### Pre-req: MySQL
You may need MySQL in a container

You may map it to a local dir so the data will persist:
```
mkdir mysql
docker run --network makatanet --rm --name mysql -p 13306:3306 -v `pwd`/mysql:/var/lib/mysql -e MYSQL_DATABASE=makatadb -e MYSQL_ROOT_PASSWORD=secret -d mysql
```

If everything went OK you should see MySQL running on a container. To confirm, type:
```
docker ps
``` 

#### Set up Laravel

Clone this repo
```
git clone https://github.com/hakuna-ma-kata/makata.git
```

Go into the new folder
```
cd makata
```

Copy the example .env.example file to a new .env:
```
cp .env.example .env
chmod 600 .env
```

Build a Makata container (and grab a coffee - this may take a little while):
```
docker build -t makata . -f docker/Dockerfile
````

You should see the Makata container available among the local images
```
docker images
```

Run the container mapping the folders for local development
```
docker run -d --network makatanet --rm --name makata -p 80:80 -v `pwd`/app:/var/www/html/app -v `pwd`/config:/var/www/html/config -v `pwd`/database:/var/www/html/database -v `pwd`/public:/var/www/html/public -v `pwd`/resources:/var/www/html/resources -v `pwd`/routes:/var/www/html/routes -v `pwd`/tests:/var/www/html/tests -v `pwd`/.env:/var/www/html/.env makata
```

You should see the Makata container running
```
docker ps
```

Run migrations to create the schema:
```
docker exec -it makata php artisan migrate
```

Optional: You may need to populate the database
```
docker exec -it makata php artisan db:seed
```

Open a browser. The application should be running on [localhost](http://localhost)

Open the repo with the files on your favorite code editor and make magic happen!

## Ongoing development

Always start from the agileclass folder

- Pull the latest changes
```
cd makata;git pull origin master
```

- Move back to the original folder
```
cd ..
```

- Start the database container:
```
docker run --network makatanet --rm --name mysql -p 13306:3306 -v `pwd`/mysql:/var/lib/mysql -e MYSQL_DATABASE=makatadb -e MYSQL_ROOT_PASSWORD=secret -d mysql
```

- Start the Makata application
```
docker run -d --network makatanet --rm --name makata -p 80:80 -v `pwd`/makata/app:/var/www/html/app -v `pwd`/makata/config:/var/www/html/config -v `pwd`/makata/database:/var/www/html/database -v `pwd`/makata/public:/var/www/html/public -v `pwd`/makata/resources:/var/www/html/resources -v `pwd`/makata/routes:/var/www/html/routes -v `pwd`/makata/tests:/var/www/html/tests -v `pwd`/makata/.env:/var/www/html/.env makata
```

-- Update packages to the latest version
```
docker exec -it makata composer install
```

-- Run the latest migrations
```
docker exec -it makata php artisan migrate
```

### WARNING: these steps may be dangerous
-- Reset the database (it will delete everything on the database):
```
docker exec -it makata php artisan reset
```

-- After resetting you will need to run migrations again
```
docker exec -it makata php artisan migrate
```

-- And most likely seed the database
```
docker exec -it makata php artisan db:seed
```

