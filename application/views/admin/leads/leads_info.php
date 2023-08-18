<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>

<div id="wrapper" class="bg-gray-100">
    <div class="content mx-auto py-0.5">

        <div class="relative w-full">

            <div class="w-full rounded-t-2xl shadow-lg z-10 text-white font-semibold bg-cyan-600">
                <div class="pb-16">
                    <div class="text-xl sm:text-xl md:text-2xl font-bold px-8 pt-8">John Joe</div>
                        <div class="text-lg sm:text-lg md:text-xl font-bold flex pt-5">
                            <span class="text-base sm:text-lg md:text-lg pl-8">Status:</span>
                                <div class="bg-white ml-3 customStatus rounded ">
                                    <?php
                                        $selected = '';
                                        if (isset($lead)) {
                                            $selected = $lead->status;
                                        } elseif (isset($status_id)) {
                                            $selected = $status_id;
                                        }
                                        echo render_leads_status_select($statuses, $selected, 'lead_add_edit_status');
                                    ?>
                                </div>
                        </div>
                        <div class="text-sm sm:text-md flex mt-6 pl-8">
                            <div>leademail@example.com</div>
                            <div class="mx-2">|</div>
                            <div> +123456789</div>
                            <div class="mx-2">|</div>
                            <div> City, Country</div>
                        </div>
                    </div>
                    <!-- Buttons at the top-right -->
                    <div class="absolute top-4 sm:top-8 md:top-8 right-4 sm:right-8 flex flex-col space-y-2 sm:space-y-4">
                        <button class="bg-white text-info w-8 h-8 sm:w-10 sm:h-10 md:w-10 md:h-10 flex items-center justify-center rounded-full">
                            <a class="cursor-pointer" data-tooltip="Convert To Customer">
                                <i class="fas fa-user-plus"></i>
                            </a>
                        </button>
                        <button class="bg-white text-info sm:w-10 sm:h-10 md:w-10 md:h-10 flex items-center justify-center rounded-full">
                            <a onclick="init_lead(<?= $lead->id ?>, true);return false;" class="cursor-pointer" data-tooltip="Edit Leads">
                                <i class="fas fa-pen"></i>
                            </a>
                        </button>
                    </div>
                </div>
            </div>

            <div class="lg:flex relative bg-white shadow-lg rounded-2xl -mt-10">
                
                <!-- First overlapping div -->
                <div class="lg:w-1/3 p-4 bg-neutral-100"> 
                    <div class="flex flex-col gap-4 p-4">

                            <div class="text-md sm:text-md md:text-xl font-semibold text-gray-800 mb-3">More Information:</div>

                            <div class="flex justify-between text-lg text-gray-700">
                                <span class="font-semibold">Email:</span>
                                <span class="cursor-pointer"><?= $lead->email ?: '<i class="fas fa-envelope" title="No Email Available"></i>'; ?></span>
                            </div>
                
                            <div class="flex justify-between text-lg text-gray-700">
                                <span class="font-semibold">Phone:</span>
                                <span class="cursor-pointer"><?= $lead->phonenumber ?: '<i class="fas fa-phone" title="No Phone Number Available"></i>'; ?></span>
                            </div>
                
                            <div class="flex justify-between text-lg text-gray-700">
                                <span class="font-semibold">Website:</span>
                                <span class="cursor-pointer"><?= $lead->website ?: '<i class="fas fa-globe" title="No Website Available"></i>'; ?></span>    
                            </div>
                            <div class="flex justify-between text-lg text-gray-700">
                                <span class="font-semibold">Company:</span>
                                <span class="cursor-pointer"><?= $lead->company ?: '<i class="fas fa-building" title="No Company Available"></i>'; ?></span>
                            </div>
                
                            <div class="flex justify-between text-lg text-gray-700">
                                <span class="font-semibold">Position:</span>
                                <span class="cursor-pointer"><?= $lead->title ?: '<i class="fas fa-briefcase" title="No Position Available"></i>'; ?></span>
                            </div>
                
                            <div class="flex justify-between text-lg text-gray-700">
                                <span class="font-semibold">Address:</span>
                                <span class="cursor-pointer"><?= $lead->address ?: '<i class="fas fa-map-marker-alt" title="No Address Available"></i>'; ?></span>
                            </div>
                
                            <div class="flex justify-between text-lg text-gray-700">
                                <span class="font-semibold">City:</span>
                                <span class="cursor-pointer"><?= $lead->city ?: '<i class="fas fa-city" title="No City Available"></i>'; ?></span>
                            </div>
                
                            <div class="flex justify-between text-lg text-gray-700">
                                <span class="font-semibold">State:</span>
                                <span class="cursor-pointer"><?= $lead->state ?: '<i class="fas fa-flag" title="No State Available"></i>'; ?></span>
                            </div>
                
                            <div class="flex justify-between text-lg text-gray-700">
                                <span class="font-semibold">Country:</span>
                                <span class="cursor-pointer"><?= $lead->country ?: '<i class="fas fa-globe-americas" title="No Country Available"></i>'; ?></span>
                            </div>
                
                            <div class="flex justify-between text-lg text-gray-700">
                                <span class="font-semibold">Zip Code:</span>
                                <span class="cursor-pointer"><?= $lead->zip ?: '<i class="fas fa-map-pin" title="No Zip Code Available"></i>'; ?></span>
                            </div>
            
                            <div class="flex justify-between text-lg text-gray-700 mb-3">
                                <span class="font-semibold">Description:</span>
                                <span class="cursor-pointer"><?= $lead->description ?: '<i class="fas fa-align-left" title="No Description Available"></i>'; ?></span>
                            </div>
                    </div>
                </div>
            
 
                <!-- SECOND OVERLAPPING DIV -->
                <div class="w-full lg:w-2/3 p-10 ">
                    
                    <!-- Lead Life Cycle -->
                    <div class="shadow-xl p-2 mb-5 border-2 border-solid border-gray-200 rounded-xl">
                        <div class="flex flex-row rounded-xl overflow-x-auto no-scrollbar dragscroll gap-2" >
                            <?php 
                                $currentStepFromDB = $lead->lifecycle_stage;
                                $stepNumber = 0;
                                
                                if ($lifecycle) {

                                    $cycleFlowData = json_decode($lifecycle['flow'], true);
                                    foreach($cycleFlowData as $flowItem):
                                        if (isset($flowItem['name'])) {
                                            $class = ($stepNumber < $currentStepFromDB) ? 'completed-step' : '';
                                            echo '<button onclick="move_lifecycle('.$stepNumber.');" class="bg-gray-200 px-4 py-2 transition-all duration-300 ease-in-out rounded-xl border border-transparent hover:border-gray-300 ' . $class . '" id="step-' . $stepNumber . '">';
                                                echo '<p class="text-gray-900 my-1">' . htmlspecialchars($flowItem['name']) . '</p>';
                                            echo '</button>';
                                            $stepNumber++;

                                            if($stepNumber < count($cycleFlowData)){
                                                echo '<div class="text-3xl flex items-center">➡️</div>';
                                            }
                                            
                                        }
                                    endforeach;
                                }else {
                                    echo '<h2 class="text-lg text-center p-2 w-full">Lifecycle not defined!</h2>';
                                }
                            ?>
                        </div>
                    </div>
                    

                    <div class="rounded-xl pt-4 border-2 border-solid border-gray-200">

                        <ul class="dragscroll tab-container flex flex-nowrap space-x-2overflow-x-auto overflow-y-hidden pb-[6px] px-5 no-scrollbar bg-whiterounded-t-xl shadow-xl" id="leadTab" role="tablis">
                                
                                <li class="tab-item pt-[6px]">
                                    <a class="text-lg text-gray-700 hover:text-gray-900 font-medium py-2 px-3 rounded transition duration-200 hover:bg-gray-200 rounded-t-xl" id="communications-tab" data-toggle="tab" href="#communications" role="tab" aria-controls="communications" aria-selected="false">Messages</a>
                                </li>
                        
                                
                                <li class="tab-item pt-[6px]">
                                    <a class="text-lg text-gray-700 hover:text-gray-900 font-medium py-2 px-3 rounded transition duration-200 hover:bg-gray-200 rounded-t-xl" id="proposals-tab" data-toggle="tab" href="#proposals" role="tab" aria-controls="proposals" aria-selected="false" onclick="initDataTable('.table-proposals-lead', admin_url + 'proposals/proposal_relations/' + <?php echo $lead->id; ?> + '/lead','undefined', 'undefined','undefined',[6,'desc']);">Proposals</a>
                                </li>
                                <li class="tab-item pt-[6px]">
                                    <a class="text-lg text-gray-700 hover:text-gray-900 font-medium py-2 px-3 rounded transition duration-200 hover:bg-gray-200 rounded-t-xl" id="Contracts-tab" data-toggle="tab" href="#Contracts" role="tab" aria-controls="Contracts" aria-selected="false">Contracts</a>
                                </li>
                                <li class="tab-item pt-[6px]">
                                    <a class="text-lg text-gray-700 hover:text-gray-900 font-medium py-2 px-3 rounded transition duration-200 hover:bg-gray-200 rounded-t-xl" id="invoices-tab" data-toggle="tab" href="#invoices" role="tab" aria-controls="invoices" aria-selected="false">Invoices</a>
                                </li>
                                <li class="tab-item pt-[6px]">
                                    <a class="text-lg text-gray-700 hover:text-gray-900 font-medium py-2 px-3 rounded transition duration-200 hover:bg-gray-200 rounded-t-xl" id="event-tab" data-toggle="tab" href="#event" role="tab" aria-controls="event" aria-selected="false">Events</a>
                                </li>
                                <li class="tab-item pt-[6px]">
                                    <a class="text-lg text-gray-700 hover:text-gray-900 font-medium py-2 px-3 rounded transition duration-200 hover:bg-gray-200 rounded-t-xl" id="tasks-tab" data-toggle="tab" href="#tasks" role="tab" aria-controls="tasks" aria-selected="false" onclick="init_rel_tasks_table(<?php echo $lead->id; ?>,'lead','.table-rel-tasks-leads');">Tasks</a>
                                </li>
                                <li class="tab-item pt-[6px]">
                                    <a class="text-lg text-gray-700 hover:text-gray-900 font-medium py-2 px-3 rounded transition duration-200 hover:bg-gray-200 rounded-t-xl" id="activity-tab" data-toggle="tab" href="#activity" role="tab" aria-controls="activity" aria-selected="true">Activity</a>
                                </li>
                                <li class="tab-item pt-[6px]">
                                    <a class="text-lg text-gray-700 hover:text-gray-900 font-medium py-2 px-3 rounded transition duration-200 hover:bg-gray-200 rounded-t-xl" id="attachments-tab" data-toggle="tab" href="#attachments" role="tab" aria-controls="attachments" aria-selected="false">Attachments</a>
                                </li>
                                <li class="tab-item pt-[6px]">
                                    <a class="text-lg text-gray-700 hover:text-gray-900 font-medium py-2 px-3 rounded transition duration-200 hover:bg-gray-200 rounded-t-xl" id="reminders-tab" data-toggle="tab" href="#reminders" role="tab" aria-controls="reminders" aria-selected="false" onclick="initDataTable('.table-reminders-leads', admin_url + 'misc/get_reminders/' + <?php echo $lead->id; ?> + '/' + 'lead', undefined, undefined,undefined,[1, 'asc']);">Reminders</a>
                                </li>
                                <li class="tab-item pt-[6px]">
                                    <a class="text-lg text-gray-700 hover:text-gray-900 font-medium py-2 px-3 rounded transition duration-200 hover:bg-gray-200 rounded-t-xl" id="notes-tab" data-toggle="tab" href="#notes" role="tab" aria-controls="notes" aria-selected="false">Notes</a>
                                </li>
                                
                                <!-- More nav items here... -->
                        </ul>


                        <div class="tab-content rounded-b-xl shadow-lg bg-white text-gray-800" id="leadTabContent">

                            <div class="tab-pane fade in active pt-4" id="communications" role="tabpanel" aria-labelledby="communications-tab">

                                <div class="flex flex-wrap gap-4 justify-center mb-4 p-4">
                                    <button class="flex flex-row gap-2 px-4 py-2 transition bg-blue-500 hover:bg-blue-600 text-white group items-center rounded-xl duration-300 ease-out hover:scale-105 ring-offset-2 ring-2 ring-transparent hover:ring-black" onclick="initEmailMessage('Compose', 'compose', '<?= $lead->id; ?>')">
                                        <i class="group-hover:rotate-180 group-hover:mb-1 duration-300 transition-all ease-out fa fa-plus origin-center"></i>
                                        <span>Compose</span>
                                    </button>

                                    <button onclick="openEventModal();" class="flex flex-row gap-2 px-4 py-2 transition bg-blue-500 hover:bg-blue-600 text-white group items-center rounded-xl duration-300 ease-out hover:scale-105 ring-offset-2 ring-2 ring-transparent hover:ring-black">
                                        <i class="duration-500 transition-all ease-out fa fa-calendar origin-center group-hover:translate-x-[78px]"></i>
                                        <span class="duration-500 transition-all ease-out group-hover:translate-x-[-20px]">New Event</span>
                                    </button>


                                    <?php if (has_permission('proposals', '', 'create')) { ?>
                                    <a href="<?php echo admin_url('proposals/proposal?rel_type=lead&rel_id=' . $lead->id); ?>" class="flex flex-row gap-2 px-4 py-2 transition bg-blue-500 hover:bg-blue-600 text-white group items-center rounded-xl duration-300 ease-out hover:scale-105 ring-offset-2 ring-2 ring-transparent hover:ring-black hover:text-white focus:text-white ">
                                        <i class="group-hover:rotate-180 group-hover:mb-1 duration-300 transition-all ease-out fa fa-sticky-note origin-center"></i>
                                        <span>New Proposal</span>
                                    </a>
                                    <?php } ?>

                                    <a href="<?php echo admin_url('contracts/contract/?rel_type=lead&rel_id=' . $lead->id); ?>" class="flex flex-row gap-2 px-4 py-2 transition bg-blue-500 hover:bg-blue-600 text-white group items-center rounded-xl duration-300 ease-out hover:scale-105 ring-offset-2 ring-2 ring-transparent hover:ring-black text-white hover:text-white focus:text-white">
                                        <i class="duration-500 transition-all ease-out fa fa-file-contract origin-center group-hover:translate-x-[97px]"></i>
                                        <span class="duration-500 transition-all ease-out group-hover:translate-x-[-20px]">New Contract</span>
                                    </a>

                                    


                                </div>   


                                <hr class="border-gray-200">
                                <div class="bg-white rounded-b-xl shadow-md p-4" id="conversation-flow">
                                    <!-- Conversation start -->
                                    <div>
                                        <?php
                                        if(count($messages) > 0){
                                            foreach($messages as $message){
                                                if($message['sent_by'] == "lead"){
                                                    echo '
                                                    <div class="flex mb-2 text-base">
                                                        <div class="pb-3 bg-gray-100 text-black max-w-lg rounded-xl">
                                                            <div class="mb-2 bg-gray-800 rounded-t-xl px-4 py-2 text-white font-bold">
                                                                '.$message["subject"].'
                                                            </div>
                                                            <div class="mb-2 px-3">
                                                                '.$message["body"].'
                                                            </div>
                                                            <span class="px-3 text-sm">'.date("h:i A, F jS, Y", strtotime($message["created_at"])).'</span>
                                                        </div>
                                                    </div>';
                                                } else if ($message['sent_by'] == "admin"){
                                                    echo '
                                                    <div class="flex flex-col items-end justify-end mb-2 text-base">
                                                        <div class="pb-3 bg-gray-800 text-white max-w-lg rounded-xl">
                                                            <div class="mb-2 bg-gray-100 rounded-t-xl px-3 py-2 text-gray-800 font-bold">
                                                                '.$message["subject"].'
                                                            </div>
                                                            <div class="mb-2 px-3">
                                                                '.$message["body"].'
                                                            </div>
                                                            <span class="px-3 float-right text-sm">'.date("h:i A, F jS, Y", strtotime($message["created_at"])).'</span>
                                                        </div>
                                                    </div>
                                                    ';
                                                }
                                            }
                                        } else {
                                            echo '
                                            <div class="p-4 rounded-xl shadow-lg bg-gray-300 text-gray-800">
                                                No Messages!
                                            </div>
                                            ';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                                

                            <div class="tab-pane fade in text-gray-800 p-4" id="activity" role="tabpanel" aria-labelledby="activity-tab">
                                <div class="activity-feed">
                                    <?php foreach ($activity_log as $log) { ?>
                                    <div class="feed-item flex items-start mb-3">
                                        <div class="date text-sm text-gray-500">
                                            <span class="text-has-action" data-toggle="tooltip" data-title="<?php echo _dt($log['date']); ?>">
                                                <?php echo time_ago($log['date']); ?>
                                            </span>
                                        </div>
                                        <div class="text pl-3">
                                            <?php if ($log['staffid'] != 0) { ?>
                                            <a href="<?php echo admin_url('profile/' . $log['staffid']); ?>">
                                                <?php echo staff_profile_image($log['staffid'], ['staff-profile-xs-image pull-left mright5']); ?>
                                            </a>
                                            <?php } ?>
                                            <?php
                                            $additional_data = '';
                                            if (!empty($log['additional_data'])) {
                                                $additional_data = unserialize($log['additional_data']);
                                                echo ($log['staffid'] == 0) ? _l($log['description'], $additional_data) : _l($log['description'], $additional_data);
                                            } else {
                                                if ($log['custom_activity'] == 0) {
                                                    echo $log['full_name'] . ' - ' . _l($log['description']);
                                                } else {
                                                    echo $log['full_name'] . ' - ' . _l($log['description'], '', false);
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="col-md-12">
                                        <?php echo render_textarea('lead_activity_textarea', '', '', ['placeholder' => _l('enter_activity')], [], 'mtop15'); ?>
                                        <div class="text-right">
                                            <button id="lead_enter_activity" class="btn btn-primary mt-3"><?php echo _l('submit'); ?></button>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>


                            <div class="tab-pane fade text-gray-800 p-4" role="tabpanel" id="proposals" aria-labelledby="proposals-tab">
                                <?php if (has_permission('proposals', '', 'create')) { ?>
                                <a href="<?php echo admin_url('proposals/proposal?rel_type=lead&rel_id=' . $lead->id); ?>"
                                    class="btn btn-primary mbot25 mb-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">New Proposal</a>
                                <?php } ?>
                                <?php if (total_rows(db_prefix() . 'proposals', ['rel_type' => 'lead', 'rel_id' => $lead->id]) > 0 && (has_permission('proposals', '', 'create') || has_permission('proposals', '', 'edit'))) { ?>
                                <a href="#" class="btn btn-primary mbot25 mb-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" data-toggle="modal"
                                    data-target="#sync_data_proposal_data">Sync Data</a>
                                <?php $this->load->view('admin/proposals/sync_data', ['related' => $lead, 'rel_id' => $lead->id, 'rel_type' => 'lead']); ?>
                                <?php } ?>
                                <?php
                                $table_data = [
                                    _l('proposal') . ' #',
                                    _l('proposal_subject'),
                                    _l('proposal_total'),
                                    _l('proposal_date'),
                                    _l('proposal_open_till'),
                                    _l('tags'),
                                    _l('proposal_date_created'),
                                    _l('proposal_status'),
                                ];
                                $custom_fields = get_custom_fields('proposal', ['show_on_table' => 1]);
                                foreach ($custom_fields as $field) {
                                    array_push($table_data, [
                                        'name'     => $field['name'],
                                        'th_attrs' => ['data-type' => $field['type'], 'data-custom-field' => 1],
                                    ]);
                                }
                                $table_data = hooks()->apply_filters('proposals_relation_table_columns', $table_data);
                                render_datatable($table_data, 'proposals-lead', [], [
                                    'data-last-order-identifier' => 'proposals-relation',
                                    'data-default-order'         => get_table_last_order('proposals-relation'),
                                ]);
                                ?>
                            </div>


                            <div class="tab-pane fade text-gray-800 p-4" role="tabpanel" id="Contracts" aria-labelledby="Contracts-tab">
                                <?php if (has_permission('contracts', '', 'create')) { ?>
                                <a href="<?php echo admin_url('contracts/contract/?rel_type=lead&rel_id=' . $lead->id); ?>"
                                    class="btn btn-primary mbot25 mb-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">New Contract</a>
                                <?php } ?>
                                <div class="w-full mx-auto">
                                    <div class="bg-white">
                                        <table id="contracts_table" class="table no-scrollbar">
                                            <thead class="bg-gray-200">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Subject</th>
                                                    <th>Relative</th>
                                                    <th>Contract Type</th>
                                                    <th>Contract Value</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Project</th>
                                                    <th>Signature</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-600">
                                                <?php foreach ($contracts as $contract) : ?>
                                                <tr>
                                                    <td><?php echo $contract['id']; ?></td>
                                                    <td><?php echo $contract['subject']; ?></td>
                                                    <td><?php echo $contract['client_name'] ? $contract['client_name'] : $contract['lead_name']; ?></td>
                                                    <td><?php echo $contract['contract_type']; ?></td>
                                                    <td><?php echo $contract['contract_value']; ?></td>
                                                    <td><?php echo $contract['datestart']; ?></td>
                                                    <td><?php echo $contract['dateend']; ?></td>
                                                    <td><?php echo $contract['project_id']; ?></td>
                                                    <td><?php echo $contract['signature']; ?></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane fade text-gray-800 p-4" role="tabpanel" id="invoices"aria-labelledby="invoices-tab">
                                <?php if (has_permission('proposals', '', 'create')) { ?>
                                <a href="<?php echo admin_url('invoices/invoice'); ?>"
                                    class="btn btn-primary mbot25"><?php echo 'New Invoice'; ?></a>
                                <?php } ?>
                                <?php
                                $table_data = array(
                                    _l('invoice_dt_table_heading_number'),
                                    _l('invoice_dt_table_heading_amount'),
                                    _l('invoice_total_tax'),
                                    array(
                                    'name'=>_l('invoice_estimate_year'),
                                    'th_attrs'=>array('class'=>'not_visible')
                                    ),
                                    _l('invoice_dt_table_heading_date'),
                                    array(
                                    'name'=>_l('invoice_dt_table_heading_client'),
                                    'th_attrs'=>array('class'=>(isset($client) ? 'not_visible' : ''))
                                    ),
                                    _l('project'),
                                    _l('tags'),
                                    _l('invoice_dt_table_heading_duedate'),
                                    _l('invoice_dt_table_heading_status'));
                                $custom_fields = get_custom_fields('invoice',array('show_on_table'=>1));
                                foreach($custom_fields as $field){
                                    array_push($table_data, [
                                    'name' => $field['name'],
                                    'th_attrs' => array('data-type'=>$field['type'], 'data-custom-field'=>1)
                                ]);
                                }
                                $table_data = hooks()->apply_filters('invoices_table_columns', $table_data);
                                render_datatable($table_data, (isset($class) ? $class : 'invoices'));
                                ?>
                            </div>

                            <div class="tab-pane fade text-gray-800 p-4" id="tasks" role="tabpanel"aria-labelledby="tasks-tab">
                                <?php init_relation_tasks_table(['data-new-rel-id' => $lead->id, 'data-new-rel-type' => 'lead']); ?>
                            </div>

                            <div role="tabpanel" class="tab-pane fade text-gray-800 p-4" id="attachments"aria-labelledby="attachments-tab" role="tabpanel">
                                <?php echo form_open('admin/leads/add_lead_attachment', ['class' => 'dropzone mtop15 mbot15', 'id' => 'lead-attachment-upload']); ?>
                                <?php echo form_close(); ?>
                                <?php if (1 == 1) { ?>
                                <hr />
                                <div class=" pull-left">
                                    <?php if (count($lead->attachments) > 0) { ?>
                                    <a href="<?php echo admin_url('leads/download_files/' . $lead->id); ?>" class="bold">
                                        <?php echo _l('download_all'); ?> (.zip)
                                    </a>
                                    <?php } ?>
                                </div>
                                <div class="tw-flex tw-justify-end tw-items-center tw-space-x-2">
                                    <button class="gpicker">
                                        <i class="fa-brands fa-google" aria-hidden="true"></i>
                                        <?php echo _l('choose_from_google_drive'); ?>
                                    </button>
                                    <div id="dropbox-chooser-lead"></div>
                                </div>
                                <div class=" clearfix"></div>
                                <?php } ?>
                                <?php if (count($lead->attachments) > 0) { ?>
                                <div class="mtop20" id="lead_attachments">
                                    <?php $this->load->view('admin/leads/leads_attachments_template', ['attachments' => $lead->attachments]); ?>
                                </div>
                                <?php } ?>
                            </div>

                            <div role="tabpanel" class="tab-pane fade text-gray-800 p-4" id="reminders"aria-labelledby="reminders-tab">
                                <a href="#" data-toggle="modal" class="mb-2 btn btn-primary"
                                    data-target=".reminder-modal-lead-<?php echo $lead->id; ?>"><i class="fa-regular fa-bell"></i>
                                    <?php echo _l('lead_set_reminder_title'); ?></a>
                                <hr />
                                <?php render_datatable([ _l('reminder_description'), _l('reminder_date'), _l('reminder_staff'), _l('reminder_is_notified')], 'reminders-leads'); ?>
                            </div>


                            <div role="tabpanel" class="tab-pane fade text-gray-800 p-4" id="event" aria-labelledby="event-tab">
                                <!-- Tab Content for Events -->
                                <div id="eventsContent" class="tab-pane mt-4">
                                    <button onclick="openEventModal();" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Create New Event</button>
                                    
                                    <!-- Here's where we loop through the events to generate the cards -->
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                        
                                        <?php foreach($tblevents as $tblevent): ?>
                                            <div class="transition-transform transform bg-white hover:scale-105 cursor-pointer border p-4 rounded shadow hover:shadow-lg">
                                                <h3 class="text-xl font-bold mb-2"><?php echo $tblevent['event_name']; ?></h3>
                                                <p class="mb-2 text-gray-700"><?php echo $tblevent['description']; ?></p>
                                                <a href="<?php echo $tblevent['meet_schedule_link']; ?>" target="_blank" class="text-blue-500 hover:text-blue-600 underline">Meet Schedule Link</a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade text-gray-800 p-4" id="notes" aria-labelledby="notes-tab">
                                <?php echo form_open(admin_url('leads/add_note/' . $lead->id), ['id' =>'lead-notes']); ?>
                                <div class="form-group">
                                    <textarea id="lead_note_description" name="lead_note_description" class="form-control"
                                        rows="4"></textarea>
                                </div>
                                <div class="lead-select-date-contacted hide">
                                    <?php echo render_datetime_input('custom_contact_date', 'lead_add_edit_datecontacted', '', ['data-date-end-date' => date('Y-m-d')]); ?>
                                </div>
                                <div class="radio radio-primary">
                                    <input type="radio" name="contacted_indicator" id="contacted_indicator_yes" value="yes">
                                    <label
                                        for="contacted_indicator_yes"><?php echo _l('lead_add_edit_contacted_this_lead'); ?></label>
                                </div>
                                <div class="radio radio-primary">
                                    <input type="radio" name="contacted_indicator" id="contacted_indicator_no" value="no" checked>
                                    <label for="contacted_indicator_no"><?php echo _l('lead_not_contacted'); ?></label>
                                </div>
                                <button type="submit"
                                    class="btn btn-primary pull-right"><?php echo _l('lead_add_edit_add_note'); ?></button>
                                <?php echo form_close(); ?>
                                <div class="clearfix"></div>
                                <hr />
                                <?php
                                $len = count($notes);
                                $i   = 0;
                                foreach ($notes as $note) { ?>
                                <div class="media lead-note">
                                    <a href="<?php echo admin_url('profile/' . $note['addedfrom']); ?>" target="_blank">
                                        <?php echo staff_profile_image($note['addedfrom'], ['staff-profile-image-small', 'pull-left mright10']); ?>
                                    </a>
                                    <div class="media-body">
                                        <?php if ($note['addedfrom'] == get_staff_user_id() || is_admin()) { ?>
                                        <a href="#" class="pull-right text-danger"
                                            onclick="delete_lead_note(this,<?php echo $note['id']; ?>, <?php echo $lead->id; ?>);return false;">

                                            <i class="fa fa fa-times"></i></a>
                                        <a href="#" class="pull-right mright5"
                                            onclick="toggle_edit_note(<?php echo $note['id']; ?>);return false;">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                            <?php } ?>

                                            <a href="<?php echo admin_url('profile/' . $note['addedfrom']); ?>" target="_blank">
                                                <h5 class="media-heading tw-font-semibold tw-mb-0">
                                                    <?php if (!empty($note['date_contacted'])) { ?>
                                                    <span data-toggle="tooltip"
                                                        data-title="<?php echo _dt($note['date_contacted']); ?>">
                                                        <i class="fa fa-phone-square text-success" aria-hidden="true"></i>
                                                    </span>
                                                    <?php } ?>
                                                    <?php echo get_staff_full_name($note['addedfrom']); ?>
                                                </h5>
                                                <span class="tw-text-sm tw-text-neutral-500">
                                                    <?php echo _l('lead_note_date_added', _dt($note['dateadded'])); ?>
                                                </span>
                                            </a>

                                            <div data-note-description="<?php echo $note['id']; ?>" class="text-muted mtop10">
                                                <?php echo check_for_links(app_happy_text($note['description'])); ?>
                                            </div>
                                            <div data-note-edit-textarea="<?php echo $note['id']; ?>" class="hide mtop15">
                                                <?php echo render_textarea('note', '', $note['description']); ?>
                                                <div class="text-right">
                                                    <button type="button" class="btn btn-default"
                                                        onclick="toggle_edit_note(<?php echo $note['id']; ?>);return false;"><?php echo _l('cancel'); ?></button>
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="edit_note(<?php echo $note['id']; ?>);"><?php echo _l('update_note'); ?></button>
                                                </div>
                                            </div>
                                    </div>
                                    <?php if ($i >= 0 && $i != $len - 1) {
                                    echo '<hr />';
                                }
                                    ?>
                            </div>
                                <?php $i++; } ?>
                        </div> 
    
                    </div>
                </div>
                
            </div>

        </div>

    </div>
</div>

<div class="modal fade" id="createEventModal" tabindex="-1" aria-labelledby="createEventModalLabel" aria-hidden="true">
    <div class="flex justify-center m-10">
        <div class="modal-content modal-lg">

            <div class="modal-header text-white py-3">
                <h5 class="modal-title text-xl" id="createEventModalLabel">Create New Event</h5>
            </div>
            <div class="modal-body">
                <form id="event_form">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                    <input type="text" name="event_name" placeholder="Event Name" class="w-full p-2 border rounded mt-2">
                    <textarea name="description" placeholder="Event Description" class="w-full p-2 border rounded mt-2"></textarea>
                    <input type="text" name="meet_schedule_link" placeholder="Meet Schedule Link" class="w-full p-2 border rounded mt-2">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">Save</button>
                </form>
            </div>


        </div>
    </div>
</div>


<!-- Action Template Modal -->
<div class="modal fade" id="composeModal" tabindex="-1" aria-labelledby="composeModalLabel" aria-hidden="true">
    <div class="flex justify-center m-10">
        <div class="modal-content modal-lg">

            <form id="sendMessageForm">

            <div class="modal-header text-white py-3">
                <h5 class="modal-title text-xl" id="composeModalLabel"></h5>
            </div>
            <div class="modal-body">
                <div class="p-2">

                    <div class="mb-2">
                        <label for="prompt" class="block text-gray-700 font-bold mb-2">Generation</label>

                        <select id="ai_model" class="form-input border border-gray-400 w-full py-2 px-3 rounded-lg transition duration-500 ease-in-out focus:outline-none focus:shadow-outline focus:border-blue-500 mb-2">
                            <option value="gpt-3.5-turbo">GPT 3.5 Turbo</option> <option value="gpt-4">GPT 4</option>
                        </select>

                        <div class="flex flex-col gap-2">
                            <textarea class="w-full form-input border border-gray-400 w-full py-2 px-3 rounded-lg transition duration-500 ease-in-out focus:outline-none focus:shadow-outline focus:border-blue-500" id="aiInput" placeholder="Give out a negative response!"></textarea>
                            <div class="w-full flex justify-end"><button type="button" class="rounded transition-all bg-blue-600 text-white hover:bg-white hover:text-blue-500 hover:border-blue-500 border border-solid px-4 py-2 float-right" onclick="makeAIRequest()">Generate</button></div>
                        </div>
                    </div>
 
                    <div class="mb-6">
                        <label for="subject" class="block text-gray-700 font-bold mb-2">Subject <span class="text-red-600">*</span></label>
                        <input required type="text" placeholder="Subject" name="subject" id="subject" class="form-input border border-gray-400 w-full py-2 px-3 rounded-lg transition duration-500 ease-in-out focus:outline-none focus:shadow-outline focus:border-blue-500">
                    </div>
                    <div class="mb-6">
                        <label for="body" class="block text-gray-700 font-bold mb-2">Body</label>
                        <textarea id="body" class="form-input border border-gray-400 w-full py-2 px-3 rounded-lg transition duration-500 ease-in-out focus:outline-none focus:shadow-outline focus:border-blue-500"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer flex justify-end">
                <div>
                    <button type="button" class="rounded transition-all bg-gray-600 text-white hover:bg-white hover:text-gray-500 hover:border-gray-500 border border-solid px-4 py-2" data-dismiss="modal">Close</button>
                    <button type="submit" class="rounded transition-all bg-blue-600 text-white hover:bg-white hover:text-blue-500 hover:border-blue-500 border border-solid px-4 py-2">Send <i class="fa fa-paper-plane ml-2"></i></button>
                </div>
            </div>

            </form>
            
        </div>
    </div>
</div>


 <?php init_tail(); ?>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/dragscroll/0.0.8/dragscroll.min.js"></script>

<script>
 let currentStep = <?php echo $lead->lifecycle_stage; ?>;

 function move_lifecycle(step){

    Swal.fire({
        title: 'Are you sure?',
        text: "You are moving the lifecycle to step # "+(step+1)+" !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Proceed!',
        cancelButtonText: 'Cancel'
    }).then((result) => {

        if (!result.isConfirmed) {
            return;
        }

        // Remove active class from the current step and add completed class
        document.getElementById("step-" + currentStep).classList.remove("active-step");
        document.getElementById("step-" + currentStep).classList.add("completed-step");

        // Increment current step
        currentStep = step;

        // Add active class to the new current step
        refresh_lifecycle();

        // AJAX request to save the current step to the database
        $.ajax({
            url: '<?= admin_url('leads/save_current_step'); ?>',
            type: 'POST',
            data: { step: currentStep, lead_id: '<?= $lead->id; ?>' },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Success',
                        text: "Step Saved!",
                        icon: 'success',
                    });
                }else{
                    Swal.fire({
                        title: 'Failed',
                        text: "some error!",
                        icon: 'error',
                    });
                }
            },
            error: function(error) {
                Swal.fire({
                    title: 'Failed',
                    text: "some error!",
                    icon: 'error',
                });
            }
        });

    });


    
}


