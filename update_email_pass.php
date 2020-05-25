<?php include('server.php') ?>

<?php

if(isset($_POST['UPDATE'])) {
  $email = mysqli_real_escape_string($db, $_POST['new_email']);
  $Mypassword_1 = mysqli_real_escape_string($db, $_POST['new_password']);
  $Mypassword_2 = mysqli_real_escape_string($db, $_POST['ck_new_password']);
  $Myid = mysqli_real_escape_string($db, $_POST['user_compte']);

  if (empty($email)) { array_push($errors3, "Email is required"); }
  if (empty($Mypassword_1)) { array_push($errors3, "Password is required"); }
  if ($Mypassword_1 != $Mypassword_2) {
    array_push($errors3, "The two passwords do not match");
  }

$user_check_query2 = "SELECT * FROM register WHERE id=$Myid LIMIT 1";
$result2 = mysqli_query($db, $user_check_query2);
$user2 = mysqli_fetch_assoc($result2);

if ($user2) { // if user exists
if ($user2['email'] === $email) {
  array_push($errors3, "email already exists");
}
}

if (count($errors3) == 0) {
  $Mypassword = sha1($Mypassword_1);

  $query = "UPDATE register set email='$email', password='$Mypassword' WHERE id=$Myid";
  mysqli_query($db, $query);

  $_SESSION['email'] = $email;
  $_SESSION['success'] = "You are now logged in";

  header('location: index.php');
  }
}
// $sql = "UPDATE MyGuests SET firstname='Doe', lastname='Doe' WHERE id=2";