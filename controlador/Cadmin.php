
<?php

include_once("../modelo/persona.php");
include_once("../modelo/admin.php");


//tengo que recibir el id del usuario que esta logueado y su rol

$metodo = $_SERVER["REQUEST_METHOD"]; //metodo de la peticion http

$accion = $_GET["accion"]; //parametro de la url

$info = json_decode(file_get_contents("php://input"), true); // recibe los datos en formato json

if (isset($_GET["id_admin"]) && isset($_GET["id_rol"])) { //recibo los id del usuario logueado y su rol (la idea es que sea un admin)


    $id_admin = $_GET["id_admin"];
    $id_rol = $_GET["id_rol"];

    $obj = Admin::buscar_admin_por_id($id_admin);
    //$persona=Persona::buscar_por_id($obj->Personas_DNI);

    $admin = new Admin($obj->Legajo, $obj->User, $obj->Password, $obj->Estado_Usuario, $obj->Rol_id_rol);
    $admin->setId_user($obj->Id_Usuario);



    if ($metodo == "POST") {

        if (isset($_GET["accion"])) {

            if ($accion == "crear_persona") {

                $persona = new Persona(
                    $info["dni"],
                    $info["nombre"],
                    $info["apellido"],
                    $info["fecha_nac"],
                    $info["telefono"],
                    $info["email"],
                    $info["domicilio"],
                    $info["inscripto"]
                );

                $persona->guardarPersona();
                echo json_encode($persona->buscar_por_id($persona->get_dni()));
            } else if ($accion == "crear_alumno") {

                if (isset($_GET["dni"])) {
                    $dni = $_GET["dni"];
                    $persona = Persona::buscar_por_id($dni);

                    /*  $persona=new Persona( $$persona[0],
                          $$persona[1],
                          $$persona[2],
                          $$persona[3],
                          $$persona[4],
                          $$persona[5],
                          $$persona[6],s
                          $$persona[7]
                      );
                  */

                    $user = new Usuario(
                        "primer legajo",
                        "primer usuario",
                        "password",
                        //   "libro 1 foja 1",
                        // 1,
                        // 1,
                        $persona
                    );


                    // print_r($user);
                    echo json_encode($user);
                }
            }
        }
    } 
    else if ($metodo == "GET") {

        if ($accion == "listar_usuarios") {

            echo json_encode($admin->lista_usuario());

        } else if ($accion == "ver_un_usuario") {

            $id_ver=$_GET["Id_Usuario"];

            echo json_encode(Admin::buscar_por_id($id_ver));
            //echo json_encode(Persona::buscar_por_id($id));
        } else if ($accion == "ver_materias") {

            echo json_encode($admin->lista_materias());
        }
    } 
    else if ($metodo == "PUT") {

        //  echo "el metodo http es: ".$_SERVER["REQUEST_METHOD"];

        if ($accion == "actualizar_usuario") {


            // echo "la accion del admin es: ". $_GET["accion"];


            if (isset($_GET["Id_Usuario"])) { //&& isset($_GET["Legajo"]) && isset($_GET["fk_DNI"])

                //   echo "el id del usuario es: ".$_GET["Id_Usuario"];



                $idUser = $_GET["Id_Usuario"];
                // $dni=$_GET["fk_DNI"];
                //$legajo=$_GET["Legajo"];

                $user = Admin::buscar_por_id($idUser);


                $datosNuevos = [
                    $info["Legajo"],
                    $info["User"],
                    $info["Password"],
                    $info["Estado_Usuario"],
                    $info["Rol_id_rol"]

                ];

                /*[
                    'legajo'=>$info["Legajo"],
                    'user_name'=>$info["User"],
                    'password'=>$info["Password"],
                    'estado'=>$info["Estado_Usuario"],
                    'id_rol'=>$info["Rol_id_rol"]                    
                    
                ]; */

                $user->ActualizarUser($datosNuevos);

                /*
                $user->setLegajo($info["Legajo"]);
                $user->setUser_name($info["User"]);
                $user->setPassword($info["Password"]);
              //  $user->setEstado($info["Estado_Usuario"]);
               // $user->setRol($info["Rol_id_rol"]);

               //$u=new Usuario($user->getLegajo(),$user->getUser_name(),$user->getPassword());
              
                echo $user;
               */
            }
        } else if ($accion == "actualizar_persona") {

            if (isset($_GET["DNI"]) && isset($_GET["Id_Usuario"])) {

                $dni = $_GET["DNI"];
                $idUser = $_GET["Id_Usuario"];

                $user = Admin::buscar_por_id($idUser);


                $datosNuevos = [
                    $info["nombre"],
                    $info["apellido"],
                    $info["fecha_nacimiento"],
                    $info["telefono"],
                    $info["email"],
                    $info["domicilio"],
                    $info["inscripto"],
                ];



                $user->ActualizarPersona($datosNuevos, $dni);
            }
        }
    
    
    }


}

/*
    echo "el metodo http es: ".$_SERVER["REQUEST_METHOD"];
    echo "la accion del admin es: ". $_GET["accion"];
    echo "el id del usuario es: ".$_GET["Id_Usuario"];
    */

?>