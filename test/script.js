$(document).ready(function() {
    var table;

    $.ajax({
        url: 'data.php',
        dataType: 'json',
        success: function(data) {
            renderTable(data);
        },
        error: function(xhr, status, error) {
            console.error(status + ': ' + error);
        }
    });

    function renderTable(data) {
        table = $('#example').DataTable({
            data: data,
            columns: [
                { title: "Name" },
                { title: "Position" },
                { title: "Office" },
                { title: "Age" },
                { title: "Start Date" },
                { title: "Salary" }
            ],
            columnDefs: [{
                targets: '_all',
                className: 'editable'
            }]
        });

        $('#example').on('click', 'tbody td.editable', function() {
            var cell = table.cell(this);
            var columnIndex = cell.index().column;
            var rowIndex = cell.index().row;

            var originalValue = cell.data();
            var newValue = prompt("Enter new value", originalValue);

            if (newValue !== null && newValue !== originalValue) {
                cell.data(newValue);
                updateData(rowIndex, columnIndex, newValue);
            }
        });
    }

    function updateData(row, column, value) {
        var rowData = table.row(row).data();
        rowData[column] = value;
        table.row(row).data(rowData).draw();
    }
});
