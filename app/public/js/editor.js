var Editor = function (config) {
    config.form = $('form[name="%name%"]'.replace('%name%', config.form));
    config.form.attr('action', config.ajax).attr('method', 'post');
    for (var i in config.fields) {
        config.fields[i] = $.extend({name: null, type: 'text'}, config.fields[i]);
        if (config.fields[i].type == 'datetime') {
            $('[name="%name%"]'.replace('%name%', config.fields[i].name), config.form).datepicker({dateFormat: 'yy/mm/dd'});
        }
    }
    return {
        form: function () {
            return $.extend(!0, config.form, {
                    submit: function () {
                        return $.ajax({
                            url: config.ajax,
                            data: $(config.form).serialize(),
                            type: config.form.attr('method')
                        });
                    },
                    reset: function () {
                        $('input', config.form).not('[type=submit]').each(function () {
                            $(this).attr('value', '')
                        });
                        config.form.trigger('reset');
                    }
                }
            )
        },
        edit: function (dt) {
            var data = dt.row('.selected').data();
            config.form.trigger('reset');
            for (var i in config.fields) {
                var name = config.fields[i]['name'];
                $('[name="%name%"]'.replace('%name%', name), config.form).attr('value', data[name]);
            }
        }
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
