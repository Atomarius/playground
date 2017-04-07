var Editor = {
    formTemplate: '<form action="%action%" name="%name%">%innerHtml%</form>',
    form: function (dt) {
        this.formTemplate.replace('%action%', dt.ajax.url());
        console.log(this.formTemplate.replace('%action%', dt.ajax.url()).replace('%name%', dt.template));
    },
    inputTemplate: '<label for="%id%"></label><input type="%type%" id="%id%" value="%value%">',
    text: function (name, value) {
        return this.inputTemplate.replace('%type%', 'text').replace('%name%', name).replace('%value%', value);
    },
    formRow: function (row) {
        console.log(row);
    }
};

$.fn.dataTable.ext.buttons.edit = {
    extend: "selected",
    className: 'buttons-edit buttons-html5',
    text: function (dt) {
        return dt.i18n('buttons.edit', 'Edit');
    },
    action: function (e, dt, button, config) {
        Editor.formRow(dt.row('.selected'));
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
