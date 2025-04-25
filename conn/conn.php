<?php
function get_conn(){
    $conn = mysqli_connect("localhost", "root", "", "bbs", 3308);
    //设置数据库字符编码
    mysqli_query($conn,"set names 'utf8'");
    if(!$conn){
        die("数据库连接失败".mysqli_connect_error());
    }
    //返回连接对象
    return $conn;
}
