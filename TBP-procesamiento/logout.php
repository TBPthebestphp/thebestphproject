<?php session_start();

if (
    isset ($_SESSION['nombre']) &&
    isset ($_SESSION['edad']) &&
    isset ($_SESSION['fecha_nacimiento']) &&
    isset ($_SESSION['nick_name']) &&
    isset ($_SESSION['hash'])
) {

    session_unset();
    session_destroy();
    header('Location:http://thebestphproject.local?from=tophprojects');

} else {

    header ('Location: http://thebestphproject.local/login.php?from=tophprojects');

}