function refresh_lifecycle(){
    
    // Initialize the previous steps as completed and the current step as active
    for (let i = 0; i < currentStep; i++) {
        document.getElementById("step-" + i).classList.add("completed-step");
    }

    for (let i = currentStep; i < <?= $stepNumber ?>; i++) {
        document.getElementById("step-" + i).classList.remove("completed-step");
    }
    
    document.getElementById("step-" + currentStep).classList.add("active-step");

}

refresh_lifecycle();

</script>

<style>

    .active-step {
        background-color: lightgreen;
    }
    .completed-step {
        background-color: lightblue;
    }   

    table{
        background: white;
    }
    .swal2-container {
        z-index: 20000;
    }

    .customStatus .form-group{
        margin: 0;
        width: 180px;
    }
    .customStatus .form-group-select-input-status label{
        display: none !important;
    }

    #contracts_table_wrapper .row .col-sm-12{
        overflow-x:scroll;
        
    }

    #contracts_table_wrapper .row .col-sm-12::-webkit-scrollbar {
        height: 4px; /* You can adjust the height as per your need */
        background: #f0f0f0; /* Light background color for the scrollbar */
    }
    .custombtn:active{
        transform: scale(0.98); /* You can adjust this value to your liking */
    box-shadow: 0 5px 10px rgb(0, 0, 0, 0.2);
    }

    .tab-item {
        position: relative;
        text-transform: capitalize;
        display: inline-block;
        margin-bottom: 8px;

    }

    .tab-item::before {
        content: "";
        position: absolute;
        display:  block;
        bottom: -3px; /* Adjust the position of the line based on your preference */
        left: 0;
        width: 0; /* Start the line with zero width */
        height: 3px;
        background-color: #777; /* Change the color of the line */
        transition: width 0.7s ease-in-out; /* Adjust the transition speed as needed */
    }

    .tab-item:hover::before {
        width: 100%; /* Scale the line to full width on hover */
    }
    .no-scrollbar::-webkit-scrollbar {
        height: 4px; /* You can adjust the height as per your need */
        background: #f0f0f0; /* Light background color for the scrollbar */
    }
    .no-scrollbar::-webkit-scrollbar-thumb {
        background: #ccc; /* Light color for the scrollbar thumb */
    }
