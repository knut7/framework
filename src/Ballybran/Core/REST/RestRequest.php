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

class RestRequest
{
    private $request_vars;
    private $data;
    private $http_accept;
    private $method;
    
    public function __construct()
    {
        $this->request_vars = array();
        $this->data    = '';
        $this->http_accept = (strpos($_SERVER['HTTP_ACCEPT'], 'json')) ? 'json' : 'xml';
        $this->method    = 'get';
    }
    public function setData($data)
    {
        $this->data = $data;
    }
    public function setMethod($method)
    {
        $this->method = $method;
    }
    public function setRequestVars($request_vars)
    {
        $this->request_vars = $request_vars;
    }
    public function getData()
    {
        return $this->data;
    }
    public function getMethod()
    {
        return $this->method;
    }
    public function getHttpAccept()
    {
        return $this->http_accept;
    }
    public function getRequestVars()
    {
        return $this->request_vars;
    }




}