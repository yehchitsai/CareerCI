<div id="status"></div>
<div id="id">
	<label class="lan_login_id" for="id">帳號：</label>
	<input type="text" name="username" id="username" value="a0128307" placeholder="請輸入你的學號">
</div> 

<div id="password">
	<label class="lan_login_passwd" for="password">密碼：</label>
	<input type="password" name="password" id="psw" value="qqoo" placeholder="請輸入你的密碼">
</div> 						
<div data-role="fieldcontain">
	<label class="lan_login_status" for="switch" >保持登入狀態：</label>
	<select name="re_account" id="keepLogin" data-role="flipswitch" data-mini="false" data-track-theme="c">
		<option value="off">Off</option>
		<option value="on">On</option>
	</select>
  </div>
<div align="center" >
	<button  class="lan_login_btn" data-theme="b" id="loginBtn">登入</button>
</div>
<div class="ui-field-contain">
  <fieldset data-role="controlgroup" data-type="horizontal">
    <legend>語言選擇/chose language:</legend>
    <input type="radio" name="lan_radio" rel="zh_TW" id="lan_1" class="custom" onclick=changelan(this) checked="checked">
    <label for="lan_1">中文</label>
    <input type="radio" name="lan_radio" rel="en_US" id="lan_2" class="custom" onclick=changelan(this) >
    <label for="lan_2">English</label>
  </fieldset>
</div>

