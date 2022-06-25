@extends('layouts.app')
@section('content')
    <div class="wrap-main">
        <div id="room-list" class="container">
            @include('room.list')
        </div>
    </div>
    @foreach($floors as $k => $rooms)
        @foreach($rooms as $room)
            @include('room.modal-room')
        @endforeach
    @endforeach
@endsection
@section('script')

@endsection

