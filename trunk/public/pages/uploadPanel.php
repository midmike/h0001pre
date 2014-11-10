<link href="assets/css/imgareaselect-animated.css" rel="stylesheet">
<h1 class="page-heading">
	<?php i18n::getLabel("foods")?><small><?php echo str_repeat('&nbsp;', 3);i18n::getLabel("image.and.price")?></small>
</h1>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><?php i18n::getLabel("create.new.food")?></h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-xs-6 col-md-5">
				<form role="form" enctype="multipart/form-data" method="post">
					<div class="form-group">
						<label><?php i18n::getLabel("food.code")?></label>
						<input type="text" class="form-control" placeholder="" id="foodCode">
					</div>
					<div class="form-group">
						<label><?php i18n::getLabel("food.name")?></label>
						<input type="text" class="form-control" placeholder="" id="foodName">
					</div>
					<div class="form-group">
						<label><?php i18n::getLabel("food.price")?></label>
						<div class="input-group">
							<span class="input-group-addon">$</span>
							<input type="text" class="form-control" id="foodPrice">
						</div>
					</div>
					<div class="form-group">
						<label><?php i18n::getLabel("food.type")?></label>
						<select class="form-control" id="foodType">
							<?php for($i = 1; $i <= 5; $i ++) {
								echo "<option value='$i'>Food type $i</option>";
							} ?>
						</select>
					</div>
					<div class="checkbox">
						<label> <input type="checkbox" checked><?php i18n::getLabel("active")?></label>
					</div>
					<span class="btn btn-success rm-fileinput-button">
						<i style="font-weight: bolder;" class="fa fa-plus"></i>
						<span><?php i18n::getLabel("add.file")?></span>
						<input type="file" name="file" id="file">
					</span>
					<button class="btn btn-primary" type="button" onclick="uploadFile()">
						<i class="fa fa-cloud-upload"></i>
						<span><?php i18n::getLabel("start.upload")?></span>
					</button>
					<br>
					<br>
					<div class="progress">
						<div id="progress-bar" class="progress-bar" role="progressbar"
							aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
							style="width: 0%;">0%</div>
					</div>
					<input type="hidden" id="cropX">
					<input type="hidden" id="cropY">
					<input type="hidden" id="cropW">
					<input type="hidden" id="cropH">
				</form>
			</div>
			<div class="col-xs-6 col-md-5">
				<div class="thumbnail" id="avatarBackground">
					<img id="img-thumbnail">
				</div>
			</div>
			<div class="col-xs-6 col-md-1">
				<button class="btn btn-danger" type="button" onclick="saveImage()">
					<i class="fa fa-floppy-o"></i>
					<span><?php i18n::getLabel("save")?></span>
				</button>
			</div>
		</div>
	</div>
</div>