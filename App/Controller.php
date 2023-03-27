<?php

abstract class Controller
{
    public function loadModel(string $model)
    {
        require_once(ROOT.'models/'.$model.'.php');
        
        $this->$model = new $model();
    }

    public function render(string $fichier, array $data = [])
    {
        //récupère chq étiquette et créé une var pour chacune
        extract($data);

        //démarre le buffer qui permet de stocker tout ce qui est fait 
        // ob_start();
        
        require_once(ROOT.'views/'.strtolower(get_class($this)).'/'.$fichier.'.php');

        // $content = ob_get_clean();

        // require_once(ROOT.'views/layouts/default.php');
    }
}