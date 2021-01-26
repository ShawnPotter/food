<?php
  //The Controller

  //turn on error reporting
  ini_set('display_errors', 1);
  error_reporting(E_ALL);

  //require autoload file
  require_once("vendor/autoload.php");

  //create an instance of the base class
  $f3 = Base::instance();
  $f3->set('DEBUG', 3);



  //Define a default route (home page)
  $f3->route('GET /', function(){
    //echo "Page rendered";
    $view = new Template();
    echo $view->render('views/home.html');
  });

  //define a "breakfast" route
  $f3->route('GET /breakfast/@item', function($f3, $params){

    //var_dump($params);
    $menu = array("eggs", "waffles", "pancakes");
    $item = $params['item'];
    if(in_array($item, $menu)){
      switch($item){
        case 'eggs':
          $view = new Template();
          echo $view->render('views/eggs.html');
          break;
        case 'pancakes':
          echo "Swedish or American?";
          break;
        case 'waffles':
          $f3->reroute("https://wafflehouse.com");
          break;
        case 'bacon':
          $view = new Template();
          echo $view->render('views/bacon.html');
          break;
        default:
          $f3->error(404);

      }
      //echo "We serve $item";
    } else {
      echo "Sorry, we don't serve $item";
    }

    //echo "Breakfast";
  });

  //define a "lunch" route
  $f3->route('GET /lunch', function(){
    $view = new Template();
    echo $view->render('views/lunch.html');
  });

  //run fat free
  $f3->run();
