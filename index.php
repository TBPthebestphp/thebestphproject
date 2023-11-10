<?php session_start();

if (
    isset ($_SESSION['nombre']) &&
    isset ($_SESSION['edad']) &&
    isset ($_SESSION['fecha_nacimiento']) &&
    isset ($_SESSION['nick_name']) &&
    isset ($_SESSION['hash'])
) {
    header ('Location: http://thebestphproject.local/home.php?from=tophprojects');
} else {

    require_once "./TBP-html/tbp-html.php";back();
    require_once "./TBP-form/tbp-form.php";
    require_once "./TBP-css/tbp-css.php";

    echo tbpcontenedor (
        "<h1>T H E BEST P H P</h1>
        
        <div style='
            display:flex;
            width: 100%;
            height: 450px;
            justify-content: center;
            align-items: center;
            background-color: rgb(42, 138, 63);
            margin: 10px 0px;
        '>
        
            <img src='./TBP-html/imgs/logo/logo.jpg' alt='img' width=100% height=100%>

        </div>
        
        ",
        "TBP the source",
        tbpcss("./TBP-css/tbpcss.css"),
        '<a href="http://thebestphproject.local/login.php?from=tophprojects">login</a>
        <a href="http://thebestphproject.local/signup.php?from=tophprojects">sign up</a>'.
        $_SESSION['from']
    );

}