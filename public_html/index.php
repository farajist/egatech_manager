<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Egatech</title>
    <?php require_once('../resources/utils.php');
        get_metadata();
        get_css_res();
        get_js_res();
        get_img_res();
    ?>
</head>

<body>
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Nos clients
                    </a>
                </li>
                <div class="inner-addon left-addon">
                    <input type="text" class="live-search-box" placeholder="Rechercher un client" /><i style="background-color: orange; height:20 px;" class="glyphicon glyphicon-search"></i></div>
                <?php 
                    require_once('../resources/client/functions.php');
                    require_once('../resources/login/functions.php');

                    if (is_logged_in())
                        print_clients_links_list();
                    else
                        print_clients_normal_list();
                    // echo get_last_clt_code();
                ?>

            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
                <!-- topbar -->
        <?php 
            if (is_logged_in())
            {
                 $logged = $_SESSION['login_user'];
                echo <<<HTML
                    <ul class="topbar">
                        <li><a href="../resources/login/logout.php"><button type="button" class="btn btn-warning">Déconnexion</button></a> </li>
                        <li><a class="lol">{$logged}</a></li>  
                    </ul> 
HTML;
            }
        ?>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <a href="index.php" > <img class="img-responsive" src="img/logo.png" alt="logo" width="55%" height="10%" style="margin-left: 20%;"></a>
                        <h1>Egatech-app:</h1>
                        <p>Un système de gestion destiné à stocker et à partager des informations dans votre base de données, en garantissant la qualité, la pérennité et la confidentialité des informations, tout en cachant la complexité des opérations par son interface graphique développée minutieusement.</p>
                        <p>Développée par:<code>Anas El baghdadi</code>.</p>
                        <p>Sous l'encadrement de:<code>Mr Mohammed Lemkhenter et Mr laarbi.....</code>.</p>
                        <br><br>
                         <?php 
                                if (!is_logged_in())
                                {
                                    $logged = $_SESSION['login_user'];
                                    echo '<button type="button" class="btn btn-warning" id="myBtn">Connexion</button>'; 
                                }
                                else {
                                    echo '<button type="button" class="btn btn-warning" id="add_client"><span class="glyphicon glyphicon-plus"></span>  Ajouter un client</button>'; 
                                }
                            ?>
                            
                        <div class="container">
                            <!-- Trigger the modal with a button -->
                            <div id="add_client_modal" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Informations générales </h4>
                                  </div>
                                  <div class="modal-body">
                                      <p>
                                          <form id="clt_add" method="POST" action="../resources/client/add_client.php">

                                              <div class="form-group">
                                                  <!-- <label>code client:</label> -->
                                                  <input class="form-control" name="clt_code" type="hidden" value="<?php echo get_last_clt_code(); ?>">
                                              </div>
                                              <div class="form-group">
                                                  <label>Nom client:</label>
                                                  <input id="clt_name" type="text" class="form-control" name="clt_name">
                                              </div>
                                              <div class="form-group">
                                                  <label>Adresse</label>
                                                  <input id="clt_address" type="text" class="form-control" name="clt_address">
                                              </div>
                                              <div class="form-group">
                                                  <label for="email">Email:</label>
                                                  <input id="clt_email" type="email" class="form-control" id="email" name="clt_email">
                                              </div>
                                              <div class="form-group">
                                                  <label>Téléphone:</label>
                                                  <input id="clt_phone" type="text" class="form-control" name="clt_phone">
                                              </div>
                                              <button type="submit" class="btn btn-warning" name="btn_edit">Enregister</button>
                                          </form>
                                      </p>
                                  </div>
                              </div>

                          </div>
                      </div>


                            <!-- Modal -->
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header" style="padding:35px 50px;">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4><span class="glyphicon glyphicon-lock"></span> Connexion</h4>
                                        </div>
                                        <div class="modal-body" style="padding:40px 50px;">
                                            <form role="form" method="POST" action="../resources/login/login.php">
                                                <div class="form-group">
                                                    <label for="usrname"><span class="glyphicon glyphicon-user"></span> Nom d'utilisateur</label>
                                                    <input type="text" class="form-control" id="usrname" name="username" placeholder="Entrer le nom d'utilisateur">
                                                </div>
                                                <div class="form-group">
                                                    <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Mot de passe</label>
                                                    <input type="password" class="form-control" id="psw" name="passwd">
                                                </div>
                                                <button type="submit" name="logi" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Connexion</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <script>
                            $(document).ready(function() {
                                $("#myBtn").click(function() {
                                    $("#myModal").modal();
                                });
                            });

                             $(document).ready(function() {
                                $("#add_client").click(function() {
                                    $("#add_client_modal").modal();
                                });
                            });
                        </script>

                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>

</body>

</html>