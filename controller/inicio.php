<?php

session_start();
require_once("../database/connection.php");
$database = new Database();
$connection_db = $database->conectar();
session_start();


if($_POST["iniciar"]){

 

    // Variables que permiten realizar la validacion de la existencia del usuario en la base de datos

    $username=$_POST["username"];
    $document=$_POST["document"];
    $password=$_POST["password"];

    // VARIABES PARA ASIGNAR EL ESTADO DEL USUARIO

    $inactivo = 1;

    // CONSULTA PARA LA VALIDACION DEL USUARIO REGISTRADO EN LA BASE DE DATOS
    $container=$connection_db->prepare("SELECT * FROM user WHERE username = '$username' AND document='$document' AND id_state= '$inactivo'");
    $container->execute();
    $fila=$container->fetch();




    
    // Variables que permiten capturar el horario de ingreso del usuario en la aplicacion web 

    date_default_timezone_set("America/Bogota");

    $id_usuario=$_POST["document"];

    $userentry=$connection_db->prepare("INSERT INTO ingreso_usu(date_entry,document) VALUES(now(),'$id_usuario')");
    $userentry->execute();
   //Consultamos el usuario y la clave//

   $container=$con->prepare("SELECT * FROM user WHERE username = '$username' AND document='$document' AND id_state=1");
   $container->execute();
   $fila=$container->fetch();





   if ($fila && password_verify($clave,$fila['password'])){

       // DECLARACION DE LAS VARIABLES GLOBALES DE LA SESSIONS
       $_SESSION['id_user']=$fila['document'];
       $_SESSION['nombres']=$fila['name'];
       $_SESSION['tipo']=$fila['id_type_user'];
       $_SESSION['usuario']=$fila['username'];
       $_SESSION['id_estado']=$fila['id_state'];
       $_SESSION['id_genero']=$fila['id_gender'];
       $_SESSION['clave']=$fila['password'];
       $_SESSION['telephone']=$fila['telephone'];
       $_SESSION['email']=$fila['email'];
       $_SESSION['id_pais']=$fila['id_pais'];
       $_SESSION['id_ciudad']=$fila['id_ciudad'];

       
       ///dependiendo del tipo de usuario lo redireccionamos a una su pagina correspondiente// 

       if($_SESSION['tipo']==1){

           header("Location:../model/admin/index.php");
           exit();
       }
       else if($_SESSION['tipo']==2){

           header("Location:../model/vendedor/index.php");
           exit();
       }
       else if($_SESSION['tipo']==3){

           header("Location:../model/usuario/index.php");
           exit();
       }

   }elseif($username=""|| $document ="" || $password =""){
        echo '<script> alert (" EXISTEN DATOS VACIOS");</script>';
        echo '<script> window.location= "index.php"</script>';

   }else{
       //Si el nombre de usuario el documento y la clave son incorrectas y se encuentra inactivo en el software lo lleva a la pagina de inicio de sesion//
       header("Location:../error.html");
       
   }
}
?>
