<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not, redirect to the login page
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>God's Plan Logistics - Add New Parcel</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="logo"><img
                  class="logo"
                  src="../images/godsplanlogo.jpg"
                  alt="logo"
                /></div>
            <nav>
                <a class="logout" href="logout.php">Logout</a>
            </nav>
        </div>
    </header>

    <div class="content">
        <div class="sidebar1">
            <?php include 'sidebar.php' ?>
        </div> 
        <div class="mainContent">
            <h1>ADD NEW PARCEL</h1>
        </div>
        
    </div>



    <!-- Main Footer -->
    <!-- <footer class="footer">
        <strong>Copyright &copy; 2024 <a href="https://www.facebook.com/ONDicksonBeatz/">Dickson Owusu Nyantakyi</a>.</strong>
        All rights reserved.
    </footer> -->

</body>
</html>
