
<?php 
error_reporting(0);
 session_start([
    'cookie_lifetime'=>300,
 ]);

$error=false;

$username=filter_input(INPUT_POST, 'username',FILTER_SANITIZE_STRING);
$password=filter_input(INPUT_POST, 'password',FILTER_SANITIZE_STRING);

$fp=fopen("..\crud\inc\data\user.txt","r");


   /*if (isset($_POST['username']) && isset($_POST['password'] )) {
     if ('admin'==$_POST['username'] && '21232f297a57a5a743894a0e4a801fc3'==md5($_POST['password'])) {
         $_SESSION['loggedin']=true;
        
     }else{
        $_SESSION['loggedin']=false;
        $error=true;
     }
      
   }*/ 


if ($username && $password) {
    $_SESSION['loggedin']=false;
    $_SESSION['user']=false;
    $_SESSION['role']=false;
    while ($data=fgetcsv($fp)) {
        
        if ($data[0]==$username && $data[1]==md5($password)) {
         $_SESSION['loggedin']=true;
         $_SESSION['user']=$username;
         $_SESSION['role']=$data[2];
         header('location:index.php');
        
        }

    }
    if ( !$_SESSION['loggedin']) {
        $error=true;
        
    }
    
}


 

if (isset($_GET['logout'])) {
    $_SESSION['loggedin']=false;
    $_SESSION['user']=false;
    $_SESSION['role']=false;
    session_destroy();
    header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Example</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="//cdn.rawgit.com/necolas/normalize.css/master/normalize.css">
    <link rel="stylesheet" href="//cdn.rawgit.com/milligram/milligram/master/dist/milligram.min.css">
    <style>
        body {
            margin-top: 30px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="column column-60 column-offset-20">
            <h2>Simple Auth Example</h2>
            
            <hr/>
            	
        </div>
    </div>

    <div class="row">
        <div class="column column-60 column-offset-20">
            <?php //echo md5('admin'); ?>

            <?php if (true==$error) {
                echo "<blockquote> User Name and Password is incorrect  </blockquote>";
            } ?>

            <?php 

            if(true==($_SESSION['loggedin'])){
                echo "Hello Admin, Welcome!";
            }else{
                echo  "Hello Stranger, Login below";
            }
            ?>

           
                
        </div>
    </div>
   
   


        <div class="row">
            <div class="column column-60 column-offset-20">
                <?php 

                if (false==$_SESSION['loggedin']):  ?>

                    <form  action="auth.php" method="POST">
                    <label for='fname'>User Name</label>
                    <input type="text" name="username" id="username" value="<?php // echo $fname ;?>">
                    <label for='lname'>Password</label>
                    <input type="password" name="password" id="password" value="<?php //echo $lname ;?>">
                    
                    <button type="submit" class="button-primary"  name="submit">Login</button>
                    
                </form>
                    
                <?php     
                else: ?>
                    <form  action="auth.php"  method="POST">
                    <input type="hidden" name="logout" value="l">
                    <button type="submit" class="button-primary"  name="submit">Logout</button>
                    
                </form>
                <?php endif; ?>

            </div>
        </div>
   
   
</div>
<script  src="..\crud\assets\js\script.js"> </script>
</body>

</html>