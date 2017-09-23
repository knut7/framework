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



use Ballybran\Helpers\Utility\Auth;

class Exception {

    public static function createPathInModelo() {

        Auth::Auth("Se estas a ver esta mensagem é sinal de que o directório padrão <code>Applications</code> não se encontra dentro do <code>Module</code>. Para corrigir este erro faça o seguinte: <br/><br/>1 . A pasta para a aplicação por padrão é o <code>Applications</code>. Se não existe ou se quer criar uma  <br/>
  pasta  nova para a tua aplicação então você pode cria uma pasta para a tua aplicação em <code>" . PV . "</code><br/>
  Exemplo:<br/><br/>
  <code>" . PV . "MINHA APLICACÃO;</code><br/><br/>
  2 Na pasta <code>Config</code> no ficheiro <code>Ap_Config.module.php</code> insere o nome da tua <code>aplicação</code> na variavel <code>$<en>MY_PROJECT_NAME</code><br/>
  Exemplo:<br/><br/>
  <code>$<en>MY_PROJECT_NAME = 'MINHA APLICACÃO';</code><br/><br/> ");
    }

    public static function createController($classFile, $controllerPath) {

        Auth::Auth("3 . O Controllador <code>$classFile.php</code>  nao existe. Cria um novo directorio e nomeie por <code>Controllers</code>.<br/><br/> Em seguida dentro deste novo directório <code>Controllers</code> insere o controllador <code>$classFile.php</code>. E por ultimo,  cole o codigo de baixo no <code>$classFile.php</code><br/>
       exemplo:<br/><code>$controllerPath</code><br/>
        ----------<br/><code><? php <br/>class $classFile { <br/><br/>public function __construct()\n{<br/><br/># code...<br/>}<br/><br/>public function Index(){<br/><br/>}<br/>}</code><br/>----------");
    }

    public static function controller($classFile) {

        Auth::Auth("<p class='btn btn-danger>' 3 . A class nao exise. Você deve criar em primeiro lugar uma classe em <code>$classFile</code>.'</p>' ");
    }

    public static function indexController($classFile) {

        Auth::Auth("<br/> 4 Você deve criar uma propriedade Index na tua classe <code>$classFile </code>");
    }

    public static function noPathView() {

        Auth::Auth("<br/>Não foi criado A pasta View em <code>" . APP . "</code> ");
    }

    public static function noPathinView($viewPath) {

        Auth::Auth("<br/> Não foi criado o <code>directório $viewPath</code>  dentro da pasta View em <code>" . APP . "</code> ");
    }

    public static function notHeader() {

        Auth::no("<br/>Não foi criado o arquivo <code>header.phtml</code> na pasta View ");
    }

    public static function notFooter() {

        Auth::no("<br/>Não foi criado o arquivo <code>footer.phtml</code> na pasta view");
    }

    public static function notIndex($viewPath) {

        Auth::no("<br/>Não foi criado o arquivo <code>Index.phtml</code> no <code>directório $viewPath em View</code>");
    }

    public static function notFound() {

        F7Exception::error();
    }

    public static function langNotLoad() {
        echo "Could not load language file";
    }

    public static function Error($string)
    {
        F7Exception::error($string);
    }

}
