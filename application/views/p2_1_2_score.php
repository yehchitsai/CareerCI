		<style>
		<!--分數條顏色(啟始)-->
		html{text-align:center;}
		progress[value]{width:100%;height:50px;border:1px solid #ccc;border-radius:2px;margin:100px 0;color:#fff;align:left;
			background: -moz-linear-gradient(left, #F9F900 0%, #F9F900 20%, transparent 20%, transparent 20%, #0080FF 20%, #0080FF 40%, transparent 40%, transparent 40%, #28FF28 40%, #28FF28 60%, transparent 40%, transparent 40%, #28FF28 40%, #28FF28 60%, transparent 60%, transparent 60%, #EA7500 60%, #EA7500 80%, transparent 80%, transparent 80%, #FF0000 80%, #FF0000 100%);
			background: -webkit-gradient(linear, left top, right top, color-stop(0%,#F9F900), color-stop(19%,#F9F900), color-stop(19%,transparent), color-stop(21%,transparent), color-stop(21%,#0080FF), color-stop(39%,#0080FF), color-stop(39%,transparent), color-stop(41%,transparent), color-stop(41%,#28FF28), color-stop(59%,#28FF28), color-stop(39%,transparent), color-stop(41%,transparent), color-stop(41%,#28FF28), color-stop(59%,#28FF28), color-stop(59%,transparent), color-stop(61%,transparent), color-stop(61%,#EA7500), color-stop(79%,#EA7500), color-stop(79%,transparent), color-stop(81%,transparent), color-stop(81%,#FF0000), color-stop(100%,#FF0000));
			background: -webkit-linear-gradient(left, #F9F900 0%,#F9F900 19%,transparent 19%,transparent 21%,#0080FF 21%,#0080FF 39%,transparent 39%,transparent 41%,#28FF28 41%,#28FF28 59%,transparent 39%,transparent 41%,#28FF28 41%,#28FF28 59%,transparent 59%,transparent 61%,#EA7500 61%,#EA7500 79%,transparent 79%,transparent 81%,#FF0000 81%,#FF0000 100%);
			background: -o-linear-gradient(left, #F9F900 0%,#F9F900 20%,transparent 20%,#46A3FF 20%,#46A3FF 40%,transparent 40%,transparent 40%,#28FF28 40%,#28FF28 60%,transparent 60%,transparent 40%,#28FF28 40%,#28FF28 60%,transparent 60%,transparent 60%,#EA7500 60%,#EA7500 80%,transparent 80%,transparent 80%,#FF0000 80%,#FF0000 100%);
			background: -ms-linear-gradient(left, #F9F900 0%,#F9F900 20%,transparent 20%,#46A3FF 20%,#46A3FF 40%,transparent 40%,transparent 40%,#28FF28 40%,#28FF28 60%,transparent 60%,transparent 40%,#28FF28 40%,#28FF28 60%,transparent 60%,transparent 60%,#EA7500 60%,#EA7500 80%,transparent 80%,transparent 80%,#FF0000 80%,#FF0000 100%);
			background: linear-gradient(to right, #F9F900 0%,#F9F900 20%,transparent 20%,#46A3FF 20%,#46A3FF 40%,transparent 40%,transparent 40%,#28FF28 40%,#28FF28 60%,transparent 60%,transparent 40%,#28FF28 40%,#28FF28 60%,transparent 60%,transparent 60%,#EA7500 60%,#EA7500 80%,transparent 80%,transparent 80%,#FF0000 80%,#FF0000 100%);
			-webkit-transform:rotate(180deg);
			-ms-transform:rotate(180deg);
			transform:rotate(180deg);
			-webkit-appearance:none;
			-moz-appearance:none;
			appearance:none;
		}
		progress[value]::-webkit-progress-bar{background-color:transparent;position:relative;}
		progress[value]::-webkit-progress-value{width:100%;background-color:#fff;background-size:100%;position:relative;overflow:hidden;
			 -webkit-transition:width 0.6s ease;
			-moz-transition:width 0.6s ease;
			-o-transition:width 0.6s ease;
			transition:width 0.6s ease;
		}
		<!--分數條顏色(結束)-->
		</style>
		<script type="text/javascript">
		//分數條設定值(開始)
		var progressVal = $('progress').val(),
			progressStep = 1,
			progressDirection = 1;

		setInterval(function() {
		  progressVal =100-85;//反轉分數
		  $('progress').val(progressVal);
		});
		//分數條設定值(結束)
		</script>
			<table align="center" width=80%>
			<tr >
				<td colspan="2">
					<progress value="100" max="100" ></progress>
				</td>
			</tr>
			<tr align="center">
				<td>課程(占30%)：</td>
				<td>Some Text</td>
			</tr>
			<tr align="center">
				<td>成績(占30%)：</td>
				<td>Some Text</td>
			</tr>
			<tr align="center">
				<td>證照(占40%)：</td>
				<td>Some Text</td>
			</tr>
			<tr align="center">
				<td><h2>總分：</h2></td>
				<td><h2>Some Text<h2></td>
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