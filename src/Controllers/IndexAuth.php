<?php

/**
 * PHP Version 7.2
 *
 * @category Private
 * @package  Controllers
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  MIT http://
 * @version  CVS:1.0.0
 * @link     http://
 */
namespace Controllers;

/**
 * Página Principal de Administradores
 *
 * @category Public
 * @package  Controllers/Admin
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  MIT http://
 * @link     http://
 */
class IndexAuth extends \Controllers\PrivateController
{
    
    public function run() :void
    {
        $usuario["usuario"] = $_SESSION["login"]["userName"];
        \Views\Renderer::render("IndexAuth", $usuario);
    }
}
?>
