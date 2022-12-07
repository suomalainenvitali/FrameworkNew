<?php
namespace Fw\Core;
// Класс управления контентом страницы
class Page {
    private $js = [];
    private $css = [];
    private $str = []; 
    private $properties = [];

    // Значения макросов без свойств
    private $arMacros = array (
        "CSS" => "#FW_PAGE_CSS#",
        "STR" => "#FW_PAGE_STR#",
        "JS" => "#FW_PAGE_JS#",
    );
    // Макрос определенного свойства
    private function getPropertyMacros($id): string {
        return "#FW_PAGE_PROPERTY_{$id}#";
    }
    //Добавление JS файла
    public function addJs(string $src) {
        if (!in_array($src, $this->js)) $this->js[] = $src;
    }
    //Добавление СSS файла
    public function addCss(string $link) {
        if (!in_array($link, $this->css)) $this->css[] = $link;
    }
    //Добавление строкового свойства
    public function addString(string $str) {
        if (!in_array($str, $this->str)) $this->str[] = $str;
    }
    //Вывов CSS макроса
    public function showCss() {
        echo $this->arMacros["CSS"];
    }
    //Вывов STR макроса
    public function showHeadString() {
        echo $this->arMacros["STR"];
    }
    //Вывов JS макроса
    public function showJs() {
        echo $this->arMacros["JS"];
    }
    //Установка значения свойства страницы
    public function setProperty(string $id, string $value) {
        if (!empty($id)) $this->properties[$id] = $value;
    }
    //Получение значения свойства страницы
    public function getProperty(string $id): ?string {        
        return isset($this->properties[$id]) ? $this->properties[$id] : null;
    }
    //Вывод макроса свойства
    public function showProperty(string $id) {
        echo $this->getPropertyMacros($id);
    }
    //Возвращает массив всех значений свойств и макросов (ключей массива) пейджера
    public function getAllReplace(): array {
        $replaceItems = [];
        
        $replaceItems[$this->arMacros["CSS"]] = "";

        foreach ($this->css as $link) {
            $replaceItems[$this->arMacros["CSS"]] .= "<link href='$link' type='text/css' rel='stylesheet'>";
        }       
        
        $replaceItems[$this->arMacros["STR"]] = "";

        foreach ($this->str as $str) {
            $replaceItems[$this->arMacros["STR"]] .= $str;
        }

        $replaceItems[$this->arMacros["JS"]] = "";

        foreach ($this->js as $src) {
            $replaceItems[$this->arMacros["JS"]] .= "<script async src='$src'></script>";
        }

        foreach ($this->properties as $id => $value)
        {
            $replaceItems[$this->getPropertyMacros($id)] = $value;
        }

        return $replaceItems;
    }
}