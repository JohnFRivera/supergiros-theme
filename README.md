# Tema Intranet SuperGIROS Norte del Valle

Este repositorio contiene un **tema personalizado de WordPress** desarrollado exclusivamente para la **intranet de SuperGIROS Norte del Valle**. El objetivo principal de este tema es proporcionar una experiencia interna optimizada, intuitiva y alineada con la identidad visual corporativa de la empresa.

---

## Estructura del Proyecto

```bash
Intranet/
│
├── assets/ # Recursos estáticos (CSS, imágenes, librerías de terceros)
├── components/ # Componentes reutilizables divididos por contexto (header, footer, index, etc.)
├── inc/ # Clases PHP para controladores, encolado de scripts, rutas, login y shortcodes
├── js/ # Scripts JavaScript organizados por secciones y funcionalidades
├── templates/ # Plantillas específicas para archives y entradas individuales
│
├── 404.php # Página de error 404
├── archive.php # Plantilla genérica para archivos
├── footer.php # Pie de página global
├── functions.php # Registro de funcionalidades del tema
├── header.php # Encabezado global
├── index.php # Plantilla principal
├── page.php # Plantilla genérica de páginas
├── search.php # Resultados de búsqueda
├── single.php # Plantilla genérica de entradas individuales
├── style.css # Hoja de estilos principal
├── block-editor-style.css# Estilos personalizados para el editor de bloques
├── screenshot.jpg # Imagen previa del tema
└── README.md # Este archivo
```

---

## Tecnologías Utilizadas

- **WordPress** como CMS base.
- **Bootstrap 5** para estilos y componentes UI.
- **Bootstrap Icons** para iconografía ligera.
- **JavaScript Vanilla** para interacción y lógica de front-end.
- **SCSS (parcial)** para personalización avanzada de estilos.
- **Custom PHP Classes** para modularizar la lógica del backend.

---

## Funcionalidades Clave

- Estructura modular de componentes reutilizables (`components/`).
- Archivos de plantilla personalizados para tipos de contenido (`templates/`).
- Simulador de chances, visualizador de noticias y más funcionalidades dinámicas.
- Optimización para uso en red corporativa (carga rápida y diseño limpio).
- Compatible con el editor de bloques de WordPress (Gutenberg).

---

## Instalación

1. Clona o descarga este repositorio en el directorio `wp-content/themes/` de tu instalación de WordPress.
2. Activa el tema desde el panel de administración de WordPress.
3. Asegúrate de tener habilitados los tipos de contenido y taxonomías necesarias.
4. Personaliza desde el personalizador de WordPress si es necesario.

```bash
cd wp-content/themes/
git clone https://github.com/JohnFRivera/supergiros-theme.git
```

---

## Notas

- Este tema está diseñado exclusivamente para uso interno dentro de la empresa.
- No está pensado para ser utilizado como tema público o distribuido comercialmente.
- Para cambios en funcionalidades principales, consulta el archivo `functions.php` o la carpeta `inc/`.

---

## Autor

Desarrollado por [John Freddy Rivera](https://www.linkedin.com/in/john-freddy-rivera-ayala/) en el área de TI de **SuperGIROS Norte del Valle**

---

## Licencia

Este proyecto es de uso interno. Todos los derechos reservados © SuperGIROS Norte del Valle.
