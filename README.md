# 💡✏️ Proyecto de Luces Inteligentes con IoT y Monitoreo Web 🌐

Este proyecto es parte de una evaluación práctica, que consiste en implementar un sistema de luces inteligentes que monitorea el entorno mediante un sensor ultrasónico y registra los datos en una base de datos. Los datos recolectados son posteriormente visualizados en una interfaz web, proporcionando un monitoreo en tiempo real y un historial de las interacciones del sistema.

## 🗂️ Crea la base de datos

```sql
CREATE DATABASE IF NOT EXISTS smart_lights;

USE smart_lights;

CREATE TABLE IF NOT EXISTS light_1 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,
    time TIME NOT NULL,
    value TINYINT NOT NULL
);
```

## 🚀 Importar el script SQL que esta dentro de docs/
Este repositorio incluye un archivo smart_lights.sql que:

Crea la tabla light_1

Inserta registros históricos de prueba

Establece índices y AUTO_INCREMENT

#### Puedes importarlo desde phpMyAdmin