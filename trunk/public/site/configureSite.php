<div class="container-fluid">
	<h1 class="page-heading">Configuration Page</h1>
	<form action="controls/Site.php?Save" method="post">
		<input type="hidden" value="<?php echo $site->getId()?>" name="id"/>
		<label>Language :</label>	
		<select class="form-control" name="language" >
			<option value='en'>English</option>
			<option value='kh'>Khmer</option>
		</select>
		<br>
		<button type="submit" class="btn btn-primary">save</button>
	</form>
</div>