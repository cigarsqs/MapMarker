<?php
/**
 * Created by PhpStorm.
 * User: ArisesSky
 * Date: 15/8/10
 * Time: 下午10:19
 */
    if(isset($_POST["submit"])&&$_POST["submit"]=="login"){
        $login_name = $_POST["login-name"];
        $login_pass = $_POST['login-pass'];
        if($login_name ==""||$login_pass ==""){
            echo "<script>
                    alert('请输入用户名与密码!');
                    history.go(-1);
                  </script>";
        }else{
            $user = 'root';
            $password = 'root';
            $db = 'SAP';
            $host = 'localhost';
            $port = 3306;
            $success = mysql_connect(
                $host,
                $user,
                $password
            );
            mysql_select_db("SAP",$success);
            $sql = "select username,password from user where username ='".$login_name."' and password ='".$login_pass."';";
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

        }
    }

?>
