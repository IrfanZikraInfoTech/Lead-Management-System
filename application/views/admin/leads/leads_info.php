
<style>
    .text-scroll::-webkit-scrollbar {
  display: none;
}

.text-scroll{
  -ms-overflow-style: none; /* IE and Edge */
  scrollbar-width: none; /* Firefox */
}

</style>

<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>

<div id="wrapper" class="bg-gray-100">
    <div class="content mx-auto py-0.5 pt-8">

        <div class="relative w-full">

            <div class="w-full rounded-t-2xl shadow-lg z-10 text-white font-semibold bg-cyan-600 lms-contrast ">
                <div class="pb-16">
                <div class="text-xl sm:text-xl md:text-2xl font-bold px-8 pt-8"><?php echo $lead->name; ?></div>
                <div class="text-xl sm:text-xl md:text-2xl font-bold px-8 pt-4"><?php echo $lead->status_name; ?></div>

                        <div class="text-sm sm:text-md flex mt-6 pl-5 mx-3">
                            <div><?php echo $lead->email ? $lead->email : '<i class="cursor-pointer fas fa-envelope" title="No Email Available"></i>'; ?></div>
                            <div class="mx-2">|</div>
                            <div><?php echo $lead->phonenumber ? $lead->phonenumber : '<i class="cursor-pointer fas fa-phone" title="No Phone number Available"></i>'; ?></div>
                            <div class="mx-2">|</div>
                            <div><?php echo ($lead->city && $lead->country) ? ($lead->city . ', ' . $lead->country) : '<i class="cursor-pointer fas fa-map-marker-alt" title="No city/Country Available"></i>'; ?></div>
                        </div>

                    </div>
                    <!-- Buttons at the top-right -->
                    <div class="absolute top-4 sm:top-8 md:top-8 right-4 sm:right-8 flex flex-col space-y-2 sm:space-y-4">
                        <button onclick="window.history.back();" title="Manage leads" class="cursor-pointer bg-white text-info w-8 h-8 sm:w-10 sm:h-10 md:w-10 md:h-10 flex items-center justify-center rounded-full">                            
                        <!-- <a href="<?php  admin_url('leads/list'); ?>"> -->
                            <i class="fas fa-chevron-left"></i>
                        <!-- </a> -->
                        </button>
                        <button title="Edit Leads"  class="cursor-pointer bg-white text-info w-8 h-8 sm:w-10 sm:h-10 md:w-10 md:h-10 flex items-center justify-center rounded-full">
                               <a href="" onclick="init_lead(<?= $lead->id ?>, true);return false;"><i class="fas fa-pen" ></i></a> 
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
                            
                            <?php
                                if (isset($territories) && !empty($territories[0]['data'])) {
                                    $decoded_data = json_decode($territories[0]['data'], true);

                                    if ($decoded_data === null) {
                                        echo "JSON decoding failed";
                                        return;
                                    }

                                    if (!empty($decoded_data)) {
                                        if (isset($decoded_data['stats'])) {
                                            $stats_data = $decoded_data['stats'];
                                ?>
                                <div class="flex justify-between text-lg text-gray-700 mb-3">
                                    <span class="font-semibold">Territory</span>
                                </div>
                                <div >
                                    <table class="w-full bg-gray-100 rounded-md overflow-hidden">
                                        <thead>
                                            <tr>
                                                <th class="py-2 border-b text-left text-gray-900" style="font-size: larger; font-weight: bold;">Name</th>
                                                <th class="py-2 px-3 border-b text-right text-gray-900" style="font-size: larger; font-weight: bold;">Estimate</th>
                                            </tr>
                                        </thead>
                                        <tbody id="stats-table-body" class="divide-y divide-gray-200">
                                            <?php
                                            foreach ($stats_data as $key => $value) {
                                                echo '<tr>';
                                                echo '<td class="py-2">' . $key . '</td>';
                                                echo '<td class="py-2 px-3 text-right">' . $value . '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                    <?php
                                    }
                                }
                                }
                                else {
                                ?>
                                    <div class="flex justify-between text-lg text-gray-700 mb-3">
                                        <span class="font-semibold">Territory:</span>
                                        <span class="cursor-pointer"><?= $lead->description ?: '<i class="fas fa-map-marked-alt" title="No Territory Available"></i>'; ?></span>
                                    </div>
                                    <?php
                                }
                            ?>

                    </div>
                </div>
            
 
                <!-- SECOND OVERLAPPING DIV -->
                <div class="w-full lg:w-2/3 p-10 ">
                    
                    <!-- Lead Life Cycle button-->
                    <div class="shadow-xl p-2 mb-5 border-2 border-solid border-gray-200 rounded-xl">
                        <div class="flex flex-row rounded-xl overflow-x-auto no-scrollbar dragscroll gap-2">
                            <?php 
                            $currentStepFromDB = $lead->lifecycle_stage;
                            $stepNumber = 0;

                            if ($lifecycle) {
                                $cycleFlowData = json_decode($lifecycle['flow'], true);
                                foreach($cycleFlowData as $flowItem):
                                if (isset($flowItem['name'])) {
                                    $class = ($stepNumber < $currentStepFromDB) ? 'completed-step' : '';
                                    echo '<button onclick="move_lifecycle('.$stepNumber.');" class="my-3 bg-gray-200 px-4 py-2 rounded-full border hover:border-gray-300 transition-all duration-300 ease-in-out shadow-md hover:shadow-xl ' . $class . '" id="step-' . $stepNumber . '">';
                                    echo '<div class="text-gray-900 my-1 whitespace-nowrap text-scroll overflow-x-auto  no-scrollbar dragscroll w-24">' . htmlspecialchars($flowItem['name']) . '</div>';
                                    echo '</button>';
                                    $stepNumber++;

                                    if($stepNumber < count($cycleFlowData)){
                                    echo '<div class="text-2xl flex items-center">➡️</div>';
                                    }
                                }
                                endforeach;
                            } else {
                                echo '<h2 class="text-lg text-center p-2 w-full">Lifecycle not defined!</h2>';
                            }
                            ?>
                        </div>
                    </div>

                    

                    <div class="rounded-xl pt-4 border-2 border-solid border-gray-200">

                        <ul class="dragscroll tab-container flex flex-nowrap space-x-2overflow-x-auto overflow-y-hidden pb-[6px] px-5 no-scrollbar bg-white rounded-t-xl shadow-xl" id="leadTab" role="tablis">
                                
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
                                                        <div class="pb-3 bg-gray-100 text-black max-w-lg rounded-tr-3xl rounded-tl-3xl rounded-br-3xl">
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
                                                        <div class="pb-3 bg-gray-800 text-white max-w-lg rounded-tr-3xl rounded-tl-3xl rounded-bl-3xl">
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
                                                    <td><?php echo '<a href="' . admin_url('contracts/contract/' . $contract['id']) . '"' . ($contract['project_id'] ? ' target="_blank"' : '') . '>' . $contract['subject'] . '</a>'; ?></td>
                                                    <td><?php echo $contract['client_name'] ? $contract['client_name'] : $contract['lead_name']; ?></td>
                                                    <td><?php echo $contract['contract_type']; ?></td>
                                                    <td><?php echo $contract['contract_value']; ?></td>
                                                    <td><?php echo $contract['datestart']; ?></td>
                                                    <td><?php echo $contract['dateend']; ?></td>
                                                    <td><?php echo '<a href="' . admin_url('projects/view/' . $contract['project_id']) . '">' . $contract['project_id'] . '</a>'; ?></td>
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
                                    class="btn btn-primary mbot25 "><?php echo 'New Invoice'; ?></a>
                                <?php } ?>
                                <div class="bg-white">
                                    <table id="table_invoices" class="table no-scrollbar">
                                        <thead class="bg-gray-200">
                                            <tr>
                                                <th>#</th>
                                                <th>Amount</th>
                                                <th>Total Tax</th>
                                                <th>Date</th>
                                                <th>Proposal</th>
                                                <th>Project</th>
                                                <th>Due Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-600">
                                        <?php foreach ($invoices as $invoice) : ?>
                                            <tr>
                                                <td><?php echo '<a href="' . admin_url('invoices/list_invoices/' . $invoice['id']) . '" target="_blank">' . format_invoice_number($invoice['id']) . '</a>'; ?></td>
                                                <td><?php echo $invoice['total']; ?></td>
                                                <td><?php echo $invoice['total_tax']; ?></td>
                                                <td><?php echo $invoice['date']; ?></td>
                                                <td><?php echo $invoice['proposal_subject']; ?></td>
                                                <td><?php echo $invoice['project_name']; ?></td>
                                                <td><?php echo $invoice['duedate']; ?></td>
                                                <td><?php echo $invoice['status']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
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

                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                        <?php
                                        foreach($tblevents as $tblevent): ?>
                                            <!-- Class 'event-card' added and data attributes for event details -->
                                            <div class="event-card transition-transform transform bg-white hover:scale-105 cursor-pointer border p-4 rounded shadow hover:shadow-lg"
                                                data-event-name="<?php echo $tblevent['event_name']; ?>"
                                                data-description="<?php echo $tblevent['description']; ?>"
                                                data-meet-schedule-link="<?php echo $tblevent['meet_schedule_link']; ?>"
                                                data-link="<?php echo $tblevent['link']; ?>"
                                                data-datetime="<?php echo $tblevent['datetime']; ?>"
                                                data-status="<?php echo $tblevent['status']; ?>"
                                                data-id="<?php echo $tblevent['id']; ?>">
                                                <h3 class="text-xl font-bold mb-2"><?php echo $tblevent['event_name']; ?></h3>
                                                <p class="mb-2 text-gray-700"><?php echo $tblevent['description']; ?></p>
                                                <a href="<?php echo $tblevent['meet_schedule_link']; ?>" target="_blank" class="text-blue-500 hover:text-blue-600 underline">Meet Schedule Link</a>
                                                <div class="text-sm text-gray-500">
                                                    <?php
                                                    switch ($tblevent['status']) {
                                                        case 0:
                                                            echo 'Waiting to Send';
                                                            break;
                                                        case 1:
                                                            echo 'Sent';
                                                            break;
                                                        case 2:
                                                            echo 'Scheduled';
                                                            break;
                                                        case 3:
                                                            echo 'Complete';
                                                            break;
                                                    }
                                                    ?>
                                                </div>
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
    <div class="modal-dialog">
        <div class="modal-content rounded-lg shadow-lg">
            <form id="event_form">
                <div class="modal-header bg-gray-100 border-b">
                    <h5 class="modal-title text-lg font-semibold" id="createEventModalLabel">Create New Event</h5>
                </div>
                <div class="modal-body p-4 flex flex-col gap-4">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                    <input type="hidden" name="rel_id" value="<?= $lead->id; ?>">
                    <input type="text" name="event_name" id="event_name" placeholder="Event Name" class="w-full p-2 border rounded-md focus:border-blue-500 focus:ring-1 focus:ring-blue-500 mt-2">
                    <textarea name="description" id="event_description" placeholder="Event Description" class="w-full p-2 border rounded-md focus:border-blue-500 focus:ring-1 focus:ring-blue-500 mt-2"></textarea>
                    <input type="text" name="meet_schedule_link" id="meet_link" placeholder="Meet Schedule Link" class="w-full p-2 border rounded-md focus:border-blue-500 focus:ring-1 focus:ring-blue-500 mt-2">
                </div>
                <div class="modal-footer bg-gray-100 border-t p-3 flex justify-end space-x-4">
                    <button type="button" class="btn btn-secondary px-4 py-2 rounded-md text-gray-500 border border-gray-300" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-md text-white">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="eventDetailModal" tabindex="-1" aria-labelledby="eventDetailModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-lg shadow-lg">
            <div class="modal-header bg-gray-100 border-b">
                <h5 class="modal-title text-lg font-semibold" id="eventDetailModal">Event Details</h5>
            </div>
            <div class="modal-body p-4 flex flex-col gap-4">
                <p class="mb-2"><strong>Event Name:</strong> <span id="modal_event_name" class="text-gray-700"></span></p>
                <p class="mb-2"><strong>Description:</strong> <span id="modal_description" class="text-gray-700"></span></p>
                <p class="mb-2"><strong>Meet Schedule Link:</strong> <a id="modal_meet_schedule_link" target="_blank" class="text-primary hover:text-primary-dark underline"></a></p>
                <p class="mb-2 date-time-field"><strong>Date and Time:</strong> <span id="modal_date_time" class="text-gray-700"></span></p>
                <p class="mb-2 meeting-actual-link-field"><strong>Meeting Actual Link:</strong> <a id="modal_meeting_actual_link" target="_blank" class="text-primary hover:text-primary-dark underline"></a></p>
            </div>
            <div class="modal-footer bg-gray-100 border-t p-3 flex justify-end space-x-4">
                <button type="button" class="btn btn-secondary px-4 py-2 rounded-md text-black" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content rounded-lg shadow-lg">
      <form id="schedule_form" class="space-y-4">
        <div class="modal-header bg-gray-100 border-b">
          <h5 class="modal-title text-lg font-semibold" id="scheduleModalLabel">Schedule Meeting</h5>
        </div>
        <div class="modal-body p-4 flex flex-col gap-4" >
          <input type="hidden" id="event_id" name="event_id" value="">
          <div class="flex flex-col">
            <label for="datetime" class="text-sm font-medium text-gray-600">Date and Time:</label>
            <input type="datetime-local" id="meeting_datetime" name="datetime" class="p-2 border rounded-md focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
          </div>
          <div class="flex flex-col">
            <label for="link" class="text-sm font-medium text-gray-600">Meeting Link:</label>
            <input type="text" id="meeting_link" name="link" class="p-2 border rounded-md focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
          </div>
        </div>
        <div class="modal-footer bg-gray-100 border-t p-3 flex justify-end space-x-4">
          <button type="button" class="btn btn-secondary px-4 py-2 rounded-md text-gray-500 border border-gray-300" onclick="closeScheduleModal();" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-primary px-4 py-2 rounded-md text-white bg-blue-500 border border-blue-500 hover:bg-blue-600" type="submit">Save</button>
        </div>
      </form>
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
                        <input type="hidden" name="event_id" id="event_id" value="">
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
    $(document).ready(function() {
        $('.event-card').click(function() {
            var eventName = $(this).attr('data-event-name');
            var description = $(this).attr('data-description');
            var meetScheduleLink = $(this).attr('data-meet-schedule-link');
            var link = $(this).attr('data-link');
            var dateTime = $(this).attr('data-datetime');

            $('#modal_event_name').text(eventName);
            $('#modal_description').text(description);
            $('#modal_meet_schedule_link').attr('href', meetScheduleLink).text(meetScheduleLink);
            $('#modal_date_time').text(dateTime);
            // Yahan par aapko apni zaroorat ke hisab se aur fields ko set karna hoga.

            $('#eventDetailModal').modal('show');
        });
    });

    function openEventModal() {
        $("#createEventModal").modal('show');
    }

    function updateStatus(eventId) {
        $.ajax({
            url: "<?php echo admin_url('leads/update_event_status') ?>",
            type: 'POST',
            data: { event_id: eventId },
            success: function(response) {
                // Handling success response
                Swal.fire(
                    'Success!',
                    'Met success...',
                    'success'
                );
                closeEventModal();
                closeScheduleModal();
            },
            error: function(error) {
                // Handling error response
                alert('Error updating status.');
            }
        });
    }

    function closeEventModal() {
        $('#eventDetailModal').modal('hide');
        $("#createEventModal").modal('hide');
    }

    function closeScheduleModal() {
        $("#scheduleModal").modal('hide');
    }

    // Function to handle grid item click
    function onGridItemClick() {
        var eventId = $(this).data('id'); // Get the event ID
        var eventName = $(this).data('event-name');
        var datetime = $(this).data('datetime');
        var actualLink = $(this).data('link');
        var description = $(this).data('description');
        var meetScheduleLink = $(this).data('meet-schedule-link');
        showEventDetails(eventName, description, meetScheduleLink, actualLink, datetime, this);
    }
    // Function to handle event form submission
    function onEventFormSubmit(e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo admin_url('leads/event_create') ?>",
            type: "POST",
            data: $(this).serialize(),
            success: function (response) {
                var jsonResponse = JSON.parse(response);
                var name = $("#event_name").val();
                var description = $("#event_description").val();
                var link = $("#meet_link").val();
                var date = $("#meeting_datetime").val();
                var actualLink = $("#meeting_link").val();
                if (jsonResponse.status === "success") {
                    closeEventModal();
                    initEventSend(jsonResponse.id);

                    // Construct the new event element
                    var newEvent = `<div class="event-card transition-transform transform bg-white hover:scale-105 cursor-pointer border p-4 rounded shadow hover:shadow-lg"
                                    data-event-name="${name}"
                                    data-description="${description}"
                                    data-meet-schedule-link="${link}"
                                    data-link="${actualLink}"
                                    data-datetime="${date}"
                                    data-status="0"
                                    data-id="${jsonResponse.id}">
                                    <h3 class="text-xl font-bold mb-2">${name}</h3>
                                    <p class="mb-2 text-gray-700">${description}</p>
                                    <a href="${link}" target="_blank" class="text-blue-500 hover:text-blue-600 underline">Meet Schedule Link</a>
                                    <div class="text-sm text-gray-500">Waiting to Send</div>
                                </div>`;

                    $("#eventsContent .grid").append(newEvent);

                } else {
                    alert(jsonResponse.message);
                }

            }
        });
    }

    $(document).ready(function() {
        if (location.hash) {
            $('a[href="' + location.hash + '"]').tab('show');
        }
    });


    $(function () {
        $("#eventsContent .grid").on('click', '.transition-transform', onGridItemClick);
        $("#event_form").submit(onEventFormSubmit);
    });

    function openScheduleModal(eventId) {
        // console.log("Setting event ID:", eventId); // Debugging line
        $('#event_id').val(eventId);
        $('#scheduleModal').modal('show');
        closeEventModal();
    }

    function saveSchedule(e) {
        e.preventDefault();

        let eventId = $("#event_id").val();

        var formData = {
            eventId: eventId,
            datetime: $("#meeting_datetime").val(),
            link: $("#meeting_link").val()
        };

        $.post("<?php echo admin_url('leads/save_schedule') ?>", formData, function(response) {
            var jsonResponse = JSON.parse(response);
            if (jsonResponse.status === "success") {
                Swal.fire(
                    'Success!',
                    'Met success...',
                    'success'
                );
                closeEventModal();
                var myEventId = eventId; // Assuming myEventId is the value of the #event_id field
                var eventCard = $(`.event-card[data-id='${myEventId}']`);
                eventCard.data("status", 2);
                eventCard.data("datetime", formData.datetime);
                eventCard.data("link", formData.link);
                refreshEventCard(myEventId);
                $('#scheduleModal').modal('hide');
            } else {
                alert(jsonResponse.message);
            }
        });
    }

    
    function formatEventStatusText(status){
        if(status == 0){
            return 'Waiting to be sent';
        }else if(status == 1){
            return 'Sent';
        }else if(status == 2){
            return 'Scheduled';
        }else if(status == 3){
            return 'Completed';
        }
    }


    function showEventDetails(eventName, description, meetScheduleLink,actuallink,datetime, element) {
        // Fill in the details in the modal
        document.getElementById('modal_event_name').textContent = eventName;
        document.getElementById('modal_description').textContent = description;
        document.getElementById('modal_date_time').textContent = datetime;
        document.getElementById('modal_meeting_actual_link').textContent = actuallink;
        document.getElementById('modal_meet_schedule_link').textContent = meetScheduleLink;
        document.getElementById('modal_meet_schedule_link').href = meetScheduleLink;
        var status = $(element).data('status');
        var id = $(element).data('id');

        // Remove any existing status buttons
        $('#eventDetailModal').find('.modal-footer button:not(.btn-secondary)').remove();

        // Create and append the new button based on status
        var buttonHtml = '';
        if (status == 0) {
            buttonHtml = '<button class="btn btn-info" onclick="closeEventModal();initEventSend(' + id + ')">Send</button>';
        } else if (status == 1) {
            buttonHtml = '<button class="btn btn-success" onclick="openScheduleModal('+ id +')">Schedule</button>';
        } else if (status == 2) {
            buttonHtml = '<button class="btn btn-primary" onclick="updateStatus('+ id +')">Complete</button>';
        }
        $('#eventDetailModal').find('.modal-footer').append(buttonHtml);

        $('#eventDetailModal').modal('show');
    }


    function refreshEventCard(eventId) {
        // Selecting the event card based on the data-id attribute
        var eventCard = $(`.event-card[data-id='${eventId}']`);

        // Extracting data attributes
        var eventName = eventCard.data('event-name');
        var description = eventCard.data('description');
        var meetScheduleLink = eventCard.data('meet-schedule-link');
        var link = eventCard.data('link');
        var datetime = eventCard.data('datetime');
        var status = eventCard.data('status');

        // Status text based on the status value
        var statusText = formatEventStatusText(status);

        // Constructing the updated HTML content
        var updatedContent = `
            <h3 class="text-xl font-bold mb-2">${eventName}</h3>
            <p class="mb-2 text-gray-700">${description}</p>
            <a href="${meetScheduleLink}" target="_blank" class="text-blue-500 hover:text-blue-600 underline">Meet Schedule Link</a>
            <div class="text-sm text-gray-500">${statusText}</div>
        `;

        // Replacing the HTML content of the selected event card
        eventCard.html(updatedContent);
    }


    $("#schedule_form").submit(saveSchedule);

