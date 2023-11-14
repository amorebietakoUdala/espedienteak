-- ----------------------------------------------------------
-- MDB Tools - A library for reading MS Access database files
-- Copyright (C) 2000-2011 Brian Bruns and others.
-- Files in libmdb are licensed under LGPL and the utilities under
-- the GPL, see COPYING.LIB and COPYING files respectively.
-- Check out http://mdbtools.sourceforge.net
-- ----------------------------------------------------------

-- That file uses encoding UTF-8

CREATE TABLE `Archivo`
 (
	`N_Expediente`			varchar (50), 
	`Codigo`			varchar (50), 
	`Descripcion`			text, 
	`Orden`			varchar (5), 
	`Vigencia`			varchar (5), 
	`Anno`			varchar (4), 
	`Registro`			double, 
	`Titular`			varchar (50), 
	`Localizacion`			varchar (50), 
	`Signatura`			varchar (50), 
	`Dto`			varchar (4), 
	`F_Archivo`			datetime, 
	`Archivado`			boolean NOT NULL, 
	`Prestado`			boolean NOT NULL, 
	`Id`			int not null auto_increment unique
);

CREATE TABLE `aux`
 (
	`SOLICITANTE`			varchar (50), 
	`DNI`			varchar (10), 
	`NumeroExpediente`			varchar (10), 
	`TIPO`			smallint
);

CREATE TABLE `contadores`
 (
	`Entradas`			double, 
	`Salidas`			double, 
	`Oficio`			double, 
	`Expedientes`			double, 
	`Archivo`			double
);

-- CREATE INDEXES ...

CREATE TABLE `Contadores33`
 (
	`Entradas`			double, 
	`Salidas`			double, 
	`Expedientes`			double, 
	`Archivo`			double
);

-- CREATE INDEXES ...

CREATE TABLE `departamentos`
 (
	`numero`			varchar (4), 
	`nombre`			varchar (30)
);

CREATE TABLE `DESCRIPCION`
 (
	`DESCRIPCION`			varchar (67) NOT NULL, 
	`DEPARTAMENTO`			varchar (4) NOT NULL, 
	`Codigo`			double, 
	`publico`			boolean NOT NULL, 
	`plazo`			varchar (5), 
	`DepartamentoResponsable`			varchar (4) NOT NULL, 
	`ConDto`			boolean NOT NULL
);

CREATE TABLE `Errores de pegado`
 (
	`DESCRIPCION`			varchar (255), 
	`DEPARTAMENTO`			varchar (255), 
	`Codigo`			double, 
	`publico`			boolean NOT NULL, 
	`plazo`			varchar (255), 
	`DepartamentoResponsable`			varchar (255), 
	`ConDto`			boolean NOT NULL
);

CREATE TABLE `Especiales`
 (
	`TipoExpe`			int, 
	`paso`			int
);

CREATE TABLE `InfConReg`
 (
	`TIPO`			smallint, 
	`ORDEN_ENTRADA_SALIDA`			double, 
	`ANNO`			varchar (2), 
	`DEPARTAMENTO`			varchar (4), 
	`FECHA_ENTRADA`			date, 
	`DESCRIPCION`			text, 
	`DNI`			varchar (10), 
	`TELEFONO`			varchar (10), 
	`SOLICITANTE`			varchar (50), 
	`DIRECCION`			varchar (50), 
	`POBLACION`			varchar (28), 
	`PROVINCIA`			varchar (5), 
	`FECHA_DOCUMENTO`			date, 
	`NUMERO_TEXTO`			varchar (28), 
	`NumeroExpediente`			varchar (10), 
	`EMail`			varchar (50), 
	`Usuario`			varchar (30), 
	`Importe`			double, 
	`privado`			float
);

