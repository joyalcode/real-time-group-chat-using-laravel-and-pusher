@extends('layout')
@section('content')
<div id="overlay">
   <form method="post" action="{{url('chat')}}">
   {{csrf_field()}}
      <div class="col-sm-4  col-sm-offset-4 starter">
         <div class="input-group">
            <input name="name" type="text" class="form-control" placeholder="Enter your name here">
            <span class="input-group-btn">
               <button class="btn btn-primary" type="submit" id="start_discussion">Start Discussion</button>
            </span>
         </div>
      </div>
   </form>
</div>
@endSection