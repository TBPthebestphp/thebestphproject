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
            "./TBP-procesamiento/hash.php",
            "POST",
            "Nombre",
            "crear hash",
            "
            <label>

                <input type='number' 
                placeholder='edad'
                name='text2' 
                id='text2'
                required >
            
            </label>
            <label>

                <input type='text' 
                placeholder='Fecha de nacimiento'
                name='fecha' 
                id='fecha'
                required >
            
            </label>
            <label>

                <input type='text' 
                placeholder='Crea un Nick-Name'
                name='chars' 
                id='chars'
                required >
            
            </label>
            "
        ),
        "TBP-CREATE HASH the source",
        tbpcss("./TBP-css/tbpcss.css"),
        $_SESSION['from']
    );

}