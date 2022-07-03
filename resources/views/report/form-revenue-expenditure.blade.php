<div class="col-md-12">
    <div class="d-flex justify-content-end align-items-center mb-3">
        <div class="filter">
            <form action="{{route('reports.index')}}" class="d-flex" method="GET">
                <input type="text" name="s" id="s" class="form-control me-2" placeholder="Từ khóa" value="@if(!empty(request()->s)) {{request()->s}} @endif">
                <input type="text" class="form-control me-2 filter-date" placeholder="Ngày bắt đầu" name="start_date" value="@if(!empty(request()->start_date)) {{request()->start_date}} @endif"  autocomplete="false">
                <input type="text" class="form-control me-2 filter-date" placeholder="Ngày kết thúc" name="end_date" value="@if(!empty(request()->end_date)) {{request()->end_date}} @endif" autocomplete="false">
                <input type="hidden" name="by" value="{{request()->by ?? ''}}">
                <button class="btn btn-success me-2">Lọc</button>
                <button class="btn btn-danger" type="submit" name="export" style=" white-space: nowrap;" value="export" >Xuất Excel</button>
            </form>
        </div>
    </div>
    <table class="table table-sm table-bordered table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tên</th>
            <th scope="col">Số tiền</th>
            <th scope="col">Phân loại</th>
            <th scope="col">Người tạo</th>
            <th scope="col">Ngày tạo</th>
        </tr>
        </thead>
        <tbody>
        @forelse($items as $key => $item)
            <tr>
                <td>{{$item->id ??''}}</td>
                <td>{{$item->name ??''}}</td>
                <td>{{get_price($item->money ?? 0, 'đ')}}</td>
                <td>{{\App\Models\RevenueAndExpenditure::STATUS[$item->type]}}</td>
                <td>{{$item->user->name ?? ''}}</td>
                <td>{{$item->created_at ?? ''}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6">Không có bản ghi nào</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-2 mb-2">
        {{ $items->links('pagination::bootstrap-4') }}
    </div>
</div>
