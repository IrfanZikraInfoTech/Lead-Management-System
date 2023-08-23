<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<style>
    .heading {
        position: relative;
        font-weight: 600;
        text-transform: uppercase;
        text-align: center;
        letter-spacing: 2px;
        color:#777;
        letter-spacing: 1.1;
        display: inline-block; /* Use inline-block to make the width of the element adjust to the text size */
        
    }
    .heading::before {
        content: "";
        position: absolute;
        display: block;
        bottom: -3px; /* Adjust the position of the line based on your preference */
        left: 0;
        width: 0; /* Start the line with zero width */
        height: 3px;
        background-color: #777; /* Change the color of the line */
        transition: width 0.7s ease-in-out; /* Adjust the transition speed as needed */
    }

    .heading:hover::before {
        width: 100%; /* Scale the line to full width on hover */
    }

</style>

<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center my-3">
                <h2 class="text-2xl text-gray-900 mb-6 heading ">Lead Dashboard</h2>
            </div>        
            <!-- top cards -->
            <div class="flex flex-wrap gap-3 justify-start ">
                <div class="w-full lg:flex-grow md:flex-grow-0 lg:w-1/4 md:w-1/2 p-4 cursor-pointer">
                        <div class="bg-white p-6 rounded-[20px] shadow-xl hover:shadow-2xl border border-gray-200 transform transition-all duration-500 ease-in-out hover:scale-105 relative flex items-center justify-center">    
                        <div class="mr-6">
                            <p class="text-3xl font-extrabold text-[rgba(0,135,171)]"><?php echo $total_leads; ?></p>
                            <h5 class="text-lg font-medium text-uppercase mb-2 text-[rgba(0,135,171,0.6)]">Total Leads</h5>
                        </div>    
                        <div class="w-16 h-16 bg-[rgba(0,135,171)] rounded-full flex items-center justify-center ml-auto">
                            <i class="fas fa-users text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:flex-grow md:flex-grow-0 lg:w-1/4 md:w-1/2 p-4 cursor-pointer">
                        <div class="bg-white p-6 rounded-[20px] shadow-xl hover:shadow-2xl border border-gray-200 transform transition-all duration-500 ease-in-out hover:scale-105 relative flex items-center justify-center">    
                        <div class="mr-6">
                            <p class="text-3xl font-extrabold text-[rgba(0,135,171)]" data-target="<?= $new_customers_count ?>"><?= $new_customers_count ?></p>
                            <h5 class="text-lg font-medium text-uppercase mb-2 text-[rgba(0,135,171,0.6)]">New Customers</h5>
                        </div>
                        <div class="w-16 h-16 bg-[rgba(0,135,171)] rounded-full flex items-center justify-center ml-auto">
                            <i class="fas fa-user-plus text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:flex-grow md:flex-grow-0 lg:w-1/4 md:w-1/2 p-4 cursor-pointer">
                    <div class="bg-white p-6 rounded-[20px] shadow-xl hover:shadow-2xl border border-gray-200 transform transition-all duration-500 ease-in-out hover:scale-105 relative flex items-center justify-center">
                        <div class="mr-6">
                            <p class="text-2xl mb-2 font-bold text-[rgba(0,135,171)]"><?= $top_lead_source ?></p>
                            <h5 class="text-lg font-medium text-uppercase mb-2 text-[rgba(0,135,171,0.6)]">Top Lead Source</h5>
                        </div>
                        <div class="w-16 h-16 bg-[rgba(0,135,171)] rounded-full flex items-center justify-center ml-auto">
                            <i class="fas fa-trophy text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:flex-grow md:flex-grow-0 lg:w-1/4 md:w-1/2 p-4 cursor-pointer">
                    <div class="bg-white p-6 rounded-[20px] shadow-xl hover:shadow-2xl border border-gray-200 transform transition-all duration-500 ease-in-out hover:scale-105 relative flex items-center justify-center">
                        <div class="mr-6">
                            <p class="text-3xl font-extrabold text-[rgba(0,135,171)]" id="leadsNotResponded"><?= $leads_not_responded ?></p>
                            <h6 class="text-lg font-medium text-uppercase mb-2 text-[rgba(0,135,171,0.6)]">Awaiting Response</h6>
                        </div>
                        <div class="w-16 h-16 bg-[rgba(0,135,171)] rounded-full flex items-center justify-center ml-auto">
                            <i class="fas fa-exclamation-triangle text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:flex-grow md:flex-grow-0 lg:w-1/4 md:w-1/2 p-4 cursor-pointer">
                    <div class="bg-white p-6 rounded-[20px] shadow-xl hover:shadow-2xl border border-gray-200 transform transition-all duration-500 ease-in-out hover:scale-105 relative flex items-center justify-center">
                        <div class="mr-5">
                        <p class="text-2xl font-semibold text-[rgba(0,135,171)]">Conversion: <?= $campaign_performance['conversion_rate'] ?>%</p>
                            <h5 class="text-lg font-medium text-uppercase mb-2 text-[rgba(0,135,171,0.6)]"><?= $campaign_performance['campaign_name'] ?></h5>
                        </div>
                            <div class="w-16 h-16 bg-[rgba(0,135,171)] rounded-full flex items-center justify-center ml-auto">
                            <i class="fas fa-chart-bar text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:flex-grow md:flex-grow-0 lg:w-1/4 md:w-1/2 p-4 cursor-pointer">
                    <div class="bg-white p-6 rounded-[20px] shadow-xl hover:shadow-2xl border border-gray-200 transform transition-all duration-500 ease-in-out hover:scale-105 relative flex items-center justify-center">    
                        <div class="mr-6">
                            <p class="text-lg mb-2">Interactions: <span  class="font-extrabold text-[rgba(0,135,171)]"><?= $engagement_data['interactions'] ?></span></p>
                            <h5 class="text-lg font-medium text-uppercase text-monospace mb-2 text-[rgba(0,135,171,0.6)]">Total TEngagement</h5>
                        </div>
                        <div class="w-16 h-16 bg-[rgba(0,135,171)] rounded-full flex items-center justify-center ml-auto">
                            <i class="fas fa-eye text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- top cards ends-->
        </div>
        <!-- charts -->
        <div class="row mt-4 d-flex align-items-stretch ">
            <!-- lead Distribution -->
            <div class="col-lg-5 col-md-5 col-sm-12 mb-4 ">
                <div class="card bg-white shadow-lg rounded-lg hoverable py-3 cursor-pointer rounded-[20px] shadow-xl hover:shadow-2xl border border-gray-200">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center py-4">
                        <h2 class="card-title ms-1 text-uppercase text-center mb-4" style="font-weight: bold; color: #343a40; letter-spacing: 1.5px;">Lead Status Distribution</h2>
                        <div class="d-flex justify-content-center">
                            <canvas id="leadStatusChart" style="max-width: 85%; height: auto;"class="my-4 mx-auto"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Lead Source Tracking Card -->
            <div class="col-lg-7 col-md-7 col-sm-12 mb-4">

                <div class="card bg-white shadow-lg rounded-lg hoverable h-100  cursor-pointer rounded-[20px] shadow-xl hover:shadow-2xl border border-gray-200">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center py-4">
                        <h2 class="card-title ms-1 text-uppercase text-center py-2" style="font-weight: bold; color: #343a40; letter-spacing: 1.5px;">Lead Source Tracking</h2>
                        <div class="d-flex justify-content-center">
                            <canvas id="leadSourceChart"  style="max-width: 83%; height: auto;"class=" mx-auto"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4 d-flex align-items-stretch">
            <!-- Lead Distribution by Salesperson -->
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <div  class="card bg-white shadow-lg rounded-lg hoverable h-100  cursor-pointer rounded-[20px] shadow-xl hover:shadow-2xl border border-gray-200">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center py-4">
                        <h2 class="card-title ms-1 text-uppercase text-center mb-4"style="font-weight: bold; color: #343a40; letter-spacing: 1.5px;">Lead Distribution by Salesperson</h2>
                        <div class="d-flex justify-content-center">
                            <canvas class="mx-auto" id="leadBySalespersonChart"  style="max-width: 90%; height:auto;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Lead Conversion Rate Over Time -->
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4 ">
                <div  class="card bg-white shadow-lg rounded-lg hoverable h-100  cursor-pointer rounded-[20px] shadow-xl hover:shadow-2xl border border-gray-200">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center py-4">
                        <h2 class="card-title ms-1 text-uppercase text-center mb-4"style="font-weight: bold; color: #343a40; letter-spacing: 1.5px;">Lead Conversion Rate Over Time</h2>
                        <div class="d-flex justify-content-center">
                            <canvas class="mx-auto" id="leadConversionRateProgressBarChart" style="max-width: 90%; height: 200px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="row mt-4 d-flex align-items-stretch ">
            <!-- lead source top 3 -->
            <div class="col-lg-3 col-md-3 col-sm-12 mb-4">
                <div class=" card bg-white shadow-lg rounded-lg hoverable  py-1 cursor-pointer rounded-[20px] shadow-xl hover:shadow-2xl border border-gray-200">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center py-4">
                        <h2 class="card-title ms-1 text-uppercase text-center mb-4" style="font-weight: bold; color: #343a40; letter-spacing: 1.5px;">
                                Top Leads Source</h2>
                        <?php foreach ($leadSources as $source): ?>
                            <div class="mb-4 flex flex-col items-center">
                                <div class="relative w-32 h-32">
                                    <svg class="absolute transform -rotate-90" width="100%" height="95%" viewBox="0 0 42 42">
                                        <defs>
                                            <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                                <stop offset="0%" style="stop-color:rgba(85, 199, 219, 1);stop-opacity:1" />
                                                <stop offset="100%" style="stop-color:rgba(110, 231, 183, 1);stop-opacity:1" />
                                            </linearGradient>
                                        </defs>
                                        <circle class="text-gray-300" r="15.91549430918954" cx="21" cy="21" fill="transparent" stroke="#f3f3f3" stroke-width="5"></circle>
                                        <circle class="text-blue-600" r="15.91549430918954" cx="21" cy="21" fill="transparent" stroke="url(#gradient)" stroke-width="5" stroke-dasharray="<?= $source['count'] * 0.3183098861837907 ?>, 100"></circle>
                                    </svg>

                                        <div class="absolute top-0 left-0 flex justify-center items-center w-full h-full">
                                            <p class="text-2xl font-semibold"><?= $source['count'] ?>%</p>
                                        </div>
                                </div>
                                <p class="text-gray-600 font-bold text-center mb-2"><?= $source['source'] ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>  
                </div>
            </div>

                <!-- calender -->
            <div class="col-lg-9 col-md-9 col-sm-12 mb-4">
                <div class="card bg-white shadow-lg rounded-lg hoverable h-95 py-3 cursor-pointer rounded-[20px] shadow-xl hover:shadow-2xl border border-gray-200">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center py-4">
                        <h2 class="card-title ms-1 text-uppercase text-center mb-4" style="font-weight: bold; color: #343a40; letter-spacing: 1.5px;">
                        Event Calendar</h2>
                        <div class="d-flex justify-content-center w-[85%] h-[500px] mx-auto overflow-x-auto overflow-y-auto">
                            <div id="calendar" class="w-full h-full"></div>
                        </div>
                    </div>
                </div>
            </div>      
        </div>   
        <div class="row mt-4 d-flex align-items-stretch text-center">
            <!-- lifecycle -->
            <div class="col-lg-9 col-md-9 col-sm-9 mb-4 ">
                <div class="card bg-white shadow-lg rounded-lg hoverable h-auto  cursor-pointer rounded-[20px]      
                    shadow-xl hover:shadow-2xl border border-gray-200">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center py-4">
                    <h2 class="card-title ms-1 text-uppercase text-center mb-4"style="font-weight: bold; color: #343a40; letter-spacing: 1.5px;">Lead Lifecycle</h2>
                        <div class="d-flex justify-content-center">
                            <canvas class="mx-auto"id="leadLifecycleChart" style="max-width: 80%; height: auto;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- quick actions -->
            <div class="col-lg-3 col-md-3 col-sm-3 mb-4">
                <div class="card bg-white shadow-lg rounded-lg cursor-pointer rounded-[20px] shadow-xl border border-gray-200 transition-all duration-300">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center py-4">
                        <h2 class="card-title ms-1 text-uppercase text-center mb-2 font-semibold text-gray-700">
                            Quick Actions
                        </h2>
                        <hr class="mx-auto my-4 w-1/3 bg-gray-300">
                        <div class="d-flex justify-content-between ">
                            <div title=" lead's list"class="mb-5 w-20 h-20 bg-[rgba(0,135,171)] rounded-full flex items-center justify-center mx-auto shadow-inner-xl relative transform hover:-translate-y-2 transition-all duration-300 hover:shadow-2xl cursor-pointer active:translate-y-1 active:shadow-inner"
                                onclick="window.location.href='<?= admin_url('leads/list')?>'">
                                <i class="fas fa-tasks text-white text-2xl"></i>
                            </div>
                            <div title="lead lifecycle" class="mb-5 w-20 h-20 bg-[rgba(0,135,171)] rounded-full flex items-center justify-center mx-auto shadow-inner-xl relative transform hover:-translate-y-2 transition-all duration-300 hover:shadow-2xl cursor-pointer active:translate-y-1 active:shadow-inner"
                                onclick="window.location.href='<?= admin_url('leads/lifecycle')?>'">
                                <i class="fas fa-project-diagram text-white text-2xl"></i>
                            </div>
                            <div title="teritory builder" class="mb-5 w-20 h-20 bg-[rgba(0,135,171)] rounded-full flex items-center justify-center mx-auto shadow-inner-xl relative transform hover:-translate-y-2 transition-all duration-300 hover:shadow-2xl cursor-pointer active:translate-y-1 active:shadow-inner"
                                onclick="window.location.href='<?= admin_url('leads/territories')?>'">
                                <i class="fas fa-map-marked-alt text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4 d-flex align-items-stretch ">
            <!-- response time -->
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card bg-white shadow-lg rounded-lg hoverable h-100 py-2 cursor-pointer rounded-[20px] shadow-xl hover:shadow-2xl border border-gray-200">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center py-4">
                        <h2 class="card-title ms-1 text-uppercase text-center mb-4"style="font-weight: bold; color: #343a40; letter-spacing: 1.5px;">Lead Response Time Distribution</h2>
                        <div class="d-flex justify-content-center">
                            <canvas id="leadResponseTimeDonutChart" style="max-width: 90%; height: 200px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- history -->
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card bg-white shadow-lg rounded-lg hoverable h-100 py-2 cursor-pointer rounded-[20px] shadow-xl hover:shadow-2xl border border-gray-200">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center py-4">
                        <h2 class="card-title ms-1 text-uppercase text-center mb-4"style="font-weight: bold; color: #343a40; letter-spacing: 1.5px;">Lead Interaction History</h2>
                        <div class="d-flex justify-content-center">
                        <canvas id="leadInteractionChart"style="max-width: 90%; height: 200px;"></canvas>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- charts end -->
    </div>
