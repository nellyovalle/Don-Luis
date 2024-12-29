<?php

class DataBase {
    public static function conection (){
        try {
            $baseDatos ="dv-produccion_web-tienda";
            $host = "localhost";
            $port = "3306";
            $user ="root";
            $passwort ="";
            return new PDO("mysql:dbname=$baseDatos;chartset=UTF-8;host=$host;port=$port",$user,$password);

        }catch(Excepcion $e){
            echo "error en la base de datos <br>";
            echo $e->GetMessage ();
            exit();
        }
    }
}