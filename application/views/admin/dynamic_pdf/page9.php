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
        margin: 10px 0 30px 0; /* Yeh line header ke neeche wale gap ko set karta hai */

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

    .content-table {
        width: 100%;
        margin: 10px auto 40px; /* Upar ki space set karein */
        padding: 20%;
        text-align:center;
        border:none;
        }
    .content-table th {
        font-size: 18px;
        padding: 10px 20px;
        border: none; /* th ke border ko remove karein */
    }
    .content-table td {

        border: none; /* th ke border ko remove karein */
    }

</style>

<!-- !-- header -->

<table width="100%">
    <tr>
        <td class="header-text" style="text-align:left; width: 70%;">
        <p>
        SECTION:1 'MACRO ENVIRONMENT AND TRENDS'
        </p>      
        </td>
        <td class="header-logo" style="text-align:right; width: 30%;">
            <img src="<?= base_url('assets/images/360logo.png')?>" width="20%" height="10%" />
        </td>
    </tr>
</table>
<hr class="header-separator">

<!-- header code end-->


<!-- content -->
<table width="100%" style="text-align:center;">
    <tr>
        <td>
            <h1 class="main-heading">PROBLEM</h1>
            <h3 class="sub-heading">-The medicare population is aging.</h3>
        </td>
    </tr>
</table>

<table class="content-table">

    <tr>
        <td>
        <img src="<?= base_url('assets/images/page9img.png')?>" width="auto" height="35%" />
        </td>
    </tr>
    <tr>
        <td style="margin-left:50px; font-size:15px">
        More Medicare enrollees require different care as they exhibit more chronic conditions and continue to age.
        </td>
    </tr>
</table>

