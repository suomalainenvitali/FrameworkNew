<?
//Класс автозагрузчик неймспейсов
class Autoloader {
    //Метод подключающий автозагруску неймспейсов
    public static function getLoader() {
        spl_autoload_register([
            'Autoloader', 'loadClass'
        ], true, true);
    }

    //Метод подключающий файл класса
    public static function loadClass(string $class): void {
        $path = self::buildPath($class);

        if (file_exists("{$_SERVER["DOCUMENT_ROOT"]}/$path")) {
            require_once $path;
        }
    }

    //Метод построения пути к классу
    public static function buildPath(string $class): string {
        $arPath = explode('\\', $class);

        if (count($arPath) < 2) return null;        

        return sprintf(
            '%s.php',
            implode('/', $arPath)
        );
    }
}