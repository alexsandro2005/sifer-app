<?php

    require_once("./database/connection.php");
    $db = new Database();
    $con = $db->conectar();
?>

    <!----CONSULTAS SQL TIPO USUARIOS, GENERO, PAIS, CIUDAD Y ESTADO---->
<?php

    $control=$con->prepare ("SELECT * FROM type_user");
    $control->execute();
    $fila=$control->fetch(PDO::FETCH_ASSOC);

?>
<?php

    $select_gender=$con->prepare("SELECT * FROM gender");
    $select_gender->execute();
    $gender=$select_gender->fetch(PDO::FETCH_ASSOC);
?>
<?php


?>


<?php
    if((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))

    {
        // DECLARACION DE LOS VALORES DE LAS VARIABLES DEPENDIENDO DEL TIPO DE CAMPO QUE TENGA EN EL FORMULARIO


        $encriptaciones=[
            'cost'=> 15
        ];

        $cedula = $_POST['document'];
        $nombre = $_POST['name'];
        $usuario = $_POST['username'];
        $clave= password_hash($_POST['password'], PASSWORD_DEFAULT,$encriptaciones);
        $telefono = $_POST['telephone'];
        $email = $_POST['email'];
        $idusu= $_POST['id_type_user'];
        $id_gender=$_POST['id_gender'];
        $id_pais=$_POST['id_pais'];
        $id_ciudad=$_POST['id_ciudad'];
        $id_state=$_POST['id_state'];

        // CONSULTA SQL PARA VERIFICAR SI EL USUARIO YA EXISTE EN LA BASE DE DATOS
        $examinar=$con ->prepare("SELECT * FROM user WHERE document='$cedula' or username='$usuario'");
        $examinar -> execute();
        $register_validation=$examinar->fetchAll();

        // CONDICIONALES DEPENDIENDO EL RESULTADO DE LA CONSULTA
        if ($register_validation){

            // SI SE CUMPLE LA CONSULTA ES PORQUE EL USUARIO YA EXISTE

            echo '<script> alert ("// DOCUMENTO O USUARIO NO EXISTEN, CAMBIELOS //");</script>';
            echo '<script> windows.location= "register_usu.php"</script>';

        }

        else if ($cedula=="" || $nombre==""  || $usuario=="" || $clave=="" || $telefono=="" || $email=="" || $id_ciudad=="" || $id_pais=="" || $id_gender=="" || $id_ciudad=="")
        {
            // CONDICIONAL DEPENDIENDO SI EXISTEN ALGUN CAMPO VACIO EN EL FORMULARIO DE LA INTERFAZ
            echo '<script> alert (" EXISTEN DATOS VACIOS");</script>';
            echo '<script> window.location= "register_user.php"</script>';
        }else
        {
            $register_user=$con->prepare("INSERT INTO users(document,name,telephone,email,id_type_user,id_gender,id_pais,id_ciudad,password,username,id_state) VALUES('$cedula','$nombre','$telefono','$email','$idusu','$id_gender','$id_pais','$id_ciudad','$clave', '$usuario','$id_state')" );
            if($register_user->execute()){
                echo '<script>alert ("Registro Exitoso en la base de datos, Gracias");</script>';
                echo '<script>window.location="index.php"</script>';
            }
        }
    }
?>
<!-- ESTRUCTURA DEL FORMULARIO HTML -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>REGISTRO DE USUARIO || SENA</title>
    <link rel="stylesheet" href="controller/CSS/style_register.css">
    <link rel="shortcut icon" href="controller/image/SENA.png" type="image/x-icon">
