<?php  session_start();

if (
    isset ($_SESSION['nombre']) &&
    isset ($_SESSION['edad']) &&
    isset ($_SESSION['fecha_nacimiento']) &&
    isset ($_SESSION['nick_name']) &&
    isset ($_SESSION['hash'])
) {

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

            $registro = $_POST['text1']." | ".$_POST['text2'];
                
            echo registrar_data ($conn,$registro,$_SESSION['userhash']);
                
    
        }
    
    } else {
        header ('Location: http://thebestphproject.local/home.php?from=tophprojects');
    }

} else {

    header ('Location: http://thebestphproject.local/login.php?from=tophprojects');

}