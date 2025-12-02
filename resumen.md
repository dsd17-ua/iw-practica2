# Resumen del Proyecto – Gimnasio / Centro Deportivo

## 1. Descripción general
Un gimnasio solicita el desarrollo de una nueva web donde mostrar información del centro (fotos, contacto, instalaciones, tarifas, cómo hacerse socio, etc.).
La web incluirá una zona pública y una zona privada con perfiles diferenciados.

---

## 2. Web pública
La web pública deberá mostrar:
- Información general del gimnasio
- Fotos
- Instalaciones y servicios
- Tarifas y tipos de socio
- Página de contacto
- Cómo hacerse socio

### Tipos de plan

- Basic: 19,99€/mes. Acceso a gimnasio, acceso a actividades básicas, acceso a vestuarios y duchas, app móvil.
- Pro: 29,99€/mes. Plan Basic + acceso a actividades pro, descuentos en tienda, invitaciones para amigos, acceso a sauna y piscina, prioridad para asistir a actividades.
- Platino:  Plan Pro + acceso a spa, monitores personalizado, programa nutricional, toalla y acceso a taquilla gratuita, parking gratis.

Además:
- Los usuarios no registrados podrán **enviar una solicitud para ser socio**.
- Una vez enviado el formulario, el webmaster deberá aceptar al usuario.
- Una vez aceptado, se le enviará al usuario un mail con un enlace donde se pasará a la TPVV para elegir el tipo de plan que quiere el socio.

---

## 3. Web privada – Perfil *Socio*
Los socios serán usuarios registrados con acceso privado. Tendrán las siguientes funcionalidades:


### Reservas de actividades con monitor
- Consultar actividades disponibles (Spinning, Crossfit, etc.).
- Reservar plaza en una actividad.
- Si una actividad tiene un plan superior,no se podrá acceder y habría que mejorar el plan.

### Gestión del plan
- El socio deberá tener asociado un método de pago para poder contratar un plan.
- Si no tiene un método de pago actualizado, se le cancelará su suscripción y no podrá acceder al gimnasio.
- Podrá cambiar su plan mensual a través del TPVV con su pasarela de pago.

### Actividades dependiendo del plan
- Se comprueba el plan actual del usuario y solo dejará reservar si el plan es el correcto.
- Si el socio no tiene el plan correcto, se le llevará a una pantalla para que cambie el plan y lo pague.

---

## 4. Web privada – Perfil *Webmaster* (Administrador)
El webmaster tendrá control total del sistema. Podrá:

### Gestión de socios
- Aceptar o bloquear solicitudes de socio.
- Activar o desactivar cuentas.

### Gestión de actividades
- Crear actividades puntuales o periódicas.
- Establecer horarios, sala y monitor asignado.

### Informes y estadísticas
- Ver informes del uso de instalaciones.
- Consultar informes de actividades realizadas por los socios.

---

## 5. Web privada – Perfil *Monitor* (Opcional)
Un monitor podrá:
- Consultar las actividades que debe impartir.
- Ver su calendario (día, hora, sala).
- Añadir nuevas actividades (si se habilita).

---

## 7. Interoperación obligatoria
El proyecto debe comunicarse con sistemas externos de compañeros.

### TPV Virtual (TPVV)
- Para que los socios cambien su tipo de plan.

### Mostrar productos de una tienda online
En la web del gimnasio se deberá mostrar, al menos:
- Categorías
- Productos de una tienda online (otro grupo)

---

