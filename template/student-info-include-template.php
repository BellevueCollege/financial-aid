<?php
/** Student info partial template
* Not to be used stand alone as it requires student information to be available
* Meant to be reused in other templates as needed
**/
?>
<div class="col-md-4 col-xs-12 pull-right">
	<div class="alert alert-info">
		<h4>
			<span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;<?php echo $first_name." ".$last_name; ?>
			&nbsp;&nbsp;<small>Not <em><?php echo $first_name; ?></em>? <a href="?logout=">Log out</a>.</small>
		</h4>
		<p>
			<strong>Email:</strong> <?php if(!empty($email)) echo $email; ?>
		</p>
		<?php if (!$ssn) { ?>
			<p><em>Note:</em> You do not have an SSN on record. Contact Admissions to provide them your SSN.</p>
		<?php } ?>
	</div>
</div>