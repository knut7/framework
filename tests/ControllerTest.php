<?php


use PHPUnit\Framework\TestCase as PHPUnit;


class ControllerTest extends PHPUnit {

    public function testCase(){

       $obj = new \Ballybran\Core\Controller\Controller();

       $this->getActualOutput();
    }
}