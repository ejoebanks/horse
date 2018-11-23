<select required name="serviceid" id="serviceid" class="form-control">
  <option value="">Service</option>
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
