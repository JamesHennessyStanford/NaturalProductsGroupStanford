
<?php
$servername = "localhost";
$username = "root";
$password = "HiMommy12";
$dbname = "GNPNDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
               }
$table="Beiber";
$sql="SELECT * FROM `mama`";
$result= $conn->query($sql);
$full=array();

$i=0;
if ($result->num_rows >0) {

 while($row = $result->fetch_assoc()) {
 	  $full[]=$row;
	 
	 
	 
          if($row['POS']=='1f'){
		
		$full[$i]['Promoter']=60;
		$full[$i]['Terminator']=7;
	  }
	  else if($row['POS']=='1'){
		
			
                $full[$i]['Promoter']=26;
		$full[$i]['Terminator']=15;
          }
          else if($row['POS']=='2'){
		
			
                $full[$i]['Promoter']=55;
                $full[$i]['Terminator']=5;
          }
          else if($row['POS']=='3'){
		
			
                $full[$i]['Promoter']=17;
                $full[$i]['Terminator']=3;
          }
	   else if($row['POS']=='4'){
		
			
                $full[$i]['Promoter']=27;
                $full[$i]['Terminator']=15;
          }
          else if($row['POS']=='5'){
		
			
                $full[$i]['Promoter']=59;
                $full[$i]['Terminator']=1;
          }
          else if($row['POS']=='6'){
		
			
                $full[$i]['Promoter']=57;
                $full[$i]['Terminator']=2;
          }
          else if($row['POS']=='7'){
		

			
                $full[$i]['Promoter']=75;
                $full[$i]['Terminator']=7;
          }


	  $i=$i+1;
	}
}
$length=count(array_column($full,'Promoter'));

$j=2;
$b=1;
$clusterID=26;
$clusterIDStop=array(27,29,31,32,35,38,41,42,45,47);
for($i=1;$i<$length;$i++){
	$sql="SElECT * From EngineeredGeneClusters Where GeneClusterID=".$full[$i]['GeneClusterID'];
	$result= $conn->query($sql);
	
	if ($result->num_rows >0) {
	
 	while($row = $result->fetch_assoc()) {
	
		   echo $row['ClusterName'];
	}
       	}
	if( $full[$i]['POS']<$full[$i-1]['POS']){

	$full[$i-1]['Terminator']='7';  

	}
	$k=$i+7;
	echo "<br>".$full[$k]['POS']."<br>";
	if($k<$length){
		if($full[$k]['POS']<=$full[$k-1]['POS'] || $full[$k]['POS']=='1f'){
		   $j=$j+1;
		 
		 if($full[$k]['PlasmidID']<=$full[$k-1]['PlasmidID'] && $full[$k-1]['POS']!='1f' ){
		     echo $full[$k]['PlasmidID']." ".$full[$k-1]['PlasmidID']." ".$k."<br>";
		     $clusterID=$clusterID+1;
		     if(in_array($clusterID,$clusterIDStop)){
			while(in_array($clusterID,$clusterIDStop)){
					     $clusterID=$clusterID+1;
		     }
		 }
		 
		   
		}
		}
		
		   $full[$k]['PlasmidIDT']=$j;
		   $full[$k]['GeneClusterID']=$clusterID;
				       
	}
	

}

$fp=fopen("news.csv","w");

foreach ($full as $fields) {
    fputcsv($fp, $fields);
    }
fclose($fp);

		for($i=0;$i<$length;$i++){	    
			//  $sql="UPDATE  Cassette SET PlasmidID=".$full[$i]['PlasmidID']."Where CassetteID >8 ";
		
			  //$result= $conn->query($sql);


 }
			    
?>
<button type="button" onclick="location.href='dloads.php'">here</button>
