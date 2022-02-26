<?php

    namespace Controllers\Clientes; //Coincidir con el nombre de la carpeta

    use Controllers\PublicController;
    use Views\Renderer;

    class Clientes extends PublicController
    {
        public function run(): void{
            $viewData = array();
            $viewData["titulo"] = "Manejo de clientes";


            $viewData["clientes"] = array(
                "Orlando",
                "Josue",
                "Adriana",
                "Carlos Gabriel",
                "Argelio"
            );

            Renderer::render('Clientes/Clientes', $viewData);
        }
    }

?>