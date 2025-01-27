
# Proyecto Laravel

Este documento describe los pasos necesarios para instalar y ejecutar este proyecto Laravel en tu entorno local. Asegúrate de seguir cada paso con precisión para evitar errores.

---

## Requisitos previos

1. **PHP**: Versión 8.0 o superior.
2. **Composer**: Herramienta de gestión de dependencias para PHP.
3. **Node.js y NPM**: Para compilar recursos frontend.
4. **Base de datos PostgreSQL**: Asegúrate de tener PostgreSQL instalado y en funcionamiento.
5. **Pusher**: Cuenta configurada en [Pusher](https://pusher.com/).

---

## Instalación

1. **Clonar el repositorio**

   ```bash
   git clone <URL_DEL_REPOSITORIO>
   cd <NOMBRE_DEL_PROYECTO>
   ```

2. **Instalar dependencias PHP**

   Ejecuta el siguiente comando para instalar las dependencias del backend:

   ```bash
   composer install
   ```

3. **Instalar dependencias de Node.js**

   Ejecuta el siguiente comando para instalar las dependencias del frontend:

   ```bash
   npm install
   ```

4. **Configurar el archivo `.env`**

   Copia el archivo de ejemplo `.env.example` y renómbralo como `.env`:

   ```bash
   cp .env.example .env
   ```

   ### Configuración para PostgreSQL

   Asegúrate de configurar la base de datos PostgreSQL en el archivo `.env`:

   ```env
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=nombre_base_datos
   DB_USERNAME=usuario_postgres
   DB_PASSWORD=contraseña_postgres
   ```

   ### Configuración de Pusher

   Este proyecto utiliza Pusher para manejar WebSockets. Asegúrate de configurar las credenciales de tu cuenta de Pusher:

   ```env
   PUSHER_APP_ID=tu_app_id
   PUSHER_APP_KEY=tu_app_key
   PUSHER_APP_SECRET=tu_app_secret
   PUSHER_APP_CLUSTER=tu_cluster
   BROADCAST_DRIVER=pusher
   ```

5. **Generar la clave de la aplicación**

   Ejecuta el siguiente comando para generar una clave para la aplicación:

   ```bash
   php artisan key:generate
   ```

6. **Migrar la base de datos**

   Ejecuta las migraciones para configurar las tablas en la base de datos:

   ```bash
   php artisan migrate
   ```

7. **Cargar datos iniciales (Seeders)**

   Si necesitas cargar datos iniciales en la base de datos, ejecuta el siguiente comando:

   ```bash
   php artisan db:seed
   ```

8. **Compilar recursos frontend**

   Compila los recursos estáticos (CSS y JS):

   ```bash
   npm run dev
   ```
   Si estás en un entorno de producción, usa:

   ```bash
   npm run build
   ```

9. **Iniciar el servidor de desarrollo**

   Levanta el servidor de desarrollo de Laravel:

   ```bash
   php artisan serve
   ```

   Por defecto, el servidor estará disponible en `http://127.0.0.1:8000`.

---


