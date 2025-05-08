<?php
/**
 * 业务层：处理登陆逻辑
 */
require('./userDao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = $_POST['uname'];
    $upass = $_POST['upass'];

    $user = get_user($uname, $upass);
    if ($user) {
        session_start();
        $_SESSION['user_id'] = $user['uId'];
        $_SESSION['uname'] = $uname;
        echo "<script>alert('登录成功');window.location.href='../views/index.php';</script>";
    } else {
        echo "<script>alert('用户名或密码错误');history.back();</script>";
    }
    exit;
}else{
    header("Location: ../views/error.php?msg=请求方式错误");
}