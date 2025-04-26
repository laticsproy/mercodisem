# Minuta Electrónica de Reunión

Sistema web desarrollado en **Laravel 11** para gestionar minutas electrónicas de reuniones, incluyendo la creación de reuniones y asistentes. Este proyecto utiliza validaciones de formularios con las clases `StoreReunion` y `StoreAsistente`.

## Requisitos previos

Antes de instalar el proyecto, asegúrate de tener instalado lo siguiente en tu sistema:

- **PHP** (>= 8.2): Descarga desde [php.net](https://www.php.net/downloads.php).
- **Composer**: Gestor de dependencias de PHP. Descarga desde [getcomposer.org](https://getcomposer.org/).
- **Node.js y npm**: Para compilar assets frontend (si aplica). Descarga desde [nodejs.org](https://nodejs.org/).
- **MySQL**: O una base de datos compatible (como PostgreSQL). Descarga desde [mysql.com](https://dev.mysql.com/downloads/) o usa XAMPP.
- **Git**: Para clonar el repositorio. Descarga desde [git-scm.com](https://git-scm.com/).

## Instalación

Sigue estos pasos para descargar, instalar y ejecutar el proyecto localmente:

1. **Clonar el repositorio**:
   - Abre una terminal (PowerShell, CMD, Git Bash en Windows, o la terminal en Linux/Mac).
   - Clona el repositorio desde GitHub:
     ```bash
     git clone https://github.com/laticsproy/mercodisem.git
     cd mercodisem
     ```

2. **Instalar dependencias de PHP**:
   - Ejecuta el siguiente comando para instalar las dependencias definidas en `composer.json`:
     ```bash
     composer install
     ```

3. **Instalar dependencias de frontend** (si aplica):
   - Si el proyecto utiliza Vite para compilar assets frontend (CSS/JavaScript), instala las dependencias de Node.js:
     ```bash
     npm install
     npm run build
     ```
   - Nota: Si el proyecto no usa assets frontend, puedes omitir este paso.

4. **Configurar el archivo de entorno**:
   - Copia el archivo `.env.example` para crear un archivo `.env`:
     ```bash
     copy .env.example .env  # Windows
     cp .env.example .env    # Linux/Mac
     ```
   - Abre el archivo `.env` en un editor de texto (como VS Code) y configura la conexión a la base de datos:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=minuta_electronica
     DB_USERNAME=tu_usuario
     DB_PASSWORD=tu_contraseña
     ```

5. **Generar la clave de la aplicación**:
   - Ejecuta el siguiente comando para generar una clave única para la aplicación:
     ```bash
     php artisan key:generate
     ```

6. **Crear la base de datos**:
   - Crea una base de datos en MySQL con el nombre especificado en `DB_DATABASE` (por ejemplo, `minuta_electronica`). Usa una herramienta como phpMyAdmin o la terminal de MySQL:
     ```sql
     CREATE DATABASE minuta_electronica;
     ```
   - Asegúrate de que el usuario y la contraseña en `.env` tengan permisos para esta base de datos.

7. **Ejecutar las migraciones**:
   - Aplica las migraciones para crear las tablas en la base de datos:
     ```bash
     php artisan migrate
     ```
   - Si el proyecto incluye datos iniciales (seeders), ejecuta:
     ```bash
     php artisan db:seed
     ```

8. **Iniciar el servidor de desarrollo**:
   - Inicia el servidor integrado de Laravel:
     ```bash
     php artisan serve
     ```
   - Abre un navegador y accede a `http://localhost:8000` para ver la aplicación.

## Estructura del proyecto

Para explorar el código, revisa las siguientes ubicaciones:

- **Migraciones**: Archivos que definen la estructura de la base de datos, ubicados en `database/migrations/`.
- **Modelos**: Clases Eloquent que representan las tablas de la base de datos, ubicadas en `app/Models/`.
- **Controladores**: Lógica de negocio implementada en los controladores, ubicada en `app/Http/Controllers/`.
- **Requests**: Clases de validación de formularios, como `StoreReunion` y `StoreAsistente`, ubicadas en `app/Http/Requests/`.
- **Rutas**: Definición de rutas en `routes/web.php` para rutas web y, opcionalmente, en `routes/api.php` para rutas API.
- **Vistas**: Archivos Blade para la interfaz de usuario, ubicados en `resources/views/`.

## Contribuciones

Si deseas contribuir al proyecto:

1. Haz un fork del repositorio.
2. Crea una rama para tus cambios:
   ```bash
   git checkout -b nueva-funcionalidad
   ```
3. Commitea tus cambios:
   ```bash
   git commit -m "Descripción de los cambios"
   ```
4. Sube tu rama:
   ```bash
   git push origin nueva-funcionalidad
   ```
5. Crea un Pull Request en GitHub.

## Licencia

[Agrega la licencia de tu proyecto, por ejemplo, MIT License, si aplica.]