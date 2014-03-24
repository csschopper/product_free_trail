<?php    
defined('C5_EXECUTE') or die("Access Denied.");
$survey=$controller;  
//echo $survey->surveyName.'<br>';
$miniSurvey=new TrailMiniSurvey($b);
$miniSurvey->frontEndMode=true;
?>
<a name="<?php  echo $survey->questionSetId ?>"></a><br/>
<?php  if ($invalidIP) { ?>
<div class="ccm-error"><p><?php echo $invalidIP?></p></div>
<?php  } ?>
<div style="border: 1px solid #CCCCCC;font-size: 12px;padding: 4px;>
<form enctype="multipart/form-data" id="miniSurveyView<?php echo intval($bID)?>" class="miniSurveyView" method="post" action="<?php  echo $this->action('submit_form').'#'.$survey->questionSetId?>">
	<?php   if( $_GET['surveySuccess'] && $_GET['qsid']==intval($survey->questionSetId) ){ ?>
		<div id="msg"><?php  echo $survey->thankyouMsg ?></div> 
	<?php   }elseif(strlen($formResponse)){ ?>
		<div id="msg">
			<?php  echo $formResponse ?>
			<?php  
			if(is_array($errors) && count($errors)) foreach($errors as $error){
				echo '<div class="error">'.$error.'</div>';
			} ?>
		</div>
	<?php  } ?>
	<input name="qsID" type="hidden" value="<?php echo  intval($survey->questionSetId)?>" />
	<?php   $miniSurvey->loadSurvey( $survey->questionSetId, 0, intval($bID) );  ?> 
</form>
<div style="">
<a href="http://www.csschopper.com/psd-to-concrete5.shtml" target="_blank">
<img src="<?php echo View::url(''); ?>/packages/product_free_trail/blocks/trial_form/site-credit.png" border="0" /></a>
</div>
</div>
