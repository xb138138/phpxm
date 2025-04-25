<?php
/**
 * @return mysqli
 */
function get_conn():mysqli
{
    $conn = mysqli_connect('localhost','root','','bbs',3308);
    //设置数据库字符编码
    mysqli_query($conn,'set names utf8');
    if (!$conn) {
        die("连接失败:" . mysqli_connect_error());
    }
    return $conn;
}

/**
 * 执行SQL写操作（INSERT/UPDATE/DELETE），返回影响的行数
 * @param string $sql SQL语句（建议使用预处理语句）
 * @return int 影响的行数，失败返回0
 */
function exec_update(string $sql): int
{
    $conn = get_conn();
    $result = mysqli_query($conn,$sql);
    //获取受影响的行
    $rows = mysqli_affected_rows($conn);
    $conn->close();
    return $rows;
}