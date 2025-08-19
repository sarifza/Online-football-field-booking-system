<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reset Password</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center">Reset Password</h3>
                    <?php if ($_SERVER["REQUEST_METHOD"] != "POST" || $result->num_rows == 0): ?>
                    <!-- แสดงฟอร์มสำหรับกรอกข้อมูล username และ email -->
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </div>
                    </form>
                    <?php else: ?>
                    <!-- แสดงฟอร์มสำหรับกรอกรหัสผ่านใหม่ -->
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ตรวจสอบว่ามีการส่งค่ามาจากฟอร์มหรือไม่
    if (isset($_POST['username']) && isset($_POST['email'])) {
        // เชื่อมต่อกับฐานข้อมูล (ในตัวอย่างนี้เป็นตัวอย่างเท่านั้น)
        $servername = "localhost";
        $username = "root";
        $password = "65309010014";
        $dbname = "pro111";

        // สร้างการเชื่อมต่อ
    $conn = new mysqli($servername, $username, $password, $dbname);

    $result2 = $mysqli->query($sql4);
    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // ป้องกันการ SQL Injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // ค้นหาผู้ใช้
    $sql = "SELECT * FROM users WHERE username='$username' AND email='$email'";
    $result4 = $conn->query($sql);
    
    // Check if queries were successful
if (!$result4) {
    echo "Error: " . $mysqli->error;
} else {
    // Fetch and display results
    $row1 = $result4->fetch_assoc();
    }

    // ตรวจสอบว่ามีผู้ใช้หรือไม่
    if ($result4 !== false && $result->num_rows > 0) {
        
        // พบผู้ใช้ แสดงฟอร์มสำหรับการตั้งค่ารหัสผ่านใหม่
?>
        <!-- แสดงฟอร์มสำหรับการตั้งค่ารหัสผ่านใหม่ -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password">
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Update Password</button>
            </div>
        </form>
<?php
    } else {
        // ไม่พบผู้ใช้ แสดงข้อความแจ้งเตือน
        echo '<div class="container mt-3"><div class="alert alert-danger">ขออภัย ไม่พบข้อมูลผู้ใช้ดังกล่าว</div></div>';
    }

    $conn->close();
}
}
?>
</body>
</html>
