<?php


/**
 * knut7 Framework (http://framework.artphoweb.com/)
 * knut7 FW(tm) : Rapid Development Framework (http://framework.artphoweb.com/)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link      http://github.com/zebedeu/artphoweb for the canonical source repository
 * Copyright (c) 2017.  knut7  Software Technologies AO Inc. (http://www.artphoweb.com)
 * @license   http://framework.artphoweb.com/license/new-bsd New BSD License
 * @author    Marcio Zebedeu - artphoweb@artphoweb.com
 * @version   1.0.0
 */

namespace Ballybran\Core\REST;

class RestUtilities
{
    private static $httpVersion = 'HTTP/1.1 ';
    public static function processRequest()
    {
        $req_method = strtolower($_SERVER['REQUEST_METHOD']);
        $obj = new RestRequest();
        $data = array();
        switch ($req_method)

        {
            case 'get':
                $data = $_GET;
                break;
            case 'post':
                $data = $_POST;
                break;
            case 'put':
                parse_str(file_get_contents('php://input'), $put_vars);
                $data = $put_vars;
                break;
            default:
                die();
                break; }
        $obj->setMethod($req_method);
        $obj->setRequestVars($data);
        if(isset($data['data']))
        {
            $obj->setData(json_decode($data['data']));
        }
        return $obj;
    }

    public static function sendResponse($status = 200, $body = '', $content_type =
    'text/xml')
    {
        $status_header = self::$httpVersion . $status . ' '
            .RestUtilities::getStatusCodeMessage($status);

        header($status_header);
        header('Content-type: ' . $content_type);
        header( 'Content-length: ' . strlen( $body ) );
        if($body != '')
        {
            echo $body;
            exit;
        }
            $msg = '';
            switch($status)
            {
                case 401:
                    $msg = 'You must be authorized to view this page.';
                    break;
                case 404:
                    $msg = 'The requested URL was not found.';
                    break;
                case 500:
                    $msg = 'The server encountered an error processing your request.';
                    break;
                case 501:
                    $msg = 'The requested method is not implemented.';

                    break;
            }
            $body = '<html><head>
                        <title>' . $status . ' ' .
                RestUtilities::getStatusCodeMessage($status) . '</title>
                        </head>
                        <body>
                        <h1>' . RestUtilities::getStatusCodeMessage($status) . '</h1>
                        <p>' . $msg . '</p>
                        </body></html>';
            echo $body;
            exit;
    }
    
    public static function getStatusCodeMessage($status)
    {
        $codes = Array(
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            204 => 'No Content',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported'
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }

}