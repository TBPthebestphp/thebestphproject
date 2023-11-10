<?php session_start();

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

    require_once "./TBP-html/tbp-html.php";
    require_once "./TBP-form/tbp-form.php";
    require_once "./TBP-css/tbp-css.php";

    echo tbpcontenedor (
        "<h2>Inicia Sesion</h2>".tbpform(
            "TBP-procesamiento/login.php",
            "POST",
            "Nick name",
            "Iniciar Sesion",
            "
            <label>
        
                <input type='password' 
                placeholder='password'
                name='text2' 
                id='text2'
                required >
                
            </label>
        
            <label>
        
                <input type='text' 
                placeholder='hash'
                name='hash' 
                id='hash'
                required >
            
            </label>
            "
        ),
        "TBP-LOGIN the source",
        tbpcss("./TBP-css/tbpcss.css"),
        '<a href="http://thebestphproject.local/signup.php?from=tophprojects">sign up</a>'. 
        $_SESSION['from']
    );

}