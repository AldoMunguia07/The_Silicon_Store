<?php
    namespace Dao\Mnt;

    use Dao\Table;

    class Categorias extends Table
    {
        public static function obtenerTodos()
        {
            $sqlsrt = "SELECT * FROM categorias;";
            return self::obtenerRegistros($sqlsrt, array());
            
        }

        public static function obtenerPorCatId($catid)
        {
            $sqlsrt = "SELECT * FROM categorias WHERE catid=:catid;";
            return self::obtenerUnRegistro(
                $sqlsrt, 
                array("catid" => $catid)
            );
            
        }

        public static function nuevacategoria($catnom,$catest)
            {
                $sqlsrt = "INSERT INTO categorias (catnom,catest) values (:catnom,:catest);";

                return self::executeNonQuery(
                    $sqlsrt, 
                    array(

                            "catnom" => $catnom,

                            "catest" => $catest,

                    )
                    );
            }

        public static function actualizarCategoria($catid, $catnom, $catest)
        {
            $sqlsrt = "UPDATE categorias SET catnom=:catnom, catest=:catest WHERE catid=:catid;";
           

            return self::executeNonQuery(
                $sqlsrt, 
                array(
                    "catnom" => $catnom,
                    "catest" => $catest,
                    "catid" => $catid

                )
                );
        }

        public static function eliminarCategoria($catid)
        {
            $sqlsrt = "DELETE FROM categorias WHERE catid=:catid;";

            return self::executeNonQuery(
                $sqlsrt, 
                array(
                
                    "catid" => $catid

                )
                );
        }
    }
?>