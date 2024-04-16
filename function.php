<?php 
    $conn = mysqli_connect("localhost", "root", "", "twt");

    function insert($query){
        global $conn;
        $result = mysqli_query($conn, $query);
        var_dump($result);
        return $result;
    }

    function allTweet(){
        global $conn;
        $rows = [];
        $result = mysqli_query($conn, "SELECT user.username, tweet.content, tweet.createdat FROM tweet JOIN user ON tweet.creator = user.user_id");
        foreach($result as $row){
            $rows[] = $row;
        }
        return $rows;
    }
?>