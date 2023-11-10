<?php session_start();

if (
    isset ($_SESSION['nickname']) &&
    isset ($_SESSION['userhash']) &&
    isset ($_SESSION['name']) &&
    isset ($_SESSION['nacimiento']) &&
    isset ($_SESSION['edad'])
) {

    session_unset();
    session_destroy();
    header('Location:http://thebestphproject.local?from=tophprojects');

} else {

    header ('Location: http://thebestphproject.local/login.php?from=tophprojects');

}