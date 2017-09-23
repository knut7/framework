<?php

/**
 *
 * knut7 Framework (http://framework.artphoweb.com/)
 *
 * @link      http://github.com/zebedeu/artphoweb for the canonical source repository
 * @copyright (c) 2016.  knut7 Technologies AO Inc. (http://www.artphoweb.com)
 * @license   http://framework.artphoweb.com/license/new-bsd New BSD License
 */
/**
 *
 * Also spl_autoload_register (Take a look at it if you like)
 *
 */
spl_autoload_register(function($class) {

    if (file_exists(str_replace('\\', DS, $class) . '.php'))
        require_once str_replace('\\', DS, $class) . '.php';

});
//
// function search_lib($lib, $file, $ds = '/'){
//    // Verifica se o diretório informado é válido
//    if (is_dir($lib)){
//       // Verifica se o arquivo já existe neste primeiro diretório
//       if (file_exists($lib.$ds.$file)) return $lib.$ds.$file;
//       // Lista os subdiretórios e arquivos
//       $dirs = array_diff(scandir($lib, 1), array('.','..'));
//       foreach ($dirs as $dir) {
//          // Verifica se é um arquivo se for, pula para o próximo
//          if (!is_dir($lib.$ds.$dir)) continue;
//          // Se for um diretório procura dentro dele
//          $f = search_lib($lib.$ds.$dir, $file, $ds);
//          // Caso não encontre retora false
//          if ($f !== false) return $f;
//       }
//    }
//    // Se o diretório informado não for válido ou se não tiver encontrado retorna false
//    return false;
// }
// function __autoload($class){
//    $libs = './libs';
//    $ext  = '.php';
//    $file = search_lib($libs, $class.$ext);
//    // Se encontrou inclui o arquivo
//    if ($file !== false ) require_once $file;
//    // Se não encontrar o arquivo lança um erro na tela. :)
//    else {
//       $msg = "Autoload fatal erro: Can't find the file {$class}{$ext}!";
//       error_log($msg);
//       exit('<br><br><strong>'.$msg.'</strong>');
//    }
// }
