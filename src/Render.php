<?php

namespace Carousel;

/**
 * Initial bootstrap class for template engine.
 */
class Render
{
    public $view;
    public $public_path = __DIR__.'/views/';
    public $data;
    public $content;
    public $tags = ['|:',':|'];

    /**
     * Set layout view.
     *
     * @param string view
     */
    public function setView($view)
    {
        $this->view = file_get_contents($this->public_path.$view);
    }

    /**
     * Set data.
     *
     * @param array data
     */
    public function setData($data = null)
    {
        $this->data = $data;
    }

    /**
     * Match and compile data into view.
     *
     * @param array data
     * @param string view path
     */
    public function compile($data, $view)
    {
        $pattern = '/\|\:\$'.key($data).'\:\|/';
        if (preg_match($pattern, $view)) {
            $this->content = preg_replace($pattern, $data[key($data)], $view);
        } else {
            $this->content = preg_replace('/\|\:\$[a-zA-Z]*\:\|/', '', $view);
        }
    }
    /**
     * Cleaning if no match is found.
     *
     * @param string view
     */
    public function clean($view)
    {
        $view = preg_replace('/\|\:\$[a-zA-Z]*\:\|/', '', $view);
        $this->content = $view;
    }
    /**
     * Validate input.
     *
     * @param array data
     */
    public function validateData($data)
    {
        if (count(array_filter($this->data)) != 0) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Prepare view for sending to client.
     */
    public function make()
    {
        $view = $this->view;
        if ($this->validateData($this->data)) {
            $this->compile($this->data, $view);
        } else {
            $this->clean($view);
        }
        $this->send();
    }
    /**
     * Send page to client.
     */
    public function send()
    {
        echo $this->content;
    }
}
