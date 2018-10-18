<select required name="services" id="services" class="form-control">
  <option value="">None</option>
  <?php

      $services = DB::table('services')
        ->select('services.*')
        ->orderBy('id', 'asc')
        ->get();


    foreach ($services as $serv) {
        ?>
      <option value="<?= $serv->id ?>"><?= $serv->servicename ?></option>
  <?php
    } ?>
</select>
