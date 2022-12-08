<?php
namespace Fw\Core\Component;

//Класс шаблона приложения
class Template {
    public $__path;
    public $__relativePath;
    private $id;
    private $component;
    
    //метод отображения шаблона компонента
    public function render(string $page="template") {
        global $APPLICATION;
        //Получение путей до файлов шаблона
        $resultModifier = $this->__path . "result_modifier.php";
        $template = $this->__path . $page . ".php";
        $componentEpilog = $this->__path . "component_epilog.php";
        $style = "style.css";
        $script = "script.js";
        //Подключение php файлов шаблона
        if (file_exists($resultModifier)) include $resultModifier;
        if (file_exists($template)) include $template;
        if (file_exists($componentEpilog)) include $componentEpilog;
        //Подключение файлов стилей в приложение
        if (file_exists($this->__path . $style)) $APPLICATION->AddCss($this->__relativePath . $style);
        if (file_exists($this->__path . $script)) $APPLICATION->AddJs($this->__relativePath . $script);
    }

    //Конструктор класса
    public function __construct(string $id, Base $component) {
        $this->id = $id;
        $this->component = $component;
        $this->__path = $component->__path . "templates/$id/";
        $this->__relativePath = explode($_SERVER["SERVER_NAME"], strtolower($this->__path))[1];
    }
}