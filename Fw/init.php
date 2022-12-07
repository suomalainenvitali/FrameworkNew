<?
use Fw\Core\Application;
use Fw\Core\Multiton\Multiton;

define("CORE_CONSTANT", true);

include_once "autoload.php";

session_start();

Autoloader::getLoader();

$GLOBALS["APPLICATION"] = Multiton::getInstance(Application::class);
