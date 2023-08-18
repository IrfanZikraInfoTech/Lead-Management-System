<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php init_head(); ?>

<style>
.flow-box {
    display: inline-block;
    padding: 5px 10px;
    border: 1px solid #ccc;
    margin-right: 5px;
    background-color: #f9f9f9;
}

.arrow-right {
    display: inline-block;
    width: 0; 
    height: 0; 
    border-top: 6px solid transparent;
    border-bottom: 6px solid transparent;
    border-left: 12px solid #333;
    margin-right: 5px;
}

</style>

<div id="wrapper">
    <div class="content">
        <div class="w-full mx-auto">
            <div class="bg-white shadow-md rounded-md p-6">
                <div class="mb-10 w-full flex justify-between">
                    <h4 class="text-2xl font-semibold">All Lead Flows</h4>
                    <a href="<?= admin_url('leads/flow_builder/new') ?>" class="bg-blue-500 hover:bg-blue-600 transition-all hover:text-white focus:text-white text-white font-bold px-4 rounded flex items-center">
                        New Flow
                    </a>
                </div>
                <table id="flows_table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Data</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($flows as $flow) {
                                $createdDate = new DateTime($flow['created_at']);
                                $formattedCreatedDate = $createdDate->format('F d, Y - h:i A');
                                
                                $updatedDate = new DateTime($flow['updated_at']);
                                $formattedUpdatedDate = $updatedDate->format('F d, Y - h:i A');
                                
                                // Decode the JSON data for each flow
                                $flowItems = json_decode($flow['flow'], true);
                                $flowVisualization = "";
                                
                                foreach($flowItems as $index => $item) {
                                    $flowVisualization .= '<span class="flow-box">'.$item['name'].'</span>';
                                    if ($index != count($flowItems) - 1) { // Don't add an arrow after the last item
                                        $flowVisualization .= '<span class="arrow-right"></span>';
                                    }
                                }
                            
                                echo '
                                <tr>
                                    <td>'.htmlspecialchars($flow['name']).'</td>
                                    <td>'.$flowVisualization.'</td>
                                    <td>'.$formattedCreatedDate.'</td>
                                    <td>'.$formattedUpdatedDate.'</td>
                                    <td class="flex flex-row gap-2"><a href="'.admin_url('leads/flow_builder/edit/'.$flow['id']).'">Edit</a>
                                    
                                    <a href="javascript:void(0);" class="delete-flow text-rose-500" data-id="'.$flow['id'].'">Delete</a>

                                    
                                    </td>
                                </tr>
                                ';
                            }
                            
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<?php init_tail(); ?>

<script>

    $("#flows_table").DataTable({

        initComplete: function() {
            $('#flows_table_wrapper').removeClass('table-loading');
        }

    });

    $(document).on('click', '.delete-flow', function() {
        let flowId = $(this).data('id');  // Get the ID from data-id attribute

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo admin_url('leads/delete_flow/'); ?>' + flowId,
                    method: 'GET',
                    success: function(response) {
                        // Handle success, maybe reload the page to reflect the deletion
                        location.reload();
                    },
                    error: function(err) {
                        // Handle error
                        Swal.fire('Error!', 'There was an error deleting the flow.', 'error');
                    }
                });
            }
        });
    });

</script>

</body>
</html>