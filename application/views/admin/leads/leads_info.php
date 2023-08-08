<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>

<div id="wrapper" class="bg-gray-100 p-10">
    <div class="content mx-auto">
        <div class="p-4 bg-white rounded-xl shadow-lg">
            <div class="flex flex-col md:flex-row">
                <div class="w-full md:w-3/4 p-2">
                    <div class="text-3xl font-bold text-gray-900 mb-3"><?= $lead->name; ?></div>
                    <div class="flex items-center mb-3">
                        <span class="mr-2 font-semibold text-lg text-gray-700">Status:</span>
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
                    <div class="text-sm text-gray-700 flex flex-row gap-4">
                        <span><?= $lead->email ?: '----' ; ?></span> <span>|</span>
                        <span><?= $lead->website ?: '----' ; ?></span><span>|</span>
                        <span><?= $lead->phonenumber ?: '----' ; ?></span>
                    </div>
                </div>
                <div class="w-full md:w-1/4 mt-4 md:mt-0 p-4">
                    <button class="bg-blue-500 text-white py-2 px-4 rounded-md cursor-pointer hover:bg-blue-700 w-full">Convert To Customer</button>
                </div>
            </div>
        </div>

        <div class="flex flex-col md:flex-row mt-8 gap-8">
            <div class="w-full md:w-1/3">
                <div class="p-6 bg-white rounded-xl shadow-lg">
                    <h2 class="text-2xl text-gray-900 font-bold mb-6">Lead Information</h2>
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div class="text-center">
                            <span class="text-base text-gray-600">Lead Score</span>
                            <hr class="border-t border-gray-300 my-1">
                            <span class="text-xl font-bold text-gray-900">85</span>
                        </div>
                        <div class="text-center">
                            <span class="text-base text-gray-600">Lead Quality</span>
                            <hr class="border-t border-gray-300 my-1">
                            <span class="text-xl font-bold text-gray-900">High</span>
                        </div>
                        <div class="text-center">
                            <span class="text-base text-gray-600">Lead Value</span>
                            <hr class="border-t border-gray-300 my-1">
                            <span class="text-xl font-bold text-gray-900"><?= $lead->lead_value ?: '----' ; ?></span>
                        </div>
                    </div>

                    <hr class="border-t border-gray-300 my-2">
                    <div class="mt-5 space-y-3">
                        <div class="flex justify-between text-lg text-gray-700">
                            <span class="font-semibold">Position:</span>
                            <span><?= $lead->title ?: '----' ; ?></span>
                        </div>
                        <div class="flex justify-between text-lg text-gray-700">
                            <span class="font-semibold">Email:</span>
                            <span><?= $lead->email ?: '----' ; ?></span>
                        </div>
                        <div class="flex justify-between text-lg text-gray-700">
                            <span class="font-semibold">Phone:</span>
                            <span><?= $lead->phonenumber ?: '----' ; ?></span>
                        </div>
                        <div class="flex justify-between text-lg text-gray-700">
                            <span class="font-semibold">Company:</span>
                            <span><?= $lead->company ?: '----' ; ?></span>
                        </div>
                        <div class="flex justify-between text-lg text-gray-700">
                            <span class="font-semibold">Address:</span>
                            <span><?= $lead->address ?: '----' ; ?></span>
                        </div>
                        <div class="flex justify-between text-lg text-gray-700">
                            <span class="font-semibold">City:</span>
                            <span><?= $lead->city ?: '----' ; ?></span>
                        </div>
                        <div class="flex justify-between text-lg text-gray-700">
                            <span class="font-semibold">State:</span>
                            <span><?= $lead->state ?: '----' ; ?></span>
                        </div>
                        <div class="flex justify-between text-lg text-gray-700">
                            <span class="font-semibold">Country:</span>
                            <span><?= $lead->country ?: '----' ; ?></span>
                        </div>
                        <div class="flex justify-between text-lg text-gray-700">
                            <span class="font-semibold">Zip Code:</span>
                            <span><?= $lead->zip ?: '----' ; ?></span>
                        </div>

                        <div class="flex justify-between text-lg text-gray-700">
                            <span class="font-semibold">Description:</span>
                            <span><?= $lead->description ?: '----' ; ?></span>
                        </div>

                        <!-- More details here -->
                    </div>
                </div>
            </div>

            <div class="w-full md:w-2/3 p-0">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <ul class="flex space-x-4 mb-6" id="leadTab" role="tablist">
                        <li>
                            <a class="text-xl text-gray-800 font-medium hover:text-blue-600" id="activity-tab" data-toggle="tab" href="#activity" role="tab" aria-controls="activity" aria-selected="true">Activity</a>
                        </li>
                        <li>
                            <a class="text-xl text-gray-800 font-medium hover:text-blue-600" id="proposals-tab" data-toggle="tab" href="#proposals" role="tab" aria-controls="proposals" aria-selected="false" onclick="initDataTable('.table-proposals-lead', admin_url + 'proposals/proposal_relations/' + <?php echo $lead->id; ?> + '/lead','undefined', 'undefined','undefined',[6,'desc']);">Proposals</a>
                        </li>
                        <li>
                            <a class="text-xl text-gray-800 font-medium hover:text-blue-600" id="tasks-tab" data-toggle="tab" href="#tasks" role="tab" aria-controls="tasks" aria-selected="false" onclick="init_rel_tasks_table(<?php echo $lead->id; ?>,'lead','.table-rel-tasks-leads');">Tasks</a>
                        </li>
                        <li>
                            <a class="text-xl text-gray-800 font-medium hover:text-blue-600" id="attachments-tab" data-toggle="tab" href="#attachments" role="tab" aria-controls="attachments" aria-selected="false">Attachments</a>
                        </li>
                        <li>
                            <a class="text-xl text-gray-800 font-medium hover:text-blue-600" id="reminders-tab" data-toggle="tab" href="#reminders" role="tab" aria-controls="reminders" aria-selected="false" onclick="initDataTable('.table-reminders-leads', admin_url + 'misc/get_reminders/' + <?php echo $lead->id; ?> + '/' + 'lead', undefined, undefined,undefined,[1, 'asc']);">Reminders</a>
                        </li>
                        <li>
                            <a class="text-xl text-gray-800 font-medium hover:text-blue-600" id="notes-tab" data-toggle="tab" href="#notes" role="tab" aria-controls="notes" aria-selected="false">Notes</a>
                        </li>

                        <!-- More nav items here... -->
                    </ul>

                    <div class="tab-content p-5 bg-white rounded-xl shadow-lg" id="leadTabContent">
                        
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
                                        echo ($log['staffid'] == 0) ? _l($log['description'], $additional_data) : $log['full_name'] . ' - ' . _l($log['description'], $additional_data);
                                    } else {
                                        echo $log['full_name'] . ' - ';
                                        if ($log['custom_activity'] == 0) {
                                            echo _l($log['description']);
                                        } else {
                                            echo _l($log['description'], '', false);
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

                        <div class="tab-pane fade text-gray-800" id="tasks" role="tabpanel" aria-labelledby="tasks-tab">
                            <h4 class="text-xl text-gray-900 mb-4">Tasks</h4>
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
                            <a href="#" data-toggle="modal" class="btn btn-default"
                                data-target=".reminder-modal-lead-<?php echo $lead->id; ?>"><i class="fa-regular fa-bell"></i>
                                <?php echo _l('lead_set_reminder_title'); ?></a>
                            <hr />
                            <?php render_datatable([ _l('reminder_description'), _l('reminder_date'), _l('reminder_staff'), _l('reminder_is_notified')], 'reminders-leads'); ?>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



 <?php init_tail(); ?>
</body>
</html>
<script>
</script>
<style>
    .form-group-select-input-status label{
        display: none !important;
    }
    .form-group-select-input-status{
        margin: 0px;
        width: 190px;
    }
</style>