## Kuroinku.

*Kuroinku* es un proyecto que inicié hace aproximadamente 1 año (Mediados de 2017) con 2 compañeros de la universidad. En un comienzo queriamos hacer una red social donde se pudieran publicar mangas y así conectar a muchas personas con estos gustos. Pero con el pasar del tiempo este proyecto comenzó a transformarse en una especie de foro para realizar preguntas y siguerencias.

Mis dos amigos a penas comenzaban a cursar el 1er semestre y no sabian nada de programación, así que me ofrecí a crear toda la plataforma solo. Luego de los avances que habia hecho ellos se olvidaron del proyecto y perdí la motivación al hacerlo solo. 

Sin embargo *Kuroinku* ha sido uno de mis proyectos más serios, y le agarré cariño.

### Descripción General.
En *Kuroinku* se podrá:
- Crear usuario.
- Crear temas (Pueden tener imágenes).
- Chat privado en tiempo real.
- Perfil.
- Usuarios Verificados.
- Leer Mangas.
- Notificaciones de tus publicaciones, nuevos seguimientos y mensajes.
- Crear temas.
- Responder temas de otros usuarios.

### Usuarios.
*Kuroinku* cuenta con 3 roles de usuarios:
	- Usuario.
	- Editor.
	- Administrador.

### Vistas.
- Login:
	- Cuenta con una pequeña y muy creativa introducción a la plataforma.
	- Sección de *¿Qué es Kuroinku* (Nunca fué terminada).
	- Modal de inicio de sesión.
	- Modal de registro.
	- Sección de Contáctanos (Nunca fué terminada).

- Inicio:
	- Crear tema:
		- Título.
		- Descripción del tema.
		- Categoria: `Consulta, Opinión, Recomendación`.


	- Timeline:
		- Muestra los temas publicados: Temas de todos los usuarios (Sean o no seguidores)
		- En la parte inferior del tema publicado se encuentra la cantidad de respuestas de dicho tema y un link para ir al tema.

	- Ultimos Mangas: se muestran los 6 ultimos mangas publicados.

	- Ultimas Noticias: se muestras las ultimas noticias ya sea de mangas o noticias de la plataforma.

- Tema:
	- Usuario creador del tema.
	- Fecha de creación.
	- Título.
	- Descripción.
	- Responder.
	- Lista de respuestas.

- Noticias:
	- Ver Noticias Mangas.
	- Ver Noticias *Kuroinku*.
	- Publicar Noticias Mangas `(Unicamente usuarios con el rol Administrador)`.
	- Publicar Noticias *Kuroinku* `(Unicamente usuarios con el rol Administrador)`.

- Chat: Chat en tiempo real con miembros de la plataforma.

- Mangas:
	- Todos:
		- Buscar Mangas.
		- Elegir Categoria.
		- Lista de Mangas Publicados `(Usuarios con el rol de Administrador podran ver una lista de mangas no publicados, así como también marcarlos como publicados)`.
		- Marcar Manga como Favorito.
		- Subir Mangas `(Unicamente usuarios con el rol Administrador)`:
			- Detalles del Manga: Nombre, género, temporada, estado (En curso, finalizado), creador, fecha de publicación y una portada. Luego de subir un manga este por defecto se marca como Manga `No publicado` ya que es un Manga vacio, tendrás que subir los capitulos. También en esta sección podras marcar el manga como `En curso` o ` Publicado` cada vez que sea necesario.
			- Subir Capítulo:  Se debe colocar el numero del capitulo, el nombre, los creditos de la fuente del capitulo y por ultimo el link de dicho fuente. Por defecto se crea como Capitulo `No publicado` ya que el capitulo está vacio.
			- Subir pagina: A esta sección se accede luego de haber creado el capítulo. Se necesita colocar el número de la página y el archivo de la página.

- Grupos: Esta sección tiene la intención de conectar a muchas personas con gustos es común, ya sea por categoria o Manga (Nunca fué terminada).

- Usuarios: En esta sección los `usuarios con el rol Administrador` podrán administrar a el rol de cada usuario, así como tambien betar usuarios, también se podran marcar usuarios como *Verificado*.

- Perfil:
	- Muestra información del usuario.
	- Muestra seguidores y seguidos".
	- Permite seguir o dejar de seguir.
	- Permite enviar mensaje privado.
	- Sección para crear un tema.
	- Timeline de ese usuario.
	- Sección para editar perfil.
	- Cambiar foto de perfil.

### Tecnologias usadas.
*Kuroinku* fue creado en `PHP` puro sin ningún tipo de framework, implementa `Admintle` con bootstrap, JQuery, Ajax y la base de datos en `MySQL`.