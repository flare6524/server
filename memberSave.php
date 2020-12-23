<?php
$connect = mysqli_connect("localhost", "root", "toor","sfgg");

 $id=$_POST['id'];
 $password=md5($_POST['pwd']);
 $checkpw=$_POST['pwd'];
 $password2=$_POST['pwd2'];
 $name=$_POST['name'];
 $email=$_POST['email'];

 if($id==NULL || $checkpw==NULL) {
?>
	<script>
		alert("write id or pw");
		history.back();
	</script>
<?php
 }
 $stmt=$connect->prepare("select * from account_info where id=?");
 $stmt->bind_param("s",$id);
 $stmt->execute();

 $result=$stmt->get_result();
 $stmt->close();
 if($result->num_rows>=1) {
?>
	<script>
		alert('Already exist ID!');
		history.back();
	</script>
<?php
 }
 else if($checkpw!=$password2) {
?>
	<script>
		alert('Not same password!');
		history.back();
	</script>
<?php
 }
 else { 
	$sql = $connect->prepare("insert into account_info (id, pw, name, email) values (?,?,?,?)");
	$sql->bind_param("ssss",$id,$password,$name,$email);
	$sql->execute();
	$sql->close();

	$stmt=$connect->prepare("select * from account_info where id=?");
	$stmt->bind_param("s",$id);
	$stmt->execute();

	$result=$stmt->get_result();
	$stmt->close();

	if($result->num_rows>=1){
?>
		<script>
			location.replace('./first.html');
		</script>
<?php
	}else{
?>
		<script>
			alert('Error!');
			history.back();
		</script>
<?php
 	}
 }
?>
