
https://symfony.com/doc/current/setup/symfony_server.html#symfony-server-docker

Acceder al proyecto
`````
cd adviento-symfony
`````

Instalar dependencias
````
composer install
`````

Levantar el servidor
````
symfony server:start
```

Levantar BD y Servicio de mail
`````
docker-compose up

`````

Ejecutar migraciones
`````
bin/console doctrine:migrations:migrate
`````

Ver panel de correos
````
mailcatcher: http://localhost:64088/
````
