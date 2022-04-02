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

/**
 * Index Controller
 *
 * @category Public
 * @package  Controllers
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  MIT http://
 * @link     http://
 */

class Index extends PublicController
{
    /**
     * Index run method
     *
     * @return void
     */
    public function run() :void
    {

      
        if (isset($_SESSION['start']) && (time() - $_SESSION['start'] > 259200)) {
            session_unset(); 
            session_destroy(); 
           
        }
        $_SESSION['start'] = time();
        
        
        if(!$_SESSION["anoncartid"])
        {
             $_SESSION["anoncartid"]=strtotime(date("Y-m-d H:i:s"));
        }
        
        $viewData = array();
        
        $viewData["celular"] = \Dao\Rtl\Retail::obtenerCatalogoProductos();
        
       
        //echo '<script>alert("'. $viewData["annoncartid"]  . '")</script>;';
        for ($i = 0; $i < count($viewData["celular"]); $i++) {
            $viewData["celular"][$i]["annoncartid"] =  $_SESSION["anoncartid"];
        }
        //print_r($viewData);
        \Views\Renderer::render("index", $viewData);
        
    }
}
?>
