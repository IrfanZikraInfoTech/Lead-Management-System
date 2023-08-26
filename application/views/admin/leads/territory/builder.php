<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    
    <?php if(isset($territory[0]['data'])){
        
        $territory[0]['data'] = json_decode($territory[0]['data'], true); 
    }
    ?>

    <div class="content">
        <div class="w-full flex flex-row justify-center gap-20">
            <div class="w-2/4 p-6 bg-white shadow-lg rounded-lg space-y-6">
                <div class="flex flex-row justify-between pb-4">
                <h1 class="text-2xl font-bold text-gray-800border-b">Territory Builder</h1>
                <button class="px-6 py-2 btn-primary rounded" id="add-county">Add</button>
                </div>

                <div class="flex flex-col gap-4" id="all-county-container">
                    <!-- Check if territory is defined and counties are present -->
                    <?php if (isset($territory) && !empty($territory[0]['data']['counties'])){ ?>
                        <?php foreach ($territory[0]['data']['counties'] as $index => $county): ?>
                            <?php foreach ($county as $code => $name): ?>
                                <div class="flex lg:flex-row flex-col gap-2" id="countyContainer-<?php echo $index; ?>">
                                    <div class="lg:w-4/5 w-full">
                                        <label for="county-<?php echo $index; ?>" class="block text-sm font-medium text-gray-700 mb-1">Select County</label>
                                        <select id="county-<?php echo $index; ?>" data-placeholder="Select a county..." class="mt-1 w-full p-2 border rounded-md focus:ring focus:ring-opacity-50 focus:ring-blue-300 transition duration-200 county-select">
                                            <!-- Assuming you have a function to get all counties, you can loop through and set selected if it matches -->
                                            <option value="<?php echo $code; ?>" selected><?php echo $name; ?></option>
                                        </select>
                                    </div>
                                    <div class="lg:w-1/5 w-full flex flex-col justify-end">
                                        <button class="text-center py-2 btn-danger rounded remove-county" data-target="#countyContainer-<?php echo $index; ?>">Remove</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    <?php }else{?>

                        <div class="flex lg:flex-row flex-col gap-2" id="countyContainer-0">
                            <div class="lg:w-4/5 w-full">
                                <label for="county-0" class="block text-sm font-medium text-gray-700 mb-1">Select County</label>
                                <select id="county-0" data-placeholder="Select a county..." class="mt-1 w-full p-2 border rounded-md focus:ring focus:ring-opacity-50 focus:ring-blue-300 transition duration-200 county-select"></select>
                            </div>
                            <div class="lg:w-1/5 w-full flex flex-col justify-end">
                                <button class="text-center py-2 btn-danger rounded remove-county" data-target="#countyContainer-0">Remove</button>
                            </div>
                        </div>

                    <?php }?>
                </div>

                <hr>

                <div class="my-4">
                    <button id="update-zipcodes" class="bg-neutral-500 text-white px-5 py-2 rounded-md hover:bg-neutral-400 transition duration-200 w-full">Fetch Codes</button>
                </div>

                <hr>

                <div class="space-y-4">
                    <label for="zip" class="block text-sm font-medium text-gray-700 mb-2">ZIP Codes</label>
                    <table class="w-full bg-white rounded-md overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-2 px-3 border-b text-left text-gray-600">Code</th>
                                <th class="py-2 px-3 border-b text-left text-gray-600">Action</th>
                            </tr>
                        </thead>
                        <tbody id="zip-table-body" class="divide-y divide-gray-200">
                            <?php if (isset($territory) && !empty($territory[0]['data']['zipCodes'])): ?>
                                <?php foreach ($territory[0]['data']['zipCodes'] as $zip): ?>
                                    <?php foreach ($zip as $code => $desc): ?>

                                        <tr data-zip="<?= $code ?>">
                                            <td class="py-2 px-3 border-b border-gray-300"><?= $desc ?></td>
                                            <td class="py-2 px-3 border-b border-gray-300">
                                                <button class="remove-zip bg-red-500 text-white text-center py-1 px-2 rounded-md" data-zip="<?= $code ?>">Remove</button>
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <hr>
                    <div class="flex items-center gap-2">
                        <input type="text" id="new-zip" placeholder="Enter ZIP Code" class="flex-grow border rounded-md p-2 focus:ring focus:ring-opacity-50 focus:ring-blue-300 transition duration-200">
                        <button id="add-zip" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-200">Add</button>
                    </div>
                </div>

                <hr>

                <div class="text-center">
                    <button id="update-stats" class="bg-green-600 text-white px-5 py-2 rounded-md hover:bg-green-700 transition duration-200 w-full">Update Stats</button>
                </div>

            </div>
            <div class="w-2/4">

            <div class="flex flex-col gap-4 mb-4">
                    
                <div class="w-full flex flex-row gap-2">
                    
                    <!-- Back Button -->
                    <a href="<?= admin_url("leads/territories") ?>" class="w-1/5 text-center py-3 transform transition-transform duration-300 ease-in-out bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 shadow-lg hover:shadow-xl hover:-translate-y-1 text-white rounded-lg hover:text-white focus:text-white">
                        Back
                    </a>
                    <!-- <a target="_blank" href="<?= admin_url('leads/mypdf')?>" class="w-1/5 text-center py-3 transform transition-transform duration-300 ease-in-out bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 shadow-lg hover:shadow-xl hover:-translate-y-1 text-white rounded-lg hover:text-white focus:text-white">
                        <i class="fas fa-file-pdf mr-2"></i> PDF
                    </a> -->


                    <!-- Save Button -->
                    <button class="w-4/5 text-center py-3 ml-3 transform transition-transform duration-300 ease-in-out bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 shadow-lg hover:shadow-xl hover:-translate-y-1 text-white rounded-lg" id="save_territory">
                        SAVE
                    </button>

                </div>
                
                </div>

                <div class="w-full p-6 bg-white shadow-lg rounded-lg space-y-6">
                    <table class="w-full bg-white rounded-md overflow-hidden">
                        <thead class="bg-gray-100 ">
                            <tr>
                                <th class="py-2 px-3 border-b text-left text-gray-600">Name</th>
                                <th class="py-2 px-3 border-b text-left text-gray-600">Estimate</th>
                            </tr>
                        </thead>
                        <tbody id="stats-table-body" class="divide-y divide-gray-200">
                            <?php if (isset($territory) && !empty($territory[0]['data']['stats'])): ?>
                                <?php foreach ($territory[0]['data']['stats'] as $key => $value): ?>
                                    <tr>
                                        <td class="py-2 px-3"><?php echo $key; ?></td>
                                        <td class="py-2 px-3"><?php echo $value; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="w-full p-6 bg-white shadow-lg rounded-lg space-y-6">

                    <div style="height:400px; width:100%;" id="map"></div>

                </div>
                
            </div>
        </div>

        <div class="flex flex-row w-full p-20">
            <div id="demographics" class="flex flex-col w-full py-20 bg-white px-[200px] gap-4">

                <!-- Demographics -->
                <div class="text-center">
                    <h3 class="font-bold text-xl mb-4">Demographics</h3>
                </div>

                <div class="w-full mb-14">
                    <h4 class="mb-2 text-center">Age Distribution</h4>
                    <canvas id="ageBarChart"></canvas>
                </div>

                <div class="flex flex-row gap-4 mb-14">
                    <div class="w-1/2">
                        <h4 class="mb-2 text-center">Gender Distribution</h4>
                        <canvas id="genderPieChart"></canvas>
                        
                    </div>

                    <div class="w-1/2">
                        <h4 class="mb-2 text-center">Race Distribution</h4>
                        <canvas id="racePieChart"></canvas>
                    </div>
                </div>


                <!-- Economy -->
                <div class="col-span-2 text-center mb-5">
                    <h3 class="font-bold text-xl mb-4">Economy</h3>
                </div>

                <div class="flex flex-row gap-12">
                    <!-- Median Income Bar Chart -->
                    <div class="w-1/2 h-[440px]">
                        <h4 class="mb-2 text-center">Median Income</h4>
                        <canvas id="medianIncomeBarChart"></canvas>
                    </div>

                    <!-- Housing Pie Chart -->
                    <div class="w-1/2">
                        <h4 class="mb-2 text-center">Housing Distribution</h4>
                        <canvas id="housingPieChart"></canvas>
                    </div>
                </div>

                </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="chartsModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-white rounded-lg shadow-lg">
            <div class="modal-header flex flex-row border-b p-5">
                <h5 class="modal-title text-lg font-semibold">Statistics Charts</h5>
                <button type="button" class="ml-auto close text-gray-400 hover:text-gray-600" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-5">
                
            </div>

            <div class="modal-footer border-t p-5">
                <button type="button" class="btn bg-gray-500 text-white hover:text-white focus:text-white px-4 py-2 rounded hover:bg-gray-600" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<?php init_tail(); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0_-K6RCtt2KzvvwXg-e_pFX6VST1yHto"></script>
