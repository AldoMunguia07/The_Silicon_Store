<?php

namespace Dao\Mnt;

use Dao\Table;

class documentos extends Table
{

    public static function obtenerTodos()
    {
        $sqlsrt = "SELECT * FROM documento_fiscal;";
        return self::obtenerRegistros($sqlsrt, array());
    }

    public static function obtenerdocumentoPorId($doccod)
    {
        $sqlsrt = "SELECT * FROM documento_fiscal WHERE doccod=:doccod;";
        return self::obtenerUnRegistro(
            $sqlsrt,
            array("doccod" => $doccod)
        );
    }

    public static function MisTransacciones($idUser)
        {
            $sqlstr = "select DC.doccod,DC.docfch,DC.docobs,DC.docFrmPgo, ROUND(SUM((docPrc*0.15 + docPrc) * docCtd),2) Total from documento_fiscal DC INNER JOIN documento_fiscal_lineas DCL
            ON DC.doccod = DCL.doccod WHERE usercod = :usercod
            GROUP BY DC.doccod,DC.docfch,DC.docobs,DC.docFrmPgo;";
            return self::obtenerRegistros(
                $sqlstr,
                array("usercod" => $idUser)
            );
            
        }



    public static function newdocumento($usercod, $docobs, $docshipping, $docest, $docmeta, $docfchdlv, $docestdlv, $docFrmPgo)
    {
        $sqlsrt = "INSERT INTO documento_fiscal (docfch,usercod,docobs,docshipping,docest,docmeta,docfchdlv,docestdlv,docFrmPgo) values (:docfch,:usercod,:docobs,:docshipping,:docest,:docmeta,:docfchdlv,:docestdlv,:docFrmPgo);";

        return self::executeNonQuery(
            $sqlsrt,
            array(

                "docfch" => date("Y-m-d H:i:s"),

                "usercod" => $usercod,

                "docobs" => $docobs,

                "docshipping" => $docshipping,

                "docest" => $docest,

                "docmeta" => $docmeta,

                "docfchdlv" => $docfchdlv,

                "docestdlv" => $docestdlv,

                "docFrmPgo" => $docFrmPgo,

            )
        );
    }

    public static function actualizardocumento($doccod, $docfch, $usercod, $docobs, $docshipping, $docest, $docmeta, $docfchdlv, $docestdlv, $docFrmPgo)
    {
        $sqlsrt = "UPDATE documento_fiscal SET docfch=:docfch,usercod=:usercod,docobs=:docobs,docshipping=:docshipping,docest=:docest,docmeta=:docmeta,docfchdlv=:docfchdlv,docestdlv=:docestdlv,docFrmPgo=:docFrmPgo WHERE doccod=:doccod;";

        return self::executeNonQuery(
            $sqlsrt,
            array(

                "doccod" => $doccod,

                "docfch" => $docfch,

                "usercod" => $usercod,

                "docobs" => $docobs,

                "docshipping" => $docshipping,

                "docest" => $docest,

                "docmeta" => $docmeta,

                "docfchdlv" => $docfchdlv,

                "docestdlv" => $docestdlv,

                "docFrmPgo" => $docFrmPgo,

            )
        );
    }

    public static function eliminardocumento($doccod)
    {
        $sqlsrt = "DELETE FROM documento_fiscal WHERE doccod=:doccod;";

        return self::executeNonQuery(
            $sqlsrt,
            array(

                "doccod" => $doccod

            )
        );
    }

    public static function obtenerUltimaFactura()
        {
            $sqlstr = "select doccod from documento_fiscal ORDER BY doccod DESC LIMIT 1";
            return self::obtenerRegistros(
                $sqlstr, 
                array()
            );
        }
}

?>