<?php

function tbpcontenedor ($contenido,$title,$css,$menu) {

    $pagina = '
    
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Onest:wght@200&family=Pixelify+Sans&display=swap" rel="stylesheet">
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="icon" type="image/x-icon" href="TBP-html/imgs/favicon/favicon.ico">
            <title>'.$title.'</title>
            '.$css.'
        </head>
        <body>
            <div class="home">
                '.$menu.'
                <a href="http://thebestphproject.local?from=tophprojects">home</a>
                <a>|-whatever ideas-</a>
            </div>
            '.
            $contenido
            .tbpftr().'
        </body>
        </html>

    ';

    return $pagina;

}

function tbptabla ($conn,$hash,$block) {

    $sql = "SELECT id,title,informacion,fecha_registro FROM registro WHERE nickname_hash='$hash'";
    $result = $conn->query($sql);
    $registros = '';

    if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()) {

            if(!empty($row['informacion'])){
                if($block) {

                    $registros .= "<tr><td>
                    <a href='http://thebestphproject.local/TBP-procesamiento/deletebyid.php?id=".
                    $row['id']."'>
                    <img src='TBP-html/imgs/delete.webp' alt='delete' width=50%
                    title='click para eliminar el registro'>
                    </a></td>
                    <td>".$row['title']."</td>
                    <td>".$row['informacion']."
                    </td><td>".$row['fecha_registro'].
                    "</td></tr>";

                } else {

                    $registros .= "<tr><td>".$row['title']."</td>
                    <td>".$row['informacion']."
                    </td><td>".$row['fecha_registro'].
                    "</td></tr>";

                }
            } else {
                continue;
            }
        }
        if ($block) {

            return "
            <table class='tabla'>
                <tr>
                    <th>delete</th>
                    <th>titulo</th>
                    <th>informacion</th>
                    <th>fecha</th>
                </tr>
                $registros
            </table>
            ";

        } else {

            return "
            <table class='tabla'>
                <tr>
                    <th>titulo</th>
                    <th>informacion</th>
                    <th>fecha</th>
                </tr>
                $registros
            </table>
            ";

        }
        

    } else {
        if ($block) {

            return "
            <table class='tabla'>
                <tr>
                    <th>delete</th>
                    <th>titulo</th>
                    <th>informacion</th>
                    <th>fecha</th>
                </tr>
            </table>
            ";

        } else {

            return "
            <table class='tabla'>
                <tr>
                    <th>titulo</th>
                    <th>informacion</th>
                    <th>fecha</th>
                </tr>
            </table>
            ";

        }
    }

    $conn->close();

}
//the best php footer.
function tbpftr () {

    return "<footer class='footer'>
        <a href='http://adminer.local/adminer.php'>Adminer</a>
        <a href='./home.php?block=true'>Eliminar un Registro</a>
        <a href='./?block=false'>Bloquear delete</a>
    </footer>";

}

function ejecutarHtml ($html) {
    return htmlspecialchars_decode($html);
}

function back () {
    if(isset($_GET['from']) && $_GET['from'] === 'tophprojects') {
        $_SESSION['from'] = ' <a href="http://tbpplab.local/">Back</a>';
    } else {
        $_SESSION['from']  = '';
    }
}