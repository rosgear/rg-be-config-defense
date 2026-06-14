<?php
/**
 * Этот файл является частью расширения модуля веб-приложения RosGear.
 * 
 * Файл конфигурации установки расширения.
 * 
 * @link https://rosgear.ru/
 * @copyright Copyright (c) 2015 RosGear
 * @license https://rosgear.ru/license/
 */

return [
    'id'          => 'rg.be.config.defense',
    'moduleId'    => 'rg.be.config',
    'name'        => 'Configuring access by IP Address',
    'description' => 'Restricting user access to the control panel and website by IP address',
    'namespace'   => 'Rg\Backend\Config\Defense',
    'path'        => '/rg/rg.be.config.defense',
    'route'       => 'defense',
    'locales'     => ['ru_RU', 'en_GB'],
    'permissions' => ['any', 'info'],
    'events'      => [],
    'required'    => [
        ['php', 'version' => '8.2'],
        ['app', 'code' => 'RG Workspace'],
        ['app', 'code' => 'RG CMS'],
        ['app', 'code' => 'RG CRM'],
        ['module', 'id' => 'rg.be.config']
    ]
];