</style>

<script>

<?php
if($this->session->userdata('resend') && isset($resend)){

    if($resend){
            echo '

            $(document).ready(function(){

                Swal.fire({
                title: \' '.ucfirst($rel_type).' Already sent\',
                text: "Wanna send again??",
                icon: \'warning\',
                showCancelButton: true,
                confirmButtonColor: \'#3085d6\',
                cancelButtonColor: \'#d33\',
                confirmButtonText: \'Yes, Send!\',
                cancelButtonText: \'Cancel\'
                }).then((result) => {
            
                    if (!result.isConfirmed) {
                        return;
                    }else{
                        ';
                        if(isset($rel_type) && $rel_type == "proposal"){
                            echo 'initProposalSend('.$rel_id.');';
                        }
                        echo '
                    }
                });
            })
            ';
    }else{
        if(isset($rel_type) && $rel_type == "proposal"){
            echo 'initProposalSend('.$rel_id.');';
        }
    }
    $this->session->unset_userdata('resend');
}
?>
$( document ).ready(function() {
    $("#lead_reminder_modal").html(`<?= $reminder_data ?>`);
    $('#date').datetimepicker();
});



var items = Array("Give out a negative reply!", "Write something positive!", "Write to remind about replying!", "Ask for an event schedule!", "Modify my response and make it sound professional!");
document.getElementById('aiInput').setAttribute("placeholder", items[Math.floor(Math.random()*items.length)]);


