<?php

                namespace Controllers\Mnt\inventarios;

                use Controllers\PrivateController;

                use Views\Renderer;

                class inventarios extends PrivateController {

                    public function run(): void {

                    $viewData = array();

                    $viewData["inventario"] = \Dao\Mnt\inventarios::obtenerTodos();

                    Renderer::render("mnt\inventarios", $viewData);
   
                    }

                }

            ?>