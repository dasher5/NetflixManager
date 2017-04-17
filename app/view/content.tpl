  <div class="playlist-header">
    <div class="your-playlists">
      <span><?= $rows[0]['title'] ?></span>
    </div>
    <div class="add">
      <button type="button" class="btn btn-primary" style="float: right;">Shuffle</button>
    </div>
  </div>


  <div class="content_preview" style="width: 100%; text-align: center;">
    <div style="float: left; width=50%; display:inline-block; margin-left: 2%;"><img style="padding-top: 2%;" src="<?= $rows[0]['artwork'] ?>">
    </div>

    <div style="width: 50%; display: inline-block;">
      <table class="table" style="width: 100%; margin: 0 auto; font-size: 150%;">
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
                  <td><a target="#" href="http://netflix.com/watch/<?= $rows[$i]['content_id'] ?>"><?= $rows[$i]['title'] ?></a></td>
                  <td><?= $rows[$i]['rating'] ?></td>
                  <td><?= $rows[$i]['year'] ?></td>
                  <td><?= $rows[$i]['length'] ?></td>
              </tr>
            <?php } ?>
          </tbody>
      </table>
    </div>
  </div>

  <div style="width: 25%; font-size:125%; margin-left: 2%;">
    <p><?= $rows[0]['synopsis'] ?></p>
  </div>

</div>