CREATE TABLE `InfConsultaExpe`
 (
	`numero`			double, 
	`descripcion`			text, 
	`solicitante`			varchar (50), 
	`dni`			varchar (10), 
	`fechaentrada`			datetime, 
	`fechafinalizacion`			datetime, 
	`tipoexpediente`			double, 
	`numeroexpediente`			double, 
	`finalizado`			boolean NOT NULL, 
	`año`			varchar (2), 
	`kodea`			varchar (10), 
	`departamento`			varchar (4), 
	`documento`			boolean NOT NULL, 
	`expedienterelacionado`			varchar (10), 
	`UltimoPaso`			varchar (10), 
	`Factura`			boolean NOT NULL, 
	`Archivado`			boolean NOT NULL, 
	`Procedimiento`			varchar (50)
);

CREATE TABLE `ListTrabajosPtes`
 (
	`kodea`			varchar (10), 
	`numero`			double, 
	`solicitante`			varchar (50), 
	`dni`			varchar (10), 
	`departamento`			varchar (4), 
	`descripcion`			varchar (50), 
	`plazo`			varchar (50), 
	`paso`			double, 
	`FechaAnterior`			datetime, 
	`Tiempo`			int, 
	`PlazoAnterior`			int
);

CREATE TABLE `pasos`
 (
	`numero`			double, 
	`paso`			double, 
	`kodea`			varchar (11), 
	`departamento`			varchar (4), 
	`descripcion`			varchar (50), 
	`plazo`			int, 
	`publico`			boolean NOT NULL, 
	`Plantilla`			varchar (25), 
	`kontrola`			varchar (50), 
	`ConDto`			boolean NOT NULL
);

CREATE TABLE `pasosexpedientes`
 (
	`numeroexpediente`			varchar (50), 
	`numero`			double, 
	`paso`			double, 
	`kodea`			varchar (16), 
	`departamento`			varchar (4), 
	`descripcion`			varchar (50), 
	`plazo`			varchar (50), 
	`terminado`			boolean NOT NULL, 
	`pasosiguiente`			boolean NOT NULL, 
	`fechapaso`			varchar (10), 
	`publico`			boolean NOT NULL, 
	`Plantilla`			varchar (25), 
	`ConDto`			boolean NOT NULL, 
	`DocumentoCreado`			tinyint
);

CREATE TABLE `Plantillas`
 (
	`NombrePlantilla`			varchar (50), 
	`Descripcion`			varchar (60)
);

CREATE TABLE `regexpedientes`
 (
	`numero`			double, 
	`descripcion`			text, 
	`solicitante`			varchar (50), 
	`dni`			varchar (10), 
	`fechaentrada`			datetime, 
	`fechafinalizacion`			datetime, 
	`tipoexpediente`			double, 
	`numeroexpediente`			double, 
	`finalizado`			boolean NOT NULL, 
	`año`			varchar (2), 
	`kodea`			varchar (10), 
	`departamento`			varchar (4), 
	`documento`			boolean NOT NULL, 
	`expedienterelacionado`			varchar (10), 
	`UltimoPaso`			varchar (10), 
	`Factura`			boolean NOT NULL, 
	`Archivado`			boolean NOT NULL, 
	`ExpePara`			boolean NOT NULL, 
	`privado`			float
);

CREATE TABLE `REGISTRO`
 (
	`TIPO`			smallint, 
	`ORDEN_ENTRADA_SALIDA`			double, 
	`ANNO`			varchar (2), 
	`DEPARTAMENTO`			varchar (4), 
	`FECHA_ENTRADA`			date, 
	`DESCRIPCION`			text, 
	`direccionObjetoTributario`			varchar (32), 
	`poblacionObjetoTributario`			varchar (28), 
	`DNI`			varchar (10), 
	`TELEFONO`			varchar (10), 
	`SOLICITANTE`			varchar (50), 
	`DIRECCION`			varchar (50), 
	`POBLACION`			varchar (28), 
	`PROVINCIA`			varchar (5), 
	`OBSERVACIONES`			text, 
	`FECHA_DOCUMENTO`			date, 
	`NUMERO_TEXTO`			varchar (28), 
	`REPRESENTANTE`			varchar (50), 
	`DIREC_REPRESENTANTE`			varchar (50), 
	`POBLACION_REPRESENTANTE`			varchar (28), 
	`PROVINCIA_REPRESENTANTE`			varchar (5), 
	`RECOGIDO`			boolean NOT NULL, 
	`HORA`			varchar (50), 
	`NumeroExpediente`			varchar (10), 
	`Factura`			boolean NOT NULL, 
	`EMail`			varchar (50), 
	`Usuario`			varchar (30), 
	`Importe`			varchar (50), 
	`DtoDoc`			varchar (4), 
	`privado`			float
);

