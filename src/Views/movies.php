<?php

//  foreach($params['users'] as $val)
  // foreach($params as $val)
  // {
  //   echo '<pre>';
  //   print_r($val);
  //   echo '</pre>';
  // }

  $movieList = $params;
  $location = "PHPoop/final/catalogRyt/src/assets/img/";
  $session = $_SESSION['user']['role'] ?? '';


  ?>

  <section class="movies">
    <div class="container">
      <div class="home-movies">
          <h2>Movies</h2>
          <?php foreach($movieList as $key) :?>
            <?php foreach($key as $movie) :?>
              <div class="movie-card">
                  <h3>
                      <?= $movie['id']?>
                    </h3>
                    <p>
                      <?= $movie['movie_name']?>
                    </p>
                    <?php if(file_exists($location.'/'.$movie['id'].'.jpeg')):?>
                      <td><img src="<?=$location.'/'.$movie['id']?>.jpeg" alt="" style="width:60%"></td>
                    <?php else:?>
                      <td><img src="PHPoop/final/catalogRyt/src/assets/img/default.jpg" width="50" height="60"></td>
                    <?php endif ;?>
                    <br>
                    <a href="">Movie info</a>
                    <?php if($session=='admin') :?>
                      <a href="">Delete</a>
                    <?php endif ?>
                  </div>
                <?php endforeach ?>
              <?php endforeach ?>
            </div>
          </div>
  </section>
