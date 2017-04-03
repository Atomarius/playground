var app = {
    init: function () {
        $('#example').DataTable({
            "dom": "Bfrtip",
            "processing": true,
            "serverSide": true,
            "ajax": "data/api.php",
            columns: [
                { data: "first_name" },
                { data: "last_name" },
                { data: "position" },
                { data: "office" },
                { data: "start_date" },
                { data: "salary", render: $.fn.dataTable.render.number( ',', '.', 0, '$' ) }
            ],
            "buttons": [
                "csv", "pdf"
            ]
        });
    }
};

$(document).ready(app.init());
