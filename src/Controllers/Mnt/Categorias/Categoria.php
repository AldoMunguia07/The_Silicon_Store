<?php
    namespace Controllers\Mnt\Categorias;

use Controllers\PublicController;
use Utilities\Validators;
use Views\Renderer;

    class Categoria extends PublicController
    {
        private $_modeStrings = array(
            "INS" => "Nueva categoria",
            "UPD" => "Editar %s (%s)",
            "DSP" => "Detalle de %s (%s)",
            "DEL" => "Eliminando %s (%s)"
        );

        private $_catestOptions = array(
            "ACT" => "Activo",
            "INA" => "Inactivo"
        );
        private $_viewData = array(
            "mode" => "INS",
            "catid" => 0,
            "catnom" =>"",
            "catest"=>"ACT",
            "modeDsc"=>"",
            "readonly"=>"",
            "isInsert"=>false,
            "catestOptions" => [],
            "csxsToken" => ""
        );

        private function init()
        {
            if(isset($_GET["mode"]))
            {
                $this->_viewData["mode"] = $_GET["mode"];
            }

            if(isset($_GET["catid"]))
            {
                $this->_viewData["catid"] = $_GET["catid"];
            }

           if(!isset($this->_modeStrings[$this->_viewData["mode"]]))
            {
                error_log($this->toString()." ".$this->_viewData["mode"], 0);

                \Utilities\Site::redirectToWithMsg("index.php?page=mnt.categorias.categorias",
                "Sucedio un error al procesar la pagina");
            }

            if($this->_viewData["mode"] != "INS" && intval($this->_viewData["catid"], 10) != 0)
            {
                $this->_viewData["mode"] !== "DSP";
            }
        }

        private function handlePost()
        {
            \Utilities\ArrUtils::mergeFullArrayTo($_POST, $this->_viewData);

            if(!isset($_SESSION["categoria_csxsToken"]) || $_SESSION["categoria_csxsToken"] !== $this->_viewData["csxsToken"])
            {
                unset($_SESSION["categoria_csxsToken"]);
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=categorias.categorias",
                "Ocurrio un error, no se puede procesar el formulario");
            }
            $this->_viewData["catid"] = intval($this->_viewData["catid"], 10);

            if( \Utilities\Validators::IsMatch($this->_viewData["catest"], "/^(ACT)|(INA)$/"))
            {

            }
            else
            {
                $this->_viewData["errors"][] ="Categoria debe ser AC o INA";
            }

            if(isset($this->_viewData["errors"]) && count($this->_viewData["errors"]) > 0)
            {

            }
            else
            {
                unset($_SESSION["categoria_csxsToken"]);
                
                switch($this->_viewData["mode"])
                {
                    CASE 'INS':
                    
                        $result = \Dao\Mnt\Categorias::nuevaCategoria($this->_viewData["catnom"], $this->_viewData["catest"]);

                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg('index.php?page=mnt.categorias.categorias', "Operacion realizada con exito");
                        }
                        break;
                     CASE 'UPD':
                        $result = \Dao\Mnt\Categorias::actualizarCategoria($this->_viewData["catid"],$this->_viewData["catnom"], $this->_viewData["catest"]);

                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg('index.php?page=mnt.categorias.categorias', "Operacion realizada con exito");
                        }
                        break;
                    CASE 'DEL':
                         $result = \Dao\Mnt\Categorias::eliminarCategoria($this->_viewData["catid"]);
                       
                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg('index.php?page=mnt.categorias.categorias', "Operacion realizada con exito");
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
               $tmpCategoria = \Dao\Mnt\Categorias::obtenerPorCatId(intval($this->_viewData["catid"]));
               \Utilities\ArrUtils::mergeFullArrayTo($tmpCategoria, $this->_viewData);
              
                $this->_viewData["modeDsc"] = sprintf($this->_modeStrings[$this->_viewData["mode"]], $this->_viewData["catnom"], $this->_viewData["catid"]);

                /*$this->_viewData["modeDsc"] = sprintf(
                    $this->_modeStrings[$this->_viewData["mode"]],
                    $this->_viewData["catnom"],
                    $this->_viewData["catid"]
                );*/

                if($this->_viewData["mode"] == "DSP" || $this->_viewData["mode"] == "DEL")
                {   
                    $this->_viewData["readonly"] = "readonly";
                }
                
            }

            $this->_viewData["catestOptions"] = \Utilities\ArrUtils::toOptionsArray(
                $this->_catestOptions,
                "value",
                "text",
                "selected",                
                $this->_viewData["catest"]
            );

            $this->_viewData["csxsToken"] = md5(time() . "categoria");
            $_SESSION["categoria_csxsToken"] = $this->_viewData["csxsToken"];
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
            Renderer::render('mnt/Categoria', $this->_viewData);
        }
    }

?>