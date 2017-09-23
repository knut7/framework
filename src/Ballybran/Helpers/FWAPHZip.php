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

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Ballybran\Helpers;

/**
 * Description of BallybranHZip
 * BallybranHZip::zipDir('/path/to/sourceDir', '/path/to/out.zip'); 
 *
 * @author artphotografie
 */
class BallybranHZip {

    /**
     * @var array
     */
    private $filename;

    public function __construct(array $filename = null) {
        $this->filename = $filename;
    }

    private function addFile(){

    }
    
    private static function create($folder, &$zipFile, $length){
        
       $handle = opendir($folder);

       while (false !== $f = readdir($handle)) {
           if($f != '.' && $f != '..'){
            $filePath = "$folder/$f";

            $localPath = substr($filePath, $length);
                if(is_file($filePath)){
                    $zipFile->addFile($filePath, $localPath);
                    self::create($filePath, $zipFile, $length);
                }
            }
           }
           closedir($handle); 
    }

    public static function zipDir($sourcePath, $outZipPath){
        $dirName = "";
        $pathInfo = pathinfo($sourcePath);
        $parentPath = $pathInfo['dirname'];
        /* @var $dirName type */
        $dirName = $pathInfo['basename'];

        $zip = new \ZipArchive();
        $zip->open($outZipPath, \ZipArchive::CREATE);
        $zip->addEmptyDir($dirName);

        self::create($sourcePath, $zip, strlen("$parentPath/"));
        $zip->close();
    }
}
