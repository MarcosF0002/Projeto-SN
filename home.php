<?php
    session_start();
    require('connect.php'); 

    if(!isset($_SESSION['user_logged'])){
        header("location: index.php");
    }

    try{
        $stmt = $conn->prepare("SELECT p.id, p.post, u.user FROM posts p JOIN users u ON p.user_id = u.id ORDER BY p.id desc");
        $stmt->execute();
        $posts = $stmt->fetchAll();
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/styles.css">
    <title>Web1 Social</title>
</head>
<body>
    <div class="box-home">
        <h3 class="h3">
            Olá <?php  echo ucfirst($_SESSION['user_logged'])?>
        </h3>

        <?php 
            if(isset($_SESSION['sucess'])){
                echo '<span class="sucess">' . $_SESSION['sucess'] . '</span>';

            }
            if(isset($_SESSION['error'])){
                echo '<span class="error">' . $_SESSION['error'] . '</span>';
            }
            unset($_SESSION['sucess']);
            unset($_SESSION['sucess']);
        ?>

        <form action="post.php" method="post" class="form-post">
            <textarea name="post" id="post" class="input" placeholder="No que você está pensando?"></textarea>
            <button type="submit" class="btn btn-post">Postar</button>
        </form>
        <div class="posts">
            <?php 
                foreach($posts as $post){
                $stmt = $conn->prepare("select count(*) as likes from likes where post_id = " . $post['id']);                 
                $stmt->execute();
                $likes = $stmt->fetchAll();
                
           ?>

            <div class="post">
                <p class="user"><?php echo $post['user']; ?></p>
                <p class="text-post"><?php echo $post['post']; ?></p>
                <div class="items">
                    <ul>
                        <li>
                            <form action="like.php" method="post">
                                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                <button type="submit" class="btn-like">Like <?php echo $likes[0]['likes']; ?></button>
                            </form> 
                        </li>
                    </ul>
                </div>
                <div class="comments">
                    <p class="title-comments">Comentários</p>
                    <form action="comment.php" method="post">
                        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                        <input type="text" name="comment" id="comment" class="comment-input" placeholder="Comente algo">
                        <button type="submit" class="btn-comment">Enviar</button>
                        </form>
                        <?php 
                            $stmt = $conn->prepare("SELECT c.id, c.comment, u.user FROM comments c JOIN users u ON c.user_id = u.id WHERE c.post_id = " . $post['id'] . " ORDER BY c.id desc");
                            $stmt->execute();
                            $comments = $stmt-> fetchAll();

                            foreach($comments as $comment){  
                        ?>
                            <div class="coment">
                                <p class="user"><?php echo $comment['user'] ?></p>
                                <p class="text-coment"><?php echo $comment['comment'] ?></p>
                            </div>
                        <?php } ?>    
                    </div> 
            </div>
            <hr> 
            <?php } ?>
        </div>
    </div>
    
</body>
</html>