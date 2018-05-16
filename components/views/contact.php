<?php
	$module = \Yii::$app->getModule('contact');
?>
<div>
	<div class="submit-review">
		<?php if($enabled_name) echo '<p><input class="form-control" type="text" name="name" id="name" placeholder="' . Yii::t('contact', 'Name') . '" /></p>'; ?>
		<?php if($enabled_subject) echo '<p><input class="form-control" type="text" name="subject" id="subject" placeholder="' .  Yii::t('contact', 'Subject') . '" /></p>'; ?>
		<p><input class="form-control" type="email" name="email" id="email" placeholder="<?= Yii::t('app', 'Email') ?>" /></p>
		<?php if($enabled_description) echo '<p><textarea class="form-control" name="message" id="message" placeholder="' . Yii::t('contact', 'Message') .'"></textarea></textarea></p>'; ?>
		<input class="form-control" type="button" value="<?= Yii::t('app', 'Send') ?>" onclick="post_comment()" />
	</div>
</div>

<script>
	var post_comment = function () {
		$.ajax({
			url: "<?= Yii::getAlias('@web') ?>/contact/admin/create",
			method: "POST",
			data: {
				<?php if ($enabled_name) echo 'name: $(\'#name\').val(),'?>
				email: $('#email').val(),
				description: $('#message').val(),
		<?= Yii::$app->request->csrfParam; ?>:"<?= Yii::$app->request->csrfToken; ?>"
	}
	})
		.done(function (response)
		{
			/*$('#name').val('');
			 $('#subject').val('');
			 $('#email').val('');
			 $('#message').val('');*/
			alert(response);
		})
			.fail(function( req, status, err )
			{
				//console.log( 'something went wrong', status, err );
			})
	}
</script>
