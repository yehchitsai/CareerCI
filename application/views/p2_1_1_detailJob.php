<div data-role="fieldcontain" align="center" style="overflow: auto">
	<div class="row" id="mainlist">
			<h2 style="text-align:center;" id="job_name" rel="{jt_id}">{jt_name}</h2>
			<div class="list-group" style="text-align:left;">
			</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		url=CILocation + "career/joblistappend/{jt_id}/1";
		$.get(url,function(data){
			$('.keepload').remove();
			$('.list-group').append(data);
		});
	})
</script>