CREATE TABLE `Tipo`
 (
	`Codigo`			smallint, 
	`Descripcion_Tipo`			varchar (15)
);

CREATE TABLE `TipoExpedientes`
 (
	`departamento`			varchar (4), 
	`procedimiento`			varchar (120), 
	`plazo`			smallint, 
	`EfectoDelSilencio`			varchar (2), 
	`numero`			double, 
	`privado`			float
);

CREATE TABLE `usu2`
 (
	`NombreUsuario`			varchar (50), 
	`Departamento`			varchar (6), 
	`TbKey`			varchar (15), 
	`Acceso`			float, 
	`USU`			varchar (50)
);

CREATE TABLE `zzzz`
 (
	`TIPO`			smallint, 
	`ORDEN_ENTRADA_SALIDA`			double, 
	`ANNO`			varchar (2), 
	`DEPARTAMENTO`			varchar (4), 
	`FECHA_ENTRADA`			datetime, 
	`DESCRIPCION`			text, 
	`DNI`			varchar (10), 
	`SOLICITANTE`			varchar (50), 
	`DIRECCION`			varchar (50), 
	`POBLACION`			varchar (28)
);

CREATE TABLE `Ciudadanos`
 (
	`direccionObjetoTributario`			varchar (32), 
	`poblacionObjetoTributario`			varchar (28), 
	`DNI`			varchar (10) NOT NULL, 
	`TELEFONO`			varchar (10), 
	`SOLICITANTE`			varchar (50), 
	`DIRECCION`			varchar (50), 
	`POBLACION`			varchar (28), 
	`PROVINCIA`			varchar (5), 
	`REPRESENTANTE`			varchar (50), 
	`DIREC_REPRESENTANTE`			varchar (50), 
	`POBLACION_REPRESENTANTE`			varchar (28), 
	`PROVINCIA_REPRESENTANTE`			varchar (5), 
	`EMail`			varchar (50), 
	`Usuario`			varchar (30), 
	`KK`			int, 
	`NOM`			varchar (50), 
	`APEL1`			varchar (50), 
	`APEL2`			varchar (50)
);

CREATE TABLE `documentos`
 (
	`numeroreg`			double, 
	`descripcion`			text, 
	`solicitante`			varchar (50), 
	`dni`			varchar (10), 
	`fechaentrada`			datetime, 
	`tipoexpediente`			smallint, 
	`año`			varchar (2), 
	`kodea`			varchar (11), 
	`departamento`			varchar (4), 
	`numeroexpediente`			varchar (11), 
	`documento`			boolean NOT NULL, 
	`Factura`			boolean NOT NULL, 
	`privado`			boolean NOT NULL
);

