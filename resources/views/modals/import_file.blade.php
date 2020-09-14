<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import transactions from bank</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('uploadTransactions') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="bank">Example select</label>
                        <select class="form-control" id="bank" name="bank">
                            <option>Knab</option>
                            <option>Sns</option>
                            <option>TBD ING</option>
                            <option>TBD Rabo</option>
                            <option>TBD ABN Amro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="transactionsFile">.csv file containing transactions</label>
                        <input type="file" class="form-control-file" id="transactionsFile" name="csv">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
