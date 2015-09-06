<div data-role="fieldcontain">
<script>
	function printbar(val){
		var d="<div class='progress'>";
		if (val>20) {
			d+='<div class="progress-bar progress-bar-success" style="width: 20%">0%~20%</div>';
		}
		else if (val>20&&val<40){
			d+='<div class="progress-bar progress-bar-success" style="width: '+(val-20)+'%"></div>';
			d+='<div class="progress-bar progress-bar-empty" style="width: '+(100-val)+'%"><span style="text-align:left;color=black;">'+val+'分<span></div></div>';
			document.write(d);
			return;
		}
		if (val>40) {
			d+='<div class="progress-bar progress-bar-info" style="width: 20%">20%~40%</div>';
		}
		else if (val>40&&val<60){
			d+='<div class="progress-bar progress-bar-info" style="width: '+(val-40)+'%"></div>';
			d+='<div class="progress-bar progress-bar-empty" style="width: '+(100-val)+'%"><span style="text-align:left;color=black;">'+val+'分<span></div></div>';
			document.write(d);
			return;
		}
		if (val>60) {
			d+='<div class="progress-bar progress-bar-danger" style="width: 20%">40%~60%</div>';
		}
		else if (val>60&&val<80){
			d+='<div class="progress-bar progress-bar-danger" style="width: '+(val-60)+'%"></div>';
			d+='<div class="progress-bar progress-bar-empty" style="width: '+(100-val)+'%"><span style="text-align:left;color=black;">'+val+'分<span></div></div>';
			document.write(d);
			return;
		}
		if (val>80&&val<100) {
			d+='<div class="progress-bar progress-bar-warning" style="width: 20%">60%~80%</div>';
			d+='<div class="progress-bar progress-bar-shiny" style="width: '+(val-80)+'%"></div>';
			d+='<div class="progress-bar progress-bar-empty" style="width: '+(100-val)+'%"><span style="text-align:left;color=black;">'+val+'分<span></div></div>';
			document.write(d);
			return;
		}
		else if(val==100){
			d+='<div class="progress-bar progress-bar-shiny" style="width: 20%">100分!</div></div>';
			document.write(d);
			return;
		}
	}
</script>
	<H3 align="center">請選擇你未來想要達成的職業</H3>
	<ul id="jt" class="jtc" data-role="listview" data-filter="false" data-theme="a" style="margin-bottom: 50px;" data-split-icon="star" data-split-theme="a">
		{job_query}
		<li class="ui-btn">
			<a href='#detailJob' >{jt_name}</a>
			<a href='#' class='split-button-custom' onclick='alert("已成功追蹤");' data-role='button' data-icon='star' data-iconpos='notext'>追蹤</a><br/>
			<script>printbar(100);</script><a href='#score'></a>
		</li>
		{/job_query}
	</ul>		
</div>
