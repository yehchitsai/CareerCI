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
		$(document).ready(function(){
			console.log("CILocation = " + CILocation);
			$.ajax({
				type:"get",
				url:CILocation + "job/getTitle",
				datatype:"json",
				cache:false,
				success:success,
				error:error
			});
		
			
			
		});
		function success(data)
		{
		
		
		
		//	alert(data);
			console.log(data);
			//data  = eval(data)
			var b=data;
			str ="";
				if (b!=null){
					for (var i=0;i<b.length;i++)
					{
					
						str += b[i]['jt_name'] + "<BR>\n";
						
				
								//分數條設定值(開始)	
			var progressVal = $('progress').val(),
			progressStep = 1,
			progressDirection = 1;

		setInterval(function() {
		  progressVal =100-85;//反轉分數
		  $('progress').val(progressVal);
		});
		//分數條設定值(結束)
						
						$("<li/>", {
						"id":"test"+i,
						"class":"ui-btn",
						"html": "<a href='#' >" + b[i]['jt_name'] +
								"<a href='#' class='split-button-custom' onclick='alert('已成功追蹤');' data-role='button' data-icon='star' data-iconpos='notext'>追蹤</a>"+
								"<br/>"+"<a href='#score' rel='external'><progress value='100' max='100' ></progress></a></a>"
						}).appendTo("#jt");
						
					}			
				}
		//	document.write(str);
		//	console.log('success');
		//	console.log(data);
		//	alert('追蹤成功');	
		}
	
		function error(data)
		{
		//	alert(data);
		console.log(data);
		}
		</script>
		
		     <div data-role="fieldcontain">
				<H3 align="center">請選擇你未來想要達成的職業</H3>
					<ul id="jt" class="jtc" data-role="listview" data-filter="false" data-theme="a" style="margin-bottom: 50px;"
					     data-split-icon="star" data-split-theme="a">
					</ul>		
			 </div>
		  </div>