<table class="table" align="center" width=80%>
<tr >
	<td colspan="3">{progress_bar}</td>
</tr>
<tr >
	<td>{score_learned}：</td>
	<td>{learned}{score_unit}</td>
	<td rowspan="3"><div class="row well"><h2 style="color:green;">{total_score}{score_unit}</h2></div></td>
</tr>
<tr >
	<td>{score_class_score}：</td>
	<td>{class_score}{score_unit}</td>
</tr>
<tr >
	<td>{score_lisence_score}：</td>
	<td>{lisence_score}{score_unit}</td>
</tr>
<tr>
	<td colspan="2">
		<ul data-tole="listview">
			<li data-role="list-divider"><h5>{score_learned}</h5></li>
				<div data-role="collapsible"  data-collapsed-icon="plus" data-expanded-icon="minus" data-inset="false" class="ui-collapsible">
					<h4 class="ui-collapsible-heading">
						<span class="ui-btn-text">{score_prepare_list}<h5 style="color:blue" id="requireCourseP"></h5><span class="ui-collapsible-heading-status"> click to collapse contents</span></span>
					</h4>
					<ul data-role="listview" data-inset="true" data-shadow="false" id="requireCourse">								

					</ul>
				</div>				
				<div data-role="collapsible"  data-collapsed-icon="plus" data-expanded-icon="minus" data-inset="false" class="ui-collapsible">
					<h4 class="ui-collapsible-heading">
						<span class="ui-btn-text">{score_done_list}<h5 style="color:blue" id="completeCourseP"></h5><span class="ui-collapsible-heading-status"> click to collapse contents</span></span>
					</h4>
					<ul data-role="listview" data-inset="true" data-shadow="false" id="completeCourse">								

					</ul>
				</div>
				<div data-role="collapsible"  data-collapsed-icon="plus" data-expanded-icon="minus" data-inset="false" class="ui-collapsible">
					<h4 class="ui-collapsible-heading">
						<span class="ui-btn-text">{score_undone_list}<h5 style="color:blue" id="pendCourseP"></h5><span class="ui-collapsible-heading-status"> click to collapse contents</span></span>
					</h4>
					<ul data-role="listview" data-inset="true" data-shadow="false" id="pendCourse">								

					</ul>
				</div>
			<li data-role="list-divider"><h5>{score_lisence}</h5></li>
			<p>TQC+ java</p>
			<p>TOEIC</p>	
		</ul>
	</td>
</tr>
</table>
<script>
	$(document).ready(function(){		
		$('#lan_score').text("{jt_name}");
	});
</script>