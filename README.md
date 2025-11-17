# Proyecto “Gimnasio / Centro Deportivo”
---
## 🎯 Objetivo

Desarrollar una aplicación web completa para un gimnasio: gestión de usuarios, actividades, reservas, monitores, pagos, etc., incluyendo backoffice, seguridad, y interoperación con otros sistemas de la clase.

---


## 1️⃣ Qué hay que hacer?

Crear una aplicación web en Laravel que incluya:

- Registro e inicio/cierre de sesión

- Perfiles de usuario (ej: Cliente, Monitor, Administrador)

- Web pública (información general del gimnasio)

- Zona privada (reservas, actividades, etc.)

- Backoffice (mínimo 2 CRUDs)

- Dashboard con datos relevantes

- Navegación completa (mínimo 2 niveles)

- Seeds con datos de ejemplo para la demo

- Interoperación con una tienda online (u otro sistema compatible)

Para gimnasios, la interoperación más típica es:
El gimnasio puede consultar productos de la tienda (ropa, suplementos, etc.)
o bien vender bonos del gimnasio a través de una tienda de compañeros.

---

## 2️⃣ Tecnologías decididas

✔ Backend: Laravel 10+

    Rutas web + API

    Controladores

    Modelos + Eloquent

    Autenticación (Laravel Breeze / Laravel UI / Fortify)

    Middleware de roles

    Migraciones + Seeds + Factories

✔ Frontend:

    Blade templates

    HTML5 / CSS3

    JS (vanilla)

    Layout con @extends + @yield

    Componentes Blade si queréis (opcional)

✔ Base de datos:

    MySQL o MariaDB → lo más cómodo con Laravel

---

## 3️⃣ Funciones que debería tener el gimnasio


🟢 Web pública

    Información del gimnasio

    Actividades ofrecidas

    Horarios

    Precios / cuotas

🟢 Zona privada — Clientes

    Ver actividades disponibles

    Reservar una clase

    Cancelar reserva

    Consultar reservas activas

    Editar perfil

🟢 Zona privada — Personal/Monitores

    Ver alumnos apuntados

    Ver su calendario de clases

    Editar la información de una actividad que imparten

🟢 Backoffice — Administrador

    Mínimo 2 CRUDs obligatorios, por ejemplo:

    CRUD de actividades

    CRUD de monitores

    CRUD de salas

    CRUD de usuarios (opcional)

---


## 5️⃣ Qué hay que entregar
### 📄 1. Memoria

Debe contener:

    🔹 Introducción

        Qué problema resuelve el sistema

        Objetivos del gimnasio

    🔹 Arquitectura

        Laravel + Blade

        MVC

        BD MySQL

        API para interoperación

    🔹 Mockups (Figma)

        De:

        Inicio

        Login

        Dashboard

        CRUDs

        Reservas

    🔹 Patrones de diseño web aplicados

        Single Layout

        Menú persistente

        Patrones de navegación

        Patrones de formulario

        Paginación, listados, etc.

    🔹 Diagramas obligatorios

        E/R o diagrama de BD

        Casos de uso

        Diagrama de clases (Laravel Eloquent)

        Diagrama de módulos

    🔹 Metodología

        SCRUM (iterativo)

        Sprints semanales

        Tablero de GitHub Projects

    🔹 Implementación

        Roles + Middleware

        Migraciones

        Seeds

        Controladores

        API de interoperación

    🔹 Problemas encontrados
    🔹 Mejoras futuras
    🔹 Referencias
### 💻 2. Proyecto Laravel funcional

    Repositorio GitHub

    README técnico

    Seeds incluidos

    CRUDs operativos

    Login + roles

    Dashboard

    Integración API con compañeros

### 🔗 3. Tablero de tareas

GitHub Projects

---

## 6️⃣ Planificación personalizada (Laravel + Gimnasio)
### 🕒 Sprint 0 – 11 noviembre

    Elegir proyecto (hecho)

    Elegir tecnologías (hecho: Laravel)

    Funcionalidades del gimnasio

    Casos de uso

    Requisitos

    Historias de usuario

### 🕒 Sprint 1 – 18 noviembre

    Revisar:

        Casos de uso

        Requisitos

        Historias

    Hacer:

        Mockups principales (Figma)

        Modelo BD: Actividades, Salas, Monitores, Reservas, Usuarios

        Crear proyecto Laravel

        Configurar entorno + GitHub repo

### 🕒 Sprint 2 – 25 noviembre

    Revisar:

        Mockups

        BD

        Entorno Laravel funcionando

        Hacer:

        Migraciones (crear tablas)

        Seeds

        Layout principal (Blade)

        Rutas + Controladores base

### 🕒 Sprint 3 – 2 diciembre

    Revisar:

        BD creada 

        Seeds 

        Laravel funcionando

    Hacer:

        Web pública (Landing, Actividades)

        Autenticación: login/logout/registro

        Middleware: roles y seguridad

### 🕒 Sprint 4 y 5 – 9 y 16 diciembre

    Hacer:

        CRUDs administrador

        Dashboard perfiles

        Reservas

        Integración con API externa (tienda)
