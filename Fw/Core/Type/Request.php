<?
namespace Fw\Core\Type;
//Класс запросов приложения
class Request extends Dictionary {
    public function __construct() {
        parent::__construct($_REQUEST, true);
    }
}

