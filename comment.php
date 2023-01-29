<?php 
    session_start();
    require('connect.php');

    try{
            $stmt=$conn->prepare("INSERT INTO comments(post_id, user_id, comment) VALUES(?,?,?)");
            $stmt->bindParam(1, $_POST['post_id'], PDO::PARAM_INT);
            $stmt->bindParam(2, $_SESSION['id_logged'], PDO::PARAM_INT);
            $stmt->bindParam(3, $_POST['comment'], PDO::PARAM_STR);
        
        
        if($stmt->execute()){
            $_SESSION['sucess'] = "Comentário enviado";
            header("Location: home.php");
        }
        else{
            $_SESSION['Error'] = "Comentário não enviado";
            header("Location: home.php");
        }
    }
        catch(PDOException $e){
            echo $e->getMessage();
    }

