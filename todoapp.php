<?php include('server.php');
require_once('dbconfig.php');

  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: index.php");
}
?>

<?php 

$session_email = $_SESSION['email'];
$sql =mysqli_query($db, "SELECT * FROM register WHERE email = '$session_email';");
while($Regrow=mysqli_fetch_array($sql)){
    $Reg = $Regrow['id'];
// echo "<h1> the value of id is:".$Reg."</h1>";
}
$_SESSION['id'] = $Reg;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo-ls</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/f84ba90e3b.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style/main.css">
    <script src="script/todoapp.js"></script>
</head>
<body>

<?php
        $sql = mysqli_query($db, "select *from images WHERE images.img_user=$Reg ORDER BY id DESC LIMIT 1;");

        while($row=mysqli_fetch_array($sql)){
            $my_profile_img = $row['img'];
            echo "
            <img src='$my_profile_img' class='round float-right' alt='img'>;
            ";
        }
?>

<div class="drop-down">
    <div class="dropdown float-right">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          your account
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="#" id="change_img">select your profile image</a>
          <a class="dropdown-item" href="#" id="change_email">change your email and password</a>
          <a class="dropdown-item" href="index.php?logout='1'">logout</a>
        </div>
    </div>
</div>

<h1 class="title">Welcom: <span class="subtitle"><?php echo $_SESSION['email']; ?></span> <br> to the TODO-LS app</h1>

    <div class="todo-container">
        <div class="add-task">
            <form action="upload.php" method="post" enctype="multipart/form-data">

            <input type="text" placeholder="whath you want to do today" id="todo_text" name="todo_text">
            <input type="text" id="account_id" name="account_id" class="form-control" placeholder="blog text" aria-label="Recipient's username" aria-describedby="button-addon2" value="<?php echo $Reg ?>" style="display: none">
            <input type="submit" class="plus" value="+" name="add_now">

            </form>
        </div>
        <div class="tasks-content">

<?php
        $sql = mysqli_query($db, "SELECT * FROM todo_list WHERE account_id=$Reg;");

        while($row=mysqli_fetch_array($sql)){
            $todo_text = $row['todo_text'];
            $id = $row['id'];
            echo "
            <span class='task-box'>
            $todo_text
                <a href='delete.php?id=$id'><span class='delete'>Delete</span></a>
            </span>
            ";
        }
?>
            <!-- <span class="no-task-message">No Tasks To Show</span> -->
                 <!-- <span class="task-box">
                    task one
            <span class="delete">Delete</span>
                </span> -->
        </div>
    </div>

    <div class="task-stats">
        <div class="tasks-count">
            Tasks <span>0</span>
        </div>
        <div class="tasks-completed">
            Completed <span>0</span>
        </div>
    </div>

    <form action="update_img.php" method="post" enctype="multipart/form-data" class="update_img">
        <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="inputGroupFile02" name="image" >
                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
            </div>   
        </div>

        <div class="input-group mb-3">
                <input type="text" id="user_compte_img_id" name="user_compte_img_id" class="form-control" placeholder="blog text" aria-label="Recipient's username" aria-describedby="button-addon2" value="<?php echo $Reg ?>" style="display: none"> <!--  -->
        </div> 

        <input type="submit" class="btn btn-light btn-lg btn-block mybtn1" name="change_img" value="change img">
    </form>


    <?php include('errors.php'); ?>


    <form action="update_email_pass.php" method="post" class="update_email">
            <div class="input-group mb-3">
                    <input type="text" placeholder="new email" id="new_email" name="new_email"><br>
            </div>
            <div class="input-group mb-3">
                    <input type="password" placeholder="new password" id="new_password" name="new_password"><br>
            </div>
            <div class="input-group mb-3">
                    <input type="password" placeholder="rewrite new password" id="ck_new_password" name="ck_new_password"><br>
            </div>

            <div class="input-group mb-3">
                <input type="text" id="user_compte" name="user_compte" class="form-control" placeholder="blog text" aria-label="Recipient's username" aria-describedby="button-addon2" value="<?php echo $Reg ?>" style="display: none"> <!-- style="display: none" -->
            </div> 

            <input type="submit" class="btn btn-light btn-lg btn-block mybtn2" name="UPDATE" value="update email and password">
    </form>

</body>
</html>
