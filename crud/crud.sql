
/*

Listar a todos los alumnos que se anotaron en un Final
Listar a todos los alumnos que aprobaron una determinada materia, describiendo toda la información necesaria
Mostrar todas las materias aprobadas por un alumno
Mostrar todas las materias correspondientes a una carrera y que sean promocionales
Mostrar todas las materias correlativas correspondientes a una carrera
Listar  a todos los alumnos que egresaron por fecha
Listar a todos los alumnos que cursaron materias de distintos planes
CRUD de
Alumnos
Profesores
Usuarios
Materias
Notas


*/


insert into personas (dni,nombre,apellido,fechanacimiento,telefono,email,domicilio,inscripto)
    SELECT 12121,'nombre persona 1','apellido persona 1', '2001-01-01 10:10:10','11111111','email persona 1', 'domicilio 1',0
    FROM dual
    WHERE NOT EXISTS ( SELECT dni FROM personas where dni=12121);



INSERT INTO usuario (Legajo, User, Password, Libromatriz, Id_Plan, Estado_Usuario, Rol_id_rol, Personas_DNI)
    SELECT  '11','Alumno_1_dos','Password_1','111', 1, 3, 1, '11111'
    FROM dual
    WHERE NOT EXISTS
        (SELECT Legajo, Personas_DNI, Rol_id_rol
            FROM usuario
                WHERE  Rol_id_rol=1 and Personas_DNI='11111' and Id_Plan=1 )