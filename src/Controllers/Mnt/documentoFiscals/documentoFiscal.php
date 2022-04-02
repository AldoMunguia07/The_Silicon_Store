<?php
                namespace Controllers\Mnt\documentoFiscals;

                use Controllers\PublicController;
                use Utilities\Validators;
                use Views\Renderer;

                class documentoFiscal extends PublicController
                {
            

                    private $_modeStrings = array(
                        "INS" => "Nuevo documentoFiscal",
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
            
"doccod" => 0,
"invPrdId" => 0,
"docCtd" => "",
"docPrc" => "",
"docIva" => "",
"docLObs" => "",
"docDsc" => "",

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

                if(isset($_GET["invPrdId"]))
                {
                    $this->_viewData["invPrdId"] = $_GET["invPrdId"];
                }

                if(!isset($this->_modeStrings[$this->_viewData["mode"]]))
                {
                    error_log($this->toString()." ".$this->_viewData["mode"], 0);

                    \Utilities\Site::redirectToWithMsg("index.php?page=mnt.documentoFiscals.documentoFiscals",
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

                if(!isset($_SESSION["documentoFiscal_xssToken"]) || $_SESSION["documentoFiscal_xssToken"] !== $this->_viewData["xssToken"])
                {
                    unset($_SESSION["documentoFiscal_xssToken"]);
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt.documentoFiscals.documentoFiscals",
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

                    unset($_SESSION["documentoFiscal_xssToken"]);
                        
                    switch($this->_viewData["mode"])
                    {

                        CASE "INS":                    
                            $result = \Dao\Mnt\documentoFiscals::newdocumentoFiscal($this->_viewData["docCtd"],$this->_viewData["docPrc"],$this->_viewData["docIva"],$this->_viewData["docLObs"],$this->_viewData["docDsc"]);

                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg("index.php?page=mnt.documentoFiscals.documentoFiscals", "Operacion realizada con exito");
                        }
                        break;

                        CASE "UPD":                    
                            $result = \Dao\Mnt\documentoFiscals::actualizardocumentoFiscal($this->_viewData["doccod"],$this->_viewData["invPrdId"],$this->_viewData["docCtd"],$this->_viewData["docPrc"],$this->_viewData["docIva"],$this->_viewData["docLObs"],$this->_viewData["docDsc"]);

                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg("index.php?page=mnt.documentoFiscals.documentoFiscals", "Operacion realizada con exito");
                        }
                        break;

                        CASE "DEL":                    
                            $result = \Dao\Mnt\documentoFiscals::eliminardocumentoFiscal($this->_viewData["invPrdId"]);

                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg("index.php?page=mnt.documentoFiscals.documentoFiscals", "Operacion realizada con exito");
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

                    $tmpdocumentoFiscal = \Dao\Mnt\documentoFiscals::obtenerdocumentoFiscalPorId(intval($this->_viewData["invPrdId"]));
                    \Utilities\ArrUtils::mergeFullArrayTo($tmpdocumentoFiscal, $this->_viewData);
            

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

                $this->_viewData["xssToken"] = md5(time() . "documentoFiscal");
                $_SESSION["documentoFiscal_xssToken"] = $this->_viewData["xssToken"];
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
                    Renderer::render("mnt/documentoFiscal", $this->_viewData);
                }
        }

    ?>