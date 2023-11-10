<?php

function conectar (
    $servername,
    $username,
    $password,
    $dbname
) {

    // Create connection
    $conn = new mysqli($servername, $username,
     $password,$dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    #echo "Connected successfully";

    return $conn;

}

function eliminar ($id,$conn) {

    $sql = "DELETE FROM registro WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        return "Record deleted successfully 
        <a href='http://thebestphproject.local/home.php?from=tophprojects'>back</a>";
    } else {
        return "Error deleting record: " . $conn->error."  
        <a href='http://thebestphproject.local/home.php?from=tophprojects'>back</a>";
    }

    $conn->close();
}

function existe ($data,$conn) {

    $sql = "SELECT user,password FROM users";
    $result = $conn->query($sql);

    

    if (!empty($data)) {
        $text2 = explode("|",$data)[0];
        $text3 = explode("|",$data)[1];
        
    }

    if ($result->num_rows > 0) {
        
        
        while($row = $result->fetch_assoc()) {
            
            $text0= $row["user"];
            
            $text1 = $row["password"];
            if ($text2 == $text0 && hash("md5",$text3) == $text1) {
                return true;
            }
        }

        return false;

    } else {
        return false;
    }

    $conn->close();

}


function existe_person ($name,$edad,$nacimiento,$nickname,$conn) {

   

    $sql = "SELECT name,edad,nacimiento,nickname FROM person";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()) {
            if (
                $name == $row['name'] &&
                $edad == $row['edad'] &&
                $nacimiento == $row['nacimiento'] &&
                $nickname == $row['nickname']
            ) {
                return true;
            }
        }

        return false;

    } else {
        return false;
    }

    $conn->close();

}

function registrar_hash ($conn,
    $name,int $age,$date,$nickname
) {

    
    
    $hash = hash('sha256',implode("",[
        $name,$age,$date,$nickname
    ]));

    try {
    
        $sql = "INSERT INTO person (name,edad,nacimiento,nickname,hash) 
        VALUES ('$name',$age,'$date','$nickname','$hash')";
        
        if ($conn->query($sql) === TRUE) {
        
            return "New record created successfully<br>
            Tu hash es : $hash <br> Guardelo en un lugar seguro<br>
            lo necesitara para el registro.<br>
            <a href='http://thebestphproject.local/signup.php?from=tophprojects'>sign up</a>";
        } else {
            return "Error: " . $sql . "<br>" . $conn->error."
            <a href='http://thebestphproject.local/createhash.php?from=tophprojects'>try again</a>";
        }

    }catch(Exception $e){
        die("error ".$e);
    }

    $conn->close();

}

function verificarhash ($hash,$conn) {
    

    $sql = "SELECT hash FROM person";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        
        
        while($row = $result->fetch_assoc()) {
            
            if (
                $hash == $row['hash']
                
            ) {
                
                return true;
            }
        }

        return false;

    } else {
        
        return false;
    }

    $conn->close();
}

function registrar_usuario ($conn,
    $user,$password,$hash
) {
    
    $sql = "INSERT INTO users (user,password,hash) VALUES ('$user','$password','$hash')";

    try{

        if ($conn->query($sql) === TRUE) {
        
            return "New record created successfully<br>
            <a href='http://thebestphproject.local/login.php?from=tophprojects'>login</a>";
        } else {
            return "Error: " . $sql . "<br>" . $conn->error."
            <a href='http://thebestphproject.local/signup.php?from=tophprojects'>try again</a>";
        }

    }catch(Exception $e){echo $e;}

    $conn->close();

}

function gethash ($user,$password,$conn) {
    $sql = "SELECT hash FROM users WHERE user='$user' and password='$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()) {
            $hash = $row['hash'];
        }

        return $hash;

    }
}

function setear ($user,$password,$conn) {

    $hash = gethash($user,$password,$conn);

    $sql = "SELECT name,edad,nacimiento,nickname,hash FROM person WHERE hash='$hash'";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()) {
            $_SESSION['nickname'] = $row['nickname'];
            $_SESSION['userhash'] = $row['hash'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['nacimiento'] = $row['nacimiento'];
            $_SESSION['edad'] = $row['edad'];
        }

        return true;

    } else {
        return "Error al setear las variables de sesion.";
    }

    $conn->close();
}

function registrar_data ($conn,$registro,$hash) {

    $registro = explode("|",$registro);

    $registro[0] = "<b>".$registro[0]."</b>";

    $registro = implode("|",$registro);

    $registro = htmlspecialchars($registro);

    $sql = "INSERT INTO registro (registro,hash) VALUES ('$registro','$hash')";

    if ($conn->query($sql) === TRUE) {
        return "successfully <br>
        <a href='http://thebestphproject.local/home.php?from=tophprojects'>back</a>";
    } else {
        return "Error: " . $sql . "<br>" . $conn->error."
        <br>
        <a href='http://thebestphproject.local/home.php?from=tophprojects'>back</a>";
    }

    $conn->close();


}