<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>

<div id="wrapper">

    <div class="content bg-gray-100 p-6">

        <!-- Title -->
        <h2 class="text-2xl font-semibold mb-4">Lead Flow Configuration</h2>

        <!-- Draggable Components -->
        <div class="mb-8">
            <h3 class="text-xl font-semibold mb-3">Available Components:</h3>
            <div id="components" class="text-center md:grid-cols-2 lg:grid-cols-3 gap-4">

                <div class="bg-white p-4 border rounded-lg cursor-move hover:bg-gray-50 transition duration-200 flex flex-col gap-2 shadow-lg" data-type="Lead Components">Lead Components</div>
            </div>
        </div>

        <!-- Flow Definition -->
        <div>
            <h3 class="text-xl font-semibold mb-3">Define Your Flow:</h3>
            <div id="flow-definition" class="bg-white shadow-md space-y-4 flex flex-col gap-4 p-4">
                <!-- Items dragged here will populate this area -->
                <?php 
                // print_r($flow);
                    if(isset($flow) && !empty($flow)){
                        $flowItems = json_decode($flow['flow'], true);
                        foreach($flowItems as $flowItem){
                            echo '
                            <div class="bg-white p-4 border rounded-lg cursor-move hover:bg-gray-50 transition duration-200 flex flex-col gap-2 shadow-lg" data-type="'.$flowItem['type'].'" draggable="false" style="">'.ucfirst($flowItem['type']).'<input type="text" placeholder="Enter Lead Lifecycle Name..." value="'.htmlspecialchars($flowItem['name']).'" class="px-4 py-2 bg-transparent border-b focus:outline-none w-full"></div>
                            ';
                        }
                    }
                ?>
            </div>

            <div class="flex justify-end">
                <button id="save-flow-btn" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-150 focus:outline-none">Save Flow</button>
            </div>

        </div>

    </div>


<?php init_tail(); ?>

<!-- Include sortable.min.js and initialize -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const components = document.getElementById('components');
        const flowDefinition = document.getElementById('flow-definition');
        
        new Sortable(components, {
            group: {
                name: 'shared',
                pull: 'clone',   // Clone the item from the original list on drag.
                put: false       // Don't allow items to be dropped back.
            },
            animation: 150,
            sort: false         // Don't sort the original list on drag.
        });
        
        new Sortable(flowDefinition, {
            group: 'shared',
            animation: 150,
            onAdd: function(evt) {
                // Convert dragged item to an editable field
                let item = evt.item;
                item.innerHTML += `<input type="text" placeholder="Enter ${item.textContent.trim()} Name..." class="px-4 py-2 bg-transparent border-b focus:outline-none w-full" />`;  // Arrow indicating flow direction.
            }
        });
    });
    
    $('#save-flow-btn').click(function() {
        let flowName = $('#flow-name-input').val(); // Replace '#flow-name-input' with the actual ID or selector of the flow name input
    // Assuming the flowName is already defined; otherwise, you may need to define or input it.
    const flowItems = $("#flow-definition input").map(function() {
        return {
            name: $(this).val(),
            type: $(this).closest('div').data('type')
        };
    }).get();

    $.ajax({
        url: '<?= admin_url("leads/save_flow"); ?>',
        type: 'POST',
        dataType: 'json',
        data: {
            flowName: flowName,
            flowItems: flowItems
            <?php 
            if(isset($flow)){
                echo ',id : '.$flow["id"];
            }
            ?>
        },
        success: function(response) {
            if (response.success) {
                alert('Flow saved successfully!'); // You can replace this with your desired confirmation message
            } else {
                alert('Failed to save.'); // Error message
            }
        },
        error: function(error) {
            alert('Request failed.'); // Error message
        }
    });
});


</script>

</div>

</body>
</html>