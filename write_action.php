 <?php
                $connect = mysqli_connect("localhost", "root", "toor", "sfgg") or die("fail");
                session_start();
                $id = $_POST[name];                      //Writer
                $pw = $_POST[pw];                        //Password
                $title = $_POST[title];                  //Title
                $content = $_POST[content];              //Content
                $date = date('Y-m-d H:i:s');            //Date

                $query = "insert into board (number,title, content, date, hit, id, password) 
                        values(null,'$title', '$content', '$date',0, '$id', '$pw')";
 
 
                $result = $connect->query($query);
                if($result){
?>                  <script>
                        alert("<?php echo "글이 등록되었습니다."?>");
                        location.replace("./main.php");
                    </script>
<?php
                }
                else{
                        echo "FAIL";
                }
 
                mysqli_close($connect);
?>
