<?php

class PageCities {
    static function showCities($cities) {
        if(!empty($cities)) {
        echo '<table class="table" style="width:100%;">
                <tr>
                    <th>City</th>
                    <th  style="text-align:center;">Actions</th>
                </tr>';
        foreach($cities as $city) {
            echo '<tr>
                <td>'.$city->getName().'</td>
                <td style="text-align:center;">
                <a href="'.$_SERVER['PHP_SELF'].'?id='.$city->getId().'&a=e" class="button is-primary">Edit</a>
                <a href="'.$_SERVER['PHP_SELF'].'?id='.$city->getId().'&a=d" class="button is-warning">Delete</a>
                </td>
            </tr>';
        }
        echo '</table>';
        }
    }

    static function FotmCity($city) {
        if($city->getId()==0) {
            echo '<h3 class="title is-3">Add City</h3>';
        } else {
            echo '<h3 class="title is-3">Edit City</h3>';
        }

    ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" METHOD="POST">
        <input type="hidden" name="id" value="<?php echo $city->getId(); ?>">
        <div class="field">
            <label class="label">Name</label>
            <div class="control">
                <input class="input" type="input" name="name" value="<?php echo $city->getName(); ?>" />
            </div>
        </div>
        <div class="field is-grouped">
            <div class="control">
                <button class="button is-link">Submit</button>
            </div>
            <BR>
        </div><BR>
        </form>
    <?php
    }
}

  ?>