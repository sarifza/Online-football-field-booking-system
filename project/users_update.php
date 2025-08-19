<?php
include 'header.php';
include 'db.php';

    $id = isset($_GET["id"]) ? $_GET["id"] : '';

 

    $booking = $mysqli->query("SELECT * FROM users where id= " . $id);
    while ($row = $booking->fetch_array()) {
        $name = $row["name"];
        $tel = $row["tel"];
        $email = $row["email"];
          $users_type_id= $row["users_type_id"];
        $username = $row["username"];
        $password = $row["password"];
 
    }




$result = $mysqli->query("SELECT * FROM users_type ");
while ($type = $result->fetch_array()) {
    $rows[] = $type;
}


if ($_POST) {

    if (trim($_POST["name"]) != "" && trim($_POST['email']) != ""  && trim($_POST['username']) != "" && trim($_POST['password']) != "") {


        $sql = "update users  set name='" . $_POST["name"] . "',email='" . $_POST['email'] . "', tel='" . $_POST['tel'] . "', department='" . "',users_type_id='" . $_POST['users_type_id'] . "',username='" . $_POST['username'] . "',password='" . $_POST['password'] . "',create_at='" . date("Y-m-d H:i:s") . "' where id=".$id;


        if ($mysqli->query($sql) === TRUE) {
            ?>
            <div class="alert alert-success text-center"><strong>บันทึกข้อมูลการลงทะเบียนเรียบร้อย..</strong></div>
            <?php
            echo '<meta http-equiv="refresh" content="1;url=tables.php">';
        } else {
            ?>
            <div class="alert alert-danger text-center"><strong>Error : <?= $mysqli->error ?>..</strong></div>
            <?php
            // echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }else {
    ?>
    <div class="alert alert-danger text-center"><strong>กรุณากรอกข้อมูลให้ครบถ้วน..</strong></div>
    <?php
}
} 
?>

<div class=" text-white">
<div class="container">
<STYLE>
                        body{background-image:url('img/login2.jpg'); }</STYLE>
    <br><center><h1>แก้ไขข้อมูลผู้ใช้งานระบบ</h1></center>
    <form id="w0" action="users_update.php?id=<?=$id?>" method="post">
        <div class="row justify-content-center">
            <div class="col-md-6"><div class="form-group ">
                    <label class="control-label" for="users-name">ชื่อ-สกุล</label>
                    <input type="text" id="users-name" class="form-control" name="name" value="<?=$name?>" maxlength="255" >


                </div></div>
            
        <div class="row justify-content-center">
            <div class="col-md-6"><div class="form-group field-users-tel">
                    <label class="control-label" for="users-tel">เบอร์โทร</label>
                    <input type="text" id="users-tel" class="form-control" name="tel" placeholder="ตัวเลขเท่านั้น" maxlength="100" value="<?=$tel?>">
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6"> <div class="form-group field-users-email required">
                    <label class="control-label" for="users-email">อีเมล์</label>
                    <input type="text" id="users-email" class="form-control" name="email" maxlength="255"  value="<?=$email?>">
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6"><div class="form-group field-users-username required">
                    <label class="control-label" for="users-username">ชื่อผู้ใช้</label>
                    <input type="text" id="users-username" class="form-control" name="username" maxlength="100"  value="<?=$username?>">
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6"><div class="form-group field-users-password required">
                    <label class="control-label" for="users-password">Password</label>
                    <input type="password" id="users-password" class="form-control" name="password" maxlength="255"  value="<?=$password?>">
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
             <div class="col-md-6 ">
                    <div class="form-group">
                        <label class="control-label" for="status_name_id">ประเภทการใช้งาน</label>
                        <select id="status_name_id" class="form-control" name="users_type_id">

                            <?php
                            foreach ($rows as $key => $value) {
                                ?>
                                <option value="<?= $value["id"] ?>"> <?= $value["name"] ?></option>
                            <?php } ?>
                        </select>

                    </div>
                </div>
        </div>


        <div class="form-group">
            <center><button type="submit" class="btn btn-success">บันทึก</button></center>  
        </div>

    </form>
</div>

<?php
include 'footer.php';
?>
