<?php 
    require "function.php";
    if(isset($_POST["create"])){
        if(signup($_POST) > 0){
            echo "<script>alert('User ditambahkan')</script>";
        }
    }

    function signup($data){
        global $conn;
        if(!validation($data)){
            echo "<script>alert('Please fill the form correctly')</script>";
            return false;
        }

        $username = $data["username"];
        $email = $data["email"];
        $hashpass = password_hash($data["password"], PASSWORD_DEFAULT);
        mysqli_query($conn, "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$hashpass')");
        return mysqli_affected_rows($conn);
    }

    function validation($data){
        if($data["username"] !== "" && $data["email"] !== "" && $data["password"] !== ""){
            return true;
        }
        return false;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup | your amazing journey start here!</title>
</head>
<body>
    <h1>Create your twit account</h1>
    <form action="" method="post">
        <input type="text" name="username" placeholder="Username"><br>
        <input type="text" name="email" placeholder="Email"><br>
        <input type="password" name="password" placeholder="Password"><br>
        <button type="submit" name="create">Create!</button>
        <p>Already have account? <a href="login.php">Login</a></p>
    </form>
</body>
</html>