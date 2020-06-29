<?php
//require_once("./includes/initialize_cus_sup.php");
require_once("./includes/initialize.php");
require_once("./includes/marketer_details.php");


function show_int_val1($int_val1)
{
	if (($int_val1."")=="0")
	{
		return "";
	}
	//return "";
	return $int_val1;
}
function getNoteNoSpan($val)
{
	
	echo '<span class="help-tip">';
	//$qnote = $database->query("SELECT * FROM b_notes WHERE fieldName='$val'") or die('Query failed: ' . mysql_error());
	//$rownote = $database->fetch_array($qnote);
	echo "<p>{$val}</p>";
	echo '</span>';
		
}
if ($_POST["item_to_delete1"]!="")
{
	$q = "delete from ".MARKETER."_items where itemCode=".$_POST["item_to_delete1"];
			  
			  //echo "q=".$q."<BR>";
		$database->query($q) or die('Query faild: '.mysql_error());
}
if(isset($_POST['add']))
{
		/*if ($_POST['item_id'] == '') {
			echo "<script>alert('חסר פריט');</script>";
			$notAdd = 1;
			$imageName = $_POST['photo'];
		}*/
		
		//item_code,item_name,item_anaf,item_orderby,item_vatgroup,item_includeinorder,item_noweight
		$str_note1="";
		
		
		
		


		if ($_POST['item_code'] == '') {
			//echo "<script>alert('חסר שם פריט');</script>";
			$lastItemCode = $database->fetch_array($database->query("SELECT MAX(itemCode) FROM ".MARKETER."_items"));
			$itemCode = $lastItemCode[0] + 10;
			$_POST['item_code']=$itemCode."";
			//$notAdd = 1;
			
		}


		if ($_POST['item_name'] == '') {
			//echo "<script>alert('חסר שם פריט');</script>";
			$str_note1.="שם פריט";
			$notAdd = 1;
			
		}
		
		if ($_POST['item_anaf'] == '') {
			if ($str_note1!="")
			{
				$str_note1.=",";
			}
			$str_note1.="ענף";
			//echo "<script>alert('חסר ענף');</script>";
			$notAdd = 1;
			
		}
		
		if ($_POST['item_vatgroup'] == '') {
			
			$_POST['item_vatgroup']="0";
			
			
		}
		

		if ($_POST['item_orderby'] == '') {
			//echo "<script>alert('חסר סדר');</script>";
			$_POST['item_orderby'] = '99999';
			
		}

		
		/*echo "item_includeinorder=".$_POST['item_includeinorder']."<BR>";
		if ($_POST['item_orderby'] == '') {
			//echo "<script>alert('חסר סדר');</script>";
			if ($str_note1!="")
			{
				$str_note1.=",";
			}
			$str_note1.="סדר";

			$notAdd = 1;
			
		}*/	
		
		/*echo "item_includeinorder=".$_POST['item_includeinorder']."<BR>";
		if ($_POST['item_includeinorder'] == '') {
			//echo "<script>alert('חסר סדר');</script>";
			if ($str_note1!="")
			{
				$str_note1.=",";
			}
			$str_note1.="סדר";

			$notAdd = 1;
			
		}*/	
		/*if ($_POST['item_noweight'] == '') {
			//echo "<script>alert('חסר סדר');</script>";
			if ($str_note1!="")
			{
				$str_note1.=",";
			}
			$str_note1.="משקל";

			$notAdd = 1;
			
		}*/	
		
		
		if ($str_note1!= '') {
			echo "<script>alert(' חסר ".$str_note1."');</script>";
			$notAdd = 1;
			
		}	

		if ($notAdd != 1) {

			//$lastItemCode = $database->fetch_array($database->query("SELECT MAX(itemCode) FROM b_itemsSupplier WHERE uidSupplier='{$uid}'"));
			//$itemCode = $lastItemCode[0] + 10;
			$item_includeinorder=0;
			if ($_POST['item_includeinorder']=="on")
			{
				$item_includeinorder=1;
			}

			$item_noweight=0;
			if ($_POST['item_noweight']=="on")
			{
				$item_noweight=1;
			}

			// Check if item with itemCode exists
			// if not add it, otherwise display error message
			$sql = "SELECT * FROM ".MARKETER."_items WHERE itemCode='" . $_POST['item_code']. "' LIMIT 1";
			$res = $database->query($sql);
			// error_log(__FILE__ . __LINE__ . ' itemCode: ' . print_r($_POST, 1) . 'sql: ' . $sql .  'num rows: ' . print_r($res->fetch_assoc(),1));
			if(!$res) {
				error_log(__FILE__ . __LINE__ . ' itemCode: ' . print_r($_POST, 1) . 'sql: ' . $sql .  ' NO results: ' . mysql_error());
			}
			if($res && mysql_num_rows($res) == 1) {
				// error_log(__FILE__ . __LINE__ . ' itemCode: ' . print_r($_POST, 1) . 'sql: ' . $sql .  'num rows: ' .mysql_num_rows($res));
				echo "<script> alert('שגיאה! קוד פריט זה כבר קיים במלאי.');</script>";
			} else {
				//echo $_POST['item_noweight']."<BR>";
				$q = "INSERT INTO ".MARKETER."_items(itemCode, itemName, anaf,orderBy,vatGroup,inHaz,noWeight,itemPackage)
					  VALUES ('{$_POST['item_code']}','{$_POST['item_name']}','{$_POST['item_anaf']}','{$_POST['item_orderby']}','{$_POST['item_vatgroup']}',{$item_includeinorder},{$item_noweight},'{$_POST['itemPackage']}')";

				$database->query($q) or die('Query faild: '.mysql_error());
			}
			//echo $_POST['item_noweight']."<BR>";
			/* $q = "INSERT INTO ".MARKETER."_items(itemCode, itemName, anaf,orderBy,vatGroup,inHaz,noWeight) 
				  VALUES ('{$_POST['item_code']}','{$_POST['item_name']}','{$_POST['item_anaf']}','{$_POST['item_orderby']}','{$_POST['item_vatgroup']}',{$item_includeinorder},{$item_noweight})";
				  
			$database->query($q) or die('Query faild: '.mysql_error()); */
		}
}
elseif(isset($_POST['delete']))
{
	$checkExist = $database->fetch_array($database->query("SELECT * FROM b_custDetails WHERE itemCode='{$_POST['id_to_delete']}' AND uidSupplier = '{$uid}'"));
	if ($checkExist != '')
		echo "<script> alert('המחיקה אין מותרת, הערך נמצא בשימוש');</script>";
	else {
		$query = "delete from b_itemsSupplier where itemCode='{$_POST['id_to_delete']}' AND uidSupplier = '{$uid}'" ;
		$database->query($query) 
		or die("Delete delivery details. query:{$query}. Error:" . mysql_error() ) ;
	}

}



