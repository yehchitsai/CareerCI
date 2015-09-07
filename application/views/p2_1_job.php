<script>
	$(document).ready(function(){
		$('.progress').click(function(){
			var jt_id=$(this).attr('id');
			var $page = $(screen);
			var $url = CILocation + "career/score/"+jt_id;
			var $content = $page.children(":jqmData(role=content)");
			//console.log("url = " + $url);
			// Inject the list markup into the content element.
			$.get($url, function(data){
				$content.html(data);
		//		$page.page();
				$page.enhanceWithin();
				$.mobile.changePage($page, options);
			});
		});
	})
</script>
<div data-role="fieldcontain">
	<H3 align="center">請選擇你未來想要達成的職業</H3>
	<ul id="jt" class="jtc" data-role="listview" data-filter="false" data-theme="a" style="margin-bottom: 50px;" data-split-icon="star" data-split-theme="a">
		{job_query}
		<li class="ui-btn">
			<a href='#detailJob' >{jt_name}</a>
			<a href='#' class='split-button-custom' onclick='alert("已成功追蹤");' data-role='button' data-icon='star' data-iconpos='notext'>追蹤</a><br/>
			<a href='#score'></a>
			{progress_bar}
		</li>
		{/job_query}
	</ul>		
</div>
