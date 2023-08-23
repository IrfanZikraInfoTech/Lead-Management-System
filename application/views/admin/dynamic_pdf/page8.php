<style>

.header-text {
        font-size: 16px;
        font-weight: bold;
        color: #777;
        text-transform: uppercase;
        padding: 0;
    }
    .header-logo {
        padding: 0;
    }
    .header-separator {
        padding: 0;

    }
    .main-heading {
        font-size: 24px;
        font-weight: bold;
        color: #5aba4a;
        text-align: center;
        padding: 10px 0;
        letter-spacing: 1.1;

    }
    .sub-heading {
        font-size: 20px;
        font-weight: normal;
        color: #555;
        text-align: center;
        padding: 5px 10px;
        font-style: italic;

    }
    .card {
        flex: 1; /* Each card occupies equal space */
        border: 1px solid #ddd;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: space-between; /* Distribute space inside each card */
    }
    .card-heading {
        font-size: 22px;
        color: #fff;
        font-weight: bold;
        margin-bottom: 10px; /* Add margin between heading and data */
    }
    .card-data {
        font-size: 16px;
        color: #fff;
    }
    .card-green {
        background-color: #5aba4a;
    }
    .card-blue {
        background-color: #00bbf9;
    }
</style>


<!-- !-- header -->

<table width="100%">
    <tr>
        <td class="header-text" style="text-align:left; width: 70%;">
        <p>
        SECTION:2 'SOLUTION AND SERVICES'
        </p>      
        </td>
        <td class="header-logo" style="text-align:right; width: 30%;">
            <img src="<?= base_url('assets/images/360logo.png')?>" width="20%" height="10%" />
        </td>
    </tr>
</table>
<hr class="header-separator">

<!-- header code end-->

<table width="100%" style="text-align:center;">
    <tr>
        <td>
            <h1 class="main-heading">PRODUCTS & SERVICES</h1>
            <h3 class="sub-heading">"Holistic Health Services for a Healthier Tomorrow"</h3>
        </td>
    </tr>
</table>


<table style="margin-top:5%" >
    <tr style="margin-bottom:3%">
        <td class="card card-blue">
            <div class="card-heading">Transitional Care Management:</div>
            <br>
            <div class="card-data">Coordinated and comprehensive care for patients discharged from an acute facility.</div>
        </td>
        <td class="card card-green">
            <div class="card-heading">Remote Patient Monitoring:</div>
            <br>
            <div class="card-data">Ongoing oversight of relevant data such as blood pressure, glucose, pulse, SpO2, and weight to promote optimal health</div>
        </td>
        <td class="card card-blue">
            <div class="card-heading">Behavioral Health Integration:</div>
            <br>
            <div class="card-data">Behavioral health services enable us to treat the whole person–mind, body, and spirit–as part of our primary care.</div>
        </td>
    </tr>

    <tr>
        <td class="card card-green">
            <div class="card-heading">Annual Wellness Visit:</div>
            <br>
            <div class="card-data">A proactive way for patients to remain educated and self-aware about their health and well-being.</div>
        </td>
        <td class="card card-blue">
            <div class="card-heading">Chronic Care Management:</div>
            <br>
            <div class="card-data">A comprehensive care plan to help patients achieve their quality-of-life goals.</div>
        </td>
        <td class="card card-green">
            <div class="card-heading">Primary Care Visits:</div>
            <br>
            <div class="card-data">Exceptional medical care in the convenience and comfort of a patient’s own home.</div>
        </td>
    </tr>
</table>