</div>

<?php init_tail(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.3/chart.min.js" integrity="sha512-fMPPLjF/Xr7Ga0679WgtqoSyfUoQgdt8IIxJymStR5zV3Fyb6B3u/8DcaZ6R6sXexk5Z64bCgo2TYyn760EdcQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>


// leadStatusChart
<?php 
    $statusCharts_json = json_encode(array_values($statusCharts)); 
    $labels_json = json_encode(array_keys($statusCharts)); 
?>
var ctx = document.getElementById('leadStatusChart').getContext('2d');

function createGradient(ctx, color1, color2) {
    var gradient = ctx.createRadialGradient(150, 150, 100, 150, 150, 150); // This will simulate depth
    gradient.addColorStop(0, color1);
    gradient.addColorStop(1, color2);
    return gradient;
}

var leadStatusChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: <?php echo $labels_json; ?>,
        datasets: [{
            data: <?php echo $statusCharts_json; ?>,
            backgroundColor: [
                createGradient(ctx, 'rgba(110, 231, 183, 0.6)', 'rgba(110, 231, 183, 1)'),
                createGradient(ctx, 'rgba(59, 167, 255, 0.6)', 'rgba(59, 167, 255, 1)'),
                createGradient(ctx, 'rgba(85, 199, 219, 0.6)', 'rgba(85, 199, 219, 1)')
            ],
            hoverBackgroundColor: ['rgb(0, 135, 171)','rgb(0, 135, 171)','rgb(0, 135, 171)'],
            borderColor: ['#fff', '#fff', '#fff'],
            borderWidth: 2, // Increased border width for more pronounced edges
            borderAlign: 'inner',
            hoverBorderColor:  ['#fff', '#fff', '#fff'],
        }]
    },
    options: {
        responsive: true,
        cutout: '50%', 
        animation: {
            animateScale: true,
            animateRotate: true,
            duration: 1500,
            easing: 'easeOutQuart'
        },
        plugins: {
            legend: {
                position: 'bottom', 
                labels: {
                    usePointStyle: true,
                    padding: 20
                }
            }
        },
        elements: {
            arc: {
                borderColor: '#ffffff',
                borderWidth: 4,
                borderAlign: 'inner',  // This gives a faux "raised" effect
            }
        }
    }
});



