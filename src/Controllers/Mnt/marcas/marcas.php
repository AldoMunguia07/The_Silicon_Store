<?php

                namespace Controllers\Mnt\marcas;

                use Controllers\PrivateController;

                use Views\Renderer;

                class marcas extends PrivateController {

                    public function run(): void {

                    $viewData = array();

                    $viewData["marca"] = \Dao\Mnt\marcas::obtenerTodos();

                    Renderer::render("mnt\marcas", $viewData);
   
                    }

                }

            ?>