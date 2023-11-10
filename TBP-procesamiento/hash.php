<?php  session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
            isset($_POST['text2']) &&
            isset($_POST['fecha']) &&
            isset($_POST['nickname'])
        ) {
    
            
            
            require_once "../TBP-mysql/tbp-conn.php";
            
            $conn = conectar (
                'localhost',
                'ramiro',
                'tbpplab',
                'tbpplab'
            );

            

            if (existe_person ($_POST['text1'],$_POST['text2'],$_POST['fecha'],$_POST['nickname'],$conn)) {
                
                echo "No se puede registrar. este usuario ya existe.<br>
                <a href='http://thebestphproject.local/createhash.php?from=tophprojects'>try again</a>";
                
            } else {
                
                echo registrar_hash ($conn,
                    $_POST['text1'],(int)$_POST['text2'],
                    $_POST['fecha'],$_POST['nickname']
                );
            }
    
        }
    
    } else {
        header ('Location: http://thebestphproject.local/createhash.php?from=tophprojects');
    }

}