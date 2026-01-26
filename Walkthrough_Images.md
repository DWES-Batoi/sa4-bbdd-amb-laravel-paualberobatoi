# Walkthrough - Implementación de Imágenes para Equipos y Jugadoras

He actualizado los Seeders (`EquipsSeeder` y `JugadorasSeeder`) para que descarguen y asignen imágenes automáticamente.

## ¿Qué hace ahora el sistema?

1.  **Equipos con Escudos Reales**:
    - Al ejecutar el seeder, el sistema descarga los escudos oficiales de Wikipedia (Barça, Madrid, Atleti...) y los guarda en `storage/app/public/escuts`.
    - Si falla la descarga, genera un escudo con las iniciales usando `ui-avatars.com`.

2.  **Jugadoras con Fotos Realistas**:
    - Las "estrellas" (Alexia, Aitana...) y el resto de jugadoras generadas tendrán una foto de perfil única generada por `i.pravatar.cc` (personas reales aleatorias) o `ui-avatars` como fallback.
    - Se guardan en `storage/app/public/jugadoras`.

## Cómo activar los cambios

Como no tengo acceso directo a tu Docker, debes ejecutar tú el comando para repoblar la base de datos:

```bash
make artisan CMD="migrate:fresh --seed"
```

Este comando:
1.  Borrará la base de datos actual.
2.  Creará las tablas de nuevo.
3.  **Ejecutará los seeders nuevos**, descargando todas las imágenes (puede tardar unos segundos/minutos dependiendo de tu internet).

### Verificar visualización
Asegúrate de que el enlace simbólico de public storage esté creado:

```bash
make artisan CMD="storage:link"
```

Ahora, al listar equipos o jugadoras (vía API o Web), verás rutas como `/storage/escuts/fc-barcelona.png` o `/storage/jugadoras/alexia-putellas.jpg`.
