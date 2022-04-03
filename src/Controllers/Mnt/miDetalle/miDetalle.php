<?php

    namespace Controllers\Mnt\miDetalle;

    use Controllers\PrivateController;


    use Views\Renderer;

    class miDetalle extends PrivateController {

        public function run(): void {

        $viewData = array();
        if(isset($_GET["doccod"]))
        {
            $idDoc = $_GET["doccod"];
        }

        $viewData["miDetalle"] = \Dao\Mnt\documentoFiscals::MisDetalles($idDoc);

        Renderer::render("mnt\miDetalle", $viewData);

        }

    }

?>