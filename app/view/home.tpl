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
    <form action="<?= BASE_URL ?>/process_sign_in" method="post">
        <div class="form-group">
          <input type="search" class="form-control" name="search" required>
        </div>
        <div>
          <input class="btn btn-primary" type="submit" name="submit" value="Search">
        </div>
    </form>
  </div>

  <div class "playlist-container">
    <div class="playlist-header">
      <div class="your-playlists">
        <span>Your Playlists</span>
      </div>
      <div class="add">
        <a href="<?= BASE_URL ?>/add_playlist?id=<?php  ?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
      </div>
    </div>
    <div class="playlists">
      <div id="playlist-1">
        <a href="<?= BASE_URL ?>/playlist"><img src="http://cdn1.nflximg.net/images/4937/8904937.jpg"></br></a>
        <a href="<?= BASE_URL ?>/playlist">American Dad</a>
      </div>
      <div id="playlist-2">
        <a href="#"><img src="http://cdn0.nflximg.net/images/7596/3827596.jpg"></br></a>
        <a href="#">Caillou</a>
      </div>
      <div id="playlist-3">
        <a href="#"><img src="http://cdn1.nflximg.net/images/6439/1096439.jpg"></br></a>
        <a href="#">Documentaries</a>
      </div>
      <div id="playlist-4">
        <a href="#"><img src="http://cdn0.nflximg.net/images/4100/3694100.jpg"></br></a>
        <a href="#">Mystery</a>
      </div>
      <div id="playlist-5">
        <a href="#"><img src="http://cdn1.nflximg.net/images/3237/3743237.jpg"></br></a>
        <a href="#">My Little Pony</a>
      </div>
      <div id="playlist-6">
        <a href="#"><img src="http://cdn1.nflximg.net/images/3083/11673083.jpg"></br></a>
        <a href="#">Thriller</a>
      </div>
    </div>
  </div>
  <?php } ?>
</div>
