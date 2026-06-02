<!-- Edit Modal -->
  <div class="modal fade" id="editShippingModal{{ $address->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="{{ route('shipping.update', $address->id) }}">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h5 class="modal-title">Edit Shipping Address</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label>Full Name</label>
              <input type="text" name="fullname" value="{{ $address->fullname }}" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Phone</label>
              <input type="text" name="phone" value="{{ $address->phone }}" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Address</label>
              <textarea name="address" class="form-control" required>{{ $address->address }}</textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>