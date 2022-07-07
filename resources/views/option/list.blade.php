
<table class="table table-sm table-bordered table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Tên</th>
        <th scope="col">Địa chỉ</th>
        <th scope="col">Số điện thoại</th>
        <th scope="col">Email</th>
        <td scope="col">Fax</td>
    </tr>
    </thead>
    <tbody>
        @if($options)
          @foreach($options as $option)
          <tr>
            <td>{{ $option->id ?? ''}}</td>
            <td>{{ $option->name ?? '' }}</td>
            <td>{{ $option->address ?? ''}}</td>
            <td>{{ $option->phone ?? ''}}</td>
            <td>{{ $option->email ?? ''}} </td>
            <td>{{ $option->fax ?? ''}}</td>
          </tr>
          @endforeach
        @else
        <tr>
            <td colspan="4">Không có bản ghi nào</td>
        </tr>
        @endif
       </tbody>
</table>