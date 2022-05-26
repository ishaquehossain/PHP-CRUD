
<div class="float-left"> 


        <p>
            <a href="index.php?task=report">All Students</a> |
            <a href="index.php?task=add">Add New Student</a> |
            <a href="index.php?task=seed">Seed</a>


        </p>

</div>
<div class="float-right">
    <?php error_reporting(0);

     if (!$_SESSION['loggedin']): ?>
        <a href="..\crud\auth.php">Login</a>
    <?php else: ?>
        <a href="..\crud\auth.php?logout=true">Logout (<?php echo $_SESSION['role'] ?>)</a>
<?php endif;?>

</div>
