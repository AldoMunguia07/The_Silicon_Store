<?php
                namespace Controllers\Mnt\Anonimas;

                use Controllers\PublicController;
                use Utilities\Validators;
                use Views\Renderer;

                class Anonima extends PublicController
                {
            

                    private $_modeStrings = array(
                        "INS" => "Nuevo Anonima",
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
            
                        "anoncartid" => 0,
                        "invPrdId" => 0,
                        "cartCtd" => 0,
                        

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

                if(isset($_GET["invPrdId"]) && isset($_GET["anoncartid"]))
                {
                    $this->_viewData["invPrdId"] = $_GET["invPrdId"];
                    $this->_viewData["anoncartid"] = $_GET["anoncartid"];
                }

                /*if(!isset($this->_modeStrings[$this->_viewData["mode"]]))
                {
                    error_log($this->toString()." ".$this->_viewData["mode"], 0);

                    \Utilities\Site::redirectToWithMsg("index.php?page=mnt.Anonimas.Anonimas",
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
                //print_r($_POST);
                //\Utilities\Site::redirectToWithMsg("index.php", print_r($_POST));
                /*if(!isset($_SESSION["Anonima_xssToken"]) || $_SESSION["Anonima_xssToken"] !== $this->_viewData["xssToken"])
                {
                    unset($_SESSION["Anonima_xssToken"]);
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt.Anonimas.Anonimas",
                    "Ocurrio un error, no se puede procesar el formulario");
                }*/

                $this->_viewData["invPrdId"] = intval($this->_viewData["invPrdId"], 10);
                $this->_viewData["anoncartid"] = intval($this->_viewData["anoncartid"], 10);
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

                   
                   /* switch($this->_viewData["mode"])
                    {

                        CASE "INS":                    
                            $result = \Dao\Mnt\Anonimas::newAnonima($this->_viewData["cartCtd"],$this->_viewData["cartPrc"],$this->_viewData["cartIat"]);

                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg("index.php?page=mnt.Anonimas.Anonimas", "Operacion realizada con exito");
                        }
                        break;

                        CASE "UPD":                    
                            $result = \Dao\Mnt\Anonimas::actualizarAnonima($this->_viewData["anoncartid"],$this->_viewData["invPrdId"],$this->_viewData["cartCtd"]);

                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg("index.php", "Cantidad agregada al carrito");
                        }
                        break;

                        CASE "DEL":                    
                            $result = \Dao\Mnt\Anonimas::eliminarAnonima($this->_viewData["anoncartid"], $this->_viewData["invPrdId"]);

                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg("index.php?page=mnt.Anonimas.Anonimas", "Operacion realizada con exito");
                        }
                        break;

                    }*/

                    if($this->_viewData["anoncartid"] == 0)
                    {
                        $result = \Dao\Mnt\Anonimas::newAnonima($this->_viewData["invPrdId"], $this->_viewData["cartCtd"],$this->_viewData["cartPrc"], date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")."+ 5 days")));

                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg("index.php", "Agregado al carrito");
                        }
                    }
                    else
                    {
                        if($this->_viewData["cartCtd"] > 0)
                        {
                            $result = \Dao\Mnt\Anonimas::actualizarAnonima($this->_viewData["anoncartid"],$this->_viewData["invPrdId"],$this->_viewData["cartCtd"]);

                            if($result)
                            {
                                \Utilities\Site::redirectToWithMsg("index.php", "Cantidad agregada al carrito");
                            }

                        }
                        else
                        {
                            $result = \Dao\Mnt\Anonimas::eliminarAnonima($this->_viewData["anoncartid"], $this->_viewData["invPrdId"]);

                            if($result)
                            {
                                \Utilities\Site::redirectToWithMsg("index.php", "Producto eliminado del carrito");
                            }

                        }
                        

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

                    $tmpAnonima = \Dao\Mnt\Anonimas::obtenerAnonimaPorId($this->_viewData["anoncartid"], intval($this->_viewData["invPrdId"]));
                    \Utilities\ArrUtils::mergeFullArrayTo($tmpAnonima, $this->_viewData);
            

                    $this->_viewData["modeDsc"] = sprintf($this->_modeStrings[$this->_viewData["mode"]], $this->_viewData["invPrdId"], $this->_viewData["invPrdId"]);

                    if($this->_viewData["mode"] == "DSP" || $this->_viewData["mode"] == "DEL")
                    {   
                        $this->_viewData["readonly"] = "readonly";
                    }
                        
                }

                $this->_viewData["cmbOptions"] = \Utilities\ArrUtils::toOptionsArray(
                    $this->_cmbOptions,
                    "value",
                    "text",
                    "selected",                
                    $this->_viewData["option"]
                );

                $this->_viewData["xssToken"] = md5(time() . "Anonima");
                $_SESSION["Anonima_xssToken"] = $this->_viewData["xssToken"];
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
                    //$this->prepareViewData();
                    Renderer::render("mnt/Anonima", $this->_viewData);
                }
        }

    ?>