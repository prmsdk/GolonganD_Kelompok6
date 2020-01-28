<section>

  <div class="login-bg">
    <div class="row">
      <div class="col-5">
        <div class="modal fade" id="login_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-light font-m-bold" id="LoginLabel">Login</h5>
                    <button type="button" class="close btn-primary" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row justify-content-center">
                  <form class="font-m-light col-11 mt-3" action="cek_login.php" method="post">
                    <div class="form-group">
                      <label for="username-user" class="font-m-med">Username</label>
                      <input type="text" class="form-control" id="username-user" name="username-user" aria-describedby="usernameHelp" placeholder="Enter username" autofocus required pattern="^[A-Za-z0-9 @_.]+$" title="Username anda harus disertai tanda baca @ di awal">

                      <!-- <div class="^(?=.*[@])[A-Za-z0-9 @_.]+$"> </div?-->
                      
                    </div>
                    <div class="form-group">
                      <label for="password-user" class="font-m-med">Password</label>
                      <input type="password" class="form-control tampil-sandi" id="password-user" name="password-user" placeholder="Password" required>
                      <small id="passwordHelp" class="form-text float-right"><a href="forgot_password.php">Lupa password?</a></small>
                      <div class="form-group form-check float-left">
                        <input type="checkbox" class="form-check-input" id="tampil-sandi">
                        <label class="form-check-label" for="tampil-sandi"><small>Tampilkan Sandi</small></label>
                      </div>
                    </div>
                    
                    <div class="text-center pt-4">
                      <a href="register_user.php" class="text-dark">Belum ada akun?</a>
                    </div>
                  
                </div>
                <div class="modal-footer text-center">
                    <input type="submit" class="btn btn-primary" name="login_user" value="Login">
                </div>
              </div>
              </form>
          </div>
      </div>
      </div>
    </div>
  </div>

</section>