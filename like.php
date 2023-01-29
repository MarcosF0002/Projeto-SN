<?php 
    session_start();
    require('connect.php');

    try{
        $stmt = $conn->prepare("INSERT INTO likes(post_id, user_id) VALUES(?,?)");
        $stmt->bindParam(1, $_POST['post_id'], PDO::PARAM_INT);
        $stmt->bindParam(2, $_SESSION['id_logged'], PDO::PARAM_INT);
       
   
        if($stmt->execute()){
            $_SESSION['sucess'] = "Like Enviado";
            header("Location: home.php");
        }
        else{
            $_SESSION['error'] = "Like não Enviado";
            header("Location: home.php");
        }
    }catch(PDOException $e) {
            echo $e->getMessage();
    }

?>    