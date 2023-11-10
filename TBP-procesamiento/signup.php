<?php session_start();

if (
    isset ($_SESSION['nombre']) &&
    isset ($_SESSION['edad']) &&
    isset ($_SESSION['fecha_nacimiento']) &&
    isset ($_SESSION['nick_name']) &&
    isset ($_SESSION['hash'])
) {

    header ('Location: http://thebestphproject.local/home.php?from=tophprojects');

} else {

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        if (
            isset($_POST['text1']) && 
            isset($_POST['text2']) &&
            isset($_POST['hash'])
        ) {

            
    
            require_once "../TBP-mysql/tbp-conn.php";
            $conn = conectar (
                'localhost',
                'ramiro',
                'tbpplab',
                'tbpplab'
            );
            
            if(existe ($_POST['text1'],$_POST['text2'],$conn)) {
                echo "No se puede registrar. este usuario ya existe.
                <br><a href='http://thebestphproject.local/signup.php?from=tophprojects'>back</a>";
            } else {
               
                if (verificarhash ($_POST['hash'],$conn)) {
                    
                    echo registrar_usuario ($conn,
                        $_POST['text1'],hash("md5",$_POST['text2']),$_POST['hash']
                    );

                } else {
                    echo "No se puede registrar. el hash no existe.
                    <br><a href='http://thebestphproject.local/signup.php?from=tophprojects'>back</a>";
                }
            }

        }
    
    } else {
        header ('Location: http://thebestphproject.local/login.php?from=tophprojects');
    }

}