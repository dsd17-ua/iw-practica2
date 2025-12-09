# Funcionalidades Gimnasio / Centro Deportivo

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

Además:
- Los usuarios no registrados podrán **enviar una solicitud para ser socio**.
- Las solicitudes deberán ser **aceptadas o rechazadas** por un administrador (webmaster).

---

## 3. Web privada – Perfil *Socio*
Los socios serán usuarios registrados con acceso privado. Tendrán las siguientes funcionalidades:


### Reservas de actividades con monitor
- Consultar actividades disponibles (Spinning, Crossfit, etc.).
- Reservar plaza en una actividad. El socio deberá tener saldo suficiente para reservar actividades con  coste. Si no tiene saldo, **no podrá reservar**.
- Si una actividad tiene coste extra, este se **descontará del saldo del socio**.

Hay distintos tipos de actividades:

**Actividades gratuitas:**
- No requieren saldo. Se le dará a un botón de reservar y no se pagará nada.

**Actividades con coste extra:**
- Se descuenta automáticamente del saldo del socio.
- Si el socio no tiene saldo → **la reserva se bloquea** y se le redirige a la pagina de recargar saldo.

### Gestión del saldo
- Podrá **recargar saldo mediante un TPVV**.
- Podrá **consultar el saldo disponible**
- Podrá **ver un histórico de pagos** realizados al gimnasio.

### Elegir tipo de plan
- Podrá elegir entre distintos tipos de tarifa para el acceso ilimitado a clases o actividades. Dependiendo de la tarifa, podrás acceder a más o menos actividades gratis. Habrá dos planes en el gimnasio.
    - Plan básico: 30€/mes. En este plan incluye la tarifa mensual de acceso al gimnasio, además de la posibilidad de acceder a 2 clases que tienen coste extra, de manera gratuita, cada mes.
    - Plan Premium: 45€/mes. En este plan incluye la tarifa mensual de acceso al gimnaiso, además de la posibilidad de acceder a 6 clases con que tienen coste extra, de manera gratuita, al mes.


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
- Ver su calendario (día, hora, sala). Podra revisar un histórico para ver todas las clases que ha implemnetado en el tiempo.

---

## 7. Interoperación obligatoria
El proyecto debe comunicarse con sistemas externos mediante API.

### TPV Virtual (TPVV)
- Para que los socios recarguen saldo usando tarjeta.
- Puede ser: el TPV de otro grupo o un TPV online de ejemplo (API).

### Mostrar productos de una tienda online
En la web del gimnasio se deberá mostrar, al menos:
- Categorías
- Filtros de búsqueda.
- Productos de una tienda online (otro grupo)

---
