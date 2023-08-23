<style>
    .heading {
        text-transform: uppercase;
        font-size: 26px;
        font-weight: bold;
        color: #5aba4a;
        padding: 10px 0;
        text-align: center;
        margin-bottom: 20px;
    }
    .paragraph {
        line-height: 1.5;
        font-size: 18px;
        letter-spacing: 1.1px;
        text-align: justify;
        padding-left: 20px;
        font-style: italic;
        text-align: center;
        margin: 20px 0;
        max-width: 70%; /* Isse paragraph ko control kiya gaya hai */
        text-align: center;
    }
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
    .image-container {
        text-align: center;
    }
</style>
<table width="100%">
    <tr>
        <td class="header-text" style="text-align:left; width: 70%;">
            <p>"Guiding Principles: A Glimpse into Our Mission, Values, and Vision"</p>
        </td>
        <td class="header-logo" style="text-align:right; width: 30%;">
            <img src="<?=base_url('assets/images/360logo.png')?>" width="20%" height="10%" />
        </td>
    </tr>
</table>
<hr class="header-separator">
<table width="100%" style="height:100%;margin-top:50px">
    <tr>
        <td style="width: 60%; vertical-align: top;">
            <h2 class="heading">Our Vision</h2>
            <p class="paragraph">A community in which all people achieve their full potential for health and well-being in mind, body, and spirit...</p>
           <br>
            <h2 class="heading">Our Mission</h2>
            <p class="paragraph">
                To inspire hope and provide access to paitent-centered healthcare with excellence while contributing to the well-being of our paitients through integerated clinical practice at their door step
            </p>
            <br>
            <h2 class="heading">Our Values</h2>
            <p class="paragraph">
                We  care for the whole person see the complexity of each person's life and belive addressing a broad rang of human need is the best way to improve a person's health. We belive in providing heigh quality, accessible health care through a patient-centered health team aproach.
            </p>       
            </td>
        <td class="image-container" style="width: 30%;">
            <img src="<?= base_url('assets/images/page2pic.jpg')?>" width="auto" height="20%" alt="Your Image" />
        </td>
    </tr>
</table>