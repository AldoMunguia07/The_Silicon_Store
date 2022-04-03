<?php
                namespace Dao\Mnt;
                use Dao\Table;

            class inventarios extends Table
            {

            public static function obtenerTodos()
            {
                $sqlsrt = "SELECT a.idInventario, a.invPrdId, b.nombre, c.marca, a.cantidad
                FROM inventario a INNER JOIN celular b
                ON a.invPrdId = b.invPrdId
                INNER JOIN marca c ON c.idMarca = b.idMarca
                ORDER BY a.cantidad DESC;";
                return self::obtenerRegistros($sqlsrt, array());
                
            }

                    public static function obtenerinventarioPorId($idInventario, $invPrdId)
                    {
                        $sqlsrt = "SELECT * FROM inventario WHERE idInventario=:idInventario AND invPrdId=:invPrdId;";
                        return self::obtenerUnRegistro(
                            $sqlsrt, 
                            array("idInventario" => $idInventario, "invPrdId" => $invPrdId)
                        );
                        
                    }

                   /* public static function obtenerinventarioPorId($invPrdId)
                    {
                        $sqlsrt = "SELECT * FROM inventario WHERE invPrdId=:invPrdId;";
                        return self::obtenerUnRegistro(
                            $sqlsrt, 
                            array("invPrdId" => $invPrdId)
                        );
                        *
                    }*/

            public static function newinventario($invPrdId, $cantidad)
            {
                $sqlsrt = "INSERT INTO inventario (invPrdId, cantidad) values (:invPrdId, :cantidad);";

                return self::executeNonQuery(
                    $sqlsrt, 
                    array(
                            "invPrdId" => $invPrdId,
                            "cantidad" => $cantidad

                    )
                    );
            }

            public static function actualizarinventario($idInventario,$invPrdId,$cantidad)
            {
                $sqlsrt = "UPDATE inventario SET cantidad=:cantidad WHERE idInventario=:idInventario AND invPrdId=:invPrdId;";
        
                return self::executeNonQuery(
                    $sqlsrt, 
                    array(

                            "idInventario" => $idInventario,

                            "invPrdId" => $invPrdId,

                            "cantidad" => $cantidad,

                    )
                    );
            }

                    public static function eliminarinventario($idInventario, $invPrdId)
                    {
                        $sqlsrt = "DELETE FROM inventario WHERE idInventario=:idInventario AND invPrdId=:invPrdId;";

                        return self::executeNonQuery(
                            $sqlsrt, 
                            array(
                            
                                "idInventario" => $idInventario,
                                "invPrdId" => $invPrdId

                            )
                            );
                    }

                   /* public static function eliminarinventario($invPrdId)
                    {
                        $sqlsrt = "DELETE FROM inventario WHERE invPrdId=:invPrdId;";

                        return self::executeNonQuery(
                            $sqlsrt, 
                            array(
                            
                                "invPrdId" => $invPrdId

                            )
                            );
                    }*/
 
                }
            ?>