

<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Signup Now</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  action="/forums/partials/_signuphandel.php" method="post">
      <div class="modal-body">
  <div class="form-group">
    <label for="userName">Username</label>
    <input type="text" class="form-control"   name="userName" id="userName">
</div>
    <div class="form-group">
    <label for="signupEmail">Email</label>
    <input type="email" class="form-control" name="signupEmail" id="signupEmail" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="signupPassword">Password</label>
    <input type="password" class="form-control"  name="signupPassword" id="signupPassword">
  </div>
  <div class="form-group">
    <label for="signupcPassword">Confirm Password</label>
    <input type="password" class="form-control" name="signupcPassword" id="signupcPassword">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>