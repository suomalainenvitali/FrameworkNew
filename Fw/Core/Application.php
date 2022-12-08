<?
namespace Fw\Core;

use Fw\Core\Multiton\Multiton;
use Fw\Core\Type\Request;
use Fw\Core\Type\Server;
use Fw\Core\Type\Session;

//Класс приложения на паттерне одиночке
class Application {
    private $pager = null;
    private $template = null;
    private $templatePath = null;
    private $session = null;
    private $request = null;
    private $server = null;
    // Конструктор класса приложения
    public function __construct() {
        $this->setTemplate(".default");
        $this->pager = new Page();
        $this->session = Multiton::getInstance(Session::class);
        $this->request = Multiton::getInstance(Request::class);
        $this->server = Multiton::getInstance(Server::class);
    }
    // Метод установки значения шаблона и пути к нему
    public function setTemplate(string $name) {
        $folder = "templates";
        $templateId = Config::get("$folder/$name");

        if (isset($templateId)) {
            $this->template = $name;
            $this->templatePath = "{$_SERVER["DOCUMENT_ROOT"]}/Fw/$folder/$templateId/";
        }
    }
    // Метод подключения header.php шаблона сайта
    public function header() {
        global $APPLICATION;
        $this->startBuffer();
        include $this->templatePath . "header.php";
    }
    // Метод подключения footer.php шаблона сайта
    public function footer() {
        global $APPLICATION;
        include $this->templatePath . "footer.php";
        $this->endBuffer();
    }
    // Начало работы буфера
    public function startBuffer() {
        ob_start();
    }
    // Конец работы буфера
    public function endBuffer() {
        $content = ob_get_contents();
        $arrReplace = $this->pager->getAllReplace();
        $content = str_replace(array_keys($arrReplace), $arrReplace, $content);
        ob_end_clean();
        echo $content;
    }
    // Очистка буфера
    public function restartBuffer() {
        ob_clean();
    }
    // Вывод макросов заголовка страницы
    public function ShowHead() {
        $this->pager->showCss();
        $this->pager->showHeadString();
        $this->pager->showJs();
    }
    // Вывод макроса свойства
    public function ShowProperty(string $id) {
        $this->pager->showProperty($id);
    }
    // Установка значения свойства
    public function SetProperty(string $id, string $value) {
        $this->pager->setProperty($id, $value);
    }
    // Получение значения свойства
    public function GetProperty(string $id): ?string {
        return $this->pager->getProperty($id);
    }
    // Добавление стиля в заголовок страницы
    public function AddCss(string $link) {
        $this->pager->addCss($link);
    }
    // Добавление стиля в заголовок страницы
    public function AddJs(string $src) {
        $this->pager->addJs($src);
    }
    // Добавление стиля в заголовок страницы
    public function AddString(string $str) {
        $this->pager->addString($str);
    }
    // Возвращает значение pager
    public function getPager(): Page {
        return $this->pager;
    }
    // Возвращает значение request
    public function getRequest(): Request {
        return $this->request;
    }
    // Возвращает значение server
    public function getServer(): Server {
        return $this->server;
    }
    // Возвращает значение session
    public function getSession(): Session {
        return $this->session;
    }
    //подключение компонента
    public function includeComponent(string $component, string $template, array $params) {
        //Путь до класса компонента
        $path = "{$_SERVER["DOCUMENT_ROOT"]}/Fw/components/";
        list($folder, $componentId) = explode(":", $component); 
        $path .= "$folder/$componentId/"; 
        //Получение названия класса компонента
        $componentClass = "";
        foreach (explode(".", $componentId) as $value) {
            $componentClass .= ucfirst($value);
        }
        //Подключаемый файл компонента
        $сomponentFile = $path . "$componentClass.class.php";
        // Если компонент не найден, прекращаем работу
        if (!file_exists($сomponentFile)) return;
        //Подключение компонента
        include $сomponentFile;
        //Создание компонента
        $componentInclude = new $componentClass($componentId, $template, $path, $params);
        //Выполнение работы компонента
        $componentInclude->executeComponent();
    }
}