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
        "<h2>Crea un Usuario con tu hash</h2>".tbpform(
            "#",
            "POST",
            "introduce tu nick name creado previamente",
            "registrar",
            "
            
            <label>
        
                <input type='text' 
                placeholder='introduce tu hash creado previamente'
                name='hash' 
                id='hash'
                required >

                <div>
                    <h3>aun no tienes un hash ?</h3>
                    <a href='./createhash.php'>crear hash</a>
                </div>
            
            </label>
        
            <label>
        
                <input type='password' 
                placeholder='crea una password'
                name='text2' 
                id='text2'
                required >
                
            </label>
            "
        ),
        "TBP-SIGNUP the source",
        tbpcss("./TBP-css/tbpcss.css"),
        '<a href="http://thebestphproject.local/login.php?from=tophprojects">login</a>'. 
        $_SESSION['from']
    );

}