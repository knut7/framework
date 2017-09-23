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

namespace Ballybran\Helpers\Time;

class Timestamp {

    private static $tempo_da_sessao;

    private static function inserir_tempo(int $tempo_da_sessao): int {
        date_default_timezone_set('UTC');

        // new \DateTimeZone();

        $diferenca_tempo = time() - $tempo_da_sessao;
        $segundos = $diferenca_tempo;
        $minutos = round($diferenca_tempo / 60);
        $horas = round($diferenca_tempo / 3600);
        $dia = round($diferenca_tempo / 86400);
        $semana = round($diferenca_tempo / 604800);
        $mes = round($diferenca_tempo / 2592000);
        $ano = round($diferenca_tempo / 31536000);
//segundos

        if ($segundos <= 60) {
            echo " $segundos segundos agora<br/>";
        }
//minutos
        else if ($minutos <= 60) {
            if ($minutos == 1) {
                echo "one minuto  e $segundos agora <br/>";
            } else {
                echo "$minutos minutos agora<br/>";
            }
        }


//horas
        else if ($horas <= 24) {
            if ($horas == 1) {
                echo "uma hora agora e $minutos minutos e $segundos segundos<br/>";
            } else {
                echo "$horas horas agora<br/>";
            }
        }

        // dias
        else if ($dia <= 7) {
            if ($dia == 1) {
                echo "um dia agora <br/>";
            } else {
                echo "$dia dias agora<br/>";
            }
        }

        //semanas
        else if ($semana <= 4) {
            if ($semana == 1) {
                echo "uma semana agora<br/>";
            } else {
                echo "$semana semanas agora<br/>";
            }
        }


//mes
        else if ($mes <= 12) {
            if ($mes == 1) {
                echo "um mes agora<br/>";
            } else {
                echo "$mes meses agora<br/>";
            }
        }


//semanas
        else {
            if ($ano == 1) {
                echo "um ano agora<br/>";
            } else {
                echo "$ano anos agora<br/>";
            }
        }
        return $tempo_da_sessao;
    }

    public static function _getDataTime_stemp(string $data) : string {
        self::$tempo_da_sessao = strtotime($data);
        return ( self::inserir_tempo(self::$tempo_da_sessao));
    }

    private static function distanceOfTimeInWords($fromTime, $toTime = 0, $showLessThanAMinute = false) {
        $distanceInSeconds = round(abs($toTime - $fromTime));
        $distanceInMinutes = round($distanceInSeconds / 60);

        if ($distanceInMinutes <= 1) {
            if (!$showLessThanAMinute) {
                return ($distanceInMinutes == 0) ? 'less than a minute' : '1 minute';
            } else {
                if ($distanceInSeconds < 5) {
                    return 'less than 5 seconds';
                }
                if ($distanceInSeconds < 10) {
                    return 'less than 10 seconds';
                }
                if ($distanceInSeconds < 20) {
                    return 'less than 20 seconds';
                }
                if ($distanceInSeconds < 40) {
                    return 'about half a minute';
                }
                if ($distanceInSeconds < 60) {
                    return 'less than a minute';
                }

                return '1 minute';
            }
        }
        if ($distanceInMinutes < 45) {
            return $distanceInMinutes . ' minutes';
        }
        if ($distanceInMinutes < 90) {
            return 'about 1 hour';
        }
        if ($distanceInMinutes < 1440) {
            return 'about ' . round(floatval($distanceInMinutes) / 60.0) . ' hours';
        }
        if ($distanceInMinutes < 2880) {
            return '1 day';
        }
        if ($distanceInMinutes < 43200) {
            return 'about ' . round(floatval($distanceInMinutes) / 1440) . ' days';
        }
        if ($distanceInMinutes < 86400) {
            return 'about 1 month';
        }
        if ($distanceInMinutes < 525600) {
            return round(floatval($distanceInMinutes) / 43200) . ' months';
        }
        if ($distanceInMinutes < 1051199) {
            return 'about 1 year';
        }

        return 'over ' . round(floatval($distanceInMinutes) / 525600) . ' years';
    }

}
