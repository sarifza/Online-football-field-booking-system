<?php 
include 'header.php';
include 'db.php';



if ($_POST) {
    $username = isset($_POST["username"]) ? $_POST["username"] : '';
    $password = isset($_POST["password"]) ? $_POST["password"] : '';


    if ($result = $mysqli->query("SELECT * FROM users where username='" . $username . "'  and  password='" . $password . "'")) {
        while ($row = $result->fetch_array()) {
            $_SESSION["id"] = $row["id"];
            $_SESSION["name"] = $row["name"];
            $_SESSION["type"] = $row["users_type_id"];
            echo '<meta http-equiv="refresh" content="0;url=index1.php">';
        }
        ?>


        <?php
    } else {
        ?>
        <div class="alert alert-danger text-center"><strong>Error : <?= $mysqli->error ?>..</strong></div>
        <?php
         echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-q0sj40xoU8lRQIw5M5GTEH9KQu8W//2BLeS/2ouTy2l/aU/K5or0EdU+B90j+HcCt69XZ1sWofD0IQLq2mtOkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <style>
    body {
      background-image: url('img/Login2.jpg');
      background-size: cover;
      color: white; /* Set font color to white */
    }

    .containerr {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .card {
      background-color: rgba(255, 255, 255, 0.8);
      color: #495057; /* Text color for card */
    }

    .card-header {
      text-align: center;
      background-color: #006600;
      color: white;
    }

    .icon-input {
      position: relative;
    }

    .icon-input i {
      position: absolute;
      top: 50%;
      left: 10px;
      transform: translateY(-50%);
      color: #495057;
    }

    .login-btn {
      float: right;
      margin-top: 20px;
    }

    .text-center {
      text-align: center;
    }

    /* Additional styles for link */
    .text-center a {
      color: black;
    }

    /* Additional styles for form labels */
    label.form-label {
      color: black; /* Change form label color to white */
    }

    /* Additional styles for form inputs */
    .form-control {
      color: black; /* Change form input color to white */
    }
  </style>
  <title>Login Page</title>
</head>

<body class="bg-light">
  <div class="containerr">
    <div class="row mt-5">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header text-white">
            <i class="fas fa-sign-in"></i> Login
          </div>
          <div class="card-body">
            <form id="login-form" class="form-horizontal" action="login.php" method="post">
              <div class="mb-3 icon-input">
                <i class="fas fa-user"></i>
                <label for="users-username" class="form-label">Username</label>
                <span class="input-group-text bi bi-person-circle" id="basic-addon1">&nbsp;<input type="text" class="form-control" id="users-username" name="username" required>
              </div>
              <div class="mb-3 icon-input">
                <i class="fas fa-key"></i>
                <label for="users-password" class="form-label">Password</label>
                <span class="input-group-text bi bi-key-fill" id="basic-addon1">&nbsp;<input type="password" class="form-control" id="users-password" name="password" required>
              </div>
              <button type="submit" class="btn btn-success login-btn bi bi-check2-circle">&nbsp;ยืนยัน</button>
              <br><br>
              <p class="mt-3 text-center text-black bi bi-box-arrow-in-right"> <a href="register.php">สมัครสมาชิก</a></p>
              <!-- <p class="mt-3 text-center text-black bi bi-box-arrow-in-right"> <a href="reset_password.php">ลืมรหัสผ่าน</a></p> -->
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'footer.php'; ?>

</body>

</html>


