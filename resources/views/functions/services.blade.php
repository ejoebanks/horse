<select required name="services" id="services" class="form-control">
  <option value="">None</option>
  <?php

      $services = DB::table('services')
        ->select('services.*')
        ->orderBy('serviceid', 'asc')
        ->get();


    foreach ($services as $serv) {
        ?>
      <option value="<?= $serv->serviceid ?>"><?= $serv->servicename ?></option>
  <?php
    } ?>
</select>
