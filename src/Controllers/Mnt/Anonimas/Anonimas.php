<?php

    namespace Controllers\Mnt\Anonimas;

    use Controllers\PublicController;

    use Views\Renderer;

    class Anonimas extends PublicController {

        public function run(): void {

        $viewData = array();


        $viewData["carretilla_anon"] = \Dao\Mnt\Anonimas::obtenerTodos($_SESSION["anoncartid"]);

        Renderer::render("mnt\Anonimas", $viewData);

        }

    }

?>