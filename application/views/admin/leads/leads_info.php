<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>

<div id="wrapper" class="bg-gray-100 p-10">
    <div class="content mx-auto">

      <div class="relative w-full">
        <div style="background-color:#00B4D8;" class="w-full h-[250px]  rounded-[20px] shadow-lg z-10 text-white text-semibold" >
            <div class="m-7">
                <div class="text-xl sm:text-xl md:text-2xl font-bold px-8 pt-8">John Joe</div>
                    <div class="text-lg sm:text-lg md:text-xl font-bold flex pt-5">
                        <span class="text-base sm:text-lg md:text-lg pl-8">Status:</span>
                            <div class="bg-white value ml-3">
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
                            </a></button>
                        <button class="bg-white text-info sm:w-10 sm:h-10 md:w-10 md:h-10 flex items-center justify-center rounded-full"> 
                            <a onclick="init_lead(1, true);return false;" class="cursor-pointer" data-tooltip="Edit Leads">
                                <i class="fas fa-pen"></i> 
                            </a></button>
                    </div>
                </div>

            <div class=" lg:flex relative bg-white shadow-lg rounded-[20px] -mt-8">
                   
<!-- First overlapping div -->
                <div class=" lg:w-1/3 p-4"> 
                <div class="text-md sm:text-md md:text-xl px-3 pt-2 font-semibold text-gray-800">More Information:</div>
                    <div class="info-section my-5 py-8 space-y-3 ">
                        <div class="flex justify-between text-lg text-gray-700 mb-3">
                            <span class="font-semibold">Email:</span>
                            <span class="value1" style="cursor:pointer;"><?= $lead->email ?: '<i class="fas fa-envelope" title="No Email Available"></i>'; ?></span>
                        </div>

                        <div class="flex justify-between text-lg text-gray-700 mb-3">
                            <span class="font-semibold">Phone:</span>
                            <span class="value1" style="cursor:pointer;"><?= $lead->phonenumber ?: '<i class="fas fa-phone" title="No Phone Number Available"></i>'; ?></span>
                        </div>

                        <div class="flex justify-between text-lg text-gray-700 mb-3">
                            <span class=" font-semibold">Website:</span>
                            <span class="value1" style="cursor:pointer;"><?= $lead->website ?: '<i class="fas fa-globe" title="No Website Available"></i>'; ?></span>    
                        </div>
                        <div class="flex justify-between text-lg text-gray-700 mb-3">
                            <span class="font-semibold">Company:</span>
                            <span class="value1" style="cursor:pointer;"><?= $lead->company ?: '<i class="fas fa-building" title="No Company Available"></i>'; ?></span>
                        </div>

                        <div class="flex justify-between text-lg text-gray-700 mb-3">
                            <span class="font-semibold">Position:</span>
                            <span class="value1" style="cursor:pointer;"><?= $lead->title ?: '<i class="fas fa-briefcase" title="No Position Available"></i>'; ?></span>
                        </div>

                        <div class="flex justify-between text-lg text-gray-700 mb-3">
                            <span class="font-semibold">Address:</span>
                            <span class="value1" style="cursor:pointer;"><?= $lead->address ?: '<i class="fas fa-map-marker-alt" title="No Address Available"></i>'; ?></span>
                        </div>

                        <div class="flex justify-between text-lg text-gray-700 mb-3">
                            <span class="font-semibold">City:</span>
                            <span class="value1" style="cursor:pointer;"><?= $lead->city ?: '<i class="fas fa-city" title="No City Available"></i>'; ?></span>
                        </div>

                        <div class="flex justify-between text-lg text-gray-700 mb-3">
                            <span class="font-semibold">State:</span>
                            <span class="value1" style="cursor:pointer;"><?= $lead->state ?: '<i class="fas fa-flag" title="No State Available"></i>'; ?></span>
                        </div>

                        <div class="flex justify-between text-lg text-gray-700 mb-3">
                            <span class="font-semibold">Country:</span>
                            <span class="value1" style="cursor:pointer;"><?= $lead->country ?: '<i class="fas fa-globe-americas" title="No Country Available"></i>'; ?></span>
                        </div>

                        <div class="flex justify-between text-lg text-gray-700 mb-3">
                            <span class="font-semibold">Zip Code:</span>
                            <span class="value1" style="cursor:pointer;"><?= $lead->zip ?: '<i class="fas fa-map-pin" title="No Zip Code Available"></i>'; ?></span>
                        </div>

                        <div class="flex justify-between text-lg text-gray-700 mb-3">
                            <span class="font-semibold">Description:</span>
                            <span class="value1" style="cursor:pointer;"><?= $lead->description ?: '<i class="fas fa-align-left" title="No Description Available"></i>'; ?></span>
                        </div>
                    </div>
                </div>

