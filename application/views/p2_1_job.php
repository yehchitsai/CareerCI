
<style type="text/css"> 
	.split-button-custom {
    float: right;
    margin-right: 10px;
    margin-top: -32px;
    border-bottom-left-radius: 1em 1em;
    border-bottom-right-radius: 1em 1em;
    border-top-left-radius: 1em 1em;
    border-top-right-radius: 1em 1em;   
}

.split-button-custom span.ui-btn-inner {
    border-bottom-left-radius: 1em 1em;
    border-bottom-right-radius: 1em 1em;
    border-top-left-radius: 1em 1em;
    border-top-right-radius: 1em 1em;
    padding-right: 0px;
}

.split-button-custom span.ui-icon {
    margin-top: 0px;
    right: 0px;
    top: 0px;
    position: relative;
}	
.split-custom-wrapper {
    /* position wrapper on the right of the listitem */
    position: absolute;
    right: 0;
    top: 0;
    height: 100%;
}

.split-custom-button {
    position: relative;
    float: right;   /* allow multiple links stacked on the right */
    height: 100%;
    margin:0;
    min-width:3em;
    /* remove boxshadow and border */
    border:none;
    moz-border-radius: 0;
    webkit-border-radius: 0;
    border-radius: 0;
    moz-box-shadow: none;
    webkit-box-shadow: none;
    box-shadow: none;
}

.split-custom-button span.ui-btn-inner {
    /* position icons in center of listitem*/
    position: relative;
    margin-top:50%;
    margin-left:50%;
    /* compensation for icon dimensions */
    top:11px; 
    left:-12px;
    height:40%; /* stay within boundaries of list item */
}
</style>
		     <div data-role="fieldcontain">
				<H3 align="center">請選擇你未來想要達成的職業</H3>
					<ul id="jt" class="jtc" data-role="listview" data-filter="true" data-theme="b" style="margin-bottom: 50px;"
					     data-split-icon="star" data-split-theme="c">
					<li >
						<a href="#">Specification</a>
						<a href="#">職業</br>分數條</a> 
					</li>
					<li >
						<a href="#">職業</br>分數條</a> 
					</li>  
					
<!-- 				<table id="jt">
						
					</table>
			
					
					


<ul data-role="listview" id="ul0" data-theme="a" class="test">
-->
  <li>
    <a href="#" onclick="alert('the item!');">
      <h3>The item</h3>
    </a>
    <a href="#" onclick="alert('1st splitbutton!');" class="split-button-custom" data-role="button" data-icon="gear" data-iconpos="notext">1st link</a>
    <a href="#" onclick="alert('2nd splitbutton!');" class="split-button-custom" data-role="button" data-icon="arrow-r" data-iconpos="notext">2nd link</a>
    <a href="#" style="display: none;">Dummy</a>
  </li>
<!--
http://stackoverflow.com/questions/8322742/listview-with-more-than-one-split-button
</ul>
-->					   
				</ul>
<ul data-role="listview">
    <li>
        <a href="#">
            <img class="cover" src="./cover.jpg"/>
            <h3>title</h3>
            <p>description</p>
        </a>
        <div class="split-custom-wrapper">
            <a href="#" data-role="button" onclick="alert('1st splitbutton!');" class="split-custom-button" data-rel="dialog" data-theme="c">h1</a>
            <a href="#" data-role="button" onclick="alert('2nd splitbutton!');" class="split-custom-button" data-icon="delete" data-rel="dialog" data-theme="c" data-iconpos="notext">h2</a>           
        </div>
    </li>
</ul>			
			 </div>