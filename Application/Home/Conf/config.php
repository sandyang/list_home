<?php
return array(
	//'配置项'=>'配置值'

  /* 数据库设置 */
  'DB_TYPE'               =>  'mysql',     // 数据库类型
  'DB_HOST'               =>  '127.0.0.1', // 服务器地址
  'DB_NAME'               =>  'list_home',          // 数据库名
  'DB_USER'               =>  'root',      // 用户名
  'DB_PWD'                =>  '',          // 密码
  'DB_PORT'               =>  '3306',        // 端口
  'DB_PREFIX'             =>  'lh_',    // 数据库表前缀


  'TMPL_PARSE_STRING'  =>array(
    '__RESOURCE__'          =>  'Public',
  ),



    // 配置邮件发送服务器
    'MAIL_HOST' =>'smtp.qq.com',//smtp服务器的名称
    'MAIL_SMTPAUTH' =>TRUE, //启用smtp认证
    'MAIL_USERNAME' =>'605780034@qq.com',//你的邮箱名
    'MAIL_FROM' =>'605780034@qq.com',//发件人地址
    'MAIL_FROMNAME'=>'先火',//发件人姓名
    'MAIL_PASSWORD' =>'efitxpswcmybbbgf',//邮箱密码
    'MAIL_CHARSET' =>'utf-8',//设置邮件编码
    'MAIL_ISHTML' =>TRUE, // 是否HTML格式邮件

);