<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RiffIndex</title>
    <link rel="icon" href="images/electrics.png" type="image/png">
    <link rel="stylesheet" href="styles.css">
    <style>
        .header-right button {
            background-color: #444;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
        }

        .header-right button:hover {
            background-color: #555;
        }
    </style>
</head>

<body>
    <div class="header">
        <span class="open-sidenav">&#9776;</span>

        <div class="logo-container">
            <a href="index.php" class="logo">RiffIndex</a>
        </div>

        <div class="header-right">
            <a href="about.php" class="about-link">About</a>
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                <!-- If the user is logged in, show the username button -->
                <button class="user-button" data-username="<?php echo htmlspecialchars($_SESSION['user_name']); ?>">
                    <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                </button>
            <?php else: ?>
                <!-- If not logged in, show login/signup links -->
                <a href="login.php">Login</a>
                <a href="signup.php">Sign Up</a>
            <?php endif; ?>
        </div>
    </div>

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn">&times;</a>
        <a href="index.php">Home</a>
        <a href="riff.php">Riff</a>
        <a href="band_database.php">Database</a>
        <a href="signup.php">Sign up</a>
        <a href="login.php">Log in</a>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidenav = document.getElementById("mySidenav");
            const openButton = document.querySelector(".open-sidenav");
            const closeButton = sidenav.querySelector(".closebtn");

            // Open sidenav on clicking the open button
            if (openButton && sidenav) {
                openButton.addEventListener("click", function() {
                    sidenav.style.width = "250px";
                    document.getElementById("main")?.style.setProperty("margin-left", "250px");
                });
            }

            // Close sidenav when the close button is clicked
            if (closeButton && sidenav) {
                closeButton.addEventListener("click", function() {
                    sidenav.style.width = "0";
                    document.getElementById("main")?.style.setProperty("margin-left", "0");
                });
            }

            // Handle user button hover and logout logic
            const userButton = document.querySelector(".user-button");
            if (userButton) {
                const username = userButton.dataset.username;
                userButton.addEventListener("mouseenter", function() {
                    userButton.textContent = "Logout";
                });

                userButton.addEventListener("mouseleave", function() {
                    userButton.textContent = username;
                });

                // Redirect to logout when user clicks the button
                userButton.addEventListener("click", function() {
                    if (userButton.textContent === "Logout") {
                        window.location.href = "logout.php";
                    }
                });
            }
        });
    </script>
</body>

</html>