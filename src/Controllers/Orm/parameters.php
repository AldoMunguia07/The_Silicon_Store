<?php
    namespace Controllers\Orm;

use Controllers\PublicController;
use Views\Renderer;

    class Parameters extends PublicController
    {
        private $viewData = array();
        public function run():void
        {
            if($this->isPostBack())
            {
                \Utilities\ArrUtils::mergeFullArrayTo($_POST, $this->viewData);
                $this->viewData["tableData"] = \Dao\Orm\TableDescribe::obtenerEstructuraDeTabla($this->viewData["table"]);
                $this->DaoCode();
                $this->listarDatos();
                $this->formCode();
                $this->VistaListar();
                $this->vistaFormulario();
                $this->asignarURL();
                
               
            }
            
            Renderer::render("orm/parameters", $this->viewData);
        }
        private function listarDatos()
        {
            $buffer = array();
            $buffer[] = '<?php';
            $buffer[] = sprintf('
                namespace Controllers\Mnt\%ss;', $this->viewData["namespace"]);
            $buffer[] = '
                use Controllers\PublicController;';
            $buffer[] = '
                use Views\Renderer;';
            $buffer[] = sprintf('
                class %ss extends PublicController {', $this->viewData["namespace"]);
            $buffer[] = '
                    public function run(): void {';
            $buffer[] = '
                    $viewData = array();';
            $buffer[] = sprintf('
                    $viewData["%s"] = \Dao\Mnt\%ss::obtenerTodos();', $this->viewData["table"], $this->viewData["namespace"]);
            $buffer[] = sprintf('
                    Renderer::render("mnt\%ss", $viewData);', $this->viewData["namespace"]);

            /*foreach($this->viewData["tableData"] as $field)
            {
                $buffer[] = sprintf('private $_%s;', $field["Field"]);
            }*/
            
            $buffer[] = '   
                    }';
            $buffer[] = '
                }';
            $buffer[] = '
            ?>';
           
           $txt = implode("\n", $buffer);
           $this->viewData["listController"] = htmlspecialchars(implode("\n", $buffer));
          
           $rutaDirectorio = sprintf('./src/Controllers/Mnt/%ss', $this->viewData["namespace"]);

           if (!is_dir($rutaDirectorio)) {
            mkdir($rutaDirectorio, 0700);
            }
           
           $rutaArchivo = sprintf('./src/Controllers/Mnt/%ss/%ss.php', $this->viewData["namespace"], $this->viewData["namespace"]);
           $archivo = fopen($rutaArchivo, "w+b"); 
           
           
           
            if( $archivo == false )
            echo "Error al crear el archivo";
            else
            echo "El archivo ha sido creado";
            
            fwrite($archivo, $txt);
            fclose($archivo); 
        }


        private function DaoCode()
        {
            $buffer = array();
            $buffer[] = '<?php
                namespace Dao\Mnt;
                use Dao\Table;';

            $buffer[] = sprintf('
            class %ss extends Table
            {', $this->viewData["namespace"]);

            $buffer[] = sprintf('
            public static function obtenerTodos()
            {
                $sqlsrt = "SELECT * FROM %s;";
                return self::obtenerRegistros($sqlsrt, array());
                
            }', $this->viewData["table"]);

            foreach($this->viewData["tableData"] as $field)
            {
                if($field["Key"] == "PRI")
                {
                    $buffer[] = sprintf('
                    public static function obtener%sPorId($%s)
                    {
                        $sqlsrt = "SELECT * FROM %s WHERE %s=:%s;";
                        return self::obtenerUnRegistro(
                            $sqlsrt, 
                            array("%s" => $%s)
                        );
                        
                    }', $this->viewData["namespace"], $field["Field"], $this->viewData["table"], $field["Field"], $field["Field"],
                    $field["Field"], $field["Field"]);
                }
            }

            $paramSinID = array();
            $paramConID = array();
            foreach($this->viewData["tableData"] as $field)
            {
                if($field["Key"] != "PRI")
                {
                    $paramSinID[] = $field["Field"];
                   
                }
                else
                {
                    $whereValue[] = sprintf('%s=:%s', $field["Field"], $field["Field"]);
                }

                $paramConID[] = $field["Field"];
            }

            foreach($paramSinID as $campo)
            {
                $varSinId[] = sprintf('$%s',$campo);
                $fieldSinId[] = sprintf('%s',$campo);

                $valuesInsert[] = sprintf(':%s', $campo);
                $setValues[] = sprintf('%s=:%s', $campo, $campo);
            }

            foreach($paramConID as $campo)
            {
                $varConId[] = sprintf('$%s',$campo);
                $fieldConId[] = sprintf('%s',$campo);
            }
            
            $variablesSinId = implode(",", $varSinId);
            $variablesConId = implode(",", $varConId);
            $camposSinId = implode(",", $fieldSinId);
            $camposConId = implode(",", $fieldConId);

            $valuesInsert = implode(",", $valuesInsert);
            $setValues = implode(",", $setValues);
            $whereValue = implode(",", $whereValue);

            /*$buffer[] = $camposSinId ;
            $buffer[] = $camposConId ;
            $buffer[] = $variablesSinId ;
            $buffer[] = $variablesConId ;
            $buffer[] = $valuesInsert;
            $buffer[] = $setValues;
            $buffer[] = $whereValue;*/

            $buffer[] = sprintf('
            public static function new%s(%s)
            {
                $sqlsrt = "INSERT INTO %s (%s) values (%s);";

                return self::executeNonQuery(
                    $sqlsrt, 
                    array(', $this->viewData["namespace"],  $variablesSinId, $this->viewData["table"],
                     $camposSinId, $valuesInsert);

                    foreach($paramSinID as $campo)
                    {
                        $buffer[] =sprintf('
                            "%s" => $%s,', $campo, $campo);
                    }

                    $buffer[] = '
                    )
                    );
            }';

            $buffer[] = sprintf('
            public static function actualizar%s(%s)
            {
                $sqlsrt = "UPDATE %s SET %s WHERE %s;";
        
                return self::executeNonQuery(
                    $sqlsrt, 
                    array(', $this->viewData["namespace"], $variablesConId, $this->viewData["table"]
                    , $setValues, $whereValue);
                    foreach($paramConID as $campo)
                    {
                        $buffer[] =sprintf('
                            "%s" => $%s,', $campo, $campo);
                    }
                    $buffer[] = '
                    )
                    );
            }';

            foreach($this->viewData["tableData"] as $field)
            {
                if($field["Key"] == "PRI")
                {
                    $buffer[] = sprintf('
                    public static function eliminar%s($%s)
                    {
                        $sqlsrt = "DELETE FROM %s WHERE %s=:%s;";

                        return self::executeNonQuery(
                            $sqlsrt, 
                            array(
                            
                                "%s" => $%s

                            )
                            );
                    }', $this->viewData["namespace"], $field["Field"], $this->viewData["table"], $field["Field"], 
                    $field["Field"],$field["Field"], $field["Field"]);
                }
            }

            $buffer[] = ' 
                }
            ?>';
            $txt = implode("\n", $buffer);
            $this->viewData["daoCode"] = htmlspecialchars(implode("\n", $buffer));

           
            
           
           
           $rutaArchivo = sprintf('./src/Dao/Mnt/%ss.php', $this->viewData["namespace"]);
           $archivo = fopen($rutaArchivo, "w+b"); 
           
           
           
            if( $archivo == false )
            echo "Error al crear el archivo";
            else
            echo "El archivo ha sido creado";
            
            fwrite($archivo, $txt);
            fclose($archivo); 
        }

        private function formCode()
        {
            $buffer = array();
            $pk = "";
            foreach($this->viewData["tableData"] as $field)
            {
                if($field["Key"] == "PRI")
                {
                    $pk = $field["Field"];
                }
               
            }

            $buffer[] = sprintf('<?php
                namespace Controllers\Mnt\%ss;

                use Controllers\PublicController;
                use Utilities\Validators;
                use Views\Renderer;

                class %s extends PublicController
                {
            ', $this->viewData["namespace"], $this->viewData["namespace"]);

            $buffer[] = sprintf('
                    private $_modeStrings = array(
                        "INS" => "Nuevo %s",
                        "UPD" => "Editar %s (%s)",
                        "DSP" => "Detalle de %s (%s)",
                        "DEL" => "Eliminando %s (%s)"
                    );', $this->viewData["namespace"],'%s','%s','%s','%s','%s','%s', '%s');


            $buffer[] = '
                    private $_cmbOptions = array(
                        "OPC1" => "Opcion 1",
                        "OPC2" => "Opcion 2",
                        "OPC3" => "Opcion 3"
                    );';

            $buffer[] = '
                    private $_viewData = array(
                    "mode" => "INS",
            ';

            foreach($this->viewData["tableData"] as $field)
            {
                if($field["Key"] == "PRI")
                {
                    $buffer[] = sprintf('"%s" => 0,', $field["Field"]);
                }
                else
                {
                    $buffer[] = sprintf('"%s" => "",', $field["Field"]);
                }
            }

            $buffer[] = '
                        "modeDsc"=>"",
                        "readonly"=>"",
                        "isInsert"=>false,
                        "cmbOptions" => [],
                        "option" => "",
                        "xssToken" => ""
                    );';

            $buffer[] = '
            private function init()
            {';

            $buffer[] = '
                if(isset($_GET["mode"]))
                {
                    $this->_viewData["mode"] = $_GET["mode"];
                }';

            
            $buffer[] = sprintf('
                if(isset($_GET["%s"]))
                {
                    $this->_viewData["%s"] = $_GET["%s"];
                }', $pk, $pk, $pk);
               

            $buffer[] = sprintf('
                if(!isset($this->_modeStrings[$this->_viewData["mode"]]))
                {
                    error_log($this->toString()." ".$this->_viewData["mode"], 0);

                    \Utilities\Site::redirectToWithMsg("index.php?page=mnt.%ss.%ss",
                    "Sucedio un error al procesar la pagina");
                }', $this->viewData["namespace"], $this->viewData["namespace"]);

            $buffer[] = sprintf('
                if($this->_viewData["mode"] != "INS" && intval($this->_viewData["%s"], 10) != 0)
                {
                    $this->_viewData["mode"] !== "DSP";
                }',$pk );

            $buffer[] = '
            }';

            $buffer[] = '
            private function handlePost()
            {
                \Utilities\ArrUtils::mergeFullArrayTo($_POST, $this->_viewData);';
            
            $buffer[] = sprintf('
                if(!isset($_SESSION["%s_xssToken"]) || $_SESSION["%s_xssToken"] !== $this->_viewData["xssToken"])
                {
                    unset($_SESSION["%s_xssToken"]);
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt.%ss.%ss",
                    "Ocurrio un error, no se puede procesar el formulario");
                }', $this->viewData["namespace"], $this->viewData["namespace"], $this->viewData["namespace"],
                $this->viewData["namespace"], $this->viewData["namespace"]);

            $buffer[] = sprintf('
                $this->_viewData["%s"] = intval($this->_viewData["%s"], 10);', $pk, $pk);

            $buffer[] = '
                if(true)/* aplicar validaciones */
                {

                }
                else
                {
                    $this->_viewData["errors"][] ="Mensaje de error";
                }';
            $buffer[] = '
                if(isset($this->_viewData["errors"]) && count($this->_viewData["errors"]) > 0)
                {

                }
                else
                {';
                    
            $buffer[] = sprintf('
                    unset($_SESSION["%s_xssToken"]);
                        
                    switch($this->_viewData["mode"])
                    {', $this->viewData["namespace"]);

            $paramSinID = array();
            $paramConID = array();
            foreach($this->viewData["tableData"] as $field)
            {
                if($field["Key"] != "PRI")
                {
                    $paramSinID[] = sprintf('$this->_viewData["%s"]',$field["Field"]);
                
                }
                

                $paramConID[] = sprintf('$this->_viewData["%s"]',$field["Field"]);
            }

            $variablesSinId = implode(",", $paramSinID);
            $variablesConId = implode(",", $paramConID);
            //$buffer[] = $variablesSinId ;
            //$buffer[] = $variablesConId ;
            
            $buffer[] = sprintf('
                        CASE "INS":                    
                            $result = \Dao\Mnt\%ss::new%s(%s);',
             $this->viewData["namespace"], $this->viewData["namespace"], $variablesSinId);

            $buffer[] = sprintf('
                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg("index.php?page=mnt.%ss.%ss", "Operacion realizada con exito");
                        }
                        break;', $this->viewData["namespace"], $this->viewData["namespace"]);

            $buffer[] = sprintf('
                        CASE "UPD":                    
                            $result = \Dao\Mnt\%ss::actualizar%s(%s);',
            $this->viewData["namespace"], $this->viewData["namespace"], $variablesConId);

            $buffer[] = sprintf('
                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg("index.php?page=mnt.%ss.%ss", "Operacion realizada con exito");
                        }
                        break;', $this->viewData["namespace"], $this->viewData["namespace"]);
            $buffer[] = sprintf('
                        CASE "DEL":                    
                            $result = \Dao\Mnt\%ss::eliminar%s($this->_viewData["%s"]);',
            $this->viewData["namespace"], $this->viewData["namespace"], $pk);

            $buffer[] = sprintf('
                        if($result)
                        {
                            \Utilities\Site::redirectToWithMsg("index.php?page=mnt.%ss.%ss", "Operacion realizada con exito");
                        }
                        break;', $this->viewData["namespace"], $this->viewData["namespace"]);

            $buffer[] ='
                    }
                }
            
            }';

            $buffer[] = '
            private function prepareViewData()
            {
                if($this->_viewData["mode"] == "INS")
                {
                    $this->_viewData["isInsert"] = true;
                    $this->_viewData["modeDsc"] = $this->_modeStrings[$this->_viewData["mode"]];
                }
                else
                {';

            $buffer[] = sprintf('
                    $tmp%s = \Dao\Mnt\%ss::obtener%sPorId(intval($this->_viewData["%s"]));
                    \Utilities\ArrUtils::mergeFullArrayTo($tmp%s, $this->_viewData);
            ',$this->viewData["namespace"], $this->viewData["namespace"],
             $this->viewData["namespace"], $pk,$this->viewData["namespace"] );

             $i = 0;
            foreach($this->viewData["tableData"] as $field)
            {
                if($i == 1)
                {
                    $buffer[] = sprintf('
                    $this->_viewData["modeDsc"] = sprintf($this->_modeStrings[$this->_viewData["mode"]], $this->_viewData["%s"], $this->_viewData["%s"]);',
                    $field["Field"], $pk);
                }
                
                
                $i++;
            }

            $buffer[] = '
                    if($this->_viewData["mode"] == "DSP" || $this->_viewData["mode"] == "DEL")
                    {   
                        $this->_viewData["readonly"] = "readonly";
                    }
                        
                }';
            
            $buffer[] = '
                $this->_viewData["cmbOptions"] = \Utilities\ArrUtils::toOptionsArray(
                    $this->_cmbOptions,
                    "value",
                    "text",
                    "selected",                
                    $this->_viewData["option"]
                );';
            
            $buffer[] = sprintf('
                $this->_viewData["xssToken"] = md5(time() . "%s");
                $_SESSION["%s_xssToken"] = $this->_viewData["xssToken"];
            }', $this->viewData["namespace"], $this->viewData["namespace"]);

            $buffer[] = sprintf('
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
                    Renderer::render("mnt/%s", $this->_viewData);
                }
        }

    ?>', $this->viewData["namespace"]);

        $txt = implode("\n", $buffer);
        $this->viewData["formCode"] = htmlspecialchars(implode("\n", $buffer));

        
          
        $rutaDirectorio = sprintf('./src/Controllers/Mnt/%ss', $this->viewData["namespace"]);

        if (!is_dir($rutaDirectorio)) {
        mkdir($rutaDirectorio, 0700);
        }
        
        $rutaArchivo = sprintf('./src/Controllers/Mnt/%ss/%s.php', $this->viewData["namespace"], $this->viewData["namespace"]);
        $archivo = fopen($rutaArchivo, "w+b"); 
        
        
        
        if( $archivo == false )
        echo "Error al crear el archivo";
        else
        echo "El archivo ha sido creado";
        
        fwrite($archivo, $txt);
        fclose($archivo); 



    }
            
        
        private function VistaListar()
        {
            $buffer = array();
            $buffer[] = sprintf('
            <h1>Lista de %ss</h1>
            <hr>', $this->viewData["namespace"]);
            $buffer[] = '
            <table>
                <thead>
                    <tr>';
            foreach($this->viewData["tableData"] as $field)
            {
                $buffer[] = sprintf('<th>%s</th>', $field["Field"]);
            }
            foreach($this->viewData["tableData"] as $field)
            {
                if($field["Key"] == "PRI")
                {
                    $buffer[] = sprintf('<th><a href="index.php?page=mnt.%ss.%s&mode=INS&%s=0">+</a></th>', 
                    $this->viewData["namespace"], $this->viewData["namespace"], $field["Field"]);
                }
            }

            $buffer[] = '
                    </tr>
            </thead>';

            $buffer[] = sprintf('
            <tbody>
                {{foreach %s}}
                <tr>', $this->viewData["table"]);
            $i = 0;
            foreach($this->viewData["tableData"] as $field)
            {
                if($i == 1)
                {
                    foreach($this->viewData["tableData"] as $campo)
                    {
                        if($campo["Key"] == "PRI")
                        {
                            $pk = $campo["Field"];
                            
                        }
                    }
                    $buffer[] = sprintf('<td><a href="index.php?page=mnt.%ss.%s&mode=DSP&%s={{%s}}">{{%s}}</a></td>', 
                     $this->viewData["namespace"], $this->viewData["namespace"],  $pk, $pk, $field["Field"]);
                    
                }
                else
                {
                    $buffer[] = sprintf('<td>{{%s}}</td>', $field["Field"]);
                }
                
                $i++;
            }

            foreach($this->viewData["tableData"] as $field)
            {
                if($field["Key"] == "PRI")
                {
                    $buffer[] = sprintf('<td><a href="index.php?page=mnt.%ss.%s&mode=UPD&%s={{%s}}"/a>Editar</td>'
                    , $this->viewData["namespace"], $this->viewData["namespace"], $field["Field"], $field["Field"]);

                    $buffer[] = sprintf('&nbsp;<td><a href="index.php?page=mnt.%ss.%s&mode=DEL&%s={{%s}}"/a>Eliminar</td>'
                    , $this->viewData["namespace"], $this->viewData["namespace"], $field["Field"], $field["Field"]);
                }
            }

            $buffer[] = sprintf('
                    </tr>
                {{endfor %s}}
            </tbody>
            
        </table>', $this->viewData["table"]);
            
            $txt = implode("\n", $buffer);
            $this->viewData["vistaListar"] = htmlspecialchars(implode("\n", $buffer));

            
            

         
           $rutaArchivo = sprintf('./src/Views/templates/mnt/%ss.view.tpl', $this->viewData["namespace"]);
           $archivo = fopen($rutaArchivo, "w+b"); 

           
            if( $archivo == false )
            echo "Error al crear el archivo";
            else
            echo "El archivo ha sido creado";
            
            fwrite($archivo, $txt);
            fclose($archivo); 
        }

        private function vistaFormulario()
        {
            $buffer = array();
            $buffer[] = '
            <h1>{{modeDsc}}</h1>
            <hr>
            <section class="container-m">';
            foreach($this->viewData["tableData"] as $field)
            {
                if($field["Key"] == "PRI")
                {
                    $buffer[] = sprintf('
                    <form action="index.php?page=mnt-%ss-%s&mode={{mode}}&%s={{%s}}" method="post">',
                     $this->viewData["namespace"], $this->viewData["namespace"], $field["Field"], $field["Field"]);
                }
            }

            $buffer[] = '
            <input type="hidden" name="xssToken" value="{{xssToken}}">';

            foreach($this->viewData["tableData"] as $field)
            {
                if($field["Key"] == "PRI")
                {
                    $buffer[] = sprintf('
                    {{ifnot isInsert}}
                    <fieldset class="row flex-center align-center">
                        <label for="%s" class="col-5">%s</label>
                        <input class="col-7"  id="%s" name="%s" type="text" value="{{%s}}" readonly placeholder="" >
                    </fieldset>
                    {{endifnot isInsert}}', $field["Field"], $field["Field"],$field["Field"], $field["Field"], $field["Field"]);
                }
            }

            foreach($this->viewData["tableData"] as $field)
            {
                if($field["Key"] != "PRI")
                {
                    $buffer[] = sprintf('
                    <fieldset class="row flex-center align-center">
                        <label class="col-5" for="%s">%s</label>
                        <input class="col-7" id="%s" name="%s"   type="text" value="{{%s}}" {{readonly}} placeholder="">
                    </fieldset>', $field["Field"], $field["Field"],$field["Field"], $field["Field"], $field["Field"]);
                }
            }

            $buffer[] = '
            <fieldset class="row flex-center align-center">
                <label class="col-5" for="option">Ejemplo de comboBox(Aplicar si se requiere)</label>
                <select class="col-7"  name="option" id="option">
                    {{foreach cmbOptions}}
                    <option value="{{value}}" {{selected}}>{{text}}</option>
                    {{endfor cmbOptions}}
                </select>
            </fieldset>
            ';

            $buffer[] = '
            <fieldset class="row flex-end align-center">
                <button type="submit" name="btnConfirmar" class="btn primary">Confirmar</button>
                &nbsp;<button type="button" id="btnCancelar" class="btn secondary">Cancelar</button>
                &nbsp;
            </fieldset>
            </form>
        </section>
            ';

            $buffer[] = sprintf('
            <script>
                document.addEventListener("DOMContentLoaded", (e)=>{
                document.getElementById("btnCancelar").addEventListener("click", (e)=>{
                    e.preventDefault();
                    e.stopPropagation();
                    location.assign("index.php?page=mnt.%ss.%ss")
                })
                });
            </script>', $this->viewData["namespace"], $this->viewData["namespace"]);

            $txt = implode("\n", $buffer);
            $this->viewData["vistaFormulario"] = htmlspecialchars(implode("\n", $buffer));

            
        
           $rutaArchivo = sprintf('./src/Views/templates/mnt/%s.view.tpl', $this->viewData["namespace"]);
           $archivo = fopen($rutaArchivo, "w+b"); 

           
            if( $archivo == false )
            echo "Error al crear el archivo";
            else
            echo "El archivo ha sido creado";
            
            fwrite($archivo, $txt);
            fclose($archivo); 


        }
        

        private function asignarURL()
        {
            $buffer = array();
           
            $buffer[] = sprintf('index.php?page=mnt.%ss.%ss', $this->viewData["namespace"], $this->viewData["namespace"]);
            
            $this->viewData["url"] = htmlspecialchars(implode("\n", $buffer));

        }
    }

    

?>