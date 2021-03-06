
<div class="playlist-header">
  <div class="your-playlists">
    <span><?= $name[0]['playlist_name'] ?></span>
    <img style="cursor: pointer;" id="test" src="https://cdn3.iconfinder.com/data/icons/edition/100/pen_paper_2-512.png" height="2.5%" width="2.5%">
    <a href="<?= BASE_URL ?>/delete_playlist/<?= $rows[0]['playlist_id'] ?>"><img src="https://maxcdn.icons8.com/Share/icon/Editing//delete1600.png" height="3.7%" width="3.7%"></a>

    <form id="edit-form" action="<?= BASE_URL ?>/edit/<?= $rows[0]['playlist_id'] ?>" method="post" style="display: none;">
        <div class="form-group">
          <input style="width: 50%;" type="search" class="form-control" name="playlist_name" placeholder="Playlist Name">
        </div>
    </form>

  </div>
  <div class="add">
    <button id="shuffle" type="button" class="btn btn-primary" style="float: right;">Shuffle</button>
  </div>
</div>

</script>

<script>
$( "#test" ).click(function() {
  $( "#edit-form" ).toggle();
});
</script>


<table class="table" style="width: 90%; margin: 0 auto; font-size: 150%;">
    <thead>
        <tr>
            <th>Options</th>
            <th>Name</th>
            <th>Rating</th>
            <th>Year</th>
            <th>Length</th>
        </tr>
    </thead>
    <tbody>
      <?php for($i = 0; $i < count($rows); $i++) { ?>
        <tr>
            <th scope="row">
              <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">+</button>
                <ul class="dropdown-menu">
                  <?php for($j = 0; $j < count($playlists); $j++) { ?>
                        <li><a href="<?= BASE_URL ?>/add_to_playlist/<?= $playlists[$j]['playlist_id'] ?>/<?= $rows[$i]['content_id'] ?>/<?= $rows[$i]['title'] ?>"><?= $playlists[$j]['playlist_name'] ?></a></li>
                  <?php  } ?>
                </ul>
              </div>
            </th>
            <td><a style="text-decoration: none;" target="#" class="content-links" id="<?= $rows[$i]['content_id'] ?>" href="http://netflix.com/watch/<?= $rows[$i]['content_id'] ?>"><?= $rows[$i]['title'] ?></a></td>
            <td><?= $rows2[$i][0]['rating'] ?></td>
            <td><?= $rows2[$i][0]['year'] ?></td>
            <td class="length" id="<?= $rows[$i]['length'] ?>"><?= $rows2[$i][0]['length'] ?></td>
            <td><a href="<?= BASE_URL ?>/delete_item/<?= $playlist_id ?>/<?= $rows[$i]['content_id'] ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
        </tr>
      <?php } ?>
    </tbody>
</table>


</div>
