<?php
                namespace Dao\Mnt;
                use Dao\Table;

            class Anonimas extends Table
            {

            public static function obtenerTodos($anoncartid)
            {
                $sqlsrt = "SELECT b.invPrdId codigo, b.nombre, b.descripcion, c.marca, ROUND((a.cartPrc + (a.cartPrc * 0.15)), 2) precio, a.cartCtd cantidad,
                ROUND(((a.cartPrc + (a.cartPrc * 0.15)) * a.cartCtd), 2) total
                FROM carretilla_anon a JOIN celular b
                ON a.invPrdId = b.invPrdId
                JOIN marca c ON b.idMarca = c.idMarca
                 WHERE anoncartid=:anoncartid;";
                return self::obtenerRegistros($sqlsrt,  array("anoncartid" => $anoncartid));
                
            }

            public static function obtenerTodosI($anoncartid)
            {
                $sqlsrt = "SELECT * FROM carretilla_anon WHERE anoncartid=:anoncartid;";
                return self::obtenerRegistros($sqlsrt,  array("anoncartid" => $anoncartid));
                
            }

            public static function obtenerAnonimaPorId($anoncartid, $invPrdId)
            {
                $sqlsrt = "SELECT * FROM carretilla_anon WHERE anoncartid=:anoncartid AND invPrdId=:invPrdId;";
                return self::obtenerUnRegistro(
                    $sqlsrt, 
                    array("anoncartid" => $anoncartid, 
                    "invPrdId" => $invPrdId)
                );
                
            }

              

            public static function newAnonima($anoncartid, $invPrdId, $cartCtd,$cartPrc,$cartIat)
            {
                $sqlsrt = "INSERT INTO carretilla_anon (anoncartid, invPrdId, cartCtd, cartPrc, cartIat) values (:anoncartid, :invPrdId, :cartCtd,:cartPrc,:cartIat);";

                return self::executeNonQuery(
                    $sqlsrt, 
                    array(
                        "anoncartid" => $anoncartid,

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