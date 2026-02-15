
# Backend – Gestión de Patentes (Laravel 10)

Backend desarrollado en **Laravel 10** para la gestión de **patentes comerciales** en la Ilustre Municipalidad de La Serena.

El sistema digitaliza el proceso administrativo tradicional (AS-IS → TO-BE), centraliza la información y optimiza tiempos operativos mediante carga masiva de datos y generación automática de reportes.

---

## ✨ Funcionalidades

- ✅ Autenticación de usuarios (Laravel 10)
- ✅ CRUD completo de patentes
- ✅ Gestión de estado de patentes (habilitada / deshabilitada)
- ✅ Gestión de inspecciones asociadas
- ✅ Importación masiva de patentes desde **Excel** (formato municipal definido)
- ✅ Validaciones de datos durante el proceso de importación
- ✅ Generación automática de reportes administrativos en **PDF**
- ✅ Persistencia en **MySQL**
- ✅ API / endpoints para consumo desde frontend o sistemas externos

---

## 📊 Enfoque del Proyecto

El sistema fue desarrollado como parte de un rediseño del proceso administrativo:

- Modelado del proceso actual (AS-IS)
- Identificación de ineficiencias y reprocesos
- Definición de proceso optimizado (TO-BE)
- Implementación digital con control de estados y trazabilidad

El sistema permite una reducción significativa de horas-hombre operativas mediante la automatización del ingreso y gestión de información.

---

## 🧰 Tecnologías

- Laravel 10 (PHP)
- MySQL
- Git / GitHub
- Importación de Excel (maatwebsite/excel)
- Generación de reportes PDF (Laravel DOMPDF o similar)

---

## ⚙️ Requisitos

- PHP 8.1+
- Composer
- MySQL
- Node + NPM (si aplica para assets)

---

## 🚀 Instalación y ejecución

1. Clonar repositorio:

```bash
git clone https://github.com/KevinsIMmk/backend-sistema-patentes.git
cd backend-sistema-patentes

2. Instalar dependencias:
composer install

3.Crear archivo de entorno:
cp .env.example .env

4.Generar key:
php artisan key:generate

5. Configurar base de datos en .env

6. Ejecutar migraciones
php artisan migrate

7. Levantar servidor:
php artisan serve



## 📁 Documentación

Este repositorio incluye como documentación adicional la presentación del proyecto en formato PowerPoint, donde se explica:

- Problemática identificada  
- Modelado AS-IS  
- Rediseño TO-BE  
- Comparación de eficiencia  
- Arquitectura del sistema  
- Metodología de desarrollo  
- Resultados obtenidos  

📎 [Ver Presentación del Proyecto](./Titulo.pptx)
Autor

Kevin Yair Irigoyen Martínez
Ingeniero en Informática
GitHub: https://github.com/KevinsIMmk
