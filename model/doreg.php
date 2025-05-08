<?php
/**
 * 注册逻辑层
 */
require('./userDao.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $uname = $_GET['uname'];
    $upass = $_GET['upass'];
    $head = '1.gif';
    $gender = 2;
    $email = $_GET['email'] ?? '';

    // 检查用户名是否已存在
    $user = get_user($uname, $upass);
    if ($user) {
        echo "<script>alert('用户名已存在，请更换用户名');history.back();</script>";
    } else {
        $res = add_user($uname, $upass, $head, $gender, $email);
        if ($res > 0) {
            echo "<script>alert('注册成功');window.location.href='../views/login.php';</script>";
        } else {
            echo "<script>alert('注册失败');history.back();</script>";
        }
    }
}