<select required name="buildingid" id="buildingid" class="form-control">
  <option value="">None</option>
  <?php

      $buildings = DB::table('buildings')
        ->select('buildings.*')
        ->orderBy('id', 'asc')
        ->get();


    foreach ($buildings as $bldg) {
        ?>
      <option value="<?= $bldg->id ?>"><?= $bldg->buildingname ?></option>
  <?php
    } ?>
</select>
