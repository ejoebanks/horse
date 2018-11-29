@extends('layouts.app')

@section('content')
<?php
Use App\Notifications\AppointmentReminder;
?>
<table id="t1" class="table table-bordered">
  <thead>
    <tr>
      <th scope="col"><div class="defo">Remove</div></th>
      <th scope="col"><div class="defo">Horse</div></th>
      <th scope="col"><div class="defo">Monday</div></th>
      <th scope="col"><div class="defo">Tuesday</div></th>
      <th scope="col"><div class="defo">Wednesday</div></th>
      <th scope="col"><div class="defo">Thursday</div></th>
      <th scope="col"><div class="defo">Friday</div></th>
      <th scope="col"><div class="defo">Saturday</div></th>
      <th scope="col"><div class="defo">Sunday</div></th>

    </tr>
  </thead>

   <tr class="item">
       <td>
       </td>

       <td><input name="course" class="form-control" value="" placeholder="Horse Name"/></td>
       <td><input name="course" class="form-control" value="" placeholder="Class"/></td>
       <td><input name="course" class="form-control" value="" placeholder="Class"/></td>
       <td><input name="course" class="form-control" value="" placeholder="Class"/></td>
       <td><input name="course" class="form-control" value="" placeholder="Class"/></td>
       <td><input name="course" class="form-control" value="" placeholder="Class"/></td>
       <td><input name="course" class="form-control" value="" placeholder="Class"/></td>
       <td><input name="course" class="form-control" value="" placeholder="Class"/></td>

  </tr>
</table>

<?php
?>

@endsection
