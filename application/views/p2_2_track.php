<div data-role="fieldcontain" align="center">
	<h2>{track_caption}</h2>
	<div id="row">
		<table class="table table-striped table-condensed">
			<thead>
				<td>{track_name}</td>
				<td>{track_date}</td>
				<td>{track_option}</td>
			</thead>
			<tbody>
				{track_query}
				<tr>
					<td><a href='#detailJob@todetailJob@{jt_id}'>{jt_name}</a></td>
					<td>{track_date}</td>
					<td><input type="button" class="btn btn-default" id="deltrack{jt_id}" value="{track_btn}" onclick="deltrack(this)"></td>
				</tr>
				{/track_query}
			</tbody>
		</table>
	</div>
</div>