<div data-role="fieldcontain" align="center">
	<h2>我的追蹤列表</h2>
	<div id="row">
		<table class="table table-striped table-condensed">
			<thead>
				<td>職業名稱</td>
				<td>追蹤日期</td>
				<td>從列表移除</td>
			</thead>
			<tbody>
				{track_query}
				<tr>
					<td><a href='#detailJob@todetailJob@{jt_id}'>{jt_name}</a></td>
					<td>{track_date}</td>
					<td><input type="button" class="btn btn-default" id="deltrack{jt_id}" value="取消追蹤" onclick="deltrack(this)"></td>
				</tr>
				{/track_query}
			</tbody>
		</table>
	</div>
</div>
