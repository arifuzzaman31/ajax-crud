
<!-- Modal -->
<div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" data-toogle="validator">
            @csrf {{ method_field('post')}}
            <div class="form-group">
            <input type="hidden" name="id" id="id">
              <label for="exampleInputPassword1">Name</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Name">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Phone</label>
              <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email</label>
              <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Religion</label>
                <select class="form-control" id="religion" name="religion">
                  <option value="muslim">Muslim</option>
                  <option value="hindu">Hindu</option>
                  <option value="christian">Christian</option>
                  <option value="buddishsm">Buddihsm</option>
                  <option value="other">Other</option>
                </select>
            </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="insertbotton"></button>
        </form>
      </div>
      </div>
    </div>
  </div>
</div>

<!-- Show single Data -->

<div class="modal fade" id="single-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel" align="center"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
 
      </div>
      <div class="modal-body">
        <ul class="list-group">
      <li class="list-group-item">ID: <span class="text-danger" id="contactid"></span></li>
      <li class="list-group-item">Name: <span class="text-danger" id="fullname"></span> </li>
      <li class="list-group-item">Email: <span class="text-danger" id="contactemail"></span></li>
      <li class="list-group-item">Phone: <span class="text-danger" id="contactnumber"></span></li>
      <li class="list-group-item">Religion: <span class="text-danger" id="creligion"></span></li>
    </ul>
    </div>
  </div>
</div>