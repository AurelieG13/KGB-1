<?php
//création du routeur 

// On génère une constante contenant le chemin vers la racine publique du projet
define('ROOT', str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));

// On appelle le modèle et le contrôleur principaux
require_once(ROOT.'App/Model.php');
require_once(ROOT.'App/Controller.php');

//on sépare les params
$params = explode('/', $_GET['p']);

//est ce qu'un param existe ?
if($params[0] != ""){

    // On sauvegarde le 1er paramètre dans $controller en mettant sa 1ère lettre en majuscule
    $controller = ucfirst($params[0]);

    //on récupère le 2e param et on met index s'il n'existe pas
    $action = isset($params[1]) ? $params[1] : 'index';

    require_once(ROOT.'Controllers/'.$controller.'.php');
    
    //instancier le controller
    $controller = new $controller();


    //on vérifie si la méthode existe dans le controller
    
    if(method_exists($controller, $action)){
        unset($params[0]);
        unset($params[1]);
        call_user_func_array([$controller,$action], $params);
        // On appelle la méthode
        // $controller->$action();    
    }else{

        http_response_code(404);
        echo "La page demandée n'existe pas";
    }

}else{
    // Ici aucun paramètre n'est défini
    // On appelle le contrôleur par défaut
    // require_once(ROOT.'controllers/Main.php');

    // // On instancie le contrôleur
    // $controller = new Main();

    // // On appelle la méthode index
    // $controller->index();
}