var app = {
    init: function () {
        $('#example').DataTable({
            "dom": "Bfrtip",
            "processing": true,
            "serverSide": true,
            "ajax": "data/api.php",
            columns: [
                { data: "name" },
                { data: "position" },
                { data: "office" },
                { data: "extn" },
                { data: "start_date" },
                { data: "salary", render: $.fn.dataTable.render.number( ',', '.', 0, '$' ) }
            ],
            "buttons": [
                "csv"
            ]
        });
    }
};

$(document).ready(app.init());
