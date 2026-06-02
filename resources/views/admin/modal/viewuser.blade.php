

                <!------------------- Upate  store  modal-------------------->
                
            
                <div class="modal fade" id="viewuser{{$post->id}}">
                    <div class="modal-dialog modal-dialog-centered stock-adjust-modal">
                    <div class="modal-content">
                    <div class="page-wrapper-new p-0">
                    <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                    <div class="page-title">
                    <h4>User Details</h4>
              
                    </div>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body custom-modal-body">

                      
    
                    <div class="row" style="padding-bottom: 5px; margin-bottom:10px;  border-bottom:1px solid #CCCCCC;">
                      <div class="col-lg-4"><span style="color: black; font-size:17px; font-weight:800;">  Name:</span> </div>
                      <div class="col-lg-4"> {{$post->first_name }} {{$post->last_name }}</div>
    
                    </div>

                    <div class="row" style="padding-bottom: 5px; margin-bottom:10px;  border-bottom:1px solid #CCCCCC;">
                        <div class="col-lg-4"><span style="color: black; font-size:17px; font-weight:800;">  Email:</span> </div>
                        <div class="col-lg-4"> {{$post->email }}</div>
      
                      </div>


                      <div class="row" style="padding-bottom: 5px; margin-bottom:10px;  border-bottom:1px solid #CCCCCC;">
                        <div class="col-lg-4"><span style="color: black; font-size:17px; font-weight:800;">  Phone No.:</span> </div>
                        <div class="col-lg-4"> {{$post->phone }}</div>
      
                      </div>


                      <div class="row" style="padding-bottom: 5px; margin-bottom:10px;  border-bottom:1px solid #CCCCCC;">
                        <div class="col-lg-4"><span style="color: black; font-size:17px; font-weight:800;"> Username:</span> </div>
                        <div class="col-lg-4"> {{$post->username }}</div>
      
                      </div>

              

                      <div class="row" style="padding-bottom: 5px; margin-bottom:10px;  border-bottom:1px solid #CCCCCC;">
                        <div class="col-lg-4"><span style="color: black; font-size:17px; font-weight:800;"> Status:</span> </div>
                        <div class="col-lg-4">  
                  @if ($post->status == 1)
        <span class="badge badge-success">Active</span>
    @elseif ($post->status == 0)
        <span class="badge badge-danger">Inactive</span>
    @endif
                          </div>
      
                      </div>

  

                      <div class="row" style="padding-bottom: 5px; margin-bottom:10px;  border-bottom:1px solid #CCCCCC;">
                        <div class="col-lg-4"><span style="color: black; font-size:17px; font-weight:800;"> Date:</span> </div>
                        <div class="col-lg-4"> {{$post->created_at }}</div>
      
                      </div>

                     
                   
                      <div class="modal-footer-btn">
                        <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
      
                        </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
    