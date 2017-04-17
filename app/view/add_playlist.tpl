
<div class="search">
  <form action="<?= BASE_URL ?>/process_sign_in" method="post">
      <div class="form-group">
        <input type="search" class="form-control" name="search" required>
      </div>
      <div>
        <input class="btn btn-primary" type="submit" name="submit" value="Search">
      </div>
  </form>
</div>

<div class="form">
  <form action="<?= BASE_URL ?>/create_playlist" method="post">
    <div class="form-group">
      <label for="name">Playlist Name</label>
      <input type="text" class="form-control" name="playlist_name" required>
    </div>

    <input class="btn btn-primary" type="submit" name="submit" value="Create Playlist">
  </form>
</div>

</div>
