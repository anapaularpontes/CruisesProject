<?php

class PageAttractions {

static function showAttractions($attractions) {
  echo '<table class="table" style="width:100%;">
  <thead>
    <tr>
      <th>Attraction</th>
      <th>Tour (Ship / Sailing Date)</th>
      <th style="text-align:center;">Actions</th>
    </tr>
  </thead>
  <tbody>';
  foreach($attractions as $attraction) {
      echo '<tr>
      <td>'.$attraction->getAttractionName().'</td>
      <td>'.$attraction->getShipName().' / '.$attraction->getFormatedSailingDate().'</td>
      <td style="text-align:center;">
        <a href="'.$_SERVER['PHP_SELF'].'?act=edit&attractionID='.$attraction->getAttractionID().'" class="button is-primary">Edit</a>
        <a href="'.$_SERVER['PHP_SELF'].'?act=delete&attractionID='.$attraction->getAttractionID().'" class="button is-warning">Delete</a>
      </td>
    </tr>';
  }
  echo '</tbody>
</table>';
}



    static function showAttractionForm($attraction) {

      ToursMapper::initialize();
      $tours = ToursMapper::getTours(array());

      if($attraction->getAttractionID() == 0){
        $title = "Add Attraction";
      } else {
        $title = "Edit Attraction";
        
      }
    
        ?>

        <h3 class="title is-3"><?php echo $title; ?></h3>
        
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

          <div class="field">
            <label class="label">Attraction</label>
            <div class="control">
              <input class="input" type="text" name="attraction" id="attraction" value="<?php echo $attraction->getAttractionName();?>"/> 
            </div>
          </div>
          <div class="field">
            <label class="label">Tour (Ship / Sailing Date)</label>
            <div class="select is-fullwidth">
              <select name="tour" id="tour">
                <option value="0">Select Tour</option>
                <?php 
                  if(!empty($tours)) {
                    foreach($tours as $tour) {
                      echo '<option value="'.$tour->getId().'">'.$tour->getShipName().' / '.$tour->getFormatedSailingDate().'</option>';
                    }
                  }
                  ?>
              </select>
              <script>
                document.getElementById('tour').value = "<?php echo $attraction->getAttractionTour(); ?>";
              </script>
            </div>
          </div>
          <div class="field">
            <div class="control">
              <input type="hidden" name="attractionID" value="<?php echo $attraction->getAttractionID();?>">
              <button class="button is-link" type="submit">Submit</button>
            </div>
          </div>
        </form>
        
        <?php
    }
}

?>