function initEmailMessage(heading, type, id){
    $("#composeModalLabel").html(heading);
    $("#composeModal").modal('show');

    $("#composeModal").data("rel-type", type);
    $("#composeModal").data("rel-id", id);
}

function makeAIRequest(){

    let prompt = document.getElementById('aiInput').value;
    let model = document.getElementById("ai_model").value;

    Swal.fire({
        title: 'Processing...',
        text: 'Some cool stuff is being generated!',
        timerProgressBar: true,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        },
    });

    let rel_type = $("#composeModal").data("rel-type");
    let rel_id = $("#composeModal").data("rel-id");
    let _url = '';

    if(rel_type == "compose"){
        _url = '<?= admin_url("leads/compose_context/"); ?>'+rel_id+'/'+model+'/'+prompt;
    }else if(rel_type == "proposal"){
        _url = '<?= admin_url("leads/proposalAIRequest/"); ?>'+rel_id+'/'+model+'/'+prompt;
    }else if(rel_type == "event"){
        _url = '<?= admin_url("leads/eventAIRequest/"); ?>'+rel_id+'/'+model+'/'+prompt;
    }


    $.ajax({
        type: 'GET',
        url: _url,
        dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.success) {

                Swal.fire(
                    'Success!',
                    'Here is your content.',
                    'success'
                );

                $("#subject").val(response.subject);
                tinymce.get('body').setContent(response.body);
            } else {
                Swal.fire(
                    'Error!',
                    'Some error!',
                    'error'
                );
            }
        },
        error: function() {
            Swal.close();
            Swal.fire(
                    'Error!',
                    'Some error!',
                    'error'
                );
        }
    });
}

