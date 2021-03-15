<?php

namespace MyProject\View;

class View
{
    private $templatesPath;

    public function __construct()
    {
        $this->templatesPath = __DIR__ . '/../../../templates';
    }

    public function renderTemplate(string $templateName):void
    {
        ob_start();
        include $this->templatesPath . '/' . $templateName;
        $buffer = ob_get_contents();
        ob_end_clean();

        echo $buffer;
    }

    public function renderHtml(string $templateName, array $vars = []):void
    {
        extract($vars, EXTR_OVERWRITE);

        ob_start();
        include $this->templatesPath . '/' . $templateName;
        $buffer = ob_get_contents();
        ob_end_clean();

        echo $buffer;
    }
}