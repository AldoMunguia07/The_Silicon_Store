<?php

namespace Controllers\Mnt\misTransacciones;

use Controllers\PrivateController;

use Views\Renderer;

class misTransacciones extends PrivateController {

    public function run(): void {

    $viewData = array();

    $userId = $_SESSION["login"]["userId"];
    $viewData["misTransacciones"] = \Dao\Mnt\documentos::MisTransacciones($userId);
    $mostrar = false;
    if($viewData["misTransacciones"])
    {
        $mostrar = true;
    }
    else
    {
        $mostrar = false;
    }

    $viewData["mostrar"] = $mostrar;
    Renderer::render("mnt\misTransacciones", $viewData);

    }

}

?>