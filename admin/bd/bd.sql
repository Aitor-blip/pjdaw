DROP DATABASE IF EXISTS PERROS;
CREATE DATABASE PERROS;
USE PERROS;


CREATE TABLE PERRO (
    
    nChip int primary key not null,
    nombrePerro varchar(100) not null,
    fechaNacimiento date not null,
    fechaEntrada date not null,
    idperrera int not null,
    idRaza int not null,
    idFoto int not null,
    dniPropietario varchar(9) default null
);

CREATE TABLE FOTO(
    idFoto int primary key not null,
    ruta varchar(100) not null, 
    descripcion varchar(100)
)
ALTER TABLE PERRO ADD CONSTRAINT FK_FOTO FOREIGN KEY (idFoto) REFERENCES FOTO (idFoto);


CREATE TABLE RAZA (
    
    idraza int primary key not null,
    nombreRaza varchar(100) not null,
    ubicacionRaza varchar(100) not null
);
ALTER TABLE PERRO ADD CONSTRAINT FK_RAZA FOREIGN KEY (idRaza) REFERENCES RAZA (idRaza);

CREATE TABLE PERRERA (
    
    idperrera int primary key not null,
    nombrePerrera varchar(100) not null,
    nPerros int not null,
    ubicacion varchar(100) not null,
    valoracion  varchar(100) not null
);
ALTER TABLE PERRO ADD CONSTRAINT FK_PERRERA FOREIGN KEY (idperrera) REFERENCES PERRERA (idperrera);


CREATE TABLE PROPIETARIO(
    dniPropietario varchar (100) primary key,
    nombre varchar(100) not null,
    apellido varchar(100) not null,
    fechaNacimiento date not null,
    ciudad varchar(100) not null,
    tlf varchar(100) not null,
    email varchar(50)
);
ALTER TABLE PERRO ADD CONSTRAINT FK_PROPIETARIO FOREIGN KEY (dniPropietario) REFERENCES PROPIETARIO (dniPropietario);


CREATE TABLE HISTORIAL_MEDICO(
    idHistorialMedico int primary key auto_increment,
    fechaEntrada date not null,
    observaciones varchar(200) default null,
    nChip int not null
);

ALTER TABLE HISTORIAL_MEDICO ADD CONSTRAINT FK_HISTORIAL FOREIGN KEY (nChip) REFERENCES PERRO (nChip);

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

INSERT INTO FOTO(idFoto,ruta,descripcion) VALUES(0,'ruta','foto prueba');

INSERT INTO PERRO(nChip,nombrePerro,fechaNacimiento,fechaEntrada,idperrera,idRaza,dniPropietario)
    VALUES(188484,'Kyle','2020-01-31','2020-02-01',1,1,0,'19859555G');


INSERT INTO HISTORIAL_MEDICO(idHistorialMedico,fechaEntrada,observaciones,nChip)
    VALUES(1,'2023-04-2022','S/N',188484);

