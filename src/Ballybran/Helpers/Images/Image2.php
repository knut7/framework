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
namespace  Ballybran\Helpers\Images;

class Image2 {

    public function resize($filename, $width, $height) {
        if (!is_file(DIR_FILE . $filename)) {
            return;
        }

        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        $old_image = $filename;
        $new_image = 'cache/' . utf8_substr($filename, 0, utf8_strrpos($filename, '.')) . '-' . $width . 'x' . $height . '.' . $extension;

        if (!is_file(DIR_FILE . $new_image) || (filectime(DIR_FILE . $old_image) > filectime(DIR_FILE . $new_image))) {
            $path = '';

            $directories = explode('/', dirname(str_replace('../', '', $new_image)));

            foreach ($directories as $directory) {
                $path = $path . '/' . $directory;

                if (!is_dir(DIR_FILE . $path)) {
                    @mkdir(DIR_FILE . $path, 0777);
                }
            }

            list($width_orig, $height_orig) = getimagesize(DIR_FILE . $old_image);

            if ($width_orig != $width || $height_orig != $height) {
                $image = new Image(DIR_FILE . $old_image);
                $image->resize($width, $height);
                $image->save(DIR_FILE . $new_image);
            } else {
                copy(DIR_FILE . $old_image, DIR_FILE . $new_image);
            }
        }

        if ($this->request->server['HTTPS']) {
            return DIR_FILE . 'image/' . $new_image;
        } else {
            return DIR_FILE . 'image/' . $new_image;
        }
    }

}
