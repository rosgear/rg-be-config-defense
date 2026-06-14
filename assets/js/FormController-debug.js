/*!
 * Контроллер формы.
 * Расширение "Настройка доступа по IP-адресу".
 * Модуль "Конфигурация".
 * Copyright 2015 RosGear. Anton Tivonenko <anton.tivonenko@gmail.com>
 * https://rosgear.ru/license/
 */

Ext.define('Rg.be.config.defence.FormController', {
    extend: 'Ge.view.form.PanelController',
    alias: 'controller.rg-be-config-defense-form',

    /**
     * Срабатывает при клике на флагов "Подключить белый список IP-адресов" (панель управления).
     * @param {Ext.form.field.Checkbox} me
     * @param {Boolean} value Значение.
     */
     onCheckBackendWhiteListIp: function (me, value) {
        let blackList = this.getViewCmp('be-blacklist');
        if (value) {
            blackList.setValue(0);
            blackList.setDisabled(true);
        } else
            blackList.setDisabled(false);
    },

    /**
     * Срабатывает при клике на флагов "Подключить белый список IP-адресов" (сайт).
     * @param {Ext.form.field.Checkbox} me
     * @param {Boolean} value Значение.
     */
     onCheckFrontendWhiteListIp: function (me, value) {
        let blackList = this.getViewCmp('fe-blacklist');
        if (value) {
            blackList.setValue(0);
            blackList.setDisabled(true);
        } else
            blackList.setDisabled(false);
    }
});
