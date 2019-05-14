CREATE DATABASE registrosDocumentosDB;

USE registrosDocumentosDB;

CREATE TABLE EMPLEADOS(
	codigoEmpleado VARCHAR(10) PRIMARY KEY,
	identificacionEmpleado VARCHAR(12) UNIQUE NOT NULL,
	nombreEmpleado TEXT NOT NULL,
	apellidoEmpleado TEXT NOT NULL,
	idIdentificacion INT NOT NULL,
	telefonoEmpleado VARCHAR(10),
	correoEmpleado TEXT,
	idEstado INT NOT NULL,
	idSexo int not null,
	fechaNacimiento date not null,
	fechaEntrada date not null
);

CREATE TABLE SALIDAEMPLEADO(
	idSalidaEmpleado int primary key,
	codigoEmpleado varchar(10),
	fechaSalida date not null,
	idEstado int not null 
);

CREATE TABLE PRIORIDADES(
	idPrioridad int primary key auto_increment,
	descripcionPrioridad text not null,
	idEstado int not null
);

CREATE TABLE FOTOEMPLEADOS(
	idFotoEmpleado int primary key auto_increment,
	enlaceFoto text not null,
	codigoEmpleado varchar(10) not null,
	idEstado int not null
);

CREATE TABLE SEXOS(
	idSexo int PRIMARY key auto_increment,
	descripcionSexo text not null,
	idEstado int not null
);


CREATE TABLE FACULTADES(
	idFacultad VARCHAR(10) PRIMARY KEY,
	nombreFacultad TEXT NOT NULL,
	direccionFacultad text not null,
	telefonoFacultad text not null,
	correoFacultad text not null,
	idEstado INT NOT NULL,
	fechaInicio date not null
);


CREATE TABLE FINFACULTAD(
	idFinFacultad int primary key,
	idFacultad varchar(10),
	fechaFin date not null,
	idEstado int not null 
);

CREATE TABLE FOTOFACULTADES(
	idFotoFacultad int primary key auto_increment,
	enlaceFoto text not null,
	idFacultad VARCHAR(10) not null,
	idEstado int not null
);


CREATE TABLE AREAS(
	idArea VARCHAR(10) PRIMARY KEY,
	nombreArea TEXT NOT NULL,
	idFacultad VARCHAR(10) NOT NULL,
	idEstado INT NOT NULL,
	fechaInicio date not null
);


CREATE TABLE FINAREA(
	idFinArea int primary key,
	idArea varchar(10),
	fechaFin date not null,
	idEstado int not null 
);

CREATE TABLE AREAEMPLEADOS(
	idAreaEmpleado INT PRIMARY KEY auto_increment,
	idArea VARCHAR(10) NOT NULL,
	codigoEmpleado VARCHAR(10) NOT NULL,
	idCargo INT NOT NULL,
	idEstado INT NOT NULL
);

CREATE TABLE IDENTIFICACIONES(
	idIdentificacion INT PRIMARY KEY auto_increment,
	descripcionIdentificacion TEXT NOT NULL,
	idEstado INT NOT NULL
);

CREATE TABLE TIPODOCUMENTOS(
	idTipoDocumento INT PRIMARY KEY auto_increment,
	descripcionTipoDocumento TEXT NOT NULL,
	idEstado INT NOT NULL
);

CREATE TABLE USUARIOS(
	idUsuario INT PRIMARY KEY auto_increment,
	descripcionUsuario TEXT NOT NULL,
	claveUsuario TEXT NOT NULL,
	idEstado INT NOT NULL,
	idRol INT NOT NULL,
	codigoEmpleado VARCHAR(10) NOT NULL
);

CREATE TABLE ROLES(
	idRol INT PRIMARY KEY auto_increment,
	descripcionRol TEXT NOT NULL,
	idEstado INT NOT NULL
);

CREATE TABLE EVENTOS(
	idEvento VARCHAR(10) PRIMARY KEY,
	idDocumento VARCHAR(10) NOT NULL,
	idEstado INT NOT NULL,
	descripcionEvento TEXT NOT NULL,
	idArea VARCHAR(10) NOT NULL,
	horaEvento TIME NOT NULL,
	fechaEvento DATE NOT NULL,
	codigoEmpleado varchar(10) not null
);

CREATE TABLE TIEMPOEVENTOS(
	idTiempoEvento int primary key auto_increment,
	idEvento varchar(10) not null,
	tiempoTotal decimal not null,
	fecha date not null,
	hora time not null
);

-- agregar procedure a tiempos

CREATE TABLE ESTADOS(
	idEstado INT PRIMARY KEY auto_increment,
	descripcionEstado TEXT NOT NULL,
	estado BIT NOT NULL
);

CREATE TABLE DOCUMENTOS(
	idDocumento VARCHAR(10) PRIMARY KEY,
	idTipoDocumento INT NOT NULL, 
	fechaDocumento DATE NOT NULL,
	horaDocumento TIME NOT NULL,
	idArea VARCHAR(10) NOT NULL,
	descripcionDocumento TEXT NOT NULL,
	idEstado INT NOT NULL,
	areaVia VARCHAR(10) NOT NULL,
	codigoEmpleado VARCHAR(10) NOT NULL,
	idPrioridad int not null
);

CREATE TABLE TIEMPODOCUMENTOS(
	idTiempoDocumento int primary key auto_increment,
	idDocumento varchar(10) not null,
	tiempoTotal decimal not null,
	fecha date not null,
	hora time not null
);

CREATE TABLE CARGOS(
	idCargo INT PRIMARY KEY auto_increment,
	descripcionCargo TEXT NOT NULL,
	idEstado INT NOT NULL
);
CREATE TABLE ENLACES(
	idenlace INT PRIMARY KEY auto_increment,
	nombreEnlace TEXT NOT NULL,
	urlEnlace TEXT NOT NULL,
	idEstado INT NOT NULL
);

CREATE TABLE ENLACESROLES(
	idEnlaceRol INT PRIMARY KEY auto_increment,
	idEnlace INT NOT NULL,
	idRol INT NOT NULL
);

-- CONSTRAINTS

