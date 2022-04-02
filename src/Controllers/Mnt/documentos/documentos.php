<?php

                namespace Controllers\Mnt\documentos;

                use Controllers\PublicController;

                use Views\Renderer;

                class documentos extends PublicController {

                    public function run(): void {

                    $viewData = array();

                    $viewData["documento_fiscal"] = \Dao\Mnt\documentos::obtenerTodos();

                    Renderer::render("mnt\documentos", $viewData);
   
                    }

                }

            ?>