<?php

                namespace Controllers\Mnt\documentoFiscals;

                use Controllers\PublicController;

                use Views\Renderer;

                class documentoFiscals extends PublicController {

                    public function run(): void {

                    $viewData = array();

                    $viewData["documento_fiscal_lineas"] = \Dao\Mnt\documentoFiscals::obtenerTodos();

                    Renderer::render("mnt\documentoFiscals", $viewData);
   
                    }

                }

            ?>