// leadSourceChart

<?php 
    $sourceTracking_values_json = json_encode(array_values($sourceTrackingChart)); 
    $sourceTracking_labels_json = json_encode(array_map('ucfirst', array_keys($sourceTrackingChart))); 
?>
var ctx = document.getElementById('leadSourceChart').getContext('2d');

var gradient = ctx.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, 'rgba(110, 231, 183, 1)');
gradient.addColorStop(1, 'rgba(59, 167, 255, 1)');

var borderGradient = ctx.createLinearGradient(0, 0, 0, 400);
borderGradient.addColorStop(0, 'rgba(110, 231, 183, 1)');
borderGradient.addColorStop(1, 'rgba(59, 167, 255, 1)');

var leadSourceChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= $sourceTracking_labels_json; ?>,
        datasets: [{
            data: <?= $sourceTracking_values_json; ?>,
            backgroundColor: gradient,
            borderColor: borderGradient,
            borderWidth: 2,
            hoverBackgroundColor: ['rgb(0, 135, 171)','rgb(0, 135, 171)','rgb(0, 135, 171)'],
            hoverBorderColor: 'rgb(0, 135, 171)',
            borderRadius: 10,
            borderSkipped: false
        }]
    },
    options: {
        elements: {
            bar: {
                borderSkipped: false
            }
        },
        responsive: true,
        layout: {
            padding: {
                left: 20,
                right: 20,
                top: 20,
                bottom: 20
            }
        },
        scales: {
            x: {
                barPercentage: 0.5,
                categoryPercentage: 0.7
            },
            y: {
                beginAtZero: true,
                ticks: {
                    font: {
                        size: 15,
                        weight: 'bold'
                    },
                    color: '#333'
                },
                grid: {
                    borderColor: '#ddd'
                }
            }
        },
        plugins: {
            legend: {
                display: true,
                position: 'top',
                labels: {
                    color: '#333'
                }
            },
            animation: {
                duration: 1000,
                easing: 'easeInOutQuart',
                onComplete: function() {
                    var chartInstance = this.chart,
                        ctx = chartInstance.ctx;
                    ctx.font = Chart.helpers.fontString(Chart.defaults.font.size, Chart.defaults.font.style, Chart.defaults.font.family);
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'bottom';

                    this.data.datasets.forEach(function(dataset, i) {
                        var meta = chartInstance.controller.getDatasetMeta(i);
                        meta.data.forEach(function(bar, index) {
                            var data = dataset.data[index];
                            ctx.fillText(data, bar.x, bar.y - 5);
                        });
                    });
                }
            }
        }
    }
});

