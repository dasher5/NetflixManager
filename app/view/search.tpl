<h2 style="margin-left: 2%;"><?= count($rows) ?> result(s)</h2>

<div class="search">
  <form action="<?= BASE_URL ?>/search" method="post">
      <div class="form-group">
        <input type="search" class="form-control" name="search_query">
      </div>
      <div>
        <input class="btn btn-primary" type="submit" name="submit" value="Search">
      </div>
  </form>
</div>

  <div class="playlists">
    <?php for($i = 0; $i < count($rows); $i++) { ?>
      <div class="playlist_preview">
        <a href="<?= BASE_URL ?>/content_preview/<?= $rows[$i]['content_id'] ?>"><img src="<?= $rows[$i]['artwork'] ?>"></br></a>
        <a href="<?= BASE_URL ?>/content_preview/<?= $rows[$i]['content_id'] ?>"><?= $rows[$i]['title'] ?></a><br>
      </div>
    <?php } ?>
  </div>

</div>
