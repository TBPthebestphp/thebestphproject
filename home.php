<?php session_start();

if (
    isset ($_SESSION['nombre']) &&
    isset ($_SESSION['edad']) &&
    isset ($_SESSION['fecha_nacimiento']) &&
    isset ($_SESSION['nick_name']) &&
    isset ($_SESSION['hash'])
) {

    require_once "./TBP-html/tbp-html.php";
    require_once "./TBP-form/tbp-form.php";
    require_once "./TBP-css/tbp-css.php";
    require_once "./TBP-mysql/data.php";
    require_once "./TBP-mysql/tbp-conn.php";

    $conn = conectar (
        'localhost',
        'ramiro',
        'tbpplab',
        'tbpplab'
    );

    if (isset($_GET['block'])) {
        $tabla = tbptabla($conn,$_SESSION['userhash'],$_GET['block']);
        
    } else {
        $tabla = tbptabla($conn,$_SESSION['userhash'],false);   
    }
    
    try{
    echo tbpcontenedor (
        "<header class='header'><h1>H I : ".$_SESSION['nickname']."</h1>
        <a href='#top' class='button'>UP</a>
        <h2>hash : ".$_SESSION['userhash']."</h2></header>".
        "<h2>Almacena informacion en la base de datos !</h2>".tbpform(
            "#",
            "POST",
            "title",
            "guardar",
            "<label>      
                <textarea
                    name='text2'
                    id='text2'
                    placeholder='information here'
                    required
                ></textarea>
            </label>"
        ).
        "<a id='REGISTROS'></a>".
        ejecutarHtml($tabla),
        "The Best Php the source",
        tbpcss("./TBP-css/tbpcss.css"),
        '<a id="top"></a>
        <a href="http://thebestphproject.local/TBP-procesamiento/logout.php">logout</a>
        <a href="#REGISTROS">REGISTROS</a>'. 
        $_SESSION['from']
    );
    }catch(Exception $e){
        die("error ".$e);
    }
    

} else {
    header ('Location: http://thebestphproject.local/login.php?from=tophprojects');
}