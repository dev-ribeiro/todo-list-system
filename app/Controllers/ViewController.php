<?php

namespace App\Controllers;

use App\Config;

class ViewController
{
  public function index()
  {
    $path = $_SERVER['REQUEST_URI'];

    switch ($path) {
      case ($path === '/static/js/main'): {
          header('Content-Type: application/js');

          $jsFile = Config::PATH_TO_PUBLIC . "static/js/main.js";

          if (file_exists($jsFile)) {

            readfile($jsFile);
          } else {

            header("HTTP/1.0 404 Not Found");

            echo "Arquivo JS não encontrado.";
          }

          break;
        }

      default:
        $html = Config::PATH_TO_PUBLIC . "index.html";
        header('Content-Type: text/html');
        readfile($html);
    }
  }
}
