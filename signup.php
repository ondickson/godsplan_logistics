<?php
session_start();
require_once 'db_connection.php';

// Initialize variables to hold user input
$firstname = $lastname = $email = $password = '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password']; // Password will be hashed later

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Check if email already exists in database
    $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `email` = :email");
    $stmt->execute(['email' => $email]);
    $existingUser = $stmt->fetch();
    if ($existingUser) {
        $errors[] = "Email already exists";
    }

    // If no errors, proceed to insert into database
    if (empty($errors)) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into database
        $insertStmt = $pdo->prepare("INSERT INTO `users` (firstname, lastname, email, password, date_created) 
                                    VALUES (:firstname, :lastname, :email, :password, NOW())");
        $insertStmt->execute([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $hashed_password
        ]);

        // Redirect to login page or any other page after successful signup
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Signup</title>
  <style>
    /* Body Styles (Adjust background image path if needed) */
    body {
      margin: 0;
      padding: 0;
      background-image: url('"C:\xampp\htdocs\godsplan_logistics\images\pexels-rdne-7363190.jpg"');
      background-size: cover;
      background-position: center;
      font-family: Arial, sans-serif;
    }

    /* Signup Form Container Styles */
    #signup-container {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: rgba(255, 255, 255, 0.8);
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      width: 100%;
      text-align: center;
    }

    /* Signup Form Styles */
    .signup-form {
      padding: 10px;
    }

    /* Form Labels */
    .signup-form label {
      display: block;
      margin-bottom: 5px;
    }

    /* Form Input Fields */
    .signup-form input[type="text"],
    .signup-form input[type="email"],
    .signup-form input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }

    /* Submit Button */
    .signup-form input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #6d24aa;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    /* Submit Button Hover Effect */
    .signup-form input[type="submit"]:hover {
      background-color: #6d24ab;
    }
  </style>
</head>
<body>
  <div id="signup-container">
    <h2>Signup Form</h2>
    <?php if (!empty($errors)) : ?>
      <div style="color: red;">
        <?php foreach ($errors as $error) : ?>
          <p><?php echo $error; ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    <form class="signup-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <label for="firstname">First Name:</label>
      <input type="text" id="firstname" name="firstname" value="<?php echo $firstname; ?>"><br><br>
  
      <label for="lastname">Last Name:</label>
      <input type="text" id="lastname" name="lastname" value="<?php echo $lastname; ?>"><br><br>
  
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br><br>
  
      <label for="password">Password:</label>
      <input type="password" id="password" name="password"><br><br>
  
      <input type="submit" value="Signup">
    </form>
  </div>
</body>
</html>
