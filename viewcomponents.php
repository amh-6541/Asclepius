<style>
    table, th, td{
        border: 1px solid black;
        border-collapse: collapse;
        text-align: center;
    }
    
    tr:hover{
        background-color: White;
    }
</style>



<?php
    session_start();

    if(isset($_SESSION['useremail']) && !empty($_SESSION['useremail'])){
        ?>

<center>
<h1> <b>Asclepious</b></h1>
</center>

<br>
<br>
<br>

<input type="search" id="searchbox">
            <input type="button" value="Search" id="searchbtn">
            <br>
            <br>
            <script>
                var srcbtn=document.getElementById('searchbtn');
                srcbtn.addEventListener('click', searchprocess);
                
                function searchprocess(){
                    var searchvalue=document.getElementById('searchbox').value;
                    window.location.assign("searchpage.php?param1="+searchvalue);
                }
                
            </script>
       
	
     
 <table>
                <thead>
                    <tr>
                        <th> Component Number</th>
                        
                        <th> Component Details</th>
						<th>Component Image</th>
                        
                        <th> Component Name</th>
						<th> Component cost</th>
                        
                     </tr>  
						
                </thead>
                
                <tbody>
                    <?php
                        try{
                            
                            $dbcon = new PDO("mysql:host=localhost:3306;dbname=asclepious;","root","");
                            $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            
							
							
                            
                            $sqlquery="";
                           {
                                $sqlquery="SELECT * FROM medical_components ";
                            }

                            try{
                                $returnval=$dbcon->query($sqlquery); 
                                
                                $prestable=$returnval->fetchAll();
                                
                                foreach($prestable as $row){
                                    ?>
                                        <tr>
                                            <td><?php echo $row['Component_Number'] ?></td>   
                                             <td><?php echo $row['Component_details'] ?></td> 
											 
                                       								
                                            <td><a href="<?php echo $row['Component_Image'] ?>"download>
                                                <img width="150" height="150" alt="No prescription found" src="<?php echo $row['Component_Image'] ?>"></a>
                                            </td>
											
											
											
                                             <td><?php echo $row['Component_Name'] ?></td> 
											   
											    <td><?php echo $row['Cost'] ?></td> 
										
                                        </tr>
                                    <?php
                                }
                            }
                            catch(PDOException $ex){
                                ?>
                                    <tr>
                                        <td colspan="5">Data read error ... ...</td>    
                                    </tr>
                                <?php
                            }
                            
                        }
                        catch(PDOException $ex){
                            ?>
                                <tr>
                                    <td colspan="5">Data read error ... ...</td>    
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>

































































	 <br>
	
			<br>       
            <input type="button" value="Logout" id="logoutbtn">

            <script>
                var elm=document.getElementById('logoutbtn');
                elm.addEventListener('click', processlogout);
                
                function processlogout(){
                    window.location.assign('logoutprocess.php');
                }
                
            </script>

<?php
    }
    else{
      
        ?>
            <script>
                window.location.assign('loginpage.php');
            </script>
        <?php
    }
?>