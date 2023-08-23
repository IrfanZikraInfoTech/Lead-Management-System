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
    .toc-container {
        max-width: 60%;
        margin: 20px auto;
        justify-content: space-between;
    }
    .toc-card {
        padding: 10px; /* Yeh line padding ko chhota kar degi */
        background: #fff;
        border-radius: 5px;
        border-bottom: 2px solid #e0e0e0;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }
    .toc-card .number {
        font-size: 24px;
        color: #808080	;
        float: left;
    }
    .toc-card .heading {
        font-size: 18px;
        font-weight: bold;
        margin-left: 30px;
        color: #808080;
    }
</style>



<table width="100%">
    <tr>
        <td class="header-text" style="text-align:left; width: 70%;">
            <p>
             Table of Content   
            </p>      
        </td>
        <td class="header-logo" style="text-align:right; width: 30%;">
            <img src="<?= base_url('assets/images/360logo.png')?>" width="20%" height="10%" />
        </td>
    </tr>
</table>
<hr class="header-separator">
<div class="toc-container">
        <div class="toc-card">
            <span class="number">1.</span>
            <span class="heading">
            Macro Environment and Trends in healthcare        
            </span>
</div>
        <div class="toc-card">
            <span class="number">2.</span>
            <span class="heading">         
            Patient Revenue Cycle and Texarkana territory
            </span>
        </div>
        <div class="toc-card">
            <span class="number">3.</span>
            <span class="heading">
            Solution & Services MSO Deal structure
            </span>
        </div>
        <div class="toc-card">
            <span class="number">3.</span>
            <span class="heading">
             MSO Deal structure
             </span>
        </div>  
      </div>
