<?php
namespace Fw\Core\Component;
//Базовый класс для компонентов приложения
abstract class Base {
    public $result;
    public $id;
    public $params;
    public $template;
    public $__path;

    //метод выполнения компонента
    abstract public function executeComponent();

    //Конструктор компонента
    public function __construct(string $id, string $template, string $path, array $params) {
        $this->id = $id;
        $this->__path = $path;
        $this->params = $params;
        $this->template = new Template($template, $this);
    }
}