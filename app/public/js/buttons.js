var Editor = {
    create: function (config) {
        this.config = $.extend(true, {}, Editor.defaults, config);
    },
    init: function (dt) {
        console.log(dt.footer());
    },
    formTemplate: '<form action="%action%" name="%name%">%innerHtml%</form>',
    form: function (dt) {
        this.formTemplate.replace('%action%', dt.ajax.url());
        console.log(this.formTemplate.replace('%action%', dt.ajax.url()).replace('%name%', dt.template));
    },
    inputTemplate: '<label for="%id%"></label><input type="%type%" id="%id%" value="%value%">',
    text: function (id, value) {
        return this.inputTemplate.replace('%type%', 'text').replace('%id%', id).replace('%value%', value);
    },
    formRow: function (dt) {
        console.log(dt.footer());
    }
};

Editor['defaults'] = {
    table: null,
    ajaxUrl: null,
    fields: []
};

$.fn.dataTable.ext.buttons.edit = {
    extend: "selected",
    className: 'buttons-edit buttons-html5',
    text: function (dt) {
        return dt.i18n('buttons.edit', 'Edit');
    },
    action: function (e, dt, button, config) {
        Editor.formRow(dt);
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