<!-- SECOND OVERLAPPING DIV -->
<div class="w-full lg:w-2/3 p-0">
            <!-- Lead Life Cycle -->
            <div>
                <div class="text-md sm:text-md md:text-xl my-4 px-3 pt-2 font-semibold text-gray-800">
                    <p >Lead Life Cycle</p>
                </div>
                <div class="lead-lifecycle-chart tab-content customcontent p-5 mt-3 rounded-xl shadow-lg mx-5" >
                    <?php 
                        $currentStepFromDB = $lead->lifecycle_stage;
                        $stepNumber = 0;
                        foreach ($steps as $step):
                            $flowData = json_decode($step['flow'], true);
                            if ($flowData) {
                                foreach($flowData as $flowItem):
                                    if (isset($flowItem['name'])) {
                                        $class = ($stepNumber < $currentStepFromDB) ? 'completed-step' : '';
                                        echo '<div class="step shadow-lg hover:shadow-xl p-2 m-2 transition-all duration-300 ease-in-out  rounded-xl border border-transparent hover:border-gray-300 ' . $class . '" id="step-' . $stepNumber . '">';
                                        echo '<p class="text-gray-900 my-1">' . htmlspecialchars($flowItem['name']) . '</p>';
                                        echo '</div>';
                                        $stepNumber++;
                                    }
                                endforeach;
                            }
                        endforeach;
                    ?>
                </div>
                <div>
                    <button class="btn btn-primary mt-2 ml-5 move-btn" id="move-btn">Move</button>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6">
                <div class="scrolling-navbar overflow-x-auto whitespace-nowrap  ">
                    <ul class="tab-container flex flex-nowrap space-x-2 " id="leadTab" role="tablist">
                         <li class="tab-item">
                            <a class="text-lg text-gray-700 hover:text-gray-900 font-medium py-2 px-3 rounded transition duration-200 hover:bg-gray-200" id="activity-tab" data-toggle="tab" href="#activity" role="tab" aria-controls="activity" aria-selected="true">Activity</a>
                        </li>
                        <li class="tab-item">
                          <a class="text-xl text-gray-800 font-medium  py-2 px-2 " id="proposals-tab" data-toggle="tab" href="#proposals" role="tab" aria-controls="proposals" aria-selected="false" onclick="initDataTable('.table-proposals-lead', admin_url + 'proposals/proposal_relations/' + <?php echo $lead->id; ?> + '/lead','undefined', 'undefined','undefined',[6,'desc']);">Proposals</a>
                        </li>
                        <li class="tab-item">
                            <a class="text-xl text-gray-800 font-medium  py-2 px-2 " id="Contracts-tab" data-toggle="tab" href="#Contracts" role="tab" aria-controls="Contracts" aria-selected="false">Contracts</a>
                        </li>
                        <li class="tab-item">
                            <a class="text-xl text-gray-800 font-medium  py-2 px-2 " id="invoices-tab" data-toggle="tab" href="#invoices" role="tab" aria-controls="invoices" aria-selected="false">Invoices</a>
                        </li>
                        <li class="tab-item">
                            <a class="text-xl text-gray-800 font-medium  py-2 px-2 " id="tasks-tab" data-toggle="tab" href="#tasks" role="tab" aria-controls="tasks" aria-selected="false" onclick="init_rel_tasks_table(<?php echo $lead->id; ?>,'lead','.table-rel-tasks-leads');">Tasks</a>
                        </li>
                        <li class="tab-item">
                            <a class="text-xl text-gray-800 font-medium py-2 px-2 " id="attachments-tab" data-toggle="tab" href="#attachments" role="tab" aria-controls="attachments" aria-selected="false">Attachments</a>
                        </li>
                        <li class="tab-item">
                            <a class="text-xl text-gray-800 font-medium py-2 px-2 " id="reminders-tab" data-toggle="tab" href="#reminders" role="tab" aria-controls="reminders" aria-selected="false" onclick="initDataTable('.table-reminders-leads', admin_url + 'misc/get_reminders/' + <?php echo $lead->id; ?> + '/' + 'lead', undefined, undefined,undefined,[1, 'asc']);">Reminders</a>
                        </li>
                        <li class="tab-item">
                            <a class="text-xl text-gray-800 font-medium py-2 px-2" id="notes-tab" data-toggle="tab" href="#notes" role="tab" aria-controls="notes" aria-selected="false">Notes</a>
                        </li>
                        <li class="tab-item">
                            <a class="text-xl text-gray-800 font-medium py-2 px-2 " id="communications-tab" data-toggle="tab" href="#communications" role="tab" aria-controls="communications" aria-selected="false">Communication</a>
                        </li>
                        <li class="tab-item">
                            <a class="text-xl text-gray-800 font-medium py-2 px-2" id="event-tab" data-toggle="tab" href="#event" role="tab" aria-controls="event" aria-selected="false">Events</a>
                        </li>
                    </ul>
                </div>
                
                
                <div class="tab-content customcontent p-5 mt-3 rounded-xl shadow-lg" id="leadTabContent">     
                        <div class="tab-pane fade active in text-gray-800" id="activity" role="tabpanel" aria-labelledby="activity-tab">
                            <div>
                            <div class="activity-feed">
                                        <?php foreach ($activity_log as $log) { ?>
                                    <div class="feed-item">
                                            <div class="date">
                                                <span class="text-has-action" data-toggle="tooltip"
                                                    data-title="<?php echo _dt($log['date']); ?>">
                                                    <?php echo time_ago($log['date']); ?>
                                                </span>
                                            </div>
                                            <div class="text">
                                                <?php if ($log['staffid'] != 0) { ?>
                                                <a href="<?php echo admin_url('profile/' . $log['staffid']); ?>">
                                                <?php echo staff_profile_image($log['staffid'], ['staff-profile-xs-image pull-left mright5']);
                                                ?>
                                                </a>
                                                <?php
                                                }
                                            
                                                $additional_data = '';
                                            if (!empty($log['additional_data'])) {
                                                $additional_data = unserialize($log['additional_data']);
                                                echo ($log['staffid'] == 0) ? _l($log['description'], $additional_data) : _l($log['description'], $additional_data);
                                            } 
                                            else {
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
                                        </div>
                                        <div class="col-md-12">
                                            <?php echo render_textarea('lead_activity_textarea', '', '', ['placeholder' => _l('enter_activity')], [], 'mtop15'); ?>
                                            <div class="text-right">
                                                <button id="lead_enter_activity"
                                                    class="btn btn-primary"><?php echo _l('submit'); ?></button>
                                            </div>
                                        </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                        <div class="tab-pane fade text-gray-800" role="tabpanel" id="proposals" aria-labelledby="proposals-tab">
                            <?php if (has_permission('proposals', '', 'create')) { ?>
                            <a href="<?php echo admin_url('proposals/proposal?rel_type=lead&rel_id=' . $lead->id); ?>"
                                class="btn btn-primary mbot25"><?php echo _l('new_proposal'); ?></a>
                            <?php } ?>
                            <?php if (total_rows(db_prefix() . 'proposals', ['rel_type' => 'lead', 'rel_id' => $lead->id]) > 0 && (has_permission('proposals', '', 'create') || has_permission('proposals', '', 'edit'))) { ?>
                            <a href="#" class="btn btn-primary mbot25" data-toggle="modal"
                                data-target="#sync_data_proposal_data"><?php echo _l('sync_data'); ?></a>
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
                            _l('proposal_status'), ];
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
                        <div class="tab-pane fade text-gray-800" role="tabpanel" id="Contracts" aria-labelledby="Contracts-tab" >
                            <?php if (has_permission('proposals', '', 'create')) { ?>
                            <a href="<?php echo admin_url('contracts/contract/?rel_type=lead&rel_id=' . $lead->id); ?>"
                                class="btn btn-primary mbot25"><?php echo _l('New Contract'); ?></a>
                            <?php } ?>
                            <div class="w-full mx-auto">
                                <div class="bg-white shadow-md rounded-md p-6">
                                    <table id="campaigns_table" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>
                                                    #
                                                </th>
                                                <th>
                                                    Subject
                                                </th>
                                                <th>
                                                    Relative
                                                </th>
                                                <th >
                                                    Contract Type
                                                </th>
                                                <th >
                                                    Contract Value
                                                </th>
                                                <th>
                                                    Start Date
                                                </th>
                                                <th>
                                                    End Date
                                                </th>
                                                <th>
                                                    Project
                                                </th>
                                                <th>
                                                    Signature
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($contracts as $contract): ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $contract['id']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $contract['subject']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $contract['client_name'] ? $contract['client_name'] : $contract['lead_name']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $contract['contract_type']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $contract['contract_value']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $contract['datestart']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $contract['dateend']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $contract['project_id']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $contract['signature']; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade text-gray-800" role="tabpanel" id="invoices" aria-labelledby="invoices-tab">
                            <?php if (has_permission('proposals', '', 'create')) { ?>
                            <a href="<?php echo admin_url('invoices/invoice'); ?>"
                                class="btn btn-primary mbot25"><?php echo _l('new_invoice'); ?></a>
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

                        <div class="tab-pane fade text-gray-800" id="tasks" role="tabpanel" aria-labelledby="tasks-tab">
                            <?php init_relation_tasks_table(['data-new-rel-id' => $lead->id, 'data-new-rel-type' => 'lead']); ?>
                        </div>

                        <div role="tabpanel" class="tab-pane fade text-gray-800" id="attachments" aria-labelledby="attachments-tab" role="tabpanel">
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

                        <div role="tabpanel" class="tab-pane fade text-gray-800" id="reminders" aria-labelledby="reminders-tab">
                            <a href="#" data-toggle="modal" class="mb-2 btn btn-primary"
                                data-target=".reminder-modal-lead-<?php echo $lead->id; ?>"><i class="fa-regular fa-bell"></i>
                                <?php echo _l('lead_set_reminder_title'); ?></a>
                            <hr />
                            <?php render_datatable([ _l('reminder_description'), _l('reminder_date'), _l('reminder_staff'), _l('reminder_is_notified')], 'reminders-leads'); ?>
                        </div>
                        <div role="tabpanel" class="tab-pane fade text-gray-800" id="event" aria-labelledby="event-tab">
                            <!-- Tab Content for Events -->
                            <div id="eventsContent" class="tab-pane mt-4">
                                <button id="createEventBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create New Event</button>
                                
                                <!-- Here's where we loop through the events to generate the cards -->
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-4 ">
                                    
                                    <?php foreach($tblevents as $tblevent): ?>
                                        <div class="transition-transform transform bg-white hover:scale-105 cursor-pointer border p-4 rounded shadow hover:shadow-lg">
                                            <h3 class="text-xl font-bold mb-2"><?php echo $tblevent['event_name']; ?></h3>
                                            <p class="mb-2"><?php echo $tblevent['description']; ?></p>
                                            <a href="<?php echo $tblevent['meet_schedule_link']; ?>" target="_blank" class="text-blue-500 hover:text-blue-600 underline">Meet Schedule Link</a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="notes" aria-labelledby="notes-tab">
                            <?php echo form_open(admin_url('leads/add_note/' . $lead->id), ['id' => 'lead-notes']); ?>
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
                        <div class="tab-pane" id="communications" role="tabpanel" aria-labelledby="communications-tab">
                            <div class="mb-4">
                                <h5 class="font-semibold text-lg">Compose New Message:</h5>
                            </div>
                            <div class="space-y-4">
                                <!-- To Field -->
                                <div>
                                    <!-- buttons -->
                                </div>

                                <!-- Subject Field -->
                                <div>
                                    <?php echo render_input('email-subject', '', '', 'text', ['class' => 'w-full px-4 py-2 outline-none border border-gray-300 rounded', 'placeholder' => 'Subject:'], [], '', ''); ?>
                                </div>

                                <!-- Message Field (Using PHP function) -->
                                <div class="border border-gray-300 rounded">
                                    <?php echo render_textarea('message', '', '', ['class' => 'w-full px-4 py-2 outline-none', 'placeholder' => 'Write your msg here......'], [], '', 'tinymce'); ?>
                                </div>

                                <!-- Send Message Button -->
                                <div class="text-right mt-4">
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-800">
                                        Send Message
                                    </button>
                                </div>
                            </div>
                            <hr>
                            <div class="mt-6 bg-white rounded-xl shadow-md p-4">
                <h2 class="text-2xl font-semibold mb-4 border-b pb-2">Conversation</h2>

    <!-- Conversation start -->
    <div class="space-y-4 mt-4">

        <!-- Sender Name and Message -->
        <div class="flex flex-col items-start justify-start mb-2">
            <div class="p-2 bg-blue-200 text-blue-800 max-w-xs rounded-tl rounded-tr rounded-br">
                Hi! How are you?Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam labore distinctio rerum veniam accusantium. Dolorem temporibus minus dicta ipsum reprehenderit tenetur, necessitatibus quisquam sit dolor provident animi iure deleniti natus!
            </div>
        </div>

        <!-- Receiver Name and Message -->
        <div class="flex flex-col items-end justify-end mb-2">
            <div class="p-2 bg-green-200 text-green-800 max-w-xs rounded-tr rounded-tl rounded-bl">
                I'm good, thanks! How about you?Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur quod iste, quam rem enim atque incidunt quisquam est dignissimos molestiae porro totam id, laborum error adipisci qui vitae repellat quos.you?Lorem Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia dignissimos atque iure doloremque maiores illum incidunt veniam ducimus voluptate fuga provident nostrum quod, eius similique eaque suscipit veritatis a? Aliquid.
            </div>
        </div>
    </div>
</div>
</div>
    </div>
</div>

 <!-- Create Event Modal -->
 <div id="createEventModal" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50 hidden" style="z-index:999;">
    <div class="bg-white p-8 rounded">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl">Create New Event</h2>
            <button id="closeModal" class="text-3xl text-gray-800 hover:text-gray-600" onclick="closeEventModal()">&times;</button>
        </div>
        <form id="event_form">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
            <input type="text" name="event_name" placeholder="Event Name" class="w-full p-2 border rounded mt-2">
            <textarea name="description" placeholder="Event Description" class="w-full p-2 border rounded mt-2"></textarea>
            <input type="text" name="meet_schedule_link" placeholder="Meet Schedule Link" class="w-full p-2 border rounded mt-2">
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">Save</button>
        </form>
    </div>
</div>




 <?php init_tail(); ?>
</body>
</html>
<script>
        document.getElementById("createEventBtn").addEventListener("click", function() {
        document.getElementById("createEventModal").classList.remove('hidden');
    });
    function closeEventModal() {
    document.getElementById("createEventModal").classList.add('hidden');
    }
    window.onclick = function(event) {
        if (event.target == document.getElementById("createEventModal")) {
            document.getElementById("createEventModal").classList.add('hidden');
        }
    };
    $("#event_form").submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: "<?php echo admin_url("Leads/Event_create") ?>",
        type: "POST",
        data: $(this).serialize(),
        success: function(response) {
            var jsonResponse = JSON.parse(response);  // Parse the JSON response
            if(jsonResponse.status === "success") {
                alert(jsonResponse.message); // Show the success message
                closeEventModal(); // Close the modal
            } else {
                alert(jsonResponse.message); // Show the error message
            }
        }
    });
});
$("#campaigns_table").DataTable({
    initComplete: function() {
    $('#campaigns_table_wrapper').removeClass('table-loading');
 }
 });

 let currentStep = <?php echo $lead->lifecycle_stage; ?>;

