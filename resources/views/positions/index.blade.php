@extends('layouts.app')

@section('title', 'Position Index')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Position Index</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <button class="btn btn-danger mb-2" id="deleteSelected">Delete Selected</button>
        <form id="deleteSelectedForm" action="{{ route('position.deleteSelected') }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
            <input type="hidden" id="selectedPositions" name="selectedPositions">
        </form>
        <table id="positionTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th></th> <!-- Checkbox column -->
                    <th>ID</th>
                    <th>Script</th>
                    <th>Segment</th>
                    <th>Expiry</th>
                    <th>Entry Price</th>
                    <th>Current Price</th>
                    <th>Exit Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($positions as $position)
                <tr>
                    <td><input type="checkbox" class="position-checkbox" value="{{ $position->id }}"></td> <!-- Checkbox for each position -->
                    <td>{{ $position->id }}</td>
                    <td class="editable">{{ $position->script }}</td>
                    <td class="editable">{{ $position->segment }}</td>
                    <td class="editable">{{ $position->expiry }}</td>
                    <td class="editable">{{ $position->entry_price }}</td>
                    <td class="editable">{{ $position->current_price }}</td>
                    <td class="editable">{{ $position->exit_price }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm editBtn">Edit</button>
                        <button class="btn btn-danger btn-sm deleteBtn">Delete</button>
                        <button class="btn btn-success btn-sm saveBtn" style="display: none;">Save</button>
                        <button class="btn btn-danger btn-sm cancelBtn" style="display: none;">Cancel</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() 
    {
        
        // Handle delete selected button click
        document.getElementById('deleteSelected').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.position-checkbox:checked');
            if (checkboxes.length === 0) {
                alert('Please select at least one position to delete.');
            } else {
                if (confirm('Are you sure you want to delete selected positions?')) {
                    const selectedPositions = [];
                    checkboxes.forEach(checkbox => {
                        selectedPositions.push(checkbox.value);
                    });
                    document.getElementById('selectedPositions').value = JSON.stringify(selectedPositions);
                    document.getElementById('deleteSelectedForm').submit();
                }
            }
        });
    });
</script>

@endsection
