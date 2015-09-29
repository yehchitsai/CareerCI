{job_query}
	<a class="list-group-item" rel="{j_url}">
	<h1>{j_name}<small>{j_cname}</small></h1>
	<h3>{j_address}<span class="label label-default">{j_setdate}</span></h3>
	</a>
{/job_query}
<a class="list-group-item keepload">
<input type="button" class="form-control" rel="{page}" onclick=jobload(this) value="繼續載入">
</a>