<?php
/**
 * 完成tbl_uesr表的增删改查
 */
require 'conn.php';
/**
 * @param $uname
 * @param $upss
 * @param string $head
 * @param int $gender
 * @param $email
 * @return int
 */
function add_user($uname, $upss, $head, $gender,$email):int{
    //写insert语句
    $sql = "insert into tbl_user(uName,uPass,head,gender,email) values('$uname','$upss','$head','$gender','$email')";
    return exec_update($sql);
}

/**
 * @param $uname
 * @param $upass
 * @return mixed
 */
function get_user($uname, $upass):mixed{
    $sql = "select * from tbl_user where uName = '$uname' and uPass = '$upass'";
    $result = exec_select($sql);
    return $result[0];
}

/**
 * @param $uid
 * @param $upass
 * @param $email
 * @param $head
 * @param $gender
 * @return int
 */
function update_user($uid, $upass, $email, $head, $gender):int{
    $sql = "update tbl_user set uPass = '$upass', email = '$email', head = '$head', gender = '$gender' where uId = '$uid'";
    return exec_update($sql);
}
