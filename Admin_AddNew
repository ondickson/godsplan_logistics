<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

// Database connection
$host = 'localhost';
$dbname = 'godsplan_db';
$username = 'root';
$password = 'root';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}

// Handle user submission (if form is submitted)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Hash the password before storing
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  try {
    $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      echo '<script>alert("User added successfully!")</script>';
      // Or redirect to user list page:
      header("Location: index.php?page=user_list");
      exit();
    } else {
      echo '<script>alert("Failed to add user!")</script>';
    }
  } catch (PDOException $e) {
    echo '<script>alert("Error: ' . $e->getMessage() . '")</script>';
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>God's Plan Logistics - Add New Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/Admin_AddNew.css">
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
            <h1>ADD NEW ADMIN</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="manage_user">
                <div>
                    <b>Personal Information</b>
                    <div>
                        <label for="firstname">First Name</label>
                        <input type="text" name="firstname" id="firstname" required value="">
                    </div>
                    <div>
                        <label for="lastname">Last Name</label>
                        <input type="text" name="lastname" id="lastname" required value="">
                    </div>
                </div>
                <div>
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required value="">
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                </div>
                <div>
                    <button type="submit">Save</button>
                    <button type="button" onclick="location.href = 'index.php?page=user_list'">Cancel</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