$('#sendMessageForm').on('submit', function(e) {
    e.preventDefault();

    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, Send!',
    cancelButtonText: 'Cancel'
    }).then((result) => {

        if (!result.isConfirmed) {
            return;
        }

        Swal.fire({
            title: 'Processing...',
            text: 'Please wait while request is being processed',
            timerProgressBar: true,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            },
        });

        
        const formData = new FormData(this);
        formData.append(csrfData.token_name, csrfData.hash);

        let bodyContent = tinymce.get('body').getContent();

        formData.append('body', bodyContent);
        formData.append('lead_id', <?= $lead->id ?>);
        formData.append('email', '<?= $lead->email; ?>');

        if(!bodyContent){
            alert_float("warning", "Empty Body...");
            return;
        }

        var dateObj = new Date();
        var day = dateObj.getDate();
        var year = dateObj.getFullYear();
        var month = dateObj.toLocaleString('default', { month: 'long' });

        // Extract current hour and minute
        var hours = dateObj.getHours();
        var minutes = dateObj.getMinutes();
        var ampm = hours >= 12 ? 'PM' : 'AM';

        // Convert 24-hour format to 12-hour format
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'

        // Pad minute with zero if needed
        minutes = minutes < 10 ? '0' + minutes : minutes;

        // Construct the time string
        var timeStr = hours + ':' + minutes + ' ' + ampm;

        // Construct the full datetime string
        var dateStr = timeStr + ', ' + month + ' ' + day + nth(day) + ', ' + year;


        $.ajax({
            type: 'POST',
            url: '<?= admin_url("leads/add_message"); ?>',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                    
                    $("#composeModal").modal('hide');


                    $("#conversation-flow").prepend(`
                        <div class="flex flex-col items-end justify-end mb-2 text-base">
                            <div class="pb-3 bg-[#172A3A] text-white max-w-lg rounded-tr-3xl rounded-tl-3xl rounded-bl-3xl">
                                <div class="mb-2 bg-gray-100 rounded-t-3xl px-3 py-2 text-[#172A3A] font-bold">` + $("#subject").val() + `</div>
                                <div class="mb-2 px-3">` + bodyContent + `</div>
                                <span class="px-3 float-right text-sm">` + dateStr + `</span>
                            </div>
                        </div>
                    `);

                    tinymce.get('body').setContent("");
                    $("#subject").val("");

                    let type = $("#composeModal").data("rel-type");

                    if(type == "compose" || type=="event"){
                        Swal.close();
                        Swal.fire(
                        'Success!',
                        'Your message is sent!',
                        'success'
                        );
                    }

                    if(type == "proposal"){
                        proposalChangeStatus($("#composeModal").data("rel-id"));
                    }

                } else {
                    Swal.fire(
                        'Error!',
                        'Some error!',
                        'error'
                    );
                }
            },
            error: function() {
                alert('An error occurred while processing the request.');
            }
        });
    });
});

