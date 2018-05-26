function make_bill_text()
	{

			$btstrp_css = CSS_FOLDER."bootstrap.min.css";
			$fctr_css = CSS_FOLDER."facture.css";
			
			$jqry_js = JS_FOLDER."jquery-3.2.1.min.js";
			$btstrp_js = JS_FOLDER."bootstrap.min.js";
			$logo = IMG_FOLDER.'logo_bill.png';

			$code = $_GET['clt_code'];
			$pm_id = $_GET['pm_id'];
			if (!$code)
				return;
			$commands = get_commands($code);
			$clients = get_client($_GET['clt_code']);
			$pms = get_pms();


			$cmd_date = $commands[$_GET['cmd_id']]['date'];
			$clt_name = $clients['client_name'];
			$clt_code = $code;
			$bl_num = $commands[$_GET['cmd_id']]['num_cmd'];;
			$tbody_text = print_bill_products($_GET['cmd_id']);
			$payment_mode = $pms[$commands[$_GET['cmd_id']]['pm_id']]['pm_desc'];


			$html_text = <<<HTML
				<!DOCTYPE html>
				<html>
					<head>
				    	<meta charset="utf-8" />
				    	<meta name="viewport" content="width=device-width, initial-scale=1">
				    	<link rel="stylesheet" href="{$btstrp_css}" />
				    	<link rel="stylesheet" href="{$fctr_css}" />
				    	<script src="{$jqry_js}"></script>
				    	<script src="{$btstrp_js}"></script>
					</head>

					<body>
						<div class="container">
							<div class="row">
				    			<div>
				        			<img src="{$logo}" class="img-responsive" alt="Egatech">
				    			</div>
				    		</div>
				        	<div class="row">
				            	<div class="col-xs-3">
				                	<table class="table">
				                    	<tbody>
				                        	<tr>
				                            	<td>Meknès le :</td>
				                            	<td>{$cmd_date}</td>
				                        	</tr>
				                        	<tr>
				                            	<td>Client : </td>
				                            	<td>{$clt_name}</td>
				                        	</tr>
				                        	<tr>
				                            	<td>Code client : </td>
				                            	<td>{$clt_code}</td>
				                        	</tr>
				                    	</tbody>
				                	</table>
				            	</div>
				            	<div class="col-xs-2">
				            	</div>
				            	<div class="col-xs-1">
				                	<p id="rcorners"></p>
				            	</div>
				            	<div class="col-xs-5">
				            	</div>
				        	</div>
					        <!-- here was the closing -->
					        <div class="row">
					            <div class="dtitle">
					                <p class="btitle">BON DE LIVRAISON N° : {$bl_num}</p>
					            </div>
					        </div>
				        	<br><br>
				        	<div class="row">
				            	<!--<div class="container"> this caused me a terrible pain !-->
				                	<table class="table table-striped table-responsive">
				                    	<thead>
				                        	<tr>
				                            	<th>Référence</th>
				                            	<th>Désignation</th>
				                            	<th>Quantité</th>
				                            	<th>Prix unitaire HT</th>
				                            	<th>Total HT</th>
				                        	</tr>
				                    	</thead>
				                    	{$tbody_text}
				                	</table>
				            	<!--</div>-->
				        </div>
				        <br><br>
				        <div class="row">
				        	<div class="col-xs-4" class="btitle">
				        		<small>Arrêtez le présent BL à la somme de : </small>
				        	</div>
				            <div class="col-xs-1">
				            	<div class="dtitle">
				                	<p class="btitle"></p>
				           		</div>
				            </div>
				        </div>
				        <div class="row">
				        	<div class="col-xs-3">
				            	<small>Modalité de paiement :</small>
				            </div>
				            <div class="col-xs-2" class="btitle">
				            	<h3><code>{$payment_mode}</code></h3>
				            </div>
				        </div>
				        <br><br>
				        <div class="row">
				            <div class="col-xs-12" class="btitle">
				                <h6>EGATECH Sarl, 104,106, Z.I Sidi Slimane Moul Lkifane, 50000 Meknès, Tél : 0535.300.286, Fax:0535.300.467
				                    <br> E-mail: contact@egatech.ma, Web: www.egatech.ma</h6>
				            </div>
				        </div>
				    </div>
				</body>

				</html>

HTML;
		return $html_text;
		}