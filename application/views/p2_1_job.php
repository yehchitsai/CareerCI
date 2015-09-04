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
			//console.log(data);
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
						"html": "<a href='#detailJob' >" + b[i]['jt_name'] + "</a>" +
								"<a href='#' class='split-button-custom' onclick='alert('已成功追蹤');' data-role='button' data-icon='star' data-iconpos='notext'>追蹤</a>"+
								"<br/>"+"<a href='#score' rel='external'><progress value='100' max='100' ></progress></a>"
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
