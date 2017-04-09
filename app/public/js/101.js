var app = {
    init: function () {
        var table = $('#example').DataTable({
            "dom": "Brtip",
            "select": true,
            "processing": false,
            "serverSide": false,
            "ajax": "data/api.json",
            columns: [
                {"data": name},
                {"data": "position"},
                {"data": "office"},
                {"data": "extn"},
                {"data": "start_date"},
                {"data": "salary", render: $.fn.dataTable.render.number(',', '.', 0, '$')},
                {"data": null, defaultContent: '', sortable: false}
            ],
            "buttons": [
                "csv",
                "edit"
            ]
        });
        var editor = Editor.create({
            'ajaxUrl': table.ajax().url(),
            fields: [
                {name: "name"},
                {name: "position"},
                {name: "office"},
                {name: "extn"},
                {name: "start_date"},
                {name: "salary"}
                ]
        });
    }
};

$(document).ready(app.init());
