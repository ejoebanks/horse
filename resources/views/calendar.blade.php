@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css"/>
@endsection
@section('content')
<div class="container">
   <div class="row">
     {!! $cal->calendar() !!}
   </div>
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
{!! $cal->script() !!}
@endsection
