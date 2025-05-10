create table if not exists evaluadores
(
	id int auto_increment,
	codigo int not null,
	nombre text not null,
	apellido text not null,
	correo varchar(250) not null,
	cargo int null,
	constraint docentes_codigo_uindex
		unique (codigo),
	constraint docentes_id_uindex
		unique (id)
);

alter table evaluadores
	add primary key (id);

create table if not exists historial
(
	id int auto_increment,
	titulo text null,
	archivo varchar(200) null,
	estado int null,
	estudiantes int null,
	column_6 int null,
	director int null,
	jurado1 int null,
	jurado2 int null,
	jurado3 int null,
	nota int null,
	constraint historial_id_uindex
		unique (id)
);

alter table historial
	add primary key (id);

create table if not exists user
(
	id int auto_increment,
	username varchar(250) not null,
	password varchar(250) not null,
	rol int not null,
	constraint user_id_uindex
		unique (id),
	constraint user_username_uindex
		unique (username)
);

alter table user
	add primary key (id);

create table if not exists informacionpersonal
(
	id int auto_increment
		primary key,
	nombre varchar(50) default '0' not null,
	apellido varchar(50) default '0' not null,
	sexo tinytext not null,
	correo varchar(50) not null,
	user int not null,
	telefono varchar(15) null,
	codigo int not null,
	constraint informacionpersonal_user_id_fk
		foreign key (user) references user (id)
);

create table if not exists proyectos
(
	id int(10) auto_increment
		primary key,
	titulo varchar(100) not null,
	descripcion varchar(200) not null,
	fecha_entrega datetime default CURRENT_TIMESTAMP not null,
	user int not null,
	comentario text null,
	archivo longtext not null,
	estado int default 1 null,
	director int null,
	jurado1 text null,
	jurado2 text null,
	jurado3 text null,
	nota int default 0 null,
	constraint proyectos_docentes_id_fk
		foreign key (director) references evaluadores (id),
	constraint proyectos_user_id_fk
		foreign key (user) references user (id)
)
charset=utf8mb4;

create table if not exists usuarios
(
	id int auto_increment,
	codigo int not null,
	nombre text not null,
	apellido text not null,
	correo varchar(250) not null,
	telefono varchar(10) not null,
	sexo varchar(10) null,
	user int not null,
	constraint estudiantes_codigo_uindex
		unique (codigo),
	constraint estudiantes_id_uindex
		unique (id),
	constraint estudiantes_user_id_fk
		foreign key (user) references user (id)
);

alter table usuarios
	add primary key (id);

create table if not exists proyecto_usuario
(
	id_proyecto int null,
	id_estudiante int null,
	id int auto_increment,
	constraint proyecto_estudiante_id_uindex
		unique (id),
	constraint proyecto_estudiante_estudiantes_id_fk
		foreign key (id_estudiante) references usuarios (id),
	constraint proyecto_estudiante_proyectos_id_fk
		foreign key (id_proyecto) references proyectos (id)
);

alter table proyecto_usuario
	add primary key (id);


create table if not exists ferias
(
	id int(10) auto_increment
		primary key,
	nom_cur varchar(100) not null,
	doc-ori varchar(200) not null,
	tiem-eje varchar(50) not null,
	fecha_entrega datetime default CURRENT_TIMESTAMP not null,
	fecha_fin datetime default CURRENT_TIMESTAMP not null,
	est_por float not null,
	tip_pro int null,
	archivo longtext not null,
	comentario text null,
	jurado int null,
	nota int default 0 null,
	estado int default 1 null,
	user int not null,
	constraint ferias_docentes_id_fk
		foreign key (director) references evaluadores (id),
	constraint ferias_user_id_fk
		foreign key (user) references user (id)
)
charset=utf8mb4;

create table if not exists feria_usuario
(
	id_feria int null,
	id_estudiante int null,
	id int auto_increment,
	constraint feria_estudiante_id_uindex
		unique (id),
	constraint feria_estudiante_estudiantes_id_fk
		foreign key (id_estudiante) references usuarios (id),
	constraint feria_estudiante_ferias_id_fk
		foreign key (id_feria) references ferias (id)
);

alter table feria_usuario
	add primary key (id);