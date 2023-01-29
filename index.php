<?php 
    session_start();
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
    <title>Login</title>
</head>
<body>
    <div class="box">
        <h2 class="h2">
            Social Network
        </h2>
        <form action="login.php" method="post" class="form">
            <?php 
                if(isset($_SESSION['error'])){
                    echo "<span class='error'>" . $_SESSION['error'] . "</span>"; 
                }
            ?>
            <input type="text" name="user" id="user" class="input" placeholder="Digite seu usuário">
            <button type="submit" class="btn">Entrar</button>
        </form>
    </div>
</body>
</html>