# Tarea 13: Gestión de autos

Entrega de la tarea 13, una web para ver, agregar y modificar autos usando la base de datos de autos y marcas que pasó el profe.

## Como levantarla

1. Tener Docker instalado
2. Parado en la carpeta del proyecto correr: `docker compose up --build -d`
3. Entrar a http://localhost:8080

La base se crea sola la primera vez con el init.sql, ahi estan las tablas del profe con autos y marcas de prueba.

phpMyAdmin queda en http://localhost:8081 (usuario: root, contraseña: root_password)

## Estructura

- `api/`: backend en PHP con los controllers y models que hacen las consultas
- `api/config/init.sql`: la base de datos de prueba
- `front/`: las paginas del sitio (listado, detalle para modificar y agregar)
- `front/dist/js/api.js`: el mensajero que habla con la api (archivo del profe)

Los `.env` van incluidos a propósito para que se pueda levantar directo.

## Integrante

Franco (https://github.com/franco2554)
