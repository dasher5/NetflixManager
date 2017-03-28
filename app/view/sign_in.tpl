
  <div class="form">
    <form action="<?= BASE_URL ?>/process_sign_in" method="post">
      <div class="form-group">
        <label for="mail">E-mail</label>
        <input type="email" class="form-control" name="em" required>
      </div>

      <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="pw" required>
      </div>

      <input class="btn btn-primary" type="submit" name="submit" value="Sign In">
    </form>
  </div>

</div>
