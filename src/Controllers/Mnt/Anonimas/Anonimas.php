<?php

    namespace Controllers\Mnt\Anonimas;

    use Controllers\PublicController;

    use Views\Renderer;

    class Anonimas extends PublicController {

        public function run(): void {

        $viewData = array();


        $viewData["carretilla_anon"] = \Dao\Mnt\Anonimas::obtenerTodos($_SESSION["anoncartid"]);
        $mostrar = false;
        if(count($viewData["carretilla_anon"]) > 0)
        {
            $mostrar = true;
        }
        else
        {
            $mostrar = false;
        }

        $viewData["mostrar"] = $mostrar;
        //var_dump($viewData);
        Renderer::render("mnt\Anonimas", $viewData);

        }

    }

?>