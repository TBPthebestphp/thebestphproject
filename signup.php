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

    require_once "./TBP-html/tbp-html.php";back();
    require_once "./TBP-form/tbp-form.php";
    require_once "./TBP-css/tbp-css.php";

    echo tbpcontenedor (
        tbpform(
            "./TBP-procesamiento/signup.php",
            "POST",
            "usuario",
            "registrar",
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

                <div>
                    <h3>aun no tienes un hash ?</h3>
                    <a href='./createhash.php'>crear hash</a>
                </div>
            
            </label>
            "
        ),
        "TBP-SIGNUP the source",
        tbpcss("./TBP-css/tbpcss.css"),
        '<a href="http://thebestphproject.local/login.php?from=tophprojects">login</a>'. 
        $_SESSION['from']
    );

}