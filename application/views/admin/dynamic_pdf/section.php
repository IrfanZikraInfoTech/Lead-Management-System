
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
        font-size: 18px;
        font-weight: normal;
        color: #555;
        text-align: center;
        padding: 5px 0;
        font-style: italic;

    }
    

      /* Table styling */
      .content-table {
    width: 100%;
    margin: 10px auto 20px;
    border-collapse: collapse;
    padding: 20px;
    }
    .content-table td, .head, .data {
        font-size: 16px;
        padding: 12px 20px;
        border: 1px solid #dddddd;
    }
    th {
        background-color: #f4f4f4;
        color: #555;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    </style>
 <?php if(isset($territory[0]['data'])){
    $territory[0]['data'] = json_decode($territory[0]['data'], true); 
}
?>
  
   <table width="100%">
    <tr>
        <td class="header-text" style="text-align:left; width: 70%;">
        <p style="text-transform:uppercase;">
        SECTION:3 'Texarkana-Territory Specific Material'
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
            Texarkana- The potential territory     
           </h1>
            <h3 class="sub-heading">
            150,000 People spread over 18 ZIP codes and 5 Counties
            </h3>
        </td>
    </tr>
</table>
<table width="100%" class="content-table" >
    <thead>
        <tr>
            <th class="head">Name </th>
            <th class="head">Estimate</th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($territory) && !empty($territory[0]['data']['stats'])): ?>
            <?php foreach ($territory[0]['data']['stats'] as $key => $value): ?>
                <tr style="page-break-inside: avoid;">
                    <td class="data"><?= $key; ?></td>
                    <td class="data"><?= $value; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
<div style="text-align: center;">
    <img src="<?= base_url('assets/images/mappicture.png')?>" alt="image" style="width: auto; height: 50%;" />
</div>




    