?>
<!doctype html>
<head>
	<html xmlns="https://www.w3.org/1999/xhtml" dir="rtl" lang="he-IL">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link rel="shortcut icon" href="/images/favicon.ico"></link>
	<link href="https://code.jquery.com/ui/1.8.22/themes/ui-lightness/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<!--<link href="https://www.nisancomp.co.il/css/ui-lightness/jquery-ui-1.8.22.custom.css" rel="stylesheet" type="text/css"/> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
	<script src="https://code.jquery.com/ui/1.8.22/jquery-ui.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/i18n/jquery.ui.datepicker-he.min.js" type="text/javascript"></script>
	<!--<link href="css/style_nisan.css" rel="stylesheet" type="text/css" media="screen"/>-->
	<link href="css/style.css" rel="stylesheet" type="text/css" media="screen"/>
	<script>
	function delete_item_func1(obj1)
	{
		//alert($(obj1).attr("value"));
		$("#delete_form_"+$(obj1).attr("value")).submit();
		//alert("delete_item_func1");
	}
	
	
	
	$(document).ready(function() {
		
		
		 // $("#search_item_name1").keyup(function(){
			 // //alert("c1");
			 // //alert($("td[id2='item_name2']").length);
			
			 // var len1=$("input[type1='item_name']").length;
			 // var i1;
			 // debugger;
			 // //alert("len1="+len1);
			 // for (i1=0;i1<len1;i1++)
			 // {
				 // var str1=$($("input[type1='item_name']").get(i1)).val();
				 // //alert("str1="+str1);
				 // if (str1.includes($("#search_item_name1").val()))
				 // {
					 // $($("input[type1='item_name']").get(i1)).parent().parent().parent().css("display","");
				 // }
				 // else
				// {
					 // $($("input[type1='item_name']").get(i1)).parent().parent().parent().css("display","none");
				 // }
				 // /*if ($($("td[id2='item_name2']").get(i1)).val().includes($("#search_item1").val())
				 // {
					 // $($("td[id2='item_name2']").get(i1)).parent().css("display","none");
				 // }
				 // else
				 // {
					 // $($("td[id2='item_name2']").get(i1)).parent().css("display","");
				 // }*/
				 // //str.includes("world");
			 // }
		 // });
		$('#search_item_name1').autocomplete({
						source: 'get_items_list3.php',
						position: { my: 'right top', at: 'right bottom' },
						search: function(data) {
								$('#customerid').val('');
						},
						select: function (event, response) {
								var customerid = response.item.id;
								if (customerid) {
										$('#search_item_name1_id').val(customerid);
										$('#search_item_name1').removeClass('error');
								} else {
										alert("Item ID can't be found");
										return false;
								}
						}
				});
	
		$("[type1='item_name']").keyup(function(e1) {
	
				var item_name1=$(e1.target).val();
				var item_code1=$(e1.target).attr("item_code1");
				$("#item_name_span_"+item_code1).html(item_name1);
				$.post("items_ajax1.php", {"op_code1": "item_name1", "item_name1": item_name1,"item_code1":item_code1}, function(msg) {							
			});
			});
			
			
			$("[type1='item_anaf']").change(function(e1) {
				//alert($(e1.target).attr("item_code1"));
				//alert($(e1.target).val());
				//alert("ok1");
				//return;
				var item_anaf1=$(e1.target).val();
				var item_code1=$(e1.target).attr("item_code1");
				$.post("items_ajax1.php", {"op_code1": "item_anaf1", "item_anaf1": item_anaf1,"item_code1":item_code1}, function(msg) {							
				//alert(msg);
			});
			});
			

			$("[type1='item_orderby']").keyup(function(e1) {
				//alert($(e1.target).attr("item_code1"));
				//alert($(e1.target).val());
				//alert("ok1");
				//return;
				var item_orderby1=$(e1.target).val();
				var item_code1=$(e1.target).attr("item_code1");
				$.post("items_ajax1.php", {"op_code1": "item_orderby1", "item_orderby1": item_orderby1,"item_code1":item_code1}, function(msg) {							
				//alert(msg);
			});
			});

			
			$("[type1='item_vatgroup']").keyup(function(e1) {
				//alert($(e1.target).attr("item_code1"));
				//alert($(e1.target).val());
				//alert("ok1");
				//return;
				var item_vatgroup1=$(e1.target).val();
				var item_code1=$(e1.target).attr("item_code1");
				$.post("items_ajax1.php", {"op_code1": "item_vatgroup1", "item_vatgroup1": item_vatgroup1,"item_code1":item_code1}, function(msg) {							
				//alert(msg);
			});
			});

			
			$("[type1='item_inhaz']").change(function(e1) {
				//alert($(e1.target).attr("item_code1"));
				//alert($(e1.target).val());
				//alert("ok1");
				//return;
				var item_inhaz1=0;
				if ($(e1.target).is(':checked')==true)
				{
					item_inhaz1=1;
				}
				//var item_inhaz1=$(e1.target).is(':checked');
				//alert(item_inhaz1);
				//return;
				var item_code1=$(e1.target).attr("item_code1");
				$.post("items_ajax1.php", {"op_code1": "item_inhaz1", "item_inhaz1": item_inhaz1,"item_code1":item_code1}, function(msg) {							
				//alert(msg);
			});
			});
			
			
			$("[type1='item_noweight']").change(function(e1) {
				//alert($(e1.target).attr("item_code1"));
				//alert($(e1.target).val());
				//alert("ok1");
				//return;
				var item_noweight1=0;
				if ($(e1.target).is(':checked')==true)
				{
					item_noweight1=1;
				}
				//var item_inhaz1=$(e1.target).is(':checked');
				//alert(item_noweight1);
				//return;
				var item_code1=$(e1.target).attr("item_code1");
				$.post("items_ajax1.php", {"op_code1": "item_noweight1", "item_noweight1": item_noweight1,"item_code1":item_code1}, function(msg) {							
				//alert(msg);
			});
			});
			
			
			
			
			
	});
	

	
				
	</script>
	<title>עידכון פריטים</title>

