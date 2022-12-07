<?
namespace Fw\Core;

//Класс приложения на паттерне одиночке
class Application {

    private $pager = null;
    private $template = null;
    private $templatePath = null;

    // Конструктор класса приложения
    public function __construct() {
        $this->setTemplate(".default");
        $this->pager = new Page();
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
}