<?
namespace Fw\Core\Multiton;

//Трейт для класса Мультитон, содержащий в единственном экземпляре все классы одиночки приложения
trait MultitonTrait {
    protected static $instances = [];

    private function __construct() {}
    private function __clone() {}

    public static function getInstance(string $instance) {
        if (empty(self::$instances[$instance])) static::$instances[$instance] = new $instance;

        return self::$instances[$instance];
    }
}