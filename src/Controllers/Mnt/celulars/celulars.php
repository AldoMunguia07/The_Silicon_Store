<?php

                namespace Controllers\Mnt\celulars;

                use Controllers\PrivateController;

                use Views\Renderer;

                class celulars extends PrivateController {

                    public function run(): void {

                    $viewData = array();

                    $viewData["celular"] = \Dao\Mnt\celulars::obtenerTodos();

                    Renderer::render("mnt\celulars", $viewData);
   
                    }

                }

            ?>