<?php
/**
 * Этот файл является частью расширения модуля веб-приложения RosGear.
 * 
 * @link https://rosgear.ru/
 * @copyright Copyright (c) 2015 RosGear
 * @license https://rosgear.ru/license/
 */

namespace Rg\Backend\Config\Defense\Controller;

use Ge;
use Ge\Panel\Helper\ExtCombo;
use Ge\Panel\Widget\EditWindow;
use Rg\Backend\Config\Controller\ServiceForm;

/**
 * Контроллер конфигурации доступа по IP-адресу (Проактивная защита).
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Rg\Backend\Config\Defense\Controller
 * @since 1.0
 */
class Form extends ServiceForm
{
    /**
     * Возвращает элементы панели формы (Ge.view.form.Panel GeJS).
     * 
     * @return array
     */
    protected function getFormItems(): array
    {
        $unified = Ge::$app->unifiedConfig->get('defense');
        return [
            [
                'xtype'      => 'displayfield',
                'ui'         => 'parameter-head',
                'fieldLabel' => 'Ваш IP-адрес',
                'value'      => Ge::$app->request->getUserIp()
            ],
            [
                'xtype'    => 'fieldset',
                'title'    => Ge::t(BACKEND, BACKEND_NAME),
                'defaults' => [
                    'labelWidth' => 250,
                    'labelAlign' => 'right'
                ],
                'items' => [
                    [
                        'xtype'      => 'checkbox',
                        'id'         => $this->module->viewId('form__be-whitelist'),
                        'fieldLabel' => '#Enabled IP whitelist',
                        'name'       => 'enableBackendWhiteListIp',
                        'ui'         => 'switch',
                        'listeners'  => ['change' => 'onCheckBackendWhiteListIp'],
                        'checked'    => $unified['enableBackendWhiteListIp'] ?? false
                    ],
                    [
                        'xtype'      => 'checkbox',
                        'id'         => $this->module->viewId('form__be-blacklist'),
                        'fieldLabel' => '#Enabled IP blacklist',
                        'name'       => 'enableBackendBlackListIp',
                        'disabled'   => $unified['enableBackendWhiteListIp'] ?? false,
                        'ui'         => 'switch',
                        'checked'    => $unified['enableBackendBlackListIp'] ?? false
                    ],
                    ExtCombo::themeViews(
                        '#Page template on access error', 
                        'backendViewTemplate', 
                        BACKEND, 
                        ['type' => 'error'],
                        [],
                        [
                            'emptyText' => 'errors/blocked',
                            'value'     => $unified['backendViewTemplate'] ?? ''
                        ]
                    )
                ]
            ],
            [
                'xtype'    => 'fieldset',
                'title'    => Ge::t(BACKEND, FRONTEND_NAME),
                'defaults' => [
                    'labelWidth' => 250,
                    'labelAlign' => 'right'
                ],
                'items' => [
                    [
                        'xtype'      => 'checkbox',
                        'id'         => $this->module->viewId('form__fe-whitelist'),
                        'fieldLabel' => '#Enabled IP whitelist',
                        'name'       => 'enableFrontendWhiteListIp',
                        'ui'         => 'switch',
                        'listeners'  => ['change' => 'onCheckFrontendWhiteListIp'],
                        'checked'    => $unified['enableFrontendWhiteListIp'] ?? false
                    ],
                    [
                        'xtype'      => 'checkbox',
                        'id'         => $this->module->viewId('form__fe-blacklist'),
                        'fieldLabel' => '#Enabled IP blacklist',
                        'name'       => 'enableFrontendBlackListIp',
                        'disabled'   => $unified['enableFrontendWhiteListIp'] ?? false,
                        'ui'         => 'switch',
                        'checked'    => $unified['enableFrontendBlackListIp'] ?? false
                    ],
                    ExtCombo::themeViews(
                        '#Page template on access error', 
                        'frontendViewTemplate', 
                        FRONTEND, 
                        ['type' => 'error'],
                        [],
                        [
                            'emptyText' => 'errors/blocked',
                            'value'     => $unified['frontendViewTemplate'] ?? ''
                        ]
                    )
                ]
            ],
            [
                'xtype'  => 'toolbar',
                'dock'   => 'bottom',
                'border' => 0,
                'style'  => ['borderStyle' => 'none'],
                'items'  => [
                    [
                        'xtype'    => 'checkbox',
                        'boxLabel' => $this->module->t('reset settings'),
                        'name'     => 'reset',
                        'ui'       => 'switch'
                    ]
                ]
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function createWidget(): EditWindow
    {
        /** @var EditWindow $window */
        $window = parent::createWidget();

        // окно компонента (Ext.window.Window Sencha ExtJS)
        $window->autoHeight = true;
        $window->width = 700;

        // панель формы (Ge.view.form.Panel GeJS)
        $window->form->items = $this->getFormItems();
        $window->form->controller = 'rg-be-config-defense-form';
        $window
            ->setNamespaceJS('Rg.be.config.defence')
            ->addRequire('Rg.be.config.defence.FormController' . (GE_DEBUG ? '-debug' : ''));
        return $window;
    }
}
