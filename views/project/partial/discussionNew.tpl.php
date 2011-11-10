<?php$project = $SOUP->get('project');$cat = $SOUP->get('cat');$fork = $SOUP->fork();$fork->set('title', 'New Discussion');$fork->startBlockSet('body');?><script type="text/javascript">$(document).ready(function(){	$('#txtTitle').focus();	$('#selCategory').val('<?= $cat ?>');	$('#btnCreateDiscussion').click(function(){		buildPost({			'processPage':'<?= Url::discussionNewProcess($project->getID()) ?>',			'info':{				'action':'create',				'title':$('#txtTitle').val(),				'message':$('#txtMessage').val(),				'cat':$('#selCategory').val()			},			'buttonID':'#btnCreateDiscussion'		});	});	});</script><div class="clear">	<label for="txtTitle">Title<span class="required">*</span></label>	<div class="input">		<input id="txtTitle" type="text" maxlength="255" />	</div></div><div class="clear">	<label for="txtMessage">Message<span class="required">*</span></label>	<div class="input">		<textarea id="txtMessage"></textarea>		<p><a class="help-link" href="<?= Url::help() ?>#help-html-allowed">Some HTML allowed</a></p>	</div></div><div class="clear">	<label for="selCategory">Category</label>	<div class="input">		<select id="selCategory">			<option value="">(none)</option>			<option value="<?= BASICS_ID ?>">Basics</option>			<option value="<?= TASKS_ID ?>">Tasks</option>			<option value="<?= PEOPLE_ID ?>">People</option>			<option value="<?= ACTIVITY_ID ?>">Activity</option>		</select>		<p>Optional category for this discussion</p>	</div></div><div class="clear">	<div class="input">		<input id="btnCreateDiscussion" type="button" value="Post Discussion" />	</div></div><?php$fork->endBlockSet();$fork->render('site/partial/panel');