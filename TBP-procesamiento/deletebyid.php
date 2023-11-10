<?php session_start();

if (
    isset ($_SESSION['nickname']) &&
    isset ($_SESSION['userhash']) &&
    isset ($_SESSION['name']) &&
    isset ($_SESSION['nacimiento']) &&
    isset ($_SESSION['edad'])
) {

    require_once "../TBP-mysql/data.php";
    require_once "../TBP-mysql/tbp-conn.php";

    if (isset($_GET['id'])) {
        echo eliminar(
            $_GET['id'],
            conectar (
                'localhost',
                'ramiro',
                'tbpplab',
                'tbpplab'
            )
        );
    }
    
} else {

    header ('Location: http://thebestphproject.local/login.php?from=tophprojects');

}