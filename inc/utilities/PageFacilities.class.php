<?php

class PageFacilities{


    static function showFacilities($facilities){
            echo '<table class="table" style="width:100%;">
                    <tr>
                        <th>Facilities</th>
                        <th  style="text-align:center;">Actions</th>
                    </tr>';
            foreach($facilities as $facility) {
                echo '<tr>
                    <td>'.$facility->getName().'</td>
                    <td style="text-align:center;">
                    <a href="'.$_SERVER['PHP_SELF'].'?action=edit&id='.$facility->getId().'" class="button is-primary">Edit</a>
                    <a href="'.$_SERVER['PHP_SELF'].'?action=delete&id='.$facility->getId().'" class="button is-primary">Delete</a>
                    </td>
                </tr>';
            }
            echo '</table>';

            }

           static function facilitiiesFooter(){

            echo '<img src="img/wave.png">';

            }

    static function addFacilitiesForm(){ ?>
    <HR>
    <h1 class="title is-3" >Add Facility</h1>
    
        <form METHOD="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
        
        <input type="hidden" name="post" value="add">
        <div class="field">
            <label class="label">Facilities</label>
            </div>
            
            <div class="control">
                <input class="input" type="input" name="name" value="" placeholder="Facility Name" />
               
                <BR>
            </div>
        <div class="field is-grouped">
            <div class="control">
                <BR>
                <button class="button is-link">Submit</button>
            </div>
        </div>
        </form>
        <BR>
        


<?php    }

 static function editFacilitiesForm($facility){ ?>
    <h1 class="title is-3" >Edit Facility</h1>
        <form METHOD="POST" action="./facilities.php" >
        <input type="hidden" name="post" value="update">
        <div class="field">
        <div class="control">
            <label class="label">Facilities</label>
            </div>
            
            <input type="hidden" name="facilityID" value="<?php echo $facility->getId(); ?>">
            <div class="control">
            
                <input class="input" type="input" name="name" value="<?php echo $facility->getName(); ?>">
                <BR>
        </div>
        <div class="field is-grouped">
            <div class="control">
            <BR>
                <button class="button is-link">Submit</button>
               
            </div>
        </div>
        </form>
        <BR>
<?php }

 }



?>