			<table align="center" width=80%>
			<tr >
				<td colspan="2">
					{progress_bar}
				</td>
			</tr>
			<tr align="center">
				<td>課程(占30%)：</td>
				<td>{learned}</td>
			</tr>
			<tr align="center">
				<td>成績(占30%)：</td>
				<td>{class_score}</td>
			</tr>
			<tr align="center">
				<td>證照(占40%)：</td>
				<td>{lisence_score}</td>
			</tr>
			<tr align="center">
				<td><h2>總分：</h2></td>
				<td><h2>{total_score}<h2></td>
			</tr>
			
			<tr>
				<td colspan="2">
					<ul data-tole="listview">
						<li data-role="list-divider"><h3>課程完成度</h3></li>
							<div data-role="collapsible"  data-collapsed-icon="plus" data-expanded-icon="minus" data-inset="false" class="ui-collapsible">
								<h2 class="ui-collapsible-heading">
									<span class="ui-btn-text">須具備課程<h3 style="color:blue" id="requireCourseP"></h3><span class="ui-collapsible-heading-status"> click to collapse contents</span></span>
								</h2>
								<ul data-role="listview" data-inset="true" data-shadow="false" id="requireCourse">								

								</ul>
							</div>
								
							<div data-role="collapsible"  data-collapsed-icon="plus" data-expanded-icon="minus" data-inset="false" class="ui-collapsible">
								<h2 class="ui-collapsible-heading">
									<span class="ui-btn-text">已修課程<h3 style="color:blue" id="completeCourseP"></h3><span class="ui-collapsible-heading-status"> click to collapse contents</span></span>
								</h2>
								<ul data-role="listview" data-inset="true" data-shadow="false" id="completeCourse">								

								</ul>
							</div>
							<div data-role="collapsible"  data-collapsed-icon="plus" data-expanded-icon="minus" data-inset="false" class="ui-collapsible">
								<h2 class="ui-collapsible-heading">
										<span class="ui-btn-text">待修課程<h3 style="color:blue" id="pendCourseP"></h3><span class="ui-collapsible-heading-status"> click to collapse contents</span></span>
								</h2>
								<ul data-role="listview" data-inset="true" data-shadow="false" id="pendCourse">								

								</ul>
							</div>
						</li>
					<hr/>
					<li data-role="list-divider"><h3>同儕排行</h3></li>
						<div data-role="collapsible-set">
							<div data-role="collapsible">
							<h1>同儕01</h1>
						
							<div data-role="collapsible">
								<h1>所修課程</h1>
								<p>01</p>
							</div>
							<div data-role="collapsible">			
								<h1>課堂成績</h1>
								<p>02</p>
							</div>										
							<div data-role="collapsible">			
								<h1>證照</h1>
								<p>03</p>
							</div>		
							</div>

							<div data-role="collapsible">
							<h1>同儕02</h1>
						
							<div data-role="collapsible">
								<h1>所修課程</h1>
								<p>01</p>
							</div>
							<div data-role="collapsible">			
								<h1>課堂成績</h1>
								<p>02</p>
							</div>										
							<div data-role="collapsible">			
								<h1>證照</h1>
								<p>03</p>
							</div>		
						</div>
					<hr/>
					<li data-role="list-divider"><h3>證照</h3></li>
						<p>TQC+ java</p>
						<p>TOEIC</p>	
					</td>
				</ul>
			</tr>
			</table>

			<hr/>