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
        margin: 40px auto 20px; /* Upar ki space set karein */
        border-collapse: collapse;
        padding: 20px;
        }
    .content-table th {
        font-size: 22px;
        padding: 12px 20px;
        border: none; /* th ke border ko remove karein */
    }
    .content-table td {
        font-size: 20px;
        padding: 12px 20px;
        border: 1px solid #dddddd; /* td ke border ko set karein */
    }
</style>

<!-- header -->

<table width="100%">
    <tr>
        <td class="header-text" style="text-align:left; width: 70%;">
        <p>
        SECTION:1 'Macro Environment and Trends'
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
            <h1 class="main-heading">HEALTHCARE MARKET SHIFT</h1>
            <h3 class="sub-heading">The Ageing Baby Boomer Population Represents a Massive Strain On Healthcare</h3>
        </td>
    </tr>
</table>

<table width="100%" style="margin-top: 50px;">
    <tr>
        <td style="width: 20%; padding-right: 20px;">
            <img src="<?= base_url('assets/images/section1_img.png')?>" alt="image" style="width: 50%;" height="40%" />
        </td>
        <td style="width: 80%; vertical-align: top;">
            <table class="content-table">
                <tr>
                    <th>
                        In the United States, the senior population is growing faster than any other age group.
                    </th>
                </tr>
                <tr>
                    <td>
                    <span style="color: #00b4d8; margin-left: 20px; margin-right: 20px; font-size: medium; margin-bottom: 10px;">●</span>                        According to the Centers for Disease Control and Prevention, approximately 85% of seniors have at least one chronic health condition like cancer, diabetes or heart disease.</td>
                </tr>
                <tr>
                    <td>
                    <span style="color: #00b4d8; margin-left: 20px; margin-right: 20px; font-size: medium; margin-bottom: 10px;">●</span>
                        60% of them have at least two chronic health conditions.</td>
                </tr>
                <tr>
                    <th>80%-90% of healthcare spend occurs at 65+</th>
                </tr>
                <tr>
                    <td>
                    <span style="color: #00b4d8; margin-left: 20px; margin-right: 20px; font-size: medium; margin-bottom: 10px;">●</span>    
                    By 2030, all baby boomers will be 65 or older</td>
                </tr>
                <tr>

                    <td><span style="color: #00b4d8; margin-left: 20px; margin-right: 20px; font-size: medium; margin-bottom: 10px;">●</span>
                        The same year, the Medicare-eligible population will reach 69.7 million. Nearly double what it was in 2000.</td>
                </tr>
            </table>
        </td>
    </tr>
</table>






