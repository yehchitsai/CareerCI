<div data-role="fieldcontain" align="center" style="overflow: auto">
	<div class="row" id="mainlist">
			<h2 style="text-align:center;" id="job_name" rel="{jt_id}">{jt_name}</h2>
			<div class="list-group" style="text-align:left;">
				{job_query}
	  			<a class="list-group-item" rel="{j_url}">
	    		<h4 >{j_name}<small>{j_cname}</small></h4>
	    		<h4>{j_address}<span class="label label-default">{j_setdate}</span></h4>
	  			</a>
	  			{/job_query}
	  			<a class="list-group-item keepload">
	    		<input type="button" class="form-control" rel="2" onclick=jobload(this) value="繼續載入">
	  			</a>
			</div>
		</div>
</div>
