@extends('layouts.app')

@section('title', 'Add Position')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Add Position</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form method="POST" action="{{ route('portfolio.store') }}">
            @csrf

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="script">Script Name</label>
                        <select id="script" name="script" class="form-control">
                            @foreach($scripts as $script)
                            <option value="{{ $script }}">{{ $script }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="segment">Segment</label>
                        <select id="segment" name="segment" class="form-control">
                            @foreach($segments as $segment)
                            <option value="{{ $segment }}">{{ $segment }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="expiry">Expiry</label>
                        <select id="expiry" name="expiry" class="form-control">
                            @foreach($expiries as $expiry)
                            <option value="{{ $expiry }}">{{ $expiry }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3" id="optionDropdown" style="display: none;">
                    <div class="form-group">
                        <label for="option">Option</label>
                        <select id="option" name="option" class="form-control">
                            <option value="call">Call</option>
                            <option value="put">Put</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3" id="strickDropdown" style="display: none;">
                    <div class="form-group">
                        <label for="strickOption">Strike Option</label>
                        <select id="strickOption" name="strickOption" class="form-control">
                            <!-- Options will be dynamically added here -->
                        </select>
                    </div>
                </div>

                <!-- Price Input Box -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" id="price" name="price" class="form-control" step="0.01" placeholder="Enter price" required>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="note">Note</label>
                        <textarea id="note" name="note" class="form-control" rows="3" placeholder="Enter note"></textarea>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group d-flex align-items-end justify-content-between">
                        <div>
                            <label for="action">Action</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="action" id="buy" value="buy" checked>
                                <label class="form-check-label" for="buy">Buy</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="action" id="sell" value="sell">
                                <label class="form-check-label" for="sell">Sell</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Position</button>
                    </div>
                </div>

            </div>

        </form>
    </div>
    <!-- /.card-body -->
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to update other fields based on the selected script and segment
        function updateFields() {
            var segment = document.getElementById('segment').value;
            var script = document.getElementById('script').value;
            var strickOptionDropdown = document.getElementById('strickOption');

            // Clear existing options
            strickOptionDropdown.innerHTML = '';

            if (segment === 'Options' && script === 'Script A') {
                // Options for Script A and Options
                for (var i = 22000; i <= 30000; i += 50) {
                    var option = document.createElement('option');
                    option.value = i;
                    option.textContent = i;
                    strickOptionDropdown.appendChild(option);
                }
                document.getElementById('strickDropdown').style.display = 'block';
                document.getElementById('optionDropdown').style.display = 'block';

            } else if (script === 'Script B') {
                // Options for Script B
                for (var i = 45000; i <= 50000; i += 100) {
                    var option = document.createElement('option');
                    option.value = i;
                    option.textContent = i;
                    strickOptionDropdown.appendChild(option);
                }
                document.getElementById('strickDropdown').style.display = 'block';
                document.getElementById('optionDropdown').style.display = 'block';
                
            } else {
                document.getElementById('strickDropdown').style.display = 'none';
                 document.getElementById('optionDropdown').style.display = 'none';
            }
        }

        // Add event listeners to update fields when script or segment changes
        document.getElementById('segment').addEventListener('change', updateFields);
        document.getElementById('script').addEventListener('change', updateFields);
        
        // Trigger updateFields initially
        updateFields();
    });
</script>


@endsection
