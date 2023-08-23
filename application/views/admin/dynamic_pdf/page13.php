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
        color: #5aba4a
        text-align: center;
        padding: 10px 0;
        letter-spacing: 1.1;

    }
    .sub-heading {
        font-size: 18px;
        font-weight: normal;
        color: #555;
        text-align: center;
        padding: 5px 0;
        font-style: italic;

    }
       
    .content-table {
    width: 100%;
    margin: 10px auto 20px;
    border-collapse: collapse;
    padding: 20px;
}
.content-table td {
    font-size: 16px;
    padding: 12px 20px;
    border: 1px solid #dddddd;
}

</style>


<table width="100%">
    <tr>
        <td class="header-text" style="text-align:left; width: 70%;">
        <p style="text-transform:uppercase;">
        SECTION:2 'Solution & Services'
        </p>      
        </td>
        <td class="header-logo" style="text-align:right; width: 30%;">
            <img src="<?= base_url('assets/images/360logo.png')?>" width="20%" height="10%" />
        </td>
    </tr>
</table>
<hr class="header-separator">

<!-- content -->
<table width="100%" style="text-align:center;">
    <tr>
        <td>
            <h1 class="main-heading">
            Simplifying the Complexity of Healthcare
            </h1>
            <h3 class="sub-heading">
            Healthcare is complex, but the solution is simple.
         </td>
    </tr>
</table>

<table width="100%" style="margin-top: 50px;">
    <tr>
        <td style="width: 80%; vertical-align: top;">
            <table class="content-table">
                <tr>
                    <td>
                        We believe even the highest quality medical care can be made immeasurably better when it comes from a heart of service.
                    </td>  
                </tr>
                <tr>
                    <td>
                        That's why we created Access 360 Care, a one-of-a-kind healthcare system that brings comprehensive care directly to our patients at home.
                    </td>          
                </tr>
                <tr>
                    <td>
                        Let's work together to close the gaps in healthcare and improve the lives of our patients.
                    </td>          
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="width: 100%; text-align: center;">
            <img src="<?= base_url('assets/images/tools.png')?>" alt="image" style="width: auto;" height="20%" />
        </td>
    </tr>
</table>
