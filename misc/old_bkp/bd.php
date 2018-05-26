 <?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "clients";
$nom_clt = $_GET['nom_clt'];
$id_client = $_GET['id_client'];
$sql = "INSERT INTO `client`(`id_client`,`nom_clt`) VALUES ('$id_client','$nom_clt')";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (mysqli_query($conn,$sql)) {
    echo "";
} 
else {
    echo "Error:" . $sql . "<br>" . mysqli_error($conn);
}
$query = "SELECT `id_client`, `nom_clt` FROM `client`";
$result = mysqli_query($conn, $query);
mysqli_close($conn);
echo "<script>window.close();</script>";
?> 