<div class="panel grid vb_add bg_py" id="vb_add">
	<div class=" form-inline">
		<div class="form-group col-md-5">
			<h2>新增版本</h2>
		</div>
		<div class="form-group col-md-5">
			<paper-button tabindex="0" onclick=v_additem_valid() raised class="btn-success" >完成送出</paper-button>
		</div>
		<div class="form-group pull-right">
			<paper-icon-button class='' onclick=clean_grid('vb_add') icon="clear" ></paper-icon-button>
		</div>
	</div>
	<form class="vf_add">
		<div class="col-md-12">
			<paper-input label="發佈名稱" id='vf_name'  required auto-validate ></paper-input>
		</div>
		<div class="col-md-12">
			<paper-input label="版本編號" id='vf_version'  required auto-validate ></paper-input>
		</div>
		<div class="col-md-12">
			<paper-input label="發佈者" id='vf_poster'  required auto-validate ></paper-input>
		</div>
		<div class="">
			<table width="100%" border="0">
				<tr>
					<td width='40%'; style="font-size:16px;"><div class="col-md-12">
			<paper-input label="發佈類型" id='vf_pt'  required></paper-input>
		</div></td>
					<td class="project-type" width='20%';><div title="release" onclick=form_changeprojecttype(this) class="release-phase icon-shadow" style="width:40px;height:40px;font-size:30px;line-height:37px;"></div></td>
					<td class="project-type" width='20%';><div title="beta" onclick=form_changeprojecttype(this) class="beta-phase icon-shadow" style="width:40px;height:40px;font-size:30px;line-height:37px;"></div></td>
					<td class="project-type" width='20%';><div title="alpha" onclick=form_changeprojecttype(this) class="alpha-phase icon-shadow" style="width:40px;height:40px;font-size:30px;line-height:37px;"></div></td>
				</tr>
			</table>
		</div>
		<div class="col-md-12">
			<paper-input label="GIT版本選擇" id='vf_gitsha' required auto-validate disabled></paper-input>
		</div>
		<div class="panel gittable" id="gittable">
		</div>
		<div class="col-md-12" style="margin-top: 10px;margin-bottom: 10px;">
            <div class="form-inline">
            	<div class="form-group">
            		<span style='font-size: 16px;'>發佈日期：</span>
            	</div>
            	<div class="form-group input-group">
            		<input type='text' class="form-control" id="vf_date" onmousedown=$(this).parent().removeClass('has-error'); />
	                <script type="text/javascript">
	            		$(function(){ $('#vf_date').datetimepicker(
	            				{format: 'YYYY-MM-D H:mm:ss'}

	            			);});
	        		</script>
            	</div>
            </div>
		</div>
	</form>
</div>