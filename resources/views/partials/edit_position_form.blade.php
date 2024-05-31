<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editPositionModalLabel">Edit Position</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- Content for editing positions will be loaded here -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Position</h3>
                </div>
    <div class="card-body">
        <form method="POST" action="{{ route('position.update', ['position' => $position->id]) }}">
            @csrf
            <input type="hidden" name="position_id" value="{{ $position->id }}">
            <div class="row">
                <!-- First Column -->
            <div class="col-md-4">
            <div class="form-group">
                <label for="script">Script Name</label>
                <select id="scriptEdit" name="script" class="form-control">
                    @foreach($scripts as $script)
                    <option value="{{ $script }}" {{ $script == $position->script ? 'selected' : '' }}>{{ $script }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="segment">Segment</label>
                <select id="segmentEdit" name="segment" class="form-control">
                    @foreach($segments as $segment)
                    <option value="{{ $segment }}" {{ $segment == $position->segment ? 'selected' : '' }}>{{ $segment }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="expiry">Expiry</label>
                <select id="expiryEdit" name="expiry" class="form-control">
                    @foreach($expiries as $expiry)
                    <option value="{{ $expiry }}" {{ $expiry == $position->expiry ? 'selected' : '' }}>{{ $expiry }}</option>
                    @endforeach
                </select>
            </div>
            </div>
            <!-- Second Column -->
            <div class="col-md-4">
                <div class="form-group" id="optionDropdownEdit" style="display: none;">
                    <label for="option">Option</label>
                    <select id="option" name="option" class="form-control">
                        <option value="call" {{ $position->option == 'call' ? 'selected' : '' }}>Call</option>
                        <option value="put" {{ $position->option == 'put' ? 'selected' : '' }}>Put</option>
                    </select>
                </div>
                <div class="form-group" id="strikeDropdownEdit" style="display: none;">
                    <label for="strikeOption">Strike Option</label>
                    <select id="strikeOptionEdit" name="strickOption" class="form-control">
                        <!-- Options will be dynamically added here -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="entry_price">Entry Price</label>
                    <input type="number" id="entry_price" name="entry_price" class="form-control" step="0.01" placeholder="Enter entry price" value="{{ $position->entry_price }}" required>
                </div>
            </div>
            <!-- Third Column -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="current_price">Current Price</label>
                    <input type="number" id="current_price" name="current_price" class="form-control" step="0.01" placeholder="Enter current price" value="{{ $position->current_price }}" required>
                </div>
                <div class="form-group">
                    <label for="exit_price">Exit Price</label>
                    <input type="number" id="exit_price" name="exit_price" class="form-control" step="0.01" placeholder="Enter exit price" value="{{ $position->exit_price }}" required>
                </div>
                <div class="form-group">
                    <label for="note">Note</label>
                    <textarea id="note" name="note" class="form-control" rows="3" placeholder="Enter note">{{ $position->note }}</textarea>
                </div>
                <div class="form-group">
                    <label for="action">Action</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="action" id="buy" value="buy" {{ $position->action == 'buy' ? 'checked' : '' }}>
                        <label class="form-check-label" for="buy">Buy</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="action" id="sell" value="sell" {{ $position->action == 'sell' ? 'checked' : '' }}>
                        <label class="form-check-label" for="sell">Sell</label>
                    </div>
                </div>
            </div>
            </div>
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