// Add shadow effect
var originalDraw = Chart.controllers.bar.prototype.draw;
Chart.controllers.bar.prototype.draw = function() {
    originalDraw.apply(this, arguments);
    var ctx = this.chart.chart.ctx;
    ctx.save();
    ctx.shadowColor = 'rgba(0, 0, 0, 0.2)';
    ctx.shadowBlur = 7;
    ctx.shadowOffsetX = 5;
    ctx.shadowOffsetY = 7;
    ctx.responsive = true;
    originalDraw.apply(this, arguments);
    ctx.restore();
};



// leadBySalespersonChart
var ctx = document.getElementById('leadBySalespersonChart').getContext('2d');
var gradientFill = ctx.createLinearGradient(0, 0, 0, 400);
gradientFill.addColorStop(0, 'rgba(110, 231, 183, 0.6)');  // Starting color with transparency
gradientFill.addColorStop(1, 'rgba(59, 167, 255, 0.6)');   // Ending color with transparency

var leadBySalespersonChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: Object.keys(<?= json_encode($leadsBySalesperson); ?>),
        datasets: [{
            data: Object.values(<?= json_encode($leadsBySalesperson); ?>),
            backgroundColor: gradientFill,  // Use the gradient fill here
            borderColor: ['#3BA7FF'],
            borderWidth: 3,
            pointBackgroundColor: '#3BA7FF',   // Point color
            pointBorderColor: '#fff',          // Point border color
            pointRadius: 5,                    // Point size
            pointHoverRadius: 7,               // Point size on hover
            pointBorderWidth: 2,               // Point border width
            fill: true                         // To fill color under the line
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        },
        animation: {
            duration: 2000,
            easing: 'easeInOutQuart'  // Smooth animation
        },
        legend: {
            display: false            // Hide legend for a cleaner look
        },
        tooltips: {
            intersect: false,          // Show tooltip without intersecting the point
            backgroundColor: 'rgba(0,0,0,0.7)',  // Slight transparent black background
            titleFontColor: '#fff',    // White color text
            bodyFontColor: '#fff',     // White color text
            borderColor: '#3BA7FF',    // Border color
            borderWidth: 1             // Border width
        }
    }
});



