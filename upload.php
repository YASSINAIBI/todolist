<?php include('server.php') ?>
<?php 

 //importing dbDetails file 
 require_once 'dbconfig.php';

 if($_SERVER['REQUEST_METHOD']=='POST'){

    $account_id = mysqli_real_escape_string($db, $_REQUEST['account_id']);
    $todo_text = mysqli_real_escape_string($db, $_REQUEST['todo_text']);

    if(empty($todo_text)){
        echo "<html>
        <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
		</head>
		<body>
			<meta http-equiv='REFRESH' content='0 ; url=todoapp.php'>
			<script>
            Swal.fire({
                icon: 'error',
                title: 'writh something to add',
              })
			</script>
		</body>
        </html>";
    }
    else{
                //insert in database
                $insert=mysqli_query($db, "INSERT INTO todo_list (account_id , todo_text) VALUES ('$account_id', '$todo_text');");

                header('location: todoapp.php');
    }
}
else{
    echo "<html>
    <head>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
    </head>
    <body>
        <meta http-equiv='REFRESH' content='0 ; url=index.php'>
        <script>
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'you are not login',
            showConfirmButton: false,
            timer: 1500
          })
        </script>
    </body>
    </html>";
}

