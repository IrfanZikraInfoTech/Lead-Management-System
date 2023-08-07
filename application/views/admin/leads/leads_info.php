<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<!-- <style>
    .modal-backdrop{
        display: none !important;
    }
    .data{
        overflow: hidden;
    }

</style> -->
<div id="wrapper">
    <div class="content">
        <div class="lead-info-container">
            <div class="lead-details">
                    <div class="lead-image tw-mr-0">
                    <img src="<?= base_url('assets/images/a.jpg')?> " width="100%" height="100%" class="lead-image image-circle"  alt="" " />                
                    </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="lead-data">
                            <h3 class="tw-mt-3">Maryam</h3>
                            <div class="d-flex align-items-center">
                                <span class="tw-mr-2" style="font-weight:bold; font-size:15px;">Status:</span>
                                <select name="status" class="custom-select">
                                    <option value="customer">Customer</option>
                                    <option value="lead">Lead</option>
                                    <option value="abc">ABC</option>
                                </select>
                            </div>
                            <div class="tw-mt-3">
                                <span class="lead-email ">lead@email.com,</span>
                                <span class="lead-contact tw-ml-2">+123 456 7890,</span>
                                <span class="lead-location tw-ml-2">City, Country</span>
                            </div>                   
                        </div>
                    </div>
                    <div class="col-md-3 tw-mt-4 tw-p-0 tw-m-0">
                        <button class="convert-btn" id="convert-btn">Convert To Customer</button>    
                    </div>    
                </div>
            </div>
        </div>
    

        <div class="row tw-mt-5">
            <div class="col-md-4">
                <div class="lead-container tw-mt-5 tw-mb-5">
                    <h2>Lead Information</h2>
                    
                    <div class="lead-attributes tw-mt-4">
                        <div class="lead-attribute">
                            <span class="attribute-title">Lead Score</span>
                            <hr>
                            <span class="attribute-value">85</span>
                        </div>
                        <div class="lead-attribute">
                            <span class="attribute-title">Lead Quality</span>
                            <hr>
                            <span class="attribute-value">High</span>
                        </div>
                        <div class="lead-attribute">
                            <span class="attribute-title">Lead Value</span>
                            <hr>
                            <span class="attribute-value">$1000</span>
                        </div>
                    </div>

                    <hr>
                    <div class="lead-info tw-mt-5">
                        <div class="detail-row">
                            <span class="detail-title">Name:</span>
                            <span class="detail-value">John Doe</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-title">Position:</span>
                            <span class="detail-value">Senior Developer</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-title">Email Address:</span>
                            <span class="detail-value">johndoe@example.com</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-title">Contact:</span>
                            <span class="detail-value">+1 123 456 7890</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-title">Company:</span>
                            <span class="detail-value">XYZ Solutions</span>
                        </div>       
                        <div class="detail-row">
                            <span class="detail-title">Address:</span>
                            <span class="detail-value">123 Main St, Anytown, USA, 12345</span>
                        </div> 
                        <div class="detail-row">
                            <span class="detail-title">City:</span>
                            <span class="detail-value">Anytown</span>
                        </div>        
                        <div class="detail-row">
                            <span class="detail-title">State:</span>
                            <span class="detail-value">California</span>
                        </div> 
                        <div class="detail-row">
                            <span class="detail-title">Country:</span>
                            <span class="detail-value">United States</span>
                        </div>                        
                        <div class="detail-row">
                            <span class="detail-title">Zip Code:</span>
                            <span class="detail-value">123</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-title">Description</span>
                            <span class="detail-value">-</span>
                        </div>
                    </div>    
                </div>
            </div>

 
            <div class="col-md-8 p-0">
                <div class="lead-container tw-mt-5">
                    <ul class="nav nav-tabs" id="leadTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="proposals-tab" data-toggle="tab" href="#proposals" role="tab" aria-controls="proposals" aria-selected="false">Proposals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tasks-tab" data-toggle="tab" href="#tasks" role="tab" aria-controls="tasks" aria-selected="false">Tasks</a>
                        </li>                        
                        <li class="nav-item">
                            <a class="nav-link" id="attachments-tab" data-toggle="tab" href="#attachments" role="tab" aria-controls="attachments" aria-selected="false">Attachments</a>
                        </li>                        
                        <li class="nav-item">
                            <a class="nav-link" id="reminders-tab" data-toggle="tab" href="#reminders" role="tab" aria-controls="reminders" aria-selected="false">Reminders</a>
                        </li>                        
                        <li class="nav-item">
                            <a class="nav-link" id="notes-tab" data-toggle="tab" href="#notes" role="tab" aria-controls="notes" aria-selected="false">Notes</a>
                        </li>                        
                        <li class="nav-item">
                            <a class="nav-link" id="activity-tab" data-toggle="tab" href="#activity" role="tab" aria-controls="activity" aria-selected="false">Activity</a>
                        </li>                    
                    </ul>

                    <div class="tab-content" id="leadTabContent">
                        <div class="tab-pane fade active" id="proposals" role="tabpanel" aria-labelledby="proposals-tab">
                        <h4>All your Proposals</h4>
                        </div>
                        
                        <div class="tab-pane fade" id="tasks" role="tabpanel" aria-labelledby="tasks-tab">
                        <h4>Your Tasks</h4>
                        </div>
                        
                        <div class="tab-pane fade" id="attachments" role="tabpanel" aria-labelledby="attachments-tab">
                        <h4>Here goes your Attachments </h4>
                        </div>
                        
                        <div class="tab-pane fade" id="reminders" role="tabpanel" aria-labelledby="reminders-tab">
                        <h4>Reminders For You</h4>
                        </div>
                        
                        <div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notes-tab">
                        <h4>Your Notes</h4>
                        </div>
                        
                        <div class="tab-pane fade" id="activity" role="tabpanel" aria-labelledby="activity-tab">
                        <h4>Your Activities</h4>
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
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f6f8;
    }

    .lead-info-container {
        display: flex;
        flex-direction: column;
        padding-top:0px;
        padding: 15px;
        border: 1px solid #f0f0f0;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        background-color: #bde0fe;

    }

    .lead-details {
        display: flex;
        align-items: left;
    }

    .lead-image {
        margin-right: 14px;
        margin-left:10px
    }

    .lead-image img {
        border-radius: 50%; 
        width: 80px;
        height: 80px;
        object-fit: cover; 
        margin-top:10px
    
    }

    .row{
        width: 100%;
    } 

    .lead-data h3 {
        font-size: 24px;
        margin-bottom: 10px;
        font-weight: bold;
        color: #333;
    }

    .custom-select {
        padding: 5px 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 14px;
        outline: none;
        transition: border-color 0.2s;
    }

    .custom-select:hover {
        border-color: #999;
    }

    .lead-email, .lead-contact, .lead-location {
        font-size: 14px;
        color: #555;
    }

    .actions {
        margin-left: 20px;
    }

    .convert-btn {
        background-color: #007BFF;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
    }

    .convert-btn:hover {
        background-color: #0056b3;
    }

    .lead-container{
        display: flex;
        flex-direction: column;
        padding: 15px;
        border: 1px solid #f0f0f0;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        background-color: #f9f9f9;
    }

    h2 {
        font-size: 24px;
        color: #333;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .lead-attributes {
        display: flex;
        justify-content: space-between;
    }

    .lead-attribute {
        width: 30%;
        text-align: center;
    }

    .attribute-title {
        font-size: 16px;
        color: #555;
    }

    .attribute-value {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        float:center;
    }

    hr {
        border-top: 1px solid #ddd;
        margin: 8px 0;
    }

    .lead-info {
        width: 100%;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size:15px
    }

    .detail-title, .detail-value {
        margin: 0; 
        padding: 0; 
    }

    .detail-title {
        font-weight: bold;
    }
    .nav-tabs {
        border-bottom: none;
    }

        
    .nav-link {
        font-size: 18px;
        padding: 6px 8px;
        margin: 0; 
    }

    .nav-link.active {
        color: #333;
        border-bottom: 2px solid #007BFF;
        font-weight: 500;
    }

    .nav-link:hover {
        color: #555;
    }

    .tab-content {
        padding: 20px;
        background: #fff;
        border-radius: 5px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        margin-top: 15px;
        margin-bottom:15px
    }

</style>