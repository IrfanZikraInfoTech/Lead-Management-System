<?php

use app\services\imap\Imap;
use app\services\LeadProfileBadges;
use app\services\leads\LeadsKanban;
use app\services\imap\ConnectionErrorException;
use Ddeboer\Imap\Exception\MailboxDoesNotExistException;

header('Content-Type: text/html; charset=utf-8');
defined('BASEPATH') or exit('No direct script access allowed');

class Leads extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('leads_model');

    }

    /* List all leads */
    public function event_create() {
        if($this->input->post()) {
            $data = $this->input->post();
            $id = $this->leads_model->create_event($data);
    
            if ($id) {
                echo json_encode(['status' => 'success', 'message' => 'Event created successfully!', 'id'=>$id]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error in creating event.']);
            }
        }
    }
    

    // widgets work
    public function index() {
        $this->load->model('Leads_model');
        
        // Fetch lead status counts
        $statusCounts = $this->Leads_model->getLeadStatusCounts();
        
        // Fetch lead source counts
        $sourceCounts = $this->Leads_model->getLeadSourceCounts();
        
        // Fetch lead distribution by salesperson
        $leadsBySalesperson = $this->Leads_model->getLeadsBySalesperson();
    
        // Fetch Lead Conversion Rates
        $conversionRates = $this->Leads_model->getLeadConversionRates();
        
        // Fetch Lead Lifecycle Data
        $leadLifecycleData = $this->Leads_model->getLeadLifecycleData();
        
        // Fetch Lead Response Times
        $leadResponseTimes = $this->Leads_model->get_lead_response_times(); // Assuming you've added this function to your Leads_model.
    
        //getLeadInteractions
        $leadInteractions = $this->Leads_model->getLeadInteractions();


        // ctop cards
        $total_leads= $this->leads_model->get_total_leads();

        $new_customers_count =$this->leads_model->getNewCustomersCount();

        $engagement_data=  $this->leads_model->getEngagementData();
        $leadSources = $this->leads_model->getLeadSources(); // Assuming a function to get lead sources from the model
        $top_lead_source= $this->leads_model->get_top_lead_source();
        $leads_not_responded= $this->leads_model->getLeadsNotRespondedInAWeek();
        $campaign_performance=$this->leads_model->get_campaign_performance();


        // Send all data sets to the view
        $data = [
            'statusCounts' => $statusCounts,
            'sourceCounts' => $sourceCounts,
            'leadsBySalesperson' => $leadsBySalesperson,
            'conversionRates' => $conversionRates,
            'leadLifecycleData' => $leadLifecycleData,
            'leadResponseTimes' => $leadResponseTimes ,
            'leadInteractions'=> $leadInteractions  ,
            'total_leads' =>$total_leads,
            'new_customers_count'=> $new_customers_count,
            'engagement_data'=>$engagement_data,
            'leadSources'=> $leadSources,
            'top_lead_source'=>$top_lead_source,
            'leads_not_responded'=>$leads_not_responded,
            'campaign_performance'=>$campaign_performance
        ];
        
        $this->load->view('admin/leads/lead_dashboard', $data);
    }
    
    //widget work end 

    public function list($id = '')
    {
        close_setup_menu();

        if (!is_staff_member()) {
            access_denied('Leads');
        }

        $data['switch_kanban'] = true;

        if ($this->session->userdata('leads_kanban_view') == 'true') {
            $data['switch_kanban'] = false;
            $data['bodyclass']     = 'kan-ban-body';
        }

        $data['staff'] = $this->staff_model->get('', ['active' => 1]);
        if (is_gdpr() && get_option('gdpr_enable_consent_for_leads') == '1') {
            $this->load->model('gdpr_model');
            $data['consent_purposes'] = $this->gdpr_model->get_consent_purposes();
        }
        $data['summary']  = get_leads_summary();
        $data['statuses'] = $this->leads_model->get_status();
        $data['sources']  = $this->leads_model->get_source();
        $data['title']    = _l('leads');
        // in case accesed the url leads/index/ directly with id - used in search
        $data['leadid']   = $id;
        $data['isKanBan'] = $this->session->has_userdata('leads_kanban_view') &&
            $this->session->userdata('leads_kanban_view') == 'true';

        $this->load->view('admin/leads/manage_leads', $data);
    }
    
    public function save_flow() {
        $flowItems = $this->input->post('flowItems');
        $id = $this->input->post('id'); // If you're updating an existing record
    
        $data = array(
            'flow' => json_encode($flowItems)
        );
    
        $this->leads_model->save_or_update_flow($data); // Call the new method here
    
        // You can customize this response as per your needs
        $response = array(
            'success' => true,
            'message' => 'Flow saved successfully.'
        );
    
        echo json_encode($response);
    }
    
    public function lifecycle() {
        $lifecycle = $this->leads_model->get_lifecycle();

        $data['lifecycle'] = $lifecycle;
        $this->load->view('admin/leads/lifecycle_builder', $data); // Replace with your view's path
    }
    
    

    public function info($id, $rel_type = null, $rel_id = null){
        $reminder_data         = '';
        $data['lead_locked']   = false;
        $data['openEdit']      = $this->input->get('edit') ? true : false;
        $data['members']       = $this->staff_model->get('', ['is_not_staff' => 0, 'active' => 1]);
        $data['status_id']     = $this->input->get('status_id') ? $this->input->get('status_id') : get_option('leads_default_status');
        $data['base_currency'] = get_base_currency();

        $data['lifecycle'] = $this->leads_model->get_lifecycle();
        $data['messages'] = $this->leads_model->get_messages($id);

        if (is_numeric($id)) {
            $leadWhere = (has_permission('leads', '', 'view') ? [] : '(assigned = ' . get_staff_user_id() . ' OR addedfrom=' . get_staff_user_id() . ' OR is_public=1)');

            $lead = $this->leads_model->get($id, $leadWhere);

            if (!$lead) {
                header('HTTP/1.0 404 Not Found');
                echo _l('lead_not_found');
                die;
            }

            if (total_rows(db_prefix() . 'clients', ['leadid' => $id ]) > 0) {
                $data['lead_locked'] = ((!is_admin() && get_option('lead_lock_after_convert_to_customer') == 1) ? true : false);
            }

            $reminder_data = $this->load->view('admin/includes/modals/reminder', [
                    'id'             => $lead->id,
                    'name'           => 'lead',
                    'members'        => $data['members'],
                    'reminder_title' => _l('lead_set_reminder_title'),
                ], true);
            $data['reminder_data'] = $reminder_data;
            $data['lead']          = $lead;
            $data['mail_activity'] = $this->leads_model->get_mail_activity($id);
            $data['notes']         = $this->misc_model->get_notes($id, 'lead');
            $data['activity_log']  = $this->leads_model->get_lead_activity_log($id);
            $data['tblevents'] = $this->leads_model->get_all_events($id);
            $data['contracts']     = $this->leads_model->get_contracts_for_lead($id);
            $data['invoices']  = $this->leads_model->get_invoice_for_lead($id);

            if (is_gdpr() && get_option('gdpr_enable_consent_for_leads') == '1') {
                $this->load->model('gdpr_model');
                $data['purposes'] = $this->gdpr_model->get_consent_purposes($lead->id, 'lead');
                $data['consents'] = $this->gdpr_model->get_consents(['lead_id' => $lead->id]);
            }

            $leadProfileBadges         = new LeadProfileBadges($id);
            $data['total_reminders']   = $leadProfileBadges->getCount('reminders');
            $data['total_notes']       = $leadProfileBadges->getCount('notes');
            $data['total_attachments'] = $leadProfileBadges->getCount('attachments');
            $data['total_tasks']       = $leadProfileBadges->getCount('tasks');
            $data['total_proposals']   = $leadProfileBadges->getCount('proposals');
            // $data['total_events']      = $leadProfileBadges->getCount('events');
        }

        $data['statuses'] = $this->leads_model->get_status();
        $data['sources']  = $this->leads_model->get_source();

        $data = hooks()->apply_filters('lead_view_data', $data);

        if($rel_type == 'proposal'){
            $this->load->model("proposals_model");
            $proposal = $this->proposals_model->get($rel_id);

            $data['rel_type'] = $rel_type;
            $data['rel_id'] = $rel_id;

            if($proposal->status != "4"){
                $data['resend'] = false;
            }else{
                $data['resend'] = true;
            }
        }

        $this->load->view('admin/leads/leads_info', $data);
    }

    public function territories(){
        $data['territories'] = $this->leads_model->get_territories();
        $this->load->view("admin/leads/territory/manage", $data);
    }

    public function territory_builder($function, $id = null){
        if($function == "new"){
            $this->load->view("admin/leads/territory/builder");
        }else if($function == "edit"){
            if($id){
                $data['territory'] = $this->leads_model->get_territory($id);
                $this->load->view("admin/leads/territory/builder", $data);
            }
                
        }
    }

    public function table()
    {
        if (!is_staff_member()) {
            ajax_access_denied();
        }
        $this->app->get_table_data('leads');
    }

    public function kanban()
    {
        if (!is_staff_member()) {
            ajax_access_denied();
        }

        $data['statuses']      = $this->leads_model->get_status();
        $data['base_currency'] = get_base_currency();
        $data['summary']       = get_leads_summary();

        echo $this->load->view('admin/leads/kan-ban', $data, true);
    }
    
    public function updateStatus($id) {
        // $this->load->model('Event_model');
        $success = $this->leads_model->increaseStatus($id);
    
        if ($success) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }
    public function save_schedule()
    { 
        $eventId = $this->input->post('eventId');
        $datetime = $this->input->post('datetime');
        $link = $this->input->post('link');
        // echo $datetime;
        // echo $link;
        // echo $eventId;
        // Call the function to save the schedule
        $result = $this->leads_model->save_schedule($eventId, $datetime, $link);

        if ($result) {
            // Respond with success if saved
            echo json_encode(array('status' => 'success'));
        } else {
            // Respond with an error if something went wrong
            echo json_encode(array('status' => 'error', 'message' => 'Could not save the schedule.'));
        }
    }   
    public function getEventDetails($eventId) {
        $eventDetails = $this->EventModel->getEventDetails($eventId);
        echo json_encode($eventDetails);
    }
    
    // public function updateEventDetails() {
    //     $postData = $this->input->post();
    //     $eventId = $postData['event_id'];
    //     unset($postData['event_id']);
    //     $this->lead_model->updateEvent($eventId, $postData);
    //     echo json_encode(['status' => 'success']);
    // }
    
    public function update_event_status()
    {
        $eventId = $this->input->post('event_id');

        $success = $this->leads_model->update_status_complete($eventId);

        if ($success) {
            // Redirect or send success response
        } else {
            // Redirect or send failure response
        }
    }

// function getInactiveLeads($daysInactive = 3) {
    //     $dateLimit = date('Y-m-d', strtotime('-' . $daysInactive . ' days'));
    
    //     $this->db->select('tblleads.*');
    //     $this->db->from('tblleads');
    //     $this->db->join('tbllead_activity_log', 'tblleads.id = tbllead_activity_log.leadid');
    //     $this->db->where('tbllead_activity_log.date <', $dateLimit);
    //     $this->db->group_by('tblleads.id'); // Lead ko ek baar hi include karne ke liye
    //     // echo $dateLimit;

    //     $query = $this->db->get();
    //     echo $this->db->last_query();

    //     print_r( $query->result_array());
// }
function getInactiveLeadsAndNotify($daysInactive = 3) {
    $dateLimit = date('Y-m-d', strtotime('-' . $daysInactive . ' days'));

    $this->db->select('tblleads.*');
    $this->db->from('tblleads');
    $this->db->join('tbllead_activity_log', 'tblleads.id = tbllead_activity_log.leadid');
    $this->db->where('tbllead_activity_log.date <', $dateLimit);
    $this->db->group_by('tblleads.id'); // Include each lead only once

    $query = $this->db->get();
    $inactiveLeads = $query->result_array();

    $this->load->library('email');

    foreach ($inactiveLeads as $lead) {
        // Assume you have an email address in the lead information
        $emailAddress = $lead['email'];
        
        // Construct the email content
        $subject = "Inactive Lead Alert";
        $message = "The lead " . $lead['name'] . " has not been updated for over " . $daysInactive . " days.";

        $this->email->from('ahmed@example.com', 'Your Name');
        $this->email->to('irfan@zikrainfotech.com');
        $this->email->subject($subject);
        $this->email->message($message);

        $this->email->send();
        
        // Log the action if required
        // ...
    }
}


    /* Add or update lead */
    public function lead($id = '')
    {
        if ($this->input->post()) {
            $post_data = $this->input->post();
            if (isset($post_data['assigned']) && is_array($post_data['assigned'])) {
                $post_data['assigned'] = implode(',', $post_data['assigned']);
            }
            if ($id == '') {
                $id      = $this->leads_model->add($post_data);
                $message = $id ? _l('added_successfully', _l('lead')) : '';

                echo json_encode([
                    'success'  => $id ? true : false,
                    'id'       => $id,
                    'message'  => $message,
                    'leadView' => $id ? $this->_get_lead_data($id) : [],
                ]);
            } else {
                $emailOriginal   = $this->db->select('email')->where('id', $id)->get(db_prefix() . 'leads')->row()->email;
                $proposalWarning = false;
                $message         = '';
                $success         = $this->leads_model->update($this->input->post(), $id);

                if ($success) {
                    $emailNow = $this->db->select('email')->where('id', $id)->get(db_prefix() . 'leads')->row()->email;

                    $proposalWarning = (total_rows(db_prefix() . 'proposals', [
                        'rel_type' => 'lead',
                        'rel_id'   => $id, ]) > 0 && ($emailOriginal != $emailNow) && $emailNow != '') ? true : false;

                    $message = _l('updated_successfully', _l('lead'));
                }
                echo json_encode([
                    'success'          => $success,
                    'message'          => $message,
                    'id'               => $id,
                    'proposal_warning' => $proposalWarning,
                    'leadView'         => $this->_get_lead_data($id),
                ]);
            }
            die;
        }

        echo json_encode([
            'leadView' => $this->_get_lead_data($id),
        ]);
    }

    private function _get_lead_data($id = '')
    {
        $reminder_data         = '';
        $data['lead_locked']   = false;
        $data['openEdit']      = $this->input->get('edit') ? true : false;
        $data['members']       = $this->staff_model->get('', ['is_not_staff' => 0, 'active' => 1]);
        $data['status_id']     = $this->input->get('status_id') ? $this->input->get('status_id') : get_option('leads_default_status');
        $data['base_currency'] = get_base_currency();
    
        if (is_numeric($id)) {
            $leadWhere = '(FIND_IN_SET(' . get_staff_user_id() . ', assigned) > 0 OR addedfrom=' . get_staff_user_id() . ' OR is_public=1)';
            $lead = $this->leads_model->get($id, $leadWhere);
        
           
            if (!$lead) {
                header('HTTP/1.0 404 Not Found');
                echo _l('lead_not_found');
                die;
            }
    
            if (total_rows(db_prefix() . 'clients', ['leadid' => $id ]) > 0) {
                $data['lead_locked'] = ((!is_admin() && get_option('lead_lock_after_convert_to_customer') == 1) ? true : false);
            }
    
            $reminder_data = $this->load->view('admin/includes/modals/reminder', [
                    'id'             => $lead->id,
                    'name'           => 'lead',
                    'members'        => $data['members'],
                    'reminder_title' => _l('lead_set_reminder_title'),
                ], true);
    
            $data['lead']          = $lead;
            $data['mail_activity'] = $this->leads_model->get_mail_activity($id);
            $data['notes']         = $this->misc_model->get_notes($id, 'lead');
            $data['activity_log']  = $this->leads_model->get_lead_activity_log($id);
            $data['events']        = $this->leads_model->get_all_events($id);

            if (is_gdpr() && get_option('gdpr_enable_consent_for_leads') == '1') {
                $this->load->model('gdpr_model');
                $data['purposes'] = $this->gdpr_model->get_consent_purposes($lead->id, 'lead');
                $data['consents'] = $this->gdpr_model->get_consents(['lead_id' => $lead->id]);
            }
    
            $leadProfileBadges         = new LeadProfileBadges($id);
            $data['total_reminders']   = $leadProfileBadges->getCount('reminders');
            $data['total_notes']       = $leadProfileBadges->getCount('notes');
            $data['total_attachments'] = $leadProfileBadges->getCount('attachments');
            $data['total_tasks']       = $leadProfileBadges->getCount('tasks');
            $data['total_proposals']   = $leadProfileBadges->getCount('proposals');
            $data['total_events']      = $leadProfileBadges->getCount('events');
        }
    
        $data['statuses'] = $this->leads_model->get_status();
        $data['sources']  = $this->leads_model->get_source();
    
        $data = hooks()->apply_filters('lead_view_data', $data);
    
        return [
            'data'          => $this->load->view('admin/leads/lead', $data, true),
            'reminder_data' => $reminder_data,
        ];
    }
    public function get_all_leads() {
        if ($this->input->is_ajax_request()) {
            $this->load->model('leads_model');
            
            $leads = $this->leads_model->get();
            echo json_encode($leads);
        }
    }
    public function leads_kanban_load_more()
    {
        if (!is_staff_member()) {
            ajax_access_denied();
        }

        $status = $this->input->get('status');
        $page   = $this->input->get('page');

        $this->db->where('id', $status);
        $status = $this->db->get(db_prefix() . 'leads_status')->row_array();

        $leads = (new LeadsKanban($status['id']))
        ->search($this->input->get('search'))
        ->sortBy(
            $this->input->get('sort_by'),
            $this->input->get('sort')
        )
        ->page($page)->get();

        foreach ($leads as $lead) {
            $this->load->view('admin/leads/_kan_ban_card', [
                'lead'   => $lead,
                'status' => $status,
            ]);
        }
    }

    public function switch_kanban($set = 0)
    {
        if ($set == 1) {
            $set = 'true';
        } else {
            $set = 'false';
        }
        $this->session->set_userdata([
            'leads_kanban_view' => $set,
        ]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function export($id)
    {
        if (is_admin()) {
            $this->load->library('gdpr/gdpr_lead');
            $this->gdpr_lead->export($id);
        }
    }

    /* Delete lead from database */
    public function delete($id)
    {
        if (!$id) {
            redirect(admin_url('leads'));
        }

        if (!has_permission('leads', '', 'delete')) {
            access_denied('Delete Lead');
        }

        $response = $this->leads_model->delete($id);
        if (is_array($response) && isset($response['referenced'])) {
            set_alert('warning', _l('is_referenced', _l('lead_lowercase')));
        } elseif ($response === true) {
            set_alert('success', _l('deleted', _l('lead')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('lead_lowercase')));
        }

        $ref = $_SERVER['HTTP_REFERER'];

        // if user access leads/inded/ID to prevent redirecting on the same url because will throw 404
        if (!$ref || strpos($ref, 'index/' . $id) !== false) {
            redirect(admin_url('leads'));
        }

        redirect($ref);
    }

    public function mark_as_lost($id)
    {
        if (!is_staff_member() || !$this->leads_model->staff_can_access_lead($id)) {
            ajax_access_denied();
        }
        $message = '';
        $success = $this->leads_model->mark_as_lost($id);
        if ($success) {
            $message = _l('lead_marked_as_lost');
        }
        echo json_encode([
            'success'  => $success,
            'message'  => $message,
            'leadView' => $this->_get_lead_data($id),
            'id'       => $id,
        ]);
    }

    public function unmark_as_lost($id)
    {
        if (!is_staff_member() || !$this->leads_model->staff_can_access_lead($id)) {
            ajax_access_denied();
        }
        $message = '';
        $success = $this->leads_model->unmark_as_lost($id);
        if ($success) {
            $message = _l('lead_unmarked_as_lost');
        }
        echo json_encode([
            'success'  => $success,
            'message'  => $message,
            'leadView' => $this->_get_lead_data($id),
            'id'       => $id,
        ]);
    }

    public function mark_as_junk($id)
    {
        if (!is_staff_member() || !$this->leads_model->staff_can_access_lead($id)) {
            ajax_access_denied();
        }
        $message = '';
        $success = $this->leads_model->mark_as_junk($id);
        if ($success) {
            $message = _l('lead_marked_as_junk');
        }
        echo json_encode([
            'success'  => $success,
            'message'  => $message,
            'leadView' => $this->_get_lead_data($id),
            'id'       => $id,
        ]);
    }

    public function unmark_as_junk($id)
    {
        if (!is_staff_member() || !$this->leads_model->staff_can_access_lead($id)) {
            ajax_access_denied();
        }
        $message = '';
        $success = $this->leads_model->unmark_as_junk($id);
        if ($success) {
            $message = _l('lead_unmarked_as_junk');
        }
        echo json_encode([
            'success'  => $success,
            'message'  => $message,
            'leadView' => $this->_get_lead_data($id),
            'id'       => $id,
        ]);
    }

    public function add_activity()
    {
        $leadid = $this->input->post('leadid');
        if (!is_staff_member() || !$this->leads_model->staff_can_access_lead($leadid)) {
            ajax_access_denied();
        }
        if ($this->input->post()) {
            $message = $this->input->post('activity');
            $aId     = $this->leads_model->log_lead_activity($leadid, $message);
            if ($aId) {
                $this->db->where('id', $aId);
                $this->db->update(db_prefix() . 'lead_activity_log', ['custom_activity' => 1]);
            }
            echo json_encode(['leadView' => $this->_get_lead_data($leadid), 'id' => $leadid]);
        }
    }

    public function get_convert_data($id)
    {
        if (!is_staff_member() || !$this->leads_model->staff_can_access_lead($id)) {
            ajax_access_denied();
        }
        if (is_gdpr() && get_option('gdpr_enable_consent_for_contacts') == '1') {
            $this->load->model('gdpr_model');
            $data['purposes'] = $this->gdpr_model->get_consent_purposes($id, 'lead');
        }
        $data['lead'] = $this->leads_model->get($id);
        $this->load->view('admin/leads/convert_to_customer', $data);
    }

    /**
     * Convert lead to client
     * @since  version 1.0.1
     * @return mixed
     */
    public function convert_to_customer()
    {
        if (!is_staff_member()) {
            access_denied('Lead Convert to Customer');
        }

        if ($this->input->post()) {
            $default_country  = get_option('customer_default_country');
            $data             = $this->input->post();
            $data['password'] = $this->input->post('password', false);

            $original_lead_email = $data['original_lead_email'];
            unset($data['original_lead_email']);

            if (isset($data['transfer_notes'])) {
                $notes = $this->misc_model->get_notes($data['leadid'], 'lead');
                unset($data['transfer_notes']);
            }

            if (isset($data['transfer_consent'])) {
                $this->load->model('gdpr_model');
                $consents = $this->gdpr_model->get_consents(['lead_id' => $data['leadid']]);
                unset($data['transfer_consent']);
            }

            if (isset($data['merge_db_fields'])) {
                $merge_db_fields = $data['merge_db_fields'];
                unset($data['merge_db_fields']);
            }

            if (isset($data['merge_db_contact_fields'])) {
                $merge_db_contact_fields = $data['merge_db_contact_fields'];
                unset($data['merge_db_contact_fields']);
            }

            if (isset($data['include_leads_custom_fields'])) {
                $include_leads_custom_fields = $data['include_leads_custom_fields'];
                unset($data['include_leads_custom_fields']);
            }

            if ($data['country'] == '' && $default_country != '') {
                $data['country'] = $default_country;
            }

            $data['billing_street']  = $data['address'];
            $data['billing_city']    = $data['city'];
            $data['billing_state']   = $data['state'];
            $data['billing_zip']     = $data['zip'];
            $data['billing_country'] = $data['country'];

            $data['is_primary'] = 1;
            $id                 = $this->clients_model->add($data, true);
            if ($id) {
                $primary_contact_id = get_primary_contact_user_id($id);

                if (isset($notes)) {
                    foreach ($notes as $note) {
                        $this->db->insert(db_prefix() . 'notes', [
                            'rel_id'         => $id,
                            'rel_type'       => 'customer',
                            'dateadded'      => $note['dateadded'],
                            'addedfrom'      => $note['addedfrom'],
                            'description'    => $note['description'],
                            'date_contacted' => $note['date_contacted'],
                            ]);
                    }
                }
                if (isset($consents)) {
                    foreach ($consents as $consent) {
                        unset($consent['id']);
                        unset($consent['purpose_name']);
                        $consent['lead_id']    = 0;
                        $consent['contact_id'] = $primary_contact_id;
                        $this->gdpr_model->add_consent($consent);
                    }
                }
                if (!has_permission('customers', '', 'view') && get_option('auto_assign_customer_admin_after_lead_convert') == 1) {
                    $this->db->insert(db_prefix() . 'customer_admins', [
                        'date_assigned' => date('Y-m-d H:i:s'),
                        'customer_id'   => $id,
                        'staff_id'      => get_staff_user_id(),
                    ]);
                }
                $this->leads_model->log_lead_activity($data['leadid'], 'not_lead_activity_converted', false, serialize([
                    get_staff_full_name(),
                ]));
                $default_status = $this->leads_model->get_status('', [
                    'isdefault' => 1,
                ]);
                $this->db->where('id', $data['leadid']);
                $this->db->update(db_prefix() . 'leads', [
                    'date_converted' => date('Y-m-d H:i:s'),
                    'status'         => $default_status[0]['id'],
                    'junk'           => 0,
                    'lost'           => 0,
                ]);
                // Check if lead email is different then client email
                $contact = $this->clients_model->get_contact(get_primary_contact_user_id($id));
                if ($contact->email != $original_lead_email) {
                    if ($original_lead_email != '') {
                        $this->leads_model->log_lead_activity($data['leadid'], 'not_lead_activity_converted_email', false, serialize([
                            $original_lead_email,
                            $contact->email,
                        ]));
                    }
                }
                if (isset($include_leads_custom_fields)) {
                    foreach ($include_leads_custom_fields as $fieldid => $value) {
                        // checked don't merge
                        if ($value == 5) {
                            continue;
                        }
                        // get the value of this leads custom fiel
                        $this->db->where('relid', $data['leadid']);
                        $this->db->where('fieldto', 'leads');
                        $this->db->where('fieldid', $fieldid);
                        $lead_custom_field_value = $this->db->get(db_prefix() . 'customfieldsvalues')->row()->value;
                        // Is custom field for contact ot customer
                        if ($value == 1 || $value == 4) {
                            if ($value == 4) {
                                $field_to = 'contacts';
                            } else {
                                $field_to = 'customers';
                            }
                            $this->db->where('id', $fieldid);
                            $field = $this->db->get(db_prefix() . 'customfields')->row();
                            // check if this field exists for custom fields
                            $this->db->where('fieldto', $field_to);
                            $this->db->where('name', $field->name);
                            $exists               = $this->db->get(db_prefix() . 'customfields')->row();
                            $copy_custom_field_id = null;
                            if ($exists) {
                                $copy_custom_field_id = $exists->id;
                            } else {
                                // there is no name with the same custom field for leads at the custom side create the custom field now
                                $this->db->insert(db_prefix() . 'customfields', [
                                    'fieldto'        => $field_to,
                                    'name'           => $field->name,
                                    'required'       => $field->required,
                                    'type'           => $field->type,
                                    'options'        => $field->options,
                                    'display_inline' => $field->display_inline,
                                    'field_order'    => $field->field_order,
                                    'slug'           => slug_it($field_to . '_' . $field->name, [
                                        'separator' => '_',
                                    ]),
                                    'active'        => $field->active,
                                    'only_admin'    => $field->only_admin,
                                    'show_on_table' => $field->show_on_table,
                                    'bs_column'     => $field->bs_column,
                                ]);
                                $new_customer_field_id = $this->db->insert_id();
                                if ($new_customer_field_id) {
                                    $copy_custom_field_id = $new_customer_field_id;
                                }
                            }
                            if ($copy_custom_field_id != null) {
                                $insert_to_custom_field_id = $id;
                                if ($value == 4) {
                                    $insert_to_custom_field_id = get_primary_contact_user_id($id);
                                }
                                $this->db->insert(db_prefix() . 'customfieldsvalues', [
                                    'relid'   => $insert_to_custom_field_id,
                                    'fieldid' => $copy_custom_field_id,
                                    'fieldto' => $field_to,
                                    'value'   => $lead_custom_field_value,
                                ]);
                            }
                        } elseif ($value == 2) {
                            if (isset($merge_db_fields)) {
                                $db_field = $merge_db_fields[$fieldid];
                                // in case user don't select anything from the db fields
                                if ($db_field == '') {
                                    continue;
                                }
                                if ($db_field == 'country' || $db_field == 'shipping_country' || $db_field == 'billing_country') {
                                    $this->db->where('iso2', $lead_custom_field_value);
                                    $this->db->or_where('short_name', $lead_custom_field_value);
                                    $this->db->or_like('long_name', $lead_custom_field_value);
                                    $country = $this->db->get(db_prefix() . 'countries')->row();
                                    if ($country) {
                                        $lead_custom_field_value = $country->country_id;
                                    } else {
                                        $lead_custom_field_value = 0;
                                    }
                                }
                                $this->db->where('userid', $id);
                                $this->db->update(db_prefix() . 'clients', [
                                    $db_field => $lead_custom_field_value,
                                ]);
                            }
                        } elseif ($value == 3) {
                            if (isset($merge_db_contact_fields)) {
                                $db_field = $merge_db_contact_fields[$fieldid];
                                if ($db_field == '') {
                                    continue;
                                }
                                $this->db->where('id', $primary_contact_id);
                                $this->db->update(db_prefix() . 'contacts', [
                                    $db_field => $lead_custom_field_value,
                                ]);
                            }
                        }
                    }
                }
                // set the lead to status client in case is not status client
                $this->db->where('isdefault', 1);
                $status_client_id = $this->db->get(db_prefix() . 'leads_status')->row()->id;
                $this->db->where('id', $data['leadid']);
                $this->db->update(db_prefix() . 'leads', [
                    'status' => $status_client_id,
                ]);

                set_alert('success', _l('lead_to_client_base_converted_success'));

                if (is_gdpr() && get_option('gdpr_after_lead_converted_delete') == '1') {
                    // When lead is deleted
                    // move all proposals to the actual customer record
                    $this->db->where('rel_id', $data['leadid']);
                    $this->db->where('rel_type', 'lead');
                    $this->db->update('proposals', [
                        'rel_id'   => $id,
                        'rel_type' => 'customer',
                    ]);

                    $this->leads_model->delete($data['leadid']);

                    $this->db->where('userid', $id);
                    $this->db->update(db_prefix() . 'clients', ['leadid' => null]);
                }

                log_activity('Created Lead Client Profile [LeadID: ' . $data['leadid'] . ', ClientID: ' . $id . ']');
                hooks()->do_action('lead_converted_to_customer', ['lead_id' => $data['leadid'], 'customer_id' => $id]);
                redirect(admin_url('clients/client/' . $id));
            }
        }
    }

    /* Used in kanban when dragging and mark as */
    public function update_lead_status()
    {
        if ($this->input->post() && $this->input->is_ajax_request()) {
            $this->leads_model->update_lead_status($this->input->post());
        }
    }

    public function update_status_order()
    {
        if ($post_data = $this->input->post()) {
            $this->leads_model->update_status_order($post_data);
        }
    }

    public function add_lead_attachment()
    {
        $id       = $this->input->post('id');
        $lastFile = $this->input->post('last_file');

        if (!is_staff_member() || !$this->leads_model->staff_can_access_lead($id)) {
            ajax_access_denied();
        }

        handle_lead_attachments($id);
        echo json_encode(['leadView' => $lastFile ? $this->_get_lead_data($id) : [], 'id' => $id]);
    }

    public function add_external_attachment()
    {
        if ($this->input->post()) {
            $this->leads_model->add_attachment_to_database(
                $this->input->post('lead_id'),
                $this->input->post('files'),
                $this->input->post('external')
            );
        }
    }

    public function delete_attachment($id, $lead_id)
    {
        if (!is_staff_member() || !$this->leads_model->staff_can_access_lead($lead_id)) {
            ajax_access_denied();
        }
        echo json_encode([
            'success'  => $this->leads_model->delete_lead_attachment($id),
            'leadView' => $this->_get_lead_data($lead_id),
            'id'       => $lead_id,
        ]);
    }

    public function delete_note($id, $lead_id)
    {
        if (!is_staff_member() || !$this->leads_model->staff_can_access_lead($lead_id)) {
            ajax_access_denied();
        }
        echo json_encode([
            'success'  => $this->misc_model->delete_note($id),
            'leadView' => $this->_get_lead_data($lead_id),
            'id'       => $lead_id,
        ]);
    }

    public function update_all_proposal_emails_linked_to_lead($id)
    {
        $success = false;
        $email   = '';
        if ($this->input->post('update')) {
            $this->load->model('proposals_model');

            $this->db->select('email');
            $this->db->where('id', $id);
            $email = $this->db->get(db_prefix() . 'leads')->row()->email;

            $proposals = $this->proposals_model->get('', [
                'rel_type' => 'lead',
                'rel_id'   => $id,
            ]);
            $affected_rows = 0;

            foreach ($proposals as $proposal) {
                $this->db->where('id', $proposal['id']);
                $this->db->update(db_prefix() . 'proposals', [
                    'email' => $email,
                ]);
                if ($this->db->affected_rows() > 0) {
                    $affected_rows++;
                }
            }

            if ($affected_rows > 0) {
                $success = true;
            }
        }

        echo json_encode([
            'success' => $success,
            'message' => _l('proposals_emails_updated', [
                _l('lead_lowercase'),
                $email,
            ]),
        ]);
    }

    public function save_form_data()
    {
        $data = $this->input->post();

        // form data should be always sent to the request and never should be empty
        // this code is added to prevent losing the old form in case any errors
        if (!isset($data['formData']) || isset($data['formData']) && !$data['formData']) {
            echo json_encode([
                'success' => false,
            ]);
            die;
        }

        // If user paste with styling eq from some editor word and the Codeigniter XSS feature remove and apply xss=remove, may break the json.
        $data['formData'] = preg_replace('/=\\\\/m', "=''", $data['formData']);

        $this->db->where('id', $data['id']);
        $this->db->update(db_prefix() . 'web_to_lead', [
            'form_data' => $data['formData'],
        ]);
        if ($this->db->affected_rows() > 0) {
            echo json_encode([
                'success' => true,
                'message' => _l('updated_successfully', _l('web_to_lead_form')),
            ]);
        } else {
            echo json_encode([
                'success' => false,
            ]);
        }
    }

    public function form($id = '')
    {
        if (!is_admin()) {
            access_denied('Web To Lead Access');
        }
        if ($this->input->post()) {
            if ($id == '') {
                $data = $this->input->post();
                $id   = $this->leads_model->add_form($data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('web_to_lead_form')));
                    redirect(admin_url('leads/form/' . $id));
                }
            } else {
                $success = $this->leads_model->update_form($id, $this->input->post());
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('web_to_lead_form')));
                }
                redirect(admin_url('leads/form/' . $id));
            }
        }

        $data['formData'] = [];
        $custom_fields    = get_custom_fields('leads', 'type != "link"');

        $cfields       = format_external_form_custom_fields($custom_fields);
        $data['title'] = _l('web_to_lead');

        if ($id != '') {
            $data['form'] = $this->leads_model->get_form([
                'id' => $id,
            ]);
            $data['title']    = $data['form']->name . ' - ' . _l('web_to_lead_form');
            $data['formData'] = $data['form']->form_data;
        }

        $this->load->model('roles_model');
        $data['roles']    = $this->roles_model->get();
        $data['sources']  = $this->leads_model->get_source();
        $data['statuses'] = $this->leads_model->get_status();

        $data['members'] = $this->staff_model->get('', [
            'active'       => 1,
            'is_not_staff' => 0,
        ]);

        $data['languages'] = $this->app->get_available_languages();
        $data['cfields']   = $cfields;

        $db_fields = [];
        $fields    = [
            'name',
            'title',
            'email',
            'phonenumber',
            'lead_value',
            'company',
            'address',
            'city',
            'state',
            'country',
            'zip',
            'description',
            'website',
        ];

        $fields = hooks()->apply_filters('lead_form_available_database_fields', $fields);

        $className = 'form-control';

        foreach ($fields as $f) {
            $_field_object = new stdClass();
            $type          = 'text';
            $subtype       = '';
            if ($f == 'email') {
                $subtype = 'email';
            } elseif ($f == 'description' || $f == 'address') {
                $type = 'textarea';
            } elseif ($f == 'country') {
                $type = 'select';
            }

            if ($f == 'name') {
                $label = _l('lead_add_edit_name');
            } elseif ($f == 'email') {
                $label = _l('lead_add_edit_email');
            } elseif ($f == 'phonenumber') {
                $label = _l('lead_add_edit_phonenumber');
            } elseif ($f == 'lead_value') {
                $label = _l('lead_add_edit_lead_value');
                $type  = 'number';
            } else {
                $label = _l('lead_' . $f);
            }

            $field_array = [
                'subtype'   => $subtype,
                'type'      => $type,
                'label'     => $label,
                'className' => $className,
                'name'      => $f,
            ];

            if ($f == 'country') {
                $field_array['values'] = [];

                $field_array['values'][] = [
                    'label'    => '',
                    'value'    => '',
                    'selected' => false,
                ];

                $countries = get_all_countries();
                foreach ($countries as $country) {
                    $selected = false;
                    if (get_option('customer_default_country') == $country['country_id']) {
                        $selected = true;
                    }
                    array_push($field_array['values'], [
                        'label'    => $country['short_name'],
                        'value'    => (int) $country['country_id'],
                        'selected' => $selected,
                    ]);
                }
            }

            if ($f == 'name') {
                $field_array['required'] = true;
            }

            $_field_object->label    = $label;
            $_field_object->name     = $f;
            $_field_object->fields   = [];
            $_field_object->fields[] = $field_array;
            $db_fields[]             = $_field_object;
        }
        $data['bodyclass'] = 'web-to-lead-form';
        $data['db_fields'] = $db_fields;
        $this->load->view('admin/leads/formbuilder', $data);
    }

    public function forms($id = '')
    {
        if (!is_admin()) {
            access_denied('Web To Lead Access');
        }

        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('web_to_lead');
        }

        $data['title'] = _l('web_to_lead');
        $this->load->view('admin/leads/forms', $data);
    }

    public function delete_form($id)
    {
        if (!is_admin()) {
            access_denied('Web To Lead Access');
        }

        $success = $this->leads_model->delete_form($id);
        if ($success) {
            set_alert('success', _l('deleted', _l('web_to_lead_form')));
        }

        redirect(admin_url('leads/forms'));
    }

    // Sources
    /* Manage leads sources */
    public function sources()
    {
        if (!is_admin()) {
            access_denied('Leads Sources');
        }
        $data['sources'] = $this->leads_model->get_source();
        $data['title']   = 'Leads sources';
        $this->load->view('admin/leads/manage_sources', $data);
    }

    /* Add or update leads sources */
    public function source()
    {
        if (!is_admin() && get_option('staff_members_create_inline_lead_source') == '0') {
            access_denied('Leads Sources');
        }
        if ($this->input->post()) {
            $data = $this->input->post();
            if (!$this->input->post('id')) {
                $inline = isset($data['inline']);
                if (isset($data['inline'])) {
                    unset($data['inline']);
                }

                $id = $this->leads_model->add_source($data);

                if (!$inline) {
                    if ($id) {
                        set_alert('success', _l('added_successfully', _l('lead_source')));
                    }
                } else {
                    echo json_encode(['success' => $id ? true : false, 'id' => $id]);
                }
            } else {
                $id = $data['id'];
                unset($data['id']);
                $success = $this->leads_model->update_source($data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('lead_source')));
                }
            }
        }
    }

    /* Delete leads source */
    public function delete_source($id)
    {
        if (!is_admin()) {
            access_denied('Delete Lead Source');
        }
        if (!$id) {
            redirect(admin_url('leads/sources'));
        }
        $response = $this->leads_model->delete_source($id);
        if (is_array($response) && isset($response['referenced'])) {
            set_alert('warning', _l('is_referenced', _l('lead_source_lowercase')));
        } elseif ($response == true) {
            set_alert('success', _l('deleted', _l('lead_source')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('lead_source_lowercase')));
        }
        redirect(admin_url('leads/sources'));
    }

    // Statuses
    /* View leads statuses */
    public function statuses()
    {
        if (!is_admin()) {
            access_denied('Leads Statuses');
        }
        $data['statuses'] = $this->leads_model->get_status();
        $data['title']    = 'Leads statuses';
        $this->load->view('admin/leads/manage_statuses', $data);
    }

    /* Add or update leads status */
    public function status()
    {
        if (!is_admin() && get_option('staff_members_create_inline_lead_status') == '0') {
            access_denied('Leads Statuses');
        }
        if ($this->input->post()) {
            $data = $this->input->post();
            if (!$this->input->post('id')) {
                $inline = isset($data['inline']);
                if (isset($data['inline'])) {
                    unset($data['inline']);
                }
                $id = $this->leads_model->add_status($data);
                if (!$inline) {
                    if ($id) {
                        set_alert('success', _l('added_successfully', _l('lead_status')));
                    }
                } else {
                    echo json_encode(['success' => $id ? true : false, 'id' => $id]);
                }
            } else {
                $id = $data['id'];
                unset($data['id']);
                $success = $this->leads_model->update_status($data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('lead_status')));
                }
            }
        }
    }

    /* Delete leads status from databae */
    public function delete_status($id)
    {
        if (!is_admin()) {
            access_denied('Leads Statuses');
        }
        if (!$id) {
            redirect(admin_url('leads/statuses'));
        }
        $response = $this->leads_model->delete_status($id);
        if (is_array($response) && isset($response['referenced'])) {
            set_alert('warning', _l('is_referenced', _l('lead_status_lowercase')));
        } elseif ($response == true) {
            set_alert('success', _l('deleted', _l('lead_status')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('lead_status_lowercase')));
        }
        redirect(admin_url('leads/statuses'));
    }

    /* Add new lead note */
    public function add_note($rel_id)
    {
        if (!is_staff_member() || !$this->leads_model->staff_can_access_lead($rel_id)) {
            ajax_access_denied();
        }

        if ($this->input->post()) {
            $data = $this->input->post();

            if ($data['contacted_indicator'] == 'yes') {
                $contacted_date         = to_sql_date($data['custom_contact_date'], true);
                $data['date_contacted'] = $contacted_date;
            }

            unset($data['contacted_indicator']);
            unset($data['custom_contact_date']);

            // Causing issues with duplicate ID or if my prefixed file for lead.php is used
            $data['description'] = isset($data['lead_note_description']) ? $data['lead_note_description'] : $data['description'];

            if (isset($data['lead_note_description'])) {
                unset($data['lead_note_description']);
            }

            $note_id = $this->misc_model->add_note($data, 'lead', $rel_id);

            if ($note_id) {
                if (isset($contacted_date)) {
                    $this->db->where('id', $rel_id);
                    $this->db->update(db_prefix() . 'leads', [
                        'lastcontact' => $contacted_date,
                    ]);
                    if ($this->db->affected_rows() > 0) {
                        $this->leads_model->log_lead_activity($rel_id, 'not_lead_activity_contacted', false, serialize([
                            get_staff_full_name(get_staff_user_id()),
                            _dt($contacted_date),
                        ]));
                    }
                }
            }
        }
        echo json_encode(['leadView' => $this->_get_lead_data($rel_id), 'id' => $rel_id]);
    }

    public function email_integration_folders()
    {
        if (!is_admin()) {
            ajax_access_denied('Leads Test Email Integration');
        }

        app_check_imap_open_function();

        $imap = new Imap(
            $this->input->post('email'),
            $this->input->post('password', false),
            $this->input->post('imap_server'),
            $this->input->post('encryption')
        );

        try {
            echo json_encode($imap->getSelectableFolders());
        } catch (ConnectionErrorException $e) {
            echo json_encode([
                'alert_type' => 'warning',
                'message'    => $e->getMessage(),
            ]);
        }
    }

    public function test_email_integration()
    {
        if (!is_admin()) {
            access_denied('Leads Test Email Integration');
        }

        app_check_imap_open_function(admin_url('leads/email_integration'));

        $mail     = $this->leads_model->get_email_integration();
        $password = $mail->password;

        if (false == $this->encryption->decrypt($password)) {
            set_alert('danger', _l('failed_to_decrypt_password'));
            redirect(admin_url('leads/email_integration'));
        }

        $imap = new Imap(
            $mail->email,
            $this->encryption->decrypt($password),
            $mail->imap_server,
            $mail->encryption
        );

        try {
            $connection = $imap->testConnection();

            try {
                $connection->getMailbox($mail->folder);
                set_alert('success', _l('lead_email_connection_ok'));
            } catch (MailboxDoesNotExistException $e) {
                set_alert('danger', str_replace(["\n", 'Mailbox'], ['<br />', 'Folder'], addslashes($e->getMessage())));
            }
        } catch (ConnectionErrorException $e) {
            $error = str_replace("\n", '<br />', addslashes($e->getMessage()));
            set_alert('danger', _l('lead_email_connection_not_ok') . '<br /><br /><b>' . $error . '</b>');
        }

        redirect(admin_url('leads/email_integration'));
    }

    public function email_integration()
    {
        if (!is_admin()) {
            access_denied('Leads Email Intregration');
        }
        if ($this->input->post()) {
            $data             = $this->input->post();
            $data['password'] = $this->input->post('password', false);

            if (isset($data['fakeusernameremembered'])) {
                unset($data['fakeusernameremembered']);
            }
            if (isset($data['fakepasswordremembered'])) {
                unset($data['fakepasswordremembered']);
            }

            $success = $this->leads_model->update_email_integration($data);
            if ($success) {
                set_alert('success', _l('leads_email_integration_updated'));
            }
            redirect(admin_url('leads/email_integration'));
        }
        $data['roles']    = $this->roles_model->get();
        $data['sources']  = $this->leads_model->get_source();
        $data['statuses'] = $this->leads_model->get_status();

        $data['members'] = $this->staff_model->get('', [
            'active'       => 1,
            'is_not_staff' => 0,
        ]);

        $data['title'] = _l('leads_email_integration');
        $data['mail']  = $this->leads_model->get_email_integration();

        $data['bodyclass'] = 'leads-email-integration';
        $this->load->view('admin/leads/email_integration', $data);
    }

    public function change_status_color()
    {
        if ($this->input->post() && is_admin()) {
            $this->leads_model->change_status_color($this->input->post());
        }
    }

    public function import()
    {
        if (!is_admin() && get_option('allow_non_admin_members_to_import_leads') != '1') {
            access_denied('Leads Import');
        }

        $dbFields = $this->db->list_fields(db_prefix() . 'leads');
        array_push($dbFields, 'tags');

        $this->load->library('import/import_leads', [], 'import');
        $this->import->setDatabaseFields($dbFields)
        ->setCustomFields(get_custom_fields('leads'));

        if ($this->input->post('download_sample') === 'true') {
            $this->import->downloadSample();
        }

        if ($this->input->post()
            && isset($_FILES['file_csv']['name']) && $_FILES['file_csv']['name'] != '') {
            $this->import->setSimulation($this->input->post('simulate'))
                          ->setTemporaryFileLocation($_FILES['file_csv']['tmp_name'])
                          ->setFilename($_FILES['file_csv']['name'])
                          ->perform();

            $data['total_rows_post'] = $this->import->totalRows();

            if (!$this->import->isSimulation()) {
                set_alert('success', _l('import_total_imported', $this->import->totalImported()));
            }
        }

        $data['statuses'] = $this->leads_model->get_status();
        $data['sources']  = $this->leads_model->get_source();
        $data['members']  = $this->staff_model->get('', ['is_not_staff' => 0, 'active' => 1]);

        $data['title'] = _l('import');
        $this->load->view('admin/leads/import', $data);
    }

    public function validate_unique_field()
    {
        if ($this->input->post()) {

            // First we need to check if the field is the same
            $lead_id = $this->input->post('lead_id');
            $field   = $this->input->post('field');
            $value   = $this->input->post($field);

            if ($lead_id != '') {
                $this->db->select($field);
                $this->db->where('id', $lead_id);
                $row = $this->db->get(db_prefix() . 'leads')->row();
                if ($row->{$field} == $value) {
                    echo json_encode(true);
                    die();
                }
            }

            echo total_rows(db_prefix() . 'leads', [ $field => $value ]) > 0 ? 'false' : 'true';
        }
    }

    public function bulk_action()
    {
        if (!is_staff_member()) {
            ajax_access_denied();
        }

        hooks()->do_action('before_do_bulk_action_for_leads');
        $total_deleted = 0;
        if ($this->input->post()) {
            $ids                   = $this->input->post('ids');
            $status                = $this->input->post('status');
            $source                = $this->input->post('source');
            $assigned              = $this->input->post('assigned');
            $visibility            = $this->input->post('visibility');
            $tags                  = $this->input->post('tags');
            $last_contact          = $this->input->post('last_contact');
            $lost                  = $this->input->post('lost');
            $has_permission_delete = has_permission('leads', '', 'delete');
            if (is_array($ids)) {
                foreach ($ids as $id) {
                    if ($this->input->post('mass_delete')) {
                        if ($has_permission_delete) {
                            if ($this->leads_model->delete($id)) {
                                $total_deleted++;
                            }
                        }
                    } else {
                        if ($status || $source || $assigned || $last_contact || $visibility) {
                            $update = [];
                            if ($status) {
                                // We will use the same function to update the status
                                $this->leads_model->update_lead_status([
                                    'status' => $status,
                                    'leadid' => $id,
                                ]);
                            }
                            if ($source) {
                                $update['source'] = $source;
                            }
                            if ($assigned) {
                                $update['assigned'] = $assigned;
                            }
                            if ($last_contact) {
                                $last_contact          = to_sql_date($last_contact, true);
                                $update['lastcontact'] = $last_contact;
                            }

                            if ($visibility) {
                                if ($visibility == 'public') {
                                    $update['is_public'] = 1;
                                } else {
                                    $update['is_public'] = 0;
                                }
                            }

                            if (count($update) > 0) {
                                $this->db->where('id', $id);
                                $this->db->update(db_prefix() . 'leads', $update);
                            }
                        }
                        if ($tags) {
                            handle_tags_save($tags, $id, 'lead');
                        }
                        if ($lost == 'true') {
                            $this->leads_model->mark_as_lost($id);
                        }
                    }
                }
            }
        }

        if ($this->input->post('mass_delete')) {
            set_alert('success', _l('total_leads_deleted', $total_deleted));
        }
    }

    public function download_files($lead_id)
    {
        if (!is_staff_member() || !$this->leads_model->staff_can_access_lead($lead_id)) {
            ajax_access_denied();
        }

        $files = $this->leads_model->get_lead_attachments($lead_id);

        if (count($files) == 0) {
            redirect($_SERVER['HTTP_REFERER']);
        }

        $path = get_upload_path_by_type('lead') . $lead_id;

        $this->load->library('zip');

        foreach ($files as $file) {
            $this->zip->read_file($path . '/' . $file['file_name']);
        }

        $this->zip->download('files.zip');
        $this->zip->clear_data();
    }

    // In Leads.php

    public function add_message() {

        if ($this->input->is_ajax_request()) {

            $this->load->library('email');

            $email = $this->input->post('email');
            $body = $this->input->post('body');
            $subject = $this->input->post('subject');
            $lead_id = $this->input->post('lead_id');

            $lead = $this->leads_model->get($lead_id);

            $emailAt = explode("@",get_option("smtp_email"))[1]; 

            $this->email->initialize();
            $this->email->reply_to("proposals+l_id".$lead_id."@".$emailAt, 'Proposals Management');
            $this->email->from("proposals@".$emailAt, get_option('companyname'));
            $this->email->to($email);

            $this->email->initialize();
            $this->email->reply_to("proposals+l_id".$lead_id."@".$emailAt, 'Proposals Management');
            $this->email->from("proposals@".$emailAt, get_option('companyname'));
            $this->email->to($email);

            $this->email->subject("Hey ".$lead->name.", Here is the lead update");

            $this->email->message(get_option('email_header') . $body . get_option('email_footer'));

            $email_message_id = $this->leads_model->get_email_id($lead_id)['email_message_id'];

            if($email_message_id){
                $email_message_id = substr($email_message_id, 1);
                $email_message_ids = explode('|', $email_message_id);

                if($email_message_ids){
                    // Preparing the References string with all the email IDs separated by a space
                    $references = implode(' ', $email_message_ids);
                    
                    // Setting the headers
                    $this->email->set_header('References', $references);
                    $this->email->set_header('In-Reply-To', end($email_message_ids));
                }
            }

            $this->email->set_header('X-SES-CONFIGURATION-SET', 'ZikraLeadInbox');
            $this->email->set_header('lead_id', $lead_id);

            $email_sent = $this->email->send(false);


            // Check if the campaign was added successfully
            if ($email_sent) {

                // Get the form data from the AJAX request
                $data = array(
                    'lead_id' => $lead_id,
                    'subject' => $subject,
                    'body' => $body,
                    'sent_by' => 'admin',
                    'sent_by_id' => get_staff_user_id(),
                    'created_at' => date('Y-m-d H:i:s')
                );
        
                // Add the new campaign to the database using the model
                $message_id = $this->leads_model->add_message($data);

                if($message_id){
                    echo json_encode(array('success' => true, 'message' => 'Message added successfully.'));
                }else{
                    echo json_encode(array('success' => false, 'message' => 'Failed to add the Message.'));

                }

            } else {
                echo json_encode(array('success' => false, 'message' => 'Failed to mail!', 'error'=>$this->email->print_debugger()));
            }
        } else {
            show_error('No direct script access allowed.');
        }
    }

    function truncateReply($original) {
        $markers = array(
            'On Mon,', 'On Tue,', 'On Wed,', 'On Thu,', 'On Fri,', 'On Sat,', 'On Sun,',
            'On Monday,', 'On Tuesday,', 'On Wednesday,', 'On Thursday,', 'On Friday,', 'On Saturday,', 'On Sunday,',
            '-----Original Message-----'
            // Add more markers as needed
        );
    
        foreach ($markers as $marker) {
            $pos = strpos($original, $marker);
            if ($pos !== false) {
                return trim(substr($original, 0, $pos));
            }
        }
    
        // If no marker was found, return the whole message
        return $original;
    }

    public function capture_lead_reply_skip_auth(){

        $data = json_decode(file_get_contents('php://input'), true);

        $body = $data['body'];
        $subject = $data['subject'];
        $lead_id = $data['lead_id'];
        $message_id = $data['message_id'];

        $message = str_replace("\\n", "\n", $message);
        $message = str_replace("\\r", "\r", $message);
        $message = nl2br($message);

        $message = $this->truncateReply($message);

        $this->leads_model->set_lead_message_id($lead_id, $message_id);

        $data = array(
            'lead_id' => $lead_id,
            'subject' => $subject,
            'body' => $body,
            'sent_by' => 'lead',
            'sent_by_id' => $lead_id,
            'created_at' => date('Y-m-d H:i:s')
        );

        // Add the new campaign to the database using the model
        $message_id = $this->leads_model->add_message($data);

        if($message_id){
            echo json_encode(array('success' => true, 'message' => 'Message added successfully.'));
            //Send mails to all assigned staff members / Pausing for now since I dont have multiple staff members assigned functionality
        }else{
            echo json_encode(array('success' => false, 'message' => 'Failed to add the Message.'));

        }
    }

    public function compose_context($lead_id, $model , $prompt = null){

        $staff = $this->staff_model->get(get_staff_user_id());
        $staff_fullname = $staff->firstname . ' '.$staff->lastname;


        $messages = $this->leads_model->get_messages($lead_id);
        $lead_name = $this->leads_model->get($lead_id)->name;
  
        // Truncate the array, ignoring the system prompt
        $messages = array_slice($messages, 0, 3);
        $messages = array_reverse($messages);

        $messages_array = [];

        $systemPrompt = "";

        if(count($messages) > 0){
            $systemPrompt .= "Here is the context:";
            foreach($messages as $message){
                $body = Strip_tags($message["body"]);

                if($message["sent_by"] == "lead"){
                    $systemPrompt .=  $lead_name." said ``".$body."``. ";
                }else if($message["sent_by"] == "admin"){
                    $systemPrompt .=  "I said ``".$body."``. ";
                }
                
            }
        }
        $subjectPrompt = $systemPrompt;

        if($prompt){
            $systemPrompt = ' '.$prompt.'. '.$systemPrompt;
        }

        $subjectPrompt = "I want you to generate me a subject for my next message." . $subjectPrompt;
        $systemPrompt = "I am ".$staff_fullname.". I want you to generate me body of email to my lead, Use HTML tags for formatting." . $systemPrompt;


        $messages_array[] = ['role' => 'system', 'content' => $systemPrompt];
        $messages_array_subject[] = ['role' => 'system', 'content' => $subjectPrompt];

        $body = $this->makeAIRequest($messages_array, $model, 700);
        $subject = $this->makeAIRequest($messages_array_subject, "gpt-3.5-turbo", 40);

        echo json_encode(['success' => true, 'subject' =>$subject, 'body' => $body]);
    }

    public function proposalAIRequest($proposal_id, $model, $prompt=null){
        $this->load->model("proposals_model");
        $this->load->model("staff_model");

        $proposal = $this->proposals_model->get($proposal_id);

        if($proposal->status != "4" && $proposal->rel_type=="lead"){

            $staff = $this->staff_model->get(get_staff_user_id());
            $staff_fullname = $staff->firstname . ' '.$staff->lastname;

            $lead_name = $this->leads_model->get($proposal->rel_id)->name;

            $subject = $proposal->subject;
            $link = base_url("proposal/".$proposal_id."/".$proposal->hash);
        
            $bodyMessage = "I am ".$staff_fullname.". I want you to generate me body of email to my lead, I want to send ".$lead_name." a proposal. Subject of the proposal is ```".$subject."``` and link to the proposal is: ```".$link."``` \n Make sure to give me the body of the email in html format with proper spaces and newlines. Please add link in <a> tag.";

            if($prompt){
                $bodyMessage .= $prompt;
            }

            $body_flow[] = ['role' => 'system', 'content' => $bodyMessage];
            $subject_flow[] = ['role' => 'system', 'content' => 'I want you to generate me subject for my email to my lead. I want to send him proposal with subject ```'.$subject.'```'];


            $body = $this->makeAIRequest($body_flow, $model, 700);
            $subject = $this->makeAIRequest($subject_flow, "gpt-3.5-turbo", 40);

            echo json_encode(['success' => true, 'subject' =>$subject, 'body' => $body]);
        }
    }

    public function eventAIRequest($event_id, $model, $prompt=null){
        $this->load->model("staff_model");

        $event = $this->leads_model->get_event($event_id);

        if($event->status != "1"){

            $staff = $this->staff_model->get(get_staff_user_id());
            $staff_fullname = $staff->firstname . ' '.$staff->lastname;

            $lead_name = "John Doe";

            $subject = $event->event_name;
            $link = $event->meet_schedule_link;
        
            $bodyMessage = "I am ".$staff_fullname.". I want you to generate me body of email to my lead, I want to send ".$lead_name." an event invite. Subject of the meeting is ```".$subject."``` and link to the schedule is: ```".$link."``` \n Make sure to give me the body of the email in html format with proper spaces and newlines. Please add link in <a> tag.";

            if($prompt){
                $bodyMessage .= $prompt;
            }

            $body_flow[] = ['role' => 'system', 'content' => $bodyMessage];
            $subject_flow[] = ['role' => 'system', 'content' => 'I want you to generate me subject for my email to my lead. I want to send him an event invitation with subject ```'.$subject.'```'];


            $body = $this->makeAIRequest($body_flow, $model, 700);
            $subject = $this->makeAIRequest($subject_flow, "gpt-3.5-turbo", 40);

            echo json_encode(['success' => true, 'subject' =>$subject, 'body' => $body]);
        }
    }

    

    public function makeAIRequest($message_array, $model, $max_token){

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer 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'
        ];
    
        $data = [
            'model' => $model,
            'messages' => $message_array,
            'max_tokens' => $max_token,
            'temperature' => 0.8,
            'top_p' => 0.8,
        ];
    
        $ch = curl_init('https://api.openai.com/v1/chat/completions');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    
        $response = curl_exec($ch);
        curl_close($ch);
    
        $response_data = json_decode($response, true);
        // $gpt_response = $response_data['choices'][0]['message']['content'];
        
        return $response_data;
    }

    public function send_proposal_status($id){
        $this->load->model("proposals_model");
        if($this->proposals_model->send_proposal_to_email($id)){
            echo json_encode(['success'=>true]);
        }else{
            echo json_encode(['success'=>false]);
        } 
    }

    //Territory Builder Stuff
    public function get_counties() {
        $searchTerm = $this->input->get('query'); 
        $results = $this->leads_model->search_counties($searchTerm);

        $response = [];
        foreach ($results as $result) {
            $response[] = ['name' => $result['county_name'], 'fips' => $result['county_fips']];
        }

        echo json_encode($response);
    }

    public function get_zips(){
        $countyFIPS = $this->input->get('countyFIPS');
        $results = $this->leads_model->search_zipcodes($countyFIPS);

        $response = [];
        foreach ($results as $result) {
            $response[] = ['zip' => $result["zip"], 'city' => $result["city"]];
        }

        echo json_encode($response);
    }

    public function get_stats(){
        $censusAPI = '15523c7a6cf114697f193339f376b599cc9bbbab'; //Census API Key
        $placesAPI = 'AIzaSyD0_-K6RCtt2KzvvwXg-e_pFX6VST1yHto';

        $zipCodes = $this->input->get('zipCodes');
        
        $fields = [
            "B01003_001E", "B01001_002E", "B01001_026E", // Total, Male, Female
            "B01001_003E", "B01001_027E", // Under 5 years old
            "B01001_004E", "B01001_005E", "B01001_006E", "B01001_007E", "B01001_008E", "B01001_009E", "B01001_010E", "B01001_011E", "B01001_012E", "B01001_013E", "B01001_014E", "B01001_028E", "B01001_029E", "B01001_030E", "B01001_031E", "B01001_032E", "B01001_033E", "B01001_034E", "B01001_035E", "B01001_036E", "B01001_037E", "B01001_038E", // Under 18
            "B01001_022E", "B01001_023E", "B01001_024E", "B01001_047E", "B01001_048E", "B01001_049E", // 65 and over
            "B02001_002E", "B02001_003E", "B02001_005E", "B02001_006E", "B02001_008E", "B02001_009E", // Races
            "B03001_003E" // Hispanic
        ];
        $zipCodesString = implode(",", $zipCodes);
        $fieldsString = implode(",", $fields);

        $url = "https://api.census.gov/data/2021/acs/acs5?get=NAME,$fieldsString&for=zip%20code%20tabulation%20area:$zipCodesString&key=$censusAPI";

        $response = file_get_contents($url);
        $response = json_decode($response, true);
        $headers = array_shift($response);

        $combinedMetrics = [
            'Total Population' => 0,
            'Total Hospitals' => 0,
            '% Male' => 0,
            '% Female' => 0,
            '% Under 5 Years Old' => 0,
            '% Under 18 Years Old' => 0,
            '% 21 Years and Over' => 0,
            '% Working Age (25 to 64)' => 0,
            '% 65 and Over' => 0,
            '% White' => 0,
            '% Black or African American' => 0,
            '% Asian' => 0,
            '% Native Hawaiian' => 0,
            '% Some Other Race' => 0,
            '% Two or More Races' => 0,
            '% Hispanic (of Any Race)' => 0
        ];

        // Initialization
        $totalPopulation = $totalMales = $totalFemales = $totalUnder5 = $totalUnder18 = $total65AndOver = $totalWhite = $totalBlack = $totalAsian = $totalNativeHawaiian = $totalOtherRace = $totalTwoOrMoreRaces = $totalHispanic = 0;

        // Iterating over the response and processing each row
        foreach ($response as $row) {
            $totalPopulation += $row[1];
            $totalMales += $row[2];
            $totalFemales += $row[3];
            $totalUnder5 += $row[4] + $row[5];
            $totalUnder18 += array_sum(array_slice($row, 6, 21));
            $total65AndOver += array_sum(array_slice($row, 27, 6));
            $totalWhite += $row[34];
            $totalBlack += $row[35];
            $totalAsian += $row[33];
            $totalNativeHawaiian += $row[36];
            $totalOtherRace += $row[37];
            $totalTwoOrMoreRaces += $row[38];
            $totalHispanic += $row[39];
        }

        $combinedMetrics['Total Population'] = $totalPopulation;
        $combinedMetrics['% Male'] = ($totalMales / $totalPopulation) * 100;
        $combinedMetrics['% Female'] = ($totalFemales / $totalPopulation) * 100;
        $combinedMetrics['% Under 5 Years Old'] = ($totalUnder5 / $totalPopulation) * 100;
        $combinedMetrics['% Under 18 Years Old'] = ($totalUnder18 / $totalPopulation) * 100;
        $combinedMetrics['% 21 Years and Over'] = ((($totalPopulation - $totalUnder18) / $totalPopulation) * 100) - ($total65AndOver / $totalPopulation * 100);
        $combinedMetrics['% Working Age (25 to 64)'] = ($totalPopulation - ($totalUnder5 + $totalUnder18 + $total65AndOver)) / $totalPopulation * 100;
        $combinedMetrics['% 65 and Over'] = ($total65AndOver / $totalPopulation) * 100;
        $combinedMetrics['% White'] = ($totalWhite / $totalPopulation) * 100;
        $combinedMetrics['% Black or African American'] = ($totalBlack / $totalPopulation) * 100;
        $combinedMetrics['% Asian'] = ($totalAsian / $totalPopulation) * 100;
        $combinedMetrics['% Native Hawaiian'] = ($totalNativeHawaiian / $totalPopulation) * 100;
        $combinedMetrics['% Some Other Race'] = ($totalOtherRace / $totalPopulation) * 100;
        $combinedMetrics['% Two or More Races'] = ($totalTwoOrMoreRaces / $totalPopulation) * 100;
        $combinedMetrics['% Hispanic (of Any Race)'] = ($totalHispanic / $totalPopulation) * 100;


        $newFields = [
            "B19013_001E", // Median Household Income
            "B25003_002E", "B25003_003E", // Owner occupied, Renter occupied
            "B11001_001E", "B11001_007E", // Households, Single-person households
            "B01001_022E", "B01001_023E", "B01001_024E", // 65 and over
            "B23025_005E", "B23025_002E", // Unemployed, Labor force
            // Add any additional required fields
        ];
    
        $newFieldsString = implode(",", $newFields);
    
        $urlNew = "https://api.census.gov/data/2021/acs/acs5?get=NAME,$newFieldsString&for=zip%20code%20tabulation%20area:$zipCodesString&key=$censusAPI";
    
        $responseNew = file_get_contents($urlNew);
        $responseNew = json_decode($responseNew, true);
        // Assuming the headers follow the same pattern
        array_shift($responseNew);
    
        // Initialization for the new metrics
        $totalIncome = $totalIncomeDivision = $totalOwnerOccupied = $totalRenterOccupied = $totalHouseholds = $totalSinglePersonHouseholds = $totalUnemployed = $totalLaborForce = 0;
    
        // Iterating over the new response and processing each row
        foreach ($responseNew as $row) {
            if($row[1] > 0){
                $totalIncome += $row[1];
                $totalIncomeDivision += 1;
            }
            
            $totalOwnerOccupied += $row[2];
            $totalRenterOccupied += $row[3];
            $totalHouseholds += $row[4];
            $totalSinglePersonHouseholds += $row[5];
            $total65AndOver += array_sum(array_slice($row, 6, 3)); // Update as this was already declared earlier
            $totalUnemployed += $row[9];
            $totalLaborForce += $row[10];
        }
    
        // Calculating new metrics and adding them to the `combinedMetrics` object
        $combinedMetrics['Median Income'] = ($totalIncomeDivision > 0) ? $totalIncome / $totalIncomeDivision : 0; // Average median income across all ZIPs
        $combinedMetrics['% Owned Houses'] = ($totalOwnerOccupied / ($totalOwnerOccupied + $totalRenterOccupied)) * 100;
        $combinedMetrics['% Rented Houses'] = 100 - $combinedMetrics['% Owned Houses']; // Or ($totalRenterOccupied / ($totalOwnerOccupied + $totalRenterOccupied)) * 100;
        $combinedMetrics['% Single-Person Households'] = ($totalSinglePersonHouseholds / $totalHouseholds) * 100;
        $combinedMetrics['% Families'] = 100 - $combinedMetrics['% Single-Person Households'];
        $combinedMetrics['% Unemployed'] = ($totalUnemployed / $totalLaborForce) * 100;



        foreach($zipCodes as $zip) {
            $geocodeUrl = "https://maps.googleapis.com/maps/api/geocode/json?address=$zip&key=$placesAPI";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $geocodeUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
            $geocodeResponse = curl_exec($ch);
            $geocodeData = json_decode($geocodeResponse, true);
            if (isset($geocodeData['results'][0]['geometry']['location'])) {
                $lat = $geocodeData['results'][0]['geometry']['location']['lat'];
                $lng = $geocodeData['results'][0]['geometry']['location']['lng'];
                $radius = 15000;
                $url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=$lat,$lng&radius=$radius&type=hospital&key=$placesAPI";
                curl_setopt($ch, CURLOPT_URL, $url);
                $response = curl_exec($ch);
                $places = json_decode($response, true);
                if (isset($places['results'])) {
                    $hospitalCount = count($places['results']);
                    $combinedMetrics['Total Hospitals'] += $hospitalCount;
                }
            }
            curl_close($ch);
        }


        echo json_encode($combinedMetrics);

    }

    public function save_territory() {
        $territoryData = json_decode($_POST['territoryData'], true); 
        $territoryId = $_POST['territory_id'] ?? null;

        // Extract data from POST request
        $title = $territoryData['title'];
        $population = $territoryData['population'];
        $value = ($territoryData['value']) ?? 0;

        if ($territoryId) {

            $result = $this->leads_model->update_territory($territoryId, [
                'title' => $title,
                'population' => $population,
                'value' => $value,
                'data' => json_encode($territoryData),
                'created_at' => date("Y-m-d H:i:s")
            ]);
        }else{
            $result = $this->leads_model->add_territory([
                'title' => $title,
                'population' => $population,
                'value' => $value,
                'data' => json_encode($territoryData),
                'created_at' => date("Y-m-d H:i:s")
            ]);
        }
        
        
    
         if ($result) {
             echo json_encode(['success' => true]);
         } else {
             echo json_encode(['success' => false]);
         }
    }

    // Inside your Controller
    public function serveGeoJson() {
        $filePath = APPPATH . 'views/admin/leads/territory/geoJson.json';

        if (file_exists($filePath)) {
            $data = file_get_contents($filePath);
            $this->output
                ->set_content_type('application/json')
                ->set_output($data);
        } else {
            show_404();
        }
    }

    public function save_current_step() { 
       $step = $this->input->post('step');
       $lead_id = $this->input->post('lead_id');
       
       $result = $this->leads_model->update_step($lead_id, $step);
     
        //Send a response back to the JavaScript
        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }
    
    
}
