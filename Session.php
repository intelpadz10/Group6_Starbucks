<?php
namespace Sessions;

class Session {
     
    public static function start(){
        session_start();
    } 

    public static function stop(){
        session_destroy();
    }

    public static function add($key,$value){
        return $_SESSION[$key] = $value;
    }

    public static function get($key,$indexList=null){
        $numberOfArguments = func_num_args();
        if($numberOfArguments > 1){
            if(is_array($indexList)){  
                $current = $_SESSION[$key];
                foreach($indexList as $indexKey){
                      $current = $current[$indexKey];  
                }
                return $current;
            } elseif (is_string($indexList) or is_numeric($indexList)){
                  return $_SESSION[$key][$indexList];
            } 
        } elseif($numberOfArguments <= 1){
            return $_SESSION[$key];   
        }           
    }

    public static function remove($key){
            unset($_SESSION[$key]);
        return true;
    }

    public static function has($key){
        if(isset($_SESSION[$key]))
            return true;
        else
            return false;
    }

    public static function removeFirstElement($key){
        $i=0;
        for($i; $i < (count($_SESSION[$key]) - 1); $i++){
            $_SESSION[$key][$i] = $_SESSION[$key][$i+1];
        }
        unset($_SESSION[$key][$i]);
    }

    public static function removeSpecificElement($key, $position){
        $i=0;
        for($i; $i < (count($_SESSION[$key]) - 1); $i++){
            if($i >= $position){
                $_SESSION[$key][$i] = $_SESSION[$key][$i+1];
            }
        }
        unset($_SESSION[$key][$i]);
    }
}
