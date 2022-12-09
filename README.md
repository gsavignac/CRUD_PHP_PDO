# Sistema básico en PHP

En este módulo se muestran las funciones básicas de un CRUD (Agregar, Editar, Eliminar y Listar), utilizando PHP y una estructura de trabajo de modelo, vista y controlador (MVC) y con conexión a una base de datos en PostgreSQL.

En este ejemplo se tienen dos formas de realizar las mismas operaciones:

1. En primer lugar se tiene una clase que permite manejar los procesos del CRUD con funciones de PHP nativo **class/class_conexion.php**. 
2. Y en segundo lugar se tiene un ejemplo de como trabajar los mismos procesos pero utilizando la extensión Objetos de Datos de PHP ( PDO por sus siglás en inglés), este ejemplo lo podemos vesualizar en el modulo llamada **PRUEBA**.

El sistema tiene un menú de navegación que se construye de manera dinámica de acuerdo a los modulos que se encuentran dentro del directorio **modules/**, excluyendo el modulo de **login** que solo se utiliza para el manejo de la inicio de sesión de usuarios en el sistema.


## instalación

Para instalar el sistema necesitas tener:

* PHP 5.6 o superior.
* PostgreSQL 11 o superior.
* y tener configurado un servidor web como apache para poder levantarlo.

### Datos de conexión a la base de datos

Para poder conectarte a la base de datos, se debe modificar el archivo de constantes que se encuentra en el directorio **config/constantes.php**

```
	define("BD","CRUD");
    define("SERVIDOR","localhost");
    define("USUARIO","postgres");
    define("CLAVE","123456");
    define("PUERTO","5432");
```

### Restaurar la base de datos

En el directorio raíz del sistema se encuentra el archivo **CRUD.backup** y **CRUD.sql** los cuales permitiran restaurar la base de datos del sistema. Se puede utilizar cualquier de los dos.

### Acceder al sistema

**Usuario:** admin
**Clave:** admin

## estructura de directorios

```
	class/ => contien las clases de conexión
	config/ => tiene las constantes con los datos de conexión a la base de datos
	controllers/ => se almacenan los controladores utilizados para cada modulo
	css/ => los estilos del sistema
	img/ => imagenes del sistema
	js/ => funciones básicas del sistema en javascript
	lib/ => librerias (bootstrap, fontawesome, sweetalert, ...)
	modules/ => modulos del sistema
```

Los módulos contienen un directorio para las clases, uno para las validaciones de Javascript y la vista

```
	modules/
		prueba/
			class/
				prueba.php
			js/
				pruebas.js
			view/
				pruebas.php
```

Cabe recordar que este es un proyecto muy básico en PHP y que carece de funcionalidades más compleja que podrian ayudar a que los procesos sean más eficientes, pero se puede prestar para aprender un poco como manejar los procesos de un CRUD en PHP y crear nuevos proyectos a partir de aqui.

Contacto: gustavo.savignac@gmail.com