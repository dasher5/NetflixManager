<?php if (!isset($_SESSION['user'])) { ?>
  <p class="purpose">An easy way to create your own Netflix playlists</p>

  <div class="icons">
    <div>
      <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
      <p>Create customized playlists</p>
    </div>
    <div>
      <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
      <p>Search for content to add to lists</p>
    </div>
    <div>
      <span class="glyphicon glyphicon-play" aria-hidden="true"></span>
      <p>Watch your favorite content</p>
    </div>
  </div>

  <div class="sign-up">
    <a href="<?= BASE_URL ?>/sign_up"><button type="button" class="btn btn-primary btn-lg">Sign Up Now!</button></a>
  </div>
  <?php } else { ?>

  <div class="search">
    <form action="<?= BASE_URL ?>/search" method="post">
        <div class="form-group">
          <input type="search" class="form-control" name="search_query" required>
        </div>
        <div>
          <input class="btn btn-primary" type="submit" name="submit" value="Search">
        </div>
    </form>
  </div>

  <!-- <a href="<?= BASE_URL ?>/script">run script</a> -->

  <div class "playlist-container">
    <div class="playlist-header">
      <div class="your-playlists">
        <span>Your Playlists</span>
      </div>
      <div class="add">
        <a href="<?= BASE_URL ?>/add_playlist"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
      </div>
    </div>
    <div class="playlists">
      <?php for($i = 0; $i < count($rows); $i++) { ?>
        <div class="playlist_preview">
          <a href="<?= BASE_URL ?>/playlist/<?= $rows[$i]['playlist_id'] ?>"><img src=""></br></a>
          <a href="<?= BASE_URL ?>/playlist/<?= $rows[$i]['playlist_id'] ?>"><?= $rows[$i]['playlist_name'] ?></a>
        </div>
      <?php } ?>
    </div>
  </div>
  <?php } ?>
</div>
