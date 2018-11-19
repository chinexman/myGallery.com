
<?php


require_once 'db_connect.php';




$imageid= $_GET['imageid'];

$res=$con->query("delete  from upload_image where imageid=$imageid");


?>

<script type="text/javascript">
    window.location="checkhome.php";
</script>