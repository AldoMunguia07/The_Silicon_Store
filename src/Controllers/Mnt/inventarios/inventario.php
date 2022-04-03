<?php
                namespace Controllers\Mnt\inventarios;

                use Controllers\PrivateController;
                use Utilities\Validators;
                use Views\Renderer;

                class inventario extends PrivateController
                {
            

                    private $_modeStrings = array(
                        "INS" => "Nuevo inventario",
                        "UPD" => "Editar cantidad %s (%s)",
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
            
                        "idInventario" => 0,
                        "invPrdId" => 0,
                        "nombre" => "",
                        "cantidad" => "",

                        "modeDsc"=>"",
                        "readonly"=>"",
                        "isInsert"=>false,
                        "cmbCelulares" => [],
                        "option" => "",
                        "xssToken" => ""
                    );

            private function init()
            {

                if(isset($_GET["mode"]))
                {
                    $this->_viewData["mode"] = $_GET["mode"];
                }

                if(isset($_GET["invPrdId"]) && isset($_GET["idInventario"]))
                {
                    $this->_viewData["idInventario"] = $_GET["idInventario"];
                    $this->_viewData["invPrdId"] = $_GET["invPrdId"];
                
                    
                }

                if(isset($_GET["nombre"]))
                {
                    
                    $this->_viewData["nombre"] = $_GET["nombre"];
                    
                }

                if(!isset($this->_modeStrings[$this->_viewData["mode"]]))
                {
                    error_log($this->toString()." ".$this->_viewData["mode"], 0);

                    \Utilities\Site::redirectToWithMsg("index.php?page=mnt.inventarios.inventarios",
                    "Sucedio un error al procesar la pagina");
                }

                if($this->_viewData["mode"] != "INS" && intval($this->_viewData["invPrdId"], 10) != 0)
                {
                    $this->_viewData["mode"] !== "DSP";
                }

            }

            private function handlePost()
            {
                \Utilities\ArrUtils::mergeFullArrayTo($_POST, $this->_viewData);

               

                $this->_viewData["invPrdId"] = intval($this->_viewData["invPrdId"], 10);

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

                    unset($_SESSION["inventario_xssToken"]);
                        
                    switch($this->_viewData["mode"])
                    {

                        CASE "INS":  
                                             
                            $result = \Dao\Mnt\inventarios::newinventario($this->_viewData["invPrdId"], $this->_viewData["cantidad"]);

                            if($result)
                            {
                                \Utilities\Site::redirectToWithMsg("index.php?page=mnt.inventarios.inventarios", "Operacion realizada con exito");
                            }
                             break;

                        CASE "UPD": 
                                        
                            $result = \Dao\Mnt\inventarios::actualizarinventario($this->_viewData["idInventario"],$this->_viewData["invPrdId"],$this->_viewData["cantidad"]);

                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg("index.php?page=mnt.inventarios.inventarios", "Operacion realizada con exito");
                        }
                        break;

                        CASE "DEL":                    
                            $result = \Dao\Mnt\inventarios::eliminarinventario($this->_viewData["idInventario"], $this->_viewData["invPrdId"]);

                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg("index.php?page=mnt.inventarios.inventarios", "Operacion realizada con exito");
                        }
                        break;

                    }
                }
            
            }

            private function prepareViewData()
            {
                if($this->_viewData["mode"] == "INS")
                {
                    $this->_viewData["isInsert"] = true;
                    $this->_viewData["modeDsc"] = $this->_modeStrings[$this->_viewData["mode"]];
                }
                else
                {

                    $tmpinventario = \Dao\Mnt\inventarios::obtenerinventarioPorId(intval($this->_viewData["idInventario"]), intval($this->_viewData["invPrdId"]));
                    \Utilities\ArrUtils::mergeFullArrayTo($tmpinventario, $this->_viewData);
            

                    $this->_viewData["modeDsc"] = sprintf($this->_modeStrings[$this->_viewData["mode"]], $this->_viewData["nombre"], $this->_viewData["invPrdId"]);

                    if($this->_viewData["mode"] == "DSP" || $this->_viewData["mode"] == "DEL")
                    {   
                        $this->_viewData["readonly"] = "readonly";
                    }
                        
                }

                $celulares = \Dao\Mnt\celulars::obtenerTodosCmb();
                $this->_viewData["celulares"] = $celulares;
                $celularesCmb = array();
                for($i = 0; $i < count($this->_viewData["celulares"]); $i++)
                {
                    $celularesCmb[$celulares[$i]["invPrdId"]] = $celulares[$i]["nombre"];
                    

                }

                $this->_viewData["cmbCelulares"] = \Utilities\ArrUtils::toOptionsArray(
                    $celularesCmb,
                    "value",
                    "text",
                    "selected",                
                    $this->_viewData["invPrdId"]
                );

               

                $this->_viewData["xssToken"] = md5(time() . "inventario");
                $_SESSION["inventario_xssToken"] = $this->_viewData["xssToken"];
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
                    $this->prepareViewData();

                    Renderer::render("mnt/inventario", $this->_viewData);
                }
        }

    ?>