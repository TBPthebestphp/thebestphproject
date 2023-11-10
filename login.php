<?php session_start();

if (
    isset ($_SESSION['nickname']) &&
    isset ($_SESSION['userhash']) &&
    isset ($_SESSION['name']) &&
    isset ($_SESSION['nacimiento']) &&
    isset ($_SESSION['edad'])
) {
    header ('Location: http://thebestphproject.local/home.php?from=tophprojects');
} else {

    require_once "./TBP-html/tbp-html.php";
    require_once "./TBP-form/tbp-form.php";
    require_once "./TBP-css/tbp-css.php";

    echo tbpcontenedor (
        tbpform(
            "./TBP-procesamiento/login.php",
            "POST",
            "Usuario",
            "Iniciar Sesion",
            "
            <label>

                <input type='password' 
                placeholder='password'
                name='text2' 
                id='text2'
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