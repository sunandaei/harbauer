
<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css"> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css"> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/2.0.0/css/select.dataTables.css"> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css"> 
<link rel="stylesheet" type="text/css" href="https://editor.datatables.net/extensions/Editor/css/editor.dataTables.css"> 

  <!-- iCheck -->
  <link rel="stylesheet" href="http://127.0.0.1:8000/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="http://127.0.0.1:8000/adminlte/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="http://127.0.0.1:8000/adminlte/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="http://127.0.0.1:8000/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="http://127.0.0.1:8000/adminlte/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="http://127.0.0.1:8000/adminlte/plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
   
        <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>First name</th>
                <th>Last name</th>             
            </tr>
        </thead>
    </table>
   

    <!-- jQuery -->
<script src="http://127.0.0.1:8000/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="http://127.0.0.1:8000/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="http://127.0.0.1:8000/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>


<script type="text/javascript" src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/2.0.0/js/dataTables.select.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/2.0.0/js/select.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/datetime/1.5.2/js/dataTables.dateTime.min.js"></script>
<script type="text/javascript" src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.js"></script>
<script type="text/javascript" src="https://editor.datatables.net/extensions/Editor/js/editor.dataTables.js"></script>




<script type="text/javascript">
    $('#expandable-table-header-row').ExpandableTable('toggleRow')
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() 
    {
        const editor = new DataTable.Editor({
    ajax: 'test1.php',
    fields: [
        {
            label: 'First name:',
            name: 'first_name'
        },
        {
            label: 'Last name:',
            name: 'last_name'
        }
    ],
    table: '#example'
});
 
const table = new DataTable('#example', {
    ajax: 'test1.php',
    columns: [
        {
            data: null,
            orderable: false,
            render: DataTable.render.select()
        },
        { data: 'first_name' },
        { data: 'last_name' }
    ],
    layout: {
        topStart: {
            buttons: [
                { extend: 'create', editor: editor },
                { extend: 'edit', editor: editor },
                { extend: 'remove', editor: editor }
            ]
        }
    },
    order: [[1, 'asc']],
    select: {
        style: 'os',
        selector: 'td:first-child'
    }
});
 
// Activate an inline edit on click of a table cell
table.on('click', 'tbody td:not(:first-child)', function (e) {
    editor.inline(this);
});
       
    });
</script>


</body>
</html>

