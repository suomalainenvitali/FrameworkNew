<?
namespace Fw\Core;

class Route {
    //Запрет на клонирование объекта и создание его
    private function __construct() {}
    private function __clone() {}

    //Метод роутинга
    public static function route(string $url): void {
        //Подключение файла с массивом маршрутов
        include_once "{$_SERVER["DOCUMENT_ROOT"]}/Fw/routes.php";
        //Получение массива маршрутов
        $routes = getRoutes();
        //Получение пути из URL
        $path = parse_url($url, PHP_URL_PATH);
        //Поиск маршрута
        foreach ($routes as $route) {
            if (preg_match($route['condition'], $path, $params)) {
                array_shift($params);        
                $urlParameters = preg_replace_callback( '/(\$[0-9]+)/', function($match) use(&$params) {
                    return array_shift($params);
                }, $route['rule']);
            }
            var_dump($urlParameters);
        }
    }
}