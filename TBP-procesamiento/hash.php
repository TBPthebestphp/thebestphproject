<?php  session_start();

if (
    isset ($_SESSION['nickname']) &&
    isset ($_SESSION['userhash']) &&
    isset ($_SESSION['name']) &&
    isset ($_SESSION['nacimiento']) &&
    isset ($_SESSION['edad'])
) {

    header ('Location: http://thebestphproject.local/home.php?from=tophprojects');

} else {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        

        if (
            isset($_POST['text1']) && 
            isset($_POST['text2']) &&
            isset($_POST['fecha']) &&
            isset($_POST['chars'])
        ) {
    
            
            require_once "../TBP-mysql/data.php";
            require_once "../TBP-mysql/tbp-conn.php";
            
            $conn = conectar (
                'localhost',
                'ramiro',
                'tbpplab',
                'tbpplab'
            );

            

            if (existe_person ($_POST['text1'],$_POST['text2'],$_POST['fecha'],$_POST['chars'],$conn)) {
                
                echo "No se puede registrar. este usuario ya existe.<br>
                <a href='http://thebestphproject.local/createhash.php?from=tophprojects'>try again</a>";
                
            } else {
                
                echo registrar_hash ($conn,
                    $_POST['text1'],(int)$_POST['text2'],
                    $_POST['fecha'],$_POST['chars']
                );
            }
    
        }
    
    } else {
        header ('Location: http://thebestphproject.local/createhash.php?from=tophprojects');
    }

}