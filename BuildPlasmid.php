<?php
$servername = "localhost";
$username = "root";
$password = "*";
$dbname = "GNPNDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
          }

$table="testy";
$sql="SELECT * FROM testy ";
$full=array();
$result = $conn->query($sql);

if ($result->num_rows >0) {
 while($row = $result->fetch_assoc()) {
          $full[]=$row;


}
}

for($n=7; $n>1;$n--){
$sql="SELECT * FROM reggie WHERE CDS LIKE '%".$n."'";

$ons=array();
$cds=array();
$result = $conn->query($sql);
if ($result->num_rows >0) {
   		    
    // output data of each row
            while($row = $result->fetch_assoc()) {
	    	       $id= $row['GeneID'];
		       $place=array_column($full,'GeneID');
		       $key=array_search($id,$place);
		       $length= strlen($full[$key]['ONS']);
		       $keys=$key-1;
		    
		       if($n>2){
		       $full[$keys]['ONS']= $full[$keys]['ONS'].substr($full[$key]['ONS'],49,$length-1);
		       }
		       else{
		       $full[$keys]['ONS']= $full[$keys]['ONS'].substr($full[$key]['ONS'],50,$length-1);
		}			      
			 
		       
		       
		       
		      
		      
}

}

}
$fp=fopen("new.csv","w");

foreach ($full as $fields) {
    fputcsv($fp, $fields);
    }
fclose($fp);
$place=array_column($full,'GeneID');
$length= count($place);
//for($key=0;$key<$length;$key++){
//$sql = "UPDATE Gene SET ONS ='".$full[$key]['ONS']."' WHERE GeneID=".$place[$key];

//$conn->query($sql);
//}
//for($l=7;$l>1;$l--){

//$sql="DELETE FROM Gene WHERE CDS LIKE '%".$l."'";
//echo "Best";
//$conn->query($sql);
//$sql="UPDATE Gene SET GeneID=GeneID-($l-1) Where CDS LIKE '%".$l."'";
//echo "Better";
//$conn->query($sql);


//}
//for($cds in $value){



//}
    

?>

<button type="button" onclick="location.href='Download.php'">here</button>
