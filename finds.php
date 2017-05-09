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
	  $nam= $_POST['Cluster'];
	  $name=$nam;
	  $version=$_POST['Version']."%";
	  echo $name;
	  $sql = "SELECT Distinct(GeneClusterID) FROM EngineeredGeneClusters  where ClusterName LIKE '".$name."' And Version LIKE 2.2";
	  $result = $conn->query($sql);
	  $x=1;
	  $geneArray=array();
	  $nameArray=array();
if ($result->num_rows >0) {
    // output data of each row
            while($row = $result->fetch_assoc()) {
	    	       $nameArray=$row;
		
		                    }
				                        } else {
							                        echo "0 results";
										                        }

$spot= $nameArray['GeneClusterID'];
$sql="SELECT * FROM  Cassette Where GeneClusterID =".$spot;
$result = $conn->query($sql);
echo $spot;	  
$full=array();
if ($result->num_rows >0) {
										    // output data of each row
										    	            while($row = $result->fetch_assoc()) {							     											    $full[]=$row;
        
		                    }
				                        } else {
							                        echo "0 results";
										                        }


										echo print_r($full);
									        $nameArray=array();
										$promArray=array();
										$termArray=array();
										$resistArray=array();
										$cassNumTable=array();
										$geneArray=array();																							   $length=count($full);
										$backboneArray=array();
										echo "<br>".$length."<br>"."bird"."<br>";																		
$j=0;
for($i=0;$i<$length;$i++){
										
$sql=" SELECT * From Gene Where GeneID=".$full[$i]['GeneID'];
										
									
$result= $conn->query($sql);

if ($result->num_rows >0) {
										    // output data of each row
										            while($row = $result->fetch_assoc()) {

                $nameArray[]=$row['GeneName'];
		                $curve= strlen($row['ONS'])-50;
				                $nameforGene=substr($row['ONS'] ,50,$curve-50);

                $geneArray[]=$nameforGene;
		                $cassNumTable[]="'".$row['GeneID']."'";

                $x=$x+1;
		                    }
				                        } else {
							                        echo "0t results";
										                        }
													
$sql="SELECT * FROM Promoter Where PromoterID=".$full[$i]['PromoterID'];

$result= $conn->query($sql);

if ($result->num_rows >0) {
    // output data of each row
                while($row = $result->fetch_assoc()) {
		                       $promArray[]=$row;

                                    }
				                                                            } else {
											    echo "0g results";
																					                                                                                                            }
																														
$sql="SELECT Sequence FROM Resist Where ResistID =(Select ResistanceID From NewPlasmidID Where PlasmidID =  ".$full[$i]['PlasmidID'].")";
$result= $conn->query($sql);

if ($result->num_rows >0) {
    // output data of each row
                  while($row = $result->fetch_assoc()) {
		  echo "Bees";
		                                                       $resistArray[]=$row;

                                    }
				                                                                                                                                    } else {
																				                                                                                                                                                                                                               
																																													                                                                                                        echo "0Zach results";                                                                                         
																																																										                                                                          }

$sql="SELECT Sequence FROM backbone Where backboneid in(Select BackboneID From NewPlasmidID Where PlasmidID =  ".$full[$i]['PlasmidID'].")";
$result= $conn->query($sql);

if ($result->num_rows >0) {
    // output data of each row
                      while($row = $result->fetch_assoc()) {
		                                                            $backboneArray[]=$row;

                                    }

                                                                                                                                                                    } else {
																				                                                                                                                                                                                                               
																																													                                                                            echo "n0T results";

}

$sql="SELECT * FROM Terminator Where TerminatorID=".$full[$i]['TerminatorID'];
$result= $conn->query($sql);


if ($result->num_rows >0) {
    // output data of each row
       	      while($row = $result->fetch_assoc()) {
	      		   			   if($i==$length-1){
						   $termArray[]=$termArray[0].$backboneArray[$j]['Sequence'];
						   $j=$j+1;
						   }
						   else if($full[$i+1]['OOP']==1){
						    $termArray[]=$row.$backboneArray[$j]['Sequence'];
						    $j=$j+1;
						    
						   }
						   else{
	                                             $termArray[]=$row;
						     }
						  //   if($b==2){
						    // $termArray[$i]['Sequence']= $termArray[$i]['Sequence'].$resistArray[$i]['Sequence']
						     //}
						  

                                    }
				                                                                                                } else {
																                                                                                                                                                                            echo "0v results";																									                                                                                }

																																																																								                            






}
$x=0;
$b=0;
echo print_r($backboneArray);
foreach($geneArray as $value){
      // $rest=substr($termArray[$x],50,strlen($termArray[$x]));
            // $tired=substr($promArray[$x],0,strlen($promArray[$x])-50);
	            
                echo ">".$nameArray[$x]."<br>";
                    echo $promArray[$x]['Sequence'].$geneArray[$x].$termArray[$x]['Sequence']."<br>";
		    if($full[$x]['OOP']==2 && $full[$x+1]['OOP']==3){
                     $finalString=$finalString.">".$nameArray[$x]."\n";
		     $finalString=$finalString.$promArray[$x]['Sequence'].$geneArray[$x].$termArray[$x]['Sequence'].resistArray[$b]['Sequence']."\n";
		    
		     $b=$b+1;			  
		    } else{
 	             $finalString=$finalString.">".$nameArray[$x]."\n";
		     $finalString=$finalString.$promArray[$x]['Sequence'].$geneArray[$x].$termArray[$x]['Sequence']."\n";
		     }
			           $x=$x+1;
			}

echo $x;
$myfile = fopen("filers.fasta", "w") or die("Unable to open file!");
fwrite($myfile, $finalString);

fclose($myfile);
$conn->close();

													
?>

<button type="button" onclick="location.href='dloadsTwo.php'">Download the Fasta File</button>
