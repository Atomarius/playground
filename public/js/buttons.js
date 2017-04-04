$.fn.dataTable.ext.buttons.edit = {
    extend: "selected",
    className: 'buttons-edit buttons-html5',
    text: function ( dt ) {
        return dt.i18n( 'buttons.edit', 'Edit' );
    },
    action: function ( e, dt, button, config ) {
        alert(JSON.stringify(dt.row('.selected').data()));
    }
};
$.fn.dataTable.ext.buttons.delete = {
    extend: "selected",
    className: 'buttons-delete buttons-html5',
    text: function ( dt ) {
        return dt.i18n( 'buttons.delete', 'Delete' );
    },
    action: function ( e, dt, button, config ) {
        alert(JSON.stringify(dt.row('.selected').data()));
    }
};
