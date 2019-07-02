<?php

require_once 'Data.php';
class Router{ 
    
    //Recupere url
    public function setUrl($url) {
        $this->route($url);
    }

    //Redection vers la page souhaitee
    private function route($page){
        $page = strtolower($page);
        if (strpos($page, 'controller')) {
            //Redirection vers les controllers
            require_once '../controller/' . $page . '.php';
        } elseif (is_file('../template/' . $page . '.php')) {
            //Redirection vers les templates
            require_once '../template/' . $page . '.php'; 
        } else {
            //page no file pas redirection 404 
            throw new Exception("page introuvable", 404);
        }
         
    }
}