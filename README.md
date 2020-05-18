# Sistema para la generación de comprobante de matrícula

_Proyecto para crear un sistema web para la generación de un comprobante de matrícula_

### Instalación 🔧

1. Crear un archivo en la raiz del proyecto que se llame .env con el contenido del archivo .env.example

2. Configurar los datos de conexión a la base de datos en el archivo .env

```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=poligrafo
    DB_USERNAME=root
    DB_PASSWORD=
```

3. Abrir una consola y ubicarnos en la carpeta del proyecto.

4. Instalar las dependencias de composer

```
    composer install
```

5. Instalar las dependencias de webpack para el frontend

```
    npm install
```

6. Abrir una consola, nos ubicamos en el directorio del proyecto y generamos la key de la aplicación:

```
    php artisan key:generate
```

7. Generar las migraciones de la base de datos:

```
    php artisan migrate
```

8. Abrir una consola, nos ubicamos en el directorio del proyecto y lanzamos el servidor de laravel:

```
    php artisan serve
```

9. Abrir otra consola, nos ubicamos en el directorio del proyecto y lanzamos el comando para generar el frontend de producción

```
    npm run watch
```

10. Abrimos nuestro navegador y vamos a la dirección:

```
    localhost:8000
```