CREATE TABLE `FACTURAS`
 (
	`numeroreg`			double, 
	`descripcion`			text, 
	`solicitante`			varchar (50), 
	`dni`			varchar (10), 
	`Fechaentrada`			datetime, 
	`Tipoexpediente`			smallint, 
	`Año`			varchar (2), 
	`Kodea`			varchar (11), 
	`Departamento`			varchar (4), 
	`Numeroexpediente`			varchar (11), 
	`Documento`			boolean NOT NULL, 
	`AnoPresupuesto`			varchar (4), 
	`FaseDeGasto`			varchar (3), 
	`ClaveOperacion`			int, 
	`Signo`			tinyint, 
	`ClasificacionOrganica`			int, 
	`ClasificacionFuncional`			int, 
	`ClasificacionEconomica`			varchar (6), 
	`Importe`			double, 
	`FechaADO`			datetime, 
	`NumeroDeRelacion`			int, 
	`PlantillaAdo`			varchar (50), 
	`Procedimiento`			varchar (50), 
	`Euros`			double, 
	`ImporLetra`			text
);

CREATE TABLE `Instituciones`
 (
	`Id`			varchar (50) NOT NULL, 
	`Nombre`			varchar (50), 
	`numero`			varchar (4)
);

CREATE TABLE `POBLACIONES`
 (
	`CLAPRO`			varchar (4), 
	`CLANOM`			varchar (4), 
	`codInsti`			varchar (25), 
	`Poblacion`			varchar (50), 
	`CodigoPostal`			varchar (5), 
	`Comunidad`			varchar (50), 
	`DESPRO`			varchar (50), 
	`CodComunidad`			varchar (4), 
	`nulo`			varchar (1)
);

CREATE TABLE `Provincias`
 (
	`CodigoPostal`			varchar (5), 
	`Provincia`			varchar (35), 
	`CODAUTONOM`			varchar (4), 
	`comunidad`			varchar (50)
);

-- CREATE TABLE `TipoExpedientes - 20090630`
--  (
-- 	`departamento`			varchar (4), 
-- 	`procedimiento`			varchar (120), 
-- 	`plazo`			smallint, 
-- 	`EfectoDelSilencio`			varchar (2), 
-- 	`numero`			double, 
-- 	`privado`			float
-- );

-- -- CREATE INDEXES ...
-- ALTER TABLE `TipoExpedientes - 20090630` ADD PRIMARY KEY (`numero`);
-- ALTER TABLE `TipoExpedientes - 20090630` ADD INDEX `procedimiento` (`procedimiento`);


-- CREATE Relationships ...
-- Relationship from `usu2` (`Departamento`) to `departamentos`(`numero`) does not enforce integrity.
-- Relationship from `FACTURAS` (`Numeroexpediente`) to `regexpedientes`(`kodea`) does not enforce integrity.
-- Relationship from `FACTURAS` (`numeroreg`) to `REGISTRO`(`ORDEN_ENTRADA_SALIDA`) does not enforce integrity.
-- Relationship from `FACTURAS` (`Año`) to `REGISTRO`(`ANNO`) does not enforce integrity.
-- Relationship from `FACTURAS` (`Numeroexpediente`) to `REGISTRO`(`NumeroExpediente`) does not enforce integrity.
-- Relationship from `TipoExpedientes` (`departamento`) to `departamentos`(`numero`) does not enforce integrity.
-- Relationship from `pasos` (`numero`) to `TipoExpedientes`(`numero`) does not enforce integrity.
-- Relationship from `regexpedientes` (`tipoexpediente`) to `TipoExpedientes`(`numero`) does not enforce integrity.
-- Relationship from `pasosexpedientes` (`numero`) to `TipoExpedientes`(`numero`) does not enforce integrity.
-- Relationship from `pasos` (`departamento`) to `departamentos`(`numero`) does not enforce integrity.
-- Relationship from `REGISTRO` (`ORDEN_ENTRADA_SALIDA`) to `regexpedientes`(`numero`) does not enforce integrity.
-- Relationship from `pasosexpedientes` (`numeroexpediente0`) to `regexpedientes`(`kodea0`) does not enforce integrity.
-- Relationship from `pasosexpedientes` (`numeroexpediente`) to `regexpedientes`(`kodea`) does not enforce integrity.
-- Relationship from `pasos` (`numero`) to `tipoexpedientes`(`numero`) does not enforce integrity.
