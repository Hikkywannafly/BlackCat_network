<?php
require './conn.php';
require './validate.php';

$page = empty($_GET['page']) ? 1 : $_GET['page'];
if (!is_numeric($page)) die();

//search
$search = empty($_GET['search']) ? '' : $_GET['search'];
$search = validate($search);


$post_length = get_count('select count(*) from user where name like \'%' . $search . '%\'');
$post_limit = 6;
$page_length = ceil($post_length / $post_limit);
$page_skip = $post_limit * ($page - 1);


$query = "select * from user where name like '%$search%' limit $post_limit offset $page_skip";
$return = get_list($query);
$posts = $return;

//dem so record
$records = count_records();

//tim kiem
// // $search1 = $_GET('search_name');
// $sql = "select * from user where name like '%$search1'%";


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Andika+New+Basic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="font/fontawesome-free-5.12.1-web/fontawesome-free-5.12.1-web/css/all.min.css">

</head>

<body>
    <div class="overview">
        <div class="header">
            <a href="homepage.php" target="_blank"> <img src="./img/backcat2.gif" alt="blackcat" style="position:relative; left:15px; top: 0px; width: 140px; height: 110px;"></a>

            <div id="logo" class="pr-4">
                <span>BLACKCAT</span>
                <span>NETWORK</span>

            </div>
            <div id="wellcome">
                <!-- <h1>Chào mừng bạn đến với </h1> -->
                <h1 style="font-size:25px; color:rgb(0, 0, 0)"> BlackCat Network</h1>
                <p>Nơi kết nối những tâm hồn trẻ thơ</p>
            </div>
            <div id="social-icon">
                <ul class="wrapper">
                    <a href="https://www.facebook.com/TamNC29">
                        <li class="icon facebook">

                            <span class="tooltip">Facebook</span>
                            <span><i class="fab fa-facebook"></i></span>
                        </li>
                    </a>

                    <a href="https://twitter.com/TamNguy28327146">
                        <li class="icon twitter">
                            <span class="tooltip">Twitter</span>
                            <span><i class="fab fa-twitter"></i></span>

                        </li>
                    </a>
                    <a href="https://github.com/TamNguyenS">
                        <li class="icon instagram">
                            <span class="tooltip">Instagram</span>
                            <span><i class="fab fa-instagram"></i></span>

                        </li>
                    </a>
                    <a href="https://github.com/TamNguyenS">
                        <li class="icon github">
                            <span class="tooltip">Github</span>
                            <span><i class="fab fa-github"></i></span>

                        </li>
                    </a>
                    <a href="https://www.youtube.com/channel/UC_aLW5yh278IJt2S4qTDIrA/featured">
                        <li class="icon youtube">
                            <span class="tooltip">Youtube</span>
                            <span><i class="fab fa-youtube"></i></span>
                        </li>
                </ul>
                </a>
            </div>




        </div>
        <br>
        <div class="nav">
            <div class="active">Trang chủ</div>
            <a href="./regis/register.php">
                <div>Đăng ký</div>
            </a>
            <!-- <a href="./user/user.php">
                <div>Thành viên</div>
            </a> -->
        </div>
        <div>
            <h1 class="mb-0">
                <span class="text-red-dark">CHỦ TỌA HIKKY XIN THÔNG BÁO >.< </span>
            </h1>

            <h3 class="text-pink mt-0">
                Đợt bổ sung nhân sự khủng nhất từ trước đến nay ^^
            </h3>

            <p class="text-pink-dark">
                Mạng lưới mèo đen với sự dẫn dắt của ông trùm Hikky. Chúng tôi đã gần như bao phủ khắp cả ngóc ngách thế giới.
                <br>
                Bằng sự hiếu hảo, nhiệt tình hội mèo đen chúng tôi xin tuyến bố (làm trùm) đợt tuyển thành viên số lượng cực khủng.
                <br>
                Với tiêu chí "Thàm Giết nhầm hơn bỏ sót" chúng tôi chỉ tuyển chọn những em chân dài đặc biệt Víu phải bự.
                <br>
                Ai cam đảm hảy mạng dạn ĐĂNG KÝ (chúng tôi luôn đón tiếp các bạn)! `(*>﹏<*)′ </p>

                    <p> &emsp; 👇👇👇👇👇</p>

                    <a href="./regis/register.php"> <button class="btn"> Đăng kí !! </button> </a>
                    <!-- List -->
                    <div>
                        <h2 class="text-red-dark">Số thành viên hiện nay: <?php echo $records; ?> </h2>

                        <form action="" method="get">
                            <input type="search" name="search" placeholder="Bạn muốn tìm ai?" value="">
                        </form>

                        <div class="list">
                            <?php foreach ($posts  as $post) { ?>
                                <a href="./user/user.php?id=<?php echo ($post['id']); ?>">
                                    <div>
                                        <p class="text-red-dark" style="color: #602222"><?php echo $post['name']; ?></p>
                                        <p><?php echo $post['reason']; ?></p>
                                        <!-- <p><?php echo ($post['id']); ?></p> -->
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                        <br>

                        <div class="page">
                            <?php for ($i = 1; $i <= $page_length; $i++) {
                                if ($i == $page) { ?>
                                    <span class='active'><?php echo $i; ?></span>
                                <?php
                                } else { ?>
                                    <a href="?page=<?php echo $i; ?>">
                                        <span><?php echo $i; ?></span>
                                    </a>
                            <?php
                                }
                            } ?>
                        </div>
                    </div>
                    <br>
        </div>

</body>

</html>