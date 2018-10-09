<form method="post" action="{{url('/home')}}">
  <div class="form-group">
    <label class="control-label col-sm-2" for="course">Course:</label>
      <input type="hidden" value="{{csrf_token()}}" name="_token" />
      @include('functions.locations')
  </div>
</form>
