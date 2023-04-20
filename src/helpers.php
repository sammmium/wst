<?php

namespace App;

use App\models\Config;
use Exception;

require_once __DIR__ . '/models/Config.php';;

/**
 * Функция для получения значения любого из конфигурационных файлов,
 * находящихся в директории /src/configurations с расширением *.php
 * 
 * Поиск происходит по строковым ключам.
 * Вложенность ключей при поиске обеспечивается разделением через точку.
 * 
 * Примеры ключей: app_name или database.mysql.host
 */
function config(string $key): string
{
    try {
        $config = Config::getInstance();
        $files = scandir(__DIR__ . '/configurations');

        foreach ($files as $file) {
            if (preg_match('/\.(php)/', $file)) {
                $pathFile = require __DIR__ . '/configurations/' . $file;
                $config->setConfig($pathFile);
            }
        }

        return $config->getConfig($key);
    } catch(Exception $ex) {
        throw new Exception('Подключить конфигурационные файлы не удалось');
    }
}

/**
 * Функция получения директории по ее наименованию.
 * 
 * Например:
 *     нужна директория /var/www/wst/src/interfaces/interfaces 
 *     для подключения php файла. передаем данной функции имя interface 
 *     в единственном числе так как необходимо подключение лишь одного файла.
 */
function wstdir(string $name)
{
    return config($name . '_dir');
}
