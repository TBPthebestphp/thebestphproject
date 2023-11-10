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

function existe ($nickname,$hash,$conn) {

    $sql = "SELECT nick_name,hash FROM person";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        
        while($row = $result->fetch_assoc()) {

            if ($nickname == $row["nick_name"] && $hash == $row["hash"]) {
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

   

    $sql = "SELECT nombre,edad,fecha_nacimiento,nick_name FROM person";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()) {
            if (
                $name == $row['nombre'] &&
                $edad == $row['edad'] &&
                $nacimiento == $row['fecha_nacimiento'] &&
                $nickname == $row['nick_name']
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

function registrar_hash ($conn,$name,int $age,$date,$nickname) {

    
    
    $hash = hash('sha256',implode("",[
        $name,$age,$date,$nickname
    ]));

    try {
    
        $sql = "INSERT INTO person (nombre,edad,fecha_nacimiento,nick_name,hash) 
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

function registrar_usuario ($conn,$user,$password,$hash) {
    
    $sql = "INSERT INTO users (person_nick_name,person_hash,password) VALUES ('$user','$hash','$password')";

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
    $sql = "SELECT hash FROM users WHERE person_nick_name='$user' and password='$password'";
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

    $sql = "SELECT name,edad,fecha_nacimiento,nick_name,hash FROM person WHERE hash='$hash'";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()) {
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['edad'] = $row['edad'];
            $_SESSION['fecha_nacimiento'] = $row['fecha_nacimiento'];
            $_SESSION['nick_name'] = $row['nick_name'];
            $_SESSION['hash'] = $row['hash'];
        }

        return true;

    } else {
        return "Error al setear las variables de sesion.";
    }

    $conn->close();
}

function registrar_data ($conn,$title,$info,$hash) {

    $info = htmlspecialchars($info);

    $sql = "INSERT INTO registro (title,informacion,nickname_hash) VALUES ('$title','$info','$hash')";

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