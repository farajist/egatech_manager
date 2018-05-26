<!DOCTYPE html>
<html>
<head>
	<?php require_once('../utils.php');
		get_metadata();
        get_css_res();
        get_js_res();
        get_img_res();
    ?>

</head>
			<body>
				<div class="container">
					<div class="row">
			    		<div>
			        		<img src="<?php echo IMG_FOLDER."logo_bill.png"; ?>" class="img-responsive center-block" alt="Egatech">
			    		</div>
			    	</div>
			        <div class="row">
			            <div class="col-xs-3">
			                <table class="table">
			                    <tbody>
			                        <tr>
			                            <td>Meknès le :</td>
			                            <td>10/07/2017</td>
			                        </tr>
			                        <tr>
			                            <td>Client : </td>
			                            <td>SIPAT</td>
			                        </tr>
			                        <tr>
			                            <td>Code client : </td>
			                            <td>003</td>
			                        </tr>
			                    </tbody>
			                </table>
			            </div>
			            <div class="col-xs-4">

			            </div>
			            <div class="col-xs-1">
			                <p id="rcorners"></p>
			            </div>
			            <div class="col-xs-3">
			            </div>
			        </div>
			        <!--        here was the closing-->
			        <div class="row">
			            <div class="center-block dtitle">
			                <p class="btitle">BON DE LIVRAISON N° : 008-00</p>
			            </div>
			        </div>
			        <br><br>
			        <div class="row">
			            <div class="container">
			                <table class="table table-striped">
			                    <thead>
			                        <tr>
			                            <th>Référence</th>
			                            <th>Désignation</th>
			                            <th>Quantité</th>
			                            <th>Prix unitaire HT</th>
			                            <th>Total HT</th>
			                        </tr>
			                    </thead>
			                    <tbody>
			                        <tr>
			                            <td></td>
			                            <td>Bague en cuivre</td>
			                            <td>12</td>
			                            <td>50.00</td>
			                            <td>600.00</td>
			                        </tr>
			                        <tr>
			                            <td></td>
			                            <td>Soudure de fourchette</td>
			                            <td>1</td>
			                            <td>100.00</td>
			                            <td>100.00</td>
			                        </tr>
			                        <tr>
			                            <td>N/A</td>
			                            <td>N/A</td>
			                            <td>N/A</td>
			                            <td></td>
			                            <td></td>
			                        </tr>
			                        <!-- prices -->
			                        <tr>
			                            <td></td>
			                            <td></td>
			                            <td></td>
			                            <td><code>Total HT</code></td>
			                            <td>700.00</td>
			                        </tr>
			                        <tr>
			                            <td></td>
			                            <td></td>
			                            <td></td>
			                            <td><code>TVA 20%</code></td>
			                            <td>140.00</td>
			                        </tr>
			                        <tr>
			                            <td></td>
			                            <td></td>
			                            <td></td>
			                            <td><code>Total TTC</code></td>
			                            <td>840.00</td>
			                        </tr>
			                    </tbody>
			                </table>
			            </div>
			        </div>
			        <div class="row">
			            <h5>Arrêtez le présent BL à la somme de : </h5>
			            <div class="center-block" class="dtitle">
			                <p class="btitle"></p>
			            </div>
			        </div>
			        <div class="row">
			            <h5>Modalité de paiement :</h5>
			            <h3><code>En espece</code></h3>
			        </div>
			        <br>
			        <br>
			        <div class="row">
			            <div class="text-center">
			                <p>EGATECH Sarl, 104,106, Z.I Sidi Slimane Moul Lkifane, 50000 Meknès, Tél : 0535.300.286, Fax:0535.300.467
			                    <br> E-mail: contact@egatech.ma, Web: www.egatech.ma</p>
			            </div>
			        </div>
			    </div>
			</body>

</html>