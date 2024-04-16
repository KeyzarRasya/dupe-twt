<?php 
    require "function.php";
    session_start();
    if(!isset($_SESSION["login"])){
        return header("Location: login.php");
    }
    $tweet = allTweet();

    if(isset($_POST["upload"])){
        if(uploadTweet($_POST) > 0){
            header("Location: menu.php");
        }
    }

    function uploadTweet($data){
        global $conn;
        $content = $_POST["tweet"];
        $idsender = intval($_COOKIE["id"]);
        mysqli_query($conn, "INSERT INTO tweet (content, creator) VALUES ('$content', '$idsender')");
        return mysqli_affected_rows($conn);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="menu.css">
    <title>Enjoy ur day</title>
</head>
<body class="container">
    <div class="content">
        <?php foreach($tweet as $twt) :?>
        <div class="card">
            <p class="uname"><?= $twt["username"]?></p>
            <p><?= $twt["content"]?></p>
            <p>created at <?= $twt["createdat"]?></p>
        </div>
        <?php endforeach;?>
    </div>
    <a href="logout.php">Logout</a>
    <form action="" method="post" class="tform">
        <textarea type="text" name="tweet" placeholder="Tweet here!"></textarea>
        <button type="submit" name="upload">Upload!</button>
    </form>
</body>
</html>