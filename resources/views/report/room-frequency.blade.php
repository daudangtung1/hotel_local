
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
           <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<canvas id="myChart" width="400" height="400"></canvas>
<script>

	const DATA_COUNT = 7;
const NUMBER_CFG = {count: DATA_COUNT, min: -100, max: 100};

const labels = ['red', 'blue', 'green'];
const data = {
  labels: labels,
  datasets: [
    {
      label: 'Dataset 1',
      data: labels.map(() => {
        return [50, 100];
      }),
      backgroundColor: 'red',
    },
    {
      label: 'Dataset 2',
      data: labels.map(() => {
        return [25, 57];
      }),
      backgroundColor: 'blue',
    },
  ]
};
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: {
    plugins: {
      title: {
        display: true,
        text: 'Chart.js Bar Chart - Stacked'
      },
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


