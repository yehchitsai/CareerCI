				<div id="status"></div>
				<div id="id">
					<label for="id">帳號：</label>
					<input type="text" name="username" id="username" value="a0128307" placeholder="請輸入你的學號" data-theme="d">
				</div> 

				<div id="password">
					<label for="password">密碼：</label>
					<input type="password" name="password" id="psw" value="qqoo" placeholder="請輸入你的密碼">
				</div> 						
				<div data-role="fieldcontain">
					<label for="switch" >保持登入狀態：</label>
					<select name="re_account" id="keepLogin" data-role="flipswitch" data-mini="false" data-track-theme="c">
						<option value="off">Off</option>
						<option value="on">On</option>
					</select>
				  </div>
				<div id ="login1" align="center" >
					<button  data-theme="b" id="login">登入</button>
				</div>
<script>
$("#login").on("click" , function(e, data) {
	console.log("Login click");
	$.mobile.changePage("#menu_2",{reload:true});			
	return false;
});
</script>