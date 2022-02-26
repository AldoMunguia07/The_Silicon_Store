<?php
    namespace Controllers\Mnt\IntentosPagos;

    use Controllers\PublicController;
    use Utilities\Validators;
    use Views\Renderer;

    class Intento extends PublicController
    {
        private $_modeStrings = array(
            "INS" => "Nueva intento",
            "UPD" => "Editar %s (%s)",
            "DSP" => "Detalle de %s (%s)",
            "DEL" => "Eliminando %s (%s)"
        );

        private $_estOptions = array( 
            "ENV" => "Enviado",
            "PGD" => "Pagado",
            "CNL" => "Cancelado",
            "ERR" => "Errado"
        );
        private $_viewData = array(
            "mode" => "INS",
            "id" => 0,
            "fecha" =>"",
            "cliente"=>"",
            "monto"=>"",
            "fechaVencimiento"=>"",
            "estado"=>"ENV",
            "modeDsc"=>"",
            "readonly"=>"",
            "isInsert"=>false,
            "estOptions" => [],
            "csxsToken" => ""
        );

        private function init()
        {
            if(isset($_GET["mode"]))
            {
                $this->_viewData["mode"] = $_GET["mode"];
            }

            if(isset($_GET["id"]))
            {
                $this->_viewData["id"] = $_GET["id"];
            }

           if(!isset($this->_modeStrings[$this->_viewData["mode"]]))
            {
                error_log($this->toString()." ".$this->_viewData["mode"], 0);

                \Utilities\Site::redirectToWithMsg("index.php?page=mnt.intentospagos.intentospagos",
                "Sucedio un error al procesar la pagina");
            }

            if($this->_viewData["mode"] != "INS" && intval($this->_viewData["id"], 10) != 0)
            {
                $this->_viewData["mode"] !== "DSP";
            }
        }

        private function handlePost()
        {
            \Utilities\ArrUtils::mergeFullArrayTo($_POST, $this->_viewData);

            if(!isset($_SESSION["intentos_csxsToken"]) || $_SESSION["intentos_csxsToken"] !== $this->_viewData["csxsToken"])
            {
                unset($_SESSION["intentos_csxsToken"]);
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=mnt.intentospagos.intentospagos",
                    
                "Ocurrio un error, no se puede procesar el formulario");
            }
            $this->_viewData["id"] = intval($this->_viewData["id"], 10);

            if( \Utilities\Validators::IsMatch($this->_viewData["estado"], "/^(ENV)|(PGD)|(CNL)|(ERR)$/"))
            {

            }
            else
            {
                $this->_viewData["errors"][] ="El estado debe ser ENV|PGD|CNL|ERR";
            }

            if(isset($this->_viewData["errors"]) && count($this->_viewData["errors"]) > 0)
            {

            }
            else
            {
                unset($_SESSION["intentos_csxsToken"]);
                
                switch($this->_viewData["mode"])
                {
                    CASE 'INS':
                    
                        $result = \Dao\Mnt\IntentosPagos::nuevoIntento($this->_viewData["cliente"], $this->_viewData["monto"], $this->_viewData["fechaVencimiento"], 
                        $this->_viewData["estado"]);

                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg('index.php?page=mnt.intentospagos.intentospagos', "Operacion realizada con exito");
                        }
                        break;
                     CASE 'UPD':
                        $result = \Dao\Mnt\IntentosPagos::actualizarIntento($this->_viewData["id"], $this->_viewData["cliente"], $this->_viewData["monto"], 
                        $this->_viewData["fechaVencimiento"], $this->_viewData["estado"]);

                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg('index.php?page=mnt.intentospagos.intentospagos', "Operacion realizada con exito");
                        }
                        break;
                    CASE 'DEL':
                         $result = \Dao\Mnt\IntentosPagos::eliminarIntento($this->_viewData["id"]);
                       
                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg('index.php?page=mnt.intentospagos.intentospagos', "Operacion realizada con exito");
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
               $tmpIntentos = \Dao\Mnt\IntentosPagos::obtenerPorId(intval($this->_viewData["id"]));
               \Utilities\ArrUtils::mergeFullArrayTo($tmpIntentos, $this->_viewData);
              
                $this->_viewData["modeDsc"] = sprintf($this->_modeStrings[$this->_viewData["mode"]], $this->_viewData["cliente"], $this->_viewData["id"]);

                /*$this->_viewData["modeDsc"] = sprintf(
                    $this->_modeStrings[$this->_viewData["mode"]],
                    $this->_viewData["catnom"],
                    $this->_viewData["id"]
                );*/

                if($this->_viewData["mode"] == "DSP" || $this->_viewData["mode"] == "DEL")
                {   
                    $this->_viewData["readonly"] = "readonly";
                }
                
            }

            $this->_viewData["estOptions"] = \Utilities\ArrUtils::toOptionsArray(
                $this->_estOptions,
                "value",
                "text",
                "selected",                
                $this->_viewData["estado"]
            );

            $this->_viewData["csxsToken"] = md5(time() . "intento");
            $_SESSION["intentos_csxsToken"] = $this->_viewData["csxsToken"];
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
            Renderer::render('mnt/Intento', $this->_viewData);
        }

    }

?>