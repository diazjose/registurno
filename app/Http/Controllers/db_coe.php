create table users(
id int(255) auto_increment not null,
name varchar(255),
surname varchar(255),
email varchar(100),
password varchar(100),
role varchar(100),
created_at datetime,
updated_at datetime,
remember_token varchar(255),
CONSTRAINT pk_users PRIMARY KEY(id)    
)ENGINE=InnoDB;

create table personas(
id int(255) auto_increment not null,
nombre varchar(255),
apellidos varchar(255),
dni varchar(10),
email varchar(100),
direccion varchar(255),
telefono varchar(255),
fechaIngreso date,
situacionLaboral varchar(100),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_persona PRIMARY KEY(id)
)ENGINE=InnoDB;

create table trabajo(
id int(255) auto_increment not null,
persona_id int(255),
fecha date,
horaEntrada time,
horaSalida time,
direccion varchar(255),
tarea varchar(255),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_trabajo PRIMARY KEY(id),
CONSTRAINT fk_trabajo_persona FOREIGN KEY(persona_id) REFERENCES personas(id)
)ENGINE=InnoDB;

create table dependiente(
id int(255) auto_increment not null,
coordinador_id int(255),
persona_id int(255),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_dependiente PRIMARY KEY(id),
CONSTRAINT fk_dependiente_coordinador FOREIGN KEY(coordinador_id) REFERENCES personas(id),
CONSTRAINT fk_dependiente_persona FOREIGN KEY(persona_id) REFERENCES personas(id)
)ENGINE=InnoDB;