<style>
/*-------------------------
	Inline help tip
--------------------------*/

input[type=file]{ 
        color:transparent;
    }
.help-tip{
	position: relative;
	cursor: default;
}

.help-tip:hover p{
	background-color: white;
	display:block;
	transform-origin: 75% 75%;
	-webkit-animation: fadeIn 0.5s ease-in-out;
	animation: fadeIn 0.5s ease-in-out;
	z-index: 1;
}

.help-tip p{
	display: none;
	text-align: right;
	background-color: white;
	padding: 10px;
	width: 300px;
	position: absolute;
	border-radius: 3px;
	box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.2);
	right: 20px;
	top: 30px;
	color: black;
	font-size: 20px;
	line-height: 1.4;
	border: 4px solid #43A011 ;
}

@-webkit-keyframes fadeIn {
	0% { 
		opacity:0; 
		transform: scale(0.6);
	}

	100% {
		opacity:100%;
		transform: scale(1);
	}
}

@keyframes fadeIn {
	0% { opacity:0; }
	100% { opacity:100%; }
}
	</style>
</head>
<body>
<div style="width:100%; margin: auto;">
	<div id="header">
		<div id="centerbar">
			<?php include 'nav_update_tbls1.php';?>
		</div>
	</div>
	<div class="h2" style="font-size:40px!important;margin-top:-20px!important">עידכון פריטים</div>
	<div id="wrap">
