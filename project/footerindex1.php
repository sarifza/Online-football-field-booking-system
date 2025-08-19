<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .footer-container {
            background-color: #333;
            color: white;
            padding: 20px 0;
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
        }

        .footer-container.hidden {
            opacity: 0;
        }

        .footer-container.visible {
            opacity: 1;
        }

        .footer-container h4 {
            color: #fff;
        }

        .footer-container a {
            color: #fff;
            text-decoration: none;
        }

        .social li {
            display: inline-block;
            margin-right: 10px;
        }

        .contact_form textarea {
            width: 100%;
            height: 100px;
            margin-bottom: 10px;
            resize: none;
        }

        .contact_form input {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .copyright {
            background-color: #333;
            color: white;
            padding: 10px 0;
        }

        .copyright p {
            margin: 0;
        }
    </style>

<script>
        document.addEventListener("DOMContentLoaded", function () {
            var lastScrollTop = 1;

            window.addEventListener("scroll", function () {
                var st = window.pageYOffset || document.documentElement.scrollTop;
                var footer = document.querySelector(".footer-container");

                if (st > lastScrollTop) {
                    if (st > lastScrollTop + 5) {
                        // เลื่อนลงและมากกว่า 20px - ซ่อน Footer ทีละนิด
                        footer.classList.remove("visible");
                        footer.classList.add("half-hidden");
                    }
                } else {
                    // เลื่อนขึ้น - แสดง Footer
                    footer.classList.remove("half-hidden");
                    footer.classList.add("visible");
                }

                lastScrollTop = st;
            });
        });
    </script>
</head>
<body>

    <div class="footer-container">
        <div class="row" data-appear-top-offset="-200" data-animated="fadeInUp">
            <div class="col-lg-4 col-md-4 col-sm-6 padbot30 text-center mx-auto">
                <h4><b>Locations</b></h4>
                <div class="post_item_content_small">
                    <a class="title" href="#"> เทศบาลนครหาดใหญ่ 90110</a><br>
                    <p>โทร 098-7097065 & 062-7644044</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 padbot30 text-center mx-auto">
                <h4><b>ติดต่อกับเรา</b></h4>
                <div class="span9 contact_form">
                    <div id="note"></div>
                    <div id="fields">
                        <form id="contact-form-face" class="clearfix" action="#">
                            <textarea name="message" onFocus="if (this.value == 'Message') this.value = '';" onBlur="if (this.value == '') this.value = 'Message';">Message</textarea>
                            <input class="contact_btn" type="submit" value="Send message" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid copyright">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p>2024 &copy; <i class="fa fa-heart"></i>Kok stadium by IT 014 & 024 Grup</a></p>
            </div>
        </div>
    </div>
</body>
</html>
