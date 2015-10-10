{job_query}
	<a class="list-group-item" rel="{j_url}">
	<h5 class="djt">{j_name}<small>{j_cname}</small></h5>
	<h6 class="djst">{j_address}<span class="label label-default">{j_setdate}</span></h6>
	</a>
{/job_query}
<a class="list-group-item keepload">
<input type="button" class="form-control" rel="{page}" onclick=jobload(this) value="{detailjob_btn}">
</a>