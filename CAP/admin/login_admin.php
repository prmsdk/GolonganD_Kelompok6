<section>

  <div class="login-bg">
    <div class="row">
      <div class="col-5">
        <div class="modal fade" id="login_admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-biru-tua">
                    <h5 class="modal-title text-light font-m-bold ml-3" id="LoginLabel">Login Admin</h5>
                    <button type="button" class="close btn bg-biru-tua" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row justify-content-center">
                  <form class="font-m-light col-11 mt-3" action="cek_login_admin.php" method="post">
                    <div class="form-group">
                      <label for="username-admin" class="font-m-med">Username</label>
                      <input type="text" class="form-control" id="username-admin" name="username-admin" aria-describedby="usernameHelp" placeholder="Enter username" required autofocus>
                      
                    </div>
                    <div class="form-group">
                      <label for="password-admin" class="font-m-med">Password</label>
                      <input type="password" class="form-control tampil-sandi" id="password-admin" name="password-admin" placeholder="Password" required>
                      <small id="passwordHelp" class="form-text float-right"><a href="forgot_password.php">Lupa password?</a></small>
                      <div class="form-group form-check float-left">
                        <input type="checkbox" class="form-check-input" id="tampil-sandi">
                        <label class="form-check-label" for="tampil-sandi"><small>Tampilkan Sandi</small></label>
                      </div>
                    </div>
                  
                </div>
                <div class="modal-footer text-center">
                    <input type="submit" class="btn btn-primary" name="login_admin" value="Login">
                </div>
              </div>
              </form>
          </div>
      </div>
      </div>
    </div>
  </div>

</section>