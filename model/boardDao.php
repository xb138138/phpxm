<?php
require_once 'conn.php';

/**
 * 根据板块编号获取板块信息，返回结果
 * @param $boardId
 * @return mixed
 */
function get_board($boardId): mixed{
    $sql="select * from tbl_board order by bId desc";
    return exec_select($sql);
}

/**
 * 获取子板块
 * @param $parentId
 * @return array
 */
function get_son_boards($parentId): array {
    $sql = "select * from tbl_board where parentId = $parentId";
    return exec_select($sql);
}

function get_all_board():array
{
    $sql = "select * from tbl_board";
    return exec_select($sql);
}

