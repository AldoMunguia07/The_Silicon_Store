<?php
                namespace Dao\Mnt;
                use Dao\Table;

            class Anonimas extends Table
            {

            public static function obtenerTodos()
            {
                $sqlsrt = "SELECT * FROM carretilla_anon;";
                return self::obtenerRegistros($sqlsrt, array());
                
            }

                    public static function obtenerAnonimaPorId($anoncartid, $invPrdId)
                    {
                        $sqlsrt = "SELECT * FROM carretilla_anon WHERE anoncartid=:anoncartid and invPrdId=:invPrdId;";
                        return self::obtenerUnRegistro(
                            $sqlsrt, 
                            array("anoncartid" => $anoncartid, "invPrdId" => $invPrdId)
                        );
                        
                    }

              

            public static function newAnonima($invPrdId, $cartCtd,$cartPrc,$cartIat)
            {
                $sqlsrt = "INSERT INTO carretilla_anon (invPrdId, cartCtd, cartPrc, cartIat) values (:invPrdId, :cartCtd,:cartPrc,:cartIat);";

                return self::executeNonQuery(
                    $sqlsrt, 
                    array(
                            "invPrdId" => $invPrdId,
                            
                            "cartCtd" => $cartCtd,

                            "cartPrc" => $cartPrc,

                            "cartIat" => $cartIat,

                    )
                    );
            }

            public static function actualizarAnonima($anoncartid,$invPrdId,$cartCtd)
            {
                $sqlsrt = "UPDATE carretilla_anon SET cartCtd=:cartCtd WHERE anoncartid=:anoncartid and invPrdId=:invPrdId;";
        
                return self::executeNonQuery(
                    $sqlsrt, 
                    array(

                            "anoncartid" => $anoncartid,

                            "invPrdId" => $invPrdId,

                            "cartCtd" => $cartCtd,


                    )
                    );
            }

                    public static function eliminarAnonima($anoncartid, $invPrdId)
                    {
                        $sqlsrt = "DELETE FROM carretilla_anon WHERE anoncartid=:anoncartid and invPrdId=:invPrdId;";

                        return self::executeNonQuery(
                            $sqlsrt, 
                            array(
                            
                                "anoncartid" => $anoncartid,
                                "invPrdId" => $invPrdId

                            )
                            );
                    }

                   
 
                }
            ?>