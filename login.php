<?php
$err_msg = "";

function check_account($status)
{
    $err_msg = "";
    switch ($status) {
        case 0:
            $err_msg = "عذرا ولكن تم تجميد الحساب.";
            break;
        case 1:
            header("Location: admin/pages/posts_management.php");
            exit(); // Make sure to exit after a redirect
    }
    return $err_msg;
}

session_start();
$err = "";

if (isset($_POST['send'])) {

    $userName = $_POST['user_name'];
    $password = sha1($_POST['pass']);

    echo "Debug: Username: $userName, Password: $password<br>"; // Debug
    echo "Debug: Password from form: $password<br>"; // Debug

    if (!empty($userName) && !empty($password)) {

        require 'connect.php';


        $stmt = $conn->prepare("SELECT * FROM admins WHERE userName=? AND pass=?");
        $stmt->bind_param("ss", $userName, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if (mysqli_num_rows($result) == 1) {
            echo "Debug: User found<br>"; // Debug

            $row = mysqli_fetch_assoc($result);

            $_SESSION['id'] = $row['id'];
            $_SESSION['user_name'] = $row['userName'];
            $_SESSION['status'] = $row['status'];
            echo "Debug: Session set<br>"; // Debug

            $err = check_account($_SESSION['status']);
            echo "Debug: Error message from check_account: $err<br>"; // Debug
        } else {
            $err_msg = "يرجى التحقق من البيانات.";
            echo "Debug: User not found<br>"; // Debug
        }

        mysqli_close($conn);
        echo "Debug: Connection closed<br>"; // Debug
    }
}
?>

<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="./login.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style type="text/tailwindcss">
        .my-container {
            @apply bg-mainColor text-white p-4;
        }
        .nav-btn {
            @apply w-full  py-2 px-4 rounded-sm text-white bg-thirdColor;
        }
        .title-text {
            @apply text-2xl font-semibold;
        }
        .main-color {
            @apply text-red-600;
        }
        .form-group {
            @apply flex flex-col gap-2
        }
        .input {
            @apply bg-mainColor  text-white border rounded-md focus:outline-none border-thirdColor px-4 py-2;
        }
        .btn-danger {
            @apply bg-redColor border-none text-white hover:bg-redColor hover:text-white;
        }
        .btn-success {
            @apply bg-greenColor border-none text-white hover:bg-greenColor hover:text-white;
        }
        .alert-success {
            @apply bg-greenColor border-none text-white hover:bg-greenColor hover:text-white;
        }
        .btn-warning {
            @apply bg-yellowColor border-none text-white hover:bg-yellowColor hover:text-white;
        }
        .btn-primary {
            @apply bg-blueColor border-none text-white hover:bg-blueColor hover:text-white;
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        mainColor: '#0B1437',
                        secondColor: '#111C44',
                        thirdColor: '#7551FF',
                        yellowColor: '#FFB547',
                        blueColor: '#3965FF',
                        greenColor: '#01B574',
                        redColor: '#EE5D50',
                    }
                }
            }
        }
    </script>
</head>

<body dir="rtl">

    <div class="bg-mainColor grid sm:grid-cols-2 gap-12 min-h-[100svh]">

        <div class="order-last sm:order-first flex justify-center items-center">
            <div class="min-w-[350px] text-white flex flex-col gap-8">
                <h3 class="text-3xl ">تسجيل الدخول</h3>
                <?php echo $err ?>
                <?php echo $err_msg ?>
                <form action="login.php" method="post" class="flex flex-col gap-4">
                    <div class="form-group ">
                        <label for="user_name">اسم المستخدم</label>
                        <input type="text" class="input" name="user_name" id="user_name" required>
                    </div>

                    <div class="form-group">
                        <label for="pass">كلمة المرور</label>
                        <input class="input" type="password" name="pass" id="pass" required>
                    </div>

                    <input type="submit" value="تسجيل" name="send" class="nav-btn">
                </form>
            </div>
        </div>
        <div class="w-full h-full order-first sm:order-last object-cover flex justify-center items-center"
            style="background-image: url('assets/imgs/login\ bg.png'); background-size: cover;">
            <div>
                <h1 class="text-4xl text-white">نظام ادارة الموارد البشرية</h1>
            </div>
        </div>

    </div>


    <!-- <div class="container">
        <div class="form">
            <h3>تسجيل الدخول</h3>
            <?php echo $err ?>
            <?php echo $err_msg ?>
            <form action="login.php" method="post">
                <div class="input-field">
                    <label for="user_name">اسم المستخدم</label>
                    <input type="text" name="user_name" id="user_name" required>
                </div>

                <div class="input-field">
                    <label for="pass">كلمة المرور</label>
                    <input type="password" name="pass" id="pass" required>
                </div>

                <input type="submit" value="تسجيل" name="send" class="submit-btn">
            </form>
        </div>
        <div class="img">
            <img src="./hrm image.jpg" alt="">
        </div>
    </div> -->
</body>

</html>