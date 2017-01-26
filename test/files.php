<?php
$link=mysqli_connect("localhost", "root", "celmz321") or die ('error' . mysql_error ());
mysqli_select_db($link, "test") or die('error' . mysql_error());

error_reporting(E_ERROR | E_WARNING | E_PARSE);



	$Email=$_POST['Email'];
	$Email=mysqli_real_escape_string($link, $Email);
    $Password=$_POST['Password'];
	$Password=mysqli_real_escape_string($link, $Password);
	
	

	
	$query = "SELECT * FROM users  WHERE email = '$Email' AND password = '$Password'";
	

$result = mysqli_query($link, $query) or die('error' . mysql_error());
$line = mysqli_fetch_array($result, MYSQL_ASSOC);

 $id=$line['id'];

if (!$line) {
	         echo 'The client is not registered<br>
			 <a href="register_form">register</a><br>
			 <a href="index.php">back to log in</a>';
			 }
			 
			 else
			 {
			
			if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
   {
	   
	
	  
		 
     move_uploaded_file($_FILES["filename"]["tmp_name"], "files/".$_FILES["filename"]["name"]);
	 
	 $File=$_FILES["filename"]["name"];
	 
	 $File=mysqli_real_escape_string($link, $File);
	
	 
	 $strSQL = "INSERT INTO files (file, user_id) VALUES('$File', '$id')"; 
     mysqli_query($link, $strSQL) or die('error' .mysql_error());
   }	 
				 
				 
				 
				 
			 echo "User's e-mail: ".$line['email']."<br><br>";
			 			 
			 ?>
  <html>
  <form method="post" action="files.php?Email=<?php echo $Email;?>&Password=<?php echo $Password;?>" enctype="multipart/form-data">
  File upload<br>
  <input type="file" name="filename" required><br>
  <input type="submit" value="upload">
  <input type="hidden" name="Email" value="<?php echo $Email; ?>">
  <input type="hidden" name="Password" value="<?php echo $Password; ?>">
  <br>
  </form>
  </html>
                                       
             <?php
			 
			 
		
		
		
			 
			 $files_query = "SELECT * FROM files  WHERE user_id = '$id' ORDER BY file_id DESC";
             $files_result = mysqli_query($link, $files_query) or die('error' . mysql_error());
   
						 
			 while ($files_line = mysqli_fetch_array($files_result, MYSQL_ASSOC))
			 {
		  
			 echo "<br>".$files_line['file']."</td>";
			 
            
             }
			
					 
			 
			 
			
			 echo "<br><br><a href='index.php'>log off</a><br>";
 
			 
			 }

mysqli_close($link);

?>