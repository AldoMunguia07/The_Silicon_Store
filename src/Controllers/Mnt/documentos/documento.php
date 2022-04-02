<?php
                namespace Controllers\Mnt\documentos;

                use Controllers\PublicController;
                use Utilities\Validators;
                use Views\Renderer;

                class documento extends PublicController
                {
            

                    private $_modeStrings = array(
                        "INS" => "Nuevo documento",
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
"docfch" => "",
"usercod" => "",
"docobs" => "",
"docshipping" => "",
"docest" => "",
"docmeta" => "",
"docfchdlv" => "",
"docestdlv" => "",
"docFrmPgo" => "",

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

                if(isset($_GET["doccod"]))
                {
                    $this->_viewData["doccod"] = $_GET["doccod"];
                }

                if(!isset($this->_modeStrings[$this->_viewData["mode"]]))
                {
                    error_log($this->toString()." ".$this->_viewData["mode"], 0);

                    \Utilities\Site::redirectToWithMsg("index.php?page=mnt.documentos.documentos",
                    "Sucedio un error al procesar la pagina");
                }

                if($this->_viewData["mode"] != "INS" && intval($this->_viewData["doccod"], 10) != 0)
                {
                    $this->_viewData["mode"] !== "DSP";
                }

            }

            private function handlePost()
            {
                \Utilities\ArrUtils::mergeFullArrayTo($_POST, $this->_viewData);

                if(!isset($_SESSION["documento_xssToken"]) || $_SESSION["documento_xssToken"] !== $this->_viewData["xssToken"])
                {
                    unset($_SESSION["documento_xssToken"]);
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt.documentos.documentos",
                    "Ocurrio un error, no se puede procesar el formulario");
                }

                $this->_viewData["doccod"] = intval($this->_viewData["doccod"], 10);

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

                    unset($_SESSION["documento_xssToken"]);
                        
                    switch($this->_viewData["mode"])
                    {

                        CASE "INS":                    
                            $result = \Dao\Mnt\documentos::newdocumento($this->_viewData["docfch"],$this->_viewData["usercod"],$this->_viewData["docobs"],$this->_viewData["docshipping"],$this->_viewData["docest"],$this->_viewData["docmeta"],$this->_viewData["docfchdlv"],$this->_viewData["docestdlv"],$this->_viewData["docFrmPgo"]);

                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg("index.php?page=mnt.documentos.documentos", "Operacion realizada con exito");
                        }
                        break;

                        CASE "UPD":                    
                            $result = \Dao\Mnt\documentos::actualizardocumento($this->_viewData["doccod"],$this->_viewData["docfch"],$this->_viewData["usercod"],$this->_viewData["docobs"],$this->_viewData["docshipping"],$this->_viewData["docest"],$this->_viewData["docmeta"],$this->_viewData["docfchdlv"],$this->_viewData["docestdlv"],$this->_viewData["docFrmPgo"]);

                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg("index.php?page=mnt.documentos.documentos", "Operacion realizada con exito");
                        }
                        break;

                        CASE "DEL":                    
                            $result = \Dao\Mnt\documentos::eliminardocumento($this->_viewData["doccod"]);

                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg("index.php?page=mnt.documentos.documentos", "Operacion realizada con exito");
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

                    $tmpdocumento = \Dao\Mnt\documentos::obtenerdocumentoPorId(intval($this->_viewData["doccod"]));
                    \Utilities\ArrUtils::mergeFullArrayTo($tmpdocumento, $this->_viewData);
            

                    $this->_viewData["modeDsc"] = sprintf($this->_modeStrings[$this->_viewData["mode"]], $this->_viewData["docfch"], $this->_viewData["doccod"]);

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

                $this->_viewData["xssToken"] = md5(time() . "documento");
                $_SESSION["documento_xssToken"] = $this->_viewData["xssToken"];
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
                    Renderer::render("mnt/documento", $this->_viewData);
                }
        }

    ?>