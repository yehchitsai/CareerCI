<div class="panel bg_lb grid" id="version_base">
	<div class="form-inline">
		<div class="form-group col-md-5">
            <h2>版本列表</h2>
    	</div>
    	<div class="form-group pull-right">
    		<paper-icon-button class="btn-add" raised suffix onclick=v_additem() icon="add" ></paper-icon-button>
    	</div>
	</div>
    <div class="col-md-12">
        <paper-input label="關鍵字搜尋" id="vkeysearch">
                <iron-icon icon="search" prefix></iron-icon>
                <paper-icon-button suffix onclick=""
                    icon="clear" alt="clear" title="clear" tabindex="0">
                </paper-icon-button>
        </paper-input>
    </div>
	<div class="panel vtable">
		<table class="table table-bordered table-hover table-condensed">
                <thead>
                    <td width="10%">Type</td>
                    <td width="50%">Name</td>
                    <td width="25%">Upload</td>
                    <td width="15%">Version</td>
                </thead>
                <tbody id="vt_rander">
                	<script>
                	$(document).ready(function(){
                        unloading();
                		get_basic_version();
                		$('#vkeysearch').find(input).keyup(function() {
  							version_key_search($('#vkeysearch').val());
						});
                	})
                	</script>
                </tbody>
        </table>
	</div>
</div>