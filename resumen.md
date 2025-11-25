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

Además:
- Los usuarios no registrados podrán **enviar una solicitud para ser socio**.
- Las solicitudes deberán ser **aceptadas o rechazadas** por un administrador (webmaster).

---

## 3. Web privada – Perfil *Socio*
Los socios serán usuarios registrados con acceso privado. Tendrán las siguientes funcionalidades:

### Acceso a instalaciones
- Entrada gratuita a las salas generales (musculación, bicicletas, etc.).

### Reservas de actividades con monitor
- Consultar actividades disponibles (Spinning, Crossfit, etc.).
- Reservar plaza en una actividad.
- Si una actividad tiene coste extra, este se **descontará del saldo del socio**.

### Gestión del saldo
- El socio deberá tener saldo suficiente para reservar actividades con coste.
- Si no tiene saldo, **no podrá reservar**.
- Podrá **recargar saldo mediante un TPVV** (interoperación obligatoria).

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

## 6. Reservas y pagos
### Actividades gratuitas
- No requieren saldo.

### Actividades con coste extra
- Se descuenta automáticamente del saldo del socio.
- Si el socio no tiene saldo → **la reserva se bloquea**.

### Recargar saldo
- El socio podrá recargar mediante **TPVV** (pasarela de pago).
- El TPVV forma parte de la **interoperación obligatoria** del proyecto.

---

## 7. Interoperación obligatoria
El proyecto debe comunicarse con sistemas externos mediante API.

### TPV Virtual (TPVV)
- Para que los socios recarguen saldo usando tarjeta.
- Puede ser: el TPV de otro grupo o un TPV online de ejemplo (API).

### Mostrar productos de una tienda online
En la web del gimnasio se deberá mostrar, al menos:
- Categorías
- Productos de una tienda online (otro grupo)

La integración será **vía API REST**, no vía base de datos compartida.

---

## 8. Funcionalidades principales (resumen)
- Web pública informativa
- Solicitud de socio
- Registro/login de socios aceptados
- Perfil socio: reservas, saldo, TPV
- Perfil administrador: socios, actividades, informes
- Perfil monitor (opcional)
- Interoperación TPV
- Interoperación Tienda online
