<?php
    namespace Dao\Mnt;

    use Dao\Table;
use DateTime;

    class IntentosPagos extends Table
    {
        public static function obtenerTodos()
        {
            $sqlsrt = "SELECT * FROM intentospagos;";
            return self::obtenerRegistros($sqlsrt, array());
            
        }

        public static function obtenerPorId($id)
        {
            $sqlsrt = "SELECT * FROM intentospagos WHERE id=:id;";
            return self::obtenerUnRegistro(
                $sqlsrt, 
                array("id" => $id)
            );
            
        }

        public static function nuevoIntento($cliente, $monto, $fechaVencimiento, $estado)
        {
            $sqlsrt = "INSERT INTO intentospagos (fecha, cliente, monto, fechaVencimiento, estado) values (:fecha, :cliente, :monto, :fechaVencimiento, :estado);";

            return self::executeNonQuery(
                $sqlsrt, 
                array(
                    "fecha" => date("Y-m-d H:i:s"),
                    "cliente" => $cliente,
                    "monto" => $monto,
                    "fechaVencimiento" => $fechaVencimiento,
                    "estado" => $estado

                )
                );
        }

        public static function actualizarIntento($id,$cliente, $monto, $fechaVencimiento, $estado)
        {
            $sqlsrt = "UPDATE intentospagos SET cliente=:cliente, monto=:monto, fechaVencimiento=:fechaVencimiento, estado=:estado WHERE id=:id;";
           

            return self::executeNonQuery(
                $sqlsrt, 
                array(
                   // "fecha" => date("Y-m-d H:i:s"),
                    "cliente" => $cliente,
                    "monto" => $monto,
                    "fechaVencimiento" => $fechaVencimiento,
                    "estado" => $estado,
                    "id" => $id

                )
                );
        }

        public static function eliminarIntento($id)
        {
            $sqlsrt = "DELETE FROM intentospagos WHERE id=:id;";

            return self::executeNonQuery(
                $sqlsrt, 
                array(
                
                    "id" => $id

                )
                );
        }
    }
?>