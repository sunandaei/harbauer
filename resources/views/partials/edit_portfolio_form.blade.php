<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createPortfolioModalLabel">Edit Portfolio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Form fields for editing portfolio details -->
        <form id="editPortfolioForm" method="post" action="{{ route('updatePortfolio') }}">
        @csrf
        <div class="form-group">
            <label for="portfolioName">Portfolio Name</label>
            <input type="text" class="form-control" id="portfolioName" name="name" placeholder="Enter Portfolio Name" value="{{ $portfolio->name }}">
        </div>
        <div class="form-group">
            <label for="portfolioType">Portfolio Type</label>
            <select class="form-control" id="portfolioType" name="type">
            <option value="equity" {{ $portfolio->type == 'equity' ? 'selected' : '' }}>Equity</option>
            <option value="futures" {{ $portfolio->type == 'futures' ? 'selected' : '' }}>Futures</option>
            <option value="options" {{ $portfolio->type == 'options' ? 'selected' : '' }}>Options</option>
            </select>
        </div>
        <div class="form-group">
            <label for="portfolioInterval">Portfolio Interval</label>
            <select class="form-control" id="portfolioInterval" name="interval">
            <option value="daily" {{ $portfolio->interval == 'daily' ? 'selected' : '' }}>Daily</option>
            <option value="weekly" {{ $portfolio->interval == 'weekly' ? 'selected' : '' }}>Weekly</option>
            <option value="monthly" {{ $portfolio->interval == 'monthly' ? 'selected' : '' }}>Monthly</option>
            </select>
        </div>

        <div class="form-group">
            <label for="portfolioRemark">Remark</label>
            <textarea class="form-control" id="portfolioRemark" name="remarks">{{ $portfolio->remarks }}</textarea>
        </div>
        <input type="hidden" name="_id" value="{{ $portfolio->_id }}">
        <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
</div>
