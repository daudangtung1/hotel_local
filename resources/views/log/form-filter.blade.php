<div class="d-flex justify-content-end align-items-center mb-3">
    <div class="filter">
        <form action="{{route('logs.index')}}" class="d-flex" method="GET">
            <input type="text" autocomplete="off"  name="title" id="title" class="form-control form-control-sm me-2" placeholder="Nhập tiêu đề " value="@if(!empty(request()->title)) {{request()->title}} @endif">
            <input type="text" autocomplete="off"  name="user_name" id="user_name" class="form-control form-control-sm me-2" placeholder="Nhập tên người dùng" value="@if(!empty(request()->user_name)) {{request()->user_name}} @endif">
            <input type="text" autocomplete="off"  class="form-control form-control-sm me-2 filter-date" placeholder="Ngày tạo" name="created_at" value="@if(!empty(request()->created_at)) {{request()->created_at}} @endif"  autocomplete="off">
            <button class="btn btn-success me-2  d-flex align-items-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                    <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                </svg>Lọc</button>
        </form>
    </div>
</div>
