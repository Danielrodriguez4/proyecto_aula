create table if not exists docentes
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
)CHARSET=utf8mb4;

alter table docentes
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
)CHARSET=utf8mb4;

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
)CHARSET=utf8mb4;

alter table user
	add primary key (id);

create table if not exists informacionpersonal
(
	id int auto_increment
		primary key,
	nombre varchar(50) default '0' not null,
	apellido varchar(50) default '0' not null,
	num_id varchar(11) not null,
	codigo int not null,
	semestre int not null,
	telefono varchar(50) not null,
	sexo tinytext not null,
	correo varchar(50) not null,
	user int not null,
	constraint informacionpersonal_user_id_fk
		foreign key (user) references user (id)
)CHARSET=utf8mb4;

create table if not exists proyectos
(
	id int(10) auto_increment
		primary key,
	grupo int not null,
	asignatura varchar(200) not null,
	titulo varchar(100) not null,
	num_est int not null,
	archivo longtext not null,
	estado int default 1 null,
	fecha_entrega datetime default CURRENT_TIMESTAMP not null,
	user int not null,
	docente int null,
	constraint fk_proyecto_asignatura 
		foreign key (asignatura_id) references asignaturas (id) 
		on delete restrict on update cascade,
	constraint proyectos_docentes_id_fk
		foreign key (docente_id) references docentes (id) 
		on delete set null on update cascade,
	constraint proyectos_user_id_fk
		foreign key (user_id) references user (id)
		on delete set cascade on update cascade
)
charset=utf8mb4;

create table if not exists usuarios
(
	id int auto_increment,
	nombre text not null,
	apellido text not null,
	num_id int not null,
	codigo int not null,
	semestre int not null,
	telefono varchar(10) not null,
	sexo varchar(10) null,
	correo varchar(250) not null,
	user int not null,
	constraint estudiantes_codigo_uindex
		unique (codigo),
	constraint estudiantes_id_uindex
		unique (id),
	constraint estudiantes_user_id_fk
		foreign key (user) references user (id)
)CHARSET=utf8mb4;

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
)CHARSET=utf8mb4;

alter table proyecto_usuario
	add primary key (id);


create table if not exists ferias
(
	id int(10) auto_increment
		primary key,
	nom_cur varchar(100) not null,
	doc_ori varchar(200) not null,
	tiem_eje varchar(50) not null,
	fecha_entrega DATETIME NULL,
    fecha_fin DATETIME NULL,
	est_por float not null,
	tip_pro int null,
	archivo longtext not null,
	comentario text null,
	jurado int null,
	nota int default 0 null,
	estado int default 1 null,
	user int not null,
	director int null,
	constraint ferias_docentes_id_fk
		foreign key (director) references docentes (id),
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
)CHARSET=utf8mb4;

alter table feria_usuario
	add primary key (id);

CREATE TABLE IF NOT EXISTS convocatorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    picture  VARCHAR(255) NULL,
    apertura DATE NOT NULL,
    cierre DATE NOT NULL,
    user INT NOT NULL,
    FOREIGN KEY (user) REFERENCES user(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS asignaturas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(50) NOT NULL UNIQUE,
    nombre VARCHAR(255) NOT NULL
)CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS docente_asignatura (
    id INT AUTO_INCREMENT PRIMARY KEY,
    docente_id INT NOT NULL,
    asignatura_id INT NOT NULL,
    FOREIGN KEY (docente_id) REFERENCES docentes(id),
    FOREIGN KEY (asignatura_id) REFERENCES asignaturas(id),
    UNIQUE KEY (docente_id, asignatura_id)
)CHARSET=utf8mb4;


INSERT INTO user (username, password, rol) 
VALUES ('ingsistemas@ufps.edu.co', MD5('115Sistemas'), 1)
ON DUPLICATE KEY UPDATE password = VALUES(password);