<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
	<title>Document</title>
	<script src="<?php echo base_url();?>public/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url();?>public/bower_components/webcomponentsjs/webcomponents.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="import" href="<?php echo base_url();?>public/bower_components/paper-input/paper-input.html"/>
  <link rel="import" href="<?php echo base_url();?>public/bower_components/paper-button/paper-button.html"/>
   <style>
.blinfo
{
  width: 300px;
    height: 500px;
    top: 30px;
    margin: 0 auto;
    background: rgba(255,255,255,0.7);
    position:relative;       
        box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
}
.blinfo:before, .blinfo:after
{
  content:"";
    position:absolute; 
    z-index:-1;
    box-shadow:0 0 20px rgba(0,0,0,0.8);
    bottom:0;
    left:10px;
    right:10px;
    border-radius:100px / 10px;
}
.linfo{
  padding-top: 30px;
  width: 200px;
  height: 500px;
  margin: 0 auto;
}
#lsubmit{
      left: -5px;
      top: 20px;
      background-color: #32CD32;
      color: black;
      width: 100%;
      font-size: 18px;
    }
#licon{
  margin-left: 37.5%;
}
p{
  text-align: center;
  color: black;
  font-size: 30px;
}
html {
    height: 100%;
}
body {
    font-family: Microsoft JhengHei;
    height: 100%;
    margin: 0;
    background-repeat: no-repeat;
    background-attachment: fixed;
  background:
    -webkit-linear-gradient(45deg, hsla(335, 100%, 55%, 1) 0%, hsla(335, 100%, 55%, 0) 70%),
    -webkit-linear-gradient(315deg, hsla(225, 100%, 55%, 1) 10%, hsla(225, 100%, 55%, 0) 80%),
    -webkit-linear-gradient(225deg, hsla(140, 80%, 50%, 1) 10%, hsla(140, 80%, 50%, 0) 80%),
    -webkit-linear-gradient(135deg, hsla(40, 1%, 55%, 1) 100%, hsla(40, 1%, 55%, 0) 70%);
  background:
    linear-gradient(45deg, hsla(335, 100%, 55%, 1) 0%, hsla(335, 100%, 55%, 0) 70%),
    linear-gradient(135deg, hsla(225, 100%, 55%, 1) 10%, hsla(225, 100%, 55%, 0) 80%),
    linear-gradient(225deg, hsla(140, 80%, 50%, 1) 10%, hsla(140, 80%, 50%, 0) 80%),
    linear-gradient(315deg, hsla(40, 1%, 55%, 1) 100%, hsla(40, 1%, 55%, 0) 70%);
  
}
</style>
</head>
<body>
    <div class="blinfo">
  <div class="linfo">
    <div class="lhead">
      <i class="fa fa-android fa-5x text-center" id="licon"></i>
      <p class="text-center">職業夢想家</p>
      <p class="text-center">後臺管理</p>
    </div>
    <paper-input  label="帳號" id="inputid" value="careeradmin"></paper-input>
    <paper-input  label="密碼" id="inputpwd" value="careeradmin" ></paper-input>
    <paper-button id="lsubmit" onclick=login();>登入</paper-button>
    <script>
var CILocation = "http://127.0.0.1/CareerCI/backend/";
function login(){
  if ($('#inputid').val()==""||$('#inputpwd').val()=="") {
    alert('有欄位未填寫！');
    return;
  }
  $.ajax({
    type: "POST",
    url: CILocation+"receivelogin",
    dataType: 'JSON',
    data: { 'id' : $('#inputid').val(),
        'pwd': $('#inputpwd').val()
    },
    success: function(data){
      if (data) {
        location.reload();
      }
      else{
        alert('登入失敗，請再確認!');
      }
    },
    error: function (xhr, desc, err)
    {
            console.log("error");
    }
});
}
    </script>
  </div>
</div>
</body>
</html>