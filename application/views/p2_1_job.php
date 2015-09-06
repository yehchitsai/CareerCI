
<div data-role="fieldcontain">
	<H3 align="center">請選擇你未來想要達成的職業</H3>
	<ul id="jt" class="jtc" data-role="listview" data-filter="false" data-theme="a" style="margin-bottom: 50px;" data-split-icon="star" data-split-theme="a">
		{job_query}
		<li class="ui-btn">
			<a href='#detailJob' >{jt_name}</a>
			<a href='#' class='split-button-custom' onclick='alert("已成功追蹤");' data-role='button' data-icon='star' data-iconpos='notext'>追蹤</a><br/>
			<a href='#score'></a><div class="bar_place">{progress_bar}</div>
		</li>
		{/job_query}
	</ul>		
</div>
