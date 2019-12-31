<?php

/**
* @Author Deepak
* @Class Database Driver Interface
* @Date 21/01/2016  
*/
Interface DatabaseDriver{

	public static function connect();
	public static function query($query);
	public static function execute($variables);

}