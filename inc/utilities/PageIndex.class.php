<?php

require_once('Log.class.php');

class PageIndex {
  public static $title = "Cruises";

  static function header() {
  ?>
      <!DOCTYPE html>
      <html lang="en">
        <head>
          <meta charset="utf-8">
          <title><?php echo self::$title; ?></title>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
          <link rel="stylesheet" href="css/bulma-calendar.min.css">
          <script src="js/bulma-calendar.min.js"></script>
          <style>
            footer {
              position: absolute;
              left: 0;
              bottom: 0;
              height: 60px;
              width: 100%;
              overflow:hidden;
              text-align:center;
            }
            html {
              position: relative;
              min-height: 100%;
            }
            body {
              margin: 0px 0px 60px 0px;
              padding: 0px 0px 60px 0px;
            }
          </style>
        </head>
          <body>
            <nav class="navbar is-link" role="navigation" aria-label="main navigation">
              <div class="navbar-brand">
                <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" 
                  data-target="navbarBasic">
                  <span aria-hidden="true"></span>
                  <span aria-hidden="true"></span>
                  <span aria-hidden="true"></span>
                </a>
                </div>
                <div id="navbarBasic" class="navbar-menu">
                  <div class="navbar-start">
                    <a class="navbar-item" href="ships.php">Ships</a>
                    <a class="navbar-item" href="index.php">Tours</a>
                    <div class="navbar-item has-dropdown is-hoverable">
                      <a class="navbar-link">Others</a>
                      <div class="navbar-dropdown">
                      <a class="navbar-item" href="attractions.php">Attractions</a>
                        <a class="navbar-item" href="cities.php">Cities</a>
                        <a class="navbar-item" href="facilities.php">Facilities</a>
                        <a class="navbar-item" href="facilitiesShip.php">Ship Facilities</a>
                      </div>
                    </div>
                  </div>
                  <div class="navbar-end">
                  </div>
                </div>
              </nav>
              <script>
              document.addEventListener('DOMContentLoaded', () => {
                const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
                if ($navbarBurgers.length > 0) {
                  $navbarBurgers.forEach( el => {
                    el.addEventListener('click', () => {
                      const target = el.dataset.target;
                      const $target = document.getElementById(target);
                      //console.log(target);
                      el.classList.toggle('is-active');
                      $target.classList.toggle('is-active');
                    });
                  });
                }
              });
              </script>
              <div id="container" style="margin:auto;width:95%;position:relative;">
    <?php
    }

