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
            <a href="../homepage.php" target="_blank"> <img src="https://4.bp.blogspot.com/-cQVVfOJpzN8/XRzBCXNi3uI/AAAAAABGy-g/leSiL6hmTekJ1I6wf_8zdN7ngVeum0dBQCLcBGAs/s1600/AW3925002_09.gif" alt="blackcat" style="position:relative; left:15px; top: 0px; width: 140px; height: 110px;"></a>

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
            <div class="active">Đăng ký</div>
            <a href="../user/user.php">
                <div>Thành viên</div>
            </a>
        </div>
        <div>
            <h1 class="mb-0">
                <span class="text-red-dark">CHỦ TỌA HIKKY XIN THÔNG BÁO >.< </span>
            </h1>

            <h3 class="text-pink mt-0">
                Với tiêu chí hàng đầu là nơi ươm mần những hạt giống tí hon ^^
            </h3>

            <p class="text-pink-dark">
                Đến với chúng tôi bạn chắn chắc có nhưng phút bùng lổ với cảm xúc của bạn.
                <br>
                Nhắm mắt lại, cảm nhận những cảm xúc thăng hoa khó tả, trong tâm hồn tận hưởng những phút giây khoái cảm...
                <br>
                Đăng ký ngay để có những trải nghiệm bùng lổ nào! `(*>﹏<*)′ </p>
                    <div>
                        <h2 class="text-red-dark"> From Đăng ký</h2>
                        <p id="text-red-dark" style="color: rgb(185, 9, 9); font-weight: bold; "><?php echo ($error) ?> </p>

                        <form action="" method="post" id="form">
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
                                Đặt cho chính mình một mật khẩu nào ^^
                                <input type="password" name="password" required placeholder="Mật khẩu từ 6 kí tự bao gồm chữ hoa, chữ thường, số, kí tự dặc biệt">
                            </label>
                            <button class="btn"> Đăng kí !! </button>
                        </form>
                    </div>
                    <br>
        </div>
</body>

</html>