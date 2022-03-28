<?php
$name = isset($_POST['name']) ? $_POST['name'] : false;
$age = isset($_POST['age']) ? $_POST['age'] : false;
$email = isset($_POST['email']) ? $_POST['email'] : false;
$size = isset($_POST['size']) ? $_POST['size'] : false;
$gender = isset($_POST['gender']) ? $_POST['gender'] : false;
$reason = isset($_POST['reason']) ? $_POST['reason'] : false;
$password = isset($_POST['password']) ? $_POST['password'] : false;

$isSubmit = false; //submit
$error = ''; //loi
$isError = false; //loi
if (
    $name !== false
    && $age !== false
    && $email !== false
    && $size !== false
    && $gender !== false
    &&  $reason !== false
    && $password !== false
) {

    $isSubmit = true;
    require '../conn.php';
    require '../validate.php';

    if (!isPassword($password)) {
        $error .= '[Error] Mật khẩu phải từ 6 tới 30 ký tự, bao gồm chữ hoa, chữ thường, số và kí tự đặc biệt<br>';
        $isError = true;
    }

    if (!isEmail($email)) {
        $error .= '[Error] Email không hợp lệ!<br>';
        $isError = true;
    }

    if ($age / 1 != $age) {
        $error .= '[Error] Tuổi không phải là số!<br>';
        $isError = true;
    }

    if ($age >= 150 || $age < 1) {
        $error .= '[Error] Tuổi phải nhỏ hơn 150. Bạn tưởng tui ngu chắc :v <br>';
        $isError = true;
    }

    if ($gender / 1 != $gender || $gender > 1 || $gender < 0) {
        $error .= '[Error] Giới tính không hợp lệ!<br>';
        $isError = true;
    }
    if (!$isError) {
        $result = insert('user', array(
            'name' => $name,
            'age' => $age,
            'gender' => $gender,
            'email' => $email,
            'size' => $size,
            'reason' => $reason,
            'pass' => $password
        ));

        if ($result) {
            $error = '[OK] Chúc mừng bạn đã rớt vào động mèo đen thành công !<br>';
        } else {
            $error = '[Error] Có lỗi xảy ra, vui lòng thử lại sau!<br>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Andika+New+Basic&display=swap" rel="stylesheet">
</head>

<body>
    <div class="overview">
        <div class="header">
            <a href="../homepage.php" target="_blank"> <img src="../img/blackcat3.gif" alt="blackcat" style="position:relative; left:15px; top: 0px; width: 140px; height: 110px;"></a>

            <div id="logo" class="pr-4">
                <span>BLACKCAT</span>
                <span>NETWORK</span>
            </div>
            <div id="wellcome">
                <h1>Chào mừng bạn đến với </h1>
                <h1 style="font-size:25px; color:rgb(0, 0, 0)"> BlackCat Network</h1>
                <p>Nơi kết nối những tâm hồn trẻ thơ</p>
            </div>
        </div>
        <br>
        <div class="nav">
            <a href="../homepage.php">
                <div>Trang chủ</div>
            </a>
            <a href="../regis/register.php">
                <div>Đăng ký</div>
            </a>
            <div class="active">Thành viên</div>

        </div>
        <div>
            <h1 class="mb-0">
                <span class="text-red-dark"> >.< COMMING SOON >.< </span>
            </h1>

        </div>
</body>

</html>