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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (
            isset($_POST['text1']) && 
            isset($_POST['text2']) 
        ) {
            
            require_once "../TBP-mysql/data.php";
            require_once "../TBP-mysql/tbp-conn.php";

            $conn = conectar (
                'localhost',
                'ramiro',
                'tbpplab',
                'tbpplab'
            );
            
            if(existe ($_POST['text1']."|".$_POST['text2'],$conn)) {
                
                if (setear($_POST['text1'],hash("md5",$_POST['text2']),$conn)) {
                    header ('Location: http://thebestphproject.local/login.php?from=tophprojects');
                } else {
                    echo setear($_POST['text1'],hash("md5",$_POST['text2']),$conn);
                }

            } else {
                echo "Error al iniciar sesion<br>
                <a href='http://thebestphproject.local/signup.php?from=tophprojects'>try again</a>";
            }
    
        }
    
    } else {
        header ('Location: http://thebestphproject.local?from=tophprojects');
    }

}