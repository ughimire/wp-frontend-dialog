;(function ($, doc, win) {
    "use strict";


    function WPFrontendDialog(el, opts) {


        this.selector = $(el);

        this.defaults = {};

        this.options = $.extend(this.defaults, opts);


        this.init();
    }

    WPFrontendDialog.prototype.init = function () {

        this.initResources();
        this.initHtml();


    };


    WPFrontendDialog.prototype.destroy = function () {


    };
    WPFrontendDialog.prototype.initHtml = function () {


        var wrapper = $("<div class='file-manager-wrapper' style='display:none'/>");


    };
    WPFrontendDialog.prototype.getSidebar = function () {

        var sidebar = $('<div class="file-manager-sidebar"/>');

        return sidebar;

    };
    WPFrontendDialog.prototype.bindEvents = function (object) {


        object.find('.fm_search').on('click', function () {

            WPFrontendDialog.prototype.searchEventBind($(this));
        });


    };

    $.fn.WPFrontendDialog = function (opts) {
        return this.each(function () {
            new WPFrontendDialog(this, opts);
        });
    };

})(jQuery, document, window);

$(function () {

    var WP_FD_TEXT_DOMAIN = 'wp-frontend-dialog';

    $('.' + WP_FD_TEXT_DOMAIN + '_CLASS').WPFrontendDialog();


});