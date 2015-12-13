<div class="panel grid vb_view form-{type}" id='view{id}'>
	<div class="form-inline" style="margin-top:5px">
		<div class=" col-md-9 form-group">
			<paper-input label="版本名稱" id='vf_name{id}' value='{name}' required auto-validate disabled></paper-input>
		</div>
		<div class="form-group .col-md-1 project-type">
			<div class="{type}-phase" title="{type}"  style="width:40px;height:40px;font-size:30px;line-height:37px;"></div>
		</div>
		<div class="form-group pull-right">
			<paper-icon-button  onclick=clean_grid('view{id}') icon="clear" ></paper-icon-button>
		</div>
	</div>
	<div class="col-md-12">
			<paper-input label="發佈者" id='vf_poster{id}' value='{poster}' required auto-validate disabled></paper-input>
	</div>
	<div class="col-md-12">
			<paper-input label="版本編號" id='vf_version{id}' value='{version}' required auto-validate disabled></paper-input>
	</div>
	<div class="col-md-12">
			<paper-input label="發佈日期" id='vf_date{id}' value='{date}' required auto-validate disabled></paper-input>
	</div>
	<div class="col-md-12">
			<paper-input label="GIT SHAKEY" id='vf_gitsha{id}' value='{gitsha}' required auto-validate disabled></paper-input>
	</div>
	<div class="col-md-12" id="gitdetail{id}">
		<script>$(document).ready(function(){v_gitdetail('{gitsha}','{id}');})</script>
	</div>
	<div class="col-md-12">
		<h4>APP APIKEY：</h4>
	</div>
	<div class="col-md-12">
			<textarea style="width:100%;height:80px;" disabled>{auth_key}</textarea>
	</div>
	<div class="col-md-12">
		<div class=" form-inline">
		<div class="form-group">
			<paper-button tabindex="0" onclick=v_api_package('{auth_key}') raised class="btn-primary" >下載API KEY</paper-button>
		</div>
		<div class="form-group pull-right">
			<paper-button tabindex="0" onclick=v_deleteitem('{id}') raised class="btn-danger" >刪除版本</paper-button>
		</div>
	</div>
	</div>
</div>