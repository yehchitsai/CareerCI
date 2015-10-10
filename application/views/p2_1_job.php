<div data-role="fieldcontain">
	<H3 align="center">{job_caption}</H3>
	<br/>
	<ul id="jt" class="jtc" data-role="listview" data-filter="false" data-theme="a" style="margin-bottom: 50px;" data-split-icon="arrow-r" data-split-theme="a">
		{job_query}
		<li class="ui-btn">
			<a href='#detailJob@todetailJob@{jt_id}'>{jt_name}</a>
			<a href='#' class='split-button-custom track' id="track{jt_id}" onclick='addtrack(this)' data-role='button' data-icon='star' data-iconpos='notext'>追蹤</a><br/>
			<a href='#score@toscore@{jt_id}'></a>
			{progress_bar}
		</li>
		{/job_query}
	</ul>
	<script>
	$(document).ready(function(){
		settrack();
	})
	</script>
</div>
