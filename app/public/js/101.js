var app = {
    init: function () {
        var editor = new Editor({
            'ajaxUrl': "data/post.php",
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
                    className: 'buttons-edit buttons-html5',
                    text: function (dt) {
                        return dt.i18n('buttons.edit', 'Edit');
                    },
                    action: function (e, dt, button, config) {
                        editor.edit(dt);
                        console.log(dt.ajax);
                    }
                }
            ]
        });
        var form = editor.form();
        $('[type=submit]', form).click(function (e) {
            e.preventDefault();
            $.ajax({
                url: form.attr('action'),
                data: $(form).serialize(),
                type: form.attr('method'),
                success: function () {
                    $('input', form).not('[type=submit]').each(function () {
                        $(this).attr('value', '')
                    });
                    table.ajax.reload();
                }
            });
        });
    }
};

$(document).ready(app.init());
