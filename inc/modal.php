<!-- Modal Confirm Delete -->
<div class="modal fade" id="modal-delete-<?= $product['product_id'] ?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Do you want to delete product <strong><?= $product['product_name'] ?></strong> ?</p>
            </div>
            <div class="modal-footer">
                <a href="delete.php?product_id=<?= $product['product_id'] ?>" class="btn btn-outline-success">Save changes</a>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->