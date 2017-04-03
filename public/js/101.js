var app = {
    init: function () {
        $('#example').DataTable({
            dom: "Bfrtip",
            ajax: "data/arrays.json",
            buttons: [
                "csv", "pdf"
            ]
        });
    }
};

$(document).ready(app.init());
