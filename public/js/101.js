var app = {
    init: function () {
        $.get('data/buttons.php').done(function(buttons) {
            $('#example').DataTable({
                "dom": "Bfrtip",
                "processing": true,
                "serverSide": true,
                "ajax": "data/api.php",
                columns: [
                    { "data": "name" },
                    { "data": "position" },
                    { "data": "office" },
                    { "data": "extn" },
                    { "data": "start_date" },
                    { "data": "salary", render: $.fn.dataTable.render.number( ',', '.', 0, '$' ) }
                ],
                "buttons": JSON.parse(buttons)
            });
        });
    }
};

$(document).ready(app.init());
