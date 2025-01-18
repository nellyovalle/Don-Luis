<?php 
require_once __DIR__ . "/../models/Usuario.php";
require_once __DIR__ . "/../helpers/Utils.php";

class UsuarioController {

    public function index(){
        echo "<h1>Index de UsuarioController</h1>";
    }
    
    public function registro(){
        require_once __DIR__ . "/../views/usuario/registro.php";
    }

    public function save(){
        if( isset($_POST["submitRegistro"]) ){
            $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : false;
            $apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : false;
            $email = isset($_POST["email"]) ? $_POST["email"] : false;
            $password = isset($_POST["password"]) ? $_POST["password"] : false;
        
            if( $nombre && $apellido && $email && $password ){
                
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellido($apellido);
                $usuario->setEmail($email);
                $usuario->setPassword(password_hash($password,PASSWORD_BCRYPT));

                $save = $usuario->save();
                
                if($save){
                    $_SESSION["registro"]["flag"] = true;
                    /* Redirecciono al login */
                    header("Location: " . base_url . "index.php?controller=usuario&action=login");
                }else{
                    $_SESSION["registro"]["flag"] = false;
                    $_SESSION["registro"]["mensaje"] = "No se pudo guardar su usuario en la base de datos";

                    /* Redirecciono a la pagina de registro */
                    header("Location: " . base_url . "index.php?controller=usuario&action=registro");
                }
                
            }else{
                $_SESSION["registro"]["flag"] = false;
                $_SESSION["registro"]["mensaje"] = "Faltan datos para registrarte";

                /* Redirecciono a la pagina de registro */
                header("Location: " . base_url . "index.php?controller=usuario&action=registro");
            }
        }

        

    }

    public function login(){
        require_once __DIR__ . "/../views/usuario/login.php";
    }

    public function procesarLogin(){
        $email = $_POST["email"];
        $clave = $_POST["password"];

        $usuario = new Usuario();

        $usuario->setEmail($email);
        $usuario->setPassword($clave);

        $resultadoLogin = $usuario->login();
        
        if($resultadoLogin){
            $_SESSION["identity"] = $resultadoLogin;
            $_SESSION["login"]["flag"] = true;
            $_SESSION["login"]["message"] = "Bienvenido ".ucfirst($resultadoLogin->nombre)." ".ucfirst($resultadoLogin->apellido)."!" ;

            if(Utils::isAdmin()){
                header("Location: ".base_url."index.php?controller=producto&action=getAll");
            }else{
                header("Location: ".base_url."index.php?controller=producto&action=index");
            }
        }else{
            $_SESSION["session"]["flag"] = false;
            $_SESSION["session"]["mensaje"] = "Usuario no encontrado";

            header("Location: ".base_url."/index.php?controller=usuario&action=login");
        }
    }

    public function logOut(){
        // Eliminar variables de usuario
        if( isset($_SESSION["identity"]) ){
            unset($_SESSION["identity"]);
        }
        session_destroy();
        
        header("Location: ".base_url.'index.php?controller=producto&action=index');
    }
}
