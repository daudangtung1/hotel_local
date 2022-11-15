<div class="col-md-12">
    <div class="d-flex justify-content-end align-items-center mb-3">
        <div class="filter">
            <form action="{{route('reports.index')}}" class="d-flex" method="GET">
                <input type="text" autocomplete="off"  name="s" id="s" class="form-control form-control-sm me-2" placeholder="{{__('Key_word')}}" value="@if(!empty(request()->s)) {{request()->s}} @endif">
                <input type="text" autocomplete="off"  class="form-control form-control-sm me-2 filter-date" placeholder="{{__('Start_date')}}" name="start_date" value="@if(!empty(request()->start_date)) {{request()->start_date}} @endif"  autocomplete="off">
                <input type="text" autocomplete="off"  class="form-control form-control-sm me-2 filter-date" placeholder="{{__('End_date')}}" name="end_date" value="@if(!empty(request()->end_date)) {{request()->end_date}} @endif" autocomplete="off">
                <input type="hidden" name="by" value="{{request()->by ?? ''}}">
                <select name="type" id="type" class="form-control form-control-sm me-2">
                    <option value="">{{__('All')}}</option>
                    @foreach(\App\Models\RevenueAndExpenditure::STATUS as $key => $status)
                    <option value="{{$key}}" @if(!empty(request()->type) && request()->type == $key) selected @endif>
                        {{__($status)}}
                    </option>
                        @endforeach

                </select>
                <button class="btn btn-success me-2 d-flex align-items-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                        <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                    </svg>{{__('Filter')}}</button>
                <button class="btn btn-danger d-flex align-items-center" type="submit" name="export" style=" white-space: nowrap;" value="export" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-excel" viewBox="0 0 16 16">
                        <path d="M5.884 6.68a.5.5 0 1 0-.768.64L7.349 10l-2.233 2.68a.5.5 0 0 0 .768.64L8 10.781l2.116 2.54a.5.5 0 0 0 .768-.641L8.651 10l2.233-2.68a.5.5 0 0 0-.768-.64L8 9.219l-2.116-2.54z"/>
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                    </svg>{{__('Export_excel')}}</button>
            </form>
        </div>
    </div>
    <table class="table table-sm table-bordered table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('Name')}}</th>
            <th scope="col">{{__('Amount_money')}}</th>
            <th scope="col">{{__('Classify')}}</th>
            <th scope="col">{{__('Creator')}}</th>
            <th scope="col">{{__('Created_date')}}</th>
        </tr>
        </thead>
        <tbody>
        @forelse($items as $key => $item)
            <tr>
                <td>{{$item->id ??''}}</td>
                <td>{{$item->name ??''}}</td>
                <td>{{get_price($item->money ?? 0, 'đ')}}</td>
                <td>{{\App\Models\RevenueAndExpenditure::STATUS[$item->type]}}</td>
                <td>{{$item->user->name ?? __('Not_exist')}}</td>
                <td>{{$item->created_at ?? ''}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6">{{__('No_data')}}</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-2 mb-2">
        {{ $items->links('pagination::bootstrap-4') }}
    </div>
</div>
