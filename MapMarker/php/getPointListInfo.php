<?php
/**
 * Created by PhpStorm.
 * User: ArisesSky
 * Date: 15/8/10
 * Time: 下午10:19
 */

    $user = 'root';
    $password = 'root';
    $db = 'test';
    $host = 'localhost';
    $port = 3306;
    $success = mysql_connect(
        $host,
        $user,
        $password
    );
    mysql_select_db("SAP",$success);
    $sql = "select position_x,position_y,community_name from user where username ='".$login_name."' and password ='".$login_pass."';";
    $result = mysql_query($sql);
    $num = mysql_fetch_row($result);
    if($num){

        header('Location: ../html/mapMarker.html');
        exit;
    }else{
        echo "<script>
                alert('please check your username or your password!');

              </script>";
    }


?>