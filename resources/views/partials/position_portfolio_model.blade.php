<div class="modal fade" id="createPortfolioModal" tabindex="-1" role="dialog" aria-labelledby="createPortfolioModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createPortfolioModalLabel">Create Portfolio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="createPortfolioForm">
          @csrf
          <div class="form-group">
              <label for="portfolioName">Portfolio Name</label>
              <input type="text" class="form-control" id="portfolioName" name="name" placeholder="Enter Portfolio Name">
          </div>
          <div class="form-group">
              <label for="portfolioType">Portfolio Type</label>
              <select class="form-control" id="portfolioType" name="type">
                  <option value="equity">Equity</option>
                  <option value="futures">Futures</option>
                  <option value="options">Options</option>
              </select>
          </div>
          <div class="form-group">
              <label for="portfolioInterval">Portfolio Interval</label>
              <select class="form-control" id="portfolioInterval" name="interval">
                  <option value="daily">Daily</option>
                  <option value="weekly">Weekly</option>
                  <option value="monthly">Monthly</option>
              </select>
          </div>

          <div class="form-group">
              <label for="remark">Remark</label>
              <textarea class="form-control" id="portfolioRemark" name="remarks"></textarea>       
          </div>
          <input type="hidden" name="collectionName" value="Portfolio">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="savePortfolio()">Save changes</button>
      </div>
    </div>
  </div>
</div>