ALTER TABLE SALIDAEMPLEADO
ADD FOREIGN KEY(codigoEmpleado) 
REFERENCES EMPLEADOS(codigoEmpleado)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE SALIDAEMPLEADO
ADD FOREIGN KEY (idEstado)
REFERENCES ESTADOS(idEstado) 
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE FINFACULTAD
ADD FOREIGN KEY(idFacultad)
REFERENCES FACULTADES(idFacultad)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE FINFACULTAD
ADD FOREIGN KEY (idEstado)
REFERENCES ESTADOS(idEstado) 
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE FINAREA
ADD FOREIGN KEY(idArea)
REFERENCES AREAS(idArea)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE FINAREA
ADD FOREIGN KEY (idEstado)
REFERENCES ESTADOS(idEstado) 
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE TIEMPODOCUMENTOS
ADD FOREIGN KEY(idDocumento)
REFERENCES DOCUMENTOS(idDocumento)
ON DELETE CASCADE
ON UPDATE CASCADE;

alter table PRIORIDADES
ADD FOREIGN KEY (idEstado)
REFERENCES ESTADOS(idEstado)
on delete CASCADE
on UPDATE cascade;

alter table DOCUMENTOS
ADD FOREIGN KEY (idPrioridad)
REFERENCES PRIORIDADES(idPrioridad)
on delete CASCADE
on UPDATE cascade;

ALTER TABLE FACULTADES
ADD FOREIGN KEY (idEstado)
REFERENCES ESTADOS(idEstado)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE FOTOFACULTADES
ADD FOREIGN KEY(idFacultad)
REFERENCES FACULTADES(idFacultad)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE TIPODOCUMENTOS
ADD FOREIGN KEY(idEstado)
REFERENCES ESTADOS(idEstado)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE EMPLEADOS
ADD FOREIGN KEY(idSexo)
REFERENCES SEXOS(idSexo)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE EMPLEADOS
ADD FOREIGN KEY (idIdentificacion) 
REFERENCES IDENTIFICACIONES(idIdentificacion)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE TIEMPOEVENTOS
ADD FOREIGN KEY(idEvento)
REFERENCES EVENTOS(idEvento)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE EMPLEADOS
ADD FOREIGN KEY (idEstado) 
REFERENCES ESTADOS(idEstado)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE CARGOS
ADD FOREIGN KEY (idEstado) 
REFERENCES ESTADOS(idEstado)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE FOTOEMPLEADOS
ADD FOREIGN KEY(codigoEmpleado)
REFERENCES EMPLEADOS(codigoEmpleado)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE FOTOEMPLEADOS
ADD FOREIGN KEY(idEstado)
REFERENCES ESTADOS(idEstado)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE SEXOS
ADD FOREIGN KEY(idEstado)
REFERENCES ESTADOS(idEstado)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE AREAS
ADD FOREIGN KEY (idFacultad)
REFERENCES FACULTADES(idFacultad)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE AREAS
ADD FOREIGN KEY (idEstado)
REFERENCES ESTADOS(idEstado)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE AREAS
ADD FOREIGN KEY (idFacultad)
REFERENCES FACULTADES(idFacultad)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE AREAEMPLEADOS
ADD FOREIGN KEY(idArea)
REFERENCES AREAS(idArea)
ON DELETE CASCADE
ON UPDATE CASCADE; 

ALTER TABLE AREAEMPLEADOS
ADD FOREIGN KEY(codigoEmpleado)
REFERENCES EMPLEADOS(codigoEmpleado)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE IDENTIFICACIONES
ADD FOREIGN KEY(idEstado)
REFERENCES ESTADOS(idEstado)
ON DELETE CASCADE
ON UPDATE CASCADE;	

ALTER TABLE AREAEMPLEADOS
ADD FOREIGN KEY(idCargo)
REFERENCES CARGOS(idCargo)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE AREAEMPLEADOS
ADD FOREIGN KEY (idEstado) 
REFERENCES ESTADOS(idEstado)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE USUARIOS
ADD FOREIGN KEY (idEstado)
REFERENCES ESTADOS(idEstado)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE USUARIOS
ADD FOREIGN KEY(idRol)
REFERENCES ROLES(idRol)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE USUARIOS
ADD FOREIGN KEY (codigoEmpleado)
REFERENCES EMPLEADOS(codigoEmpleado)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE EVENTOS
ADD FOREIGN KEY (idDocumento)
REFERENCES DOCUMENTOS(idDocumento)
ON DELETE CASCADE
ON UPDATE CASCADE; 

ALTER TABLE EVENTOS
ADD FOREIGN KEY(idEstado)
REFERENCES ESTADOS(idEstado)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE EVENTOS
ADD FOREIGN KEY(idArea)
REFERENCES AREAS(idArea)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE EVENTOS
ADD FOREIGN KEY(codigoempleado)
REFERENCES EMPLEADOS(codigoEmpleado)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE DOCUMENTOS
ADD FOREIGN KEY (idTipoDocumento) 
REFERENCES TIPODOCUMENTOS(idTipoDocumento)
ON DELETE CASCADE
ON UPDATE CASCADE;
	
ALTER TABLE DOCUMENTOS	
ADD FOREIGN KEY(idArea)
REFERENCES AREAS(idArea)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE DOCUMENTOS	
ADD FOREIGN KEY(idEstado)
REFERENCES ESTADOS(idEstado)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE DOCUMENTOS
ADD FOREIGN KEY(areaVia)
REFERENCES AREAS(idArea)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE DOCUMENTOS	
ADD FOREIGN KEY (codigoEmpleado)
REFERENCES EMPLEADOS(codigoEmpleado)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE ENLACES
ADD FOREIGN KEY(idEstado)
REFERENCES ESTADOS(idEstado)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE ENLACESROLES
ADD FOREIGN KEY(idEnlace)
REFERENCES ENLACES(idEnlace)
ON DELETE CASCADE
ON UPDATE CASCADE;
	
ALTER TABLE ENLACESROLES	 
ADD FOREIGN KEY(idRol)
REFERENCES ROLES(idRol)
ON DELETE CASCADE
ON UPDATE CASCADE;

-- procedures

CREATE PROCEDURE `agregarEstado`(IN `nombre` TEXT) 
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
INSERT INTO ESTADOS(descripcionEstado, estado) 
VALUES(nombre,1);

CREATE PROCEDURE `editarEstado`(IN `nombre` TEXT, IN `id` INT, IN `estado` INT) 
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	UPDATE ESTADOS 
	SET descripcionEstado = nombre, estado = estado 
	WHERE idEstado = id;
END;

CREATE PROCEDURE `desactivarEstado`(IN `id` INT, IN `estado` INT) 
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
UPDATE ESTADOS 
SET estado = estado 
WHERE idEstado = id;

