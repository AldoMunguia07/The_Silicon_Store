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

                        if($viewData["carretilla_anon"])
                        {
                            for ($i = 0; $i < count($viewData["carretilla_anon"]); $i++) {

                                $productId = $viewData["carretilla_anon"][$i]["invPrdId"];
                                $cantidad = $viewData["carretilla_anon"][$i]["cartCtd"];
                                $precio = $viewData["carretilla_anon"][$i]["cartPrc"];
                                $Iat= $viewData["carretilla_anon"][$i]["cartIat"];
        
        
                                $resultado = \Dao\Mnt\Autenticados::newAutenticado($userId, $productId, $cantidad, $precio, $Iat);

                                if($resultado)
                                {
                                    $delete = \Dao\Mnt\Anonimas::eliminarAnonima($_SESSION["anoncartid"], $productId);

                                    if( $i == count($viewData["carretilla_anon"]) - 1)
                                    {
                                        unset($_SESSION["anoncartid"]);
                                    }

                                }
                            }

                        }
                    
                        $viewData["carretilla_auth"] = \Dao\Mnt\Autenticados::obtenerTodos($userId);

                        $mostrar = false;
                        if(count($viewData["carretilla_auth"]) > 0)
                        {
                            $mostrar = true;
                        }
                        else
                        {
                            $mostrar = false;
                        }

                        $viewData["mostrar"] = $mostrar;

                        
                        Renderer::render("mnt\Autenticados", $viewData);
   
                    }

                }

            ?>