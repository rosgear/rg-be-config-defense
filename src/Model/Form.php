<?php
/**
 * Этот файл является частью расширения модуля веб-приложения RosGear.
 * 
 * @link https://rosgear.ru/
 * @copyright Copyright (c) 2015 RosGear
 * @license https://rosgear.ru/license/
 */

namespace Rg\Backend\Config\Defense\Model;

use Rg\Backend\Config\Model\ServiceForm;
use Ge\Panel\Helper\ExtField;

/**
 * Модель данных конфигурации доступа по IP-адресу (Проактивная защита).
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Rg\Backend\Config\Defense\Model
 * @since 1.0
 */
class Form extends ServiceForm
{
    /**
     * {@inheritdoc}
     */
    public function init(): void
    {
        parent::init();

        $this->unifiedName = 'defense';
    }

    /**
     * {@inheritdoc}
     */
    public function beforeLoad(array &$data): void
    {
        // панель управления
        ExtField::checkboxValue($data, 'enableBackendWhiteListIp', true, false); // подключить белый список IP-адресов:
        ExtField::checkboxValue($data, 'enableBackendBlackListIp', true, false); // подключить чёрный список IP-адресов:
        // сайт
        ExtField::checkboxValue($data, 'enableFrontendWhiteListIp', true, false); // подключить белый список IP-адресов:
        ExtField::checkboxValue($data, 'enableFrontendBlackListIp', true, false); // подключить чёрный список IP-адресов:
    }
}
