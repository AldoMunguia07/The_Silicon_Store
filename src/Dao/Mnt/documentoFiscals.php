<?php
                namespace Dao\Mnt;
                use Dao\Table;

            class documentoFiscals extends Table
            {

            public static function obtenerTodos()
            {
                $sqlsrt = "SELECT * FROM documento_fiscal_lineas;";
                return self::obtenerRegistros($sqlsrt, array());
                
            }

                    /*public static function obtenerdocumentoFiscalPorId($doccod)
                    {
                        $sqlsrt = "SELECT * FROM documento_fiscal_lineas WHERE doccod=:doccod;";
                        return self::obtenerUnRegistro(
                            $sqlsrt, 
                            array("doccod" => $doccod)
                        );
                        
                    }

                    public static function obtenerdocumentoFiscalPorId($invPrdId)
                    {
                        $sqlsrt = "SELECT * FROM documento_fiscal_lineas WHERE invPrdId=:invPrdId;";
                        return self::obtenerUnRegistro(
                            $sqlsrt, 
                            array("invPrdId" => $invPrdId)
                        );
                        
                    }*/

            public static function newdocumentoFiscal($doccod, $invPrdId, $docCtd,$docPrc,$docIva,$docLObs,$docDsc)
            {
                $sqlsrt = "INSERT INTO documento_fiscal_lineas (doccod, invPrdId, docCtd,docPrc,docIva,docLObs,docDsc) values (:doccod, :invPrdId, :docCtd,:docPrc,:docIva,:docLObs,:docDsc);";

                return self::executeNonQuery(
                    $sqlsrt, 
                    array(

                            "doccod" => $doccod,

                            "invPrdId" => $invPrdId,

                            "docCtd" => $docCtd,

                            "docPrc" => $docPrc,

                            "docIva" => $docIva,

                            "docLObs" => $docLObs,

                            "docDsc" => $docDsc,

                    )
                    );
            }

            public static function actualizardocumentoFiscal($doccod,$invPrdId,$docCtd,$docPrc,$docIva,$docLObs,$docDsc)
            {
                $sqlsrt = "UPDATE documento_fiscal_lineas SET docCtd=:docCtd,docPrc=:docPrc,docIva=:docIva,docLObs=:docLObs,docDsc=:docDsc WHERE doccod=:doccod,invPrdId=:invPrdId;";
        
                return self::executeNonQuery(
                    $sqlsrt, 
                    array(

                            "doccod" => $doccod,

                            "invPrdId" => $invPrdId,

                            "docCtd" => $docCtd,

                            "docPrc" => $docPrc,

                            "docIva" => $docIva,

                            "docLObs" => $docLObs,

                            "docDsc" => $docDsc,

                    )
                    );
            }

                    public static function eliminardocumentoFiscal($doccod)
                    {
                        $sqlsrt = "DELETE FROM documento_fiscal_lineas WHERE doccod=:doccod;";

                        return self::executeNonQuery(
                            $sqlsrt, 
                            array(
                            
                                "doccod" => $doccod

                            )
                            );
                    }

                    /*public static function eliminardocumentoFiscal($invPrdId)
                    {
                        $sqlsrt = "DELETE FROM documento_fiscal_lineas WHERE invPrdId=:invPrdId;";

                        return self::executeNonQuery(
                            $sqlsrt, 
                            array(
                            
                                "invPrdId" => $invPrdId

                            )
                            );
                    }*/
 
                }
            ?>