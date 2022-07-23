<div class="col-md-12">
    <div class="d-flex justify-content-end align-items-center mb-3">
        <div class="filter">
            <form action="{{route('reports.index')}}" class="d-flex" method="GET">
                <input type="text" class="form-control me-2 filter-date-not-time" placeholder="Chọn ngày" name="start_date" value="@if(!empty(request()->start_date)) {{request()->start_date}} @endif"  autocomplete="off">
                <input type="hidden" name="by" value="{{request()->by ?? ''}}">
                <select class="form-control" name="month_year" id="">
                    @foreach ($monthRanges as $month)
                        <option @if(!empty(request()->month_year) && request()->month_year == $month) selected
                                @endif value="{{$month}}">{{ $month }}</option>
                    @endforeach
                </select>
                <button class="btn btn-success me-2  d-flex align-items-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                        <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                    </svg>Lọc</button>
            </form>
        </div>
    </div>
        <div class="d-flex align-items-start">
            @if(!empty($items))
                @foreach ($items as $key => $item)
                    <table class="table table-sm  table-hover">
                        <thead>
                        <tr>
                            <th scope="col">{{ "Tháng $key" }}</th>
                            <th scope="col">Phòng trống</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($item as $subKey => $value)
                            <tr>
                                <td>{{ $subKey }}</td>
                                <td>{{ $value }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endforeach
            @endif
        </div>

    </table>
</div>
