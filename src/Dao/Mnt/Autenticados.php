<?php
                namespace Dao\Mnt;
                use Dao\Table;

            class Autenticados extends Table
            {

            public static function obtenerTodos($usercod)
            {
                $sqlsrt = "SELECT b.invPrdId codigo, b.nombre, b.descripcion, c.marca, a.cartPrc precio, a.cartCtd cantidad, 
                (a.cartCtd * a.cartPrc) total
                FROM carretilla_auth a JOIN celular b
                ON a.invPrdId = b.invPrdId
                JOIN marca c ON b.idMarca = c.idMarca
                 WHERE usercod=:usercod;";
                return self::obtenerRegistros($sqlsrt, array("usercod" => $usercod));
                
            }

                    public static function obtenerAutenticadoPorId($usercod)
                    {
                        $sqlsrt = "SELECT * FROM carretilla_auth WHERE usercod=:usercod;";
                        return self::obtenerUnRegistro(
                            $sqlsrt, 
                            array("usercod" => $usercod)
                        );
                        
                    }

                    /*public static function obtenerAutenticadoPorId($invPrdId)
                    {
                        $sqlsrt = "SELECT * FROM carretilla_auth WHERE invPrdId=:invPrdId;";
                        return self::obtenerUnRegistro(
                            $sqlsrt, 
                            array("invPrdId" => $invPrdId)
                        );
                        
                    }*/

            public static function newAutenticado($usercod, $invPrdId, $cartCtd,$cartPrc,$cartIat)
            {
                $sqlsrt = "INSERT INTO carretilla_auth (usercod, invPrdId, cartCtd,cartPrc,cartIat) values (:usercod, :invPrdId, :cartCtd,:cartPrc,:cartIat)
                ON DUPLICATE KEY UPDATE cartCtd = cartCtd + values(cartCtd),
                cartPrc = values(cartPrc);";

                return self::executeNonQuery(
                    $sqlsrt, 
                    array(
                            "usercod" => $usercod,

                            "invPrdId" => $invPrdId,

                            "cartCtd" => $cartCtd,

                            "cartPrc" => $cartPrc,

                            "cartIat" => $cartIat,

                    )
                    );
            }

            public static function actualizarAutenticado($usercod,$invPrdId,$cartCtd,$cartPrc,$cartIat)
            {
                $sqlsrt = "UPDATE carretilla_auth SET cartCtd=:cartCtd,cartPrc=:cartPrc,cartIat=:cartIat WHERE usercod=:usercod,invPrdId=:invPrdId;";
        
                return self::executeNonQuery(
                    $sqlsrt, 
                    array(

                            "usercod" => $usercod,

                            "invPrdId" => $invPrdId,

                            "cartCtd" => $cartCtd,

                            "cartPrc" => $cartPrc,

                            "cartIat" => $cartIat,

                    )
                    );
            }

                    public static function eliminarAutenticado($usercod, $invPrdId)
                    {
                        $sqlsrt = "DELETE FROM carretilla_auth WHERE usercod=:usercod AND invPrdId=:invPrdId;";

                        return self::executeNonQuery(
                            $sqlsrt, 
                            array(
                            
                                "usercod" => $usercod,
                                "invPrdId" => $invPrdId

                            )
                            );
                    }

                    /*public static function eliminarAutenticado($invPrdId)
                    {
                        $sqlsrt = "DELETE FROM carretilla_auth WHERE invPrdId=:invPrdId;";

                        return self::executeNonQuery(
                            $sqlsrt, 
                            array(
                            
                                "invPrdId" => $invPrdId

                            )
                            );
                    }*/
 
                }
            ?>