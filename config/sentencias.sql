create database kuroinku;

use kuroinku;

create table usuario(
	id int auto_increment not null primary key,
	usuario varchar(40) not null unique,
	contra varchar(40) not null,
	nombre varchar(50) default 'Anonimo' not null,
	apellido varchar(50) not null,
	sexo varchar(20) not null,
	check (sexo in('Masculino','Femenino','Prefiero no decirlo')),
	correo varchar(60) not null unique,
	verifi_correo int default 0 not null,
	direccion varchar(60),
	facebook varchar(60),
	twitter varchar(60),
	instagram varchar(60),
	foto varchar(120) default 'perfil.png' not null,
	tipo int default 0 not null,
	fecha_reg datetime not null,
	fecha_nac date,
	verificado int default 0 not null,
	editor int default 0 not null,
	admin int default 0 not null,
	betado int default 0 not null
);

create table manga(
	id int auto_increment not null primary key,	
	nombre varchar(60) not null,
	portada varchar(120) default 'portada.jpg' not null,
	genero varchar(120) not null,
	temporada int default 1 not null,
	estado varchar(10) default 'En curso' not null,
	check (estado in('Finalizado','En curso')),
	creador varchar(60) default'Desconocido' not null,
	fecha_pub date,
	id_usuario int not null,
	publicado int default 0 not null,
	foreign key (id_usuario) references usuario(id)
	on delete no action on update cascade
);

create table capitulo(
	cap int not null,
	nombre varchar(120) not null,
	id_manga int not null,
	fecha_sub date not null,
	publicado int default '0' not null,
	creditos varchar(80) default null,
	url_creditos varchar(120) default null,
	foreign key (id_manga) references manga(id)
	on delete cascade on update cascade,
	primary key (cap, id_manga)
);

create table pagina(
	id int auto_increment not null primary key,
	cap int not null,
	id_manga int not null,
	img varchar(120) not null,
	pag int  not null,
	foreign key (id_manga) references manga(id)
	on delete cascade on update cascade,
	foreign key (cap) references capitulo(cap)
	on delete cascade on update cascade
);

/*create table grupo(
	id int auto_increment not null primary key,
	nombre varchar(50) default'Sin Nombre' not null,
	fecha_crea date not null,
	id_usuario int,
	id_manga int,
	foreign key(id_usuario) references usuario(id)
	on delete no action on update cascade,
	foreign key(id_manga) references manga(id)
	on delete cascade on update cascade
);*/

/*create table imagen(
	id int auto_increment not null primary key,
	img varchar(120) not null,
	id_grupo int,
	id_chat int,
	foreign key(id_grupo) references grupo(id)
	on delete cascade on update cascade,
	foreign key(id_chat) references chat(id)
	on delete cascade on update cascade
);*/

create table opinion(
	id int auto_increment not null primary key,
	id_usuario int not null,
	id_manga int not null,
	opinion varchar(1000),
	puntuacion int,
	fecha datetime not null,
	desactivada int default 0 not null,
	foreign key(id_usuario) references usuario(id)
	on delete no action on update cascade,
	foreign key(id_manga) references manga(id)
	on delete cascade on update cascade
);

/*create table mensajes(
	id int auto_increment primary key,
	fecha date not null,
	hora time not null,
	mensaje varchar(1000),
	id_grupo int,
	id_chat int,
	id_usuario int,
	foreign key(id_grupo) references grupo(id)
	on delete cascade on update cascade,
	foreign key(id_usuario) references usuario(id)
	on delete no action on update cascade,
	foreign key(id_chat) references chat(id)
	on delete cascade on update cascade
);

create table miembro(
	id_usuario int not null,
	id_grupo int not null,
	foreign key(id_usuario) references usuario(id)
	on delete cascade on update cascade,
	foreign key(id_grupo) references grupo(id)
	on delete cascade on update cascade,
	primary key(id_usuario,id_grupo)
);*/

create table favorito(
	id_usuario int not null,
	id_manga int not null,
	foreign key(id_usuario) references usuario(id)
	on delete cascade on update cascade,
	foreign key(id_manga) references manga(id)
	on delete cascade on update cascade,
	primary key(id_usuario,id_manga)
);

create table publicacion(
	id int auto_increment primary key,
	id_usuario int not null,
	fecha datetime not null,
	titulo varchar(120) not null,
	contenido varchar(1000),
	img varchar(120),
	categoria int not null,
	desactivada int default 0 not null,
	foreign key(id_usuario) references usuario(id)
	on delete cascade on update cascade
);

create table comentario(
	id int auto_increment not null primary key,
	id_usuario int not null,
	comentario varchar(500) not null,
	fecha datetime not null,
	id_publicacion int not null,
	desactivado int default 0 not null,
	foreign key(id_usuario) references usuario(id)
	on delete no action on update cascade,
	foreign key(id_publicacion) references publicacion(id)
	on delete no action on update cascade
);

create table seguidores(
	id int auto_increment not null primary key,
	seguidor int not null,
	seguido int not null,
	fecha_reg date not null,
	foreign key (seguidor) references usuario(id)
	on delete cascade on update cascade,
	foreign key (seguido) references usuario(id)
	on delete cascade on update cascade
);

create table noticia(
	id int auto_increment not null primary key,
	titulo varchar(60) not null,
	fecha date not null,
	prev varchar(250) not null,
	noticia varchar(2000) not null,
	tipo int default 0 not null,
	id_usuario int not null,
	foreign key (id_usuario) references usuario(id)
	on update no action on delete cascade
);

/*create table version(
	id int auto_increment not null primary key,
	version varchar(20) not null,
	año varchar(11) not null,
	fecha date not null
);*/

create table c_chats (
	id_cch int auto_increment not null primary key,
	de int not null,
	para int not null,
	foreign key (de) references usuario(id)
	on delete no action on update cascade,
	foreign key (para) references usuario(id)
	on delete no action on update cascade
);

create table chats (
 	id_cha int auto_increment not null primary key,
  	id_cch int not null,
 	de int not null,
  	para int not null,
  	mensaje varchar(2000) not null,
  	prev varchar(20) not null,
 	fecha datetime not null,
 	leido int not null,
 	foreign key(id_cch) references c_chats(id_cch)
 	on delete no action on update cascade
);

create table notificacion(
	id int auto_increment not null primary key,
	user1 int not null,
	user2 int not null,
	tipo int not null,
	visto int default 0 not null,
	id_noti int not null,
	fecha datetime not null,
	foreign key (user1) references usuario(id)
	on delete no action on update cascade,
	foreign key (user2) references usuario(id)
	on delete no action on update cascade
);