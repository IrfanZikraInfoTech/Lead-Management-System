<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php init_head(); ?>

<div id="wrapper">
    <div class="content">
        <div class="w-full mx-auto">
            <div class="bg-white shadow-md rounded-md p-6">
                <div class="mb-10 w-full flex justify-between">
                    <h4 class="text-2xl font-semibold">Territories</h4>
                    <a href="<?= admin_url('leads/territory_builder/new') ?>" class="bg-blue-500 hover:bg-blue-600 transition-all hover:text-white focus:text-white text-white font-bold px-4 rounded flex items-center">
                        New Territory
                    </a>
                </div>
                <table id="territories_table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>
                                Title
                            </th>
                            <th>
                                Population
                            </th>
                            <th>
                                Value
                            </th>
                            <th>
                                Data
                            </th>
                            <th>
                                Date
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($territories as $territory){

                                $date = new DateTime($territory['created_at']);
                                $formattedDate = $date->format('F d, Y - h:i A');

                                echo '
                                <tr>
                                <td><a class="text-blue-500 " href="'.admin_url("leads/territory_builder/edit/".$territory['id']).'">'.$territory['title'].'</a></td>
                                <td>'.$territory['population'].'</td>
                                <td>'.$territory['value'].'</td>
                                <td><a class="text-blue-700" href="#"> Show Data!</a></td>
                                <td>'.$formattedDate.'</td>
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

    $("#territories_table").DataTable({

        initComplete: function() {
            $('#territories_table_wrapper').removeClass('table-loading');
        }

    });

</script>

</body>
</html>