</head>
<body onload="formreg.document.focus()">
    <main>

        <div class="container_title">
            <header>REGISTRO DE USUARIO</header>
        </div>
        <form method="POST" name="formreg" action="" autocomplete="off" id="formulario" class="formulario">

            <!-- Group: Document -->
			<div class="formulario__grupo" id="grupo__document">
				<label for="document" class="formulario__label">Numero de documento</label>
				<div class="formulario__grupo-input">
					<input type="number" onkeypress="" class="formulario__input" name="document" id="document" required placeholder="Ingrese su numero de documento">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El numero de documento debe ser de 6 a 10 numeros.</p>
			</div>


            <!-- Group: Nombre -->
			<div class="formulario__grupo" id="grupo__name">
				<label for="name" class="formulario__label">Nombre completo</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="name" required id="name" placeholder="Ingrese sus nombres">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Debe ingresar su nombre completo, o en preferencia su primer nombre y apellido.</p>
			</div>


            <!-- Group: Username -->
			<div class="formulario__grupo" id="grupo__username">
				<label for="username" class="formulario__label">Nombre de Usuario</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="username" required id="username" placeholder="Ingrese su nombre">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El usuario tiene que ser de 4 a 10 dígitos y solo puede contener numeros, letras y guion bajo.</p>
			</div>

        
			<!-- Group: Password -->

			<div class="formulario__grupo" id="grupo__password">
				<label for="password" class="formulario__label">Contraseña de Usuario</label>
				<div class="formulario__grupo-input">
					<input type="password" class="formulario__input" name="password" required id="password"placeholder="Ingrese su contraseña">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La contraseña tiene que ser de 4 a 10 dígitos y solo puede contener numeros, letras y guion bajo.</p>
			</div>

            <!-- Group: Password 2 -->

			<div class="formulario__grupo" id="grupo__password2">
				<label for="password2" class="formulario__label">Repetir Contraseña</label>
				<div class="formulario__grupo-input">
					<input type="password" class="formulario__input" name="password2" required id="password2"placeholder="Repita su contraseña">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p>
			</div>


            <!-- Group: telephone -->

			<div class="formulario__grupo" id="grupo__telephone">
				<label for="telephone" class="formulario__label">Numero de Telefono</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="telephone" required id="telephone" placeholder="Ingrese su numero de contacto">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El nombre tiene que ser de 4 a 20 dígitos y solo puede contener numeros, letras y guion bajo.</p>
			</div>


            <!-- Group: email -->
			<div class="formulario__grupo" id="grupo__email">
				<label for="email" class="formulario__label">Correo Electronico</label>
				<div class="formulario__grupo-input">
					<input type="text" onkeyup="return minus(event)" class="formulario__input" name="email" required id="email" placeholder="Ingrese su correo electronico">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El nombre tiene que ser de 4 a 20 dígitos y solo puede contener numeros, letras y guion bajo.</p>
			</div>


            <script>
                function mayus(e){
                    e.value.toUpperCase();
                }


                function minus(e){
                    e.value.toLowerCase();
                }
            </script>


            <!-- Group Type User -->
            
            <div class="formulario__grupo select" >
                <label for="tipousuario" class="formulario__label label">Tipo de Usuario</label>
                <div class="formulario__grupo__input">
                    <select name="id_type_user"  class="formulario__input">
                        <option value="">Seleccione Tipo de Usuario</option>

                            <?php
                            do{
                            ?>

                            <option value="<?php echo($fila['id_type_user'])?>"><?php echo($fila['type_user'])?></option>


                        <?php
                            }while($fila=$control->fetch(PDO::FETCH_ASSOC));
                        ?>
                    </select>
                </div>
            </div>

            <!-- Group Type Gender -->  

            <div class="fomulario__grupo container_gender">
                <label for="" class="formulario__label label"><option value="">Selecccion Tipo de Genero</option></label>
                <div class="formulario__grupo__input formulario__input">
                        <?php
                        do{

                        ?>
                        <input class="gender" name="id_gender" type="radio" value="<?php echo($gender['id_gender'])?>"> <?php echo($gender['gender'])?></input>
                        <?php    

                        }while($gender=$select_gender->fetch(PDO::FETCH_ASSOC));
                        ?>
                </div>
            </div>


            <!-- Group pais -->
            
            <div class="formulario__grupo select" >
                <label for="tipousuario" class="formulario__label label">Pais de Origen</label>
                <div class="formulario__grupo__input">
                    <select name="id_pais"  class="formulario__input">
                        <option value="">Seleccione Pais de Origen</option>

                            <?php
                            do{
                            ?>

                            <option value="<?php echo($pais['id_pais'])?>"><?php echo($pais['pais'])?></option>



                        <?php
                            }while($pais=$select_pais->fetch(PDO::FETCH_ASSOC));
                        ?>
                    </select>
                </div>
            </div>


            <!-- Group ciudad -->
            
            <div class="formulario__grupo select" >
                <label for="tipousuario" class="formulario__label label">Ciudad de Origen</label>
                <div class="formulario__grupo__input">
                    <select name="id_ciudad"  class="formulario__input">
                        <option value="">Seleccione ciudad de origen</option>

                            <?php
                            do{
                            ?>

                            <option value="<?php echo($ciudad['id_ciudad'])?>"><?php echo($ciudad['ciudad'])?></option>



                        <?php
                            }while($ciudad=$select_ciudad->fetch(PDO::FETCH_ASSOC))
                        ?>
                    </select>
                </div>
            </div>

            <!-- Group: State_user -->
            <div class="state">
                <input class="cajas" type="hidden" value="2" name="id_state" placeholder="Ingrese su estado">  
            </div>

            <!-- Group: Terminos y Condiciones -->
			<div class="formulario__grupo formulario__checkbox" id="grupo__terminos">
				<label class="formulario__label">
					<input type="checkbox" name="terminos" id="terminos">
					Acepto los Terminos y Condiciones <br> para el uso de mis datos
				</label>    
			</div>


            <!-- Group: Confirmacion de formulario  -->

            <div class="formulario__mensaje" id="formulario__mensaje">
				<!-- <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p> -->
			</div>

            <div class="formulario__grupo formulario__grupo-btn-enviar">
				<input type="submit" name="validar" value="Registrarme" class="formulario__btn"></input>
                <input type="hidden" name="MM_insert" value="formreg">
                <a href="login.php" class="return">Regresar</a>
				<!-- <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p> -->
			</div>
        </form>
    </main>

    <script src="./controller/JS/formulario.js"></script>
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>

</body>
</html>