// leadConversionRateChart
var ctx = document.getElementById('leadConversionRateProgressBarChart').getContext('2d');
var gradient = ctx.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, 'rgba(59, 167, 255, 0.6)');
gradient.addColorStop(1, 'rgba(110, 231, 183, 0.6)');
var hovercolor = ('rgb(0, 135, 171)');

var leadConversionRateProgressBarChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        labels: <?= json_encode($conversionRates['dates']); ?>,
        datasets: [{
            label: 'Conversion Rate (%)',
            data: <?= json_encode($conversionRates['rates']); ?>,
            backgroundColor: gradient,
            hoverBackgroundColor: hovercolor, // Adding hover background color here
            borderColor: 'rgba(47, 137, 207, 0.8)',
            borderWidth: 2,
            borderRadius: 20,
            borderSkipped: false
        }]
    },
    options: {
        responsive: true,
        scales: {
            x: {
                beginAtZero: true,
                max: 100  // Assuming conversion rate is a percentage
            },
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            legend: {
                display: true,
                position: 'bottom',
            },
            animation: {
                duration: 1500,
                easing: 'easeInOutQuart',
            }
        }
    }
});
var ctx = document.getElementById('leadLifecycleChart').getContext('2d');

// Colors for the histogram bars
var colors = [
    createGradient(ctx, 'rgba(110, 231, 183, 0.6)', 'rgba(110, 231, 183, 0.8)'),
    createGradient(ctx, 'rgba(59, 167, 255, 0.6)', 'rgba(59, 167, 255, 0.8)'),
    createGradient(ctx, 'rgba(85, 199, 219, 0.6)', 'rgba(85, 199, 219, 0.8)')
];

