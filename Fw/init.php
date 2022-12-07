<?
use Fw\Core\Application;

include_once "autoload.php";

session_start();

Autoloader::getLoader();

$GLOBALS["APPLICATION"] = Application::getInstance();