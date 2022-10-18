@extends('layouts.app')
@section('content')
<div class="wrap-main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="card-title mb-0">{{$title}}</h2>
                        <div class="card-tools">
                            <a class="btn btn-default" href="{{ route('roles.index') }}"><i class="fas fa-angle-double-left"></i> Danh sách</a>
                        </div>
                    </div>
                    {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                    <div class="card-body">
                        <div class="tab-pane" id="settings">
                            <div class="form-horizontal">
                                <div class="form-group row">
                                    <label for="inputName" class="col-md-2 col-form-label">Tên chức vụ</label>
                                    <div class="col-md-10">
                                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label for="inputPermission" class="col-md-2 col-form-label">Quyền hạn</label>
                                    <div class="col-md-10">

                                        <div class="row">
                                            <div class="col-lg-12">
                                            <label class="fw-bold mb-5 all" style="cursor:pointer;">
                                                Toàn bộ
                                            </label>
                                            </div>
                                            <?php
                                            $abc = "";
                                            $len = count($permission);
                                            ?>
                                            @foreach($permission as $key => $value)

                                            <?php

                                            if ($key === 0) {
                                                echo '<div class="col-lg-4 mb-3">';
                                            }

                                            if ($abc != substr($value->name, 0, strpos($value->name, "-")) && $key === 0) {
                                                $abc = substr($value->name, 0, strpos($value->name, "-"));

                                                echo '<label  class="fw-bold mb-2 parent" style="cursor:pointer;">' . $abc . '</label><div class="block">';
                                            } else if ($abc != substr($value->name, 0, strpos($value->name, "-")) && $key !== 0) {
                                                $abc = substr($value->name, 0, strpos($value->name, "-"));
                                                echo '</div></div><div class="col-lg-4 mb-3">';
                                                echo '<label class="fw-bold mb-2 parent" style="cursor:pointer;">' . $abc . '</label><div class="block">';
                                            }

                                            ?>
                                            <label for="{{$value->id}}">
                                                {{ Form::checkbox('permission[]', $value->id, false, array('id' => $value->id, 'class' => 'name')) }}
                                                {{ $value->name }}
                                            </label>
                                            <br />
                                            <?php
                                            if ($key === $len - 1) {
                                                echo '</div></div>';
                                            }
                                            ?>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    $(document).ready(function() {
        $(".parent").click(function() {
            var checkBoxes = $(this).closest('.col-lg-4').find("input[name=permission\\[\\]]");
            checkBoxes.prop("checked", !checkBoxes.prop("checked"));
        });  
        
        $(".all").click(function() {
            var checkBoxes = $(this).closest('.row').find("input[name=permission\\[\\]]");
            checkBoxes.prop("checked", !checkBoxes.prop("checked"));
        });  
    });
</script>
@endsection