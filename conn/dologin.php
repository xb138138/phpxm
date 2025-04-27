<?php
/**
 * 业务层：处理登陆逻辑
 */
require('./conn.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $uname = $_GET['uname'];
    $upass = $_GET['upass'];

    $conn = get_conn();
    $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE uName=? AND uPass=?");
    $stmt->bind_param("ss",$uname, $upass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        session_start();
        // 获取用户ID
        $user_id = $result->fetch_assoc()['uId'];
        $_SESSION['user_id'] = $user_id;
        $_SESSION['uname'] = $uname;
        echo "<script>alert('登录成功');window.location.href='../static/index.php';</script>";
    } else {
        echo "<script>alert('登录失败');history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}