<?php
include('auth_check.php'); // Ensures the user is authenticated
?>
<div id="mySidenav" class="sidenav">
    <!-- Close button to hide the side navigation -->
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="index.php">Home</a>
    <a href="riff.php">Riff</a>
    <a href="band_database.php">Database</a>
    <a href="signup.php">Sign up</a>
    <a href="login.php">Log in</a>
</div>

<script>
    // Open the side navigation
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
    }

    // Close the side navigation
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
    }
</script>