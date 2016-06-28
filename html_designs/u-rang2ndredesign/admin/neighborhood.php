<?php
$page="cms.php";
require("header.php");
require_once("includes/pagination.php");

$stitle = "Neighborhood";
$ptitle = "View Neighborhood";

$current_url=$_SERVER['PHP_SELF'];
$loc1=strrpos($current_url,"/")+1;
$loc2=strrpos($current_url,".")-1;

for ($a=$loc1;$a<=$loc2;$a++) {
	$this_page.=$current_url[$a];
}

if ($_POST["submit"]=="Add") {

	$error='';
	$description=santisize(stripslashes(trim($_POST["description"])));
	$name=santisize(stripslashes(trim($_POST["name"])));
	$body = $_POST["text"];
	$text=santisize($_POST["text"]);
	$title=santisize(stripslashes(trim($_POST["title"])));

	if ($name=="")
		$error.='Please Enter '.$stitle.' Name.<br />';
		
	if ($description=="")
		$error.='Please Enter '.$stitle.' Description.<br />';

	if (no_of_records(PREFIX.$this_page,"name",$name)==1){
		$error.=$stitle.' Name already exists.<br />';
	}

	if ($error!=NULL)
		$msg.='<div class="error">Errors:<br /><br />'.$error.'</div>';
	else
	{
		$todate = date("Y-m-d");
		$sql=mysql_query("insert into ".PREFIX.$this_page." (name, description, createddate) values('$name', '$description', '$todate')");
		$value=mysql_insert_id();
		$insert=mysql_query("update ".PREFIX.$this_page." set value='$value' where id='$value'");

		// creating a html files by Irfan Lateef Jan-20-2011
		
		/*$startbody = "<html><body>";
		$endbody = "</html></body>";
		$File = $name;
		$Handle = fopen($File, 'w');
		$Data = $startbody.$body.$endbody;
		fwrite($Handle, $Data);
		fclose($Handle);
		$tmp_name = explode(".", $name);
		$pg_name = $tmp_name[0];*/
	}
}


else if ($_POST[submit]=="Update"){
	
	$id=santisize($_POST["id"]);
	$error='';

	$description=santisize(stripslashes(trim($_POST["description"])));
	$name=santisize(stripslashes(trim($_POST["name"])));

	if ($name=="")
		$error.='Please Enter '.$stitle.' Name.<br />';
		
	if ($description=="")
		$error.='Please Enter '.$stitle.' Description.<br />';

	if (no_of_records(PREFIX.$this_page,"name",$name)==1 && getname("name",PREFIX.$this_page,"id",$id)!=$name){
		$error.='Page Name already exists.<br />';
	}

	if ($error!=NULL)
		$msg.='<div class="error">Errors:<br /><br />'.$error.'</div>';
	else{
		$modifieddate = date("Y-m-d");
		$sql = mysql_query("update ".PREFIX.$this_page." set name='$name', description='$description', modifieddate='$modifieddate' where id='$id'");
		$msg='<div class="success">'.$stitle.' Updated.</div>';
	}
}

else if ($_GET[act]=="delete"){
	$id=santisize($_GET["id"]);

	//deleting page
	/*$pg_name = getname2(PREFIX."pages","id",$id,"name");
	$tmp_name = explode(".", $pg_name);
	if($tmp_name[1]=="html") {
		unlink($tmp_name[0].".html");
	}*/

	$sql=mysql_query("delete from ".PREFIX.$this_page." where id='$id'");
	$msg='<div class="success">'.$stitle.' Deleted.</div>';
}

if ($_SESSION[$this_page.'_limit']==NULL)
	$_SESSION[$this_page.'_limit']=10;
else if ($_GET[limit]!=NULL)
	$_SESSION[$this_page.'_limit']=santisize($_GET[limit]);

$sql=mysql_query("select * from ".PREFIX.$this_page);
$no_of_records=mysql_num_rows($sql);
// Pagination class //
if ($no_of_records>0){
	$limit = $_SESSION[$this_page.'_limit'];
	$PaginateIt = new pagination();
	$PaginateIt->SetItemsPerPage($limit);
	$PaginateIt->SetQueryString('');
	$PaginateIt ->SetLinksToDisplay(5);
	$PaginateIt->SetItemCount($no_of_records);
	$PaginateIt->SetLinksFormat( '<< Back', ' | ', 'Next >>' );

	if($_GET["page"]){
		$pageVar = ($limit* htmlspecialchars(addslashes($_GET["page"]))) - $limit;
	}else{
		$pageVar = 0;
	}

	$PageLinks = $PaginateIt->GetPageLinks();
	$query = "select * from ".PREFIX.$this_page." order by id desc ".$_SESSION[$this_page.'_sort']." ".$_SESSION[$this_page.'_order'].$PaginateIt->GetSqlLimit();
}
// Pagination class //
$sql=mysql_query($query);
?>
<!-- TinyMCE -->
<script type="text/javascript" src="tiny_mce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({

		// add these two lines for absolute urls
		remove_script_host : false,
		convert_urls : false,

		force_br_newlines : true,
		forced_root_block : '',
		theme_advanced_path : false,
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "phpimage,safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,phpimage,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		paste_create_paragraphs : false,
		paste_create_linebreaks : true,
		paste_use_dialog : true,
		paste_auto_cleanup_on_paste : true,
		paste_convert_middot_lists : false,
		paste_unindented_list_class : "unindentedList",
		paste_convert_headers_to_strong : true,

		// Example content CSS (should be your site CSS)
		content_css : "../style.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		setup : function(ed) {
		ed.onPaste.add( function(ed, e, o) {
             ed.windowManager.open({file:'tiny_mce/jscripts/tiny_mce/plugins/paste/pastetext.htm',width:450,height:400,inline:1},{plugin_url:'tiny_mce/jscripts/tiny_mce/plugins/paste/'});
			 return tinymce.dom.Event.cancel(e);

       });

     }

	});

