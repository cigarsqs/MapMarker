<?php

/**
 * Created by PhpStorm.
 * User: ArisesSky
 * Date: 16/3/7
 * Time: 下午10:19
 */
if (!empty($_REQUEST['action'])) {
    try {
        $action = explode('/', $_REQUEST['action']);
        $class_name = $action[0];
        $method_name = $action[1];
        require '../php/action/'.$class_name . '.php';
        $class = new ReflectionClass($class_name);
        if (class_exists($class_name)) {
            if ($class->hasMethod($method_name)) {
                $func = $class->getmethod($method_name);
                $instance = $class->newInstance();
                $func->invokeArgs($instance, array($_REQUEST));
                $result = $instance->getResult();
                echo $result;
            }
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}
?>