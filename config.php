<?php
function __autoload($classname){
	require_once "klase/{$classname}.class.php";
}
