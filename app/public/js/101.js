var app = {
    init: function () {
        $('#example').DataTable({
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
                {"data": "salary", render: $.fn.dataTable.render.number(',', '.', 0, '$')}
            ],
            "buttons": [
                "csv",
                "edit"
            ]
        });
    }
};

$(document).ready(app.init());
