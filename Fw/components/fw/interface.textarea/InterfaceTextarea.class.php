<?php
use Fw\Core\Component\Base;

class InterfaceTextarea extends Base {
    public function executeComponent() {
        $this->template->render();
    }
}