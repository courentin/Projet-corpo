<?php
class App{

    static $db = null;

    static function getDatabase(){
        if(!self::$db){
            self::$db = new Database(Conf::$db['login'], Conf::$db['mdp'], Conf::$db['database'], Conf::$db['host']);
        }
        return self::$db;
    }

    static function route($route)
    {
    	return WEBROOT.$route;
    }
}