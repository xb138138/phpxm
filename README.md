项目开发流程：
1.需求分析：项目的角色、项目的功能
2.详细设计：页面设计(原型图)、数据库设计(sql脚本)、功能设计(接口文档)
3.编码：开发前台页面、开发后台功能
4.系统集成
5.测试
6.部署(项目上线)

云计算前端3234班：3人1组，51人，一共17组。
1.完成个性化前端页面设计。(论坛的页面样式、LOGO)
2.以小组为单位，完成基本功能和扩展功能(加分项)。
基本功能：
用户：1)用户登录和注册
2)用户个人信息编辑功能
3)用户登录后，可以发帖、回帖
4)用户未登录，只能查看论坛首页
5)用户只能修改、删除本人的帖子
6)首页显示一级版块和二级版块信息、二级版块的帖子总数及最新帖子信息。

扩展功能：1)帖子分页功能
2)热帖排行榜
3)管理员功能：管理员登录、用户管理、帖子管理、版块管理

数据库：bbs
tbl_board  版块信息表
tbl_user     用户信息表
tbl_topic   帖子信息表
tbl_reply   回帖信息表

项目架构：3层
表示层：view
login.php/reg.php/index.php  .......
业务层：control
doLogin.php/doReg.php/doTopic.php .....
数据层：model
boardDao.php/userDao.php/topicDao.php/replyDao.php
每张数据表对应一个独立的dao

论坛的功能设计：
tbl_user     用户信息表:
//添加用户信息，返回bool--->用户注册
function add_user($uname,$upass,$head,$gender);

       //根据用户名和密码查询用户信息，返回一维数组 --->用户登录
    function get_user($uname,$upass);

     //根据用户id更新用户信息，返回bool--->用户信息编辑
    function update_user($uid);
