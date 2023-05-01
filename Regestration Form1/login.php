<!DOCTYPE html>
<html>
<head>
  <title>Page Title</title>
</head>
<body>

<form action="login.php" method="POST">
  <label for="username">Username:</label>
  <input type="text" id="username" name="username" required>

  <label for="password">Password:</label>
  <input type="password" id="password" name="password" required>

  <button type="submit" name="login">Login</button>
</form>


</body>
</html>


<?php
session_start();

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Query database for user with given username
  $conn = new mysqli('localhost', 'shivam112', 'm0mandp4p4', 'mydatabasenew');
  $stmt = $conn->prepare("SELECT id, username, password FROM user_table WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();
  $stmt->close();
  $conn->close();

  // Verify password and log user in
  if (password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    header("Location:\Upload System\display1.php ");
    exit;
  } else {
    $error_msg = "Invalid username or password";
  }
}
?>