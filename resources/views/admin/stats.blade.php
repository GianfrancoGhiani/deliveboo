@extends('layouts.admin')

@section('content')


<div>

    <div class="container p-5">
        <div class="row row-cols-1">
            <div class="col row">
                {{-- <input class="col"  type="month" name="filter" id="filter" value="{{date('Y-m')}}"> --}}
                <input class="col-auto"  type="week" name="filter" id="week" value="{{date('Y').'-W'.date('W')}}">
                <button class="col-auto" id="sendFilter">Send</button>
            </div>
            <div class="col row align-items-center">
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

<script src="
https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js
"></script>

  
<script>
    

    const input_week = document.getElementById('week');
    //   input_week.addEventListener('change', () => {
    //     console.log(input_week.value);
    //   })


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
                        
                        hoverBackgroundColor:[
                          'rgba(255, 99, 132, 0.9)',
                          'rgba(255, 159, 64, 0.9)',
                          'rgba(255, 205, 86, 0.9)',
                          'rgba(75, 192, 192, 0.9)',
                          'rgba(54, 162, 235, 0.9)',
                          'rgba(153, 102, 255, 0.9)',
                          'rgba(201, 203, 207, 0.9)'
                        ],
                        backgroundColor: [
                          'rgba(255, 99, 132, 0.5)',
                          'rgba(255, 159, 64, 0.5)',
                          'rgba(255, 205, 86, 0.5)',
                          'rgba(75, 192, 192, 0.5)',
                          'rgba(54, 162, 235, 0.5)',
                          'rgba(153, 102, 255, 0.5)',
                          'rgba(201, 203, 207, 0.5)'
                        ],
                        borderColor: 'rgb(75, 192, 192)',
                        borderWidth: 1,
                        tension: 0.1
                    }],
                    options: {
                          scales: {
                                x: {
                                  grid: {
                                   color: 'rgb(75, 192, 192)',
                                   borderColor: 'green'
                                   }
                                },
                                y: {
                                  grid: {
                                       color: 'red',
                                     borderColor: 'green'
                                    }
                                    }
                              }
                           }
                    
                    };
                    const cfg = {
                        type: 'bar',
                        data: data,
                };
                const chart = new Chart(ctx, cfg);

                input_week.addEventListener('change', ()=>{
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
                let numTopProducts = (res.data.results.length > 5) ? 5 : res.data.results.length;
                for (let i = 0; i < numTopProducts; i++) {
                    // console.log(res.data.results[i].product_name);
                    topFiveProducts.push(res.data.results[i].product_name);
                    topFiveQuantities.push(res.data.results[i].total_quantity);
                    
                }
                // console.log(topFiveProducts, topFiveQuantities)
                const data = {
                    labels: topFiveProducts,
                    datasets: [{
                        data: topFiveQuantities,
                        hoverBackgroundColor:[
                          'rgba(255, 99, 132, 0.9)',
                          'rgba(255, 159, 64, 0.9)',
                          'rgba(255, 205, 86, 0.9)',
                          'rgba(75, 192, 192, 0.9)',
                          'rgba(54, 162, 235, 0.9)',
                          'rgba(153, 102, 255, 0.9)',
                          'rgba(201, 203, 207, 0.9)'
                        ],
                        backgroundColor: [
                          'rgba(255, 99, 132, 0.5)',
                          'rgba(255, 159, 64, 0.5)',
                          'rgba(255, 205, 86, 0.5)',
                          'rgba(75, 192, 192, 0.5)',
                          'rgba(54, 162, 235, 0.5)',
                          'rgba(153, 102, 255, 0.5)',
                          'rgba(201, 203, 207, 0.5)'
                        ],
                        hoverOffset: 0
                    }]
                };
                const cfg2 = {
                    type: 'pie',
                    data: data,
                    options:{
                        plugins: {
                            title: {
                                display: true,
                                text: 'Most ordered products',
                                font: {
                                    size: 18
                                }
                            },
                            
                            legend:{
                                position: 'bottom',
                                labels: {
                                    font: {
                                        size: 14,
                                    }
                                }
                            }
                    }
                }}
                new Chart(ctx2, cfg2);
            }
            )
        
    }
  </script>

@endsection