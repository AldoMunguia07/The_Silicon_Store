<?php
                namespace Dao\Mnt;
                use Dao\Table;

            class marcas extends Table
            {

            public static function obtenerTodos()
            {
                $sqlsrt = "SELECT * FROM marca;";
                return self::obtenerRegistros($sqlsrt, array());
                
            }

            public static function obtenerTodosCmb()
            {
                $sqlsrt = "SELECT idMarca, marca FROM marca;";
                return self::obtenerRegistros($sqlsrt, array());
                
            }

                    public static function obtenermarcaPorId($idMarca)
                    {
                        $sqlsrt = "SELECT * FROM marca WHERE idMarca=:idMarca;";
                        return self::obtenerUnRegistro(
                            $sqlsrt, 
                            array("idMarca" => $idMarca)
                        );
                        
                    }

            public static function newmarca($marca,$estado)
            {
                $sqlsrt = "INSERT INTO marca (marca,estado) values (:marca,:estado);";

                return self::executeNonQuery(
                    $sqlsrt, 
                    array(

                            "marca" => $marca,

                            "estado" => $estado,

                    )
                    );
            }

            public static function actualizarmarca($idMarca,$marca,$estado)
            {
                $sqlsrt = "UPDATE marca SET marca=:marca,estado=:estado WHERE idMarca=:idMarca;";
        
                return self::executeNonQuery(
                    $sqlsrt, 
                    array(

                            "idMarca" => $idMarca,

                            "marca" => $marca,

                            "estado" => $estado,

                    )
                    );
            }

                    public static function eliminarmarca($idMarca)
                    {
                        $sqlsrt = "DELETE FROM marca WHERE idMarca=:idMarca;";

                        return self::executeNonQuery(
                            $sqlsrt, 
                            array(
                            
                                "idMarca" => $idMarca

                            )
                            );
                    }
 
                }
            ?>