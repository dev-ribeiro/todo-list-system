<?php

namespace App\Views;

use App\Config;

class HomeView
{
  public function render($path)
  {
    $this->loadStaticAssets($path);
  }

  public function loadStaticAssets(string $path)
  {

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
      case ($path === '/static/css/main'): {
          header('Content-Type: text/css');

          $cssFile = Config::PATH_TO_PUBLIC . "static/css/main.css";

          if (file_exists($cssFile)) {

            readfile($cssFile);
          } else {

            header("HTTP/1.0 404 Not Found");

            echo "Arquivo JS não encontrado.";
          }

          break;
        }
      case ($path === '/static/js/api-adapter'): {
        header('Content-Type: application/js');

          $jsFile = Config::PATH_TO_PUBLIC . "static/js/api-adapter.js";

          if (file_exists($jsFile)) {

            readfile($jsFile);
          } else {

            header("HTTP/1.0 404 Not Found");

            echo "Arquivo JS não encontrado.";
          }

          break;
        }
      case ($path === '/'): {
          $home = Config::PATH_TO_PUBLIC . "index.html";

          readfile($home);

          break;
        }
      default:
        echo "Not Found!";
    }
  }
}
