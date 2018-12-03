@extends('layouts.app')

@section('content')
<?php
if (is_object($order) && Auth::user()->id == $order->clientid) {
    ?>
    <div class="container">
      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div><br />
      @endif
    	<h2>Revise Order</h2>
    	<br/>
      <div class="row">
        <div class="col">
        </div>
        <div class="col-md-6">
          <form class="form-horizontal" role="form" method="POST" action="{{ action('OrderController@reviseSubmit',$order->id) }}">
               {!! csrf_field() !!}
               <input type="hidden" name="_method" value="POST">
    			  <div class="row">
    			    <div class="col-md-6">
    						<div class="form-group">
    							<input type="hidden" value="{{csrf_token()}}" name="_token" />
    							<input id="horsename" name="horsename" type="text" value="{{ $order->horsename }}" placeholder="Horse Name" class="form-control input-md" required />
    					</div>
    			    </div>
    			    <div class="col-md-6">
    						<div class="form-group">
    							<input type="hidden" value="{{csrf_token()}}" name="_token" placeholder="Location"/>
                  <select required name="locationid" id="locationid" class="form-control">
                    <option value="">Location</option>
                    <?php
                    foreach ($RR as $loc) {
                        if ($loc->id == $order->locationid){
                          $selected = 'selected';
                        } else {
                          $selected = '';
                        }
                        $location = $loc->address.", ".$loc->city.", ".$loc->state
                          ?>
                        <option {{ $selected }} value="<?= $loc->id ?>"><?= $location ?></option>
                    <?php
                      } ?>
                  </select>
    					</div>
    			    </div>
    					<div class="col-md-6">
    						<div class="form-group">
    							<input type="hidden" value="{{csrf_token()}}" name="_token" />
                  <input id="buildingid" name="buildingid" type="text" value="{{ $order->buildingid }}" placeholder="Building" class="form-control input-md">
    					</div>
    					</div>
    					<div class="col-md-6">
    						<div class="form-group">
    							<input type="hidden" value="{{csrf_token()}}" name="_token" />
    							<input id="stablenumber" name="stablenumber" type="number" value="{{ $order->stablenumber }}" placeholder="Stable Number" class="form-control input-md">
    					</div>
    					</div>
    					<div class="col-md-6">
    						<div class="form-group">
    							<input type="hidden" value="{{csrf_token()}}" name="_token" />
                  <select required name="serviceid" id="serviceid" class="form-control">
                    <option value="">Service</option>
                    <?php
                      foreach ($services as $serv) {
                        if ($serv->id == $order->serviceid){
                          $selected = 'selected';
                        } else {
                          $selected = '';
                        }
                          ?>
                        <option {{ $selected }} value="<?= $serv->id ?>"><?= $serv->servicename ?></option>
                    <?php
                      } ?>
                  </select>
    					</div>
    			    </div>
    					<div class="col-md-6">
    						<div class="form-group">
    							<input type="hidden" value="{{csrf_token()}}" name="_token" />
    							<input id="color" name="color" value="{{ $order->color }}" type="text" placeholder="Color" class="form-control input-md">
    					</div>
    					</div>
    					<div class="col-md-6">
    						<div class="form-group">
    							<input type="hidden" value="{{csrf_token()}}" name="_token" />
    							<select required name="tied" id="tied" class="form-control">
                  <?php if ($order->tied == 1){?>
                    <option selected value="1">Yes</option>
                    <option value="0">No</option>
                  <?php } else { ?>
                    <option value="1">Yes</option>
                    <option selected value="0">No</option>
                  <?php } ?>
    							</select>
    					</div>
    					</div>

    			    <div class="col-md-6">
    						<div class="form-group">
    							<input type="hidden" value="{{csrf_token()}}" name="_token"/>
    					    <input id="scheduledtime" value="{{ $order->scheduledtime }}" name="scheduledtime" />
    					</div>
    			    </div>
    					<div class="col-md-12">
    						<div class="form-group">
    							<input type="hidden" value="{{csrf_token()}}" name="_token" />
    							<label class="control-label" for="comments">Comments</label>
    							<textarea class="form-control" name="comments" rows="5" id="comments">{{ $order->comments }}</textarea>
    						</div>
    						<button type="submit" class="btn btn-default">Revise</button>

    					</div>

    			  </div>
    			</form>
        </div>
        <div class="col">
        </div>
      </div>
    </div>


<?php
} else {
                                ?>
  @include('functions.denied')
<?php
                            } ?>

@endsection
