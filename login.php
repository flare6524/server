<?php
session_start();

$id=$_POST["id"];
$pw=md5($_POST["pw"]);

$connect = mysqli_connect("localhost","root","toor");
if(!$connect){
    die('Could no connect: '.mysql_error());
}
echo 'Connected successfully';
echo '<br/>';

mysqli_query($connect,"set names euckr");

mysqli_select_db($connect, "sfgg");

$stmt = $connect->prepare("select * from account_info where id=?");
$stmt->bind_param("s",$id);

$stmt->execute();

$result=$stmt->get_result();
$data=$result->fetch_array(MYSQLI_NUM);

if($data[0]==$id) {
    if($data[1]==$pw) {
        $_SESSION['id']=$id;
        $_SESSION['is_logged']=1;
?>
	<script>
		location.replace('./main.php');
	</script>
<?php
    }else{
        echo"<script>alert(\"실패\");
            history.back(1);
            </script>";
    }
}else{
    echo "<script>alert(\"실패\");
            history.back(1);
            </script>";
}

mysqli_close($connect);
?>
