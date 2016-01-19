<?php
namespace Carousel;

        class Render
        {
            public $template;
            public $public_path = __DIR__.'/views/';
            public $data;
            public $content;
            public $quotes = '{{}}';
            public function __construct($template)
            {
                $this->template = $this->public_path.$template;
            }
            public function render()
            {
                $template = file_get_contents($this->template);
                if (isset($this->data)) {
                    $pattern = '(['.$this->quotes.']+)';
                    $this->content = preg_replace($pattern, $this->data, $template);
                } else {
                    $this->clean($template);
                }
            }
            public function clean($template)
            {
                $pattern = '(['.$this->quotes.']+)';
                $template = preg_replace($pattern, '', $template);
                $this->content = $template;
            }
            public function make($data = null)
            {
                $this->data = $data;
                $this->render();
                $this->send();
            }
            public function send()
            {
                echo $this->content;
            }
        }
        $view = new Render('index.render.php');
        $view->make('Paragraph');
