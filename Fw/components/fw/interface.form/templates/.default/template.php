<?php
/*
    Form component 

    $includeComponent - анонимная функция подключающая компонент, принимающая в качестве параметров -
    набор пораметров подключаемого компонента

    $params - содержит набор параметров, которые принимает компонент

    $printProperty - анонимная функция, выводящая в форматированном виде атрибут из набора параметров

    Аттрибуты компонента form:
    accept-charset => Устанавливает кодировку, в которой сервер может принимать и обрабатывать данные.
    action => адрес программы или документа, который обрабатывает данные формы.
    additional_class => класс, которым наделяется компонент
    attr => массив атрибутов, которые добавляются в компонент по принципу $key => $value
    autocomplete => включает автозаполнение полей формы.
    enctype => cпособ кодирования данных формы.
    id => id компонента
    method => метод протокола HTTP.
    name => имя формы.
    novalidate => отменяет встроенную проверку данных формы на корректность ввода.
    target => имя окна или фрейма, куда обработчик будет загружать возвращаемый результат.
*/


$includeComponent = function($element) use ($APPLICATION)  {
    switch($element["type"]) {
        case 'checkbox':
            $APPLICATION->includeComponent("fw:interface.input.checkbox", ".default", $element);
            break;
        case 'checkbox-multiple':
            $APPLICATION->includeComponent("fw:interface.input.checkbox.multiple", ".default", $element);
            break; 
        case 'email':
            $APPLICATION->includeComponent("fw:interface.input.email", ".default", $element);
            break;
        case 'number':
            $APPLICATION->includeComponent("fw:interface.input.number", ".default", $element);
            break;
        case 'password':
            $APPLICATION->includeComponent("fw:interface.input.password", ".default", $element);
            break;
        case 'radio':
            $APPLICATION->includeComponent("fw:interface.input.radio", ".default", $element);
            break;
        case 'select':
            $APPLICATION->includeComponent("fw:interface.select", ".default", $element);
            break;
        case 'select-multiple':
            $APPLICATION->includeComponent("fw:interface.select.multiple", ".default", $element);
            break;      
        case 'text':
            $APPLICATION->includeComponent("fw:interface.input.text", ".default", $element);
            break;
        case 'text-multiple':
            $APPLICATION->includeComponent("fw:interface.input.text.multiple", ".default", $element);
            break;
        case 'textarea':
            $APPLICATION->includeComponent("fw:interface.textarea", ".default", $element);
            break;       
    }
};

$params = $this->component->params;

$printProperty = function ($value) use ($params) {
    if (!isset($params[$value])) return;

    switch ($value) {
        case "accept-charset":
            echo " accept-charset='{$params["accept-charset"]}'";
            break;
        case "action":
            echo " action='{$params["action"]}'";
            break;
        case "additional_class":
            echo " class='{$params["additional_class"]}'";
            break; 
        case "attr":
            foreach ($params["attr"] as $key => $value) echo " $key='$value'";
            break;
        case "autocomplete":
            echo " autocomplete='{$params["autocomplete"]}'";
            break;  
        case "enctype":
            echo " enctype='{$params["enctype"]}'";
            break; 
        case "id":
            echo " id='{$params["id"]}'";
            break;
        case "method":
            echo " method='{$params["method"]}'";
            break;       
        case "name":
            echo " name='{$params["name"]}'";
            break;
        case "novalidate":
            if ($params["novalidate"]) echo " novalidate";
            break;
        case "target":
            echo " target='{$params["target"]}'";
            break;     
    }
};
?>
<form
    <?php
    $printProperty("accept-charset");
    $printProperty("action");
    $printProperty("additional_class");
    $printProperty("attr");
    $printProperty("autocomplete");
    $printProperty("enctype");
    $printProperty("id");
    $printProperty("method");
    $printProperty("name");
    $printProperty("novalidate");
    $printProperty("target");
    ?>
>
    <?php
    if(isset($params["elements"])) {
        foreach ($params["elements"] as $element) {
            if(!isset($element["type"])) continue;
            $includeComponent($element);
            echo "<br>";
        }
    }
    ?>
</form>
