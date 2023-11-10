<?php

function tbpcontenedor ($contenido,$title,$css,$menu) {

    $pagina = '
    
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    $sql = "SELECT id,registro,fecha_de_registro FROM registro WHERE hash='$hash'";
    $result = $conn->query($sql);
    $registros = '';

    if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()) {
            if(!empty($row['registro'])){
                if($block) {

                    $registros .= "<tr><td>
                    <a href='http://thebestphproject.local/TBP-procesamiento/deletebyid.php?id=".
                    $row['id']."'>
                    <img src='./TBP-html/imgs/delete_database.webp' alt='delete' width=50%
                    title='click para eliminar el registro'>
                    </a></td><td>".$row['registro']."
                    </td><td>".$row['fecha_de_registro'].
                    "</td></tr>";

                } else {

                    $registros .= "<tr><td>".$row['registro']."
                    </td><td>".$row['fecha_de_registro'].
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
                    <th>registro</th>
                    <th>fecha</th>
                </tr>
                $registros
            </table>
            ";

        } else {

            return "
            <table class='tabla'>
                <tr>
                    <th>registro</th>
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
                    <th>registro</th>
                    <th>fecha</th>
                </tr>
            </table>
            ";

        } else {

            return "
            <table class='tabla'>
                <tr>
                    <th>registro</th>
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
        <a href='http://adminer.local'>Adminer</a>
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