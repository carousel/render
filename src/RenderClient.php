<?php

namespace Carousel;

class RenderClient
{
    public $render;
    public function __construct(Render $render, $data = [], $view)
    {
        $this->render = $render;
        $this->render->setView($view);
        $this->render->setData($data);
    }
}
