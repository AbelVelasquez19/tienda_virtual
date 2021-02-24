<?php 
  require_once("Config/Config.php");
  $url = !empty($_GET['url']) ? $_GET['url'] : 'home/home';
  $arrUrl = explode('/', $url);
  $controller =$arrUrl[0];
  $metods=$arrUrl[0];
  $params = "";

   if(!empty($arrUrl[1])){
       if($arrUrl[1] != ""){
            $metods=$arrUrl[1];
       }
   }

   if(!empty($arrUrl[2])){
        if($arrUrl[2] != ""){
            for ($i=2; $i < count($arrUrl) ; $i++) { 
                $params.=$arrUrl[$i].","; 
            }
            $params =trim($params,',');
        }
    }

    spl_autoload_register(function($class){
        if(file_exists(LIBS."Core/".$class.".php")){
            require_once(LIBS."Core/".$class.".php");
        }
    });

    //load
    $controllerfile = "Controllers/".$controller.".php";
    if(file_exists($controllerfile)){
        require_once($controllerfile);
        $controller = new $controller();
        if(method_exists($controller,$metods)){
            $controller->{$metods}($params);
        }else{
            echo "No existe el metodo";
        }   
    }else{
        echo "No existe controlador";
    }


?>