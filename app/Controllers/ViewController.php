<?php

namespace App\Controllers;

use App\Views\HomeView;

class ViewController
{
  public function index()
  {
    $path = $_SERVER['REQUEST_URI'];

    $view = new HomeView();

    $view->render($path);
  }
}
