<?php

  require_once('functions.php');

?>

<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="utf-8">
        <title>GSuite - Track your games!</title>
        <script src="js/site.js"></script>
        <script src="lib/jquery-3.6.0.js"></script>
        <script src="lib/bootstrap-5.0.0-beta3-dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="css/site.css">
        <link rel="stylesheet" href="lib/bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css">
    </head>
    <body class="d-flex flex-column">
      <main>
        <!--Results Modal-->
        <div id="results-modal" class="modal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!--User Content Goes Here-->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <h1>GSuite</h1>
        <section class="container" id=header>
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
                        <a class="nav-link" href="#">Log in/Registrer</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Friends</a>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Platforms
                        </a>
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

        <section class="container" id="games">
            <div class="row">
                <?php
                  echo(getGames());
                ?>
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