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
            <div class="alert alert-success text-center"><strong>สมัครสมาชิกไม่สำเร็จเนื่องจากมีผู้ใช้งานในระบบแล้ว..</strong></div>
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
                    echo '<meta http-equiv="refresh" content="1;url=users.php">';
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
<body>
                        <STYLE>
                        body{background-image:url('img/login2.jpg'); }</STYLE>


<div class="container">
<br>
    <h1 class="text-center" style="color: #FFFFFF;">เพิ่มข้อมูลสมาชิก </h1>
    <form id="w0" action="" method="post" style="color: #FFFFFF">
                                  <div class="row justify-content-center">
                                    <div class="col-md-6"><div class="form-group field-users-username required">
                                            <label class="control-label" for="users-username">ชื่อผู้ใช้</label>
                                            <input type="text" id="users-username" value="<?php if (isset($_POST['register']) || isset($_POST['check'])) {
                                  echo $usercheck; } ?>"  class="form-control" name="username" maxlength="100" aria-required="true">
                                  
                                  <div class="col-md-12"><div class="form-group field-users-password required">
                    <label class="control-label" for="users-password">Password</label>
                    <input type="password" id="users-password" class="form-control" name="password" maxlength="255" aria-required="true">
                </div>
            </div>
        
        <div class="col-md-18"><div class="form-group ">
                    <label class="control-label" for="users-name">ชื่อ-สกุล</label>
                    <input type="text" id="users-name" class="form-control" name="name" maxlength="255" >


                </div></div>
           

                   
                </div>
            <div class="col-md-24"><div class="form-group field-users-tel">
                    <label class="control-label" for="users-tel">เบอร์โทร</label>
                    <input  name="tel" type="text" class="form-control" id="users-tel" required  placeholder="ตัวเลขเท่านั้น" maxlength="10" pattern="^[0-9]+$" title="ตัวเลขเท่านั้น" />
                </div>
            </div>
            <div class="col-md-30"> <div class="form-group field-users-email required">
                    <label class="control-label" for="users-email">อีเมล์</label>
                    <input type="email" id="users-email" class="form-control" name="email" maxlength="255" aria-required="true">
                </div>
            </div>
        </div>
        <div class="form-group">
           <br><br><br> <center><button style="" type="submit" name="register" class="btn btn-success">ยืนยัน</button></center></div>

    </form>
</div>

<?php
include 'footer.php';
?>
<style>

.alert.success {background-color: #4CAF50;}
.alert.warning {background-color: #ff9800;}

.alert {
  padding: 10px;
  background-color: #f44336;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}

* {
  box-sizing: border-box;
}



/* Set a style for the submit button */
.registerbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 15%;
  opacity: 0.9;
}
.black {
  background-color: red;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 15%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>

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