@extends('layouts.app')
@section('content')
<div class="wrap-main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h5>{{$title ?? ''}}</h5>
            </div>
            @can('Quản lý ngôn ngữ-update')
            <div class="col">
                <form class="row g-3" method="POST" action="@if(!empty($currentItem)){{route('languages.update', ['language'=>$currentItem])}} @else{{route('languages.store')}}@endif">
                    @if(!empty($currentItem))
                    {{method_field('PUT')}}
                    @endif
                    @csrf
                    <div class="col-md-12">
                        <label for="en" class="form-label fw-bold">En</label>
                        <textarea type="text" class="form-control form-control-sm form-control-sm" id="en" name="en" required>{{$currentItem->en ??''}}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="vi" class="form-label fw-bold">Vi</label>
                        <textarea type="text" class="form-control form-control-sm form-control-sm" id="vi" name="vi" required>{{$currentItem->vi ??''}}</textarea>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-sm @if(isset($currentItem)) btn-success @else
                            btn-primary @endif">@if(isset($currentItem)) {{__('Update')}} @else
                            {{__('Create')}} @endif</button>
                    </div>
                </form>
            </div>
            @endcan
            @can('Quản lý ngôn ngữ-list')
            <div class="col">
                <div class="d-flex justify-content-end align-items-center mb-3">
                    <div class="filter">
                        <form action="{{route('languages.create')}}" class="d-flex" method="GET">
                            <input type="text" autocomplete="off" name="s" id="s" class="form-control form-control-sm me-2" placeholder="{{__('Key_word')}}" value="@if(!empty(request()->s)){{request()->s}}@endif">
                            <button class="btn btn-success me-2  d-flex align-items-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                                    <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                                </svg>{{__('Filter')}}</button>
                            <button class="btn btn-danger d-flex align-items-center" type="submit" name="export" style=" white-space: nowrap;" value="export"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-excel" viewBox="0 0 16 16">
                                    <path d="M5.884 6.68a.5.5 0 1 0-.768.64L7.349 10l-2.233 2.68a.5.5 0 0 0 .768.64L8 10.781l2.116 2.54a.5.5 0 0 0 .768-.641L8.651 10l2.233-2.68a.5.5 0 0 0-.768-.64L8 9.219l-2.116-2.54z" />
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                </svg>{{__('Export')}}</button>
                        </form>
                    </div>
                </div>
                <table class="table table-sm table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">EN</th>
                            <th scope="col">VI</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $key => $item)
                        <tr>
                            <td>{{$item->id ??''}}</td>
                            <td>{{$item->en ??''}}</td>
                            <td>{{$item->vi ??''}}</td>
                            <td>
                                <div class="d-flex">
                                    @can('Quản lý ngôn ngữ-update')
                                    <a class=" text-warning d-inline-block" href="{{route('languages.edit',['language' => $item])}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                        </svg>
                                    </a>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">{{__('No_data')}}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-2 mb-2">
                    {{ $items->links('pagination::bootstrap-4') }}
                </div>
                <script>
                    $(document).ready(function() {
                        $('body').on('click', '.btn-ajax-delete', function(e) {
                            e.preventDefault();
                            if (!confirm("{{__('Confirm_delete')}}")) {
                                return false;
                            }

                            $(this).closest('form').submit();
                        })
                    });
                </script>
            </div>
            @endcan
        </div>
    </div>
</div>
@endsection