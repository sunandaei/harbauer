<div class="modal fade" id="addPositionModal" tabindex="-1" role="dialog" aria-labelledby="addPositionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document"> <!-- Add the modal-lg class for wider modal -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addPositionModalLabel">Add Position</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Content for adding positions will be loaded here -->

        <div class="card">
         <div class="card-header">
          <h3 class="card-title">Add Position</h3>
         </div>
            <!-- /.card-header -->
         <div class="card-body">
          <form method="POST" action="{{ route('position.store') }}">
          @csrf
          <input type="input" name="portfolio_id" id="portfolio_id" value="{{$pItem->id}}">
          <div class="row">
           <div class="col-md-3">
            <div class="form-group">
             <label for="script">Script Name</label>
             <select id="script" name="script" class="form-control">
             @foreach($scripts as $script)
              <option value="{{ $script->underlying}}">{{ $script->underlying}}-{{ $script->underlyingValue}}</option>
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
                <option value="{{ $expiry->expiryDate }}">{{ $expiry->expiryDate }}</option>
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

            <!-- Entry Price Input Box -->
            <div class="col-md-3">
              <div class="form-group">
                <label for="entry_price">Entry Price</label>
                <input type="number" id="entry_price" name="entry_price" class="form-control" step="0.01" placeholder="Enter entry price" required>
               </div>
            </div>

            <!-- Current Price Input Box -->
            <div class="col-md-3">
              <div class="form-group">
                <label for="current_price">Current Price</label>
                <input type="number" id="current_price" name="current_price" class="form-control" step="0.01" placeholder="Enter current price" required>
               </div>
            </div>

            <!-- Exit Price Input Box -->
            <div class="col-md-3">
              <div class="form-group">
                <label for="exit_price">Exit Price</label>
                <input type="number" id="exit_price" name="exit_price" class="form-control" step="0.01" placeholder="Enter exit price" required>
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
               </div>
                <button type="submit" class="btn btn-primary">Add Position</button>
               </div>

            </div>
          </form>
         </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>        
    </div>
    </div>
  </div>
</div>
@push('scripts')

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

@endpush