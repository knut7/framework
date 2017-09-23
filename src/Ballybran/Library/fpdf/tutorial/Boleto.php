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

/**
 * Created by PhpStorm.
 * User: artphotografie
 * Date: 26/06/17
 * Time: 10:44
 */

require('../fpdf.php');

class Boleto extends FPDF
{

    // Load data
    function LoadData($file) {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach ($lines as $line)
            $data[] = explode(';', trim($line));
        return $data;
    }

// Simple table
    function BasicTable($header, $data) {
        // Header
        foreach ($data as $col)
            $this->Cell(72, 7, $col, 1);
        $this->Ln();
        // Data
        foreach ($header as $row) {
            foreach ($row as $col)
                $this->Cell(72, 6, $col, 1);
            $this->Ln();
        }
    }

}

$pdf = new Boleto('L');
$header = array('Data de entrada   Data de saida', ' Item      ', 'Valor    ');
$data = $pdf->LoadData('countries.txt');
$pdf->SetFont('Arial', '', 14);
$pdf->AddPage();
$pdf->BasicTable($header, $data);
$pdf->AddPage();
$pdf->Output();