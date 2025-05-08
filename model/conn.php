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
        header("Location:../views/error.php?msg=连接失败");
    }
    return $conn;
}

/**
 * 执行SQL写操作（INSERT/UPDATE/DELETE），返回影响的行数
 * @param string $sql SQL语句（建议使用预处理语句）
 * @return int 影响的行数，失败返回0
 */
function exec_update($sql){
    $conn=get_conn();
    $result=mysqli_query($conn, $sql);
    if(!$result){
        header("location:../view/error.php?msg=数据库操作失败");
    }
    //获取受影响行数
    $num=mysqli_affected_rows($conn);
    mysqli_close($conn);
    return $num;
}

/**
 * 执行SQL查询操作，返回结果数组
 * @param string $sql SQL语句
 * @return array 查询结果的二维数组
 */
function exec_select($sql){
    $conn=get_conn();
    $result=mysqli_query($conn, $sql);
    if(!$result){
        header("location:../view/error.php?msg=数据库查询失败");
    }
    $arr=array();
    foreach($result as $row){
        $arr[]=$row;
    }
    mysqli_close($conn);
    return $arr;
}