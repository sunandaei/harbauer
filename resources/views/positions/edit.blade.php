@extends('layouts.app')

@section('title', 'Position Index')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Position Index</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example" class="display" cellspacing="0" width="100%">

        <table id="exampleTable" class="table table-bordered table-striped display">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    
                </tr>                
            </thead>
            <tbody>
               
                <tr>
                    <td>Name</td>
                    <td>Position</td>
                    <td>Office</td>
                   
                </tr>

                <tr>
                    <td>Name</td>
                    <td>Position</td>
                    <td>Office</td>
                </tr>

                <tr>
                    <td>Name</td>
                    <td>Position</td>
                    <td>Office</td>
                </tr>

                <tr>
                    <td>Name</td>
                    <td>Position</td>
                    <td>Office</td>
                </tr>

                <tr>
                    <td>Name</td>
                    <td>Position</td>
                    <td>Office</td>
                </tr>
               
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<script>
    $(document).ready(function() {
    var editor = new $.fn.dataTable.Editor({
        ajax: "your-server-side-script.php",
        table: "#exampleTable",
        fields: [
            { label: "Name:", name: "name" },
            { label: "Position:", name: "position" },
            { label: "Office:", name: "office" }
            // Add more fields as needed
        ]
    });

    $('#exampleTable').DataTable({
        ajax: "your-server-side-script.php",
        columns: [
            { data: "name" },
            { data: "position" },
            { data: "office" }
            // Add more columns as needed
        ],
        select: true,
        buttons: [
            { extend: "create", editor: editor },
            { extend: "edit", editor: editor },
            { extend: "remove", editor: editor }
        ]
    });
});

</script>

@endsection