<?php
if ($row['userOrderType'] == 'HS') {
?>
<div class="h2">ניהול פריטים</div>
<div id="subHeadlines1">
<table style="width:10%;">
<tr>
<form method=post id=frm2>
<td style="width:150px";>
<?php getNoteNoSpan("חפש פריט");
?>
<input <?php echo $disFS; ?>  type=hidden name=itemIdf id=itemIdf value="">
<input <?php echo $disFS; ?>  name="item_namef" id="item_namef" type=text placeholder="חפש פריט" autocomplete="off" style="width:90%;margin-right:20px;" value="<?php echo $_POST['item_namef']; ?>"></span></td>
<td style="width:150px";>
<?php getNoteNoSpan("בחר קט. ראשית");
?>
<select name="mainGroupf" id="mainGroupf" style="width:90%;margin-right:20px;">
<option value=''>בחר קט. ראשית</option>
<?
$mainGroups = $database->query("SELECT * FROM c_itemMainGroup WHERE uidSupplier='{$uid}'");
while ($rowt = $database->fetch_array($mainGroups)) {
	echo "<option ".(($_POST['mainGroupf'] == $rowt['mainGroup'] && $rowt['mainGroup'] != '') ? ' selected ': '')." value='{$rowt['mainGroup']}'>{$rowt['mainGroupName']}</option>";
}
?>
</select>
</td>
</tr><tr>
<td style="width:10px";>
<?php getNoteNoSpan("בחר קטגוריה");
?>
<select name="subGroupf" id="subGroupf" style="width:90%;margin-right:20px;">
<option value=''>בחר קט. משנית</option>
<?php
	if ($_POST['mainGroupf'] != '') {
		$subGroups = $database->query("SELECT * FROM c_itemSubGroup WHERE uidSupplier='{$uid}' AND mainGroup='{$_POST['mainGroupf']}'");
		while ($rowt = $database->fetch_array($subGroups)) {
			echo "<option ".(($_POST['subGroupf'] == $rowt['subGroup'] && $rowt['subGroup'] != '') ? ' selected ': '')." value='{$rowt['subGroup']}'>{$rowt['subGroupName']}</option>";
		}
	}

?>
</select>
</span>
</form>
<td style="width:80px;"><div align=center><button <?php echo $disFS; ?>  name=add2 type=button onclick="location.href='supplier_items.php'" value="הוסף" style="width:92%;">הצג הכל</button></div></td>

</tr>
</table>
</div>

<?php
}
?>

<div style="font-size:35px;">חיפוש פריט:</div>
<table id="orders_head" style="width:100%;">
<tr class=odd>
<form method=post>

		<td style="width:100px;">
		<input type="hidden" value="" id="search_item_name1_id" name="search_item_name1_id" />
<input  class=odd name="search_item_name1" id="search_item_name1" type=text placeholder="בחר פריט" style="width:100%;"></td>
<td style="width:10px;background: #ffffff" >

</td>
<td style="width:7%;">
	<button  id="searchBtn" name="searchBtn" type="submit" value="הצג" style="width:100%;margin-left:0px;">הצג</button>
</td>
<td style="width:200px;background: #ffffff!important;border-bottom:0px!important;border-righ!important" >