<script>
    $(document).ready(function() {

        <?php
            if(isset($territory)){
                $zipCodes = $territory[0]['data']['zipCodes'];

                $onlyZipCodes = array_map(function($item) {
                    return key($item); // Returns the first key of the associative array
                }, $zipCodes);



                echo 'drawMap('.json_encode($onlyZipCodes).');';
            }    
        ?>


        let uniqueId = 1;

        // Add new county input
        $('#add-county').on('click', function() {
            uniqueId++;

            // Create new select input
            const newCountyInput = `
                <div class="flex lg:flex-row flex-col gap-2" id="countyContainer-${uniqueId}">
                    <div class="lg:w-4/5 w-full">
                        <label for="county-${uniqueId}" class="block text-sm font-medium text-gray-700 mb-1">Select County</label>
                        <select id="county-${uniqueId}" data-placeholder="Select a county..." class="mt-1 w-full p-2 border rounded-md focus:ring focus:ring-opacity-50 focus:ring-blue-300 transition duration-200 county-select"></select>
                    </div>
                    <div class="lg:w-1/5 w-full flex flex-col justify-end">
                        <button class="text-center py-2 btn-danger rounded remove-county" data-target="#countyContainer-${uniqueId}">Remove</button>
                    </div>
                </div>
            `;

            // Append to container
            $('#all-county-container').append(newCountyInput);

            // Initialize select2 on new input
            $(`#county-${uniqueId}`).select2({
                ajax: {
                    url: '<?= admin_url("leads/get_counties") ?>',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            query: params.term // Search term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.fips
                                };
                            })
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1,
                placeholder: 'Select a county'
            });
        });

        $(`.county-select`).select2({
                ajax: {
                    url: '<?= admin_url("leads/get_counties") ?>',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            query: params.term // Search term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.fips
                                };
                            })
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1,
                placeholder: 'Select a county'
            });

        // Remove county input
        $(document).on('click', '.remove-county', function() {
            const target = $(this).data('target');
            $(target).remove();
        });


        $('#update-zipcodes').on('click', function(){


            $("#zip-table-body").empty();

            $(".county-select").each(function(){

                let countyFIPS = $(this).val();

                let countyName = $(this).children("option:selected").text();

                $.get('<?= admin_url("leads/get_zips") ?>', { countyFIPS: countyFIPS }, function(data) {
                    let zipData = JSON.parse(data);
                    zipData.forEach(item => {
                        let row = `<tr data-zip="${item.zip}">
                            <td class="py-2 px-3 border-b border-gray-300">${countyName} | ${item.city} (${item.zip})</td>
                            <td class="py-2 px-3 border-b border-gray-300">
                                <button class="remove-zip bg-red-500 text-white text-center py-1 px-2 rounded-md" data-zip="${item.zip}">Remove</button>
                            </td>
                        </tr>`;
                        $("#zip-table-body").append(row);
                    });
                    // Add event listener for the remove button
                    $(".remove-zip").on("click", function() {
                        let zipToRemove = $(this).data('zip');
                        $(this).closest('tr').remove();
                        // Optional: You can also send an AJAX request here to update your backend about the removed ZIP.
                    });
                });

                

            });

        });

    });


    
    $("#save_territory").on('click', function(){
        let counties = [];
        $(".county-select").each(function() {
            let countyValue = $(this).val();
            let countyName = $(this).find('option:selected').text();
            let countyObj = {};
            countyObj[countyValue] = countyName;
            counties.push(countyObj);
        });


        // Extract Zipcodes
        let zipCodes = [];
        $("#zip-table-body tr").each(function() {
            let zipValue = $(this).data("zip");
            let cityName = $(this).find('td').html(); // Assuming city is first word before the parenthesis
            let zipObj = {};
            zipObj[zipValue] = cityName;
            zipCodes.push(zipObj);
        });

        // Extract Stats
        let stats = {};
        $("#stats-table-body tr").each(function() {
            let key = $(this).find("td").eq(0).text();
            let value = $(this).find("td").eq(1).text();
            stats[key] = value;
        });

        // Package data into an object
        let territoryData = {
            counties: counties,
            zipCodes: zipCodes,
            stats: stats,
            // mapData: {...} // If you have map data to save
        };

        console.log(territoryData);

        Swal.fire({
        title: 'Enter Territory Title and Value',
        html: `
            <input id="swal-input1" class="swal2-input" placeholder="Territory Title">
            <input id="swal-input2" class="swal2-input" type="number" placeholder="Value (in $)">

        `,
        didOpen: function() {
            var valueFromTable = document.querySelector("#stats-table-body tr:nth-child(1) td:nth-child(2)").textContent.trim();
            document.getElementById("swal-input2").value = parseFloat((valueFromTable.replace(/,/g, ""))*2);
        <?php
        if (isset($territory)) {
            echo '
                        document.getElementById("swal-input1").value = "' . $territory[0]["title"] . '"; 
                    ';
        }
        ?>
        },
        showCancelButton: true,
        preConfirm: () => {
            const title = document.getElementById('swal-input1').value;
            const value = document.getElementById('swal-input2').value;

            if (!title) {
                Swal.showValidationMessage('Please fill in all the fields')
            }
            else if (!value) {
                Swal.showValidationMessage('Please fill in all the fields')
            }

            return { title: title, value: value };
        }
    }).then((result) => {
        if (result.isConfirmed && result.value) {
            // Extend territoryData with the provided title, population, and value
            territoryData.title = result.value.title;
            territoryData.value = parseFloat(result.value.value);

            territoryData.population = parseInt(territoryData.stats['Total Population'].replace(/,/g, '')) || 0;

            let jsonData = JSON.stringify(territoryData);

            // Send the territoryData to the server to save it
            $.ajax({
                type: "POST",
                url: '<?= admin_url("leads/save_territory") ?>',
                data: {
                    'territoryData': jsonData,
                    'territoryValue': territoryData.value
                    <?php 
                    if(isset($territory)){
                        echo ", 'territory_id' : '".$territory[0]["id"]."'";
                    }
                    ?>
                },
                dataType: 'json',
                success: function(response) {
                    // Handle the server response here.
                    if (response.success) {
                        Swal.fire('Saved!', 'Territory has been saved.', 'success');
                    } else {
                        Swal.fire('Error!', 'There was a problem saving the territory.', 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'There was a problem communicating with the server.', 'error');
                }
            });
        }
    });


    });
    function drawMap(zipCodes) {
        var geoJsonUrl = '<?= admin_url('leads/serveGeoJson'); ?>';
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: { lat: 37.7749, lng: -122.4194 } // Adjust to fit your zip codes
        });

        var bounds = new google.maps.LatLngBounds();

        // Fetch the GeoJSON data
        fetch(geoJsonUrl).then(function(response) {
          return response.json();
        }).then(function(geoJson) {
          // Filter features based on zip code
          var filteredFeatures = geoJson.features.filter(function(feature) {
            var zipCode = feature.properties.ZCTA5CE20; // Replace with the actual property name
            return zipCodes.includes(parseInt(zipCode));
          });

          // Create a new GeoJSON object with only the filtered features
          var filteredGeoJson = {
            type: 'FeatureCollection',
            features: filteredFeatures
          };

          // Add the filtered GeoJSON to the map
          map.data.addGeoJson(filteredGeoJson);

          // Style the features
          map.data.setStyle({
            fillColor: 'blue',
            strokeWeight: 2,
            strokeColor: 'red'
          });

          // Add labels for the zip codes
          map.data.forEach(function(feature) {
            var zipCode = feature.getProperty('ZCTA5CE20');
            var bounds = new google.maps.LatLngBounds();

            feature.getGeometry().forEachLatLng(function(latlng) {
              bounds.extend(latlng);
            });

            var center = bounds.getCenter();

            new google.maps.Marker({
              position: center,
              label: {
                text: zipCode,
                color: 'black',
                fontSize: '14px'
              },
              icon: {
                url: 'https://static.vecteezy.com/system/resources/previews/009/305/140/original/white-blank-buttons-clipart-design-illustration-free-png.png',
                scaledSize: new google.maps.Size(60, 20), // size of the icon
                origin: new google.maps.Point(0, 0), // origin of the image
                anchor: new google.maps.Point(25, 25) // anchor point
              },
              map: map
            });
          });

          map.data.forEach(function(feature) {
            feature.getGeometry().forEachLatLng(function(latlng) {
              bounds.extend(latlng);
            });
          });

          // Use fitBounds to set the map's viewport
          map.fitBounds(bounds);

        });
    }
    $(".remove-zip").on("click", function() {
        let zipToRemove = $(this).data('zip');
        $(this).closest('tr').remove();
    });

    $("#add-zip").click(function() {
        let newZip = $("#new-zip").val();
        
        // You might want to verify the ZIP code format here
        if (newZip) {
            let row = `
                <tr data-zip="${newZip}">
                    <td class="py-2 px-3 border-b border-gray-300">${newZip}</td>
                    <td class="py-2 px-3 border-b border-gray-300">
                        <button class="remove-zip bg-red-500 text-white px-2 py-1 rounded-md" data-zip="${newZip}">Remove</button>
                    </td>
                </tr>`;
            $("#zip-table-body").append(row);
            $("#new-zip").val(''); // Clearing the input field

            $(".remove-zip").on("click", function() {
                let zipToRemove = $(this).data('zip');
                $(this).closest('tr').remove();
            });

        }
    });


    $("#update-stats").click(function() {
        let zipCodes = [];
        $("#zip-table-body tr").each(function() {
            let zip = $(this).data("zip");
            zipCodes.push(zip);
        });

        if(zipCodes.length < 1) {
            Swal.fire({
                title: 'No Codes',
                text: `Add some zip codes or select from county!`,
                icon: 'warning'
            });

            return;
        }

        Swal.fire({
            title: 'Processing...',
            text: 'Fetching population data...',
            timerProgressBar: true,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            },
        });

        $.get("<?= admin_url("leads/get_stats") ?>", { zipCodes: zipCodes }, function(data) {
            let stats = JSON.parse(data);
            let totalPopulation = stats['Total Population'].toLocaleString();
            let totalHospitals = stats['Total Hospitals'].toLocaleString();

            Swal.close();
            Swal.fire({
                title: 'Done!',
                html: `Total population: ${totalPopulation} <br> Total Hospitals: ${totalHospitals} `,
                icon: 'success'
            });

            drawMap(zipCodes);

            let statsDupe = stats;

        

            let tableBody = $("#stats-table-body");
            tableBody.empty(); // Clear existing rows

            for (let key in stats) {
                if (stats.hasOwnProperty(key)) {
                    let value = stats[key];
                    
                    // Format the numbers
                    if (key === 'Total Population' || key === 'Total Hospitals') {
                        value = value.toLocaleString();
                    } else if (key.startsWith('%')) {
                        value = (value.toFixed(2) + '%');
                    }
                    else if (key == 'Median Income') {
                        value = (value.toFixed(2) + '$');
                    }

                    let row = `<tr>
                                    <td class="py-2 px-3">${key}</td>
                                    <td class="py-2 px-3">${value}</td>
                                </tr>`;
                    tableBody.append(row);
                }
            }


            renderCharts(readyDataForCharts(statsDupe));
            

        });


    });


    

    <?php 
        if(isset($territory)){

        // Sample data
        $data = $territory[0]['data']['stats'];

        // Extract numeric value from the Total Population
        $totalPopulation = (int) str_replace(",", "", $data["Total Population"]);

        // A list of keys for which we need to convert percentage values to population numbers
        $convertToPopulationKeys = [
            "% Under 5 Years Old", 
            "% Under 18 Years Old", 
            "% 21 Years and Over", 
            "% Working Age (25 to 64)", 
            "% 65 and Over"
        ];

        // Iterate through the data and transform it
        foreach ($data as $key => $value) {
            // Remove commas
            $numericValue = (float) str_replace(",", "", $value);
            $numericValue = (float) str_replace("%", "", $numericValue);

            // If the key is in the list and value has a '%', convert to a population number
            if (in_array($key, $convertToPopulationKeys) && strpos($value, '%') !== false) {
                $numericValue = $numericValue / 100 * $totalPopulation;
                $data[$key] = round($numericValue);  // Rounding to nearest whole number
            } else {
                $data[$key] = $numericValue;
            }
        }

    // Now you can encode the data and pass it to the JS function
    echo "renderCharts(" . json_encode($data) . ");";

    }?>

    function createGradient(ctx, startColor, endColor) {
        let gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, startColor);
        gradient.addColorStop(1, endColor);
        return gradient;
    }

    var genderPieChart;
    var ageDistributionChart;
    var racePieChart;
    var medianIncomeChart;
    var housingPieChart;

    function renderCharts(stats) {

        if (genderPieChart) { 
            genderPieChart.destroy(); // Destroy the previous instance if it exists
        }
        if (ageDistributionChart) { 
            ageDistributionChart.destroy(); // Destroy the previous instance if it exists
        }
        if (racePieChart) { 
            racePieChart.destroy(); // Destroy the previous instance if it exists
        }
        if (medianIncomeChart) { 
            medianIncomeChart.destroy(); // Destroy the previous instance if it exists
        }
        if (housingPieChart) { 
            housingPieChart.destroy(); // Destroy the previous instance if it exists
        }


        // Gender Distribution Pie Chart
        var ctx = document.getElementById("genderPieChart").getContext('2d');
        genderPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["Male", "Female"],
                datasets: [{
                    data: [stats['% Male'], stats['% Female']],
                    backgroundColor: [
                        createGradient(ctx, 'rgba(110, 231, 183, 0.6)', 'rgba(110, 231, 183, 1)'),
                        createGradient(ctx, 'rgba(59, 167, 255, 0.6)', 'rgba(59, 167, 255, 1)')
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


        var ctx = document.getElementById('ageBarChart').getContext('2d');
        var gradientFill = ctx.createLinearGradient(0, 0, 0, 400);
        gradientFill.addColorStop(0, 'rgba(110, 231, 183, 0.6)');  // Starting color with transparency
        gradientFill.addColorStop(1, 'rgba(59, 167, 255, 0.6)');   // Ending color with transparency

        // Age Distribution Bar Chart
        ageDistributionChart = new Chart(document.getElementById("ageBarChart"), {
            type: 'line',
            data: {
                labels: ["Under 5", "Under 18", "21 and Over", "Working Age (25 to 64)", "65 and Over"],
                datasets: [{
                    label: 'Population',
                    data: [
                        stats['% Under 5 Years Old'], 
                        stats['% Under 18 Years Old'], 
                        stats['% 21 Years and Over'], 
                        stats['% Working Age (25 to 64)'], 
                        stats['% 65 and Over']
                    ],
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
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctxRace = document.getElementById("racePieChart").getContext('2d');
        racePieChart = new Chart(ctxRace, {
            type: 'pie',
            data: {
                labels: ["White", "Black or African American", "Asian", "Native Hawaiian", "Some Other Race", "Two or More Races", "Hispanic (of Any Race)"],
                datasets: [{
                    data: [stats['% White'], stats['% Black or African American'], stats['% Asian'], stats['% Native Hawaiian'], stats['% Some Other Race'], stats['% Two or More Races'], stats['% Hispanic (of Any Race)']],
                    backgroundColor: [
                        createGradient(ctxRace, 'rgba(59, 167, 255, 0.6)', 'rgba(59, 167, 255, 1)'),
                        createGradient(ctxRace, 'rgba(110, 231, 183, 0.6)', 'rgba(110, 231, 183, 1)'),
                        createGradient(ctxRace, 'rgba(85, 199, 219, 0.6)', 'rgba(85, 199, 219, 1)'),
                        createGradient(ctxRace, 'rgba(245, 166, 35, 0.6)', 'rgba(245, 166, 35, 1)'),
                        createGradient(ctxRace, 'rgba(255, 102, 204, 0.6)', 'rgba(255, 102, 204, 1)'),
                        createGradient(ctxRace, 'rgba(102, 255, 102, 0.6)', 'rgba(102, 255, 102, 1)'),
                        createGradient(ctxRace, 'rgba(160, 82, 45, 0.6)', 'rgba(160, 82, 45, 1)')
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

        // Median Income Bar Chart
        var ctxIncome = document.getElementById("medianIncomeBarChart").getContext('2d');

        var gradientIncome = ctxIncome.createLinearGradient(0, 0, 0, 400);
        gradientIncome.addColorStop(0, 'rgba(110, 231, 183, 0.6)');  // Starting color with transparency
        gradientIncome.addColorStop(1, 'rgba(59, 167, 255, 0.6)');   // Ending color with transparency

        medianIncomeChart = new Chart(ctxIncome, {
            type: 'bar',
            data: {
                labels: ["Median Income"],
                datasets: [{
                    label: 'Income in $',
                    data: [stats['Median Income']],
                    backgroundColor: gradientIncome, // use the gradient fill
                    borderColor: ['#3BA7FF'],
                    borderWidth: 2,
                    hoverBackgroundColor: 'rgb(0, 135, 171)',
                    hoverBorderColor:  ['#fff'],
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,  
            }
        });


        var ctxHousing = document.getElementById("housingPieChart").getContext('2d');
        housingPieChart = new Chart(ctxHousing, {
            type: 'pie',
            data: {
                labels: ["Owned", "Rented"],
                datasets: [{
                    data: [stats['% Owned Houses'], stats['% Rented Houses']],
                    backgroundColor: [
                        createGradient(ctxHousing, 'rgba(110, 231, 183, 0.6)', 'rgba(110, 231, 183, 1)'),
                        createGradient(ctxHousing, 'rgba(59, 167, 255, 0.6)', 'rgba(59, 167, 255, 1)')
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
    
    }

    function readyDataForCharts(myStats){
        // Extract the total population
        let totalPopulation = myStats['Total Population'];

        // List of keys that need conversion
        let keysToConvert = [
            '% Under 5 Years Old',
            '% Under 18 Years Old',
            '% 21 Years and Over',
            '% 65 and Over',
            '% Working Age (25 to 64)'
        ];

        // Convert the percentages to population counts for the specified keys
        keysToConvert.forEach(key => {
            myStats[key] = parseInt((myStats[key] / 100) * totalPopulation);
        });

        // Log the updated stats and render the charts
        console.log(myStats);

        return myStats;
    }


</script>

</body>
</html>