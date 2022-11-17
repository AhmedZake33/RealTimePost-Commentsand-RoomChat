@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      Private message to 
      @if (Auth::user()->id == $recived->id)
        {{$sender->name}} 
      @else
        {{$recived->name}}  
      @endif
    </div>
    @if(auth()->user())
    <private-component :recived="{{$recived}}" :sender="{{$sender}}" :Auth="{{$Auth}}"></private-compoent>
    @endif
</div>
@endsection
