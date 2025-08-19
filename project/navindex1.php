<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap 5 Navbar Example</title>
  <!-- เรียกใช้ Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
  <style>
    body {
      overflow-x: auto;
    }

    .custom-navbar {
      background-color: #eeeeee; /* สามารถปรับสีตามต้องการ */
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <nav class="navbar navbar-expand-lg navbar-light fixed-top custom-navbar">
    <!-- หัว Navbar ทางซ้าย -->
    <a class="navbar-brand" href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kok Stadium</a>
  
    <!-- Navbar items ทางขวา -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active order-0">
          <a class="nav-link" href="index1.php">หน้าแรก<span class="visually-hidden"></span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">ดูสนามว่าง</a>
        </li>

        <!-- สร้างเมนู Dropdown อีกตัวอย่าง -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            ผู้ใช้
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
            <!-- ทุกรายการใน dropdown จะแสดงทั้งหมด -->
            <li><a class="dropdown-item" href="login.php">เข้าสู่ระบบ</a></li>
            <li><a class="dropdown-item" href="register.php">สมัครสมาชิก</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php">ออกจากระบบ</a></li>
            
          </ul>
        </li>
        <li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
        <li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
        <li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
        <li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
        <li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
      </ul>
    </div>
  </nav>
</div>

<!-- เรียกใช้ Bootstrap JS และ Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"></script>
   
   <script>
  // ฟังก์ชันสำหรับเลื่อนไปยังส่วนที่ต้องการ
  function scrollToBottom() {
    $('html, body').animate({scrollTop: $(document).height()}, 'slow');
  }
    </script>

</body>
</html>

