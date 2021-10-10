

<!-- Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Send Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
        <input type="hidden" name="" id='senderId' >

        <input type="hidden" name="" id='recieverId' >
        <textarea class="form-control" name="" id="messageValue" cols="30" rows="10"></textarea>
        
        
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
        <button id="sendMessage" type="button" class="btn btn-primary">SEND MESSAGE</button>
      </div>
    </div>
  </div>
</div>