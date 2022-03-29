<?php
require '../conn.php';
require '../validate.php';

$id = empty($_GET['id']) ? 'false' : $_GET['id'];
if (!$id) die('Đã có lỗi xãy ra');
$id = validate($id);
$query = "select * from user where id = $id";
$getInfo = get_info($query);


$name = isset($_POST['name']) ? $_POST['name'] : false;
$age = isset($_POST['age']) ? $_POST['age'] : false;
$email = isset($_POST['email']) ? $_POST['email'] : false;
$size = isset($_POST['size']) ? $_POST['size'] : false;
$gender = isset($_POST['gender']) ? $_POST['gender'] : false;
$reason = isset($_POST['reason']) ? $_POST['reason'] : false;
$password = isset($_POST['password']) ? $_POST['password'] : false;

$query_update = "UPDATE user set name = '$name' , age = $age, email= '$email', size = '$size', gender = $gender , reason = '$reason' where id= $id";

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
    if( $password != $getInfo['pass']) {
        $error .= '[Error] Password không đúng !<br>';
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
        $result = update($query_update);
        echo(!$result);
        if (!$result) {
            $error = '[OK] Chúc mừng bạn đã đổi thông tin thành công !<br>';
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
    <style>

    </style>
</head>

<body>
    <div class="overview">
        <div class="header">
            <a href="../homepage.php" target="_blank"> <img src="../img/blackcat3.gif" alt="blackcat" style="position:relative; left:0px; top: 0px; width: 140px; height: 110px;"></a>

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
                <span class="text-red-dark"><?php echo $getInfo['name']; ?> </span>
            </h1>

        </div>
        <div>
        <p class=".text-pink2"> Liên hệ: <?php echo $getInfo['email']; ?></p>


            <div class="hashtag"> <?php 
                    $gender = $getInfo['gender'];
                    if($gender == 0){
                        echo 'Nam';
                    }
                    else{
                        echo 'Nữ';
                    }
              ?></div>

            <div class="hashtag"> <?php echo $getInfo['age']; ?> tuổi</div>
            <div class="hashtag"> <?php echo $getInfo['size']; ?> </div>
            <p class="text-banner">Tiểu sử:</p>
            <p class="text-pink"> <?php echo $getInfo['reason']; ?> </p>

            <p>
                <span style="cursor: pointer" class="text-red mr-1" onclick="update()">[Sửa]</span>
                <span style="cursor: pointer" class="text-red" onclick="remove()">[Xoá]</span>
            </p>
        </div>
        <p id="text-red-dark" style="color: rgb(185, 9, 9); font-weight: bold; "><?php echo ($error) ?> </p>
        <form action="./user.php?id=<?php echo $id; ?>" method="post" id="form_update" hidden>
            <h2 class="text-red-dark">Sửa thông tin đăng ký </h2>

            <label>
                Tên bạn là gì?
                <input type="text" name="name" required placeholder="Mikami Yua ,Eimi Dukada?, Doraemon">
            </label>

            <label>
                Bạn mấy tuổi rồi?
                <input type="number" name="age" required>
            </label>

            <label>
                Email của bạn là gì?
                <input type="email" name="email" required>
            </label>
            <label>
                Số đo ba vòng?
                <input type="text" name="size" required placeholder="VD: 85 ,65, 99">
            </label>
            <div>
                Bạn là nam hay nữ?
                <br>
                <label class="radio" style="margin-top: .25rem;">
                    <input type="radio" name="gender" value="0" required>
                    <span>Nam</span>
                </label>

                <label class="radio">
                    <input type="radio" name="gender" value="1" required>
                    <span>Nữ</span>
                </label>
                <br>
            </div>

            <label>
                Vì sao bạn đăng ký Blackcat Network?
                <input type="text" name="reason" required placeholder="Vì tớ yêu bạn Hikky nên muốn chơi với cậu ấy ^^">
            </label>

            <label>
                Nhập mật khẩu của bạn ^^
                <input type="password" name="password" required placeholder="Mật khẩu bạn đã đăng kí">
            </label>
            <button class="btn"> Cập nhật !! </button>
        </form>
        <form  action="./delete.php?id=<?php echo $id; ?>" method="post" id="form_remove" hidden >
        <h2 class="text-red-dark">Xóa thông tin đăng ký </h2>
        <label>
                Nhập mật khẩu của bạn ^^
                <input type="password1" name="password1" required placeholder="Mật khẩu bạn đã đăng kí">
            </label>
        <button class="btn"> Xóa </button>
        </form>
        <script src="event.js"></script>
</body>

</html>