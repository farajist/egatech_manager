<html>
<head>
<title> Login </title>
<link rel="stylesheet" type="text/css" href="logstyledoc.css">
<link rel="icon" href="http://egatech.ma/wp-content/uploads/2017/01/cropped-E-32x32.png" sizes="32x32" />
<link rel="icon" href="http://egatech.ma/wp-content/uploads/2017/01/cropped-E-192x192.png" sizes="192x192" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script  type="text/javascript" src="script.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
</head> 
<body>
<ul class="live-search-list">
<a class="logo" href="http://egatech.ma/" target="_blank"> <img width="355" height="90" src="Egatech-LOGO-site-slogan-.jpg" class="header_logo header-logo" alt="Egatech"/></a>
<input type="text" class="live-search-box" placeholder="Rechercher un client" />
<?php $servername = "127.0.0.1";
$username = "root";
$password = "CStar.hdb07_mysql";
$dbname = "clients";
$conn = mysqli_connect($servername, $username, $password, $dbname);
$query = "SELECT `id_client`, `nom_clt` FROM `client`";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_assoc($result)){
echo "<li><a href='#' id='link'><b>" .$row["id_client"]."- ".$row["nom_clt"]."</b></a></li>";}?><br>
<form action="add.html" target="_blank" >
<button class="addclt" action="add.html" ><strong><b>+ </b> Ajouter un nouveau client</strong></button></form>
</ul>
<script>$('a#link').click(function(){ document.getElementById('demo').style.display='block'; }) </script>
<br>
<br>
<form style="padding:20px;width:40%; border: 2px solid orange;background-color:#262626;" class="addform" method="get" action="bd.php">
<TABLE>
<tr>
    <td><b>ID client:</b></td>
    <td> <input type="text" name="id_client"/><br></td>
  </tr>
  <tr>
    <td><b>nom client:</b></td>
    <td><input type="text" name="nom_clt"/></td>
  </tr>
   <tr>
    <td><b>Date:</b></td>
	<td><input type="date" name="date" placeholder="jj/mm/aaaa"/></td>
    <br>
  </tr>
</TABLE>
<br>
<input class="button" type="submit" value="+ Ajouter"><br>
</form>
</body>
</html>