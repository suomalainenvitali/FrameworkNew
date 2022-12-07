<?
namespace Fw\Core;

//Класс приложения на паттерне одиночке
class Application {

    private $pager = null;
    private static $instance = null;
    private $template = null;

    private function __construct() {}
    private function clone() {}

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        
        return self::$instance;
    }
}