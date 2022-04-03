<?php

namespace Controllers\Checkout;

use Controllers\PublicController;
class Accept extends PublicController{
    public function run():void
    {
        $dataview = array();
        $token = $_GET["token"] ?: "";
        $session_token = $_SESSION["orderid"] ?: "";
        if ($token !== "" && $token == $session_token) {
            $result = \Utilities\Paypal\PayPalCapture::captureOrder($session_token);
            $dataview["orderjson"] = json_encode($result, JSON_PRETTY_PRINT);
        } else {
            $dataview["orderjson"] = "No Order Available!!!";
        }

        $userId = $_SESSION["login"]["userId"];
        $carretilla = \Dao\Mnt\Autenticados::obtenerTodos($userId);

        if($carretilla)
        {
            $metadata = json_decode($dataview["orderjson"]);
            $statusCode =$metadata->statusCode;
            $obs = $metadata->result->status;
            $shipping = json_encode($metadata->result->purchase_units[0]->shipping, JSON_PRETTY_PRINT);
            $fechadlv = $metadata->result->purchase_units[0]->payments->captures[0]->create_time;
            $frmPago = "PyP";
            $timestamp = strtotime($fechadlv);
            $fechadlv = date("Y-m-d H:i:s", $timestamp);

            $result = \Dao\Mnt\documentos::newdocumento($userId, $obs, $shipping, $statusCode, json_encode($metadata, JSON_PRETTY_PRINT), $fechadlv, $statusCode, $frmPago);
            $ultimaFactura= \Dao\Mnt\documentos::obtenerUltimaFactura();
          
            $idFactura = $ultimaFactura[0]["doccod"];
            if($result)
            {
                for($i = 0; $i < count($carretilla); $i++) 
                {
                    $idProducto = $carretilla[$i]["codigo"];
                    $cantidad = $carretilla[$i]["cantidad"];
                    $precio = $carretilla[$i]["precio"];
                    $impuesto = 0.15;
                    $observacion = $obs;
                    $descuento = 0.00;
                    

                  $resultado = \Dao\Mnt\documentoFiscals::newdocumentoFiscal($idFactura ,$idProducto,$cantidad, $precio ,$impuesto, $observacion,  $descuento);
                  if($resultado)
                  {
                    $delete = \Dao\Mnt\Autenticados::eliminarAutenticado($userId, $idProducto);
                        
                  }

                }
            }

            $viewData["miDetalle"] = \Dao\Mnt\documentoFiscals::MisDetalles($idFactura);
            \Views\Renderer::render("mnt\miDetalle", $viewData);
            
        }
       
        //\Views\Renderer::render("paypal/accept", $dataview);
        
    }
}

?>