<td style="width:3px;">
	
	<a href="https://www.nisancomp2.co.il/itemsGroups.php" style="width:100%; background-color:#ffffff;color:black;" >פריטים משקי בית</a>
</td>


</form>
</tr>
</table>
</div>


<div style="font-size:35px;">הוספת פריט:</div>

<table id="orders_head" style="width:100%;">
<tr class=odd>
<form method=post>


<td style="width:160px"><input   class=odd name="item_code" type=text placeholder="קוד פריט" value="" style="width:96%;text-align:right;"></td>

<td style="width:200px"><input   class=odd name="item_name" type=text placeholder="שם פריט" style="width:90%;text-align:right;"></td>

<td style="width:150px"><select class=odd id='item_anaf' name='item_anaf' ><option   value='0'>פירות</option><option  value='1'>ירקות</option><option  value='9'>אחר</option></select>
</td>
<!--<input   class=odd name="item_anaf" type=text placeholder="ענף" style="width:80%;margin-right:20px;">-->

<td style="width:150px"><input   class=odd name="item_orderby" type=text placeholder="סדר" value="" style="width:80%;text-align:right;"></td>

<td style="width:150px"><input   class=odd name="item_vatgroup" type=text placeholder="קבוצת מעמ" value="" style="width:80%;text-align:right;font-size:20px;"></td>

<td style="width:150px">
<input type='checkbox' class=odd name="item_includeinorder"  />כלול בהזמנה</td>


<td style="width:150px"><input type='checkbox' class="odd " name="item_noweight" />ללא משקל</td>

<td style="width:300px" class="kkkk">
	<select class=odd name="itemPackage" id="itemPackage" style="background-color:#eff3f4;" onclick="check_customer()">

		<?php 
		$query = "SELECT * FROM " . MARKETER . "_packages where 1";
        $result = $database->query($query) or die('Query failed: ' . mysql_error());
		echo "<option value='' selected=''>בחר אריזה</option>";
		while ($row = $database->fetch_array($result)) {
			$packageCode = $row['package_code'];
			$packageName = $row['package'];
			if($packageCode!=''){
			?>
			<option value="<?php echo $packageCode; ?>"><?php echo $packageName; ?></option>
			<?php
			}
		}
		?>
	</select>
