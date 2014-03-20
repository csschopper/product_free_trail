<?php
defined('C5_EXECUTE') or die("Access Denied.");

$upToPage = Page::getByPath("/dashboard");
echo  Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Trail Form Submit Details '),t('See list of submited here. '), 'span8 offset2',true, -1, $upToPage);
$db= Loader::db();
$r = $db->Execute('select distinct(BFQ.question) from btFormQuestions AS BFQ join btTrailFormSubmit AS BTFS ON BTFS.questionSetId = BFQ.questionSetId ');
$questions = $r->getAll();


$ansQuery = $db->Execute('select distinct(asID) from btTrailFormSubmit');
$ansQueryData = $ansQuery->getAll();

?>

<form method="post" class="form-horizontal" id="site-form" action="">
<div class="ccm-pane-body">
	<?php if(!empty($questions) ) { ?>
	<table class="table">
		<thead>
			<th> <?php echo('Sl'); ?> </th>
			<?php if(!empty( $questions )): 
				foreach ( $questions as $question):
			?>
			<th><?php echo $question['question']; ?></th>
			<?php endforeach;endif;?>
		</thead>
		<tbody>
		<?php $i = 1; if(!empty( $ansQueryData )): foreach ( $ansQueryData as $ansID):
				
				$ansDataQuery = $db->Execute('select answer , answerLong from btFormAnswers WHERE asID = ? ' , array($ansID['asID']));
				$submitValue = $ansDataQuery->getAll();
				
			?>
			<tr>
			<td><?php echo $i;?></td>
			<?php foreach ( $questions as $key => $question): ?>
				<td><?php echo ($submitValue[$key]['answer']) ? $submitValue[$key]['answer'] : $submitValue[$key]['answerLong']; ?></td>
			<?php endforeach;?>
			</tr>
		<?php $i++; endforeach;endif;?>		
		</tbody>
		
	</table>
	<?php } else{ ?>
		<span>No results </span>
	<?php } ?>	
</div>

</form>
<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false);?>
