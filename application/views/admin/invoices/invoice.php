<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <?php
            echo form_open($this->uri->uri_string(), ['id' => 'invoice-form', 'class' => '_transaction_form invoice-form']);
            if (isset($invoice)) {
                echo form_hidden('isedit');
            }
            ?>
            <div class="col-md-12">
                <h4
                    class="tw-mt-0 tw-font-semibold tw-text-lg tw-text-neutral-700 tw-flex tw-items-center tw-space-x-2">
                    <span>
                        <?php echo isset($invoice) ? format_invoice_number($invoice) : _l('create_new_invoice'); ?>
                    </span>
                    <?php echo isset($invoice) ? format_invoice_status($invoice->status) : ''; ?>
                </h4>
                <?php $this->load->view('admin/invoices/invoice_template'); ?>
            </div>
            <?php echo form_close(); ?>
            <?php $this->load->view('admin/invoice_items/item'); ?>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script>
$(function() {
    // validate_invoice_form();
    // Init accountacy currency symbol
    init_currency();
    // Project ajax search
    init_ajax_project_search_by_customer_id();
    // Maybe items ajax search
    init_ajax_search('items', '#item_select.ajax-search', undefined, admin_url + 'items/search');
});

$(document).ready(function() {
    // Initially hide both forms
    toggleClientOrLead();

    // Toggle dropdown based on the selected type
    $('#typeSelector').change(function() {
        toggleClientOrLead();
        clearValues();
    });

    function toggleClientOrLead() {
        var type = $('#typeSelector').val();
        if(type == 'customer') {
            $('#customerForm').show();
            $('#leadForm').hide();
        } else if(type == 'lead') {
            $('#leadForm').show();
            $('#customerForm').hide();
        } else {
            $('#customerForm').hide();
            $('#leadForm').hide();
        }
    }

    function clearValues() {
        if($('#typeSelector').val() == 'customer') {
            $("#invoice_lead_dropdown").val('').trigger('change');
        } else if($('#typeSelector').val() == 'lead') {
            $("#clientid").val('').trigger('change');
        }
    }

    // If you need this script loading check, you can keep it.
    console.log("Script loaded!");
});

function init_ajax_lead_dropdown() {
    $.get(admin_url + 'leads/get_all_leads', function(response) {
        var leads = JSON.parse(response);
        var $leadSelect = $('#invoice_lead_dropdown');
        var selectedLead = $leadSelect.data('selected'); // Get the lead ID to be selected

        $leadSelect.empty(); // Clear current options
        
        $leadSelect.append('<option value=""></option>');
        $.each(leads, function(i, lead) {
            var isSelected = (lead.id == selectedLead) ? 'selected' : ''; // Check if this lead should be selected
            $leadSelect.append('<option value="' + lead.id + '" ' + isSelected + '>' + lead.name + '</option>');
        });
    });
}


// Call the function when the document is ready:
$(function() {
    init_ajax_lead_dropdown();
});


</script>
</body>

</html>