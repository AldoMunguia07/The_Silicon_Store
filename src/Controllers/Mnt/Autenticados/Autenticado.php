<?php
                namespace Controllers\Mnt\Autenticados;

                use Controllers\PrivateController;
                use Utilities\Validators;
                use Views\Renderer;

                class Autenticado extends PrivateController
                {
            

                    private $_modeStrings = array(
                        "INS" => "Nuevo Autenticado",
                        "UPD" => "Editar %s (%s)",
                        "DSP" => "Detalle de %s (%s)",
                        "DEL" => "Eliminando %s (%s)"
                    );

                    private $_cmbOptions = array(
                        "OPC1" => "Opcion 1",
                        "OPC2" => "Opcion 2",
                        "OPC3" => "Opcion 3"
                    );

                    private $_viewData = array(
                    "mode" => "INS",
            
                        "usercod" => 0,
                        "invPrdId" => 0,
                        "cartCtd" => "",
                        "cartPrc" => "",
                        "cartIat" => "",

                        "modeDsc"=>"",
                        "readonly"=>"",
                        "isInsert"=>false,
                        "cmbOptions" => [],
                        "option" => "",
                        "xssToken" => ""
                    );

            private function init()
            {

                if(isset($_GET["mode"]))
                {
                    $this->_viewData["mode"] = $_GET["mode"];
                }

                if(isset($_GET["invPrdId"]) && isset($_GET["usercod"]))
                {
                    $this->_viewData["invPrdId"] = $_GET["invPrdId"];
                    $this->_viewData["usercod"] = $_GET["usercod"];
                }

                /*if(!isset($this->_modeStrings[$this->_viewData["mode"]]))
                {
                    error_log($this->toString()." ".$this->_viewData["mode"], 0);

                    \Utilities\Site::redirectToWithMsg("IndexAuth.php?page=mnt.Autenticados.Autenticados",
                    "Sucedio un error al procesar la pagina");
                }

                if($this->_viewData["mode"] != "INS" && intval($this->_viewData["invPrdId"], 10) != 0)
                {
                    $this->_viewData["mode"] !== "DSP";
                }*/

            }

            private function handlePost()
            {
                \Utilities\ArrUtils::mergeFullArrayTo($_POST, $this->_viewData);

                /*if(!isset($_SESSION["Autenticado_xssToken"]) || $_SESSION["Autenticado_xssToken"] !== $this->_viewData["xssToken"])
                {
                    unset($_SESSION["Autenticado_xssToken"]);
                    \Utilities\Site::redirectToWithMsg(
                        "IndexAuth.php?page=mnt.Autenticados.Autenticados",
                    "Ocurrio un error, no se puede procesar el formulario");
                }*/

                $this->_viewData["invPrdId"] = intval($this->_viewData["invPrdId"], 10);
                $this->_viewData["usercod"] = intval($this->_viewData["usercod"], 10);

                if(true)/* aplicar validaciones */
                {

                }
                else
                {
                    $this->_viewData["errors"][] ="Mensaje de error";
                }

                if(isset($this->_viewData["errors"]) && count($this->_viewData["errors"]) > 0)
                {

                }
                else
                {

                    $tmpAnonima = \Dao\Mnt\Autenticados::obtenerAutenticadoPorId(intval($this->_viewData["usercod"]), intval($this->_viewData["invPrdId"]));
                    
                    if(!$tmpAnonima)
                    {
                        if($this->_viewData["cartCtd"] <= 0)
                        {
                            \Utilities\Site::redirectToWithMsg("index.php?page=IndexAuth", "Ingrese al menos 1 producto");
                        }
                        else
                        {
                            $result = \Dao\Mnt\Autenticados::newAutenticadoAuth($this->_viewData["usercod"], $this->_viewData["invPrdId"], $this->_viewData["cartCtd"],$this->_viewData["cartPrc"], date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")."+ 5 days")));

                            if($result)
                            {
                                \Utilities\Site::redirectToWithMsg("index.php?page=Catalogo", "Agregado al carrito");
                            }

                        }
                    }
                    else
                    {
                        if($this->_viewData["cartCtd"] > 0)
                        {
                            $result = \Dao\Mnt\Autenticados::actualizarAutenticado($this->_viewData["usercod"],$this->_viewData["invPrdId"],$this->_viewData["cartCtd"]);

                            if($result)
                            {
                                \Utilities\Site::redirectToWithMsg("index.php?page=Catalogo", "Cantidad agregada al carrito");
                            }

                        }
                        else
                        {
                            $result = \Dao\Mnt\Autenticados::eliminarAutenticado($this->_viewData["usercod"], $this->_viewData["invPrdId"]);

                            if($result)
                            {
                                \Utilities\Site::redirectToWithMsg("index.php?page=Catalogo", "Producto eliminado del carrito");
                            }

                        }
                        

                    }
                        
                   
                }
            
            }

           

                public function run(): void
                {
                    /*$viewData = array();
                    $this->isPostBack();*/
                    $this->init();
                    if($this->isPostBack())
                    {
                        $this->handlePost();
                    }
                    Renderer::render("Catalogo", $this->_viewData);
                }
        }

    ?>