</script>


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
    // alert(currentStep);
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

    #contracts_table_wrapper .row .col-sm-12::-webkit-scrollbar  {
        height: 4px; /* You can adjust the height as per your need */
        background: #f0f0f0; /* Light background color for the scrollbar */
    }
    #table_invoices_wrapper .row .col-sm-12::-webkit-scrollbar  {
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
            } else{
                Swal.fire(
                    'Error!',
                    response.message,
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

                    if(!$("#conversation-flow div").html().includes("No Messages")){
                        $("#conversation-flow").prepend(`
                            <div class="flex flex-col items-end justify-end mb-2 text-base">
                                <div class="pb-3 bg-[#172A3A] text-white max-w-lg rounded-tr-3xl rounded-tl-3xl rounded-bl-3xl">
                                    <div class="mb-2 bg-gray-100 rounded-t-3xl px-3 py-2 text-[#172A3A] font-bold">` + $("#subject").val() + `</div>
                                    <div class="mb-2 px-3">` + bodyContent + `</div>
                                    <span class="px-3 float-right text-sm">` + dateStr + `</span>
                                </div>
                            </div>
                        `);

                    }else{
                        $("#conversation-flow").html(`
                            <div class="flex flex-col items-end justify-end mb-2 text-base">
                                <div class="pb-3 bg-[#172A3A] text-white max-w-lg rounded-tr-3xl rounded-tl-3xl rounded-bl-3xl">
                                    <div class="mb-2 bg-gray-100 rounded-t-3xl px-3 py-2 text-[#172A3A] font-bold">` + $("#subject").val() + `</div>
                                    <div class="mb-2 px-3">` + bodyContent + `</div>
                                    <span class="px-3 float-right text-sm">` + dateStr + `</span>
                                </div>
                            </div>
                        `);
                    }

                    tinymce.get('body').setContent("");
                    $("#subject").val("");

                    let type = $("#composeModal").data("rel-type");

                    if(type == "compose"){
                        Swal.close();
                        Swal.fire(
                        'Success!',
                        'Your message is sent!',
                        'success'
                        );
                    }
                    if(type == "proposal"){
                        let id_joined = $("#composeModal").data("rel-id");
                        let ids = id_joined.split(",");
                        proposalChangeStatus(ids[0], ids[1]);
                    }
                    if(type=="event"){

                        let myEventId = $("#composeModal").data("rel-id");
                        
                        Swal.close();
                        $.post("<?php echo admin_url('leads/updateStatus'); ?>/" + myEventId, function(response) {
                            
                            var jsonResponse = JSON.parse(response);
                                if (jsonResponse.success) {
                                    Swal.fire(
                                        'Success!',
                                        'Met success...',
                                        'success'
                                    );
                                    closeEventModal();
                                    $(`.event-card[data-id='${myEventId}']`).data("status", 1);
                                    refreshEventCard(myEventId);
                                } else {
                                    alert("An error occurred while updating the status.");
                                }

                        });
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

    var isInvoiced = false;

    $.ajax({
        type: 'GET',
        url: '<?= admin_url("proposals/check_proposal_invoiced/");?>'+id,
        dataType: 'json',
        success: function(response) {
            if (response.success && response.check) {
                isInvoiced = true;
            }else{
                isInvoiced = false;
            }

            if (!isInvoiced) {
                Swal.fire({
                    title: 'No Invoice for this proposal',
                    showDenyButton: true,
                    confirmButtonColor: '#29b952',
                    text: "Still Continue?",
                    confirmButtonText: 'Continue',
                    denyButtonText: 'Invoice',
                    denyButtonColor: '#6e7881',
                }).then((result) => {
                    console.log (result);
                    if (result.isConfirmed) {
                        proceedToContracts(id); 
                    }else if(result.isDenied){
                        window.location.href = '<?= admin_url("proposals/list_proposals/") ?>#'+id;
                    }
                });
            } else {
                proceedToContracts(id);
            }
        },
        error: function() {
            alert('An error occurred while processing the request.');
        }
    });

    
}

function proceedToContracts(id) {
    let contractsHtml = '<div class="flex flex-col gap-2">';
    <?php if (count($contracts) > 0) : ?>
        <?php foreach ($contracts as $contract) : ?>
            contractsHtml += '<button onclick="initProposalModelSelection(' + id + ',<?= $contract['id'] ?>)" class="rounded-xl px-4 py-2 bg-gray-200 hover:bg-gray-300 transition-all"><?php echo $contract["subject"]; ?></button>';
        <?php endforeach; ?>
    <?php else: ?>
        contractsHtml += '<div>Please create a <a class="inline" href="<?php echo admin_url('contracts/contract/?rel_type=lead&rel_id=' . $lead->id); ?>">contract</a>, or continue without selecting one!</div>';
    <?php endif; ?>

    contractsHtml += '</div>';

    Swal.fire({
        title: 'Choose a contract',
        html: contractsHtml,
        showCancelButton: true,
        confirmButtonColor: '#29b952',
        confirmButtonText: 'Continue without Contract',
        cancelButtonText: 'Cancel',
    }).then((result) => {
        if (result.isConfirmed) {
            initProposalModelSelection(id);
        }
    });
}


function initProposalModelSelection(id, contract = null){

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

                    let id_joined = id + ',' + (contract !== null ? contract : '');
                    initEmailMessage("Send Proposal", "proposal", id_joined);

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

function proposalChangeStatus(id, contract = null){

    let url = '<?= admin_url("leads/send_proposal_status/"); ?>'+id;
    if (contract !== null) {
        url += '/' + contract;
    }

    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(response) {
            Swal.close();
            if (response.success) {
                
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
        if (status !== 'Sent' && status !== 'Accepted') {
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
    $("#contracts_table").DataTable({
        initComplete: function() {
        $('#contracts_table_wrapper').removeClass('table-loading');
    }
    });


</script>


</body>
</html>
