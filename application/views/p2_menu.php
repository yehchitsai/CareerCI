		     <div data-role="fieldcontain">
				<H3 align="center" id="stuName"></H3>
				<ul data-role="listview" data-inset="true">

					<li><a href="#job">職業選擇</a></li>
					<li><a href="#track">夢想追蹤</a></li>
					<li><a href="#push">訊息接收</a></li>
				</ul>
			</div>
			<script>
			$("#stuName").text(localStorage.getItem("stu_name") + "您好");
			</script>
			