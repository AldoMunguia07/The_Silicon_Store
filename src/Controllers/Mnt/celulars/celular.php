<?php
                namespace Controllers\Mnt\celulars;

                use Controllers\PrivateController;
                use Utilities\Validators;
                use Views\Renderer;

                class celular extends PrivateController
                {
            

                    private $_modeStrings = array(
                        "INS" => "Nuevo celular",
                        "UPD" => "Editar %s (%s)",
                        "DSP" => "Detalle de %s (%s)",
                        "DEL" => "Eliminando %s (%s)"
                    );

                    private $_cmbOptionsEst = array(
                        "ACT" => "Activo",
                        "INA" => "Inactivo"
                    );

                    private $_viewData = array(
                    "mode" => "INS",
            
"invPrdId" => 0,
"nombre" => "",
"descripcion" => "",
"precio" => "",
"estado" => "",
"idMarca" => "",

                        "modeDsc"=>"",
                        "readonly"=>"",
                        "isInsert"=>false,
                        "cmbMarca" => [],
                        "idMarca" => "",
                        "xssToken" => ""
                    );

            private function init()
            {

                if(isset($_GET["mode"]))
                {
                    $this->_viewData["mode"] = $_GET["mode"];
                }

                if(isset($_GET["invPrdId"]))
                {
                    $this->_viewData["invPrdId"] = $_GET["invPrdId"];
                }

                if(!isset($this->_modeStrings[$this->_viewData["mode"]]))
                {
                    error_log($this->toString()." ".$this->_viewData["mode"], 0);

                    \Utilities\Site::redirectToWithMsg("index.php?page=mnt.celulars.celulars",
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

                if(!isset($_SESSION["celular_xssToken"]) || $_SESSION["celular_xssToken"] !== $this->_viewData["xssToken"])
                {
                    unset($_SESSION["celular_xssToken"]);
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt.celulars.celulars",
                    "Ocurrio un error, no se puede procesar el formulario");
                }

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

                    unset($_SESSION["celular_xssToken"]);
                        
                    switch($this->_viewData["mode"])
                    {

                        CASE "INS":                    
                            $result = \Dao\Mnt\celulars::newcelular($this->_viewData["nombre"],$this->_viewData["descripcion"],$this->_viewData["precio"],$this->_viewData["estado"],$this->_viewData["idMarca"]);

                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg("index.php?page=mnt.celulars.celulars", "Operacion realizada con exito");
                        }
                        break;

                        CASE "UPD":                    
                            $result = \Dao\Mnt\celulars::actualizarcelular($this->_viewData["invPrdId"],$this->_viewData["nombre"],$this->_viewData["descripcion"],$this->_viewData["precio"],$this->_viewData["estado"],$this->_viewData["idMarca"]);

                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg("index.php?page=mnt.celulars.celulars", "Operacion realizada con exito");
                        }
                        break;

                        CASE "DEL":                    
                            $result = \Dao\Mnt\celulars::eliminarcelular($this->_viewData["invPrdId"]);

                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg("index.php?page=mnt.celulars.celulars", "Operacion realizada con exito");
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

                    $tmpcelular = \Dao\Mnt\celulars::obtenercelularPorId(intval($this->_viewData["invPrdId"]));
                    \Utilities\ArrUtils::mergeFullArrayTo($tmpcelular, $this->_viewData);
            

                    $this->_viewData["modeDsc"] = sprintf($this->_modeStrings[$this->_viewData["mode"]], $this->_viewData["nombre"], $this->_viewData["invPrdId"]);

                    if($this->_viewData["mode"] == "DSP" || $this->_viewData["mode"] == "DEL")
                    {   
                        $this->_viewData["readonly"] = "readonly";
                    }
                        
                }

                $marcas = \Dao\Mnt\marcas::obtenerTodosCmb();
                $this->_viewData["marcas"] = $marcas;
                $marcasCmb = array();
                for($i = 0; $i < count($this->_viewData["marcas"]); $i++)
                {
                    $marcasCmb[$marcas[$i]["idMarca"]] = $marcas[$i]["marca"];
                    

                }

                //print_r( $marcasCmb);
                $this->_viewData["cmbMarca"] = \Utilities\ArrUtils::toOptionsArray(
                    $marcasCmb,
                    "value",
                    "text",
                    "selected",                
                    $this->_viewData["idMarca"]
                );

               $this->_viewData["cmbEstado"] = \Utilities\ArrUtils::toOptionsArray(
                    $this->_cmbOptionsEst,
                    "value",
                    "text",
                    "selected",                
                    $this->_viewData["estado"]
                );

                $this->_viewData["xssToken"] = md5(time() . "celular");
                $_SESSION["celular_xssToken"] = $this->_viewData["xssToken"];
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
                    
                   
                    Renderer::render("mnt/celular", $this->_viewData);
                }
        }

    ?>