var CILocation = "http://127.0.0.1/CareerCI/backend/";
var gitjson='https://api.github.com/repos/yehchitsai/CareerCI/commits';
var version_basic_data;
function changepage(dom){
	$('.sidebar-link').removeClass('active');
	$(dom).parent().addClass('active');
	var t=$(dom).children().last().text();
	$('.page-header').text(t);
  $.get(CILocation+'page/'+$('li.active').attr('id'),function(data){
    $('#contain').html(data);
  })
}
function changepaged(dom){
  loading();
  $('.sidebar-link').removeClass('active');
  $(dom).addClass('active');
  var t=$(dom).children().children().last().text();
  $('.page-header').text(t);
  $.get(CILocation+'page/'+$('li.active').attr('id'),function(data){
    $('#contain').html(data);
  });
  unloading();
}
function get_basic_version(){
  loading();
  var output='';
  $.get(CILocation+'version/get_base',function(data){
    var obj=JSON.parse(data);
    version_basic_data=JSON.parse(data);
    for (var i = 0; i < obj.length; i++) {
      output+="<tr class='vt_item' dr='"+obj[i]['id']+"'><td class='project-type'><div class='"+obj[i]['v_type']+"-phase'></div></td>";
      output+="<td>"+obj[i]['v_name']+"</td>";
      output+="<td>"+obj[i]['v_update']+"</td>";
      output+="<td>"+obj[i]['v_value']+"</td></tr>";
    };
    $('#vt_rander').html(output);
    unloading();
    $('.vt_item').click(function(){item_detail($(this));});
  })
}
function version_key_search(key){
  if (key.length>0) {
    console.log('keynotempty');
    console.log(key);
    var output='';
    for (var i = 0; i < version_basic_data.length; i++) {
      if (version_basic_data[i]['id'].search(key)!=-1||version_basic_data[i]['v_type'].search(key)!=-1||version_basic_data[i]['v_name'].search(key)!=-1||version_basic_data[i]['v_update'].search(key)!=-1||version_basic_data[i]['v_value'].search(key)!=-1) {
      output+="<tr class='vt_item' dr='"+version_basic_data[i]['id']+"'><td class='project-type'><div class='"+version_basic_data[i]['v_type']+"-phase'></div></td>";
      output+="<td>"+version_basic_data[i]['v_name']+"</td>";
      output+="<td>"+version_basic_data[i]['v_update']+"</td>";
      output+="<td>"+version_basic_data[i]['v_value']+"</td></tr>";
      }
    };
    $('#vt_rander').html(output);
  }else{
    console.log('keyisempty');
    get_basic_version();
  }
}
function item_detail(dom){
  if ($('#contain').find('#view'+$(dom).attr('dr')).length==0) {
    loading();
  $.get(CILocation+'/version_view/'+$(dom).attr('dr'),function(data){
      $('#contain').append(data);
  });
}
}
function v_additem(){
  if (!$('#contain').children().hasClass('vb_add')) {
      loading();
    $.get(CILocation+'getform/form_version_add',function(data){
      $('#version_base').after(data);
    }).done(function() {
      $.getJSON(gitjson,function(data){
      var output='';
      for (var i = 0; i < data.length; i++) {
        output+='<div class="panel gititem"><table class="table" border="0" onclick=form_changeversion(this)><tr><td>';
        output+=data[i]['commit']['committer']['date']+'</td></tr><tr><td>';
        output+=data[i]['commit']['committer']['name']+'</td></tr><tr><td>';
        output+=data[i]['commit']['message']+'</td></tr><tr><td rt="sha">';
        output+=data[i]['sha']+'</td></tr></table></div>';
      };
      $('#gittable').html(output);
      unloading();
    }).fail(function() {
    console.log( "error" );
  });
  });
    $('#vf_date').datetimepicker();
    
  }
}
function v_additem_valid(){
  if(isEmpty($('#vf_name').val())){   invalid('#vf_name','發佈名稱必填!'); }
  if(isEmpty($('#vf_version').val())){    invalid('#vf_version','發佈版本必填!');  }
  if(isEmpty($('#vf_poster').val())){    invalid('#vf_poster','發佈者必填!');  }
  if(isEmpty($('#vf_pt').val())){ invalid('#vf_pt','發佈類型必填!');  }
  if(!isEmpty($('#vf_pt').val())&&$('#vf_pt').val()!='release'&&$('#vf_pt').val()!='alpha'&&$('#vf_pt').val()!='beta'){ invalid('#vf_pt','發佈類型錯誤!');  }
  if(isEmpty($('#vf_gitsha').val())){invalid('#vf_gitsha','GIT版本必選!');  }
  if(isEmpty($('#vf_date').val())){ $('#vf_date').parent().addClass('has-error'); invalid('#vf_date',''); }
  if (isEmpty($('#vf_name').val())||isEmpty($('#vf_version').val())||isEmpty($('#vf_poster').val())||isEmpty($('#vf_pt').val())||isEmpty($('#vf_gitsha').val())||isEmpty($('#vf_date').val())) {  return; };
  $.post( CILocation+"version/add",{ name:$('#vf_name').val(),version:$('#vf_version').val(),poster:$('#vf_poster').val(),pt:$('#vf_pt').val(),gitsha:$('#vf_gitsha').val(),date:$('#vf_date').val() })
  .done(function( data ) {
    var obj=JSON.parse(data);
    if (obj['status']) {
      alert('新增成功');
      loading();
      clean_grid('vb_add');
      get_basic_version();
      $.get(CILocation+'/version_view/'+obj['newid'],function(data){  $('#contain').append(data);   });
      unloading();
    }else{
      alert('新增失敗');
    }
  });
}
function invalid(dom,exception){
  $(dom).attr('error-message',exception);
  $(dom).attr('invalid','');
}
function isEmpty(value){
  return (value == null || value.length === 0);
}
function clean_grid(name){
  $('#'+name).remove();
}
function form_changeversion(dom){
  $('.gititem').removeClass('active');
  $(dom).parent().addClass('active');
  $('#vf_gitsha').val($(dom).find('td[rt="sha"]').text());
  $('#vf_gitsha').removeAttr('invalid');
}
function form_changeprojecttype(dom){
  $('.icon-shadow').removeClass('active');
  $(dom).addClass('active');
  $('#vf_pt').val($(dom).attr('title'));
  $('#vf_pt').removeAttr('invalid');
}
function v_gitdetail(sha,id){
  $.getJSON(gitjson,function(data){
    for (var i = 0; i < data.length; i++) {
      if (data[i]['sha']==sha) {
        var output='';
        output+='<div class="panel table"><table class="table" border="0" onclick=form_changeversion(this)><tr><td>';
        output+=data[i]['commit']['committer']['date']+'</td></tr><tr><td>';
        output+=data[i]['commit']['committer']['name']+'</td></tr><tr><td>';
        output+=data[i]['commit']['message']+'</td></tr><tr><td rt="sha">';
        output+=data[i]['sha']+'</td></tr></table></div>';
        $('#gitdetail'+id).html(output);
        return;
      }
    };
  });
  unloading();
}
function v_api_package(key){
  var element = document.createElement('a');
  element.setAttribute('href', 'data:text/plain;charset=utf-8,' + 'var auth_key="'+key+'"');
  element.setAttribute('download','auth_key.js');
  element.style.display = 'none';
  document.body.appendChild(element);
  element.click();
  document.body.removeChild(element);
}
function v_deleteitem(dataid){
  if(confirm('確定刪除此版本?')){
    loading();
    $.post( CILocation+"version/delete",{ id:dataid})
  .done(function( data ) {
    if (data) {
      unloading();
      alert('刪除成功!');
      loading();
      clean_grid('view'+dataid);
      get_basic_version();
      unloading();
    }else{
      alert('刪除失敗!');
    }
  });
  }
}
function loading(){
  $('body').append('<div class="loading"><paper-spinner active></paper-spinner></div>');
}
function unloading(){
  $('.loading').remove();
}