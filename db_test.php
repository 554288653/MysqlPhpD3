<?php
  require("db_config.php");

  //面向对象方式
  $mysqli = new mysqli($db_host, $db_user, $db_pwd, $db_name);

  //面向对象的昂视屏蔽了连接产生的错误，需要通过函数来判断
  if(mysqli_connect_error()){
      echo mysqli_connect_error();
  }

  //设置编码
  $mysqli->set_charset("utf8");

  //查询数据到数组中
  $sql = "select * from person";
  $result = $mysqli->query($sql);
  if($result === false){//执行失败
      echo $mysqli->error;
      echo $mysqli->errno;
  }

  $json ="";
  $data =array(); //定义好一个数组.PHP中array相当于一个数据字典.

  //定义一个类,用到存放从数据库中取出的数据
  class Name
  {
    public $name ;
    public $age;
  }

  while ($row= mysqli_fetch_array($result, MYSQL_ASSOC))
  {
    $user =new Name();
    $user->name = $row['name'];
    $user->age = $row['age'];
    $data[]=$user;
  }

  $json = json_encode($data);//把数据转换为JSON数据.
  echo $json;
?>
