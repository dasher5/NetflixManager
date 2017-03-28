
  <div class="form">
    <form action="<?= BASE_URL ?>/register" method="post">
      <div class="form-group">
        <label for="name">First Name</label>
        <input type="text" class="form-control" name="fn" required>
      </div>

      <div class="form-group">
        <label for="name">Last Name</label>
        <input type="text" class="form-control" name="ln" required>
      </div>

      <div class="form-group">
        <label for="mail">E-mail</label>
        <input type="email" class="form-control" name="em" required>
      </div>

      <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="pw" required>
      </div>

      <input class="btn btn-primary" type="submit" name="submit" value="Sign Up">
    </form>
  </div>

</div>
