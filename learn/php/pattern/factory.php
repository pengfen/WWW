<?php

namespace pattern;

/**
    工厂模式
        工厂方法或者类生成对象 而不是在代码中直接 new

    单例模式
        使某个类的对象仅允许创建一个

    注册模式
        全局共享和交换对象
*/

    class Factory
    {
    	static function createDatabase() {
    		$db = new Database;
    		return $db;
    	}
    }
