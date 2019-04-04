<?php

class PageFacilitiesShip{

    static function displayShipFacilties($shipFacilities){

        echo '<table class="table" style="width:100%;">
        <tr>
            <th>Ship Name</th>
            <th>Ship Year</th>
            <th>Ship Facilities</th>
            <th  style="text-align:center;">Actions</th>
                </tr>';
        foreach($shipFacilities as $sf) {
            echo '<tr>
                <td>'.$sf->shipName.'</td>
                <td>'.$sf->yearservice.'</td>
                <td>'.$sf->facilityName.'</td>
                <td style="text-align:center;">
                    <a href="'.$_SERVER['PHP_SELF'].'?action=edit&id='.$sf->getID().'"class="button is-primary">Edit</a>
                    <a href="'.$_SERVER['PHP_SELF'].'?action=delete&id='.$sf->getID().'"class="button is-primary">Delete</a>
                    </td>
            </tr>';
        }
        echo '</table>';
            }

            static function displaySearchResults($searchShips){
        
                echo '<BR><div class="select is-fullwidth">
                <label class="label">Results for "'. $_POST['searchValue'].'"</label>';
                
                echo '<table class="table" style="width:100%;">
                <tr>
                <th>Ship Name</th>
                <th>Ship Year</th>
                <th>Ship Facilities</th>
                    </tr>';
            foreach($searchShips as $search) {
                echo '<tr>
                    <td>'.$search->shipName.'</td>
                    <td>'.$search->yearservice.'</td>
                    <td>'.$search->facilityName.'</td>
                </tr>
                ';
            }
        
            echo '<tr><td></td><td></td>
            <td>Search Result:   '. count($searchShips).'</td></tr></table> <HR><BR>';
            
                }
        



    static function searchForm(){   ?>
        <BR>
        <h1 class="title is-3" >Search for Ships based on Facilities</h1>
                
                <form METHOD="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
        
                    <input type="hidden" name="post" value="search">
                    <div class="field">
                     <label class="label">Facility Name:</label>
                       </div>
                      
                       <div class="select is-fullwidth">
                       <input class="input" type="text" name="searchValue" placeholder="Facility Name"> 
                
         
                       </div>
               
        
                            <div class="field is-grouped">
                                <div class="control">
                                    <BR>
                                    <button class="button is-link" name="searchButton">Submit</button>
                                </div>
                            </div>
                </form>
        
        
          <?php
    }

    static function addForm($s, $f){ ?>
        <HR>
        <h1 class="title is-3" >Add Facility to Ship</h1>
        
        <form METHOD="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
            <input type="hidden" name="post" value="add">
            <div class="field">
             <label class="label">Ships</label>
               
              
               <div class="select is-fullwidth">
                   <select name="shipOptions">
                       <option value="0">Please Select a Ship</option>
 
                       <?php foreach($s as $ship){   ?>
 
                       <OPTION value="<?php echo $ship->getShip()?>"><?php echo $ship->shipName?></OPTION>'; 
 
                     
                     <?php    } ?>
 
                   </select>
 
               </div>



                <label class="label">Facilities</label>
               
                 </div>
                
                <div class="select is-fullwidth">
                    <select name="facilityOptions">
                        <option value="0">Please Select a Facility</option>

                        <?php foreach($f as $option){   ?>

                        <OPTION value="<?php echo $option->getID()?>"><?php echo $option->getName()?></OPTION>'; 

                      
                      <?php    } ?>

                    </select>

                </div>
                            

            <div class="field is-grouped">
                <div class="control">
                    <BR>
                    <button class="button is-link">Submit</button>
                </div>
            </div>
        </form>
            <BR>

 <?php   }

    static function editForm($s, $f, $updateOptions){ ?>
    <HR>
    <h1 class="title is-3" >Edit Ship Facilities</h1>
    
    <form METHOD="POST" action="./facilitiesShip.php" >
        <input type="hidden" name="post" value="update">
        <input type="hidden" name="fsid" value="<?php echo $updateOptions->getID();?>">
        <div class="field">
         <label class="label">Ships</label>
           
          
           <div class="select is-fullwidth">
               <select name="shipOptions">
                   <option value="0">Please Select a Ship</option>
                   <option value="<?php echo $updateOptions->getShip()?>" selected><?php echo $updateOptions->shipName?></option>
                   <?php foreach($s as $ship){   ?>


                   <OPTION value="<?php echo $ship->getShip()?>"><?php echo $ship->shipName?></OPTION>'; 

                 
                 <?php    } ?>

               </select>

           </div>



            <label class="label">Facilities</label>
           
             </div>
            
            <div class="select is-fullwidth">
                <select name="facilityOptions">
                    <option value="0">Please Select a Facility</option>
                    <option value="<?php echo $updateOptions->getFacilities()?>" selected><?php echo $updateOptions->facilityName?></option>

                    <?php foreach($f as $option){   ?>

                    <OPTION value="<?php echo $option->getID()?>"><?php echo $option->getName()?></OPTION>'; 

                  
                  <?php    } ?>

                </select>

            </div>
                        

        <div class="field is-grouped">
            <div class="control">
                <BR>
                <button class="button is-link">Submit</button>
            </div>
        </div>
    </form>
        <BR>

<?php   }
}




?>