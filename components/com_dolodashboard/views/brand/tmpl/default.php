<?php
/**
**/
// no direct access
defined('_JEXEC') or die;
?>
<!-- Dolo Dashboard Company starts here -->
<div class="doloDashboard<?php echo $this->pageclass_sfx; ?>">
<?php if ($this->params->get('show_page_heading', 1)) : ?>
<h1>
	<?php if ($this->escape($this->params->get('page_heading'))) :?>
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	<?php else : ?>
		<?php echo $this->escape($this->params->get('page_title')); ?>
	<?php endif; ?>
</h1>
<?php endif; ?>
</div>
    <link rel="stylesheet" type="text/css" href="http://dolo.insessus.com/includes/charts/styles/Attributes/jchartfx.attributes.smoothness.css" />
    <link rel="stylesheet" type="text/css" href="http://dolo.insessus.com/includes/charts/styles/Palettes/jchartfx.palette.ui-lightness.css" />
<!-- Dolo Dashboard ends here -->
<script type="text/javascript">
        var chart1, chart2, chart3;
        var border1, border2;
        var single1, single2;
        var horizontal1, horizontal2, horizontal3, horizontal4;

        function initialize() {
            chart1 = new cfx.Chart();
            chart2 = new cfx.Chart();
            chart3 = new cfx.Chart();
            chart4 = new cfx.Chart();

            doInitializeDash();

            chart1.create('divChart1');
            chart2.create('divChart2');
            chart3.create('divChart3');
            chart4.create('divChart4');


        }
        
function doInitializeDash()
{
    var title;
    
    // Company Overview
    chart1.setGallery(cfx.Gallery.Area);
    populateBrandInfo(chart1);
    //chart1.getView3D().setEnabled(true);
    title = new cfx.TitleDockable();
    title.setText("BET");
    chart1.getTitles().add(title);
    chart1.getLegendBox().setVisible(true);
    
    chart2.setGallery(cfx.Gallery.Area);
    populateBrandInfo(chart2);
    //chart2.getView3D().setEnabled(true);
    title = new cfx.TitleDockable();
    title.setText("MTV");
    chart2.getTitles().add(title);
    chart2.getLegendBox().setVisible(true);
    
    chart3.setGallery(cfx.Gallery.Area);
    populateBrandInfo(chart3);
   // chart3.getView3D().setEnabled(true);
    title = new cfx.TitleDockable();
    title.setText("Spike");
    chart3.getTitles().add(title);
    chart3.getLegendBox().setVisible(true);
    
    chart4.setGallery(cfx.Gallery.Area);
    populateBrandInfo(chart4);
    //chart4.getView3D().setEnabled(true);
    title = new cfx.TitleDockable();
    title.setText("VH1");
    chart4.getTitles().add(title);
    chart4.getLegendBox().setVisible(true);
    

   // chart1.getDataGrid().setVisible(true);
}
  
function doConfigureHorizontal(horizontal,value)
{
    var scale = horizontal.getMainScale();
    scale.setThickness(0.7);
    scale.setPosition(0.15);
    scale.setMax(10);
    horizontal.setMainValue(value);
}

function populateBrandInfo(chart)
{
    //just test stuff
    var items = [];
    
    for (var i = 0; i < 8; i++) {
       var obj = {
       "Clicks":Math.floor((Math.random() * 10500) + 8000),
       "Engagements":Math.floor((Math.random() * 10000) + 8000),
       "Views":Math.floor((Math.random() * 10500) + 8000),
       "Time":Math.floor((Math.random() * 560) + 400),
       "Date":"07/10/14" + i 
       };
  
        items.push(obj);
    }

    chart.setDataSource(items);
}

function doCreateTable(tableContainer, items) {
    $('#' + tableContainer).append('<table></table>');
    var table = $('#' + tableContainer).children();
    var cols = GetHeaders(items);
    var th = "<thead><tr>";
    for (var i = 0; i < cols.length; i++) {
        th += "<th>" + cols[i] + "</th>";
    }
    th += "</tr></thead>";
    table.append(th);

    for (var j = 0; j < items.length; j++) {
        var row = items[j];
        var tr = $('<tr></tr>');
        for (var k = 0; k < cols.length; k++) {
            var columnName = cols[k];
            tr.append('<td>' + row[columnName] + '</td>');
        }
        table.append(tr);
    }
}

function GetHeaders(obj) {
    var cols = new Array();
    var p = obj[0];
    for (var key in p) {
        cols.push(key);
    }
    return cols;
}
        
    </script>

    <center>
 <div class="jchartfx_container" style="align-center;width:100%;margin-top:30px;">
        <div style="display:inline-block;">
          <h1 style="display:inline-block;">Viacom</h1><select style="display:inline-block;margin-left:10px;"><option>BET</option><option>VH1</option><option>MTV</option><option>Spike</option></select>
        </div>
        
        <div id="myDash" style="width:1200px;height:520px;">
            <div id="divChart1" style="width:1000px;height:490px;display:inline-block;"></div>
        </div>
        
        <script language="javascript">
            $(document).ready(function ($) {
                initialize();
            });
        </script>
    </div>
    <div style="width:1200px;height:300px;display:inline-block;font-size:10px;">
            <div style="border:1px solid black;width:80px;display:inline-block;"><div style="background-color:lightgray;height:40px;">Images</div><br/>300</div>
            <div style="border:1px solid black;width:80px;display:inline-block;"><div style="background-color:lightgray;height:40px;">Views</div><br/>100,000</div>
            <div style="border:1px solid black;width:80px;display:inline-block;"><div style="background-color:lightgray;height:40px;">Engagements</div><br/>500,000</div>
            <div style="border:1px solid black;width:80px;display:inline-block;"><div style="background-color:lightgray;height:40px;">Engage Rate</div><br/>4%</div>
            <div style="border:1px solid black;width:80px;display:inline-block;"><div style="background-color:lightgray;height:40px;">Clicks</div><br/>30</div>
            <div style="border:1px solid black;width:80px;display:inline-block;"><div style="background-color:lightgray;height:40px;">Clickthru Rate</div><br/>20%</div>
            <div style="border:1px solid black;width:80px;display:inline-block;"><div style="background-color:lightgray;height:40px;">Time Spent</div><br/>2.1m</div>
            <div style="border:1px solid black;width:80px;display:inline-block;"><div style="background-color:black;color:white;height:40px;">Spend</div><br/>$7,000</div>
             <div style="border:1px solid black;width:80px;display:inline-block;"><div style="background-color:black;color:white;height:40px;">ROI</div><br/>.00625</div>
        </div>
              </center>