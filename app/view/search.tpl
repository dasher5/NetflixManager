  <div class="playlists">
    <?php for($i = 0; $i < count($rows); $i++) { ?>
      <div class="playlist_preview">
        <a href="<?= BASE_URL ?>/content_preview/<?= $rows[$i]['content_id'] ?>"><img src="<?= $rows[$i]['artwork'] ?>"></br></a>
        <a href="<?= BASE_URL ?>/content_preview/<?= $rows[$i]['content_id'] ?>"><?= $rows[$i]['title'] ?></a><br>
      </div>
    <?php } ?>
  </div>

</div>
