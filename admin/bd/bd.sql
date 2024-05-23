DROP DATABASE IF EXISTS PERROS;
CREATE DATABASE PERROS;
USE PERROS;


CREATE TABLE PERRO (
    
    nChip int primary key not null,
    nombrePerro varchar(100) not null,
    fechaNacimiento date not null,
    fechaEntrada date not null,
    idperrera int not null,
    peso int not null,
    idRaza int not null
);

CREATE TABLE FOTO(
    idFoto int primary key not null auto_increment,
    ruta varchar(100) not null, 
    descripcion varchar(100),
    nChip int not null
);
ALTER TABLE FOTO ADD CONSTRAINT FK_NCHIP_FOTO FOREIGN KEY (nChip) REFERENCES PERRO (nChip);


CREATE TABLE RAZA (
    
    idraza int primary key not null,
    nombreRaza varchar(100) not null,
    ubicacionRaza varchar(100) not null
);
ALTER TABLE PERRO ADD CONSTRAINT FK_RAZA FOREIGN KEY (idRaza) REFERENCES RAZA (idRaza);

CREATE TABLE PERRERA (
    
    idperrera int primary key not null auto_increment,
    nombrePerrera varchar(100) not null,
    nPerros int not null,
    ubicacion varchar(100) not null,
    valoracion  varchar(100) not null
);
ALTER TABLE PERRO ADD CONSTRAINT FK_PERRERA FOREIGN KEY (idperrera) REFERENCES PERRERA (idperrera);


CREATE TABLE PROPIETARIO(
    dniPropietario varchar (100) primary key unique not null,
    nombre varchar(100) default null,
    apellido varchar(100) default null,
    fechaNacimiento date default current_timestamp,
    ciudad varchar(100) default null,
    tlf varchar(100) default null,
    email varchar(50) not null
);


CREATE TABLE HISTORIAL_MEDICO(
    idHistorialMedico int primary key auto_increment,
    fechaEntrada date not null,
    observaciones varchar(200) default null,
    nChip int not null
);

ALTER TABLE HISTORIAL_MEDICO ADD CONSTRAINT FK_HISTORIAL FOREIGN KEY (nChip) REFERENCES PERRO (nChip);

CREATE TABLE ADOPCION_PERROS(
    nChip int not null,
    dniPropietario varchar(20) not null,
    fechaAdopcion date not null default current_timestamp(),
    adoptado int default 0 not null,
    enTramite int default 0 not null
); 	

CREATE TABLE USUARIO(
    idUsuario int primary key auto_increment,
    email varchar(70) not null unique,
    password varchar(70) not null,
    dni varchar(9) not null unique,
    idRol int not null
);

CREATE TABLE USUARIO_ROL(
    idRol int primary key not null,
    nombre varchar(40) not null
);

ALTER TABLE USUARIO ADD CONSTRAINT FK_USUARIO_ROL FOREIGN KEY (idRol) REFERENCES USUARIO_ROL (idRol);


ALTER TABLE ADOPCION_PERROS ADD CONSTRAINT FK_NCHIP_ADOPCION_PERROS FOREIGN KEY (nChip) REFERENCES PERRO (nChip);
ALTER TABLE ADOPCION_PERROS ADD CONSTRAINT FK_DNI_PROPIEATARIO_ADOPCION_PERROS FOREIGN KEY (dniPropietario) REFERENCES PROPIETARIO (dniPropietario);


INSERT INTO PERRERA (idperrera,nombrePerrera,nPerros,ubicacion,valoracion) 
    VALUES(1,'Perrera',2,'España','4,2');

INSERT INTO PERRERA (idperrera,nombrePerrera,nPerros,ubicacion,valoracion) 
    VALUES(2,'Perrera 2',5,'Francia','Sin valoracion');

INSERT INTO PROPIETARIO (dniPropietario,nombre,apellido,fechaNacimiento,ciudad,tlf,email) 
    VALUES('19859555G','Juan','Muñoz','2023-03-12','Laredo','744 56 67 58','p@gmail.com');
INSERT INTO PROPIETARIO (dniPropietario,nombre,apellido,fechaNacimiento,ciudad,tlf,email) 
    VALUES('19859555J','Marcos','Perez','2023-02-12','Laredo','744 56 67 58','p2@gmail.com');

INSERT INTO RAZA(idRaza,nombreRaza,ubicacionRaza) VALUES(1,'Malinois','Francia');
INSERT INTO RAZA(idRaza,nombreRaza,ubicacionRaza) VALUES(2,'Doberman','Alemania');
INSERT INTO RAZA(idRaza,nombreRaza,ubicacionRaza) VALUES(3,'Haski','Noruega');
INSERT INTO RAZA(idRaza,nombreRaza,ubicacionRaza) VALUES(4,'Pastor Aleman','Alemania');


INSERT INTO PERRO(nChip,nombrePerro,fechaNacimiento,fechaEntrada,idperrera,idRaza)
    VALUES(188484,'Kyle','2020-01-31','2020-02-01',1,1);

INSERT INTO FOTO(ruta,descripcion,nChip) VALUES('dog2.jpg','foto prueba',188484);



INSERT INTO HISTORIAL_MEDICO(idHistorialMedico,fechaEntrada,observaciones,nChip)
    VALUES(1,'2023-04-2022','S/N',188484);


INSERT INTO ADOPCION_PERROS(nChip,dniPropietario,fechaAdopcion) VALUES(188484,'19859555G','2023-04-2022');


/*Usuarios*/

INSERT INTO USUARIO_ROL (idRol,nombre) VALUES(1,'Administrador');
INSERT INTO USUARIO_ROL (idRol,nombre) VALUES(2,'Usuario Logueado');
INSERT INTO USUARIO_ROL (idRol,nombre) VALUES(3,'Usuario Solicitador');

INSERT INTO USUARIO(email,password,idRol) VALUES("a@gmail.com","aitor2002",2);