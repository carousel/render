    <?php

        class Render
        {
            public $view;
            public $public_path = __DIR__.'/views/';
            public $data;
            public $content;
            public $tags = ['|:',':|'];
            public function __construct($view)
            {
                $this->view = $this->public_path . $view;
            }
            public function render()
            {
                $view = file_get_contents($this->view);
                if (isset($this->data)) {
                    $pattern = '/\|\:\$' . $this->data[0] . '\:\|/';
                    $this->content = preg_replace($pattern, $this->data[1], $view);
                } else {
                    $this->clean($view);
                }
            }
            public function clean($view)
            {
                //$pattern = '(['.$this->tags[0] .$this->tags[1] . ']+)';
                //$view = preg_replace($pattern, '', $view);
                //$this->content = $view;
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
        $view = new Render('master.php');
        $title = 'Hello World';
        $view->make(['title',$title]);