  // Showing the table tours and the aside filters
  static function showTours($tour, $tours, $cities, $facilities, $ships, $attractions, $stats) {
      echo '
      <div class="columns">
        <div class="column">';
          // Calling the stats card
          self::showStat($stats);
          echo '<p class="title is-5">Filters</p>
          <p class="title is-6" style="margin:15px 0px 0px 0px;">Departure</p>';
          foreach($cities as $city) {
              echo '<a href="'.$_SERVER['PHP_SELF'].'?filter=Departure&addfilter='.$city->getId().'"
                id="a_dep'.$city->getId().'">'.trim($city->getName()).'</a></br>';
            }
          echo '<p class="title is-6" style="margin:15px 0px 0px 0px;">Destiny</p>';
          foreach($cities as $city) {
            echo '<a href="'.$_SERVER['PHP_SELF'].'?filter=Destiny&addfilter='.$city->getId().'" 
              id="a_des'.$city->getId().'">'.trim($city->getName()).'</a></br>';
            }
          echo '<p class="title is-6" style="margin:15px 0px 0px 0px;">Atractions</p>';
          foreach($attractions as $attraction) {
            echo '<a href="'.$_SERVER['PHP_SELF'].'?filter=Attraction&addfilter='.$attraction->getAttractionID().'"
              id="a_atr'.$attraction->getAttractionID().'">'.trim($attraction->getAttractionName()).'</a></br>';
          }
          echo '<p class="title is-6" style="margin:15px 0px 0px 0px;">Ships</p>';
          foreach($ships as $ship) {
            echo '<a href="'.$_SERVER['PHP_SELF'].'?filter=Ship&addfilter='.$ship->getShipID().'"
              id="a_ship'.$ship->getShipID().'">'.trim($ship->getShipName()).'</a></br>';
          }
          echo '<br/><a href="'.$_SERVER['PHP_SELF'].'?filter=none" class="button is-primary">Clear Filters</a>
        </div>  
        <div class="column is-10">';

        echo '<table class="table" style="width:100%;">
        <tr>
          <th>Ship</th>
          <th>Sailing Date</th>
          <th>Duration</th>
          <th>Departure</th>
          <th>Destiny</th>
          <th>One-Way</th>
          <th>Actions</th>
        </tr>';
    if(!empty($tours)) {
      foreach($tours as $t) {
        echo '<tr>
            <td>'.$t->getShipName().'</td>
            <td>'.$t->getFormatedSailingDate().'</td>
            <td style="text-align:right;">'.$t->getDuration().'</td>
            <td>'.$t->getFromCityName().'</td>
            <td>'.$t->getToCityName().'</td>
            <td>'.($t->getOneway()==1?'One Way':'Round Trip').'</td>
            <td>
              <a href="'.$_SERVER['PHP_SELF'].'?id='.$t->getId().'&a=e" class="button is-primary">Edit</a>
              <a href="'.$_SERVER['PHP_SELF'].'?id='.$t->getId().'&a=d" class="button is-warning">Delete</a>
            </td>
          </tr>';
      } 
      echo '<tr><th colspan="7">
        Your search returned '.sizeof($tours).' tours.</th></tr>';
    } else {
        echo '<tr><th colspan="7">Sorry, no Tours to show.</th></tr>';
    }
    echo '<tr><th colspan="7" style="text-align:right;">
      <a href="'.$_SERVER['PHP_SELF'].'?filter=none" class="button is-primary">
        Clear Filters
      </a>
      </th>
      </tr>';

    echo '</table>';

    if($tour->getId()==0) {
      echo '<h3 class="title is-3">Add Tour</h3>';
    } else {
      echo '<h3 class="title is-3">Edit Tour</h3>';
    }
  ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" METHOD="POST">
    <div class="field">
      <label class="label">Sailing Date</label>
      <div class="control">
        <input class="input" type="text" name="sailing" id="sailing" 
          value="<?php echo $tour->getFormatedSailingDate(); ?>" /> 
      </div>
    </div>
    <div class="field">
      <label class="label">Ship</label>
      <div class="select is-fullwidth">
        <select name="ship" id="ship">

          <option value="0">Select Ship</option>
      <?php
          foreach($ships as $ship) {
            echo '<option value="'.$ship->getShipID().'">'.$ship->getShipName().'</option>';
          }
      ?>
        </select>
      </div>
    </div>
    <div class="field">
      <label class="label">Duration</label>
      <div class="control">
        <input class="input" type="number" name="duration" id="duration" value="<?php echo $tour->getDuration(); ?>" />
      </div>
    </div>
    <div class="field">
      <label class="label">Departure</label>
      <div class="select is-fullwidth">
        <select name="departure" id="departure">
          <option value="0">Select City</option>
          <?php 
            if(!empty($cities)) {
              foreach($cities as $city) {
                echo '<option value="'.$city->getId().'">'.$city->getName().'</option>';
              }
            }
            ?>
        </select>
      </div>
    </div>
    <div class="field">
      <label class="label">Destiny</label>
      <div class="select is-fullwidth">
        <select name="destiny" id="destiny">
          <option value="0">Select City</option>
          <?php 
          if(!empty($cities)) {
            foreach($cities as $city) {
              echo '<option value="'.$city->getId().'">'.$city->getName().'</option>';
            }
          }
          ?>
        </select>
    </div>
    <div class="field">&nbsp;
      <div class="control">
        <label class="checkbox">
          <input type="checkbox" name="oneway" id="oneway"> One Way
        </label>
      </div>
    </div>
    <div class="field is-grouped">
      <div class="control">
        <input type="hidden" name="id" value="<?php echo $tour->getId(); ?>" />
        <button class="button is-link" type="submit">Submit</button>
      </div>
    </div>
    </form>
    <script>
          document.getElementById('ship').value = "<?php echo $tour->getShip(); ?>";
          document.getElementById('departure').value = "<?php echo $tour->getFromCity(); ?>";
          document.getElementById('destiny').value = "<?php echo $tour->getToCity(); ?>";
          if("<?php echo $tour->getOneWay(); ?>"=="1") {
            document.getElementById('oneway').checked = true;
          }          
          let sailing = bulmaCalendar.attach('#sailing', 
            {"dateFormat":"DD-MMM-YYYY", "timeFormat": ""});
          
    </script>
    </div>
    </div>
    </div>
  <?php

  }
  
