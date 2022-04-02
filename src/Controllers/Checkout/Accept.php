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

        $metadata = json_decode($dataview["orderjson"]);
        $statusCode =$metadata->statusCode;
        $obs = $metadata->result->status;
        $shipping = json_encode($metadata->result->purchase_units[0]->shipping, JSON_PRETTY_PRINT);
        $fechadlv = $metadata->result->purchase_units[0]->payments->captures[0]->create_time;
        $frmPago = "PayPal";
 

 
    
   
        print($fechadlv);
       

        
        //\Views\Renderer::render("paypal/accept", $dataview);
    }
}

?>
