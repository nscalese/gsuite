<?php

  require_once('functions.php');

?>

<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>GSuite - Track your games!</title>
        <script src="js/site.js"></script>
        <script src="lib/jquery-3.6.0.js"></script>
        <script src="lib/bootstrap-5.0.0-beta3-dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
        <link rel="stylesheet" href="css/site.css">
        <link rel="stylesheet" href="lib/bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    </head>
    <body class="d-flex flex-column">
      <main>
        <!--Results Modal-->
        <div id="results-modal" class="modal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title"></h5>
              </div>
              <div class="modal-body">
                <!--User Content Goes Here-->
              </div>
              <div class="modal-footer">
                <button type="button" id="close-button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <section class="container sticky-top" id="header">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                  <a id="logo" class="navbar-brand" href="#"><img class="gSuiteLogo" src="Images/Other/GS.JPG"></a>
                  <a class="navbar-brand" href="#games">Games</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                        <a class="nav-link" href="#">Log in/Register</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Friends</a>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Platforms</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="#">Playstation</a></li>
                          <li><a class="dropdown-item" href="#">Xbox</a></li>
                          <li><a class="dropdown-item" href="#">PC</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="#">GAMER SUITE</a></li>
                        </ul>
                      </li>
                    </ul>
                    <form id="search-form" class="d-flex">
                      <input class="form-control me-2" id="search" type="search" placeholder="Search" aria-label="Search">
                      <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                  </div>
                </div>
              </nav>
        </section>

        <section class="container">
            <div class="row">
              <div class="col-10" id="games">
                <div class="row">
                  <?php
                    echo(getGames());
                  ?>
                </div>
              </div>
              <div class="col-2">
                <div class="sidebar">
                  <a class="twitter-timeline" href="https://twitter.com/IGN?ref_src=twsrc%5Etfw">
                    Tweets by IGN
                  </a> 
                  <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                  
                  <a class="d-block" id="comments" href="#">Comments</a>
                  <a class="d-block" id="recent" href="#">Recent Games</a>
                  <a class="d-block" id="news" href="#">News</a>
                  <a class="d-block" id="bug-report" href="#">Bug Report</a>
                </div>
              </div>
            </div>
        </section>        
      </main>
      <footer class="footer mt-auto py-3">
        <hr></hr>
        <div class="container">    
          <span class="text-muted">Copyright claimed by Nick Scalese and Seamus Nauton : 2021</span>
        </div> 
      </footer>
    </body>
</html>