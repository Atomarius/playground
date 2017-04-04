var app = {
    init: function () {
            $('#example').DataTable({
                "dom": "Bfrtip",
                "select": true,
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
                "buttons": [
                    "csv",
                    app.buttons.edit
                ]
        });
    },
    buttons: {
        edit: {
            className: 'buttons-edit buttons-html5',
            text: function ( dt ) {
                return dt.i18n( 'buttons.edit', 'Edit' );
            },
            action: function ( e, dt, button, config ) {
                alert(JSON.stringify(dt.row('.selected').data()));
            }
        }
    }
};

$(document).ready(app.init());
