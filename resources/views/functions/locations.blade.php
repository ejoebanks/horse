<select required name="locationid" id="locationid" class="form-control">
  <option value="">Location</option>
  <?php

      $RR = DB::table('locations')
        ->select('locations.*')
        ->orderBy('id', 'asc')
        ->get();


    foreach ($RR as $loc) {
      $location = $loc->address.", ".$loc->city.", ".$loc->state
        ?>
      <option value="<?= $loc->id ?>"><?= $location ?></option>
  <?php
    } ?>
</select>
