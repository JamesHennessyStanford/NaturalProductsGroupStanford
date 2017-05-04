<?php
$servername = "localhost";
$username = "root";
$password = "HiMommy12";
$dbname = "GNPNDB";
$sql="SELECT * FROM Cassette";
$conn = new mysqli($servername, $username, $password, $dbname);
$result= $conn->query($sql);
$full=array();
$special=array();
$promArray=array();
$termArray=array();
if ($result->num_rows >0) {
 while($row = $result->fetch_assoc()) {
           $full[]=$row;
	   $special[]=$row['PlasmidID'];
	  
}
}

$geneArray=array();
$length=count($full);

for($j=0;$j<$length;$j++){
             $sql="SELECT ONS FROM Gene WHERE GeneID= '".$full[$j]['GeneID']."'";
	     $result= $conn->query($sql);
if ($result->num_rows >0) {
 while($row = $result->fetch_assoc()) {
            $geneArray[]=$row;
	    }
	    }
	    
	     }
	
for($j=0;$j<$length;$j++){
             $sql="SELECT Sequence FROM Promoter WHERE PromoterID= ".$full[$j]['PromoterID'];
             $result= $conn->query($sql);
	     if ($result->num_rows >0) {
	      while($row = $result->fetch_assoc()) {
	                  $promArray[]=$row;
			              }
				                  }

             }

for($j=0;$j<$length;$j++){
             $sql="SELECT Sequence FROM Terminator WHERE  TerminatorID= ".$full[$j]['TerminatorID'];
             $result= $conn->query($sql);
	     if ($result->num_rows >0) {
	      while($row = $result->fetch_assoc()) {
	                  $termArray[]=$row;
			              }
				                  }

             }
$resistArray=array();	     
for($j=0;$j<$length;$j++){
		
             $sql="SELECT Sequence From Resist Where ResistID in( SELECT ResistanceID FROM NewPlasmidID WHERE ResistanceID= ".$special[$j].")";
             $result= $conn->query($sql);
	     
	     if ($result->num_rows >0) {
	     
	      while($row = $result->fetch_assoc()) {
	                  $resistArray[]=$row;
			              }
				                  }

             }
	     
$b=1;
echo count($promArray);
echo count($geneArray);
echo count($termArray);
$plaCount= count(array_unique($special));
$i=0;

for($k=0;$k<$plaCount;$k++){
	$sequence="";
	do{ if($i!=2){
		$sequence= $sequence.$promArray[$i]['Sequence'].$geneArray[$i]['ONS'].$termArray[$i]['Sequence'];

}else{
		$sequence= $sequence.$promArray[$i]['Sequence'].$geneArray[$i]['ONS'].$termArray[$i]['Sequence'].$resistArray[$i];
}
		$i=$i+1;
	}while($special[$i]<$special[$i+1]);
	
	$sql="UPDATE NewPlasmidID SET Sequence ='".$sequence."' Where PlasmidID =".$k;
	$result= $conn->query($sql);
		     

}


?>