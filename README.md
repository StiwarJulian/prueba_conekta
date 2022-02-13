# Prueba Conekta

[![Build Status](https://travis-ci.org/joemccann/dillinger.svg?branch=master)](https://travis-ci.org/joemccann/dillinger)

La prueba fue realizada en el framework codeigniter 4.

- Codeigniter 4
- Flatlab Template
- Axios

## Instalacion

Lo primero que se debe realizar es clonar el repositorio de la siguiente manera:
En la terminal nos ubicamos donde queremos que quede clonado el repositorio y escribimos la siguiente instruccion.
```sh
git clone https://github.com/StiwarJulian/prueba_conekta.git
```
Una vez nuestro repositorio este clonado, nos ubicamos sobre el proyecto desde la terminal y instalamos las dependencias de composer.
```sh
cd repositorio_clonado
composer install
```
En el momento en el que finalicen las instalaciones de composer deberemos crear la base de datos 
la cual es el archivo prueba_conekta.sql, se debe importar el archivo.
Ya teniendo nuestra base de datos creada abriremos el archivo .env y reemplazaremos los siguientes campos por los de nuestra conexion:

```sh
database.default.hostname = localhost       
database.default.database = prueba_conekta // Nombre Base Datos
database.default.username = root // usuario Base Datos
database.default.password = ""   // clave Base Datos
```

por ultimo ya teniendo esto configurado procederemos a desplegar nuestro servidor con las siguientes instrucciones en la terminal

```sh
php spark serve
```

En este momento ya nuestro servidor estara desplegado con nuestra aplicacion.