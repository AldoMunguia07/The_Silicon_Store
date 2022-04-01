<?php

                namespace Controllers\Mnt\Autenticados;

                use Controllers\PrivateController;

                use Views\Renderer;

                class Autenticados extends PrivateController {

                    public function run(): void {

                    $viewData = array();

                    $viewData["carretilla_anon"] = \Dao\Mnt\Anonimas::obtenerTodosI($_SESSION["anoncartid"]);
                    /*print_r($viewData["carretilla_anon"]);
                    print($_SESSION["login"]["userId"]);*/
                    $userId = $_SESSION["login"]["userId"];
                    for ($i = 0; $i < count($viewData["carretilla_anon"]); $i++) {

                        $productId = $viewData["carretilla_anon"][$i]["invPrdId"];
                        $cantidad = $viewData["carretilla_anon"][$i]["cartCtd"];
                        $precio = $viewData["carretilla_anon"][$i]["cartPrc"];
                        $Iat= $viewData["carretilla_anon"][$i]["cartIat"];


                        $resultado = \Dao\Mnt\Autenticados::newAutenticado($userId, $productId, $cantidad, $precio, $Iat);
                    }
                    $viewData["carretilla_auth"] = \Dao\Mnt\Autenticados::obtenerTodos($userId);

                    
                    Renderer::render("mnt\Autenticados", $viewData);
   
                    }

                }

            ?>