<?php

require __DIR__.'/../vendor/autoload.php';
use Carousel\RenderClient;
use Carousel\Render;

$client = new RenderClient(new Render(), ['title' => 'World'], 'layout.php');
$client->render->make();
