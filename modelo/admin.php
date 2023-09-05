
<?php

    include_once("../conexion/config.php");
    include_once("../conexion/conexion.php");
    include_once("../modelo/usuario.php");
    
    class Admin extends Usuario implements JsonSerializable
    {
        private int $id_user;

        private int $estado;

        private int $rol;

     
        public function __construct(
            
            string $legajo, 
            string $user_name, 
            string $password, 
            int $estado,
            int $rol,
            Persona $persona=null){

            parent::__construct($legajo,$user_name,$password,$persona);

            $this->estado =$estado;
            $this->rol = $rol;
        }
        

        public function getEstado()
        {
            return $this->estado;
        }

      
        public function setEstado(int $estado)
        {
            $this->estado = $estado;

           
        }

        public function getRol()
        {
            return $this->rol;
        }

        public function setRol(int $rol)
        {
            $this->rol = $rol;

         
        }

        public function getId_user()
        {
            return $this->id_user;
        }


        public function setId_user($id_user){

            $this->id_user= $id_user;
        }


        public function lista_usuario():Array{

            $con = new db();
            $sql = "SELECT u.Id_Usuario as id, u.Legajo, u.User as userName, u.Password as pass, u.Libromatriz, 
                    p.Carrera, e.Descripcion_Estado as estado, r.Descripcion as Rol, u.Personas_DNI  
                    from usuario u 
                    INNER JOIN rol  r on u.Rol_id_rol=r.id_rol 
                    INNER JOIN plan p on u.Id_Plan=p.idPlan 
                    INNER JOIN estado e on u.Estado_Usuario=e.Id_Estado";
            
            
            $result=$con->query($sql);
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $con->close();
            
           return $data;
            
        }


        public static function buscar_admin_por_id(int $id_admin){

            $con = new db();

            $sql = "SELECT Id_Usuario,Legajo, User, Password, Estado_Usuario, Rol_id_rol,Personas_DNI FROM usuario WHERE Id_Usuario=? and Rol_id_rol=3";
            
            $result = $con->query_prepare($sql,[$id_admin]);  
                      
            $con->close();

            return $result->fetch_object();


        }



        
        public static function buscar_por_id(int $id_user)
        {

            $con = new db();

            $sql = "SELECT Id_Usuario,Legajo, User, Password, Estado_Usuario, Rol_id_rol,Personas_DNI FROM usuario WHERE Id_Usuario=? ";

            $result = $con->query_prepare($sql,[$id_user]);  

            $con->close();
            

            $obj =$result->fetch_object();

            //$persona=Persona::buscar_por_id($obj->Personas_DNI);

            //$user=new Admin($obj->Legajo, $obj->User, $obj->Password, $obj->Estado_Usuario, $obj->Rol_id_rol,$persona);
            //$user->setId_user($obj->Id_Usuario);
            return $obj;//new Usuario($obj->Legajo, $obj->User, $obj->Password, $obj->Estado_Usuario, $obj->Rol_id_rol);
            
            //return $user;
        }


        public function lista_materias(){
            
            $con = new db();

            $sql = "SELECT * FROM materias";
            $result = $con->query_prepare($sql);  
                      
            $con->close();

            return $result->fetch_all(MYSQLI_ASSOC);


        }



        //int $id_usuario, string $user_name, string $email, string $clave, int $rol, int $estado
        //$user_name,$email,$clave,$rol,$estado,$id_usuario

        public function ActualizarUser(Array $datosNuevos){
            
            $datos=$datosNuevos;

            array_push($datosNuevos,$this->getId_user());


            $sql="UPDATE usuario SET Legajo=?, User= ?, Password= ?,  Estado_Usuario= ?, 
                    Rol_id_rol= ? WHERE Id_Usuario = ?";

            parent::ActulizarUser($sql,$datosNuevos);
        }


        public function ActualizarPersona(Array $datosNuevos,$dni){

            $persona=Persona::buscar_por_id($dni);

            array_push($datosNuevos,$persona->get_dni());

            $sql="UPDATE personas SET Nombre=?, Apellido=?, Fechanacimiento=?, Telefono=?,
                  Email=?, Domicilio=?, Inscripto=? WHERE DNI =?;";
            

            parent::ActulizarUser($sql,$datosNuevos);
        }




        public function jsonSerialize()
        {
            return [
                'id_usuario' => $this->getId_user(),
                'legajo' => $this->getlegajo(),
                'user_name' => $this->getuser_name(),
                //'password' => $this->password,
                'estado_usuario'=>$this->getEstado(),
                'rol'=>$this->getRol(),
                'dni'=>$this->getPersona()->get_dni()
                //'libromatriz' => $this->libromatriz,
                //'persona' => $this->persona
            ];
        }




        

    }

    


?>
