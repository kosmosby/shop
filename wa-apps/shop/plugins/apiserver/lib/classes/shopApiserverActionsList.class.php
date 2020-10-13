<?php
/**
 * Created by PhpStorm.
 * User: vitali
 * Date: 23.01.20
 * Time: 8:47
 */

class shopApiserverActionsList{

    /* array $key == $_POST['action_name'],
    *  $value == actionName */

   public static $actionsArray = array(
          'run_app' => 'runApp',
    );

   public static function getActionIfExist($action){
       if (!empty (self::$actionsArray[$action])){
           return self::$actionsArray[$action];
       }
       else {return "";}
   }
}