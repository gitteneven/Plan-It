<?php

class Controller {

  public $route;
  protected $viewVars = array();
  // set environment to development by default
  protected $mode = 'development';

  public function filter() {
    // switch environment to production if the file is not in a folder named 'src'
    if (basename(dirname(dirname(__FILE__))) != 'src') {
      $this->mode = 'production';
    }
    call_user_func(array($this, $this->route['action']));
  }

  public function render() {
    // set a variable js and css for the development environment (done by webpack dev server)
    // 3000 is the port set in our webpack config
    $this->set('js', '<script src="http://localhost:3000/script.js"></script>');
    $this->set('css', '');

    // link starting js and css files from the dist folder in production
    if ($this->mode == 'production') {
      $this->set('js', '<script src="script.js"></script>');
      $this->set('css', '<link href="style.css" rel="stylesheet">');
    }

    $this->createViewVarWithContent();
    $this->renderInLayout();

    /*
    // in case you work with sessions for info and errors
    if (!empty($_SESSION['info'])) {
      unset($_SESSION['info']);
    }
    if (!empty($_SESSION['error'])) {
      unset($_SESSION['error']);
    }

    */
  }

  public function set($variableName, $value) {
    $this->viewVars[$variableName] = $value;
  }

  private function createViewVarWithContent() {
    extract($this->viewVars, EXTR_OVERWRITE);
    ob_start();
    require __DIR__ . '/../view/' . strtolower($this->route['controller']) . '/' . $this->route['action'] . '.php';
    $content = ob_get_clean();
    $this->set('content', $content);
  }

  private function renderInLayout() {
    extract($this->viewVars, EXTR_OVERWRITE);
    include __DIR__ . '/../view/layout.php';
  }

}
