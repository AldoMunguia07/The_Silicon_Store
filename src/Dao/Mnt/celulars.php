<?php
                namespace Dao\Mnt;
                use Dao\Table;

            class celulars extends Table
            {

            public static function obtenerTodos()
            {
                $sqlsrt = "SELECT a.invPrdId, a.nombre, a.descripcion, a.precio, a.estado, b.marca
                FROM celular a INNER JOIN marca b
                ON a.idMarca = b.idMarca;";
                return self::obtenerRegistros($sqlsrt, array());
                
            }

            public static function obtenerTodosCmb()
            {
                $sqlsrt = "SELECT invPrdId, nombre
                FROM celular 
                WHERE invPrdId NOT IN (SELECT invPrdId FROM inventario);";
                return self::obtenerRegistros($sqlsrt, array());
                
            }

                    public static function obtenercelularPorId($invPrdId)
                    {
                        $sqlsrt = "SELECT * FROM celular WHERE invPrdId=:invPrdId;";
                        return self::obtenerUnRegistro(
                            $sqlsrt, 
                            array("invPrdId" => $invPrdId)
                        );
                        
                    }

            public static function newcelular($nombre,$descripcion,$precio,$estado,$idMarca)
            {
                $sqlsrt = "INSERT INTO celular (nombre,descripcion,precio,estado,idMarca) values (:nombre,:descripcion,:precio,:estado,:idMarca);";

                return self::executeNonQuery(
                    $sqlsrt, 
                    array(

                            "nombre" => $nombre,

                            "descripcion" => $descripcion,

                            "precio" => $precio,

                            "estado" => $estado,

                            "idMarca" => $idMarca,

                    )
                    );
            }

            public static function actualizarcelular($invPrdId,$nombre,$descripcion,$precio,$estado,$idMarca)
            {
                $sqlsrt = "UPDATE celular SET nombre=:nombre,descripcion=:descripcion,precio=:precio,estado=:estado,idMarca=:idMarca WHERE invPrdId=:invPrdId;";
        
                return self::executeNonQuery(
                    $sqlsrt, 
                    array(

                            "invPrdId" => $invPrdId,

                            "nombre" => $nombre,

                            "descripcion" => $descripcion,

                            "precio" => $precio,

                            "estado" => $estado,

                            "idMarca" => $idMarca,

                    )
                    );
            }

                    public static function eliminarcelular($invPrdId)
                    {
                        $sqlsrt = "DELETE FROM celular WHERE invPrdId=:invPrdId;";

                        return self::executeNonQuery(
                            $sqlsrt, 
                            array(
                            
                                "invPrdId" => $invPrdId

                            )
                            );
                    }
 
                }
            ?>