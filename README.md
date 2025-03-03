# 🗣️ Foro de la Comunidad

## 📝 Descripción

Un foro de la comunidad moderno y funcional construido con Laravel y Tailwind CSS. La plataforma permite a los usuarios crear temas de discusión, responder a otros usuarios, votar respuestas y marcar soluciones a los temas planteados.

## 📸 Capturas de Pantalla

### 🏠 Página Principal

![Página Principal](/screenshots/home.png)
_Vista del listado de temas con estadísticas y estado de resolución_

### 💬 Detalle de Tema

![Detalle de Tema](/screenshots/thread.png)
_Vista detallada de un tema con sus respuestas y sistema de votación_

### ✍️ Crear Tema

![Crear Tema](/screenshots/create.png)
_Formulario para crear un nuevo tema de discusión_

### 🔐 Inicio de Sesión

![Inicio de Sesión](/screenshots/login.png)
_Página de inicio de sesión para usuarios registrados_

### 📝 Registro de Usuario

![Registro de Usuario](/screenshots/register.png)
_Formulario de registro para nuevos usuarios_

### 👤 Perfil de Usuario

![Perfil](/screenshots/profile.png)
_Panel de control del usuario con opciones de configuración_

## 🚀 Tecnologías Utilizadas

-   🎯 Laravel 10 como framework backend
-   🎨 Tailwind CSS para el diseño
-   🔐 Sistema de autenticación de Laravel Breeze
-   💾 SQLite como base de datos
-   🔄 Vite para el bundling de assets

## 🛠️ Características Principales

-   📝 Creación y gestión de temas
-   💭 Sistema de respuestas
-   👍 Votación de respuestas (upvote/downvote)
-   ✅ Marcado de soluciones
-   👀 Contador de vistas
-   🔍 Listado de temas con paginación
-   🎨 Diseño responsive
-   🔒 Sistema de autenticación completo

## ⚙️ Requisitos Previos

-   PHP 8.1 o superior
-   Composer
-   Node.js y npm
-   SQLite

## 🚀 Instalación

1. Clonar el repositorio

```bash
git clone https://github.com/MichaelVairoDev/Community_Forum.git
cd Community_Forum
```

2. Instalar dependencias de PHP

```bash
composer install
```

3. Instalar dependencias de Node.js

```bash
npm install
```

4. Configurar el entorno

```bash
cp .env.example .env
php artisan key:generate
```

5. Configurar la base de datos en .env

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

6. Crear la base de datos y ejecutar migraciones

```bash
touch database/database.sqlite
php artisan migrate
```

7. Compilar assets

```bash
npm run build
```

8. Iniciar el servidor

```bash
php artisan serve
```

## 🔍 Estructura de la Base de Datos

### Tablas Principales

-   👥 users - Usuarios del sistema
-   📝 threads - Temas de discusión
-   💬 replies - Respuestas a los temas
-   👍 votes - Votos en las respuestas

## 📝 API Endpoints

### Temas

-   GET /threads - Obtener todos los temas
-   GET /threads/{id} - Obtener un tema específico
-   POST /threads - Crear un nuevo tema
-   PATCH /threads/{id} - Actualizar un tema
-   DELETE /threads/{id} - Eliminar un tema

### Respuestas

-   POST /threads/{thread}/replies - Crear una respuesta
-   PATCH /replies/{reply} - Actualizar una respuesta
-   DELETE /replies/{reply} - Eliminar una respuesta
-   POST /replies/{reply}/solution - Marcar como solución
-   POST /replies/{reply}/vote - Votar una respuesta

## 📄 Licencia

Este proyecto está bajo la Licencia MIT.

---

⌨️ con ❤️ por [Michael Vairo]