var leadLifecycleData = <?= json_encode($leadLifecycleData); ?>;
var datasets = leadLifecycleData.leads.map(function(stageName, index) {
    return {
        label: stageName, // Using stage name as the label
        data: [leadLifecycleData.times[index]], // Single data point per stage, using "times" array
        backgroundColor: colors[index % colors.length],
        borderColor: colors[index % colors.length],
        borderWidth: 2,
        borderRadius: 4,
        hoverBackgroundColor: colors[index % colors.length]
    };
});

var leadLifecycleChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($leadLifecycleData['leads']); ?>,
        datasets: datasets
    },
    options: {
        responsive: true,
        scales: {
            x: {
                beginAtZero: true
            },
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Number of Leads' // Updated title to "Number of Leads"
                }
            }
        },
        animation: {
            duration: 2000,
            easing: 'easeOutBounce'
        }
    }
});

// leadResponseTimeDonutChart
document.addEventListener("DOMContentLoaded", function() {  // Ensure the DOM is loaded
    var ctx = document.getElementById('leadResponseTimeDonutChart').getContext('2d');

    function createGradient(ctx, color1, color2) {
        var gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, color1);
        gradient.addColorStop(1, color2);
        return gradient;
    }

    var hoverColors = [
        'rgb(110, 231, 183)',
        'rgb(59, 167, 255)',
        'rgb(85, 199, 219)',
        'rgb(0, 135, 171)'
    ];

    var leadResponseTimeChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Lead 1', 'Lead 2', 'Lead 3', 'Lead 4'],
            datasets: [{
                label: 'Response Time (hours)',
                data: [2, 4, 1, 3],
                backgroundColor: [
                    createGradient(ctx, 'rgba(110, 231, 183, 0.6)', 'rgba(110, 231, 183, 0.8)'),
                    createGradient(ctx, 'rgba(59, 167, 255, 0.6)', 'rgba(59, 167, 255, 0.8)'),
                    createGradient(ctx, 'rgba(85, 199, 219, 0.6)', 'rgba(85, 199, 219, 0.8)'),
                    createGradient(ctx, 'rgba(0, 135, 171, 0.6)', 'rgba(0, 135, 171, 0.8)')
                ],
                borderColor: ['#fff', '#fff', '#fff', '#fff'],
                borderWidth: 2,
                hoverBorderColor: ['#fff', '#fff', '#fff', '#fff'],
                hoverBackgroundColor: hoverColors
            }]
        },
        options: {
            responsive: true,
            cutout: '80%',
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                },
                animation: {
                    duration: 1500,
                    easing: 'easeInOutQuart',
                }
            }
        }
    });
});

    // Assuming PHP passes the data as an associative array, grouped by date or lead name
    let interactionData = <?php echo json_encode($leadInteractions); ?>;

