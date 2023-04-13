<?php

    // Clase que contiene todos los parametros de conexion a la base de datos
    class Database 
    {
        // Variable para declarar el parametro del servidor

        private $localhost = "localhost";

        // Variable para declarar el parametro del nombre de la base de datos a desarrollar.

        private $databasename = "matrixapp";

        // Variable para declarar el parametro del nombre de usuario

        private $username = "root";

        // Variable para declarar el parametro de la contraseña de usuario

        private $password = "luchito2005";


        // Variable para declarar el parametro de los caracteres especiales
        private $charset = "utf8";

        function conectar(){
            try{
                $connection = "mysql:host=".$this->localhost.";dbname=".$this->databasename.";charset=".$this->charset;
                $accion=[
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false
                ];


                $pdo= new PDO($connection,$this->username,$this->password,$accion);
                return $pdo;
            }catch(PDOException $e){
                echo " ERROR EN LA CONEXION A LA BASE DE DATOS SIFERAPP".$e->getMessage();
                exit;
            }
        }

    }

?>