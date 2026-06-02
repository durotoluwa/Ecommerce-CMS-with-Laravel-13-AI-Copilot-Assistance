

                <!------------------- Upate  store  modal-------------------->
                
            
            <div class="modal fade" id="deleteproduct{{$product->id}}">
                <div class="modal-dialog modal-dialog-centered stock-adjust-modal">
                <div class="modal-content">
                <div class="page-wrapper-new p-0">
                <div class="content">
                <div class="modal-header border-0 custom-modal-header">
                <div class="page-title">
                <h4>Are you sure?</h4>
                </div>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body custom-modal-body">

                <div class="row">
                    
                    <p>Do you really want to delete these Product? This process cannot be undone.</p>
                  
                    <div class="modal-footer-btn">
                        <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                        

                      <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-submit">Delete</button>
</form>

                        
                        </div>

                    

                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
           