let labels = []; // This will store either dates or lead names
let data = [];   // This will store interaction counts

interactionData.forEach(interaction => {
    if (!labels.includes(interaction.date)) { // or interaction.lead
        labels.push(interaction.date);
        data.push(1);
    } else {
        let index = labels.indexOf(interaction.date);
        data[index]++;
    }
});

leadInteractionChart
var ctx = document.getElementById('leadInteractionChart').getContext('2d');

var leadInteractionChart = new Chart(ctx, {
    type: 'polarArea',
    data: {
        labels: labels,
        datasets: [{
            label: 'Interactions',
            data: data,
            backgroundColor:'rgba(85, 199, 219,0.5)', 
            borderColor:'rgba(85, 199, 219)',
            borderWidth: 2,
            hoverBackgroundColor:'rgba(85, 199, 219,0.5)'
        }]
    },
    options: {
        scales: {
            r: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Number of Interactions'
                }
            }
        },
        plugins: {
            legend: {
                display: true  // You might want to show a legend for a polar area chart
            }
        }
    }
});



// // calender

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    timeZone: 'America/New_York', // Set your desired time zone here
    events: [
      {
        title: 'Meeting',
        start: '2023-08-10T10:00:00' // Use ISO 8601 format for accurate time
      },
      {
        title: 'Conference',
        start: '2023-08-15T14:00:00',
        end: '2023-08-17T17:00:00'
      }
      // Add more events as needed
    ]
  });

  calendar.render();
});
// document.addEventListener('DOMContentLoaded', function() {
//   var calendarEl = document.getElementById('calendar');

//   var calendar = new FullCalendar.Calendar(calendarEl, {
//     initialView: 'dayGridMonth',
//     timeZone: 'America/New_York', // Set your desired time zone here
//     events: function(fetchInfo, successCallback, failureCallback) {
//       $.ajax({
//         url: '<?php echo base_url('leads/fetch_events_for_calander')?>', // Aapke controller ka path yahan dalein
//         type: 'GET',
//         success: function(data) {
//           successCallback(data);
//         },
//         error: function() {
//           failureCallback('There was an error while fetching events.');
//         }
//       });
//     }
//   });

//   calendar.render();
// });

</script>


</body>
</html>