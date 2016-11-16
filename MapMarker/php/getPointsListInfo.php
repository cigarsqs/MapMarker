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
    mysql_select_db("test",$success);
    $sql = "SELECT * FROM Community;";
    mysql_query("set names 'utf8'");
    $result = mysql_query($sql);
    $points =array();    
        while ($num = mysql_fetch_array($result)) {
            
            $list=array("position_x"=>$num[position_x],"position_y"=>$num[position_y],"community_name"=>$num[community_name],"comminity_per_price"=>$num[comminity_per_price],"house_number"=>$num[house_number]);
            $points[] = $list;

        }
        echo json_encode($points);
    

?>