<?php

?>
    <hr style=" border: 2px solid #990000">
<main class="page blog-post-list">
    <nav id="myTab" class="nav nav-tabs" role="tablist">
        <a class="nav-item nav-link green"id="nav-contact-tab" data-toggle="tab" href="#nav-allMovies" role="tab" aria-controls="nav-contact" aria-selected="false">All Movies</a>
        <a class="nav-item nav-link green active" id="nav-nowplaying-tab" data-toggle="tab" href="#nav-nowPlaying" role="tab" aria-controls="nav-home" aria-selected="true">Now Playing</a>
        <a class="nav-item nav-link green" id="nav-comingSoon-tab" data-toggle="tab" href="#nav-comingSoon" role="tab" aria-controls="nav-profile" aria-selected="false">Coming Soon</a>
    </nav>
 
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane" id="nav-allMovies" role="tabpanel" aria-labelledby="nav-contact-tab">
            <section class="clean-block clean-blog-list dark">
                <div class="container">
                    <div class="block-heading">
                        <h2 class="header active">All Movies</h2>
                        <p>All the movies that have played or will soon play in our theatre.</p>
                    </div>
                    <div class="block-content">
                        <?php
                        Database::initialize();
                        //Database::refreshAllMovies();
                        $movies = Database::getAllMovies();
                        foreach($movies as $key=>$movie):
                            $movieId = $movie->getId();
                            $title = $movie->getTitle();
                            $posterPath = $movie->getPosterPath();
                            $overview = $movie->getOverview();
                            if(strlen($overview) > 350){
                                $overview = substr($overview, 0, 350) . "...";
                            }
                            $language = $movie->getLanguage();
                            $genres = $movie->getGenres();
                            ?>
                            <div class="clean-blog-post">
                                <div class="row">
                                    <div class="col-lg-5" style="text-align: center"><img class="rounded img-fluid" src="<?php echo $posterPath; ?>" width="300" alt="<?php echo $movie->getTitle()." - poster image";?>"></div>
                                    <div class="col-lg-7"><br/><br/><br/><br/>
                                        <h3><?php echo $title; ?></h3>
                                        <div class="info"><span class="text-muted"><?php echo $genres; ?></span></div>
                                        <p><?php echo $overview; ?></p>
                                        <form action="index.php?content=movie-info" method="post">
                                            <input type="hidden" name="movieId" value="<?php echo $movieId; ?>">
                                            <button class="btn btn-outline-success btn-sm" type="submit" >
                                            Showtimes and More</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </section>
        </div>
        <div class="tab-pane active" id="nav-nowPlaying" role="tabpanel" aria-labelledby="nav-home-tab">
            <section class="clean-block clean-blog-list dark">
                <div class="container">
                    <div class="block-heading">
                        <h2 class="header">Now Playing</h2>
                        <p>Movies now playing in cinemas near you.</p>
                    </div>
                    <div class="block-content">
                        <?php
                            Database::initialize();
                            $movies = Database::getNowPlaying();
                            foreach($movies as $key=>$movie):
                            $movieId = $movie->getId();
                            $title = $movie->getTitle();
                            $posterPath = $movie->getPosterPath();
                            $overview = $movie->getOverview();
                            if(strlen($overview) > 350){
                                $overview = substr($overview, 0, 350) . "...";
                            }
                            $language = $movie->getLanguage();
                            $genres = $movie->getGenres();
                        ?>
                            <div class="clean-blog-post">
                                <div class="row">
                                    <div class="col-lg-5" style="text-align: center"><img class="rounded img-fluid" src="<?php echo $posterPath; ?>" width="300" alt="<?php echo $movie->getTitle()." - poster image";?>"></div>
                                    <div class="col-lg-7"><br/><br/><br/><br/>
                                        <h3><?php echo $title; ?></h3>
                                        <div class="info"><span class="text-muted"><?php echo $genres; ?></span></div>
                                        <p><?php echo $overview; ?></p>
                                        <form action="index.php?content=movie-info" method="post">
                                            <input type="hidden" name="movieId" value="<?php echo $movieId; ?>">
                                            <button class="btn btn-outline-success btn-sm" type="submit">Showtimes and More</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </section>
        </div>
        <div class="tab-pane" id="nav-comingSoon" role="tabpanel" aria-labelledby="nav-profile-tab">
            <section class="clean-block clean-blog-list dark">
                <div class="container">
                    <div class="block-heading">
                        <h2 class="header">Coming Soon</h2>
                        <p>Coming soon to a theatre near you.</p>
                    </div>
                    <div class="block-content">
                        <?php
                            Database::initialize();
                            $movies = Database::getComingSoon();
                            foreach($movies as $key=>$movie):
                            $movieId = $movie->getId();
                            $title = $movie->getTitle();
                            $posterPath = $movie->getPosterPath();
                            $overview = $movie->getOverview();
                            if(strlen($overview) > 350){
                                $overview = substr($overview, 0, 350) . "...";
                            }
                            $language = $movie->getLanguage();
                            $genres = $movie->getGenres();
                        ?>
                            <div class="clean-blog-post">
                                <div class="row">
                                    <div class="col-lg-5" style="text-align: center"><img class="rounded img-fluid" src="<?php echo $posterPath; ?>" width="300" alt="<?php echo $movie->getTitle()." - poster image";?>"></div>
                                    <div class="col-lg-7"><br/><br/><br/><br/>
                                        <h3><?php echo $title; ?></h3>
                                        <div class="info"><span class="text-muted"><?php echo $genres; ?></span></div>
                                        <p><?php echo $overview; ?></p>
                                        <form action="index.php?content=movie-info" method="post">
                                            <input type="hidden" name="movieId" value="<?php echo $movieId; ?>">
                                            <button class="btn btn-outline-success btn-sm" type="submit" disabled="">More info soon</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </section>
        </div>
    </div> 
</main>