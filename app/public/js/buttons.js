var Editor = function(config) {

    return {
        ajax: {
            url: config.ajaxUrl,
            send: function () {
                $.ajax(this.url)
            }
        },
        edit: function (dt) {
            var data = dt.row('.selected').data();
            $('form[name="%name%"]'.replace('%name%', 'example')).trigger('reset');
            for(var i in config.fields) {
                var name = config.fields[i]['name'];
                $('[name="%name%"]'.replace('%name%', name), dt.footer()).attr('value', data[name]);
            }
        },
        delete: function () {}
    };
};

$.fn.dataTable.ext.buttons.edit = {
    extend: "selected",
    className: 'buttons-edit buttons-html5',
    editor: 'foo',
    text: function (dt) {
        return dt.i18n('buttons.edit', 'Edit');
    },
    action: function (e, dt, button, config) {
        this.editor.init(dt)
    }
};

$.fn.dataTable.ext.buttons.delete = {
    extend: "selected",
    className: 'buttons-delete buttons-html5',
    text: function (dt) {
        return dt.i18n('buttons.delete', 'Delete');
    },
    action: function (e, dt, button, config) {
        alert(JSON.stringify(dt.row('.selected').data()));
    }
};