  // Marking the active filters as bold
  static function MarkFilters($filters) {
    echo '<script>';
    foreach($filters as $k => $f) {
      switch($k) {
        case 'Departure':
          echo 'document.getElementById(\'a_dep'.$f.'\').style.fontWeight = "bold";';
          break;
        case 'Destiny':
          echo 'document.getElementById(\'a_des'.$f.'\').style.fontWeight = "bold";';
          break;
        case 'Ship':
          echo 'document.getElementById(\'a_ship'.$f.'\').style.fontWeight = "bold";';
          break;
        case 'Attraction':
          echo 'document.getElementById(\'a_atr'.$f.'\').style.fontWeight = "bold";';
          break;
      }
    }
    echo '</script>';
    
    
  }

  // Show errors and log functions
  static function showErrors(Array $errors = array(), $stackMessage = null) {
        // Opens the log file
        $log = Log::openLog();
        // Shows a message in case of error opening the file
        if($log==false) {
          array_push($errors, "Impossible to log, please call the administrator");
        }
    ?>
        <article class="message is-warning">
          <div class="message-header">
            <p>Ooooppsss..</p>
          </div>
          <div class="message-body">
            <ul>
            <?php
              foreach($errors as $error) {
                echo '<li> + '.$error.'</li>';
                if($log==true) {
                  Log::appendLog($error);
                }
              }
              if($stackMessage!=null) {
                Log::appendLog($stackMessage);
              }
              Log::closeLog($error);
            ?>
            </ul>
          </div>
        </article>
  <?php
  }

  // Show (successfull) Messages to the user
  static function showMessages(String $message = 'Done') {
    ?>
        <article class="message is-warning">
          <div class="message-header">
            <p>Okay!</p>
          </div>
          <div class="message-body">
            <?php echo $message; ?>
          </div>
        </article>
  <?php
  }
  
  // Show the number of tours avaible for each month
  static function showStat(Array $stats) {
    ?>
        <div class="card">
          <header class="card-header">
            <p class="card-header-title">Tours Available by Month</p>
          </header>
          <div class="card-content">
            <div class="content">
              <table>
              <?php
                if(!empty($stats)) {
                  foreach($stats as $stat) {
                    $date = DateTime::createFromFormat('Y-m', $stat->year."-".$stat->month);
                    echo '<tr><td>'.$date->format('M-Y').'</td><td><strong>'.$stat->n.'<strong></tr>';
                    
                  }
                }
              ?>
              </table>
            </div>
          </div>
        </div><br/>
  <?php
  }

  static function footer() {
    ?>
        
        </div>
        <footer>
          <strong><h4>(Cruises) Ana Paula Ruiz Pontes - Cesar Reboucas - Lindsey Fergunson</h4></strong>
          <img src="img/wave.png">
        </footer >
      </body>
    </html>
  <?php
  }
}

?>