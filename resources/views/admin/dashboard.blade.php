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
        <div class="row row-cols-1">
            <div class="col row">
                {{-- <input class="col"  type="month" name="filter" id="filter" value="{{date('Y-m')}}"> --}}
                <input class="col"  type="week" name="filter" id="week" value="{{date('Y').'-W'.date('W')}}">
                <button class="col" id="sendFilter">Send</button>
            </div>
            <div class=" col row align-items-center">
                <div class="col-6">
                    <canvas id="myChart"></canvas>
                </div>
                <div class="col-6">
                    <canvas id="myChart2"></canvas>
                </div>
            </div>
        </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <script>

    const input_week = document.getElementById('week');
      input_week.addEventListener('change', () => {
        console.log(input_week.value);
      })

    const ctx = document.getElementById('myChart');
      
     
     

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

    const createChart = function (week){
        axios.get('/api/charts/weekorders', { params: {
                    restaurantId: {{Auth::user()->restaurant->id}},
                    week_ago: week 

                }}).then((res) => {
                      console.log(res.data.results);

                    
                const arrayResponse = res.data.results;

                const days = [];
                for(let day of Object.values(res.data.results)){
                    // console.log(day);
                    days.push(day);
                    
                }
                // console.log(days);

                const data = {
                    
                    labels: ['Monday','Tuesday','Wednesday','Thursday ','Friday','Saturday','Sunday'],
                    datasets: [{
                        label: 'N° Orders',
                        // data: createArraysToChart(arrayResponse)[1],
                        data: days,
                        fill: false,
                        color: 'rgb(75, 192, 192)',
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
                        beginAtZero: true
                    }
                    }}
                    
                    };
                    const cfg = {
                        type: 'bar',
                        data: data,
                };
                const chart = new Chart(ctx, cfg);

                filterBtn.addEventListener('click', ()=>{
                    const dateArray =document.getElementById('week').value;
                    let weekYear = dateArray.split('-')[1];
                    weekYear = parseInt(weekYear.split('')[1]+weekYear.split('')[2]);
                    const week_ago = {{date('W')}} - weekYear;
                    chart.destroy();
                    createChart(week_ago);
                
                })
            })
    }

    setTimeout(() => {
        createChart(0);
        createOrderChart();

    }, 100);

    const createOrderChart = function ()
    {
        axios.get('/api/charts/mostordered', { params: {
            restaurantId: {{Auth::user()->restaurant->id}}
            }}).then((res) => {
                // console.log(res.data.results)
                const ctx2 = document.getElementById('myChart2');
                const topFiveProducts = [];
                const topFiveQuantities = [];
                for (let i = 0; i < 5; i++) {
                    // console.log(res.data.results[i].product_name);
                    topFiveProducts.push(res.data.results[i].product_name);
                    topFiveQuantities.push(res.data.results[i].total_quantity);
                    
                }
                // console.log(topFiveProducts, topFiveQuantities)
                const data = {
                    labels: topFiveProducts,
                    datasets: [{
                        data: topFiveQuantities,
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(75, 192, 192)',
                            'rgb(255, 205, 86)',
                            'rgb(0,130,130)',
                            'rgb(0,130,10)'
                        ],
                        hoverOffset: 0
                    }]
                };
                const cfg2 = {
                    type: 'pie',
                    data: data,
                    options: {plugins:
                        {legend:
                            {position: 'right'}
                        }
                    }
                };
                 new Chart(ctx2, cfg2);
            })
        
    }
  </script>
@endsection