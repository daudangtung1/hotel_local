@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div id="room-list" class="container">
            @include('room.list')
        </div>
    </div>
@endsection