<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0);" class="closebtn" onclick="SimpleChat.closeNav();">&times;</a>
    <a href="/" style="white-space: nowrap;">Home</a>
    <?php
    if(!isset($_COOKIE["logged_in"])){
        ?>
        <a href="login.php" style="white-space: nowrap;">Sign In</a>
        <a href="register.php" style="white-space: nowrap;">Register</a>
        <?php
    }else{
        ?>
        <a href="new.php" style="white-space: nowrap;">New Chat Room</a>
        <a href="find.php" style="white-space: nowrap;">Find Chat Room</a>
        <a href="logout.php" style="white-space: nowrap;">Sign Out</a>
        <?php
    }
    ?>
</div>