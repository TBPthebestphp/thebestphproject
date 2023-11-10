<?php  session_start();

if (
    isset ($_SESSION['nickname']) &&
    isset ($_SESSION['userhash']) &&
    isset ($_SESSION['name']) &&
    isset ($_SESSION['nacimiento']) &&
    isset ($_SESSION['edad'])
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