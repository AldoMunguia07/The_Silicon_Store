<?php

namespace Controllers\Checkout;

use Controllers\PublicController;

class Checkout extends PublicController{
    public function run():void
    {
        $viewData = array();
        if ($this->isPostBack()) {
            $PayPalOrder = new \Utilities\Paypal\PayPalOrder(
                "test".(time() - 10000000),
                "http://localhost/The_Silicon_Store/index.php?page=checkout_error",
                "http://localhost/The_Silicon_Store/index.php?page=checkout_accept"
            );
            /*$PayPalOrder->addItem("Test", "TestItem1", "PRD1", 100, 15, 1, "DIGITAL_GOODS");
            $PayPalOrder->addItem("Test 2", "TestItem2", "PRD2", 200, 7.5, 2, "DIGITAL_GOODS");*/
            $order = array();
            $userId = $_SESSION["login"]["userId"];
            $order["carretilla_auth"] = \Dao\Mnt\Autenticados::obtenerTodos($userId);

            for ($i = 0; $i < count($order["carretilla_auth"]); $i++) {

                $codigo = $order["carretilla_auth"][$i]["codigo"];
                $nombre = $order["carretilla_auth"][$i]["nombre"];
                $descripcion = $order["carretilla_auth"][$i]["descripcion"];
                $precio = $order["carretilla_auth"][$i]["precio"];
                $cantidad = $order["carretilla_auth"][$i]["cantidad"];
                

                $PayPalOrder->addItem($nombre, $descripcion, $codigo, $precio, 15, $cantidad , "DIGITAL_GOODS");

    
            }

            $response = $PayPalOrder->createOrder();
            $_SESSION["orderid"] = $response[1]->result->id;
            \Utilities\Site::redirectTo($response[0]->href);
            die();
        }

        \Views\Renderer::render("paypal/checkout", $viewData);
    }
}
?>
