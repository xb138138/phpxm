<?php
/**
 * 注册逻辑层
 */
require('./conn.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $uname = $_GET['uname'];
    $upass = $_GET['upass'];

    // 检查用户名是否已存在
    $conn = get_conn();
    $check_stmt = $conn->prepare("SELECT * FROM tbl_user WHERE uName=?");
    $check_stmt->bind_param("s", $uname);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        echo "<script>alert('用户名已存在，请更换用户名');history.back();</script>";
    } else {
        // 插入新用户
        $insert_stmt = $conn->prepare("INSERT INTO tbl_user (uName, uPass) VALUES (?, ?)");
        $insert_stmt->bind_param("ss", $uname, $upass);
        
        if ($insert_stmt->execute()) {
            echo "<script>alert('注册成功');window.location.href='../static/login.php';</script>";
        } else {
            echo "<script>alert('注册失败: " . $conn->error . "');history.back();</script>";
        }
        $insert_stmt->close();
    }

    $check_stmt->close();
    $conn->close();
}