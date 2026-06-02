<!-- Modal -->
<div class="modal fade" id="addShippingModal" tabindex="-1" aria-labelledby="addShippingModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="addShippingModalLabel">Add Shipping Address</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form method="POST" action="{{ route('shipping.store') }}">
        @csrf
        <div class="modal-body">
          <div class="form-group mb-3">
            <label>Full Name</label>
            <input type="text" name="fullname" value="{{ old('fullname') }}" class="form-control" required>
          </div>

          <div class="form-group mb-3">
            <label>Phone</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" required>
          </div>

          <div class="form-group mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control" required>{{ old('address') }}</textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Address</button>
        </div>
      </form>

    </div>
  </div>
</div>