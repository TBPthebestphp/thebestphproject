<?php session_start();

if (
    isset ($_SESSION['nombre']) &&
    isset ($_SESSION['edad']) &&
    isset ($_SESSION['fecha_nacimiento']) &&
    isset ($_SESSION['nick_name']) &&
    isset ($_SESSION['hash'])
) {

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