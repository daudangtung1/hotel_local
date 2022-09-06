
<div class="col-md-12">
    <div class="d-flex justify-content-end align-items-center mb-3">
        <div class="filter">
            <form action="{{route('reports.index')}}" class="d-flex" method="GET">
                <input type="text" class="form-control form-control-sm start-date me-2 filter-date-not-time" placeholder="Chọn ngày bắt đầu" name="start_date" value="{{ $from_date }}"  autocomplete="off">
                <input type="text" class="form-control form-control-sm end-date me-2 filter-date-not-time" placeholder="Chọn ngày kết thúc" name="end_date" value="{{ $to_date }}"  autocomplete="off">
                <select class="form-control form-control-sm" name="room_type" id="room_type" style="margin-right:7px">
                  @foreach ($types as $type)
                      <option @if(!empty(request()->room_type) && request()->room_type == $type->id) selected
                              @endif value="{{$type->id}}">{{ $type->name }}</option>
                  @endforeach
              </select>
                <select class="form-control form-control-sm" name="month_year" id="month_year">
                  @foreach ($monthRanges as $month)
                      <option @if(!empty(request()->month_year) && request()->month_year == $month) selected
                              @endif value="{{$month}}">{{ $month }}</option>
                  @endforeach
              </select>
                <input type="hidden" name="by" value="{{request()->by ?? ''}}">
                <button class="btn btn-success me-2  d-flex align-items-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                        <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                    </svg>Lọc</button>
            </form>
        </div>
    </div>
    <div class="d-flex align-items-start">
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <canvas id="myChart" width="400" height="400"></canvas>
      <script>
        var dataChart = @json($chart);

        const data = {
          labels: dataChart.labels,
          datasets:  [
            dataChart.room_used,
            dataChart.room_free
          ]
        };

        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
            plugins: {
              legend: {
                labels: {
                    // This more specific font property overrides the global property
                    font: {
                        size: 28
                    }
                }
            }
            },
            responsive: true,
            interaction: {
              intersect: false,
            },
            scales: {
              x: {
                stacked: true,
              },
              y: {
                stacked: true
              }
            }
            }
        });
      </script>
      </div>
    </table>
</div>


