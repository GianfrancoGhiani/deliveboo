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
    {{-- <button id="mybtn">invia</button> --}}
    <div class="container p-5">
        <div class="row">
            <div class="col-12">

                <canvas id="myChart"></canvas>
            </div>
            {{-- <div class="col-6">

                <canvas id="myChart2"></canvas>
            </div> --}}
        </div>

    </div>
  </div>
{{-- <script >
//     import Chart from '../../../node_modules/chart.js/auto';
        
//     const mybtn = document.getElementById('mybtn');

//     mybtn.addEventListener('click', () => {

//             axios.get('/api/charts', { params: {
//                     restaurantId: {{Auth::user()->restaurant->id}}
//                 }}).then((res) => {
//                     console.log(res.data.results);
//                     createCharts(res.data.results);
//                 })

//         });
//     function createCharts(array){

//             const arrayLabels = [];
//             const arrayData = []
//                 arrayData.forEach(element => {
//                 arrayLabels.push(element.date);
//                 arrayData.push(element.total);
//             });

//     const ctx = document.getElementById('myChart');
      
//     const labels = arrayLabels;
//     // console.log(labels);
//     const data = {
//         labels: labels,
//         datasets: [{
//             label: 'N° Orders',
//             data: arrayData,
//             fill: false,
//             borderColor: 'rgb(75, 192, 192)',
//             tension: 0.1
//         },{
//             label: 'Bo',
//             data: [12,10,2],
//             fill: false,
//             borderColor: 'rgb(0, 105, 12)',
//             tension: 0.1
//         }],
//         options: {
//             plugins: {
//             legend: {
//                 labels: {
//                     // This more specific font property overrides the global property
//                     font: {
//                         size: 18
//                     }
//                 }
//             }
//         }
//     }
    
//     };

//     const cfg = {
//         type: 'line',
//         data: data,
//     };
//   new Chart(ctx, cfg);

// }
        

  </script> --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <script>
      
      const ctx = document.getElementById('myChart');
      
     
     
      // const data = [10,23];
     const mybtn = document.getElementById('mybtn');

    

        setTimeout(() => {
            
        
    
            axios.get('/api/charts', { params: {
                    restaurantId: {{Auth::user()->restaurant->id}}
                }}).then((res) => {
                    console.log(res.data.results);

                    
                const arrayResponse = res.data.results

                const arrayLabels = [];
                const arrayData = []
                    arrayResponse.forEach(element => {
                    arrayLabels.push(element.date);
                    arrayData.push(element.total);
                });
      
      
                    const labels = arrayLabels;
                    console.log(labels);
                    const data = {
                    labels: labels,
                    datasets: [{
                        label: 'N° Orders',
                        data: arrayData,
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    },{
                        label: 'Bo',
                        data: [12,10,2],
                        fill: false,
                        borderColor: 'rgb(0, 105, 12)',
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
                new Chart(ctx, cfg);


                const ctx2 = document.getElementById('myChart2');

                    const cfg2 = {
                type: 'doughnut',
                data: {
                    datasets: [{
                    data: [{id: 'Sales', nested: {value: 1500}}, {id: 'Purchases', nested: {value: 500}}]
                    }]
                },
                options: {
                    parsing: {
                    key: 'nested.value'
                    }
                }
                }
                new Chart(ctx2, cfg2);
                })

            }, 100);
 

        // const cose = '@foreach ($orders as $order) {!! $order !!} @endforeach';
        // const arraynonso = cose.split('  ');
        // console.log(arraynonso);
        // console.log(JSON.parse(arraynonso[1]));
        

        // const arrayLabels = [];
        // const arrayData = [];

        // arraynonso.forEach(element => {
        //     element = JSON.parse(element);
            
        //     arrayLabels.push(element.date.split(' ')[0]);
        //     arrayData.push(element.total);
        // });

        
  </script>
@endsection