document.getElementById("move-btn").addEventListener("click", function() {
    // If current step is already at the last, do nothing
    if (currentStep >= <?= $stepNumber - 1 ?>) return;

    // Remove active class from the current step and add completed class
    document.getElementById("step-" + currentStep).classList.remove("active-step");
    document.getElementById("step-" + currentStep).classList.add("completed-step");

    // Increment current step
    currentStep++;

    // Add active class to the new current step
    document.getElementById("step-" + currentStep).classList.add("active-step");

    // AJAX request to save the current step to the database
    $.ajax({
        url: '<?= admin_url('leads/save_current_step'); ?>',
        type: 'POST',
        data: { step: currentStep, lead_id: '<?= $lead->id; ?>' },
        success: function(response) {
            if (!response.success) {
                console.log('Failed to save step.');
            }
        },
        error: function(error) {
            console.log('Request failed.');
        }
    });
});

// Initialize the previous steps as completed and the current step as active
for (let i = 0; i < currentStep; i++) {
    document.getElementById("step-" + i).classList.add("completed-step");
}
document.getElementById("step-" + currentStep).classList.add("active-step");




</script>
<style>
.customcontent{
        background: #f8f8f8;

    }
    .form-group-select-input-status label{
        display: none !important;
    }
    .form-group-select-input-status{
        margin: 0px;
        width: 190px;
    }
   .custombtn {
        position: relative;
        border: 2px solid #777;
        border-radius: 20px;
        letter-spacing: 1.5;
        display: inline-block; /* Ensures that the tooltip aligns properly with the button */
        transition: all ease;

    }
    .custombtn:hover{
        transform: scale(1.01);
        cursor: pointer;
        box-shadow: 0 10px 20px rgb(0,0,0,0.2);

    }
    
    .lead-lifecycle-chart {
    display: flex;
    }

    .step {
        /* padding: 10px; */
        border: 1px solid #ccc;
    }

    .move-btn {
        background-color: blue;
        color: white;
        padding: 5px 10px;
        text-decoration: none;
    }
    .active-step {
        background-color: lightpink;
    }
    .completed-step {
    background-color: lightblue;
}

    .custombtn:active{
        transform: scale(0.98); /* You can adjust this value to your liking */
        box-shadow: 0 5px 10px rgb(0, 0, 0, 0.2);
    }

    .custombtn[data-tooltip]:hover:after {
        content: attr(data-tooltip);
        position: absolute;
        left: 0;
        top: -30px; /* Adjust as needed */
        background: rgba(0, 0, 0, 0.6);
        color: #fff;
        padding: 5px;
        border-radius: 5px;
        font-size: 12px;
        z-index: 100;
        white-space: nowrap;
    }


    .heading_secondary {
    position: relative;
    font-weight: 600;
    text-transform: uppercase;
    text-align: center;
    letter-spacing: 2px;
    color:#777;
    letter-spacing: 1.1;
    display: inline-block; /* Use inline-block to make the width of the element adjust to the text size */
    transition: all ease-in-out;

}
.heading_secondary:hover{
    cursor: pointer;
    transform: scale(1.01); /* Apply scale effect on hover */
    text-shadow: 0 10px 20px rgb(0,0,0,0.2);


}
.heading_secondary::before {
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

.heading_secondary:hover::before {
    width: 100%; /* Scale the line to full width on hover */
}
.info-container {
    background: #f8f8f8;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
}

.info-item {
    border-bottom: 1px solid #e5e5e5;
    padding: 10px 0;
}

.info-item:last-child {
    border-bottom: none;
}

.label {
    font-weight: 500;
    color: #333;
}

.value {
    font-size: 1.1em;
    color: #007bff;
}

.info-section {
    padding: 15px;
    background: #f8f8f8;
    border-radius: 10px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
}

.info-row {
    padding: 10px;
    border-bottom: 1px solid #e5e5e5;
}

.info-row:last-child {
    border-bottom: none;
}

.label1 {
    font-weight: 500;
    color: #333;
    margin-bottom: 5px;
    margin-right: 10px;
}

.value1 {
    font-size: 1em;
    color: #00B4D8;
    text-align: right;
}

@media (min-width: 768px) {
    .info-row {
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }

    .label1,
    .value1 {
        margin-bottom: 0;
    }
}


.tab-item {
    position: relative;
    text-transform: capitalize
    display: inline-block;
    margin-bottom: 8px;

}

.tab-item a ,.tab-item a:hover ,.tab-item a:visited,.tab-item a :active{
    text-decoration: none;
    color:black;
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
.scrolling-navbar::-webkit-scrollbar {
    display: none;
}

.scrolling-navbar {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}

</style>