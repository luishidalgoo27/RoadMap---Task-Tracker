# 🧰 Task Tracker CLI con MySQL

Este proyecto es una implementación del reto propuesto por [roadmap.sh: Task Tracker CLI](https://roadmap.sh/projects/task-tracker), con una modificación importante: en lugar de usar un archivo JSON para guardar las tareas, se utiliza una **base de datos MySQL**.

## 🔗 Enlace al reto original

👉 [Task Tracker en roadmap.sh](https://roadmap.sh/projects/task-tracker)

## 📋 Descripción

Este es un pequeño gestor de tareas por línea de comandos que permite:

- Añadir, actualizar y eliminar tareas
- Marcar tareas como "en progreso" o "completadas"
- Listar tareas según su estado (`todo`, `in-progress`, `done`)

## 🚀 Versiones

Esta tarea tiene dos versiones: 
- Guarda las tareas en una **base de datos MySQL**, lo que permite un mejor manejo de datos en proyectos más grandes o colaborativos.
- Manipula un archivo **JSON**, puedes probarla en el archivo tasks.php, ejecutandolo te saltará una ayuda sobre el funcionamiento de ella.

## 🏗️ Funcionalidades principales

- `add "Nombre"` → Añadir una nueva tarea
- `update <id> "Nuevo Nombre"` → Actualizar la descripción
- `delete <id>` → Eliminar una tarea
- `mark-in-progress <id>` → Marcar como "en progreso"
- `mark-done <id>` → Marcar como "completada"
- `list` → Mostrar todas las tareas
- `list-done` / `list-todo` / `list-in-progress` → Filtrar tareas por estado

## 🧱 Estructura de la tabla en MySQL

```sql
CREATE TABLE tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name TEXT NOT NULL,
  status ENUM('todo', 'in-progress', 'done') DEFAULT 'todo',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