CREATE PROCEDURE `eliminarEstado`(IN `id` INT) 
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
DELETE FROM ESTADOS 
WHERE idEstado = id;


CREATE PROCEDURE agregarSexo(in nombre text, in estado text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER
BEGIN
	INSERT INTO SEXOS(descripcionSexo, idEstado)
	VALUES(nombre, (SELECT idEstado	FROM ESTADOS WHERE descripcionEstado = estado));
END;

CREATE PROCEDURE editarSexo(in id int, in nombre text, in estado TEXT)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER
BEGIN
	UPDATE SEXOS
	SET descripcionSexo = nombre, idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado)
	WHERE idSexo = id;
END;

CREATE PROCEDURE desactivarSexo(in id int, in estado text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER
BEGIN
	
	UPDATE SEXOS
	SET idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado)
	WHERE idSexo = id;
END;

CREATE DEFINER=`id8696707_root`@`%` PROCEDURE `agregarFacultad`(IN `nombre` TEXT, IN `id` VARCHAR(10), IN `correo` TEXT, IN `direccion` TEXT, IN `telefono` TEXT, IN `enlace` TEXT, IN `estado` TEXT, in fecha date) 
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN 
	INSERT INTO FACULTADES(idFacultad, nombreFacultad, direccionFacultad, telefonoFacultad, correoFacultad, idEstado, fechaInicio) 
	VALUES(id, nombre, direccion, telefono, correo, (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado), fecha); 
	call agregarFotoFacultad(enlace, nombre, estado); 
END;

CREATE PROCEDURE `editarFacultad`(IN `nombre` TEXT, in idfacultad varchar(10),  in correo text, in direccion text, in telefono text, in enlace text, IN `id` varchar(10), IN `estado` TEXT, in idFoto int, in fecha date, in estadoin text) 
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	UPDATE FACULTADES
	SET 
		nombreFacultad = nombre, 
		idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado), 
		direccionFacultad = direccion, 
		correoFacultad = correo, 
		telefonoFacultad = telefono, 
		idFacultad = idfacultad,
		fechaInicio = fecha
	WHERE idFacultad = id;

	call `editarFotoFacultad`(`enlace`, `estado`, nombre, idFoto) ;

	UPDATE FINFACULTAD
	SET	
		idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estadoin)
	WHERE idFacultad = id;
END;

CREATE PROCEDURE `desactivarFacultad`(IN `id` varchar(10), IN `estado` TEXT, in fechafin date) 
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN

	UPDATE FACULTADES
	SET idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado) 
	WHERE idFacultad = id;

	call desactivarFotoFacultad(
		(SELECT idFotoFacultad FROM FOTOFACULTADES WHERE idFacultad = id and idEstado = idestado), 
		`estado`
	);

	UPDATE FINFACULTAD 
	SET	idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado)
	WHERE idFacultad = id;

	INSERT INTO FINFACULTAD(
		idFacultad,
		fechaFin,
		idEstado
	)VALUES(
		idarea,
		fechaFin,
		(SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado)
	);

END;


CREATE DEFINER=`id8696707_root`@`%` PROCEDURE `agregarArea`(IN `nombre` TEXT, IN `id` VARCHAR(10), IN `facultad` TEXT, IN `estado` TEXT, in fecha date) 
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN 
	INSERT INTO AREAS(
		idArea, 
		nombreArea, 
		idFacultad, 
		idEstado,
		fechaInicio) 
	VALUES(
			id, 
			nombre, 
			(SELECT idFacultad FROM FACULTADES WHERE nombreFacultad = facultad), 
			(SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado),
			fecha
		); 
END;

CREATE DEFINER=`id8696707_root`@`%` PROCEDURE `editarArea`(IN `idarea` VARCHAR(10), IN `nombre` TEXT, IN `idfacultad` TEXT, IN `estado` TEXT, IN `id` VARCHAR(10), IN `estadoin` TEXT) 
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN 
	UPDATE FINAREA 
	SET idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estadoin) 
	WHERE idArea = id; 
	UPDATE AREAS 
	SET idArea = idarea, 
	nombreArea = nombre, 
	idFacultad = idFacultad, 
	idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado) 
	WHERE idArea = id; 
END

CREATE PROCEDURE `desactivarArea`(IN `estado` TEXT, IN `idarea` VARCHAR(10), IN `fechaFin` DATE, IN `estadoinverso` TEXT) 
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN 
	UPDATE AREAS 
	SET idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado) 
	WHERE idArea = idarea; 
	
	UPDATE FINAREA 
	SET idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado) 
	WHERE 
		idArea = idarea; 
	
	INSERT INTO FINAREA( 
		idArea, 
		fechaFin, 
		idEstado )
	VALUES( 
		idarea, 
		fechaFin, 
		(SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estadoinverso) 
	); 
END

