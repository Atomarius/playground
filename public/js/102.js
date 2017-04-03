var app = {
    init: function () {
        $('#example').DataTable({
            "ajax": "data/arrays.json"
        });
    }
};

var Editor = {
    restore: function ( oTable, nRow )
    {
        var aData = oTable.fnGetData(nRow);
        var jqTds = $('>td', nRow);

        for ( var i=0, iLen=jqTds.length ; i<iLen ; i++ ) {
            oTable.fnUpdate( aData[i], nRow, i, false );
        }

        oTable.fnDraw();
    },
    edit: function ( oTable, nRow )
    {
        var aData = oTable.fnGetData(nRow);
        var jqTds = $('>td', nRow);
        jqTds[0].innerHTML = '<input type="text" value="'+aData[0]+'">';
        jqTds[1].innerHTML = '<input type="text" value="'+aData[1]+'">';
        jqTds[2].innerHTML = '<input type="text" value="'+aData[2]+'">';
        jqTds[3].innerHTML = '<input type="text" value="'+aData[3]+'">';
        jqTds[4].innerHTML = '<input type="text" value="'+aData[4]+'">';
        jqTds[5].innerHTML = '<a class="edit" href="">Save</a>';
    },
    save: function ( oTable, nRow )
    {
        var jqInputs = $('input', nRow);
        oTable.fnUpdate( jqInputs[0].value, nRow, 0, false );
        oTable.fnUpdate( jqInputs[1].value, nRow, 1, false );
        oTable.fnUpdate( jqInputs[2].value, nRow, 2, false );
        oTable.fnUpdate( jqInputs[3].value, nRow, 3, false );
        oTable.fnUpdate( jqInputs[4].value, nRow, 4, false );
        oTable.fnUpdate( '<a class="edit" href="">Edit</a>', nRow, 5, false );
        oTable.fnDraw();
    }
};


$(document).ready(function() {
    var oTable = $('#example').dataTable({
        "ajax": "data/arrays.json"
    });
    var nEditing = null;

    $('#new').click( function (e) {
        e.preventDefault();

        var aiNew = oTable.fnAddData( [ '', '', '', '', '',
            '<a class="edit" href="">Edit</a>', '<a class="delete" href="">Delete</a>' ] );
        var nRow = oTable.fnGetNodes( aiNew[0] );
        Editor.edit( oTable, nRow );
        nEditing = nRow;
    } );

    $('#example a.delete').click(function (e) {
        e.preventDefault();

        var nRow = $(this).parents('tr')[0];
        oTable.fnDeleteRow( nRow );
    } );

    $('#example a.edit').click( function (e) {
        e.preventDefault();

        /* Get the row as a parent of the link that was clicked on */
        var nRow = $(this).parents('tr')[0];

        if ( nEditing !== null && nEditing != nRow ) {
            /* Currently editing - but not this row - restore the old before continuing to edit mode */
            Editor.restore( oTable, nEditing );
            Editor.edit( oTable, nRow );
            nEditing = nRow;
        }
        else if ( nEditing == nRow && this.innerHTML == "Save" ) {
            /* Editing this row and want to save it */
            Editor.save( oTable, nEditing );
            nEditing = null;
        }
        else {
            /* No edit in progress - let's start one */
            Editor.edit( oTable, nRow );
            nEditing = nRow;
        }
    } );
} );
