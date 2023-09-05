
Use mydb;
/*************************************************** -- PERSONAS -- ******************************************************************************/
INSERT INTO personas (DNI, Nombre, Apellido, Fechanacimiento, Telefono, Email, Domicilio, Inscripto)
VALUES
(11111,'nombre persona 1','apellido persona 1', '2001-01-01 10:10:10','11111111','email persona 1', 'domicilio 1',0 );

Select * from personas where DNI='';

UPDATE personas SET Nombre='', Apellido='', Fechanacimiento='', Telefono='', Email='', Domicilio='', Inscripto='' WHERE DNI ='';

DELETE FROM Personas WHERE insctipto =0; /*PROCESO PROGRAMADO*/

/*************************************************** -- PLAN -- ******************************************************************************/
INSERT INTO plan (carrera, Estado_Id_Estado) 
VALUES
('NO APLICA',1),
('Analista de sistemas 2023 - Plan 001',1);

SELECT * FROM plan WHERE Carrera LIKE '%%';

UPDATE plan set carrera='',Estado_Id_Estado='' WHERE idPlan='' ;

/*Delete no corresponde*/

/*************************************************** -- Usuario -- ******************************************************************************/

INSERT INTO usuario (Legajo, User, Password, Libromatriz, Id_Plan, Estado_Usuario, Rol_id_rol, Personas_DNI)
VALUES 
('11','Alumno_1','Password_1','111', 1, 3, 1, '11111' ); /*Primer campo es legajo- id es autoincrement*/

SELECT * FROM usuario WHERE Id_Usuario ='';

UPDATE usuario set Legajo='', User='', Password='', Libromatriz='', Id_Plan='', Estado_Usuario='' where Id_usuario=''; /*Saco id_plan, rol_id y Personas_DNI*/

UPDATE usuario set Estado_Usuario=0 where Id_usuario='';
/*Es necesario volver invisible a usuarios viejos ?*/

/*************************************************** -- Materias -- ******************************************************************************/

Insert Into materias (Descripcion, Estado, Es_Promocional, Anio_carrera)
VALUES 
('NO APLICA', 1 , 0, 0),
('Analisis Matematico I', 1 , 1, 1);

SELECT * FROM materias where idMaterias ='';

UPDATE materias set Descripcion='', Estado='', Es_Promocional='', Anio_carrera='' WHERE idMaterias='';

UPDATE materias set Estado=0 WHERE idMateria ='';

/*************************************************** -- Detalle PLAN -- ******************************************************************************/

INSERT INTO Detalle_plan (Id_Materia, Id_Plan)
VALUES
(2,'6790/19'),(2,'5817/03'),(3,'6790/19'),(4,'6790/19'),(5,'5817/03'),(6,'6790/19'),(6,'5817/03'),(7,'6790/19'),(8,'6790/19'),(9,'6790/19'),(10,'5817/03');

SELECT * FROM Detalle_plan WHERE Id_Plan='';
SELECT p.carrera, m.Descripcion
FROM 
Detalle_plan dp join plan p on dp.id_plan=p.idPlan 
join materias m on dp.id_materia=m.idMaterias WHERE Id_Plan='';

UPDATE  Detalle_plan set Id_Materia='' WHERE Id_Plan='';

/* DELETE NO CORRESPONDE */

/*************************************************** -- Correlativas -- ******************************************************************************/
INSERT INTO correlativas (fk_Materia, Depende_de)
VALUES
(4,3),(6,2),(8,7),(8,3),(9,8),(9,3),(9,7),(10,2);

SELECT * FROM correlativas;

UPDATE correlativa SET depende_de='' WHERE fk_Materia = '';

/*************************************************** -- Acta volante -- ******************************************************************************/

INSERT INTO ActaVolante (fk_Materia, fk_id_Fecha_Final, fk_Fecha_Final, fk_Usuario, fk_Legajo, Folio, Nota)
VALUES
(2, 1, '2023-12-16', 1, 11, 1, 10);

SELECT p.Nombre, p.Apellido, p.DNI, av.fk_Legajo, m.Descripcion, av.fk_Fecha_Final, av.Folio, av.Nota
FROM materia m 
INNER JOIN actavolante av
ON m.id_Materia = av.fk_Materia
INNER JOIN usuario u
ON av.fk_Usuario = u.Id_Usuario
INNER JOIN persona p
ON u.fk_DNI = p.DNI
WHERE av.fk_Materia = '';
/* Muestra los datos necesarios para el acta volante */

UPDATE actavolante SET fk_Materia = '', fk_id_Fecha_Final = '', fk_Fecha_Final = '', fk_Usuario = '', fk_Legajo = '', Folio = '', Nota = '' WHERE fk_Materia = '';

/*************************************************** -- Detalle cursada -- ******************************************************************************/

INSERT INTO DetalleCursada (fk_Usuario, fk_Legajo, fk_Materia, fk_Estado, Anio)
VALUES
(1, 11, 2, 1, YEAR(CURDATE()) );

SELECT * FROM detallecursada;

SELECT * FROM detallecursada WHERE fk_Materia = '';

SELECT * FROM detallecursada WHERE fk_Legajo = '';

UPDATE detallecursada SET 
fk_Usuario= '',
 fk_Materia = '', 
 Primer_Parcial = '',
 Recuperatio_Parcial_1 = '', 
 Primer_TPDECIMAL = '', 
 Recuperatio_TP_1DECIMAL = '',
 Segundo_ParcialDECIMAL = '',
 Recuperatio_Parcial_2DECIMAL = '',
 Segundo_TPDECIMAL = '',
 Recuperatio_TP_2DECIMAL = '',
 PromedioDECIMAL = '',
 AnioVARCHAR = ''
 WHERE fk_Materia = '';

UPDATE detallecursada SET Estado=0 WHERE fk_Materia ='';

/*************************************************** -- Documentación -- ******************************************************************************/

INSERT INTO documentacion (Descripcion, Estado_Documentacion, fk_Materia, Permisos_visibilidad, Ubicacion)
VALUES
('Foto de perfil',1,1,1,'C:\Users\danie\OneDrive\Documentos\Dani\Terciacio');

SELECT Ubicacion FROM documentacion WHERE fk_Materia = '' AND Estado_Documentacion = '';

UPDATE Documentacion SET Descripcion= '', Estado_Documentacion = '', Permisos_visibilidad = '', Ubicacion = '' WHERE fk_Materia = '';


/*************************************************** -- Fecha Finales -- ******************************************************************************/

INSERT INTO FechasFinales (fk_Materia, Fecha, fk_Estado)
VALUES
(2, '2023-12-16', 1 );

SELECT Fecha FROM FechasFinales WHERE fk_Materia = '' AND fk_Estado = 1;

UPDATE FechaFinales SET Fecha = '', fk_Estado = '' WHERE fk_Materia = '';