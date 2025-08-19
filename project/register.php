<?php
 include 'header.php'; 
include 'db.php';

$result = $mysqli->query("SELECT * FROM status_name ");
while ($row = $result->fetch_array()) {
    $rows[] = $row;
}


if (isset($_POST['register'])) { 

    if (trim($_POST["name"]) != "" && trim($_POST['email'])  && trim($_POST['username']) && trim($_POST['password'])) {
        $usercheck = $_POST['username'];
        
        $result_NO = $mysqli->query("SELECT * FROM users WHERE username = '$usercheck'"); // ค้นหา
        if(mysqli_num_rows($result_NO) == 1 ){
            ?>
            <div class="alert alert-danger text-center"><strong>สมัครสมาชิกไม่สำเร็จเนื่องจากมีผู้ใช้งานในระบบแล้ว..</strong></div>
            <?php
        }else{
           // ปิดการแสดง error
           error_reporting(0);
                $sql = "INSERT INTO users (name,email, tel, department,users_type_id,username,password,create_at)";
                $sql .= "VALUES ('" . $_POST["name"] . "', '" . $_POST['email'] . "', '" . $_POST['tel'] . "','" . "',3,'" . $_POST['username'] . "','" . $_POST['password'] . "','" . date("Y-m-d H:i:s") . "')";

                if ($mysqli->query($sql) === TRUE) {
                    ?>
                    <div class="alert alert-success text-center"><strong>บันทึกข้อมูลการลงทะเบียนเรียบร้อย..</strong></div>
                    <?php
                    echo '<meta http-equiv="refresh" content="1;url=login.php">';
                    $tel = mysqli_real_escape_string($_POST["tel"]);
                } else {
                    ?>
                    <div class="alert alert-danger text-center"><strong>Error : <?= $mysqli->error ?>..</strong></div>
                    <?php
                    // echo "Error: " . $sql . "<br>" . $mysqli->error;
                }
            }
    } else {
    ?>
    <div class="alert alert-danger text-center"><strong>กรุณากรอกข้อมูลให้ครบถ้วน..</strong></div>
    <?php
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('img/login2.jpg');
            background-size: cover;
        }
        
        .containerr {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
        .card {
            background-color: rgba(255, 255, 255, 0.8);
            color: white; /* Set font color to white */
        }
        
        .card-header {
            text-align: center;
            background-color: #006600;
            color: white;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .sign-up-btn {
            float: right;
        }
        
        .text-center {
            text-align: center;
        }
    </style>
</head>

<body class="bg-light">
    <div class="containerr">
        <div class="row  mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-white">
                        <i class="fas fa-user-plus"></i> Sign Up
                    </div>
                    <div class="card-body" style=" color: black;">
                        <form id="signup-form" action="" method="post">
                            <div class="mb-3">
                                <label for="users-username" class="form-label ">Username</label>
                                <span class="input-group-text bi bi-person-circle" id="basic-addon1">&nbsp;<input type="text" class="form-control" id="users-username" name="username" required></span>
                            </div>
                            <div class="mb-3">
                                <label for="users-password" class="form-label">Password</label>
                                <span class="input-group-text bi bi-key-fill" id="basic-addon1">&nbsp;<input type="password" class="form-control" id="users-password" name="password" required></span>
                            </div>
                            <div class="mb-3">
                                <label for="users-name" class="form-label">Full Name</label>
                                <span class="input-group-text bi bi-person-circle" id="basic-addon1">&nbsp;<input type="text" class="form-control" id="users-name" name="name" required></span>
                            </div>
                            <div class="mb-3">
                                <label for="users-tel" class="form-label">Phone Number</label>
                                <span class="input-group-text bi bi-telephone-plus-fill" id="basic-addon1">&nbsp;<input type="tel" class="form-control" placeholder="ตัวเลขเท่านั้น" id="users-tel" name="tel" required></span>
                            </div>
                            <div class="mb-3">
                                <label for="users-email" class="form-label">Email</label>
                                <span class="input-group-text bi bi-envelope-fill" id="basic-addon1">&nbsp;<input type="email" class="form-control" id="users-email" name="email" required></span><br>
                                <button type="submit" name="register" class="btn btn-success float-end bi bi-check2-circle">&nbsp;ยืนยัน</button>
                            </div>
                            
                        </form><br>
                        <p class="mt-3 text-center">เป็นสมาชิกอยู่แล้ว? <a c href="login.php">เข้าสู่ระบบ</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</body><br>
<?php
include 'footer.php';
?>
<br>
</body>
</html>
  
<script>
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
  close[i].onclick = function(){
    var div = this.parentElement;
    div.style.opacity = "0";
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}
</script>