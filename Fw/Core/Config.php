<?
namespace Fw\Core;

//Класс для работы с конфигами
class Config {
    private function __construct() {}
    private function __clone() {}   
    //Метод получения значения конфига по пути
    public static function get(string $path): string {
        //Подключение файла с массивом конфигов по пути
        include_once "{$_SERVER["DOCUMENT_ROOT"]}/Fw/config.php";
        //Разбиение строки пути на ступени
        $arPath = explode('/', $path);
        //Получение массива конфигов
        $configs = getConfigs();
        //Поиск в массиве конфигов значение необходимого
        foreach ($arPath as $step) {
            if(!isset($configs[$step])) return null;
            $configs = $configs[$step];
        }

        return $configs;
    }

}