</script>
<!-- /TinyMCE -->

        <div id="wrapper">
			<div id="content">
				<?=$msg?>
            	<div id="box">
                	<h3><?=$ptitle?></h3>
					<form id="form" method="post" action="<?=$this_page?>.php">
                	<table width="100%">
						<thead>
							<tr>
							<th width="40px">ID</th>
							<th align="center">Name</th>
                            <th align="center">Created Date</th>
                            <th width="40px">Action</th>
                            </tr>
						</thead>
						<tbody>
						<?php
						while ($rs=mysql_fetch_object($sql)){ 
						$d = $rs->createddate;
						$dd = explode(" ", $d);
						$cd = explode("-", $dd[0]);
						$createdate = $cd[1]."-".$cd[2]."-".$cd[0];
						?>
							<tr>
								<td align="center"><?=$rs->id?></td>
                            	<td align="center"><a href="<?=$this_page?>.php?id=<?=$rs->id?>&act=edit"><? echo $rs->name; ?></a></td>
								<td align="center"><a href="<?=$this_page?>.php?id=<?=$rs->id?>&act=edit"><? echo $createdate; ?></a></td>
                                <td><a href="<?=$this_page?>.php?id=<?=$rs->id?>&act=edit"><img src="images/icons/brick_edit.png" title="Edit" width="16" height="16" /></a><a href="javascript:if(confirm('Proceed with deletion?')){window.location='<?=$this_page?>.php?id=<?=$rs->id?>&act=delete';}"><img src="images/icons/page_white_delete.png" title="Delete" width="16" height="16" /></a></td>
                            </tr>
						<? } ?>
						</tbody>
					</table>
					</form>
					<center>
					<? if ($no_of_records>10) { ?>
					<?=$PageLinks?>&nbsp;View <select name="limit" onchange="javascript:window.location='?limit='+this.value">
                    				<option value="10" <? if ($_SESSION[$this_page.'_limit']==10) echo "selected";?>>10</option>
                                    <option value="20" <? if ($_SESSION[$this_page.'_limit']==20) echo "selected";?>>20</option>
                                    <option value="50" <? if ($_SESSION[$this_page.'_limit']==50) echo "selected";?>>50</option>
                                    <option value="100" <? if ($_SESSION[$this_page.'_limit']==100) echo "selected";?>>100</option>
                    			</select>
                    per page<br/>
					<? } ?>
					Total <b><?=$no_of_records?></b> Records Found.
					</center>
				</div>
				<br />

                <div id="box">
					<?php
					if ($_GET["act"]=="edit") { if ($_GET["act"]=="edit") $id=santisize($_GET["id"]); ?>
					<h3 id="update_page">Update <?=$stitle?></h3>
                    <form id="form" name="form1" action="<?=$this_page?>.php" method="post" onsubmit="return <?=$stitle?>();">
					<fieldset>
					<legend><?=$stitle?> Content</legend>
					<input name="id" type="hidden" value="<?=$id?>">
                     	<table>
							<tr>
								<td style="padding-left:15px;padding-top:10px;"><b>Name :</b> <input name="name" id="name" type="text" maxlength="255" value="<?=getname("name",PREFIX.$this_page,"id",$id);?>" style="width:300px" /><br/><br/>
								<b>Description :</b>
								<textarea name="description" id="description" style="height:500px;"><?=getname("description",PREFIX.$this_page,"id",$id);?></textarea>
								</td>
							</tr>
						</table>
					</fieldset>

                    <div align="center">
                      <input id="button1" type="submit" name="submit" value="Update" />
                      <input id="button2" type="button" value="Cancel" onclick="javascript:window.location='<?=$this_page?>.php'"/>
                    </div>
                    </form>
					<script language="javascript">
					document.form1.submit.focus();
					</script>
					<? } else { ?>
                	<h3 id="add_page">Add New <?=$stitle?></h3>
                    <form id="form" name="form1" action="<?=$this_page?>.php" method="post" onsubmit="return <?=$stitle?>();">
					<fieldset>
					<legend><?=$stitle?> Content</legend>
						<table width="100%" cellpadding="0" cellspacing="2">
							<tr>
								<td style="padding-left:15px;padding-top:10px;"><b>Name :</b> <input name="name" id="name" type="text" maxlength="255" style="width:300px" /><br/><br/>
								<b>Description :</b>
								<textarea name="description" id="description" style="height:500px;"></textarea>
								</td>
							</tr>
						</table>
						</div>
					</fieldset>
					<div align="center">
                      		<input id="button1" type="submit" name="submit" value="Add" />
                      		<input id="button2" type="reset" value="Reset" name="reset" />
					</div>
                    </form>
					<? } ?>
                </div>
            </div>

   	  	<?php
	  	require("footer.php");
	  	?>
	</div>
</body>
</html>