</td>

		<td style="width:80px;"><button <?php echo $disFS; ?>  id=addBtn name=add type=submit value="הוסף" style="width:80%;margin-left:10px;">הוסף</button></td>
		</form>
		</tr>

		</table>
		<br>
		<table id="orders_head" style="width:auto;">
		<tr class="headT">

		<td>קוד פריט</td>
		<td style="width:200px">שם פריט</td>
		<td>ענף</td>
		<td>סדר</td>
		<td>קבוצת מע"מ</td>
        <td>לא פעיל</td>
		<td>ללא משקל</td>
		<td>אריזה לפריט</td>
		<td>מחק</td>
		</tr>
		<?php
			
				$query = "SELECT * 
				FROM b_itemsSupplier where uidSupplier = '{$uid}'";
				
				$query = "SELECT * FROM ".MARKETER."_items order by itemCode";
				$delivery_rs = $database->query($query);
			
			while ($delivery_row = $database->fetch_array($delivery_rs)) 
			{	
				
				if($delivery_row['itemCode']==$_POST['search_item_name1_id']){
						//itemPackage;
						echo '<tr' . (($odd = !$odd) ? ' class="odd"' : '') . '>';
						
						echo "<td style='width:150px'>{$delivery_row['itemCode']}</td>";
						echo "<td style='width:150px;vertical-align: none;white-space: nowrap;'>";//{$delivery_row['itemName']}</td>";
						echo "<div id='item_name_div_".$delivery_row["itemCode"]."' style='position:relative;top:0px;right:0px;width:auto;height:auto;font-size: 25px' >";
						echo "<span style='visibility:hidden' id='item_name_span_".$delivery_row["itemCode"]."' >".$delivery_row['itemName']."</span>";
						echo "<input style='position:absolute;right:0px;width:100%;margin-right:0px;' ". (($odd) ? ' class="odd"' : '') ." type1='item_name' item_code1='{$delivery_row["itemCode"]}'  name='item_item_name_{$delivery_row["itemName"]}' type=text  value='{$delivery_row['itemName']}' >";
						echo "</div>";
						echo "</td>";
						//echo "<td style=width:150px;>{$delivery_row['anaf']}</td>";
						$val0="";
						if (($delivery_row['anaf']."")=="0")
						{
							$val0=" selected ";
						}
						$val1="";
						if (($delivery_row['anaf']."")=="1")
						{
							$val1=" selected ";
						}
						$val9="";
						if (($delivery_row['anaf']."")=="9")
						{
							$val9=" selected ";
						}

						echo "<td style='width:100px;'><select type1='item_anaf' item_code1='{$delivery_row["itemCode"]}'   id='item_anaf' ". (($odd) ? ' class="odd"' : '') ." ><option {$val0}  value='0'>פירות</option><option {$val1} value='1'>ירקות</option><option {$val9} value='9'>אחר</option></select> </td>";
						echo "<td style='width:150px;'>";
						echo "<input ". (($odd) ? ' class="odd"' : '') ." type1='item_orderby'  item_code1='{$delivery_row["itemCode"]}'   name='item_orderby_{$delivery_row["itemCode"]}' type=text  value='".show_int_val1($delivery_row["orderBy"])."' style='width:80%;margin-right:20px;'></td>";
						echo "<td style=width:150px;>";
						echo "<input ". (($odd) ? ' class="odd"' : '') ."  type1='item_vatgroup'  item_code1='{$delivery_row["itemCode"]}'  name='item_vat_group_{$delivery_row["itemCode"]}' type=text  value='".show_int_val1($delivery_row["vatGroup"])."' style='width:80%;margin-right:20px;'>";
						echo "</td>";
						echo "<td style='width:150px;'><input type='checkbox' name='item_in_haz_{$delivery_row["itemCode"]}' type1='item_inhaz'  item_code1='{$delivery_row["itemCode"]}' ";
						if (($delivery_row['inHaz']."")=="1")
						{
							echo " checked ";
						}
						
						//echo " />כלול בהזמנה</td>";
						echo " <td/>לא פעיל</td>";
						echo "<td style=width:150px;><input type='checkbox' name='item_no_weight_{$delivery_row["itemCode"]}' type1='item_noweight'  item_code1='{$delivery_row["itemCode"]}' ";
						if (($delivery_row['noWeight']."")=="1")
						{
							echo " checked ";
						}
						echo " />ללא משקל</td>";

				
				
						//echo "<td>{$delivery_row["itemPackage"]}</td>";
						?>
						<td style="width:200px;">
						
						<select name="package" class="package" style="background-color:#eff3f4;" data-id="<?php echo $delivery_row["itemCode"]; ?>">
								
							<?php 
				
								$query = "SELECT * FROM " . MARKETER . "_packages where 1";
								$result = $database->query($query) or die('Query failed: ' . mysql_error());
								echo "<option value='' selected=''>בחר אריזה</option>";
								while ($row = $database->fetch_array($result)) {
									$packageCode = $row['package_code'];
									$packageName = $row['package'];
									if($packageCode!=''){
									?>
									<option value="<?php echo $packageCode; ?>" <?php if($delivery_row["itemPackage"]==$packageCode){echo "selected";} ?>><?php echo $packageName; ?></option>
									<?php
									}
								}
						
								?>	
								
						</select></td>
						
						<?php
						
						echo "<td><form method=post name='delete_form_{$delivery_row["itemCode"]}' id='delete_form_{$delivery_row["itemCode"]}' ><input type='hidden' name='item_to_delete1' value='{$delivery_row["itemCode"]}' /> <img onclick='delete_item_func1(this)' class='edit_btns' style='width:30px;height:auto' src='images/delete_blue.jpg' alt='' title='' id='delete_item_{$delivery_row["itemCode"]}' name='item_code_to_delete' value='{$delivery_row["itemCode"]}' ></form></td>";
						
						echo '</tr>';
						
		}
			}
			
		?>
		
		</table>
		
<br>
	</div>
</body>
<script>
jQuery(document).ready(function(){
	jQuery('.package').change(function(){
		var itemCode=jQuery(this).attr('data-id');
		var value=jQuery(this).val();
		var prefix="<?php echo MARKETER ?>";
		var action='hidden_update_package';
		jQuery.ajax({
			data:{itemCode:itemCode,value:value,action:action,prefix:prefix},
			url :'ajax_functions.php',
			type : 'POST',
			success:function(response){
			}
		})
	})
})
</script>
		