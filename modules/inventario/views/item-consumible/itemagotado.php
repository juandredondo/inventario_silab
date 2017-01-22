<?php $contador=count($model); if ($model !== null):?>
<html>
<head>
<style>
 body {font-family: sans-serif;
 font-size: 10pt;
 }
 p { margin: 0pt;
 }
 td { vertical-align: top; }
 .items td {
 border-left: 0.1mm solid #000000;
 border-right: 0.1mm solid #000000;
 }
 table thead td { background-color: #EEEEEE;
 text-align: center;
 border: 0.1mm solid #000000;
 }
 .items td.blanktotal {
 background-color: #FFFFFF;
 border: 0mm none #000000;
 border-top: 0.1mm solid #000000;
 }
 .items td.totals {
 text-align: right;
 border: 0.1mm solid #000000;
 }
</style>
</head>
<br> <br>
<body>
  <?php foreach($model as $row): ?>

 <htmlpageheader name="myheader">
 <table width="100%"><tr>
 <td width="50%" style="color:#0000BB;"><span style="font-weight: bold; font-size: 12pt;">ITEMS CONSUMIBLES EN ESTADO: 
 <?php echo $row->estadoConsumible->ESCO_NOMBRE;  ?></span> </td>
 
 </tr></table><br>
 </htmlpageheader>
 <br>
<htmlpagefooter name="myfooter">
 <div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
 Página {PAGENO} de {nb}
 </div>
 </htmlpagefooter>
 
<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
 <sethtmlpagefooter name="myfooter" value="on" />

<div style="text-align: left"><b>Fecha: </b><?php echo date("d/m/Y"); ?> <br><br><br></div>

 <table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse;" cellpadding="5">

 <thead>
  <br>
 <br>
 <br>
 <tr>
 <td width="21.666666666667%">ITEM ID</td>
 <td width="21.666666666667%">NOMBRE</td>
 <td width="21.666666666667%">TIPO</td>
 <td width="21.666666666667%">ESTADO</td>


 </tr>
 </thead>
 <tbody>
 <!-- ITEMS -->
 <?php foreach($model as $row): ?>
 <tr>
 <td align="center">
 <?php echo $row->item->ITEM_ID; ?>
 </td>
 <td align="center">
 <?php echo $row->item->ITEM_NOMBRE; ?>
 </td>
 <td align="center">
 <?php echo $row->item->tipoItem->TIIT_NOMBRE; ?>
 </td>
 <td align="center"> 
 <?php echo $row->estadoConsumible->ESCO_NOMBRE; ?>
 </td>

 </tr>
 <?php endforeach; ?>
 <!-- FIN ITEMS -->
 <tr>
 <td class="blanktotal" colspan="4" rowspan="4"></td>
 </tr>
 </tbody>
 </table>
 </body>
  <?php endforeach; ?>
 </html>
<?php endif; ?> 