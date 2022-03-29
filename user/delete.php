<?php 
require '../conn.php';
$getInfo = get_info($query);
$password1 = isset($_POST['password1']) ? $_POST['password1'] : false;

$id = empty($_GET['id']) ? 'false' : $_GET['id'];
if( $password1 != $getInfo['pass']) {
    echo '<script>alert("Mật khẩu không đúng")</script>';
}
if($id != 'false'){
    
        $result = remove($id);
        echo '<script>alert("Xóa thành công")</script>';
    
}
?>

