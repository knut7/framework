<?php

/**
 *
 * knut7 Framework (http://framework.artphoweb.com/)
 * knut7 FW(tm) : Rapid Development Framework (http://framework.artphoweb.com/)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link      http://github.com/zebedeu/artphoweb for the canonical source repository
 * @copyright (c) 2016.  knut7  Software Technologies AO Inc. (http://www.artphoweb.com)
 * @license   http://framework.artphoweb.com/license/new-bsd New BSD License
 * @author    Marcio Zebedeu - artphoweb@artphoweb.com
 * @version   1.0.0
 */

namespace Ballybran\Exception;
use Ballybran\Helpers\Assets;


class F7Exception {

    public static function error( $params = null){ ?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>404</title>
    <link rel="stylesheet" href="<?php echo URL; ?>Public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>Public/bootstrap/css/bootstrap-theme.min.css">

</head>
<script src="<?php echo URL; ?>Public/bootstrap/jQuery.js"></script>


<?php
// if (isset($this->Js)) {
//     foreach ($this->Js as $Js) {
//         echo ' <script type="text/javascript" src="' . URL . 'view/' . $Js . '"></script>';
//     }
// }
//
?>
<body>
<!-- Navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top" id="my-navbar">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <p class="navbar-brand">knut7</p>
        </div><!-- End Navbar Header -->

        <div class="collapse navbar-collapse" id="navbar-collapse">

            <ul class="nav navbar-nav" >
                <!-- <li><a href="<?php /* echo URL; */ ?>index">HOME</a> </li> -->

            </ul>
        </div>
    </div><!-- End Conteiner -->
</nav><!-- End Navbar -->

<br/><br/><br/>
<div class="container content">
    <div class="row">
        <div class="col-md-12">

            <h1>404</h1>



            <hr />

            <h3>The page you were looking for could not be found</h3>
            <p>This could be the result of the page being removed, the name being changed or the page being temporarily unavailable</p>
            <h3>Troubleshooting</h3>

            <ul>
                <li>If you spelled the URL manually, double check the spelling</li>
                <li>Go to our website's home page, and navigate to the content in question</li>
            </ul>

            <hr>

                <?php

                    if(is_array($params)) {
                        echo"<div class=\"well\">";
                        foreach ($params as $k => $v) {
                            echo "<ul>";
                            echo "<li>" .$k . " :::::::::::: ". $v . "</li>";
                            echo "</ul>";

                        }
                        echo "</div>";

                    }else if($params){
                        echo"<div class=\"well\">";
                        echo $params;
                        echo "</div>";

                } else if(class_exists($params)){

                    } ?>

            </div>

        </div>
    </div>
</div>
   <?php
    }
}
?>
</body>
</html>

