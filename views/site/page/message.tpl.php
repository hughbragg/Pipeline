<?php

$fork = $SOUP->fork();
$fork->set('pageTitle', 'Inbox');
$fork->startBlockSet('body');

?>

<td class="left">

<?php
	$SOUP->render('site/partial/message', array(
	));
?>

</td>

<td class="right">

</td>

<?php

$fork->endBlockSet();
$fork->render('site/partial/page');