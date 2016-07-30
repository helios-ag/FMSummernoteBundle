(function (factory) {
    /* global define */
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else {
        // Browser globals: jQuery
        factory(window.jQuery);
    }
}(function ($){
    // template, editor
    var tmpl = $.summernote.renderer.getTemplate();
    // add plugin
    $.summernote.addPlugin({
        name: 'ElFinder', // name of plugin
        buttons: { // buttons
            elfinder: function () {
                return tmpl.iconButton('fa fa-list-alt', {
                    event: 'elfinder',
                    title: 'ElFinder File Manager',
                    hide: false
                });
            }
        },

        events: { // events
            elfinder: function (event, editor, layoutInfo) {
                elFinderBrowser();
            }

        }
    });
}));