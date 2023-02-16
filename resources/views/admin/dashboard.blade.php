@extends('layouts.admin')

@section('content')
<div id="dashboard" class="container">
    {{-- <div class="row justify-content-center">
        <div class="col-8">
            <div class="card bg-dark-light">
                <div class="card-header py-4 d-flex justify-content-around">
                    <img src="{{asset('storage/'.$restaurant->image_url)}}" alt="Image"/>
                    <div>
                        <h1 class="orange">{{$restaurant->name}}</h1>
                        <div>Address: <span>{{$restaurant->address}}, New York</span></div>

                        <div>VAT Number: <span>{{$restaurant->piva}}</span></div>
                        <div>Tel: <span>{{$restaurant->tel_num}}</span></div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status')}}
                    </div>
                    @endif
                    <p>Welcome <span class="text-capitalize">{{ Auth::user()->name }}, </span>you have successfully logged in, now you are ready to manage your "{{$restaurant->name}}"</p>
                </div>
            <div>
            <ul class="flex-column dashboard-list">
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'admin.products.index' ? '' : '' }}" href="{{route('admin.products.index')}}">
                        <i class="fa-solid fa-newspaper fa-lg fa-fw"></i> Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'admin.orders.index' ? '' : '' }}" href="{{route('admin.orders.index')}}">
                        <i class="fa-solid fa-newspaper fa-lg fa-fw"></i> Orders
                    </a>
                </li>
            </ul>
            </div>
        </div>
    </div> --}}
</div>
<div>

    <div class="container p-5">
        <div class="row">
            <div class="row">
                <input class="col"  type="month" name="filter" id="filter" value="{{date('Y-m')}}">
                <button id="sendFilter">Send</button>
            </div>
            <div class="col-12">

                <canvas id="myChart"></canvas>
            </div>
            {{-- <div class="col-6">

                <canvas id="myChart2"></canvas>
            </div> --}}
        </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <script>
      
      const ctx = document.getElementById('myChart');
      
     
     
      // const data = [10,23];
    const mybtn = document.getElementById('mybtn');
    const filterBtn = document.getElementById('sendFilter');

    const createArraysToChart = function (arrayResponse){
        
        const arrayLabels = [];
        const arrayData = []
        arrayResponse.forEach(element => {
            arrayLabels.push(element.date);
            arrayData.push(element.total);
            // console.log(arrayLabels, arrayData)
        });
        // console.log(arrayLabels, arrayData)

        return [arrayLabels, arrayData];
    }

    const createChart = function (filterToSend){
        axios.get('/api/charts', { params: {
                    restaurantId: {{Auth::user()->restaurant->id}},
                    filter: filterToSend
                }}).then((res) => {
                     console.log(res.data.results);

                    
                const arrayResponse = res.data.results;
                // let [arrayLabel, arrayData] = createArraysToChart(arrayResponse);
                    
                // console.log(createArraysToChart(arrayResponse));
      
                    const labels = createArraysToChart(arrayResponse)[0];
                    // console.log(labels);
                    const data = {
                    labels: labels,
                    datasets: [{
                        label: 'N° Orders',
                        data: createArraysToChart(arrayResponse)[1],
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }],options: {
                    responsive: true,
                    interaction: {
                    mode: 'index',
                    intersect: false,
                    },
                    stacked: false,
                    plugins: {
                    title: {
                        display: true,
                        text: 'Chart.js Line Chart - Multi Axis'
                    }
                    },
                    scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',

                        // grid line settings
                        grid: {
                        drawOnChartArea: false, // only want the grid lines for one axis to show up
                        },
                    },
                    }}
                    
                    };

                    const cfg = {
                        type: 'line',
                        data: data,
                    };
                const chart = new Chart(ctx, cfg);
                    
                filterBtn.addEventListener('click', ()=>{
                    const dateArray =document.getElementById('filter').value.split('-');
                    let filter = '';
                    for (let i = 0; i < 2; i++) {
                        filter += dateArray[i]+'-'
                    }
                    console.log(filter)
                    chart.destroy();
                    createChart(filter);
                
                })
                // const ctx2 = document.getElementById('myChart2');

                //     const cfg2 = {
                // type: 'doughnut',
                // data: {
                //     datasets: [{
                //     data: [{id: 'Sales', nested: {value: 1500}}, {id: 'Purchases', nested: {value: 500}}]
                //     }]
                // },
                // options: {
                //     parsing: {
                //     key: 'nested.value'
                //     }
                // }
                // }
                // new Chart(ctx2, cfg2);
                 })
    }

        setTimeout(() => {createChart(document.getElementById('filter').value)}, 100);
 
        
  </script>
@endsection