CREATE PROCEDURE agregarPrioridad(IN nombre TEXT, in estado text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
INSERT INTO  PRIORIDADES(descripcionPrioridad, idEstado)
VALUES (nombre, (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado));

CREATE PROCEDURE editarPrioridad(IN nombre TEXT, IN id int, in estado text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
UPDATE  PRIORIDADES
SET	descripcionPrioridad = nombre, idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado)
WHERE idPrioridad = id;

CREATE PROCEDURE desactivarPrioridad(IN id int, in estado text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
UPDATE  PRIORIDADES
SET idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado)
WHERE idPrioridad = id;


CREATE PROCEDURE agregarTipoDocumento(IN nombre TEXT, in estado text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	INSERT INTO  TIPODOCUMENTOS(descripcionTipoDocumento, idEstado)
	VALUES (nombre, (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado));
END;

CREATE PROCEDURE editarTipoDocumento(IN nombre TEXT, IN id int, in estado text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN

	UPDATE  TIPODOCUMENTOS
	SET	descripcionTipoDocumento = nombre, idEstado = (SELECT idEstado	FROM ESTADOS WHERE descripcionEstado = estado)
	WHERE idTipoDocumento = id;
END;

CREATE PROCEDURE desactivarTipoDocumento (IN id int, in estado text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN

	UPDATE  TIPODOCUMENTOS
	SET idEstado = (SELECT idEstado	FROM ESTADOS WHERE descripcionEstado = estado)
	WHERE idTipoDocumento = id;
END;

CREATE PROCEDURE agregarIdentificacion(in identificacion text, in estado text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	INSERT INTO IDENTIFICACIONES(descripcionIdentificacion, idEstado)
	VALUES (identificacion, (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado));
END;

CREATE PROCEDURE editarIdentificacion(in identificacion text, in estado text, in ididentificacion int)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	UPDATE IDENTIFICACIONES
	SET descripcionIdentificacion = identificacion, idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado) 
	WHERE idIdentificacion = ididentificacion;
END;

CREATE PROCEDURE desactivarIdentificacion(in estado text, in ididentificacion int)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	UPDATE IDENTIFICACIONES
	SET idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado) 
	WHERE idIdentificacion = ididentificacion;
END;

CREATE PROCEDURE agregarRoles(IN nombre TEXT, in estado text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
INSERT INTO ROLES(
	descripcionRol, 
	idEstado)
VALUES(
	nombre, 
	(SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado)
);

CREATE PROCEDURE editarRoles(IN nombre TEXT, IN id INT, in estado text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
UPDATE ROLES
SET 
	descripcionRol = nombre, 
	idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado)
WHERE idRol = id;

CREATE PROCEDURE desactivarRoles(IN id INT, in estado text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
UPDATE ROLES
SET idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado)
WHERE idRol = id;

CREATE PROCEDURE agregarCargos(IN nombre TEXT, in estado text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	INSERT INTO CARGOS(
		descripcionCargo, 
		idEstado)
	VALUES(
		nombre, 
		(SELECT idEstado	from ESTADOS WHERE descripcionEstado = estado)
		);
END;

CREATE PROCEDURE editarCargos(IN nombre TEXT, IN id INT, in estado TEXT)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	UPDATE CARGOS
	SET 
		descripcionCargo = nombre, 
		idEstado = (SELECT idEstado	from ESTADOS WHERE descripcionEstado = estado)
	WHERE idCargo = id;
END;

CREATE PROCEDURE desactivarCargos(IN id INT, in estado text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	UPDATE CARGOS
	SET idEstado = (SELECT idEstado	from ESTADOS WHERE descripcionEstado = estado)
	WHERE idCargo = id;
END;

CREATE PROCEDURE agregarTipoPrioridad(IN nombre TEXT, in estado text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	INSERT INTO PRIORIDADES(
		descripcionPrioridad, 
		idEstado)
	VALUES(
		nombre, 
		(SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado));
END;

CREATE PROCEDURE editarTipoPrioridad(IN nombre TEXT, IN id INT, in estado TEXT)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	UPDATE CARGOS
	SET 
		descripcionPrioridad = nombre, 
		idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado)
	WHERE idPrioridad = id;
END;

CREATE PROCEDURE desactivarTipoPrioridad(IN id INT, in estado text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	UPDATE PRIORIDADES
	SET idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado)
	WHERE idPrioridad = id;
END;

CREATE PROCEDURE agregarEmpleado(IN codigo varchar(10), IN identificacion varchar(12), in nombre text, in apellido text, in tipoidentificacion text, in telefono varchar(10), in correo text, in sexo text,in enlace text, in estado text, in fechaNacimiento date, in fechaEntrada date)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
	BEGIN
	INSERT INTO EMPLEADOS(
		codigoEmpleado, 
		identificacionEmpleado, 
		nombreEmpleado, 
		apellidoEmpleado, 
		idIdentificacion, 
		telefonoEmpleado, 
		correoEmpleado, 
		idEstado, 
		idSexo, 
		fechaNacimiento,
		fechaEntrada)
	VALUES(
		codigo, 
		identificacion, 
		nombre, 
		apellido, 
		(SELECT idIdentificacion FROM IDENTIFICACIONES WHERE descripcionIdentificacion = tipoidentificacion), telefono, correo, 
		(SELECT idEstado from ESTADOS WHERE descripcionEstado = estado), 
		(SELECT idSexo FROM SEXOS WHERE descripcionSexo = sexo),
		fechaNacimiento,
		fechaEntrada);
	call agregarFotoEmpleados(enlace, codigo, estado); 
END;

CREATE PROCEDURE editarEmpleado(IN codigo varchar(10), IN identificacion varchar(12), in nombre text, in apellido text, in tipoidentificacion text, in telefono varchar(10), in correo text, in estado text, in codigoEmp varchar(10), in sexo text, in enlace text, in idfoto int, in fechaNacimiento date, in fechaEntrada date, in estadoin text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN	
	UPDATE EMPLEADOS
	SET	
		codigoEmpleado = codigo, 
		identificacionEmpleado = identificacion, 
		nombreEmpleado = nombre, 
		apellidoEmpleado = apellido, 
		idIdentificacion = (SELECT idIdentificacion FROM IDENTIFICACIONES WHERE descripcionIdentificacion = tipoidentificacion), 
		telefonoEmpleado = telefono, 
		correoEmpleado = correo, 
		idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado), 
		idSexo = (SELECT idSexo FROM SEXOS WHERE descripcionSexo = sexo),
		fechaNacimiento = fechaNacimiento,
		fechaEntrada = fechaEntrada
	WHERE codigoEmpleado = codigoEmp;

	call `editarFotoEmpleados`(enlace, estado, codigo, idfoto);

	UPDATE SALIDAEMPLEADO
	SET idEstado = estadoin
	WHERE codigoEmpleado = codigo;
END;

CREATE PROCEDURE desactivarEmpleado(IN codigo varchar(10), IN estado text, in idfoto int, in estadoin text, in fecha date)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	UPDATE EMPLEADOS
	SET idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado)
	WHERE codigoEmpleado = codigo; 


	UPDATE SALIDAEMPLEADO
	SET idEstado = estado
	WHERE codigoEmpleado = codigo;

	INSERT INTO SALIDAEMPLEADO(
		codigoEmpleado,
		fechaSalida
		idEstado
	)VALUES(
		codigo,
		fecha,
		(SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estadoin)
	);
	
	call `desactivarFotoEmpleados`(idfoto, `estado`);
END;

CREATE DEFINER=`id8696707_root`@`%` PROCEDURE `agregarAreaEmpleado`(IN `area` TEXT, IN `empleado` VARCHAR(10), IN `cargo` TEXT, IN `estado` TEXT) 
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN 
	INSERT INTO AREAEMPLEADOS(
		idArea, 
		codigoEmpleado, 
		idCargo, 
		idEstado) 
	VALUES (
		(SELECT idArea FROM AREAS WHERE nombreArea = area), 
		empleado, 
		(SELECT idCargo FROM CARGOS WHERE descripcionCargo = cargo), 
		(SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado)
	); 
END

CREATE PROCEDURE editarAreaEmpleado(IN area varchar(10), IN empleado varchar(10), in cargo text, in estado text ,in id INT)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	UPDATE AREAEMPLEADOS
	SET 
		idArea = area, 
		codigoEmpleado = empleado, 
		idCargo = (SELECT idCargo FROM CARGOS WHERE descripcionCargo = cargo), 
		idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado)
	WHERE idAreaEmpleado = id;
END;

CREATE PROCEDURE desactivarAreaEmpleado( in estado text ,in id INT)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	UPDATE AREAEMPLEADOS
	SET idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado)
	WHERE idAreaEmpleado = id;
END;

CREATE DEFINER=`id8696707_root`@`%` PROCEDURE `agregarUsuario`(IN `user` TEXT, IN `pass` TEXT, IN `rol` TEXT, IN `empleado` VARCHAR(10), IN `estado` TEXT) 
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN 
	INSERT INTO USUARIOS(descripcionUsuario, claveUsuario, idEstado, idRol, codigoEmpleado) 
	VALUES(user, pass, (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado), (SELECT idRol FROM ROLES WHERE descripcionRol = rol), empleado); 
END;

CREATE PROCEDURE editarUsuario(IN id INT, IN user TEXT, IN pass TEXT, IN estado text, in rol text, in empleado varchar(10) )
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	UPDATE USUARIOS
	SET 
		descripcionUsuario = user, 
		claveUsuario = pass, 
		idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado), 
		idRol = (SELECT idRol FROM ROLES WHERE descripcionRol = rol), 
		codigoEmpleado = empleado
	WHERE idUsuario = id;
END;

CREATE PROCEDURE desactivarUsuario(in id int, in estado text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	UPDATE USUARIOS
	SET idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado)
	WHERE idUsuario = id;
END;


CREATE PROCEDURE empleadoUsuarioAgregar(IN codigo varchar(10), IN identificacion varchar(12),in tipoidentificacion TEXT, in nombre text, in apellido text,  in telefono varchar(10), in correo text, IN user TEXT, IN pass TEXT, in tiporol text, IN nombrearea text, in tipocargo text, in sexo text, in enlace text, in estado text, in fechaNacimiento date, in fechaEntrada date)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	call agregarEmpleado(codigo, identificacion, nombre, apellido, tipoidentificacion, telefono, correo, sexo, enlace, estado, fechaNacimiento, fechaNacimiento, fechaEntrada);
	call agregarAreaEmpleado(nombrearea, codigo, tipocargo, estado);
	call agregarUsuario(user,pass ,tiporol, codigo, estado); 
END;

CREATE PROCEDURE empleadoUsuarioEditar(IN codigo varchar(10), IN identificacion varchar(12),in tipoidentificacion TEXT, in nombre text, in apellido text,  in telefono varchar(10), in correo text, IN user TEXT, IN pass TEXT, in tiporol text, IN nombrearea text, in tipocargo text, in sexo text, in enlace text, in estado text, in codigoEmp varchar(10), in idfoto int, in idarea varchar(10), in idareaempleado int, in idusuario int, in fechaNacimiento date, in fechaEntrada date, in estadoin text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	call editarEmpleado(codigo, identificacion, nombre, apellido, tipoidentificacion, telefono, correo,estado, codigoEmp, sexo, enlace, idfoto, fechaNacimiento, fechaEntrada, estadoin);
	call editarAreaEmpleado(idarea, codigo, tipocargo, estado, idareaempleado);
	call editarUsuario(idusuario, user, pass, estado, tiporol, codigo);
END;

CREATE DEFINER=`id8696707_root`@`%` PROCEDURE `empleadoUsuarioDesactivar`(IN `codigoempleado` VARCHAR(10), IN `idusuario` TEXT, IN `estado` TEXT, IN `idfoto` INT, IN `estadoin` TEXT, IN `fecha` DATE) 
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN 
	call desactivarEmpleado(codigoempleado, estado, idfoto, estadoin, fecha); 
	call desactivarUsuario(idusuario, estado); 
END

CREATE PROCEDURE agregarEvento(in evento varchar(10), in empleado varchar(10), in documento varchar(10), in descripcion text, in area text, IN hora time, in fecha date, in estado text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER
BEGIN
	
	INSERT INTO EVENTOS(
		idEvento, 
		idDocumento, 
		idEstado, 
		descripcionEvento, 
		idArea, 
		horaEvento, 
		fechaEvento, 
		codigoEmpleado)
	VALUES(
		evento, 
		documento, 
		(SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado), 
		descripcion, 
		(SELECT idArea FROM AREAS WHERE nombreArea = area), 
		hora, 
		fecha, 
		empleado
	);
END;

CREATE PROCEDURE editarEvento(in evento varchar(10), in documento varchar(10), in empleado varchar(10),in estado text, in descripcion text, in area text, in idevento varchar(10), IN hora time, in fecha date)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER
BEGIN
	UPDATE EVENTOS
	SET 
		idEvento = evento, 
		idDocumento = documento, 
		idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado), 
		codigoEmpleado = empleado, 
		descripcionEvento = descripcion, 
		idArea = (SELECT idArea FROM AREAS WHERE nombreArea = areaVia), 
		horaEvento = hora, 
		fechaEvento = fecha
	WHERE idEvento = idevento;
END;

CREATE PROCEDURE desactivarEvento(in evento varchar(10), in estado text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER
BEGIN
	UPDATE EVENTOS
	SET idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado)
	WHERE idEvento = evento;
END;

CREATE PROCEDURE agregarEnlace(IN nombre text, in enlace text, in estado text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER
BEGIN
	INSERT INTO ENLACES(nombreEnlace, urlEnlace, idEstado)
	VALUES(nombre, enlace, (SELECT idEstado	FROM ESTADOS WHERE descripcionEstado = estado));
END;

CREATE PROCEDURE editarEnlace(IN id INT, IN nombre text, in enlace text, in estado text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER
BEGIN
	update ENLACES
	SET idEstado = (SELECT idEstado	FROM ESTADOS WHERE descripcionEstado = estado), urlEnlace = enlace, nombreEnlace = nombre
	WHERE idEnlace = id;
END;

CREATE PROCEDURE desactivarEnlace(IN id text, in estado text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER
BEGIN
	update ENLACES
	SET idEstado = (SELECT idEstado	FROM ESTADOS WHERE descripcionEstado = estado)
	WHERE idEnlace = id;
END;

CREATE PROCEDURE agregarEnlacesRoles(in enlace int, in rol text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER
BEGIN
	INSERT INTO ENLACESROLES(idEnlace, idRol)
	VALUES(enlace, (SELECT idRol FROM ROLES	WHERE descripcionRol = rol));
END;

CREATE PROCEDURE editarEnlacesRoles(in id int, in enlace int, in rol text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER
BEGIN
	UPDATE ENLACESROLES
	SET idEnlace = enlace, idRol = (SELECT idRol FROM ROLES	WHERE descripcionRol = rol)
	WHERE idEnlaceRol = id;
END;

CREATE PROCEDURE agregarDocumento(in iddocumento varchar(10), in tipodocumento text, in fecha date, in hora time, in area text, in desrec text,  in areavia text, in empleado varchar(10), tipoprioridad text, in estado text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	INSERT INTO DOCUMENTOS(
		idDocumento, 
		idTipoDocumento, 
		fechaDocumento, 
		horaDocumento, 
		idArea,
		descripcionDocumento ,
		idEstado, 
		areaVia, 
		codigoEmpleado, 
		idPrioridad)
	VALUES(
		iddocumento, 
		(SELECT idTipoDocumento FROM TIPODOCUMENTOS WHERE descripcionTipoDocumento = tipodocumento), 
		fecha, 
		hora, 
		(SELECT idArea FROM AREAS WHERE nombreArea = area), 
		desrec, 
		(SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado), 
		(SELECT idArea FROM AREAS WHERE nombreArea = areaVia), 
		empleado, 
		(SELECT idPrioridad into idprioridad	FROM PRIORIDADES WHERE descripcionPrioridad = tipoprioridad)
	);
	
END;

CREATE PROCEDURE editarDocumento(in id varchar(10), in iddocumento varchar(10), in tipodocumento text, in fecha date, in hora time, in area text, in desrec text, in estado text, in instvia varchar(10), in empleado varchar(10), tipoprioridad text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	UPDATE DOCUMENTOS
	SET 
		idDocumento = iddocumento, 
		idTipoDocumento = (SELECT idTipoDocumento FROM TIPODOCUMENTOS WHERE descripcionTipoDocumento = tipodocumento), 
		fechaDocumento = fecha,	
		horaDocumento = hora, 
		idArea = (SELECT idArea FROM AREAS WHERE nombreArea = area), 
		descripcionDocumento = desrec, 
		idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado), 
		institutoVia = instvia, 
		codigoEmpleado = empleado, 
		idPrioridad = (SELECT idPrioridad FROM PRIORIDADES WHERE descripcionPrioridad = tipoprioridad)
	WHERE idDocumento = id;
END;

CREATE PROCEDURE desactivarDocumento(in iddocumento varchar(10), in estado text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	UPDATE DOCUMENTOS
	SET idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado)
	WHERE idDocumento = iddocumento;
END;

CREATE PROCEDURE `agregarFotoFacultad`(IN `enlace` TEXT, IN `facultad` text, in estado text) 
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	INSERT INTO FOTOFACULTADES(enlaceFoto, idEstado, idFacultad) 
	VALUES(enlace, (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado), (SELECT idFacultad FROM FACULTADES	WHERE nombreFacultad = facultad));
END

CREATE PROCEDURE `editarFotoFacultad`(IN `enlace` TEXT, IN `estado` TEXT, IN `facultad` text, in id int) 
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	UPDATE FOTOFACULTADES
	SET enlaceFoto = enlace , idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado), idFacultad = (SELECT idFacultad FROM FACULTADES WHERE nombreFacultad = facultad) 
	WHERE idFotoFacultad = id;
END;

CREATE PROCEDURE `desactivarFotoFacultad`(IN `id` INT, IN `estado` text) 
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	UPDATE FOTOFACULTADES
	SET idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado) 
	WHERE idFotoFacultad = id;
END;

CREATE PROCEDURE `agregarFotoEmpleados`(IN `enlace` TEXT, IN `empleado` varchar(10), in estado text) 
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	INSERT INTO FOTOEMPLEADOS(enlaceFoto, idEstado, codigoEmpleado) 
	VALUES(enlace, (SELECT idEstado	FROM ESTADOS WHERE descripcionEstado = estado), empleado);
END

CREATE PROCEDURE `editarFotoEmpleados`(IN `enlace` TEXT, IN `estado` TEXT, IN `empleado` varchar(10), in id int) 
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	UPDATE FOTOEMPLEADOS 
	SET 
		enlaceFoto = enlace , 
		idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado), 
		codigoEmpleado = empleado 
	WHERE idFotoEmpleado = id
END;

CREATE PROCEDURE `desactivarFotoEmpleados`(IN `id` INT, IN `estado` text) 
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	UPDATE FOTOEMPLEADOS 
	SET 
		idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = estado) 
	WHERE idFotoEmpleado = id;
END;

CREATE PROCEDURE `documentoEventoAgregar`(IN `iddocumento` VARCHAR(10), IN `evento` VARCHAR(10), IN `descEven` TEXT, IN `desctipodocumento` TEXT, IN `fecha` DATE, IN `hora` TIME, IN `nombrearea` TEXT, IN `desrec` TEXT, IN `tipoestado` TEXT, IN `areavia` text, IN `empleado` VARCHAR(10), in tipoprioridad text, in estado text) 
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN 
	call agregarDocumento(iddocumento, desctipodocumento, fecha, hora, nombrearea, desrec,  areavia, empleado, tipoprioridad, estado);
	call agregarEvento(evento, empleado, iddocumento, descEven, nombrearea, hora, fecha, estado);
END;

CREATE PROCEDURE `documentoEventoEditar`(in iddocanterior varchar(10), IN `iddocumento` VARCHAR(10), IN `evento` VARCHAR(10), IN `descEven` TEXT, IN `desctipodocumento` TEXT, IN `fecha` DATE, IN `hora` TIME, IN `nombrearea` TEXT, IN `desrec` TEXT, IN `tipoestado` TEXT, IN `areavia` text, IN `empleado` VARCHAR(10), in prioridad text) 
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN 
	call editarDocumento(iddocanterior, iddocumento, (SELECT idTipoDocumento FROM DOCUMENTOS WHERE descripcionTipoDocumento = desctipodocumento), fecha, hora, nombrearea, desrec, tipoestado, areavia, empleado, prioridad);
END;


CREATE PROCEDURE `enlacerolagregar`(IN `nombre` TEXT, IN `enlace` TEXT, IN `estado` INT, IN `rol` INT) 
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN 
	call agregarEnlace(nombre, enlace, estado);
	call agregarEnlacesRoles((SELECT idEnlace FROM ENLACES WHERE urlEnlace = enlace AND nombreEnlace = nombre) , rol);
END

CREATE PROCEDURE `enlaceroleditar`(in idenlace int, in idenlacerol int,IN `nombre` TEXT, IN `enlace` TEXT, IN `estado` text, IN `rol` text) 
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN 
	call editarEnlace(idenlace, nombre, enlace, estado);
	call editarEnlacesRoles(idenlacerol, (SELECT idEnlace FROM ENLACES WHERE urlEnlace = enlace AND nombreEnlace = nombre), rol);
END;


CREATE PROCEDURE agregarConfiguracionFacultad(IN `nombre` TEXT, IN `id` varchar(10), in correo text, in direccion text, in telefono text, in enlacefoto text, IN codigoempleado varchar(10),in area text, in cargo text, in idareaempledo int, in estado text, in fecha date)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	call `agregarFacultad`(`nombre`,`id`, correo ,direccion ,telefono ,enlacefoto, estado, fecha);
	call editarAreaEmpleado((SELECT idArea FROM AREAS WHERE nombreArea = area), codigoempleado, cargo, estado ,idareaempledo);
END;

CREATE PROCEDURE configuracionFacultadEditar(IN `nombre` TEXT, IN `id` varchar(10),in idfacultad varchar(10), in correo text, in direccion text, in telefono text, in enlacefoto text, IN codigoempleado varchar(10),in area text, in cargo text, in idareaempledo int, in estado text, in fecha date)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	call `editarFacultad`(`nombre`, id, correo, direccion, telefono, enlacefoto, `idfacultad`, `estado`, fecha);
	call editarAreaEmpleado((SELECT idArea FROM AREAS WHERE nombreArea = area), codigoempleado, cargo, estado ,idareaempledo);
END;

CREATE PROCEDURE desactivarConfiguracionFacultad(IN `idfacultad` varchar(10),  in idareaempleado int, in estado text)
NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN
	call `desactivarFacultad`(`idfacultad` , `estado` );
	call desactivarAreaEmpleado( estado, idareaempleado);
END;




/*
-- ejemplo
CREATE FUNCTION fn_TraeUnaTabla (@parametro datetime) 
RETURNS TABLE AS 
BEGIN 
	RETURN( 
		SELECT zona.zona, zona.especial, SUM(ta.valor) AS actividades, 
		SUM(te.valor) AS ejecutadas, SUM(TE.VALOR) / SUM(TA.VALOR) * 100 AS porcentaje 
		FROM dbo.zona 
		INNER JOIN 	dbo.ta ON dbo.zona.num_act = dbo.ta.num_act 
		INNER JOIN dbo.te ON dbo.zona.num_act = dbo.te.num_act 
		AND dbo.zona.fecha=(@parametro) 
		GROUP BY dbo.zona.zona, dbo.zona.especial
	) 
END 

-- Asi se ejecuta 
SELECT * FROM dbo_fn_TraeUnaTabla('2005-01-01')
-- ejemplo
*/

SELECT 
	usuario.`descripcionUsuario` 'user',
	usuario.`claveUsuario` 'password',
	usuario.idUsuario 'idUsuario',
	estado.descripcionEstado 'estado',
	rol.descripcionRol 'rolusuario',
	empleado.nombreEmpleado 'nombreempleado',
	empleado.apellidoEmpleado 'apellidoempleado',
	empleado.codigoEmpleado 'codigoempleado',
	sexo.descripcionSexo 'genero',
	area.nombreArea 'area',
	facultad.nombreFacultad 'facultad',
	facultad.idFacultad 'idFacultad',
	foto.enlaceFoto 'foto',
	foto.idFotoEmpleado 'idFoto'
FROM USUARIOS AS usuario 
inner join ESTADOS AS estado on usuario.idEstado = estado.idEstado
inner join ROLES AS rol on usuario.idRol = rol.idRol
inner join EMPLEADOS AS empleado on usuario.codigoEmpleado = empleado.codigoEmpleado
inner join SEXOS AS sexo on empleado.idSexo = sexo.idSexo
inner join AREAEMPLEADOS AS areaemp on empleado.codigoEmpleado = areaemp.codigoEmpleado
inner join AREAS AS area on areaemp.idArea = area.idArea
inner join FACULTADES AS facultad on area.idFacultad = facultad.idFacultad
inner join FOTOEMPLEADOS as foto on empleado.codigoEmpleado = foto.codigoEmpleado
WHERE estado.descripcionEstado = estado AND facultad.nombreFacultad = facultad
GROUP BY area.nombreArea;


SELECT 
	usuario.`descripcionUsuario` 'user',
    usuario.`claveUsuario` 'password',
    estado.descripcionEstado 'estado',
    rol.descripcionRol 'rolusuario',
    empleado.nombreEmpleado 'nombreempleado',
    empleado.apellidoEmpleado 'apellidoempleado',
    empleado.codigoEmpleado 'codigoempleado',
    sexo.descripcionSexo 'genero',
	area.nombreArea 'area',
	facultad.nombreFacultad 'facultad',
	facultad.idFacultad 'idFacultad',
	foto.enlaceFoto 'foto',
	foto.idFotoEmpleado 'idFoto'
FROM USUARIOS AS usuario 
inner join ESTADOS AS estado on usuario.idEstado = estado.idEstado
inner join ROLES AS rol on usuario.idRol = rol.idRol
inner join EMPLEADOS AS empleado on usuario.codigoEmpleado = empleado.codigoEmpleado
inner join SEXOS AS sexo on empleado.idSexo = sexo.idSexo
inner join AREAEMPLEADOS AS areaemp on empleado.codigoEmpleado = areaemp.codigoEmpleado
inner join AREAS AS area on areaemp.idArea = area.idArea
inner join FACULTADES AS facultad on area.idFacultad = facultad.idFacultad
inner join FOTOEMPLEADOS as foto on empleado.codigoEmpleado = foto.codigoEmpleado
WHERE usuario.descripcionUsuario = [usuario] AND usuario.claveUsuario = [clave] AND estado.descripcionEstado = 'ACTIVO';

SELECT 
	areaemp.`idAreaEmpleado` 'id',
    area.`idArea` 'idarea',
    area.nombreArea 'nombrearea',
    facultad.idFacultad 'idfacultad',
    facultad.nombreFacultad 'nombrefacultad',
    empleado.`codigoEmpleado` 'codigoempleado',
    empleado.nombreEmpleado 'nombreempleado',
    empleado.apellidoEmpleado 'apellidoempleado',
    empleado.identificacionEmpleado 'identificacionempleado',
    empleado.fechaEntrada 'fechaentrada',
    empleado.correoEmpleado 'correoempleado',
    empleado.telefonoEmpleado 'telefonoempleado',
    identificion.descripcionIdentificacion 'tipoidentificacion',
    cargo.`idCargo` 'idcargo',
    cargo.descripcionCargo 'nombrecargo',
    areaemp.`idEstado`'idestado',
    estado.descripcionEstado 'nombreestado'
FROM `AREAEMPLEADOS` as areaemp
inner join EMPLEADOS as empleado on areaemp.codigoEmpleado = empleado.codigoEmpleado
inner join AREAS as area on areaemp.idArea = area.idArea
inner join FACULTADES as facultad on area.idFacultad = facultad.idFacultad
inner join CARGOS as cargo on areaemp.idCargo = cargo.idCargo
inner join ESTADOS as estado on areaemp.idEstado = estado.idEstado
inner join IDENTIFICACIONES as identificion on empleado.idIdentificacion = identificion.idIdentificacion
WHERE estado.descripcionEstado = [estado] AND facultad.idFacultad = [FACULTAD];

SELECT 
	documento.idDocumento 'codigoDocumento',
	documento.descripcionDocumento 'descripcion',
    documento.fechaDocumento 'fecha',
    documento.horaDocumento 'hora',
    tipodocumento.descripcionTipoDocumento 'tipodocumento',
    area.nombreArea 'AreaRecive',
	area.idArea 'idAreaRecive',
    facultad.nombreFacultad 'facultadRecive',
	facultad.IdFacultad 'idfacultadRecive',
    estado.descripcionEstado 'estado',
    via.nombreArea 'areaVia',
	via.idArea 'idareaVia',
    facultadvia.nombreFacultad 'facultadVia',
	facultadvia.idFacultad 'idfacultadVia',
    empleado.codigoEmpleado 'codigoEmpleadoVia',
    empleado.nombreEmpleado 'nombreEmpleadoVia',
    empleado.apellidoEmpleado 'apellidoEmpleadoVia'
FROM DOCUMENTOS AS documento
inner join TIPODOCUMENTOS AS tipodocumento on documento.idTipoDocumento = tipodocumento.idTipoDocumento
inner join AREAS AS area on documento.idArea = area.idArea
inner join ESTADOS estado on documento.idEstado = estado.idEstado
inner join AREAS AS via on documento.areaVia = via.idArea
inner join EMPLEADOS AS empleado on documento.codigoEmpleado = empleado.codigoEmpleado
inner join FACULTADES AS facultad on area.idFacultad = facultad.idFacultad
inner join FACULTADES AS facultadvia on via.idFacultad = facultadvia.nombreFacultad
inner join PRIORIDADES AS prioridad on documento.idPrioridad = prioridad.idPrioridad
WHERE estado.descripcionEstado = [ESTADO] AND area.nombreArea = [area];

SELECT 
	evento.idEvento 'idevento',
	evento.horaEvento 'horaevento',
    evento.fechaEvento 'fechaevento',
    evento.descripcionEvento 'decripcionevento',
    documento.idDocumento 'codigodocumento',
    documento.descripcionDocumento 'documento',
    documento.fechaDocumento 'fechadocumento',
    documento.horaDocumento 'horadocumento',
    estadodocumento.descripcionEstado 'estadodocumento',
    estadoevento.descripcionEstado 'estadoevento',
    area.nombreArea 'areaevento',
	area.idArea 'idArea'
FROM EVENTOS AS evento
inner join DOCUMENTOS AS documento on evento.iddocumento = documento.iddocumento
inner join ESTADOS AS estadoevento on evento.idestado = estadoevento.idEstado
inner join AREAS AS area on evento.idarea = area.idArea
inner join ESTADOS AS estadodocumento on documento.idEstado = estadodocumento.idEstado
WHERE estado.descripcionEstado = [ESTADO] AND documento.iddocumento = [documento];

SELECT 
	empleado.`codigoEmpleado` 'codigoempleado',
    empleado.`identificacionEmpleado` 'identificacionempleado',
    identificacion.descripcionIdentificacion 'tipoidentificacion',
    empleado.`nombreEmpleado` 'nombreempleado',
    empleado.`apellidoEmpleado` 'apellidoempleado',
    empleado.`telefonoEmpleado` 'telefonoempleado',
    empleado.`correoEmpleado` 'correoempleado',
    empleado.fechaNacimiento 'nacimiento',
    empleado.fechaEntrada 'entrada',
    sexo.descripcionSexo 'genero',
	foto.enlaceFoto 'foto',
	foto.idFotoEmpleado 'idFoto',
    area.nombreArea 'nombrearea',
    area.idArea 'idarea',
    facultad.nombreFacultad 'nombrefacultad',
    facultad.idFacultad 'idfacultad'
FROM EMPLEADOS AS empleado
inner join SEXOS AS sexo on empleado.idSexo = sexo.idSexo
inner join IDENTIFICACIONES AS identificacion on empleado.idIdentificacion = identificacion.idIdentificacion
inner join ESTADOS AS estado on empleado.idEstado = estado.idEstado
inner join AREAEMPLEADOS AS areaemp on empleado.codigoEmpleado = areaemp.codigoEmpleado
inner join AREAS AS area on areaemp.idArea = area.idArea
inner join FOTOEMPLEADOS as foto on empleado.codigoEmpleado = foto.codigoEmpleado
inner join FACULTADES as facultad on area.idFacultad = facultad.idFacultad
WHERE estado.descripcionEstado = [ESTADO] AND area.nombreArea = [AREA];