<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<style>
 .animatefromdown{
    animation:movefrombottom 0.5s ease-out 0.7s ;
    animation-fill-mode:backwards;
 }
 @keyframes movefrombottom {
    0%{
        opacity: 0;
        transform: translateY(30px);
    }
    100%{
        opacity: 1;
        transform: translateY(0);

    }
}
  
</style>



<div id="wrapper">
<div class="container ">
<!-- Responsive Bootstrap grid -->
<!-- Wrapper div to ensure the cards have the same height in a row -->
<div class="row mt-4 d-flex align-items-stretch">
    <!-- Lead Status Distribution Card -->
    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
        <div class="card bg-white shadow-lg rounded-lg hoverable h-100">
            <div class="card-body d-flex flex-column justify-content-center align-items-center py-4">
                <h2 class="card-title ms-1 text-uppercase text-center mb-4" style="font-weight: bold; color: #343a40; letter-spacing: 1.5px;">Lead Status Distribution</h2>
                <div class="d-flex justify-content-center">
                    <canvas id="leadStatusChart" style="max-width: 90%; height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Lead Source Tracking Card -->
    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
        <div class="card bg-white shadow-lg rounded-lg hoverable h-100">
            <div class="card-body d-flex flex-column justify-content-center align-items-center py-4">
                <h2 class="card-title ms-1 text-uppercase text-center mb-4" style="font-weight: bold; color: #343a40; letter-spacing: 1.5px;">Lead Source Tracking</h2>
                <div class="d-flex justify-content-center">
                    <canvas id="leadSourceChart"  style="max-width: 90%; height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4 d-flex align-items-stretch">
    <!-- Lead Distribution by Salesperson -->
    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
        <div class="card bg-white shadow-lg rounded-lg hoverable h-100">
            <div class="card-body d-flex flex-column justify-content-center align-items-center py-4">
                <h2 class="card-title ms-1 text-uppercase text-center mb-4"style="font-weight: bold; color: #343a40; letter-spacing: 1.5px;">Lead Distribution by Salesperson</h2>
                <div class="d-flex justify-content-center">
                    <canvas id="leadBySalespersonChart"  style="max-width: 90%; height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Lead Conversion Rate Over Time -->

    <div class="col-lg-6 col-md-6 col-sm-12 mb-4 ">
    <div class="card bg-white shadow-lg rounded-lg hoverable h-100">
        <div class="card-body d-flex flex-column justify-content-center align-items-center py-4">
            <h2 class="card-title ms-1 text-uppercase text-center mb-4"style="font-weight: bold; color: #343a40; letter-spacing: 1.5px;">Lead Conversion Rate Over Time</h2>
            <div class="d-flex justify-content-center">
                <canvas id="leadConversionRateProgressBarChart" style="max-width: 90%; height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>
</div>
<div class="row mt-4 d-flex align-items-stretch ">
<div class="col-lg-12 col-md-12 col-sm-12 mb-4">
    <div class="card bg-white shadow-lg rounded-lg hoverable h-100">
        <div class="card-body d-flex flex-column justify-content-center align-items-center py-4">
            <h2 class="card-title ms-1 text-uppercase text-center mb-4"style="font-weight: bold; color: #343a40; letter-spacing: 1.5px;">Lead Lifecycle</h2>
            <div class="d-flex justify-content-center">
                <canvas id="leadLifecycleChart" style="max-width: 90%; height: 250px;"></canvas>
            </div>
        </div>
    </div>
</div>
</div>

<div class="row mt-4 d-flex align-items-stretch ">
<div class="col-lg-6 col-md-6 col-sm-12 mb-4">
    <div class="card bg-white shadow-lg rounded-lg hoverable h-100">
        <div class="card-body d-flex flex-column justify-content-center align-items-center py-4">
            <h2 class="card-title ms-1 text-uppercase text-center mb-4"style="font-weight: bold; color: #343a40; letter-spacing: 1.5px;">Lead Response Time Distribution</h2>
            <div class="d-flex justify-content-center">
                <canvas id="leadResponseTimeDonutChart" style="max-width: 90%; height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-6 col-md-6 col-sm-12 mb-4">
<div class="card bg-white shadow-lg rounded-lg hoverable h-100">
<div class="card-body d-flex flex-column justify-content-center align-items-center py-4">
        <h2 class="card-title ms-1 text-uppercase text-center mb-4"style="font-weight: bold; color: #343a40; letter-spacing: 1.5px;">Lead Interaction History</h2>
        <div class="d-flex justify-content-center">
        <canvas id="leadInteractionChart"style="max-width: 90%; height: 300px;"></canvas>
    </div>
    </div>
</div>
</div>

