<?php
/*
 * Copyright 2005-2013 the original author or authors.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

require_once("inc_menu.php");
$page['title'] = getlocal("canned.title");
$page['menuid'] = "canned";

function tpl_content() { global $page, $webimroot, $errors;
?>

<?php echo getlocal("canned.descr") ?>
<br />
<br />
<?php 
require_once('inc_errors.php');
?>

<form name="cannedForm" method="get" action="<?php echo $webimroot ?>/operator/canned.php">
	
	<div class="mform"><div class="formtop"><div class="formtopi"></div></div><div class="forminner">

	<div class="packedFormField">
		<?php echo getlocal("canned.locale") ?><br/>
		<select name="lang" onchange="this.form.submit();"><?php
			foreach($page['locales'] as $k) {
				echo "<option value=\"".$k["id"]."\"".($k["id"] == form_value("lang") ? " selected=\"selected\"" : "").">".$k["name"]."</option>";
			} ?></select>
	</div>

	<div class="packedFormField">
		<?php echo getlocal("canned.group") ?><br/>
		<select name="group" onchange="this.form.submit();"><?php 
			foreach($page['groups'] as $k) { 
				echo "<option value=\"".$k["groupid"]."\"".($k["groupid"] == form_value("group") ? " selected=\"selected\"" : "").">".str_repeat('&nbsp', $k['level']*2).$k["vclocalname"]."</option>";
			} ?></select>
	</div>

	
	<br clear="all"/>
	
	</div><div class="formbottom"><div class="formbottomi"></div></div></div>
</form>
<br/>

<div class="tabletool">
	<img src="<?php echo $webimroot ?>/images/buttons/createban.gif" border="0" alt=""/>
	<a href="<?php echo $webimroot ?>/operator/cannededit.php?lang=<?php echo form_value("lang") ?>&amp;group=<?php echo form_value("group")?>" target="_blank" 
				onclick="this.newWindow = window.open('<?php echo $webimroot ?>/operator/cannededit.php?lang=<?php echo form_value("lang") ?>&amp;group=<?php echo form_value("group")?>', '', 'toolbar=0,scrollbars=1,location=0,status=1,menubar=0,width=640,height=480,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;">
		<?php echo getlocal("canned.add") ?>
	</a>
</div>
<br clear="all"/>

<?php if( $page['pagination'] ) { ?>

<table class="translate">
<thead>
	<tr class="header"><th>
		<?php echo getlocal("canned.message_title") ?>
	</th><th>
		<?php echo getlocal("cannededit.message") ?>
	</th><th>
		<?php echo getlocal("canned.actions") ?>
	</th></tr>
</thead>
<tbody>
<?php 
if( $page['pagination.items'] ) {	
	foreach( $page['pagination.items'] as $localstr ) { ?>
	<tr>
		<td>
			<?php echo str_replace("\n", "", htmlspecialchars(topage($localstr['vctitle']))) ?>
		</td>
		<td>
			<?php echo str_replace("\n", "<br/>",htmlspecialchars(topage($localstr['vcvalue']))) ?>
		</td>
		<td>
			<a href="<?php echo $webimroot ?>/operator/cannededit.php?key=<?php echo $localstr['id'] ?>" target="_blank" 
				onclick="this.newWindow = window.open('<?php echo $webimroot ?>/operator/cannededit.php?key=<?php echo $localstr['id'] ?>', '', 'toolbar=0,scrollbars=1,location=0,status=1,menubar=0,width=640,height=480,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;"><?php echo getlocal("canned.actions.edit") ?></a>, 
			<a href="<?php echo $webimroot ?>/operator/canned.php?act=delete&amp;key=<?php echo $localstr['id'] ?>&amp;lang=<?php echo form_value("lang") ?>&amp;group=<?php echo form_value("group")?><?php print_csrf_token_in_url() ?>"><?php echo getlocal("canned.actions.del") ?></a>
		</td>
	</tr>
<?php
	} 
} else {
?>
	<tr>
	<td colspan="3">
		<?php echo getlocal("tag.pagination.no_items.elements") ?>
	</td>
	</tr>
<?php 
} 
?>
</tbody>
</table>
<?php
	if( $page['pagination.items'] ) { 
		echo "<br/>";
		echo generate_pagination($page['pagination']);
	}
} 
?>

<?php 
} /* content */

require_once('inc_main.php');
?>