function initEventSend(id){
    Swal.fire({
    title: 'Choose a model',
    text: "Select AI Model to generate content!",
    icon: 'info',
    showDenyButton: true,
    confirmButtonColor: '#29b952',
    denyButtonColor: '#8e4dcf',
    confirmButtonText: 'Balanced',
    denyButtonText: 'Quality'
    }).then((result) => {

        let model = '';

        if (result.isConfirmed) {
            model = 'gpt-3.5-turbo';
        }else if(result.isDismissed){
            return;
        }else if (result.isDenied) {
            model = 'gpt-4';
        }


        Swal.fire({
            title: 'Processing...',
            text: 'Some cool stuff is being generated!',
            timerProgressBar: true,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            },
        });


        $.ajax({
            type: 'GET',
            url: '<?= admin_url("leads/eventAIRequest/"); ?>'+id+'/'+model,
            dataType: 'json',
            success: function(response) {
                Swal.close();
                if (response.success) {

                    Swal.fire(
                        'Success!',
                        'Here is your content.',
                        'success'
                    );

                    $("#subject").val(response.subject);
                    tinymce.get('body').setContent(response.body);
                    
                    initEmailMessage("Send Event", "event", id);

                } else {
                    Swal.fire(
                        'Error!',
                        'Some error!',
                        'error'
                    );
                }
            },
            error: function() {
                alert('An error occurred while processing the request.');
            }
        });

    });
}

