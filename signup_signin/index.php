<?php

session_start();
if(isset($_SESSION["user_id"])){
    include "config.php";
    $sql = "SELECT*FROM user WHERE id = {$_SESSION["user_id"]}";
    $stmnt = $con1->prepare($sql);
    $stmnt->execute();
    $user = $stmnt ->fetch(PDO::FETCH_ASSOC);
}

?>
<DOCTYPE html>
    <html>

    <head>
        <title>Sign in</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="">
    </head>

    <body>
        <div class="box">
            <h1>Home</h1>
            <?php if (isset($user)): ?>
        
                <p>Welcome <?= htmlspecialchars($user["username"]) ?></p>
                
                <p><a href="logout.php">Log out</a></p>
            
            <?php else: ?>
                
                <p><a href="http://localhost/WAD/selfstudy/signup_signin/signin.php">Sign in</a>
                 or <a href="http://localhost/WAD/selfstudy/signup_signin/signup.html">Create</a> an account</p>
                
            <?php endif; ?>

        </div>
        <div>
            <?php

            if(isset($user)){
                if(isset($_GET['page'])){
                    $page=$_GET['page'];
                }
                else{
                    $page=1;
                }
    
                $rows_per_page = 3;
                $start_from =($page-1)*$rows_per_page;
    
                $sql1 = "SELECT * FROM user limit $start_from,$rows_per_page";
                $stmt = $con1->prepare($sql1);
                $stmt->execute();
    
                
    
                ?>
    
                <table border="1">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                    </tr>
                    <?php
                    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                        //echo $r['id']."-".$r["name"]."<br>";
    
                        echo "<tr>
                            <td>".$row['id']."</td>
                            <td>".$row['username']."</td>
                            <td>".$row['email']."</td>
                            </tr>";
                    }
                    ?>
                    
                </table>
                <?php
    
                $rs_sql="SELECT*FROM user";
                $rs_stmt = $con1->prepare($rs_sql);
                $rs_stmt->execute();
    
                $tot_records=$rs_stmt->rowCount();
                $tot_pages=ceil($tot_records/$rows_per_page);
    
                if($page>1){
                    echo "<a href='index.php?page=".($page-1)."'>PREVIOUS</a>";
                    echo "\t";
                }
                
                for($i=1;$i<=$tot_pages;$i++){
    
                    echo "<a href='index.php?page=".$i."'>$i</a\t>";
                    echo "\t";
    
                }
    
                if($i-1>$page){
                    echo "<a href='index.php?page=".($page+1)."'>NEXT</a\t>";
                }
            }      

            ?>
            
            
        </div>
    </body>
    </html>
</DOCTYPE>