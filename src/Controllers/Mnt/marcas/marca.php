<?php
                namespace Controllers\Mnt\marcas;

                use Controllers\PrivateController;
                use Utilities\Validators;
                use Views\Renderer;

                class marca extends PrivateController
                {
            

                    private $_modeStrings = array(
                        "INS" => "Nuevo marca",
                        "UPD" => "Editar %s (%s)",
                        "DSP" => "Detalle de %s (%s)",
                        "DEL" => "Eliminando %s (%s)"
                    );

                    private $_cmbEstado = array(
                        "ACT" => "Activo",
                        "INA" => "Inactivo"
                        
                    );

                    private $_viewData = array(
                    "mode" => "INS",
            
"idMarca" => 0,
"marca" => "",
"estado" => "",

                        "modeDsc"=>"",
                        "readonly"=>"",
                        "isInsert"=>false,
                        "cmbEstado" => [],
                        "option" => "",
                        "xssToken" => ""
                    );

            private function init()
            {

                if(isset($_GET["mode"]))
                {
                    $this->_viewData["mode"] = $_GET["mode"];
                }

                if(isset($_GET["idMarca"]))
                {
                    $this->_viewData["idMarca"] = $_GET["idMarca"];
                }

                if(!isset($this->_modeStrings[$this->_viewData["mode"]]))
                {
                    error_log($this->toString()." ".$this->_viewData["mode"], 0);

                    \Utilities\Site::redirectToWithMsg("index.php?page=mnt.marcas.marcas",
                    "Sucedio un error al procesar la pagina");
                }

                if($this->_viewData["mode"] != "INS" && intval($this->_viewData["idMarca"], 10) != 0)
                {
                    $this->_viewData["mode"] !== "DSP";
                }

            }

            private function handlePost()
            {
                \Utilities\ArrUtils::mergeFullArrayTo($_POST, $this->_viewData);

                if(!isset($_SESSION["marca_xssToken"]) || $_SESSION["marca_xssToken"] !== $this->_viewData["xssToken"])
                {
                    unset($_SESSION["marca_xssToken"]);
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt.marcas.marcas",
                    "Ocurrio un error, no se puede procesar el formulario");
                }

                $this->_viewData["idMarca"] = intval($this->_viewData["idMarca"], 10);

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

                    unset($_SESSION["marca_xssToken"]);
                        
                    switch($this->_viewData["mode"])
                    {

                        CASE "INS":                    
                            $result = \Dao\Mnt\marcas::newmarca($this->_viewData["marca"],$this->_viewData["estado"]);

                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg("index.php?page=mnt.marcas.marcas", "Operacion realizada con exito");
                        }
                        break;

                        CASE "UPD":                    
                            $result = \Dao\Mnt\marcas::actualizarmarca($this->_viewData["idMarca"],$this->_viewData["marca"],$this->_viewData["estado"]);

                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg("index.php?page=mnt.marcas.marcas", "Operacion realizada con exito");
                        }
                        break;

                        CASE "DEL":                    
                            $result = \Dao\Mnt\marcas::eliminarmarca($this->_viewData["idMarca"]);

                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg("index.php?page=mnt.marcas.marcas", "Operacion realizada con exito");
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

                    $tmpmarca = \Dao\Mnt\marcas::obtenermarcaPorId(intval($this->_viewData["idMarca"]));
                    \Utilities\ArrUtils::mergeFullArrayTo($tmpmarca, $this->_viewData);
            

                    $this->_viewData["modeDsc"] = sprintf($this->_modeStrings[$this->_viewData["mode"]], $this->_viewData["marca"], $this->_viewData["idMarca"]);

                    if($this->_viewData["mode"] == "DSP" || $this->_viewData["mode"] == "DEL")
                    {   
                        $this->_viewData["readonly"] = "readonly";
                    }
                        
                }

                $this->_viewData["cmbEstado"] = \Utilities\ArrUtils::toOptionsArray(
                    $this->_cmbEstado,
                    "value",
                    "text",
                    "selected",                
                    $this->_viewData["estado"]
                );

                $this->_viewData["xssToken"] = md5(time() . "marca");
                $_SESSION["marca_xssToken"] = $this->_viewData["xssToken"];
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
                    Renderer::render("mnt/marca", $this->_viewData);
                }
        }

    ?>