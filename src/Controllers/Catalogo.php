<?php

/**
 * PHP Version 7.2
 *
 * @category Public
 * @package  Controllers
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  MIT http://
 * @version  CVS:1.0.0
 * @link     http://
 */
namespace Controllers;
use Controllers\PrivateController;

/**
 * Index Controller
 *
 * @category Public
 * @package  Controllers
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  MIT http://
 * @link     http://
 */

class Catalogo extends PrivateController
{
   
    public function run() :void
    {

        
        $viewData = array();
        
        $viewData["celular"] = \Dao\Rtl\Retail::obtenerCatalogoProductos();
        
       
        //echo '<script>alert("'. $viewData["annoncartid"]  . '")</script>;';
        for ($i = 0; $i < count($viewData["celular"]); $i++) {
            $viewData["celular"][$i]["usercod"] =  $_SESSION["login"]["userId"];
        }
        //print_r($viewData);
        \Views\Renderer::render("Catalogo", $viewData);
        
    }
}
?>
