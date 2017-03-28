var app = {
    init: function () {
        $('#example').DataTable({
            "ajax": "data/arrays.json"
        });
    }
};

$(document).ready(app.init);