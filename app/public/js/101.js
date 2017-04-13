var app = {
    init: function () {
        var editor = new Editor({
            ajax: "data/post.php",
            form: 'example',
            fields: [
                {name: "name"},
                {name: "position"},
                {name: "office"},
                {name: "extn"},
                {name: "start_date", type: "datetime"},
                {name: "salary"}
            ]
        });
        var table = $('#example').DataTable({
            "dom": "Brtip",
            "select": true,
            "processing": false,
            "serverSide": false,
            "ajax": "data/api.json",
            columns: [
                {"data": "name"},
                {"data": "position"},
                {"data": "office"},
                {"data": "extn"},
                {"data": "start_date"},
                {"data": "salary", render: $.fn.dataTable.render.number(',', '.', 0, '$')},
                {"data": null, defaultContent: '', sortable: false}
            ],
            "buttons": [
                "csv",
                {
                    extend: "selected",
                    className: 'btn-primary',
                    text: function (dt) {
                        return dt.i18n('buttons.edit', 'Edit');
                    },
                    action: function (e, dt, button, config) {
                        editor.edit(dt);
                    }
                }
            ]
        });
        var form = editor.form();
        $('[type=submit]', form).click(function (e) {
            e.preventDefault();
            editor.form().submit().done(function () {
                editor.form().reset();
                table.ajax.reload();
            }).fail(function () {alert('Fail')});
        });
    }
};

$(document).ready(app.init());
