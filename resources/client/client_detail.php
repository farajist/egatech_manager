<!-- <?php 
  //require_once('functions.php');
  //encode_client(); 
?>
 --><!DOCTYPE html>
<html>
    <head>
    	<title></title>
        <?php require_once('../utils.php');
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
                <input  type="text" class="live-search-box" placeholder="Rechercher un client" /><i style="background-color: orange; height:20 px;" class="glyphicon glyphicon-search"></i></div>
                <?php 
                  require_once ('functions.php');
                  require_once ('../command/functions.php');
                  require_once('../client/functions.php');
                  require_once('../login/functions.php');
                  
                  print_clients_links_list();
                ?>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
        <?php 
                $domain = DOMAIN;
                echo <<<HTML
                    <ul class="topbar">
                        <li><a href="{$domain}/Egatech/resources/login/logout.php"><button type="button" class="btn btn-warning">Déconnexion</button></a> </li>
                        <li><a class="lol">{$logged}</a></li>  
                    </ul> 
HTML;
            // }
        ?>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                      <?php echo show_client_detail(); 
                            echo show_commands($_GET['id']);
                      ?>
                      <!-- Modal -->
                      <div id="myModal" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Informations générales </h4>
                                  </div>
                                  <div class="modal-body">
                                      <p>
                                          <form id="clt_edit_ajax" method="POST" action="edit_client.php">

                                              <div class="form-group">
                                                  <!-- <label>code client:</label> -->
                                                  <input class="form-control" name="nclt_code" type="hidden" value="<?php echo $_GET['id']; ?>">
                                              </div>
                                              <div class="form-group">
                                                  <label>Nom client:</label>
                                                  <input id="clt_name" type="text" class="form-control" name="nclt_name">
                                              </div>
                                              <div class="form-group">
                                                  <label>Adresse</label>
                                                  <input id="clt_address" type="text" class="form-control" name="nclt_address">
                                              </div>
                                              <div class="form-group">
                                                  <label for="email">Email:</label>
                                                  <input id="clt_email" type="email" class="form-control" id="email" name="nclt_mail">
                                              </div>
                                              <div class="form-group">
                                                  <label>Téléphone:</label>
                                                  <input id="clt_phone" type="text" class="form-control" name="nclt_phone">
                                              </div>
                                              <button type="submit" class="btn btn-warning" name="btn_edit">Enregister</button>
                                          </form>
                                      </p>
                                  </div>
                              </div>

                          </div>
                      </div>

                      <!--Modal for adding product goes here -->
                      <!-- Modal -->
                      <div class="modal fade" id="add_command_modal" role="dialog">
                          <div class="modal-dialog">
                              <!-- Modal content-->
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h4>Ajouter une nouvelle commande</h4>
                                  </div>
                                  <div class="modal-body">
                                  <div class="panel-body">
                                  <form id="add_command_form" method="POST" action="../command/add_command.php">
                                    <div class="form-group">
                                                  <!-- <label>code client:</label> -->
                                                  <input class="form-control" name="client_id" type="hidden" value="<?php echo $_GET['id']; ?>">
                                              </div>
                                      <div id="product_fields">
                                          <!--child components are added here ! -->
                                      </div>
                                      
                                        <div class="col-sm-3 nopadding">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="prod_ref" name="prod_ref[]" value="" placeholder="Référence de produit">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 nopadding">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="prod_name" name="prod_name[]" value="" placeholder="Nom de produit">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 nopadding">
                                            <div class="form-group">
                                                <input type="number" class="form-control" id="price" name="price[]" value="" placeholder="Prix">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 nopadding">
                                            <div class="form-group">
                                                <div class="input-group">
                                                  <input type="number" class="form-control" id="qte" name="qte[]" value="" placeholder="Quantité">
                                                  <div class="input-group-btn">
                                                          <button class="btn btn-warning" type="button" onclick="products_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                        </div>

                                        </div>
                                        <div class="modal-footer">
                                              <div class="form-group">
                                                <div class="input-group">
                                                <h4>Mode de paiement</h4>
                                                  <select class="form-control" id="payement_mode" name="payment_mode">  
                                                      <?php echo get_payment_modes(); ?>
                                                  </select>
                                                </div>
                                              </div>

                                              <button type="submit" name="confirm_cmd" class="btn btn-default btn-default pull-left"><span class="glyphicon glyphicon-ok"></span>Confirmer</button>
                                              <button type="reset" class="btn btn-default btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-unchecked"></span> Vider les champs</button>
                                              <!-- <button type="submit" class="btn btn-default btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler</button>  --> 
                                        </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                      <!--Confirm delete client modal-->
                      <div class="modal fade" id="confirm_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                          <h4 class="modal-title" id="myModalLabel">Confirmer la suppression</h4>
                                      </div>
                                      <div class="modal-body">
                                          <p>Etes-vous sûr de vouloir supprimer le client "<?php $client = get_client($_GET['id']); echo $client['client_name']; ?>"</p>
                                      </div>
                                      <div class="modal-footer">
                                          <form action="delete_client.php?client_code=<?php echo $client['client_code']; ?>" method="post">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                            <button class="btn btn-danger" name="delete_btn" type="submit">Confirmer</button>
                                          </form>
                                      </div>
                                  </div>
                              </div>
                          </div>

                           <!--Confirm delete command modal-->
                      <div class="modal fade" id="confirm_delete_cmd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                          <h4 class="modal-title" id="myModalLabel">Confirmer la suppression</h4>
                                      </div>
                                      <div class="modal-body">
                                          <p id="core_text"></p>
                                      </div>
                                      <div class="modal-footer">
                                          <!-- <form action="delete_client.php?client_code=<?php echo $client['client_code']; ?>" method="post"> -->
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                            <button class="btn btn-danger" name="delete_cmd_btn" id="confirm_cmd_delete" type="submit">Confirmer</button>
                                          <!-- </form> -->
                                      </div>
                                  </div>
                              </div>
                          </div>
                </div>
                </div>
  
                <script>
                  function process_response (response) {
                    var frm = $("#clt_edit_ajax");
                    var i;
                    alert('process_response is called');
                    console.dir("Response is : " + response);
                    for (i in response) {
                      frm.find('[name="'+ i +'"]').val(response[i]);
                    }
                  }

                $(document).ready(function(){
                    

                $("#myBtn").click(function(){
                    $("#myModal").modal();
                  });
                });
                 $("#myModal").on('show.bs.modal', function() {
                     // window.history.pushState('forward', null, '#myModal');
                      $.ajax
                      ({
                        type: "GET",
                        url: "http://faraji.dev.local/Egatech/resources/client/client_ajax.php",
                        data : "id=<?php echo $_GET['id']; ?>",
                        cache : false,
                        // success: process_response,
                        // success : function(r) {
                        //   $("#clt_edit_ajax").html("response body : " + r);
                        // },
                        error: function(xhr) {alert("AJAX request failed : " + xhr.status);}
                      })
                      .done(function(data, textStatus, jqXHR) {
                        var clt = JSON.parse(jqXHR.responseText);
                        $("#clt_name").val(clt.CLIENT_NAME);
                        $("#clt_address").val(clt.ADDRESS);
                        $("#clt_email").val(clt.EMAIL);
                        $("#clt_phone").val(clt.PHONE);

                      });
                    });
                    // $('#myModal').on('hide.bs.modal', function (e) {
                    //     //pop the forward state to go back to original state before pushing the "Modal!" button
                    // });

                   // $(window).on('popstate', function () {
                   //     $('#myModal').modal('hide');
                   // });
                    // $( window ).unload(function() {
                    //     removeModal()
                    // });

                    $("#btn_add_command").click(function(){
                        $("#add_command_modal").modal();
                    });

                    $("#delete_clt").click(function(){
                        $("#confirm_delete").modal();
                    });

                    $(document).on("click", ".open_cmd_del_confirm", function(){
                      var cmd_id = $(this).data('id');
                      var clt_code = $(this).data('clt_code');
                      console.log(cmd_id);
                      $("#confirm_cmd_delete").attr('onClick', "location.href=\'../command/delete_command.php?clt_code=" + clt_code + "&cmd_id=" + cmd_id + "\'");

                      $("#core_text").text("Etes-vous sûr de vouloir supprimer la commande N° " + cmd_id + " ?");
                      $("#confirm_delete_cmd").modal();
                  });
                
                  var room = 1;
                  function products_fields() {
                   
                      room++;
                      var objTo = document.getElementById('product_fields')
                      var divtest = document.createElement("div");
                      divtest.setAttribute("class", "form-group removeclass"+room);
                      var rdiv = 'removeclass'+room;
                      divtest.innerHTML = '<div class="col-sm-3 nopadding"><div class="form-group"><input type="text" class="form-control" id="prod_ref" name="prod_ref[]" value="" placeholder="Référence de produit"></div></div><div class="col-sm-3 nopadding"><div class="form-group"><input type="text" class="form-control" id="prod_name" name="prod_name[]" value="" placeholder="Nom de produit"></div></div><div class="col-sm-3 nopadding"><div class="form-group"><input type="number" class="form-control" id="price" name="price[]" value="" placeholder="Prix"></div></div><div class="col-sm-3 nopadding"><div class="form-group"><div class="input-group"><input type="number" class="form-control" id="qte" name="qte[]" value="" placeholder="Quantité"><div class="input-group-btn"><button class="btn btn-danger" type="button" onclick="remove_product_fields('+ room +');"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div></div></div><div class="clear"></div>';
                      
                      objTo.appendChild(divtest)
                  }
                     function remove_product_fields(rid) {
                       $('.removeclass'+rid).remove();
                     }
                </script>

            </div>
        </div>
    </div>
<!-- </div>
        /#page-content-wrapper

</div> -->

</body>
</html>	