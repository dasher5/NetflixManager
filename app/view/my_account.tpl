  <div style="text-align: center;">
    <h2>Change Your Password</h2>
  </div>

  <div class="form">
    <form action="<?= BASE_URL ?>/change_password/<?= $_GET['user_id'] ?>" method="post">
      <div class="form-group">
          <label for="password">Current Password</label>
          <input type="password" class="form-control" name="current_pw" required>
      </div>

      <div class="form-group">
          <label for="password">New Password</label>
          <input type="password" class="form-control" name="new_pw" required>
      </div>

      <div class="form-group">
          <label for="password">Retype Password</label>
          <input type="password" class="form-control" name="retype_pw" required>
      </div>

      <input class="btn btn-primary" type="submit" name="submit" value="Submit">
    </form>
  </div>

  <div style="width: 100%; text-align: center;">
    <h2>Delete Your Account</h2>
    <p>Once this is done all of your data will be lost and you will no longer be able
      to access this account</p>
    <button id="delete" class="btn btn-danger" type="submit">DELETE ACCOUNT</button>
  </div>

  <div style="display: none;" id="delete-form" class="form">
    <form action="<?= BASE_URL ?>/delete_account/<?= $_GET['user_id'] ?>" method="post">
      <div class="form-group">
        <input type="password" class="form-control" name="pw" placeholder="Enter Password" required>
      </div>
    </form>
  </div>

  <script>
  $( "#delete" ).click(function() {
    $( "#delete-form" ).toggle();
  });
  </script>

</div>