function initProposalSend(id) {
    // Create a popup to select a contract
    let contractsHtml = '';
    <?php if (count($contracts) > 0) : ?>
        <?php foreach ($contracts as $contract) : ?>
            contractsHtml += '<button onclick="initProposalModelSelection('+id+',<?= $contract['id'] ?>)" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 transition-all"><?php echo $contract["subject"]; ?></button><br>';
        <?php endforeach; ?>
    <?php else: ?>
        contractsHtml += '<button onclick="initProposalModelSelection('+id+', null)" class="contract-button">Dummy Contract</button><br>';
    <?php endif; ?>

    Swal.fire({
        title: 'Choose a contract',
        html: contractsHtml,
        showCancelButton: true,
        showConfirmButton: false,
        confirmButtonColor: '#29b952',
        confirmButtonText: 'Cancel',
    }).then((result) => {
        if (result.isConfirmed) {
            return;
        }
    });
}

function initProposalModelSelection(id, contract){

    Swal.fire({
    title: 'Choose a model',
    text: "Select AI Model to generate content!",
    icon: 'info',
    showDenyButton: true,
    confirmButtonColor: '#29b952',
    denyButtonColor: '#8e4dcf',
    confirmButtonText: 'Balanced',
    denyButtonText: 'Quality'
    }).then((result) => {

        let model = '';

        if (result.isConfirmed) {
            model = 'gpt-3.5-turbo';
        }else if(result.isDismissed){
            return;
        }else if (result.isDenied) {
            model = 'gpt-4';
        }

        


        Swal.fire({
            title: 'Processing...',
            text: 'Some cool stuff is being generated!',
            timerProgressBar: true,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            },
        });


        $.ajax({
            type: 'GET',
            url: '<?= admin_url("leads/proposalAIRequest/"); ?>'+id+'/'+model,
            dataType: 'json',
            success: function(response) {
                Swal.close();
                if (response.success) {

                    Swal.fire(
                        'Success!',
                        'Here is your content.',
                        'success'
                    );

                    $("#subject").val(response.subject);
                    tinymce.get('body').setContent(response.body);
                    
                    initEmailMessage("Send Proposal", "proposal", id);

                } else {
                    Swal.fire(
                        'Error!',
                        'Some error!',
                        'error'
                    );
                }
            },
            error: function() {
                alert('An error occurred while processing the request.');
            }
        });

    });
}

