<?php

$is_invalid = false; //to show an error message when username is wrong or empty
$pass_invalid = false;//to shaw an error message when password is wrong or empty

include "config.php";
if($_SERVER["REQUEST_METHOD"] === "POST"){
    
    try {
        
        $sql = "SELECT*FROM user WHERE email = :email";
        $stmnt = $con1->prepare($sql);
        $stmnt->execute(['email'=>$_POST["email"]]);
        $user = $stmnt ->fetch(PDO::FETCH_ASSOC);

        if($user){
            if(password_verify($_POST["password"], $user["password_hash"])){

                session_start();
            
                session_regenerate_id();
                
                $_SESSION["user_id"] = $user["id"];
                
                header("Location: index.php");
                exit;
                die ("Welcome " .$user['username']);
            }
            else{
                $pass_invalid = true;
            }
        }
        else{
            $is_invalid = true;
        }

        
    } 
    catch (\PDOException $e) {
    
    }
}

?>

<DOCTYPE html>
    <html>

    <head>
        <title>Sign in</title>
        <meta charset="UTF-8">
        <script src="https://kit.fontawesome.com/4577eded13.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style1.css">
    </head>

    <body>
        <div class="box">
            <div class="header">
                <h1>Sign in to your account</h1>
            </div>           
            
            <form  method="post" id="signin" class="form" novalidate>
                <?php if ($is_invalid): ?>
                    <em>Empty username or user doesn't exist</em>
                <?php endif; ?>
                <?php if ($pass_invalid): ?>
                    <em>Invalid or empty password</em>
                <?php endif; ?>
                <div class="txt_field">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>
                    
                </div>
                <div class="txt_field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>
                    
                </div>
                <div>
                    <p>Don't have an account yet? Click <a href="http://localhost/WAD/selfstudy/signup_signin/signup.html">here</a> to create one</p>
                    
                </div>
                <input type="submit" value="Sign in" id="submit" name="submit">
            </form>
        </div>

    </body>

    </html>