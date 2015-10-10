<div data-role="fieldcontain" align="center" style="overflow: auto">
	<div class="row" id="mainlist" rel="{jt_id}" >
			<div class="list-group" style="text-align:left;">
			</div>
	</div>
</div>
<script>
	$(document).ready(function(){		
		url=urlmaker("#joblistappend",[{jt_id},1]);
		$.get(url,function(data){
			$('.keepload').remove();
			$('.list-group').append(data);
		});
		$('#lan_detailjob').text("{jt_name}");
	});
</script>