function proposalChangeStatus(id){
    $.ajax({
        type: 'GET',
        url: '<?= admin_url("leads/send_proposal_status/"); ?>'+id,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(response) {
            Swal.close();
            if (response.success) {

                $('.table-proposals-lead').DataTable().ajax.reload(null, false); 

                Swal.fire(
                'Success!',
                'Your message is sent!',
                'success'
                );

            } else {
                Swal.fire(
                    'Error!',
                    'Some error!',
                    'error'
                );
            }
        },
        error: function() {
            Swal.close();
            Swal.fire(
                'Error!',
                'Some error!',
                'error'
            );
        }
    });
}

$('.table-proposals-lead').on('draw.dt', function() {
    addSendButtonIfNotSent();
});

function addSendButtonIfNotSent() {
    // Loop through each row in the table body
    $('.table-proposals-lead tbody tr').each(function() {
        // Get the status for the current row
        var status = $(this).find('td:last').text().trim();
        // Check if the status is NOT "Sent"
        if (status !== 'Sent') {
            // Only add the "Send" button if it doesn't already exist
            var rowOptionsDiv = $(this).find('.row-options');
            if (rowOptionsDiv.find('.send-proposal').length === 0) {
                // Append "Send" button/link to the row-options div for that row
                var sendButton = ' | <a href="#" class="send-proposal">Send</a>';
                rowOptionsDiv.append(sendButton);
                // Optional: Add an event listener for the send button
                // (Make sure to adjust the logic inside the function to handle the sending action)
                $(this).find('.send-proposal').click(function(e) {
                    e.preventDefault();
                    
                    var proposalLink = $(this).closest('tr').find('td:first a').attr('href');
                    var proposalId = proposalLink.split('/').pop(); // Assuming ID is the last segment in the URL

                    
                    initProposalSend(proposalId);
                });
            }
        }
    });
}


function nth(d) {
  if(d>3 && d<21) return 'th'; 
  switch (d % 10) {
        case 1:  return "st";
        case 2:  return "nd";
        case 3:  return "rd";
        default: return "th";
    }
}

tinymce.init({
  selector: '#body',
  height : "300"
});

$(document).ready(function() {
    $('#form-reminder-lead').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting via the browser.

        const formData = new FormData(this);
        formData.append(csrfData.token_name, csrfData.hash);

        $.ajax({
            type: "POST",
            url: "<?= admin_url("misc/add_reminder/".$lead->id."/lead"); ?>",
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                if(response.alert_type == "success"){
                    
                    $('.table-reminders-leads').DataTable().ajax.reload(null, false); 
                    alert_float('success', 'Reminder set successfully!'); 
                }
            },
            error: function(xhr, status, error) {
                // Handle error here. Maybe the server responded with a status other than 200 or there was a network error.
                alert('There was an error setting the reminder.');
            }
        });
    });

    $('#lead-notes').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting via the browser.

        const formData = new FormData(this);
        formData.append(csrfData.token_name, csrfData.hash);

        $.ajax({
            type: "POST",
            url: "<?= admin_url("leads/add_note/".$lead->id); ?>",
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {
                // Handle error here. Maybe the server responded with a status other than 200 or there was a network error.
                alert('There was an error setting the reminder.');
            }
        });
    });

});



</script>



<script>
    function openEventModal(){
        $("#createEventModal").modal('show');
    };
    function closeEventModal() {
        $("#createEventModal").modal('hide');
    }

    $("#event_form").submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: "<?php echo admin_url("leads/event_create") ?>",
        type: "POST",
        data: $(this).serialize(),
        success: function(response) {
            var jsonResponse = JSON.parse(response);  // Parse the JSON response
            if(jsonResponse.status === "success") {
                closeEventModal(); // Close the modal
                initEventSend(jsonResponse.id);
            } else {
                alert(jsonResponse.message); // Show the error message
            }
        }
    });
    });
    $("#contracts_table").DataTable({
        initComplete: function() {
        $('#contracts_table_wrapper').removeClass('table-loading');
    }
    });


</script>


</body>
</html>
