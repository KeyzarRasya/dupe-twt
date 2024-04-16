<?php
    require "function.php";
    session_start();


    if(isset($_POST["login"])){
        if(login($_POST)){
            header("Location: menu.php");
        }
    }

    function login($data){
        global $conn;
        $email = $data["email"];
        $password = $data["password"];
        $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
        $resassoc = mysqli_fetch_assoc($result);
        if($resassoc == NULL){
            echo "<script>alert('Data tidak digunakan')</script>";
            return false;
        }

        if(password_verify($password, $resassoc["password"])){
            $_SESSION['login'] = true;
            setcookie('id', $resassoc["user_id"], time() * 60);
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
    <title>Login to your account</title>
</head>
<body>
    <h1>Login</h1>
    <form action="" method="post">
        <input type="text" placeholder="email" name="email"><br>
        <input type="password" placeholder="password" name="password"><br>
        <button type="submit" name="login">Login</button>
        <p>don't have account? <a href="index.php">Sign up!</a></p>
    </form>
</body>
</html>