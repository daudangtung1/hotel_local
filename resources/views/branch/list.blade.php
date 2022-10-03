@extends('layouts.app')
@section('content')
<div class="wrap-main">
    <div id="room-list" class="container">
        <div class="row-room">
            <ul style="padding-left: 0px">
                @forelse($items as $key => $item)
                <li>
                    <div>
                        <h5 class="room-title">{{$item->name ??''}}</h5>
                        <div class="in-room align-items-start">
                            <p>{{$item->info ?? '' }}</p>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection