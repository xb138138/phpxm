<?php
/*
 * @Author: 林晨 14169164+lin--chen@user.noreply.gitee.com
 * @Date: 2025-05-22 09:09:53
 * @LastEditors: 林晨 14169164+lin--chen@user.noreply.gitee.com
 * @LastEditTime: 2025-05-22 09:20:04
 * @FilePath: \www\太阳\诚信论坛静态原型页面\model\userDao.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */
/**
 * 完成tbl_uesr表的增删改查
 */
require_once 'conn.php';
/**
 * @param $uname
 * @param $upss
 * @param string $head
 * @param int $gender
 * @param $email
 * @return int
 */
function add_user($uname, $upss, $head, $gender, $email): int
{
    //写insert语句
    $sql = "insert into tbl_user(uName,uPass,head,gender,email) values('$uname','$upss','$head','$gender','$email')";
    return exec_update($sql);
}

/**
 * @param $uname
 * @param $upass
 * @return array
 */
function get_user($uname, $upass): array
{
    $sql = "select * from tbl_user where uName = '$uname' and uPass = '$upass'";
    $result = exec_select($sql);
    return $result[0] ?? [];
}

/**
 * @param $uid
 * @param $upass
 * @param $email
 * @param $head
 * @param $gender
 * @return int
 */
function update_user($uid, $upass, $email, $head, $gender): int
{
    $sql = "update tbl_user set uPass = '$upass', email = '$email', head = '$head', gender = '$gender' where uId = '$uid'";
    return exec_update($sql);
}