</div>
</div>
</div>
<?php init_tail(); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.3/chart.min.js" integrity="sha512-fMPPLjF/Xr7Ga0679WgtqoSyfUoQgdt8IIxJymStR5zV3Fyb6B3u/8DcaZ6R6sXexk5Z64bCgo2TYyn760EdcQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    
    // leadStatusChart
var ctx = document.getElementById('leadStatusChart').getContext('2d');
// Gradient colors ke liye separate function:
function createGradient(ctx, color1, color2) {
    var gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, color1);
    gradient.addColorStop(1, color2);
    return gradient;
}

var leadStatusChart = new Chart(ctx, {
    type: 'pie', // This remains 'pie', donut appearance is controlled with the 'cutout' property
    data: {
        labels: ['New', 'In Progress', 'Converted'],
        datasets: [{
            data: [<?= $statusCounts['new']; ?>, <?= $statusCounts['in progress']; ?>, <?= $statusCounts['converted']; ?>],
            backgroundColor: [
                createGradient(ctx, 'rgba(110, 231, 183, 0.6)', 'rgba(110, 231, 183, 0.8)'),
                createGradient(ctx, 'rgba(59, 167, 255, 0.6)', 'rgba(59, 167, 255, 0.8)'),
                createGradient(ctx, 'rgba(85, 199, 219, 0.6)', 'rgba(85, 199, 219, 0.8)')
            ],
            hoverBackgroundColor: ['rgb(0, 135, 171)','rgb(0, 135, 171)','rgb(0, 135, 171)'],
            borderColor: ['#fff', '#fff', '#fff'],
            borderWidth: 1,
            hoverBorderColor:  ['#fff', '#fff', '#fff'],
        }]
    },
    options: {
        responsive: true,
        cutout: '50%', // This makes it a donut chart. Adjust the percentage for a bigger or smaller hole.
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
        }
    }
});

// leadSourceChart
var ctx = document.getElementById('leadSourceChart').getContext('2d');

// Gradient for bar color
var gradient = ctx.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, 'rgba(59, 167, 255, 0.6)');
gradient.addColorStop(1, 'rgba(110, 231, 183, 0.6)');

// Gradient for bar border color (darker shades)
var borderGradient = ctx.createLinearGradient(0, 0, 0, 400);
borderGradient.addColorStop(0, 'rgba(47, 137, 207, 0.6)');
borderGradient.addColorStop(1, 'rgba(90, 198, 157, 0.6)');

var leadSourceChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Website', 'Email Campaign', 'Social Media'],
        datasets: [{
            data: [<?= $sourceCounts['website']; ?>, <?= $sourceCounts['email campaign']; ?>, <?= $sourceCounts['social media']; ?>],
            backgroundColor: gradient,
            borderColor: borderGradient,
            borderWidth: 2,
            hoverBackgroundColor: ['rgb(0, 135, 171)','rgb(0, 135, 171)','rgb(0, 135, 171)'],
            hoverBorderColor: 'rgb(0, 135, 171)',
            borderRadius: 50,
            borderSkipped: false
        }]
    },
    options: {
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


// leadBySalespersonChart
var ctx = document.getElementById('leadBySalespersonChart').getContext('2d');

// Gradient for line fill
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


// leadLifecycleChart

var ctx = document.getElementById('leadLifecycleChart').getContext('2d');

// Colors for the histogram bars
var colors =  [
                createGradient(ctx, 'rgba(110, 231, 183, 0.6)', 'rgba(110, 231, 183, 0.8)'),
                createGradient(ctx, 'rgba(59, 167, 255, 0.6)', 'rgba(59, 167, 255, 0.8)'),
                createGradient(ctx, 'rgba(85, 199, 219, 0.6)', 'rgba(85, 199, 219, 0.8)')  // A shade similar to the provided colors
            ];
var leadLifecycleChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($leadLifecycleData['leads']); ?>,
        datasets: [{
    label: 'Stage 1',
    data: <?= json_encode($leadLifecycleData['times'][0]); ?>,
    backgroundColor: colors[0],
    borderColor: colors[0],
    borderWidth: 2,
    borderRadius: 4,
    hoverBackgroundColor: colors[0] // Added this line
}, {
    label: 'Stage 2',
    data: <?= json_encode($leadLifecycleData['times'][1]); ?>,
    backgroundColor: colors[1],
    borderColor: colors[1],
    borderWidth: 2,
    borderRadius: 4,
    hoverBackgroundColor: colors[1] // Added this line
}, {
    label: 'Stage 3',
    data: <?= json_encode($leadLifecycleData['times'][2]); ?>,
    backgroundColor: colors[2],
    borderColor: colors[2],
    borderWidth: 2,
    borderRadius: 4,
    hoverBackgroundColor: colors[2] // Added this line
}]

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
                    text: 'Hours'
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

</script>
</body>
</html>