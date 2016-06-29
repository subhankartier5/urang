<?php
$page="cms.php";
require("header.php");
require_once("includes/pagination.php");
require("includes/class.upload.php");

$stitle = "Menu Link";
$ptitle = "Menu Links";

$current_url=$_SERVER['PHP_SELF'];
$loc1=strrpos($current_url,"/")+1;
$loc2=strrpos($current_url,".")-1;

for ($a=$loc1;$a<=$loc2;$a++) {
	$this_page.=$current_url[$a];
}

if ($_POST[submit]=="Add"){
	$error='';
	$url_filter="/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/";
	
	$name=santisize(stripslashes(trim($_POST[menu_name])));
	$page=santisize(stripslashes(trim($_POST[page])));
	$other_url=santisize(stripslashes(trim($_POST[other_url])));
	
	if ($name=="")
		$error.='Please Enter '.$stitle.' Name.<br />';
	
	if ($other_url!="http://") {
		if (!preg_match($url_filter,$other_url))
			$error.="Invalid ".$stitle." URL.<br />";
	}
		
	if (no_of_records(PREFIX.$this_page,"name",$name)==1){
		$error.=$stitle.' Name already exists.<br />';
	}
	
	if ($error!=NULL)
		$msg.='<div class="error">Errors:<br /><br />'.$error.'</div>';		
	else{
		$sql=mysql_query("insert into ".PREFIX.$this_page." 
						 (name,
						  page,
						  other_url
						  ) 
						  values(
						  '$name',
						  '$page',
						  '$other_url'
						  )");
		$value=mysql_insert_id();
		$insert=mysql_query("update ".PREFIX.$this_page." set 
							 value='$value'
							 where id='$value'");	
		$msg='<div class="success">'.$stitle.' Added.</div>';
		$name=NULL;
		$page=NULL;
		$other_url=NULL;
	}		
}

else if ($_POST[submit]=="Update"){
	$update=1;
	$id=santisize($_POST[id]);
	
	$url_filter="/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/";
	
	$name=santisize(stripslashes(trim($_POST[menu_name])));
	$page=santisize(stripslashes(trim($_POST[page])));
	$other_url=santisize(stripslashes(trim($_POST[other_url])));
	
	if ($name=="")
		$error.='Please Enter '.$stitle.' Name.<br />';
	
	if ($other_url!="http://") {
		if (!preg_match($url_filter,$other_url))
			$error.="Invalid ".$stitle." URL.<br />";
	}
		
	if (no_of_records(PREFIX.$this_page,"name",$name)==1 && getname("name",PREFIX.$this_page,"id",$id)!=$name){
		$error.=$stitle.' Name already exists.<br />';
	}
	
	if ($error!=NULL)
		$msg.='<div class="error">Errors:<br /><br />'.$error.'</div>';		
	else{
		$sql=mysql_query("update ".PREFIX.$this_page." set 
						  name='$name',
						  page='$page',
						  other_url='$other_url'
						  where id='$id'");
		$msg='<div class="success">'.$stitle.' Updated.</div>';
		$name=NULL;
		$page=NULL;
		$other_url=NULL;
		$update=0;
	}		
}

else if ($_POST[pos_update]=="Sort"){
	$rec_id=$_POST[rec_id];
	$pos=$_POST[pos];
	for ($a=0;$a<count($rec_id);$a++){
		if ($pos[$a]!='' && is_numeric($pos[$a])){
			if (getname("value",PREFIX.$this_page,"id",$rec_id[$a])!=$pos[$a]) {
				$new_pos[]=$pos[$a];
				$new_rec_id[]=$rec_id[$a];
			}
		}
		
	}
	$size=count($new_pos); 
	for($x = 0; $x < $size; $x++) {
	  for($y = 0; $y < $size; $y++) {
		if($new_pos[$x] < $new_pos[$y]) {
		  $hold_pos = $new_pos[$x];
		  $new_pos[$x] = $new_pos[$y];
		  $new_pos[$y] = $hold_pos;
		  $hold_rec_id = $new_rec_id[$x];
		  $new_rec_id[$x] = $new_rec_id[$y];
		  $new_rec_id[$y] = $hold_rec_id;
		}
	  }
	}

	for($a = 0; $a < $size; $a++){
		if (no_of_records(PREFIX."styles","value",$new_pos[$a])==0)
			mysql_query("update ".PREFIX.$this_page." set value='$new_pos[$a]' where id='$new_rec_id[$a]'");
		else{
			mysql_query("update ".PREFIX.$this_page." set value='$new_pos[$a]' where id='$new_rec_id[$a]'");
			print $new_rec_id[$a] . "=".$new_pos[$a]."<br/>";
			mysql_query("update ".PREFIX.$this_page." set value=value+1 where id!='$new_rec_id[$a]' AND value>='$new_pos[$a]'");
		}
	}

	
	$msg='<div class="success">Sorting Complete.</div>';
	$sort=mysql_query("select * from ".PREFIX.$this_page." order by value asc");	
	$counter=0;
	while ($rs=mysql_fetch_object($sort)) {
		$counter++;
		mysql_query("update ".PREFIX.$this_page." set value='$counter' where id='$rs->id'");
	}
}

else if ($_GET[act]=="delete"){
	$id=santisize($_GET[id]);
	$sql=mysql_query("delete from ".PREFIX.$this_page." where id='$id'");
	$msg='<div class="success">'.$stitle.' Deleted.</div>';	
}

if ($_SESSION[$this_page.'_sort']==NULL){
	$_SESSION[$this_page.'_sort']="value";
	$_SESSION[$this_page.'_order']="asc";
}
else if ($_GET[sort]!=NULL){
	if ($_GET[sort]==$_SESSION[$this_page.'_sort']){
		if ($_SESSION[$this_page.'_order']=="asc")
			$_SESSION[$this_page.'_order']="desc";
		else
			$_SESSION[$this_page.'_order']="asc";	
	}
	else{
		$_SESSION[$this_page.'_sort']=santisize($_GET[sort]);
		$_SESSION[$this_page.'_order']="asc";
	}
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
	$query = "select * from ".PREFIX.$this_page." order by ".$_SESSION[$this_page.'_sort']." ".$_SESSION[$this_page.'_order'].$PaginateIt->GetSqlLimit();
}
// Pagination class //
$sql=mysql_query($query);
?>
<!-- TinyMCE -->
<script type="text/javascript" src="tiny_mce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		force_br_newlines : true,
		forced_root_block : '',
		theme_advanced_path : false,
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
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
		<div id="top-panel">
			<div id="panel">
				<ul>
					<? include ("cms_menu_links.php"); ?>
                </ul>
            </div>
		</div>
        <div id="wrapper">
			<div id="content">
				<?=$msg?>
            	<div id="box">
                	<h3><?=$ptitle?></h3>
					<form id="form" method="post" action="<?=$this_page?>.php">
                	<table width="100%">
						<thead>
							<tr>
							<th width="40px"><a href="?sort=id">ID</a></th>
                            <th align="left"><a href="?sort=name">Name</a></th>
							<th align="left"><a href="?sort=name">Page</a></th>                                
							<th align="center"><a href="?sort=value">Pos</a></th>
                            <th width="40px"><a href="#">Action</a></th>
                            </tr>
						</thead>
						<tbody>
						<?php
						while ($rs=mysql_fetch_object($sql)){ ?>
							<tr>
								<td align="center"><?=$rs->id?></td>
                            	<td><a href="<?=$this_page?>.php?id=<?=$rs->id?>&act=edit"><? echo $rs->name; ?></a></td>
								<td>
									<? if ($rs->page!="0") { ?>
									<a href="<?=getname("site_url",PREFIX."config",1,1).getname("name",PREFIX."pages","id",$rs->page)?>" target="_blank"><?=getname("site_url",PREFIX."config",1,1).getname("name",PREFIX."pages","id",$rs->page)?></a>
									<? } else if ($rs->other_url!="http://") { ?>
									<a href="<?=$rs->other_url?>" target="_blank"><?=$rs->other_url?></a>
									<? } else {?>
									N/A
									<? } ?>
								</td>
								<td align="center"><input type="hidden" name="rec_id[]" value="<?=$rs->id?>" /><input type="text" name="pos[]" value="<?=$rs->value?>" style="width:35px;text-align:center;"/></td>
                                <td><a href="<?=$this_page?>.php?id=<?=$rs->id?>&act=edit"><img src="images/icons/brick_edit.png" title="Edit" width="16" height="16" /></a><a href="javascript:if(confirm('Proceed with deletion?')){window.location='<?=$this_page?>.php?id=<?=$rs->id?>&act=delete';}"><img src="images/icons/page_white_delete.png" title="Delete" width="16" height="16" /></a></td>
                            </tr>
						<? } ?>
						<? if ($no_of_records>0) { ?>
							<tr>
								<td colspan="3"></td>
								<td align="center"><input type="submit" name="pos_update" value="Sort" /></td>		
								<td></td>
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
					if ($_GET[act]=="edit" || $update==1) { if ($_GET[act]=="edit") $id=santisize($_GET[id]); ?>
					<h3 id="update_event">Update <?=$stitle?></h3>
                    <form id="form" name="form1" action="<?=$this_page?>.php" method="post" onsubmit="return Menu();">
					<input name="id" type="hidden" value="<?=$id?>">
					<fieldset>
					  	<label for="name">Name<span class="required">*</span> : </label> 
                        <input name="menu_name" id="menu_name" type="text" maxlength="255" value="<?=getname("name",PREFIX.$this_page,"id",$id)?>"/>
                        <br />
                        <label for="url">Page : </label> 
                        <select name="page"><option value="">None</option>
						<?
						$sql=mysql_query("select * from ".PREFIX."pages order by value asc");
						while ($rs=mysql_fetch_object($sql)){ ?>
						<option value="<?=$rs->id?>" <? if ($rs->id==getname("page",PREFIX.$this_page,"id",$id)) echo "selected";?>><?=$rs->name?></option>	
						<? } ?>
						</select>
                        <br />
						<label for="name">Other URL : </label> 
                        <input name="other_url" id="other_url" type="text" maxlength="255" value="<? if (getname("other_url",PREFIX.$this_page,"id",$id)) echo getname("other_url",PREFIX.$this_page,"id",$id); else echo "http://"; ?>" size="50"/> (begin with http://)
                        <br />
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
                	<h3 id="add_event">Add New <?=$stitle?></h3>
                    <form id="form" name="form1" action="<?=$this_page?>.php" method="post" onsubmit="return Menu();">
					<fieldset>
					  	<label for="name">Name<span class="required">*</span> : </label> 
                        <input name="menu_name" id="menu_name" type="text" maxlength="255" value="<?=$name?>"/>
                        <br />
                        <label for="url">Page : </label> 
                        <select name="page"><option value="">None</option>
						<?
						$sql=mysql_query("select * from ".PREFIX."pages order by value asc");
						while ($rs=mysql_fetch_object($sql)){ ?>
						<option value="<?=$rs->id?>" <? if ($rs->id==$page) echo "selected";?>><?=$rs->name?></option>	
						<? } ?>
						</select>
                        <br />
						<label for="name">Other URL : </label> 
                        <input name="other_url" id="other_url" type="text" maxlength="255" value="<? if ($other_url) echo $other_url; else echo "http://"; ?>" size="50"/> (begin with http://)
                        <br />
                    </fieldset>
					<div align="center">
                      		<input id="button1" type="submit" name="submit" value="Add" /> 
                      		<input id="button2" type="reset" />
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
