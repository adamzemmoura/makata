# Local development

- [Initial setup](#initial)

- [Ongoing use](#ongoing)

- [Working in a containet](#container)

- [Reset everything](#reset)

<a name="initial"></a>
## Initial setup

Download and install Docker

[Mac](https://www.docker.com/docker-mac)

[Windows](https://www.docker.com/docker-windows)

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

Copy the example .env.example file to a new .env:
```
cp makata/.env.example makata/.env
chmod 600 makata/.env
```

Build a Makata container (and grab a coffee - this may take a little while):
```
docker build -t makata makata/ -f makata/docker/Dockerfile
````

You should see the Makata container available among the local images
```
docker images
```

Run the container mapping the folders for local development
```
docker run -d --network makatanet --rm --name makata -p 80:80 -v `pwd`/makata:/var/www/html makata
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

<a name="ongoing"></a>
## Ongoing development

This step is needed if the containers stopped running (because Docker was stopped or the computer restarted)

Always start from the agileclass folder

- Pull the latest changes from the repo
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
docker run -d --network makatanet --rm --name makata -p 80:80 -v `pwd`/makata:/var/www/html makata
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

<a name="container"></a>
## Working in a container

To use bash inside of the makata container do this:
```
docker exec -it makata bash
```
Once connected you may use many of the bash commands
```
ls
pwd
cd <folder>
```

To connect to the database using the mysql client, we can first connect to the makata container
```
docker exec -it makata bash
```
and then connect to the database
```
mysql -h mysql -u root -p
```
once on the engine, you can use the makatadb database
```
use makatadb
```
You may display the contents of the users table
```
select * from users;
```

<a name="reset"></a>
## Reset everything

This will help you clean up if something is really wrong

Stop the containers
```
docker stop mysql
docker stop makata
```

Delete the images
```
docker rmi -f mysql
docker rmi -f makata
````

Delete the folders with the code
### WARNING: Execute these commands from the agileclass folder
```
rm -rf makata
rm -rf mysql
```

Once you've gone through these steps you may go back to the [Initial setup](#initial)
