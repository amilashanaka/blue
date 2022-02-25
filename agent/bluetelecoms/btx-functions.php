<script>



	// global variable to save the current status of the agent, initially set to Pause then different functions in the code will be changing the value of the var
	var current_status_of_agent = "Paused";
  var pause_time_limt_value = 0;
  var btx_logged_in_flag = 0;
  var transfer_where='';
  var inboundringing='';
  var hide_dial_next_button = 0;
  var ringingactive ='N';
  var btx_extend_callback_display='NO';
  var prev_status = 'LOGIN';




  function hasNumbers(t)
  {
    var regex = /\d/g;
    return regex.test(t);
  }    


function startmakeringsound()
{
if (ringingactive=='N')
{
ringingactive = 'Y';
     $('#ringing_in').get(0).play();

   if ((inboundringing =='YES') && ($('#AgentStatusCalls123').html()!='&nbsp;Queue&nbsp;') && ($('#AgentStatusCalls123').html()!='&nbsp;undefined') && ((prev_status !='INCALL') && (prev_status !='INBOUNDINCALL') && (prev_status !='MANUAL') && (prev_status !='MANPREV'))) { 
     

     }

var interval = setInterval(function() { 

   if ((inboundringing =='YES') && ($('#AgentStatusCalls123').html()!='&nbsp;Queue&nbsp;') && ($('#AgentStatusCalls123').html()!='&nbsp;undefined') && ((prev_status !='INCALL') && (prev_status !='INBOUNDINCALL') && (prev_status !='MANUAL') && (prev_status !='MANPREV'))) { 
      
       $('#ringing_in').get(0).play();

      
   }
   else { 
      ringingactive = 'N';
      clearInterval(interval);
      
   }
}, 5000);


}




}



  function preset_option_clicked(transfer_where){
    transfer_where='Preset: '+transfer_where;
    document.vicidial_form.consultativexfer.checked = false;
    document.vicidial_form.xferoverride.checked = true;
    $('#btx_transfer_extra_info').html('Transfer to '+transfer_where);
    $('.hide_transfers').hide();
    $('#btx_transfer_stage_2').show();
    $('#btx_transfer_blind').attr('onClick', $('#DialBlindTransfer').find('a').attr('onclick'));  
  }


$(".btx_ParkControl123_button").on("click", function(){
$('.btx_ParkControl123_button').attr('onClick', $('#ParkControl').find('a').attr('onclick'));
}); 

  function quickdispo_in(){
    $('#hotkeyspopups').show();
    showDiv('HotKeyEntriesBox');
    hot_keys_active = 1; 

  }


  function quickdispo_out(){
    $('#hotkeyspopups').hide();
    showDiv('HotKeyEntriesBox');
    hot_keys_active = 0;

  }



  function Delete_callback_call_set_button(CB_lead_id,CB_id)
  {
    $('#cbk_remove_confirm_button').attr('onClick', 'Delete_callback_call("'+ CB_lead_id + '","' + CB_id + '")');
  }

  function change_profile_image(){
    var imagelocation =$('#ProfileImageUploader').val();
    if (imagelocation.includes('http')){
var url = "bluetelecoms/get_data/data.php"; // This is the file that handles the request
$.ajax({
 url: url,
 type: 'post',
 data: {"query":"upload_profile_image","user":user,"img":imagelocation},
 success: function(data_)
 {

                   if(data_)  //This is returned from the PHP request
                   {

                    var listJson = JSON.parse(data_);

                    ////console.log(listJson.newcustomone);
                    if (listJson.newcustomone.slice(0, 3) == 'BTX')
                    {
                      var userarray = listJson.newcustomone.split("-"); 
                      targetsales=userarray[1];


                     if (userarray[1].includes('H')==true) 
                       {
                          SPH = 'H';
                          targetsales = userarray[1].substring(0, userarray[1].length - 1);
                       }
                          else if (userarray[1].includes('D')==true)
                       {
                          SPH = 'D';
                       }
                      else
                      {
                          SPH = 'T';
                      }
                      poplulate_agent_sales(targetsales,SPH);

                      if (userarray[3]=='Y')
                      {

                        $("#btx_img_sample").attr("src",userarray[2]);
                        $("#btx_user_profile_img").attr("src",userarray[2]);
                        $("#btx_user_profile_img_container").show();
                        $('#profile_image_placeholder').hide();
                        $('#ImageMessage').hide();
                        $('#ProfileImageUploader').val('');
                      }
                      else
                        if (userarray[3]=='N')
                        {


                         $("#btx_img_sample").attr("src",userarray[2]);
                         $('#ImageMessage').html('Image Waiting Manager Approval')
                         $('#ImageMessage').show();
                         $("#btx_user_profile_img_container").hide();
                         $('#profile_image_placeholder').show();  
                         $('#ProfileImageUploader').val('');                         
                       }
                       else if (userarry[2]=='ERROR')

                       {

                        $('#ImageMessage').html('ERROR - Try another image')
                        $('#ImageMessage').show();
                        $("#btx_user_profile_img_container").hide();
                        $('#profile_image_placeholder').show();
                        $('#ProfileImageUploader').val('');

                      }   
                      else 
                      {

                        $('#ImageMessage').html('No Image Set')
                        $('#ImageMessage').show();
                        $("#btx_user_profile_img_container").hide();
                        $('#profile_image_placeholder').show();
                        $('#ProfileImageUploader').val('');

                      }                            

                    } 



                  }


                }

              });

}
else
{
  $('#ImageMessage').html('ERROR - Try another image')
  $('#ImageMessage').show();

  $('#ProfileImageUploader').val('');

}



}





function poplulate_agent_sales(targetsales,SPH)
{
if (SPH == 'H')
{
  var url = "bluetelecoms/get_data/data.php"; // This is the file that handles the request
  $.ajax({
    url: url,
    type: 'post',
    data: {"query":"get_sales_total_SPH","user":user,"camp":campaign},
    success: function(data_)
    {
  
                                  if(data_)  //This is returned from the PHP request
                                  {
                                    
                                   var listJson = JSON.parse(data_);
                                   
                                   if (targetsales > 0) 
                                   {
  
                                    $('#sales_label').html(listJson.sales.toFixed(1) + ' SPH');
  
                                    if (parseFloat(listJson.sales)<=parseFloat(targetsales))
                                    {
                       
                                      $('#sales_label_button').removeClass('btn-success');
                                      $('#sales_label_button').addClass('btn-danger');
  
                                      $('#salesstar').hide();
                                    }
                                    else
                                    {
                                      $('#sales_label_button').removeClass('btn-danger'); 
                                      $('#sales_label_button').addClass('btn-success');
  
                                      $('#salesstar').show();
                                    }
  
  
                                  }
                                  else
  
                                  {
                                    $('#sales_label').html(listJson.sales.toFixed(1) + ' SPH');
  
                                    $('#sales_label_button').addClass('btn-success');
  
                                  }                         
  
  
  
                                }
  
  
                              }
  
                            });
  
  


}
else if (SPH == 'D')
{
  var url = "bluetelecoms/get_data/data.php"; // This is the file that handles the request
  $.ajax({
    url: url,
    type: 'post',
    data: {"query":"get_sales_total_SPDH","user":user,"camp":campaign},
    success: function(data_)
    {
  
                                  if(data_)  //This is returned from the PHP request
                                  {
                                    
                                   var listJson = JSON.parse(data_);
                                   
                                   if (targetsales > 0) 
                                   {
  
                                    $('#sales_label').html(listJson.sales.toFixed(1) + ' SPH');
  
                                    if (parseFloat(listJson.sales)<=parseFloat(targetsales))
                                    {
                       
                                      $('#sales_label_button').removeClass('btn-success');
                                      $('#sales_label_button').addClass('btn-danger');
  
                                      $('#salesstar').hide();
                                    }
                                    else
                                    {
                                      $('#sales_label_button').removeClass('btn-danger'); 
                                      $('#sales_label_button').addClass('btn-success');
  
                                      $('#salesstar').show();
                                    }
  
  
                                  }
                                  else
  
                                  {
                                    $('#sales_label').html(listJson.sales.toFixed(1) + ' SPH');
  
                                    $('#sales_label_button').addClass('btn-success');
  
                                  }                         
  
  
  
                                }
  
  
                              }
  
                            });
  
  


}
else
{
  var url = "bluetelecoms/get_data/data.php"; // This is the file that handles the request
  $.ajax({
    url: url,
    type: 'post',
    data: {"query":"get_sales_total","user":user,"camp":campaign},
    success: function(data_)
    {
  
          if(data_)  //This is returned from the PHP request
          {
          	
           var listJson = JSON.parse(data_);
  
           if (targetsales > 0) 
           {
  
            $('#sales_label').html(listJson.sales + '/' + targetsales + ' Target');
  
            if (parseInt(listJson.sales)<parseInt(targetsales))
            {
              $('#sales_label_button').removeClass('btn-success');
              $('#sales_label_button').addClass('btn-danger');
  
              $('#salesstar').hide();
            }
            else
            {
              $('#sales_label_button').removeClass('btn-danger'); 
              $('#sales_label_button').addClass('btn-success');
  
              $('#salesstar').show();
            }
  
  
          }
          else
  
          {
            $('#sales_label').html(listJson.sales + ' Successes');
  
            $('#sales_label_button').addClass('btn-success');
  
          }              						
  
  
  
        }
  
  
      }
  
    });
  
  }
}




function poplulate_agent_stats()
{
var url = "bluetelecoms/get_data/data.php"; // This is the file that handles the request
$.ajax({
  url: url,
  type: 'post',
  data: {"query":"find_all_data_stats","user":user,"camp":campaign},
  success: function(data_)
  {

                                if(data_)  //This is returned from the PHP request
                                {
                                	
                                 var listJson = JSON.parse(data_);
                                 if(isNaN(((parseInt(listJson.avail) / (parseInt(listJson.avail) + parseInt(listJson.notavail))) * 100))){var avai = 0;} else { var avail =((parseInt(listJson.avail) / (parseInt(listJson.avail) + parseInt(listJson.notavail))) * 100);};

                                 $('#btx_stats_agent_name').html(LOGfullname);
                                 $('#btx_stats_campaign_sales').html(listJson.campsales);
                                 $('#btx_stats_camapign_rank').html(listJson.camprank);
                                $('#btx_stats_availabilty').html("<table><tr><td class='font-weight-bold'>Available:&nbsp;</td><td class='font-weight-light'>" +listJson.avail + "</td></tr><tr><td class='font-weight-bold'>Wrap:&nbsp;</td><td class='font-weight-light'>" +listJson.wrap + "</td></tr><tr><td class='font-weight-bold'>Pause:&nbsp;</td><td class='font-weight-light'>" +listJson.notavail + "</td></tr></table>");

                                 if (listJson.camprank.includes('1st')==true)
                                 {
                                  $('.medals').hide();
                                  $('#gold_medal').show();
                                }
                                else if (listJson.camprank.includes('2nd')==true)
                                {
                                  $('.medals').hide();
                                  $('#silver_medal').show();
                                }
                                else if (listJson.camprank.includes('3rd')==true)
                                {
                                  $('.medals').hide();
                                  $('#bronze_medal').show();
                                }
                                else 
                                {
                                  $('.medals').hide();
                                }						
                              }


                            }

                          });


build_agents_sales_table(function(){add_wrap_and_talk_to_agent_stats_table();});


}


function build_agents_sales_table(callback)
{
  $('#stats_table').hide();
  $('#btx_agents_stats_table').html('');
var url = "bluetelecoms/get_data/data.php"; // This is the file that handles the request
$.ajax({
  url: url,
  type: 'post',
  data: {"query":"build_agent_stats_table","user":user,"camp":campaign},
  success: function(data_)
  {

                          if(data_)  //This is returned from the PHP request
                          {

                            var listJson = JSON.parse(data_);

                            var tabledata ='';   

                            $.each(listJson, function(i, item)
                            {
                              if (item.user == user)
                              {
                                tabledata += "<tr class='table-primary'><td>";
                              }
                              else
                              {
                               tabledata += "<tr><td>"; 
                             }
                             tabledata += item.name;
                             tabledata += '</td><td>';
                             tabledata += item.sales;
                             tabledata += "</td><td id='"+item.user+"_talk'>";
                             tabledata += "</td><td id='"+item.user+"_wrap'>";
                             tabledata += '</td></tr>';
                           });

                            $('#btx_agents_stats_table').html(tabledata);
                          }



                          callback();
                        }

                      });


}

function add_wrap_and_talk_to_agent_stats_table()
{

var url = "bluetelecoms/get_data/data.php"; // This is the file that handles the request
$.ajax({
  url: url,
  type: 'post',
  data: {"query":"add_wrap_and_talk_to_agent_stats_table","user":user,"camp":campaign},
  success: function(data_)
  {

                          if(data_)  //This is returned from the PHP request
                          {

                            var listJson = JSON.parse(data_);

                            var add_tabledata ='';   

                            $.each(listJson, function(i, item)
                            {
                              if(isNaN(item.talk/item.countoftalk)){var talk = 0;} else { var talk =item.talk/item.countoftalk;};
                              if(isNaN(item.dispo/item.countofdispo)){var dispo =0;} else {var dispo = item.dispo/item.countofdispo;};

                              if($("#" + item.user+"_talk").length == 0) 
                              {
                                if (item.user == user)
                                {
                                  add_tabledata += "<tr class='table-primary'><td>";
                                }
                                else
                                {
                                  add_tabledata += "<tr><td>"; 
                                }

                                add_tabledata += item.name;
                                add_tabledata += '</td><td>0</td><td>';
                                add_tabledata += talk.toFixed(1);
                                add_tabledata += "</td><td >";
                                add_tabledata += dispo.toFixed(1);
                                add_tabledata += '</td></tr>';
                              }
                              else
                              {
                                $('#'+item.user+'_wrap').html(dispo.toFixed(1));
                                $('#'+item.user+'_talk').html(talk.toFixed(1));

                              }
                            });

                            $('#btx_agents_stats_table').append(add_tabledata);
                          }




                        }

                      });
get_pause_code_breakdown();
$('#stats_table').show();

}


function get_pause_code_breakdown()
{

var url = "bluetelecoms/get_data/data.php"; // This is the file that handles the request
$.ajax({
  url: url,
  type: 'post',
  data: {"query":"get_pause_breakdown","user":user},
  success: function(data_)
  {

                          if(data_)  //This is returned from the PHP request
                          {

                            var listJson = JSON.parse(data_);

                            var add_pauses ='';   
                            //console.log(listJson)

                            $.each(listJson, function(i, item)
                            {
                             add_pauses +=  "<div class='col'><button type='button' class='btn btn-secondary btn-sm btn-block'>"+ item.sub_status+" "+ item.sec+ "</button></div>";

                            });




                        }


$('#pause_codes_stats').html(add_pauses);                   
  }

});


}

function find_calls_in_queue() {

////console.log('function called!!!!! '+  $('#callsinqueuelist tr').length);
  var end = $('#callsinqueuelist tr').length /2;
  var start = 1;
  var queuecontent="";

  do {
    
   
    var col = 0;
    if ($( "#callsinqueuelist  tr:eq("+start+") td:eq(0) ").html()!=null)
    {

      
            
            queuecontent += '<div class="inbound-number"><i class="fa fa-fw fa-phone"></i>'+$( "#callsinqueuelist  tr:eq("+start+") td:eq("+(col+1)+") ").html()+' '+$( "#callsinqueuelist  tr:eq("+start+") td:eq("+(col+3)+") ").html()+'</div>';
            queuecontent += "<div class='inbound-ingroup' style='color:white; background-color: "+$( "#callsinqueuelist  tr:eq("+start+") td:eq("+(col+5)+") ").css('background-color')+";'><i class='fa fa-fw fa-list'></i>"+$( '#callsinqueuelist  tr:eq('+start+') td:eq('+(col+6)+') ').html()+"</div>";
            queuecontent += '<div class="inbound-name"><i class="fa fa-fw fa-user"></i>'+$( "#callsinqueuelist  tr:eq("+start+") td:eq("+(col+2)+") ").html()+'</div>';
            queuecontent += '<div class="inbound-name"><i class="fa fa-fw fa-phone-volume"></i>'+$( "#callsinqueuelist  tr:eq("+start+") td:eq("+(col+4)+") ").html()+'</div>';
                       

      if ($( "#callsinqueuelist  tr:eq("+start+") td:eq(0) ").html().includes('onclick')==true)
    {
               queuecontent += '<div style="color:white;"><button class="btn btn-sm btn-block btn-info" onclick="'+$( "#callsinqueuelist  tr:eq("+start+") td:eq(0) a").attr('onclick')+'"><i class="fa fa-fw fa-hand-rock"></i>TAKE CALL </button></div>';
      }

            queuecontent +='<hr>';




    
      }



   start ++;
 }

 while (start < end+1);
 $('#callsininboundqueue').html(queuecontent);
}


function volumecontrol_btx() {
  conf_channels_detail('SHOW');
  var end2 = $('#outboundcallsspan tr').length/2;
  var start2 = 1;
  if (end2 != 0)
  {
  
  do {
   
  
    if ($( "#outboundcallsspan  tr:eq("+start2+") td:eq(2) ").html()!='recording')
    {
      if (($( "#outboundcallsspan  tr:eq("+start2+") td:eq(1) ").html().includes(phone_login) == true) && ($('#agentVOLup').html()==''))
      {
        
         $('#agentVOLup').html('<button type="button" class="btn btn-success" onclick="volume_control(\'UP\',\''+$( "#outboundcallsspan  tr:eq("+start2+") td:eq(1) ").text()+'\',\'\')"><i class="fas fa-volume-up"></i>&nbsp;</button>');
         $('#agentVOLdown').html('<button type="button" class="btn btn-danger" onclick="volume_control(\'DOWN\',\''+$( "#outboundcallsspan  tr:eq("+start2+") td:eq(1) ").text()+'\',\'\')"><i class="fas fa-volume-down"></i>&nbsp;</button>');
          $('#agentVOLmute').html('<button type="button" id="buttonagentmute" class="btn btn-warning" onclick="volume_control(\'MUTING\',\''+$( "#outboundcallsspan  tr:eq("+start2+") td:eq(1) ").text()+'\',\'\'); $(\'#buttonagentunmute\').show(); $(\'#buttonagentmute\').hide();"><i class="fas fa-microphone-slash"></i>&nbsp;MUTE</button><button type="button" id="buttonagentunmute" class="btn btn-success" onclick="volume_control(\'UNMUTE\',\''+$( "#outboundcallsspan  tr:eq("+start2+") td:eq(1) ").text()+'\',\'\'); $(\'#buttonagentunmute\').hide(); $(\'#buttonagentmute\').show();" style="display:none;"><i class="fas fa-microphone"></i>&nbsp;UNMUTE</button>');
      }
      else
      if (($( "#outboundcallsspan  tr:eq("+start2+") td:eq(1) ").html().includes(phone_login) == false) && ($('#clientVOLup').html()==''))
      {
          $('#clientVOLup').html('<button type="button" class="btn btn-success" onclick="volume_control(\'UP\',\''+$( "#outboundcallsspan  tr:eq("+start2+") td:eq(1) ").text()+'\',\'\')"><i class="fas fa-volume-up"></i>&nbsp;</button>');
         $('#clientVOLdown').html('<button type="button" class="btn btn-danger" onclick="volume_control(\'DOWN\',\''+$( "#outboundcallsspan  tr:eq("+start2+") td:eq(1) ").text()+'\',\'\')"><i class="fas fa-volume-down"></i>&nbsp;</button>');
      }

   }

   start2 ++;
 }
 while (start2 < end2+1);
}
}




function find_preset_list() {
  generate_presets_pulldown();
  $('#btx_preset_list').html(''); 
  var btx_preset_count = 1;

  $('#PresetsSelectBoxContent a').each(function() {
   if ($(this).html() !='Close [X]')
   {

    if ($(this).html().substr(0,4) == "-FA-")
    {

      var new_preset = $(this).html().replace(/[0-9]/g, '');
      new_preset = new_preset.substring(4);
     var list_of_avaliable_presets = "<div class='col-6'><button style='margin:5px' type='button' id = 'btx_live_preset_"+btx_preset_count+"' class='btn btn-primary btn-block btn-sm preset_selection'><i class='"+new_preset+" fa-5x'></i></button></div>";

    }
  else
  {
     var list_of_avaliable_presets = "<div class='col-6'><button style='margin:5px' type='button' id = 'btx_live_preset_"+btx_preset_count+"' class='btn btn-primary btn-block btn-sm preset_selection'><i class='fas fa-phone-square'></i>&nbsp;"+$(this).html()+"</button></div>";
  }
     $('#btx_preset_list').append(list_of_avaliable_presets); 

     if ($(this).html().substr(0,4) == "-FA-")
     {
      $('#btx_live_preset_'+btx_preset_count).attr('onClick',"transfer_where='Preset ';preset_option_clicked('');" + $(this).attr('onclick'));
     }
     else
     { 
      $('#btx_live_preset_'+btx_preset_count).attr('onClick',"transfer_where='Preset: "+$(this).html()+"';preset_option_clicked('"+$(this).html()+"');" + $(this).attr('onclick'));
     }
     btx_preset_count ++
   }


 });
  hideDiv('PresetsSelectBox');
}



$(document).ready(function()

{

  

  if (view_calls_in_queue > 0) {

   $('#show_calls_in_queue_button').attr('onClick', "$('#sidebaroverlay').show();show_calls_in_queue('SHOW');");

   if(view_calls_in_queue_launch > 0)
   {
    $('#sidebaroverlay').show();
  }


 

}


$(document).on('shown.bs.modal','#LeaDInfOBox', function () {

  $('#pills-tab a:first').tab('show'); 
});
///get agent stat information
var SPH = 'T';
var targetsales = 0;
			var url = "bluetelecoms/get_data/data.php"; // This is the file that handles the request
      $.ajax({
        url: url,
        type: 'post',
        data: {"query":"find_agent_custom1_data","user":user},
        success: function(data_)
        {

                                if(data_)  //This is returned from the PHP request
                                {
                                	
                                 var listJson = JSON.parse(data_);

                                 if (listJson.custom_one.slice(0, 3) == 'BTX')
                                 {
                                   var userarray = listJson.custom_one.split("-");	
                                   targetsales=userarray[1];
                                 
                                 if (userarray[1].includes('H')==true) 
                                  {
                                    SPH = 'H';
                                    targetsales = userarray[1].substring(0, userarray[1].length - 1);
                                  }
                                  else if (userarray[1].includes('D')==true)
                                  {
                                    SPH = 'D';
                                  }
                                  else
                                  {
                                  SPH = 'T';
                                  }
                                   poplulate_agent_sales(targetsales,SPH);
                                   if (userarray[3]=='Y')
                                   {

                                    $("#btx_img_sample").attr("src",userarray[2]);
                                    $("#btx_user_profile_img").attr("src",userarray[2]);
                                    $("#btx_user_profile_img_container").show();
                                    $('#profile_image_placeholder').hide();
                                    $('#ImageMessage').hide();
                                  }
                                  else
                                    if (userarray[3]=='N')
                                    {


                                     $("#btx_img_sample").attr("src",userarray[2]);
                                     $('#ImageMessage').html('Image Waiting Manager Approval')
                                     $('#ImageMessage').show();
                                     $("#btx_user_profile_img_container").hide();
                                     $('#profile_image_placeholder').show();                           
                                   }
                                   else 
                                   {

                                    $('#ImageMessage').html('No Image Set')
                                    $('#ImageMessage').show();
                                    $("#btx_user_profile_img_container").hide();
                                    $('#profile_image_placeholder').show();

                                  }                            

                                }										
                              }


                            }

                          });


///end agent stat

$('#btx_api_button_1').on('click',function() {
  WebFormRefresH('NO','YES');CustomerData_update();document.getElementById('vcFormIFrame').contentDocument.form_custom_fields.submit();
  window.open(TEMP_VDIC_web_form_address, web_form_target, 'toolbar=1,scrollbars=1,location=1,statusbar=1,menubar=1,resizable=1,width=640,height=450');
   setTimeout(function() { FormContentsLoad(); }, 1000);
});

$('#btx_api_button_2').on('click',function() {
  WebFormTwoRefresH('NO','YES');CustomerData_update();document.getElementById('vcFormIFrame').contentDocument.form_custom_fields.submit();
  window.open(TEMP_VDIC_web_form_address_two, web_form_target, 'toolbar=1,scrollbars=1,location=1,statusbar=1,menubar=1,resizable=1,width=640,height=450');
   setTimeout(function() { FormContentsLoad(); }, 1000);
});

if (per_call_notes == 'ENABLED')
{
  $('#switch_comments_box_span').show();
  $('#btx_input_call_notes_dispo_area').show();

  $('#btx_input_call_notes').on('change',function(){

    document.vicidial_form.call_notes.value = this.value;

  });
  
  $('#btx_input_call_notes_dispo').on('change',function(){

    document.vicidial_form.call_notes_dispo.value = this.value;

  });


  $('#btx_show_comments_button').on('click',function() {
    $('#btx_show_call_log_button').addClass('btn-secondary').removeClass('btn-success');
    $('#btx_show_comments_button').removeClass('btn-secondary').addClass('btn-success');
    $('#btx_input_call_notes').hide();
    $('#btx_input_comments').show();
  });

  $('#btx_show_call_log_button').on('click',function() {
    $('#btx_show_call_log_button').removeClass('btn-secondary').addClass('btn-success');
    $('#btx_show_comments_button').addClass('btn-secondary').removeClass('btn-success');
    $('#btx_input_call_notes').show();
    $('#btx_input_comments').hide();

  });


///also add to dispo

if (agent_call_log_view == '1')
{
  $('#btx_show_call_log_history').show(); 
}
}



$('#btx_search_phone').on('change',function(){

  document.vicidial_form.search_phone_number.value = this.value;
  document.vicidial_form.search_main_phone.checked=true;

});

$('#btx_search_lead_id').on('change',function(){

  document.vicidial_form.search_lead_id.value = this.value;
  document.vicidial_form.search_main_phone.checked=true;

});

$('#btx_search_vlc').on('change',function(){

  document.vicidial_form.search_vendor_lead_code.value = this.value;
  document.vicidial_form.search_main_phone.checked=true;

});



$('#btx_DiaLLeaDPrevieW123').on('change',function() {
  if ($(this).prop('checked') == true)
  {
   document.vicidial_form.LeadPreview.checked=true;
 }
 else
 {
   document.vicidial_form.LeadPreview.checked=false;
 }
})

//$('#hangup_button').on('click',function() {
//if($('#btx_DiaLDiaLAltPhonE123').prop('checked') != true) {$('#modal-outcome').modal('show');};
//});


$('#btx_DiaLDiaLAltPhonE123').on('change',function() {
  if ($(this).prop('checked') == true)
  {
   document.vicidial_form.DiaLAltPhonE.checked=true;
 }
 else
 {
   document.vicidial_form.DiaLAltPhonE.checked=false;
 }
})



$( "#btx_LeadLookuP" ).on('change',function() {
  if ($("#btx_LeadLookuP").prop('checked')==true )
   {document.vicidial_form.LeadLookuP.checked=true;}
 else
   {document.vicidial_form.LeadLookuP.checked=false;}

});




if (manual_dial_search_checkbox == 'SELECTED_LOCK') 
{
	$('#btx_man_lookup_text').html('Dialler is Set to Search for Client Record for Manual Calls');
}

if  (manual_dial_search_checkbox == 'UNSELECTED_LOCK')
{
	$('#btx_man_lookup_text').html('Dialler is Set to Add a New Record for Manual Calls');
}


$( "#btx_input_MDPhonENumbeR" ).on('keypress change input',function() {
  $('#btx_input_MDPhonENumbeR').val($('#btx_input_MDPhonENumbeR').val().replace(/[^0-9]+/g, ''));
  $('#btx_input_MDPhonENumbeR').val($('#btx_input_MDPhonENumbeR').val().replace(/^0+/, ''));


  if ((($('#btx_input_MDPhonENumbeR').val().length > 5) && $('#btx_input_MDPhonENumbeR').val() != 'Phone Number'))
  {
    $(".man_dial_buttons").prop('disabled', false);
  }
  else
  {
    $(".man_dial_buttons").prop('disabled', true);
  }
});

if (scheduled_callbacks < 1){
 $("#viewLeads").hide();
}

$(".sessionID_val").html(session_id);
		//////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////// - START TESTING - /////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////

		function get_all_global_variables_and_values(){
			for(var b in window){
				if(window.hasOwnProperty(b)){
					////////console.log(b + " - " + window[b]);
				}
			}
		}
		// on click get all variables
		$("#get_all_variables").on("click", function(){
			get_all_global_variables_and_values();
		});
		
		//////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////// - END TESTING - /////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////

//// Webphone settings
if (window.top.$('#webphone').length){
if (!window.top.$('#webphone').attr('src').includes('webrtc.bluetelecoms.com'))
{ 
  dtmf0 = new Audio("./sounds/dtmf_0.wav");
  dtmf1 = new Audio("./sounds/dtmf_1.wav");
  dtmf2 = new Audio("./sounds/dtmf_2.wav");
  dtmf3 = new Audio("./sounds/dtmf_3.wav");
  dtmf4 = new Audio("./sounds/dtmf_4.wav");
  dtmf5 = new Audio("./sounds/dtmf_5.wav");
  dtmf6 = new Audio("./sounds/dtmf_6.wav");
  dtmf7 = new Audio("./sounds/dtmf_7.wav");
  dtmf8 = new Audio("./sounds/dtmf_8.wav");
  dtmf9 = new Audio("./sounds/dtmf_9.wav");
  dtmfhash = new Audio("./sounds/dtmf_hash.wav");
  dtmfstar = new Audio("./sounds/dtmf_star.wav");
  
  $('#dtmf-0').unbind('click').attr("onclick","window.top.$('#webphone').contents().find('#zero').click();dtmf0.play();");
  $('#dtmf-1').unbind('click').attr("onclick","window.top.$('#webphone').contents().find('#one').click();dtmf1.play();");
  $('#dtmf-2').unbind('click').attr("onclick","window.top.$('#webphone').contents().find('#two').click();dtmf2.play();");
  $('#dtmf-3').unbind('click').attr("onclick","window.top.$('#webphone').contents().find('#three').click();dtmf3.play();");
  $('#dtmf-4').unbind('click').attr("onclick","window.top.$('#webphone').contents().find('#four').click();dtmf4.play();");
  $('#dtmf-5').unbind('click').attr("onclick","window.top.$('#webphone').contents().find('#five').click();dtmf5.play();");
  $('#dtmf-6').unbind('click').attr("onclick","window.top.$('#webphone').contents().find('#six').click(); dtmf6.play();");
  $('#dtmf-7').unbind('click').attr("onclick","window.top.$('#webphone').contents().find('#seven').click();dtmf7.play();");
  $('#dtmf-8').unbind('click').attr("onclick","window.top.$('#webphone').contents().find('#eight').click(); dtmf8.play();");
  $('#dtmf-9').unbind('click').attr("onclick","window.top.$('#webphone').contents().find('#nine').click(); dtmf9.play();");
  $('#dtmf-hash').unbind('click').attr("onclick","window.top.$('#webphone').contents().find('#pound').click();dtmfhash.play();");
  $('#dtmf-star').unbind('click').attr("onclick","window.top.$('#webphone').contents().find('#star').click();dtmfstar.play();");
} 
}
///// default callback menu settings should be run when callback button is clicked

function configurecallbackwindow(){

  var dateFormat = "DD-MM-YYYY";
  var CurrDate = new Date();


  
  dateCurr = moment(CurrDate, dateFormat);

  if (callback_days_limit == 0)
  {
    dateMax = moment(CurrDate, dateFormat).add(999, 'days');
  }
  else
  {
  	dateMax = moment(CurrDate, dateFormat).add(callback_days_limit, 'days');	
  }

  $("#datetimepicker1").datetimepicker({
    date: dateCurr,
    minDate: dateCurr,
    maxDate: dateMax,
    stepping: 5,
    format: 'YYYY-MM-DD HH:mm' 
  });
  
  $('#callbacknotes').val('');
  $('#callbacks_set_so_far').html('');

  if (((LastCallbackCount >= callback_active_limit) && callback_active_limit != 0) || (agentonly_callbacks == 0))
  {
  	$("#mycallbackonly").prop('checked', false);
    $("#mycallbackonly").prop('disabled', true);

  }

  else if(my_callback_option == 'CHECKED')
  {
  	$("#mycallbackonly").prop('disabled', false);	
  	$("#mycallbackonly").prop('checked', true);
  }
  else if(my_callback_option == 'UNCHECKED')
  {
  	$("#mycallbackonly").prop('disabled', false);	
  	$("#mycallbackonly").prop('checked', false);
  }
  if ( (comments_callback_screen == 'ENABLED') || (comments_callback_screen == 'REPLACE_CB_NOTES') )
  {
    $('#callbacknotesection').show();
  }
  else
  {
    $('#callbacknotesection').hide();	
  }
  $("#datetimepicker1").val(moment().format('YYYY-MM-DD HH:mm'));


  $('#datetimepicker1').val($('#datetimepicker2').val());
  $('#callbacknotes').val($('#pre_callbacknotes').val());
  if ($('#pre_CBKpriorityMed').prop('checked')==true){$('#CBKpriorityMed').prop('checked',true);}
  if ($('#pre_CBKpriorityHigh').prop('checked')==true){$('#CBKpriorityHigh').prop('checked',true);}
  if ($('#pre_CBKpriorityLow').prop('checked')==true){$('#CBKpriorityLow').prop('checked',true);}
  if ($('#pre_mycallbackonly').prop('checked')==true){$('#mycallbackonly').prop('checked',true);} else {$('#mycallbackonly').prop('checked',false);}
  $('#callbacks_set_so_far').html($('#pre_callbacks_set_so_far').html());

  $('#modal-new-callbacks').modal('show');
}






///////CALLBACK WINDOW HANDLING SECTION	
var callback_date_set = '';


$('#datetimepicker1').on('blur', function(){

 $("#call_back_submit_and_pause_button").attr('disabled',false);
 $("#call_back_submit_button").attr('disabled',false);



 if((this.value != callback_date_set) && ($("#mycallbackonly").prop('checked') == true)){


			var url = "bluetelecoms/get_data/data.php"; // This is the file that handles the request
      $.ajax({
        url: url,
        type: 'post',
        data: {"query":"callbacks_set","user":user,"newcallbacktime":this.value},
        success: function(data_)
        {
         data = '';
                                if(data_)  //This is returned from the PHP request
                                {
                                	var c = 1;
                                 var listJson = JSON.parse(data_);
                                 $.each(listJson, function(i, item)
                                 {
                                  if (item == 0){
                                   data += '<tr class="table-success">';
                                 }
                                 else
                                 {
                                   data += '<tr class="table-danger">';
                                 }

                                 if (c==3)
                                 {
                                   data += '<td><b>><b></td><td><b>'+i+'</b></td>';
                                 }
                                 else
                                 {
                                   data += '<td><b><b></td><td>'+i+'</td>';
                                 }                                            	

                                 if (item == 0){
                                   data += '<td>FREE</td></tr>';
                                 }
                                 else
                                 {
                                   data += '<td>CALLBACKS SET: '+item+'</td></tr>';
                                 }                                          

                                 c++;
                               });  

                               }

                               $('#callbacks_set_so_far').html(data);
                             }

                           });



      callback_date_set = this.value;
    }
    if ($("#mycallbackonly").prop('checked') == false)
    {
     $('#callbacks_set_so_far').html('');	
   }

 });





 //// default callback menu settings should be run when callback button is clicked

 function configureprecallbackwindow(){

  var dateFormat = "DD-MM-YYYY";
  var CurrDate = new Date();


  
  dateCurr = moment(CurrDate, dateFormat);

  if (callback_days_limit == 0)
  {
    dateMax = moment(CurrDate, dateFormat).add(999, 'days');
  }
  else
  {
    dateMax = moment(CurrDate, dateFormat).add(callback_days_limit, 'days');  
  }

  $("#datetimepicker2").datetimepicker({
    date: dateCurr,
    minDate: dateCurr,
    maxDate: dateMax,
    stepping: 5,
    format: 'YYYY-MM-DD HH:mm' 
  });
  
  $('#pre_callbacknotes').val('');
  $('#pre_callbacks_set_so_far').html('');

  if (((LastCallbackCount >= callback_active_limit) && callback_active_limit != 0) || (agentonly_callbacks == 0))
  {

    $('.viewcallback_diary_div').hide();     
  }

  else if(my_callback_option == 'CHECKED')
  {
    $("#pre_mycallbackonly").prop('disabled', false); 
    $("#pre_mycallbackonly").prop('checked', true);
  }
  else if(my_callback_option == 'UNCHECKED')
  {
    $("#pre_mycallbackonly").prop('disabled', false); 
    $("#pre_mycallbackonly").prop('checked', false);
  }
  if ( (comments_callback_screen == 'ENABLED') || (comments_callback_screen == 'REPLACE_CB_NOTES') )
  {
    $('#pre_callbacknotesection').show();
  }
  else
  {
    $('#pre_callbacknotesection').hide(); 
  }
  $("#datetimepicker2").val(moment().format('YYYY-MM-DD HH:mm'));

  $('#CBKpriorityMed').prop('checked',true);

}


/////// PRE CALLBACK WINDOW HANDLING SECTION 
var callback_date_set = '';


$('#datetimepicker2').on('blur', function(){
  $("#call_back_submit_and_pause_button").attr('disabled',false);
  $("#call_back_submit_button").attr('disabled',false);



  if((this.value != callback_date_set) && ($("#pre_mycallbackonly").prop('checked') == true)){


      var url = "bluetelecoms/get_data/data.php"; // This is the file that handles the request
      $.ajax({
        url: url,
        type: 'post',
        data: {"query":"callbacks_set","user":user,"newcallbacktime":this.value},
        success: function(data_)
        {
          data = '';
                                if(data_)  //This is returned from the PHP request
                                {
                                  var c = 1;
                                  var listJson = JSON.parse(data_);
                                  $.each(listJson, function(i, item)
                                  {
                                    if (item == 0){
                                      data += '<tr class="table-success">';
                                    }
                                    else
                                    {
                                      data += '<tr class="table-danger">';
                                    }

                                    if (c==3)
                                    {
                                      data += '<td><b>><b></td><td><b>'+i+'</b></td>';
                                    }
                                    else
                                    {
                                      data += '<td><b><b></td><td>'+i+'</td>';
                                    }                                             

                                    if (item == 0){
                                      data += '<td>FREE</td></tr>';
                                    }
                                    else
                                    {
                                      data += '<td>CALLBACKS SET: '+item+'</td></tr>';
                                    }                                          

                                    c++;
                                  });  

                                }

                                $('#pre_callbacks_set_so_far').html(data);
                                $('#callbacks_set_so_far').html($('#pre_callbacks_set_so_far').html());
                              }

                            });


    }
    if ($("#pre_mycallbackonly").prop('checked') == false)
    {
      $('#pre_callbacks_set_so_far').html('');  
    }

  });



////click callback submit
$('#call_back_submit_button').on('click',function(){

  if ($("#mycallbackonly").prop('checked') == true)
  {
   document.vicidial_form.CallBackOnlyMe.checked = true;
 }
 else
 {
   document.vicidial_form.CallBackOnlyMe.checked = false;	
 }
 callback_time_24hour = 1;

 document.vicidial_form.CallBackDatESelectioN.value = moment($('#datetimepicker1').val()).format('YYYY-MM-DD');

 if (document.getElementById('CallBackSelectBox').innerHTML.includes('CBT_ampm') == true)
 { 

  if (moment($('#datetimepicker1').val()).format('HH')>11)  
  {
  ////console.log('PM')
  document.getElementById('CBT_ampm').value ='PM';
  //CallBackTimEAmpM ='PM'
  document.vicidial_form.CBT_hour.value = moment($('#datetimepicker1').val()).format('hh');
}
else
{
  ////console.log('AM')
  document.getElementById('CBT_ampm').value ='AM'
  //CallBackTimEAmpM = 'AM'
  document.vicidial_form.CBT_hour.value = moment($('#datetimepicker1').val()).format('hh');
}
}
else
{
  document.vicidial_form.CBT_hour.value = moment($('#datetimepicker1').val()).format('HH');
}
var cbcommentsbtx = $('#callbacknotes').val();



if ($('#CBKpriorityMed').prop('checked')==true){document.vicidial_form.CallBackCommenTsField.value = '2>'+cbcommentsbtx;}
if ($('#CBKpriorityHigh').prop('checked')==true){document.vicidial_form.CallBackCommenTsField.value = '1>'+cbcommentsbtx;}
if ($('#CBKpriorityLow').prop('checked')==true){document.vicidial_form.CallBackCommenTsField.value = '3>'+cbcommentsbtx;}

//document.vicidial_form.CBT_hour.value = moment($('#datetimepicker1').val()).format('hh');

document.vicidial_form.CBT_minute.value = moment($('#datetimepicker1').val()).format('mm');


$('#CBKpriorityMed').prop('checked',true);
hideDiv('CallBackSelectBox');
$('#modal-new-callbacks').modal('hide');
$("#call_back_submit_and_pause_button").attr('disabled',true);
$("#call_back_submit_button").attr('disabled',true);
CallBackDatE_submit();


});


///click callback submit and pause

$('#call_back_submit_and_pause_button').on('click',function(){

  if ($("#mycallbackonly").prop('checked') == true)
  {
   document.vicidial_form.CallBackOnlyMe.checked = true;
 }
 else
 {
   document.vicidial_form.CallBackOnlyMe.checked = false;	
 }


 document.vicidial_form.CallBackDatESelectioN.value = moment($('#datetimepicker1').val()).format('YYYY-MM-DD');

 if (document.getElementById('CallBackSelectBox').innerHTML.includes('CBT_ampm') == true)
 { 

  if (moment($('#datetimepicker1').val()).format('HH')>11)  
  {
  ////console.log('PM')
  document.getElementById('CBT_ampm').value ='PM';
  //CallBackTimEAmpM ='PM'
  document.vicidial_form.CBT_hour.value = moment($('#datetimepicker1').val()).format('hh');
}
else
{
  ////console.log('AM')
  document.getElementById('CBT_ampm').value ='AM'
  
  document.vicidial_form.CBT_hour.value = moment($('#datetimepicker1').val()).format('hh');
}
}
else
{
  document.vicidial_form.CBT_hour.value = moment($('#datetimepicker1').val()).format('HH');
}
var cbcommentsbtx = $('#callbacknotes').val();

if ($('#CBKpriorityMed').prop('checked')==true){document.vicidial_form.CallBackCommenTsField.value = '2>'+cbcommentsbtx;}
if ($('#CBKpriorityHigh').prop('checked')==true){document.vicidial_form.CallBackCommenTsField.value = '1>'+cbcommentsbtx;}
if ($('#CBKpriorityLow').prop('checked')==true){document.vicidial_form.CallBackCommenTsField.value = '3>'+cbcommentsbtx;}



//document.vicidial_form.CBT_hour.value = moment($('#datetimepicker1').val()).format('hh');

document.vicidial_form.CBT_minute.value = moment($('#datetimepicker1').val()).format('mm');

hideDiv('CallBackSelectBox');
$('#modal-new-callbacks').modal('hide');
$("#call_back_submit_and_pause_button").attr('disabled',true);
$("#call_back_submit_button").attr('disabled',true);
CallBackDatE_submit();

$('#CBKpriorityMed').prop('checked',true);
if ( auto_dial_level > 0 )
{
	////////console.log('auto_dial_level' + auto_dial_level);
	AutoDial_ReSume_PauSe("VDADpause");
}

if ((agent_pause_codes_active=='Y') || (agent_pause_codes_active=='FORCE'))
{
//btx_autodial_resume_pause();
btx_open_pause_menu();
}



});


//// end of callback section

		// function to check variables from http
		function getParameterByName(name, url) {
			if (!url) url = window.location.href;
			name = name.replace(/[\[\]]/g, "\\$&");
			var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
			results = regex.exec(url);
			if (!results) return null;
			if (!results[2]) return '';
			return decodeURIComponent(results[2].replace(/\+/g, " "));
		}

		// Start: Transfer - Park only on live call
		// disable the Transfer - Park buttons as soon as the page loads
		$(".btx_transfer_button").hide();
		$("#park_button").hide();
		setInterval(function(){
			
			if(VD_live_customer_call || XD_live_customer_call){
				// enable the Transfer - Park buttons
				$(".btx_transfer_button").show();
				$("#park_button").show();
				////////console.log("VD_live_customer_call or XD_live_customer_call set to 1");
			} else{
				$(".btx_transfer_button").hide();
				$("#park_button").hide();
			}
		},100);
		// End: Hangup - Transfer - Park only on live call

		////////////////////////////////////////////////////////////////////////////////////////////////
		/////////////////////// - START Check if "dial_method" is not INBOUND_MAN - ////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////
		// if dial method is set to INBOUND_MAN then show the Dial Next button, else hide it. 
		if(dial_method != "INBOUND_MAN"){
			$("#dial_next_button").hide();
		}


		////////////////////////////////////////////////////////////////////////////////////////////////
		/////////////////////// - END Check if "dial_method" is not INBOUND_MAN - //////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////

		//////////////////////////////////////////////////////////////////////////////////////
		/////////////////////// - START Implement API1 and API2 Buttons - ////////////////////
		//////////////////////////////////////////////////////////////////////////////////////

		// the buttons should not be ENABLED if there is no url in the button and/or not in call

		// get the values of the old interface buttons before a call is made, then when a call is made we can compare the values every second or so and if different stp the interval
		// get it for the first api button
		//var btx_web_form_one_href = $("#WebFormSpan a").attr("href");
		// get it for the second api button
		//var btx_web_form_two_href = $("#WebFormSpanTwo a").attr("href");
		
		$(".btx_transfer_button").on("click", function(){
			$("#XfeRGrouP").removeClass("cust_form");
			$("#XfeRGrouP").addClass("form-control");
      if (document.getElementById("XfeRGrouP").innerHTML =='') {$("#btx_transfer_to_ingroup").prop('disabled', true);}
      generate_presets_pulldown();
      if ($('#PresetsSelectBoxContent a').html()=='Close [X]') { $("#btx_transfer_to_preset").prop('disabled', true);}
      hideDiv('PresetsSelectBox');
      $("#btx_transfer_number_confirm").prop('disabled', true);
      $("#btx_transfer_number").val('');
		});
		// run the code below when a call is made
		$("#btx_dial_now_button").on("click", function(){
			
			if(VDRP_stage == "READY"){
				alert("YOU MUST BE PAUSED TO MANUAL DIAL A NEW LEAD IN AUTO-DIAL MODE");
				return false;
			}
	//		var get_api_buttons_data = setInterval(function(){
	//			// first - there is a href link we need to get from the old interface
	//			// get it for the first api button
	//			var btx_web_form_one_href_current = $("#WebFormSpan a").attr("href");
	//			// get it for the second api button
	//			var btx_web_form_two_href_current = $("#WebFormSpanTwo a").attr("href");
	//			// if the data is here then add the data to the new interface buttons and stop the interval
	//			if((btx_web_form_one_href != btx_web_form_one_href_current) || (btx_web_form_two_href != btx_web_form_two_href_current)){
	//				////////console.log("boom");
	//				////////console.log("api 1 href: "+ btx_web_form_one_href_current);
	//				////////console.log("api 2 href: "+ btx_web_form_two_href_current);
	//				$("#btx_api_button_1").attr("href", btx_web_form_one_href_current);
	//				$("#btx_api_button_2").attr("href", btx_web_form_two_href_current);
	//				$("#btx_api_button_1").removeClass("disabled");
	//				$("#btx_api_button_2").removeClass("disabled");
	//				clearInterval(get_api_buttons_data);
	//			}
	//			// second - we need to fire the appropriate function that the button is firing
	//		},100);

});
		// on hang up of call disable the api buttons and clear the hrefs
		$("#submit_and_pause_button").on("click", function(){
			$("#btx_api_button_1").addClass("disabled");
			$("#btx_api_button_2").addClass("disabled");
			//$("#btx_api_button_1").attr("href", "");
			//$("#btx_api_button_2").attr("href", "");
		});
		
		document.getElementById("DiaLDiaLAltPhonE").style.display = "none";
		
   $('#MainStatuSSpan').on('DOMSubtreeModified',function(){
    $('#MainStatuSSpan11').html($('#MainStatuSSpan').html());
  });

    
   $('#dialableleadsspan').on('DOMSubtreeModified',function(){
    $('#btx_dialable_leads').html($('#dialableleadsspan').html());
  });
   $('#CloserSelectBox').on('DOMSubtreeModified',function(){
    $('#CloserSelectBox123').html($('#CloserSelectBox').html());
  });
   $('#AgentStatusCalls').on('DOMSubtreeModified',function(){
     if (($('#AgentStatusCalls').find('font').html() !='') && ($('#AgentStatusCalls').find('font').html() !=' 0') && ($('#AgentStatusCalls').find('font').html() !='0') && ($('#AgentStatusCalls').find('font').html() !=undefined))
     {	
       $('#show_calls_in_queue_button').addClass('btn-danger');	
       $('#AgentStatusCalls123').html('&nbsp;' + $('#AgentStatusCalls').find('font').html());
   if ((inboundringing =='YES') && ((prev_status !='INCALL') && (prev_status !='INBOUNDINCALL') && (prev_status !='MANUAL') && (prev_status !='MANPREV')))
       {
       startmakeringsound();
       }

     }
     else
     {
      $('#show_calls_in_queue_button').removeClass('btn-danger');	
      $('#AgentStatusCalls123').html('&nbsp;Queue&nbsp;');

    }
  });
   $('#ManualQueueNotice').on('DOMSubtreeModified',function(){
    $('#ManualQueueNotice123').html($('#ManualQueueNotice').html());
  });
   $('#ManualQueueChoice').on('DOMSubtreeModified',function(){
    $('#ManualQueueChoice123').html($('#ManualQueueChoice').html());
  });
   $('#DiaLDiaLAltPhonE').on('DOMSubtreeModified',function(){
    $('#DiaLDiaLAltPhonE123').html($('#DiaLDiaLAltPhonE').html());
  });
   $('#SecondSspan').on('DOMSubtreeModified',function(){
    $('#SecondSspan123').html($('#SecondSspan').html());
  });
   $('#SecondSDISP').on('DOMSubtreeModified',function(){
    $('#SecondSDISP123').html($('#SecondSDISP').html());
  });
   $('#callsinqueuedisplay').on('DOMSubtreeModified',function(){
    $('#callsinqueuedisplay123').html($('#callsinqueuedisplay').html());
  });
   $('#callsinqueuelist').on('DOMNodeInserted',function(){
    find_calls_in_queue()

  });
   $('#outboundcallsspan').on('DOMSubtreeModified',function(){
    volumecontrol_btx()

  });
		/*
		$('#LocalCloser').on('DOMSubtreeModified',function(){
			
		  span_change = $(this).html();
			  if(span_change = '<img src="./images/vdc_XB_localcloser.gif" alt="LOCAL CLOSER" style="vertical-align:middle" border="0">'){	
					
					 $('#LocalCloser').html($('#LocalCloser123').html());
			  }
			  
			  
		  //~ $('#LocalCloser123').html($('#LocalCloser').html());
		});
		*/
		$('#AgentXferViewSpan').on('DOMSubtreeModified',function(){
      $('#AgentXferViewSpan123').html($('#AgentXferViewSpan').html());
    });
		$('#AgentXferViewSelect').on('DOMSubtreeModified',function(){
      $('#AgentXferViewSelect123').html($('#AgentXferViewSelect').html());
    });
		$('#CallBacKsLisT').on('DOMSubtreeModified',function(){
      $('#CallBacKsLisT123').html($('#CallBacKsLisT').html());
    });
		$('#XfeRGrouPLisT').on('DOMSubtreeModified',function(){
      $('#XfeRGrouPLisT123').html($('#XfeRGrouPLisT').html());
    });



		

		
		$('#DiaLControl123').on('click',function(){
			//~ alert($('#DiaLControl > a').last().html());
			$('#DiaLControl > a').last().trigger("click");
			setTimeout(function(){
				if($('#DiaLControl a:last-child').html() !== 'undefind'){
					//alert($('#DiaLControl img:last-child').html());
					imgsrc=$('#DiaLControl img:last-child').attr('src');
					//~ alert(imgsrc);
					if(imgsrc=="./images/<?php echo _QXZ("vdc_LB_dialnextnumber_OFF.gif"); ?>"){
           $('.btx_dial_next_button123').attr('disabled',true);
         }else{
          $('.btx_dial_next_button123').attr('disabled',false);
        }
      }else{
					//~ alert($('#DiaLControl  img:last-child').html());
					parent=$('#DiaLControl a:last-child').html();
					imgsrc=parent.attr('src');
					//~ alert(imgsrc);
					if(imgsrc=="./images/<?php echo _QXZ("vdc_LB_dialnextnumber_OFF.gif"); ?>"){
						$('.btx_dial_next_button123').attr('disabled',true);
					}else{
						$('.btx_dial_next_button123').attr('disabled',false);
					}
				}
			}, 1000);

		  //$('#DiaLControl').html($('#MainStatuSSpan').html());
		});
		$('#DiaLControl > a').on('click',function(){
			
			var htmlval="abc";
			$('#DiaLControl11').html(htmlval);
		  //$('#DiaLControl').html($('#MainStatuSSpan').html());
		});
		
		
		


			var url = "bluetelecoms/get_data/data.php"; // This is the file that handles the request
      $.ajax({
        url: url,
        type: 'post',
        data: {"query":"pause_limit_active"},
        success: function(data_)
        {

                                if(data_)  //This is returned from the PHP request
                                {
                                	
                                 var listJson = JSON.parse(data_);
                                 btx_pause_limit = listJson.enable_pause_code_limits ;


                               }


                             }

                           });		

		//////////////////////////////////////////////////////////////////////////////////////
		//////////////////////// - END Implement API1 and API2 Buttons - /////////////////////
		//////////////////////////////////////////////////////////////////////////////////////
    bad_dispo_cat=[];
    sale_dispo_cat=[];
    cbk_dispo_cat=[];
    contact_dispo_cat=[];
///mike get dispo catagories for dispo screen colours

var url = "bluetelecoms/get_data/data.php"; // This is the file that handles the request
$.ajax({
  url: url,
  type: 'post',
  data: {"query":"dispo_cat","camp":campaign},
  success: function(data_)
  {
                                if(data_)  //This is returned from the PHP request
                                {
                                 var listJson = JSON.parse(data_);
                               //  //console.log(listJson)
                                $.each(listJson['CBK'], function(i, item)
                                 {
                                  cbk_dispo_cat.push(item.status);    
                                });  
                                 $.each(listJson['SALES'], function(i, item)
                                 {
                                  sale_dispo_cat.push(item.status);    
                                });   
   
                                 $.each(listJson['BAD'], function(i, item)
                                 {
                                  bad_dispo_cat.push(item.status);    
                                });  
                                 $.each(listJson['CONTACT'], function(i, item)
                                 {
                                  contact_dispo_cat.push(item.status);    
                                });                               
                               }

                               // $('#campaign_dropdown').html(data);
                             }

                           });

$( ".dtmf-button" ).hover(
  function() {
    $( this ).removeClass( "dtmf-button-inactive" );
    $( this ).addClass( "dtmf-button-active" );
  }, function() {
    $( this ).removeClass( "dtmf-button-active" );
    $( this ).addClass( "dtmf-button-inactive" );
  }
  );






/////disable/hide fields based on campaign settings:


if (document.getElementById('title').type=='hidden')
  {$('#btx_input_title').hide();}
else
{
  if (document.getElementById("title").readOnly==true)
    {$('#btx_input_title').attr("disabled", true); }
}


if (document.getElementById('first_name').type=='hidden')
  {$('#btx_input_first_name').hide();}
else
{ 
  if (document.getElementById("first_name").readOnly==true)
    {$('#btx_input_first_name').attr("disabled", true); }
}


if (document.getElementById('last_name').type=='hidden')
  {$('#btx_input_last_name').hide();}
else
{ 
  if (document.getElementById("last_name").readOnly==true)
    {$('#btx_input_last_name').attr("disabled", true); }
}


if (document.getElementById('address1').type=='hidden')
  {$('#btx_input_address1').hide();}
else
{ 
  if (document.getElementById("address1").readOnly==true)
    {$('#btx_input_address1').attr("disabled", true); }
}


if (document.getElementById('address2').type=='hidden')
  {$('#btx_input_address2').hide();}
else
{ 
  if (document.getElementById("address2").readOnly==true)
    {$('#btx_input_address2').attr("disabled", true); }
}


if (document.getElementById('city').type=='hidden')
  {$('#btx_input_city').hide();}
else
{ 
  if (document.getElementById("city").readOnly==true)
    {$('#btx_input_city').attr("disabled", true); }
}


if (document.getElementById('postal_code').type=='hidden')
  {$('#btx_input_postal_code').hide();}
else
{ 
  if (document.getElementById("postal_code").readOnly==true)
    {$('#btx_input_postal_code').attr("disabled", true); }
}


if (((document.getElementById('phone_number').type=='hidden') && (disable_alter_custphone!='Y')) || (disable_alter_custphone=='HIDE'))
  {$('#btx_input_phone_numberDISP').hide();}
else
{ 
  if ((document.getElementById("phone_number").readOnly==true) || (disable_alter_custphone=='Y') )
    {$('#btx_input_phone_numberDISP').attr("disabled", true); }
}


if (document.getElementById('alt_phone').type=='hidden')
  {$('#btx_input_alt_phone').hide();}
else
{ 
  if (document.getElementById("alt_phone").readOnly==true)
    {$('#btx_input_alt_phone').attr("disabled", true); }
}


if (document.getElementById('email').type=='hidden')
  {$('#btx_input_email').hide();}
else
{ 
  if (document.getElementById("email").readOnly==true)
    {$('#btx_input_email').attr("disabled", true); }
}


if (document.getElementById('vendor_lead_code').type=='hidden')
  {$('#btx_input_vendor_lead_code').hide();}
else
{ 
  if (document.getElementById("vendor_lead_code").readOnly==true)
    {$('#btx_input_vendor_lead_code').attr("disabled", true); }
}


if (document.getElementById('comments').type=='hidden')
  {$('#btx_input_comments').hide();
$('#btx_show_comments_button').hide();}
else
{ 
  if (document.getElementById("comments").readOnly==true)
    {$('#btx_input_comments').attr("disabled", true);
  $('#btx_show_comments_button').hide(); }
}


$( "#btx_CloserSelectBlended" ).on('change',function() {
  if ($("#btx_CloserSelectBlended").prop('checked')==true )
   {document.vicidial_form.CloserSelectBlended.checked=true;}
 else
   {document.vicidial_form.CloserSelectBlended.checked=false;}

});


if (document.vicidial_form.CloserSelectBlended.checked==true)
{

  $("#btx_CloserSelectBlended").prop('checked', true); 
}
else
{

  $("#btx_CloserSelectBlended").prop('checked', false); 
}




////////START OF TRANSFER OPTIONS////////////


$("#btx_transfer_restart_button").on("click", function(){
  $('#btx_transfer_extra_info').html('Please Select a Transfer Destination');
  $('.hide_transfers').hide();
  $('#btx_transfer_main').show();
});


///transfer to ingroup
$("#btx_transfer_to_ingroup").on("click", function(){
  $('#btx_transfer_ingroup_select').html(document.getElementById("XfeRGrouP").innerHTML);
  $('#btx_transfer_extra_info').html('Please Select a Transfer Queue From the Drop Down List');
  $('.hide_transfers').hide();
  $('#btx_transfer_group_stage_1').show();
});		

$("#btx_transfer_ingroup_select_confirm").on("click", function(){
  document.getElementById("XfeRGrouP").value = $('#btx_transfer_ingroup_select').val();
  document.vicidial_form.consultativexfer.checked = true;
  document.vicidial_form.xferoverride.checked = false;
  $('#btx_transfer_blind').attr('onClick', $('#LocalCloser').find('a').attr('onclick'));  
  transfer_where = $('#btx_transfer_ingroup_select').val();
  $('#btx_transfer_extra_info').html('Transfer to '+transfer_where);
  $('.hide_transfers').hide();
  $('#btx_transfer_stage_2').show();
});	
///transfer to ingroup

///transfer to number
$( "#btx_transfer_number" ).on('keypress change',function() {
  $('#btx_transfer_number').val($('#btx_transfer_number').val().replace(/[^0-9]+/g, ''));
  if ((($('#btx_transfer_number').val().length > 5) && $('#btx_transfer_number').val() != 'Phone Number'))
  {
    $("#btx_transfer_number_confirm").prop('disabled', false);
    $('#btx_transfer_blind').attr('onClick', $('#DialBlindTransfer').find('a').attr('onclick'));  
  }
  else
  {
    $("#btx_transfer_number_confirm").prop('disabled', true);
  }
});

$("#btx_transfer_to_num").on("click", function(){
  $('#btx_transfer_extra_info').html('Please Enter a Number to Dial');
  $('.hide_transfers').hide();
  $('#btx_transfer_num_stage_1').show();
});		

$("#btx_transfer_number_confirm").on("click", function(){

 transfer_where = $('#btx_transfer_number').val().replace(/^0+/, '');
 transfer_where = $('#btx_transfer_number_prefix').val() + transfer_where;
 document.vicidial_form.xfernumber.value= transfer_where;
 document.vicidial_form.consultativexfer.checked = false;
 document.vicidial_form.xferoverride.checked = true;
 $('#btx_transfer_extra_info').html('Transfer to '+transfer_where);
 $('.hide_transfers').hide();
 $('#btx_transfer_stage_2').show();
 $('#btx_transfer_blind').attr('onClick', $('#DialBlindTransfer').find('a').attr('onclick'));  
});	
///transfer to number

///transfer to preset
$("#btx_transfer_to_preset").on("click", function(){
  $('#btx_transfer_extra_info').html('Please Select a Transfer Destination');
  $('.hide_transfers').hide();
  find_preset_list();
  $('#btx_transfer_preset_stage_1').show();
});		


///transfer to preset
$("#btx_transfer_blind").on("click", function(){
  $('#btx_transfer_extra_info').html('Please Select a Transfer Destination');
  $('.hide_transfers').hide();
  $('#btx_transfer_main').show();
  ShoWTransferMain('OFF');
				///dispo call	
      });	


$("#btx_transfer_3way").on("click", function(){
  $('#btx_transfer_extra_info').html('3 Way Call Transfer to '+transfer_where+' in Progress');
  $('.hide_transfers').hide();
  $('#btx_transfer_grab_call').hide();
  $('#btx_transfer_restart_button').hide();
  SendManualDial('YES','YES');
  $(".hangup_and_show_dispo").not( "#btx_transfer_leave" ).prop('disabled', true);
  $('.transfer_final_controls').hide();
  $('#btx_transfer_stage_3').show();
});	

$("#btx_transfer_holdcall").on("click", function(){
  $('#btx_transfer_extra_info').html('Client Hold Transfer to '+transfer_where+' in Progress');
  $('.hide_transfers').hide();
  $('#btx_transfer_restart_button').hide();
  $('#btx_transfer_grab_call').show();
  $(".hangup_and_show_dispo").not( "#btx_transfer_leave" ).prop('disabled', true);
  $('.transfer_final_controls').hide();
  xfer_park_dial('YES');
  $('#btx_transfer_grab_call').attr('onClick', $('#ParkControl').find('a').attr('onclick'));
  $('#btx_transfer_stage_3').show();
});	


$("#btx_transfer_leave").on("click", function(){
  $('#btx_transfer_extra_info').html('Please Select a Transfer Destination');
  $('.hide_transfers').hide();
  $('#btx_transfer_main').show();
  leave_3way_call('FIRST','YES');
  ShoWTransferMain('OFF');

});	

$("#btx_transfer_hangup").on("click", function(){
  $('#btx_transfer_restart_button').show();
  $(".hangup_and_show_dispo").not( "#btx_transfer_leave" ).prop('disabled', false);
  xfercall_send_hangup('YES');
  document.vicidial_form.xfernumber.value= transfer_where;
  $('#btx_transfer_extra_info').html('Transfer to '+transfer_where);
  $('.hide_transfers').hide();
  if ($('#btx_transfer_extra_info').html().includes('Preset') == true)
  {
    $('#btx_transfer_preset_stage_1').show();
    $('#btx_transfer_extra_info').html('Please Select a Transfer Destination');
  }
  else
  {
    $('#btx_transfer_stage_2').show();  
  }

});	


$("#btx_transfer_grab_call").on("click", function(){
  $('#btx_transfer_grab_call').hide();

});	

$("#btx_transfer_go_back").on("click", function(){
  $('#btx_transfer_restart_button').show();
  $(".hangup_and_show_dispo").not( "#btx_transfer_leave" ).prop('disabled', false);

  $('#btx_transfer_extra_info').html('Transfer to '+transfer_where);
  $('.hide_transfers').hide();
  if ($('#btx_transfer_extra_info').html().includes('Preset') == true)
  {
    $('#btx_transfer_preset_stage_1').show();
    $('#btx_transfer_extra_info').html('Please Select a Transfer Destination');
  }
  else
  {
    $('#btx_transfer_stage_2').show();  
  }				
});	

		//////////////////////////////////////////////////////////////////////////////////////
		////////////////////// - START Get Form Data From Old Interface - ////////////////////
		//////////////////////////////////////////////////////////////////////////////////////

		///ONLY RUN ONCE 

		form_check = 1;
		
		function update_form_first_time(){

			if ( $("#vcFormIFrame").attr("src") != './vdc_form_display.php?lead_id=&list_id=&stage=WELCOME')
			{
				$("#vcFormIFrame").appendTo("#btx-form .card-body");
				$("#vcFormIFrame").css("width", "100%");
        $('#btx-form iframe').css('height','500px');
        form_check = 0;
      }
    }




		//////////////////////////////////////////////////////////////////////////////////////
		/////////////////////// - END Get Form Data From Old Interface - /////////////////////
		//////////////////////////////////////////////////////////////////////////////////////







		// get the number of columns that need to be build for the dispo or pause or any other screen using this function
		function btx_get_columns(count, id){
			// check the count and based on it decide which class to assign to the dispo content for the width
			// from 0 to 20
			if(count > 0 && count < 15){
				$(id).addClass("dispos_0_14");
			}
			// from 15 to 30
			if(count > 14 && count < 31){
				$(id).addClass("dispos_15_30");
			}
			// from 31 to 89 - after 89 it is very hard to represent dispos because of the viewable area, unless the dispos are two tiered
			if(count > 30){
				$(id).addClass("dispos_31_89");
			}

			var myArray = [];
			if(count > 20){
				
				var result = Math.floor(count/1);
				var i = 1;
				while(result>9){
					i++;
					result = Math.floor(count/i);
				}
				for(var x=0; x<i; x++){
					myArray[x] = result;
				}
				var left_over = count - (i*result);
				for(var y=0; y<left_over; y++){
					myArray[y]+=1;
				}
			}
			if(count <= 20){
				var result = Math.floor(count/1);
				var i = 1;
				while(result>4){
					i++;
					result = Math.floor(count/i);
				}
				for(var x=0; x<i; x++){
					myArray[x] = result;
				}
				var left_over = count - (i*result);
				for(var y=0; y<left_over; y++){
					myArray[y]+=1;
				}
			}
			return myArray;
		}
		
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		// - START: Get Interface Settings from the CSV settings file and disable or enable interface functionality - //
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		// in order for the function below to work properly, we need to add a data attribute to each element we like to control
		// with the settings file. The data attribute should have a name that is the same as the setting, for example if we have a setting
		// btx_gmaps_weather, then we name the data: data-setting='btx_gmaps_weather', this way we can run only one loop and change all settings that need to be changed.
		function btx_update_settings(){
			$.ajax({
				url: "bluetelecoms/btx_settings_csv.php",
				type: "get",
				data: { get_screen_update : "true" },
				success: function(response) {
					//Do Something
					response = JSON.parse(response);

					$.each(response, function(i, item){
						// item[0] will return the name of the setting
						// item[1] will return "on" or "off"
						// set a variable for true or false
            if (item[0] == 'btx_ringing_control')
            {
              if (item[1] == 'on')
              {
                inboundringing='YES';
              }
            }
            else if (item[0] == 'btx_extend_callback_display')
            {
              if (item[1] == 'on')
              {
                btx_extend_callback_display='YES';
              }
            }
            else
            {
						  var true_or_false = '';
						  if(item[1] == "on"){
							 true_or_false = false;
						  } else {
							true_or_false = true;
							// to remove an element use the code below
							$("body").find("[data-setting='"+item[0]+"']").remove();
						}
            }
						// to disable an element use the code below
						//$("body").find("[data-setting='"+item[0]+"']").prop('disabled', true_or_false);
					});
				},
				error: function(xhr) {
					// Do Something to handle error
					////////console.log(xhr);
				}
			});
		}

var btx_to_expand_or_not = 0;

		function btx_update_names(){
			$.ajax({
				url: "bluetelecoms/btx_settings_csv.php",
				type: "get",
				data: { get_screen_names_update : "true" },
				success: function(response) {
					//Do Something
					response = JSON.parse(response);

					////////console.log(response);

					$.each(response, function(i, item){
						// item[0] will return the id of the element
						// item[1] will return the new name of the element

            if (item[0] == 'btx_expandscript_input')
            {
              if (item[1]=='Yes')
              {
                btx_to_expand_or_not = 1;
              }
              else
              {
               btx_to_expand_or_not = 0; 
              }
            }
            else if (item[0] != 'btx_logo_address_input') 
						{
							var data_element_name = item[0].slice(0,-6);
							
							
							item[1] = item[1].replace("--A--user--B--", user);
							item[1] = item[1].replace("--A--user_group--B--", VU_user_group);
							item[1] = item[1].replace("--A--campaign--B--", campaign);


							$("body").find("[data-setname='"+data_element_name+"']").html(item[1]);
							if ((item[1] =='') || (item[1] ==' '))
							{
								$("body").find("[data-setname='"+data_element_name+"']").parent().hide();
							}
						}
						else
						{
							$('#licensee-logo').attr("src",item[1]);
						}

					});
				},
				error: function(xhr) {
					// Do Something to handle error
					////////console.log(xhr);
				}
			});
		}

		btx_update_settings();
		btx_update_names();
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		/// - END: Get Interface Settings from the CSV settings file and disable or enable interface functionality - ///
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		//////////////////////////////////////////////////////////////////////////////////////
		//////////////////////// - START: Remove Buttons when not paused - ///////////////////
		//////////////////////////////////////////////////////////////////////////////////////
		
		function DisableorHideWhenNotPaused(_is_paused){
			if (_is_paused == 'Paused')
      {
        $('.HideWhenNotPaused').show();
        $('.DisableWhenNotPaused').prop("disabled", false);
      }
      else
      {
        $('.HideWhenNotPaused').hide();
        $('.DisableWhenNotPaused').prop("disabled", true);
          if ( (inOUT=='IN') && ( (agent_lead_search=='LIVE_CALL_INBOUND') || (agent_lead_search=='LIVE_CALL_INBOUND_AND_MANUAL') ) )
          {
            $('#viewSearch').prop("disabled", false);
          }
      }
      if ($('#ManuaLDiaLButtons').css('visibility') =='hidden'){$('#viewDial').hide();$("#btx_input_MDPhonENumbeR").prop("readonly", true);$("#MDDiaLCodE_prefix").prop("readonly", true);}
    }


		//////////////////////////////////////////////////////////////////////////////////////
		////////////////////////// - END: Remove Buttons when not paused - ///////////////////
		//////////////////////////////////////////////////////////////////////////////////////


		//////////////////////////////////////////////////////////////////////////////////////
		//////////////////////// - START: Remove Buttons when not incall - ///////////////////
		//////////////////////////////////////////////////////////////////////////////////////
		
		function DisableorHideWhenNotInCall(_is_incall){
			if (_is_incall == 'Incall')
      {
        $('.DisableWhenNotInCall').prop("disabled", false);

        $('.HideWhenNotInCall').show();
        if (scheduled_callbacks != '1'){$('.viewcallback_diary').hide();}
      }
      else
      {
        $('.DisableWhenNotInCall').prop("disabled", true);
        $('.HideWhenNotInCall').hide();
      }
    }


		//////////////////////////////////////////////////////////////////////////////////////
		////////////////////////// - END: Remove Buttons when not paused - ///////////////////
		//////////////////////////////////////////////////////////////////////////////////////

		//////////////////////////////////////////////////////////////////////////////////////
		////////////////////////// - START: Weather Info Integration - ///////////////////////
		//////////////////////////////////////////////////////////////////////////////////////
		// get the city, either from the postode or the city name from the form
		function btx_get_weather(){
      $("#btx_weather_info").html('');
			// a variable for the weather api url call
			var btx_weather_api_url = "";

      if (document.vicidial_form.MDDiaLCodE.value=='1')
      {
      
                var btx_city_weather = $("#btx_input_city").val()+',US';
        //btx_weather_api_url += "http://api.openweathermap.org/data/2.5/weather?q="+btx_city_weather+"APPID=3c8fb1fc2b345b9b93ac2dd01541cfc2";
        ////////console.log(btx_weather_api_url);
        // run a an ajax to get the weather data
        $.ajax({
          url: "bluetelecoms/get_weather_api.php",
          type: "get", //send it through get method
          data: { city : btx_city_weather },
          success: function(response) {
            //Do Something
            response = JSON.parse(response);
            ////////console.log(response);
            // link to the icon for the current weather
            var weather_icon = '<img width="40%" height="40%" src="https://openweathermap.org/img/w/'+response.weather[0].icon+'.png">';

            // variable for the current weather temp
            var current_temp = response.main.temp;
            // create the full html code for the weather section
            var html_weather = "<b>"+current_temp+"&#x2103;</b> " + weather_icon;
            // place the temp and the icon on top of google maps
            $("#btx_weather_info").html(html_weather);
          },
          error: function(xhr) {
            $("#btx_weather_info").html('');
            // Do Something to handle error
            ////////console.log(xhr);
          }
        });
      }
      else
			if($("#btx_input_postal_code").val()){
				////////console.log("weather by postcode");
				// strip the postcode of any whitespaces
				postcode = $("#btx_input_postal_code").val().replace(/\s/g,'');
				var api_url = "https://api.postcodes.io/postcodes/"+postcode;
				// create two variables one for lat and one for long
				var btx_lat = "";
				var btx_long = "";
				$.get(api_url, function(data, status){
					////////console.log(data);
					btx_lat = data.result.latitude;
					btx_long = data.result.longitude;

					btx_weather_api_url += btx_lat+"/"+btx_long;
					////////console.log("whaaat " + btx_weather_api_url);
					$.ajax({
						url: "bluetelecoms/get_weather_api.php",
						type: "get", //send it through get method
						data: { lat : btx_lat, long : btx_long },
						success: function(response) {
							//Do Something
							response = JSON.parse(response);
							////////console.log(response);
							// link to the icon for the current weather
							var weather_icon = '<img width="40%" height="40%" src="https://openweathermap.org/img/w/'+response.weather[0].icon+'.png">';
							// variable for the current weather temp
							var current_temp = response.main.temp;
							// create the full html code for the weather section
							var html_weather = "<b>"+current_temp+"&#x2103;</b> " + weather_icon;
							////////console.log(html_weather);
							// place the temperature and the current weather icon on top of google maps
							$("#btx_weather_info").html(html_weather);
						},
						error: function(xhr) {
              $("#btx_weather_info").html('');
							// Do Something to handle error
							////////console.log(xhr);
						}
					});
				});
			}
			else if($("#btx_input_city").val()){
				////////console.log("weather by city");
				var btx_city_weather = $("#btx_input_city").val()+',UK';
				//btx_weather_api_url += "http://api.openweathermap.org/data/2.5/weather?q="+btx_city_weather+"APPID=3c8fb1fc2b345b9b93ac2dd01541cfc2";
				////////console.log(btx_weather_api_url);
				// run a an ajax to get the weather data
				$.ajax({
					url: "bluetelecoms/get_weather_api.php",
					type: "get", //send it through get method
					data: { city : btx_city_weather },
					success: function(response) {
						//Do Something
						response = JSON.parse(response);
						////////console.log(response);
						// link to the icon for the current weather
						var weather_icon = '<img width="40%" height="40%" src="https://openweathermap.org/img/w/'+response.weather[0].icon+'.png">';

						// variable for the current weather temp
						var current_temp = response.main.temp;
						// create the full html code for the weather section
						var html_weather = "<b>"+current_temp+"&#x2103;</b> " + weather_icon;
						// place the temp and the icon on top of google maps
						$("#btx_weather_info").html(html_weather);
					},
					error: function(xhr) {
            $("#btx_weather_info").html('');
						// Do Something to handle error
						////////console.log(xhr);
					}
				});
			}
		}
		//////////////////////////////////////////////////////////////////////////////////////
		/////////////////////////// - END: Weather Info Integration - ////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////

		//////////////////////////////////////////////////////////////////////////////////////
		////////////////////////// - START: Google Maps Integration - ////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////
		// get lat long from postcode using postcodes.io api - Use this onyl if we've got the postcode from vicidial
		function btx_create_map_postcode(postcode){
			// strip the postcode of any whitespaces
			postcode = postcode.replace(/\s/g,'');
			var api_url = "https://api.postcodes.io/postcodes/"+postcode;
			// create two variables one for lat and one for long
			var btx_lat = "";
			var btx_long = "";
			// create a var for the map iFrame
			var btx_map_iframe = '';
			$.get(api_url, function(data, status){

				btx_lat = data.result.latitude;
				btx_long = data.result.longitude;
				// generate the iFrame with the map lat and long locations
				btx_map_iframe = '<iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCi3WoyO9hAHxyODl9tA3cuHRvS1CH-klE&q='+btx_lat+','+btx_long+'&zoom=17" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>';
				// place the iFrame in the #btx_google_map div
				$("#btx_google_map").html(btx_map_iframe);

				////////console.log(data.result.latitude + " " + data.result.longitude);
			});
		}

		// check if postcode has loaded in the new interface form and if yes then run the btx_create_map_postcode
		function old_btx_built_google_maps(){
			// check for postcode first, if no postcode then check the rest of address
			if($("#btx_input_postal_code").val()){
				btx_create_map_postcode($("#btx_input_postal_code").val());
			} else {
				// set variable for the address string
				var btx_address = "";
				// set a varibale for the google map iFrame
				var btx_map_iframe = "";
				// check the rest of address, start with town
				if($("#btx_input_city").val()){
					// now check for addresss 1 and 2
					// if there is an address 1 add it to the address string
					if($("#btx_input_address1").val()){
						btx_address += $("#btx_input_address1").val();
					}
					if($("#btx_input_address2").val()){
						btx_address += ", "+$("#btx_input_address2").val();
					}
					btx_address += $("#btx_input_city").val();
					// create the iFrame and insert it into the container
					btx_map_iframe = '<iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCi3WoyO9hAHxyODl9tA3cuHRvS1CH-klE&q='+btx_address+'&zoom=17" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>';
					// place the iFrame in the #btx_google_map div
					$("#btx_google_map").html(btx_map_iframe);
				} else {
					// if no town, then just the whole of UK
					////////console.log("not enough address info to show a location on map!");
				}
			}
		}

    // check if postcode has loaded in the new interface form and if yes then run the btx_create_map_postcode
    function btx_built_google_maps(){
      // check for postcode first, if no postcode then check the rest of address

        // set variable for the address string
        var btx_address = "";
        // set a varibale for the google map iFrame
        var btx_map_iframe = "";
        // check the rest of address, start with town
        
          // now check for addresss 1 and 2
          // if there is an address 1 add it to the address string
          if($("#btx_input_address1").val()){
            btx_address += $("#btx_input_address1").val();
          }
          if($("#btx_input_address2").val()){
            btx_address += ", "+$("#btx_input_address2").val();
          }
          if($("#btx_input_city").val()){
            btx_address += ", "+$("#btx_input_city").val();
          }
          if($("#btx_input_postal_code").val()){
            btx_address += ", "+$("#btx_input_postal_code").val();
          }

          // create the iFrame and insert it into the container
          btx_map_iframe = '<iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCi3WoyO9hAHxyODl9tA3cuHRvS1CH-klE&q='+btx_address+'&zoom=17" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>';
          if (btx_address ==''){btx_map_iframe = 'No address to display'}

          // place the iFrame in the #btx_google_map div
          $("#btx_google_map").html(btx_map_iframe);

      
    }
		
		// on click of view map button open the map and load the weather. this button canbe disabled if the flag for disable api's is on
		$("#viewMap").on("click", function(){
			btx_built_google_maps();
			btx_get_weather();
		});
		//////////////////////////////////////////////////////////////////////////////////////
		/////////////////////////// - END: Google Maps Integration - /////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////

		//////////////////////////////////////////////////////////////////////////////////////
		/////////////// - START: TextArea Double Click and Count Characters - ////////////////
		//////////////////////////////////////////////////////////////////////////////////////
		$("#btx_input_comments").dblclick(function(){
			$(this).attr("readonly", false);
		});

		// if user clicks anywhere else on the screen, make the textarea readonly again
		$(document).mouseup(function(e) 
		{
			var container = $("#btx_input_comments");
			// if the target of the click isn't the container nor a descendant of the container
			if (!container.is(e.target) && container.has(e.target).length === 0) 
			{
				$(container).attr("readonly", true);
			}
		});

		$("#btx_input_comments").keyup(function(){
			$("#btx_count_chars_comments").text($(this).val().length);
		});
		//////////////////////////////////////////////////////////////////////////////////////
		//////////////// - END: TextArea Double Click and Count Characters - /////////////////
		//////////////////////////////////////////////////////////////////////////////////////

		//////////////////////////////////////////////////////////////////////////////////////
		/////////////////////// - START: Agent Status and Handler - //////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////
		function formatSeconds(seconds)
		{
      var date = new Date(1970,0,1);
      date.setSeconds(seconds);
      return date.toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");
    }

		// hide all status buttons initialy
		$(".btx_agent_status_buttons").hide();

		// set a global variable that will remember the last dispo chosen by agent and append it to the Paused button
		var btx_last_pause_chosen = "Paused";
		// variable to keep the time for the pause timer
		var btx_pause_timer_counter = 0;
		var btx_dispo_timer_counter = 0;

		if (custom_fields_enabled < 1)
   {
    $('#viewForm').hide();
   
    $('#dispohidebutton').attr('onClick', "$('.hangup_again_button').show();$('.hangup_button').hide();hideDiv('DispoSelectBox');$('#modal-outcome').modal('hide');");
    $('.hangup_again_button').attr('onClick',"$('.hangup_again_button').hide();CustomerData_update();showDiv('DispoSelectBox');");
  }
  else
  {
   
    $('#dispohidebutton').attr('onClick', "$('.hangup_again_button').show();$('.hangup_button').hide();javascript:history.back();hideDiv('DispoSelectBox');$('#modal-outcome').modal('hide');");
    $('.hangup_again_button').attr('onClick',"$('.hangup_again_button').hide();CustomerData_update();document.getElementById('vcFormIFrame').contentDocument.form_custom_fields.submit();showDiv('DispoSelectBox');");
  }



//console.log('Prev_status: '+ prev_status );



$(".btx_pause_button").hide();
//$("#start_button").hide();




if (document.getElementById("RecorDControl").innerHTML.includes('vdc_LB_startrecording_OFF.gif')) {$('#btx_RecorDControl').hide();}
else if ($('#RecorDControl').find('img').attr('alt') == 'Start Recording')
{
  $('#btx_RecorDControl').addClass('btn-outline-success');
  $('#btx_RecorDControl').removeClass('btn-outline-danger');
  $('#btx_RecorDControl').html('<i class="fas fa-microphone"></i>&nbsp;Start Record');
  $('#btx_RecorDControl').attr('onClick', $('#RecorDControl').find('a').attr('onclick'));
}
else if ($('#RecorDControl').find('img').attr('alt') == 'Stop Recording')
{
	$('#btx_RecorDControl').removeClass('btn-outline-success');
	$('#btx_RecorDControl').addClass('btn-outline-danger');
	$('#btx_RecorDControl').html('<i class="fas fa-microphone-slash"></i>&nbsp;Stop Record');
	$('#btx_RecorDControl').attr('onClick', $('#RecorDControl').find('a').attr('onclick'));
}

$('#btx_RecorDControl').on('click',function(){

  if ($('#RecorDControl').find('img').attr('alt') == 'Start Recording')
  {	
    $('#btx_RecorDControl').addClass('btn-outline-success');
    $('#btx_RecorDControl').removeClass('btn-outline-danger');
    $('#btx_RecorDControl').html('<i class="fas fa-microphone"></i>&nbsp;Start Record');
    $('#btx_RecorDControl').attr('onClick', $('#RecorDControl').find('a').attr('onclick'));
  }
  else if ($('#RecorDControl').find('img').attr('alt') == 'Stop Recording')
  {
    $('#btx_RecorDControl').removeClass('btn-outline-success');
    $('#btx_RecorDControl').addClass('btn-outline-danger');
    $('#btx_RecorDControl').html('<i class="fas fa-microphone-slash"></i>&nbsp;Stop Record');
    $('#btx_RecorDControl').attr('onClick', $('#RecorDControl').find('a').attr('onclick'));
  }

});







btx_reduce_script_section();
$(".stuff").addClass('hidden');
$('#btx-leads').hide();
$("#btx-company").removeClass('hidden');
////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////LOOP SECTION THAT HANDLES STATUS AND POPUPS/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////

setInterval(function(){

  hideDiv('CalLLoGDisplaYBox');hideDiv('LeaDInfOBox');hideDiv('CallBacKsLisTBox');$('#NeWManuaLDiaLBox').hide();

  if (btx_logged_in_flag == 1)
  {
    $('#loadingscreen').hide();		
  }

//console.log('%%%%%% CURRENT CONTENT :' + document.getElementById("callchannel").innerHTML + ' %%%%%%%%')

if (chat_enabled == 1)

{
  $('#btx-internal_chat_button').show();
  if ($('#Tabs').html().includes('vdc_tab_chat_internal.gif')==true)
  {
    $('#btx-internal_chat_button').addClass('btn-outline-secondary').removeClass('btn-light').removeClass('btn-warning');
  }
  else if ($('#Tabs').html().includes('vdc_tab_chat_internal_red.gif')==true)
  {
    $('#btx-internal_chat_button').removeClass('btn-outline-secondary').addClass('btn-light').removeClass('btn-warning');
  }
  else if ($('#Tabs').html().includes('vdc_tab_chat_internal_blink.gif')==true)
  {
    $('#btx-internal_chat_button').removeClass('btn-outline-secondary').removeClass('btn-light').addClass('btn-warning');
  }
  else
  {
    $('#btx-internal_chat_button').hide();
  }
}


//if (document.getElementById("ReQueueCall").innerHTML.includes('vdc_LB_requeue_call.gif'))
//{
//$('#requeue_call_button').show();
//}
//else
//{	
//$('#requeue_call_button').hide();	
 //}	

 if ((getParameterByName('logged-out') != "yes") && (btx_logged_in_flag == 1)){


//if (($('#dragPopup_volumecontrol').css('visibility') == 'visible') && (($('#agentVOLup').html()=='') || ($('#clientVOLup').html()=='')))
//{
//volumecontrol_btx();
//} 

  if (document.getElementById("WebFormSpan").innerHTML.includes('vdc_LB_webform.gif'))
  {
    $("#btx_api_button_1").removeClass("disabled");
  }
  else
  {
    $("#btx_api_button_1").addClass("disabled");
  }

  if (document.getElementById("WebFormSpanTwo").innerHTML.includes('vdc_LB_webform_two.gif'))
  {
    $("#btx_api_button_2").removeClass("disabled");
  }
  else
  {
    $("#btx_api_button_2").addClass("disabled");
  }




  if ((scheduled_callbacks_alert == 'NONE') || (scheduled_callbacks_alert == 'RED_DEFER') && (!$('#CBstatusSpan').html().includes('<font color="red">')))
  { 
  $('#btx_callback_count_display').hide();
  $('#viewLeads').removeClass('btn-danger');
  $('#viewLeads').removeClass('flash-button');
  $('#viewLeads').addClass('btn-white');

  }
  else
  {
   $('#btx_callback_count_display').show();
   var current_callback_counter = $('#CBstatusSpan').text().split(" "); 
   $('#btx_callback_count_display').html(current_callback_counter[0]);
   if (current_callback_counter[0] !='NO')
    {$('#btx_callback_count_display').show();}
   else
    {$('#btx_callback_count_display').hide();}

   if($('#CBstatusSpan').html().includes('<span class="blink"><b><font color="red">'))
    {
      $('#viewLeads').addClass('flash-button');   
    }
    else if($('#CBstatusSpan').html().includes('<span class="blink">'))
    {
      $('#viewLeads').removeClass('btn-white');   
      $('#viewLeads').addClass('btn-danger');      
    }
  else
  {
     $('#viewLeads').addClass('btn-white');   
   $('#viewLeads').removeClass('btn-danger');
   $('#viewLeads').removeClass('flash-button');   
  }

 }

 

if ((document.getElementById("ParkCustomerDial").innerHTML.includes("vdc_XB_parkcustomerdial_OFF.gif")) && (document.getElementById("DialWithCustomer").innerHTML.includes("vdc_XB_dialwithcustomer_OFF.gif")) && (document.getElementById("HangupXferLine").innerHTML.includes("vdc_XB_hangupxferline_OFF.gif")))
{
 $('#btx_transfer_leave').hide();
 $('#btx_transfer_hangup').hide();
 $('#btx_transfer_go_back').hide();
 if ((document.images['livecall'].src.includes('agc_live_call_DEAD.gif')) && (AgentDispoing == 0))
 {
   $(".hangup_and_show_dispo").not( "#btx_transfer_leave" ).prop('disabled', false);
 }
 else
 {
   $(".hangup_and_show_dispo").not( "#btx_transfer_leave" ).prop('disabled', true);
 }
}
else if 
  ((document.getElementById("ParkCustomerDial").innerHTML.includes("vdc_XB_parkcustomerdial.gif")) && (document.getElementById("DialWithCustomer").innerHTML.includes("vdc_XB_dialwithcustomer.gif")) && (document.getElementById("HangupXferLine").innerHTML.includes("vdc_XB_hangupxferline_OFF.gif")))

{
  $('#btx_transfer_leave').hide();
  $('#btx_transfer_hangup').hide();
  $('#btx_transfer_go_back').show();
  $(".hangup_and_show_dispo").not( "#btx_transfer_leave" ).prop('disabled', false);


}
else if ((document.getElementById("ParkCustomerDial").innerHTML.includes("vdc_XB_parkcustomerdial_OFF.gif")) && (document.getElementById("DialWithCustomer").innerHTML.includes("vdc_XB_dialwithcustomer_OFF.gif")) && (document.getElementById("HangupXferLine").innerHTML.includes("vdc_XB_hangupxferline.gif")))
{
 $('#btx_transfer_leave').show();
 $('#btx_transfer_hangup').show();
 $('#btx_transfer_go_back').hide();
 if ((document.images['livecall'].src.includes('agc_live_call_DEAD.gif')) && (AgentDispoing == 0))
 {
 	$(".hangup_and_show_dispo").not( "#btx_transfer_leave" ).prop('disabled', false);
 }
 else
 {
   $(".hangup_and_show_dispo").not( "#btx_transfer_leave" ).prop('disabled', true);
 }
}



if (document.getElementById("DiaLLeaDPrevieW").innerHTML.includes('checkbox') && ((dial_method == "INBOUND_MAN") || (dial_method == "MANUAL")))
{
  $('#btx_DiaLLeaDPrevieW123_section').show();
  if (document.vicidial_form.LeadPreview.checked==true)
  {
   $("#btx_DiaLLeaDPrevieW123").prop('checked', true);	

 }
 else
 {
  $("#btx_DiaLLeaDPrevieW123").prop('checked', false);	
}
}
else
{
	$('#btx_DiaLLeaDPrevieW123_section').hide();
}



if (document.getElementById("DiaLDiaLAltPhonE").innerHTML.includes('checkbox'))
{
  $('#btx_DiaLDiaLAltPhonE123_section').show();
  if (document.vicidial_form.DiaLAltPhonE.checked==true)
  {
    $("#btx_DiaLDiaLAltPhonE123").prop('checked', true);	
  }
  else
  {
    $("#btx_DiaLDiaLAltPhonE123").prop('checked', false);
  }
}
else
{
	$('#btx_DiaLDiaLAltPhonE123_section').hide();
}









if (document.getElementById("DiaLControl").innerHTML.includes('vdc_LB_active.gif'))
{
  if ($(".btx_pause_button").is(":hidden"))
  {
   $('.btx_pause_button').show();
 }
} 
else 
{
  if ($(".btx_pause_button").is(":visible"))
  {
   $('.btx_pause_button').hide();
 }
} 


if ((document.getElementById("DiaLControl").innerHTML.includes('vdc_LB_dialnextnumber.gif')) && (AgentDispoing == 0) && (!document.images['livecall'].src.includes('agc_live_call_ON.gif')) && hide_dial_next_button == 0)
{
  if ($(".btx_dial_next_button123").is(":hidden"))
  {
   $('.btx_dial_next_button123').show();
 }
} 
else 
{
  if ($(".btx_dial_next_button123").is(":visible"))
  {
   $('.btx_dial_next_button123').hide();
 }
}


if (document.getElementById("DiaLControl").innerHTML.includes('vdc_LB_paused.gif'))
{
  if ($(".btx_start_button").is(":hidden"))
  {

   $('.btx_start_button').show();
 }
} 
else 
{
  if ($(".btx_start_button").is(":visible"))
  {
   $('.btx_start_button').hide();
 }
} 	

if (document.getElementById("HangupControl").innerHTML.includes('vdc_LB_hangupcustomer.gif'))
{
  if ($(".hangup_and_show_dispo").is(":hidden"))
  {

   $('.hangup_and_show_dispo').not( "#btx_transfer_leave" ).show();
 }
} 
else 
{
  if ($(".hangup_and_show_dispo").is(":visible"))
  {
   $('.hangup_and_show_dispo').not( "#btx_transfer_leave" ).hide();
 }
} 



//////console.log(document.getElementById("DiaLControl").innerHTML);



if ((manual_dial_search_checkbox != 'SELECTED_LOCK') && (manual_dial_search_checkbox != 'UNSELECTED_LOCK'))
{

 if (document.vicidial_form.LeadLookuP.checked==true)  {$("#btx_LeadLookuP").prop('checked', true);}
 else
   {$("#btx_LeadLookuP").prop('checked', false);}

}


if (in_lead_preview_state == 1) 
{

	DisableorHideWhenNotPaused('hide');
  DisableorHideWhenNotInCall('hide');
  $(".btx_agent_status_buttons").hide();
  $("#btx_agent_is_preview_button").show();
  $('.btx_DIAL_LEAD').attr('onClick', "ManualDialOnly('"+document.getElementById('manual_dial_only_type_flag')+"','YES')");
  $('.mandialskipprev').show();
  $('.btx_call_control_buttons').hide();
  $('#btx_RecorDControl_div').hide();
  $('.ParkControl123').hide();
  $('.btx_dial_next_button123').hide(); 
  $('.btx_start_button').hide(); 
  $('.btx_pause_button').hide();

  get_call_launch_function();



  if ((manual_preview_dial == 'PREVIEW_ONLY') || (manual_dial_in_progress == 1))

  {
    $('.btx_SKIP_LEAD').hide();
  }
  else
  {
    $('.btx_SKIP_LEAD').show();
  }
  if ((alt_phone_dialing == 1) && ($('#btx_input_alt_phone').val() !='') && ($('#btx_input_alt_phone').val() !='Alt. Phone'))
  {
    $('.btx_DIAL_ALT').show();
  }
  else
  {
    $('.btx_DIAL_ALT').hide();
  }

}
else
{
	$('.mandialskipprev').hide();
	$('.btx_call_control_buttons').show();
  $('#btx_RecorDControl_div').show();
  $('.ParkControl123').show();
}



if (document.getElementById("ParkControl").innerHTML.includes('./images/vdc_LB_grabparkedcall.gif'))
  {	$('.ParkControl123').show();
$('.ParkControl123_button').prop('disabled', false);
$('.btx_ParkControl123_button').show();
$('.btx_ParkControl123_button').html('<i class="far fa-hand-rock"></i>&nbsp;Grab');
$('.btx_ParkControl123_button').attr('onClick', $('#ParkControl').find('a').attr('onclick'));
if ((document.images['livecall'].src.includes('agc_live_call_DEAD.gif')) && (AgentDispoing == 0)){$('.hangup_button').prop('disabled', false);} else {$('.hangup_button').prop('disabled', true);}

}
else if (document.getElementById("ParkControl").innerHTML.includes('./images/vdc_LB_parkcall.gif')) 
  {	$('.ParkControl123').show();
$('.ParkControl123_button').prop('disabled', false);
$('.btx_ParkControl123_button').show();
$('.btx_ParkControl123_button').html('<i class="fas fa-music"></i>&nbsp;Park');
$('.btx_ParkControl123_button').attr('onClick', $('#ParkControl').find('a').attr('onclick'));
$('.hangup_button').prop('disabled', false);
}
else
{
$('.ParkControl123').show();
$('.ParkControl123_button').prop('disabled', true);
$('.btx_ParkControl123_button').show();
$('.btx_ParkControl123_button').html('<i class="fas fa-music"></i>&nbsp;Park');

}







if (document.getElementById("RecorDControl").innerHTML.includes('vdc_LB_startrecording_OFF.gif')) {$('#btx_RecorDControl').hide();}
else if ($('#RecorDControl').find('img').attr('alt') == 'Start Recording')
{	
  $('#btx_RecorDControl').addClass('btn-outline-success');
  $('#btx_RecorDControl').removeClass('btn-outline-danger');
  $('#btx_RecorDControl').html('<i class="fas fa-microphone"></i>&nbsp;Start Record');
  $('#btx_RecorDControl').attr('onClick', $('#RecorDControl').find('a').attr('onclick'));
}
else if ($('#RecorDControl').find('img').attr('alt') == 'Stop Recording')
{
  $('#btx_RecorDControl').removeClass('btn-outline-success');
  $('#btx_RecorDControl').addClass('btn-outline-danger');
  $('#btx_RecorDControl').html('<i class="fas fa-microphone-slash"></i>&nbsp;Stop Record');
  $('#btx_RecorDControl').attr('onClick', $('#RecorDControl').find('a').attr('onclick'));
}

if ($('#CBcommentsBox').css('visibility') == 'visible') 
{
  ///ignore the word drag its from the old div
  var drag_popup_content =  "<small><b><?php echo _QXZ("Last Call:"); ?> </b>" + CBentry_time;
  drag_popup_content += "<b><?php echo _QXZ("&nbsp;&nbsp;CallBack:"); ?> </b>" + CBcallback_time;
  drag_popup_content += "<b><?php echo _QXZ("&nbsp;&nbsp;Agent:"); ?> </b>" + CBuser;
  drag_popup_content += "</small></br><b><?php echo _QXZ("Notes:"); ?> </b>" + CBcomments.substring(2);
  $('#callbacknotesbody').html(drag_popup_content);

   $('#prevous_callback_notes').show();$('#comments_area_information').hide();
}
else
{
  $('#prevous_callback_notes').hide();$('#comments_area_information').show();

}

////////console.log("PREV STATUS: "+ prev_status);
if ($('#SCForceDialSpan').css('visibility') == 'visible')
{

  $('#btx_callback_time').html($("#SCForceDialSpan td:contains('Callback Trigger Time:')").next('td').text());
  $('#btx_callback_set_time').html($("#SCForceDialSpan td:contains('Callback Entry Time')").next('td').text());




  var callbackpriorityblob = 'text-warning';
  if ($("#SCForceDialSpan td:contains('Callback Comments:')").next('td').text().charAt(1) == '>') 
  {
    if ($("#SCForceDialSpan td:contains('Callback Comments:')").next('td').text().charAt(0) == '1') {var callbackpriorityblob = 'text-success';}
    if ($("#SCForceDialSpan td:contains('Callback Comments:')").next('td').text().charAt(0) == '3') {var callbackpriorityblob = 'text-danger';}

    $('#btx_callback_comments').html($("#SCForceDialSpan td:contains('Callback Comments:')").next('td').text().substring(2));
  }
  else
  {
    $('#btx_callback_comments').html($("#SCForceDialSpan td:contains('Callback Comments:')").next('td').text()); 
  }

  $('#btx_callback_priority').html("<i class='fas fa-dot-circle "+callbackpriorityblob+" \'></i>");


  $('#btx_callback_client_name').html($("#SCForceDialSpan td:contains('Title:')").next('td').text()+' '+$("#SCForceDialSpan td:contains('First:')").next('td').text()+' '+$("#SCForceDialSpan td:contains('Last :')").next('td').text());
  $('#btx_callback_postcode').html($("#SCForceDialSpan td:contains('PostCode:')").next('td').text());
  $('#btx_callback_current_status').html($("#SCForceDialSpan td:contains('Status: '):not(:contains('Callback'))").next('td').text());
  $('#btx_callback_lead_comments').html($("#SCForceDialSpan td:contains('Comments:'):not(:contains('Callback'))").next('td').text());
  $('#btx_callback_phone').html($("#SCForceDialSpan td:contains('Phone:'):not(:contains('Alt'))").next('td').text().replace(/[^\d.]/g, ''));
  $('#btx_callback_alt_phone').html($("#SCForceDialSpan td:contains('Alt. Phone:')").next('td').text().replace(/[^\d.]/g, ''));
  $('#cbk_popup_dial_main').attr('onClick', $("#SCForceDialSpan td:contains('Phone: ')").next('td').find('a').attr('onclick'));  
  $('#cbk_popup_dial_alt').attr('onClick', $("#SCForceDialSpan td:contains('Alt. Phone: ')").next('td').find('a').attr('onclick'));  



  if (hasNumbers($("#SCForceDialSpan td:contains('Alt. Phone: ')").next('td').text())==true){
    $('#cbk_popup_dial_alt').show();
    $('#cbk_popup_alt_phone_span').show();
  }
  else
  {
    $('#cbk_popup_dial_alt').hide();
    $('#cbk_popup_alt_phone_span').hide();
  }

  $('#force_callback_modal').modal('show');

}
else
{
  $('#force_callback_modal').modal('hide');
}







if ($('#AgenTDisablEBoX').css('visibility') == 'visible')
{
  $('#logout_reason').html('You have been logged out by another user- Please close your browser')
  $('#logoutwave').hide();
  $('#logouterror').show();
  LogouT('DISABLED','');
  needToConfirmExit = false;
			//window.location.replace('https://dev.bluetelecoms.com:8443/agc/bluetelecoms/logged-out.php?logged-out=yes');
			$('body > :not(#logout-div)').hide(); //hide all nodes directly under the body
			$('#logout-div').appendTo('body');
			$("#return_to_login").attr("href","../agent/bluetelecoms/login.php?VD_login=" + user + "&VD_pass=" + orig_pass + "&phone_login=" +phone_login + '&phone_pass='+phone_pass);

      window.setTimeout(function(){
        // Move to a new location or you can do something else
        window.location.href = "../agent/bluetelecoms/login.php?VD_login=" + user + "&VD_pass=" + orig_pass + "&phone_login=" +phone_login + '&phone_pass='+phone_pass;
      }, 15000);

    }


    if ($('#SysteMDisablEBoX').css('visibility') == 'visible')
    {
      $('#time_sync_error_popup').modal('show');
    }



    if (($('#DispoSelectBox').css('visibility') == 'visible') && ($('#CallBackSelectBox').css('visibility') != 'visible'))
    {
      hide_dial_next_button =0;
      $('#modal-outcome').modal('show');
      if ($("#btx_transfer_main").is(":visible"))
      {
        poplulate_agent_stats()
        btx_reduce_script_section();
        $(".stuff").addClass('hidden');
        $('#btx-leads').hide();
        $("#btx-stats").removeClass('hidden');
      }

///
      if (document.getElementById("callchannel").innerHTML.length > 3)
        {
          
          var url = "bluetelecoms/get_data/manual_bug_fix.php"; // This is the file that handles the request
          $.ajax({
            url: url,
            type: 'post',
            data: {"lead_id":vicidial_form.lead_id.value,"user":user,"phone_number":vicidial_form.phone_number.value,"extension":phone_login},
            success: function(data_)
            {
          
              if(data_)  //This is returned from the PHP request
               {
                console.log('*** MANUAL DIAL BUG FIX APPLIED ***')
               }
                     
            }
          
          });

          DispoHanguPAgaiN();
        }

    }



    if ($('#AlertBox').css('visibility') == 'visible')
    {
      $('#alert_modal_popup_msg').html(document.getElementById("AlertBoxContent").innerHTML);

      if (document.getElementById("AlertBoxContent").innerHTML.includes('Dial timed out, contact your system administrator'))
      {
        $('#alert_modal_popup_msg').html('Recommended ring time exceeded. Please disposition call');
      }

      if (document.getElementById("AlertBoxContent").innerHTML.includes('No more leads in the hopper for campaign'))
      {
        $('#alert_modal_popup_msg').html('There is currently no data available to call in this campaign');
      }

      $('#alert_modal_popup').modal('show');
    }



    if ($('#TimerSpan').css('visibility') == 'visible')
    {
      $('#btx_TimerSpan_popup_msg').html(document.getElementById("TimerContentSpan").innerHTML);

      if (document.getElementById("TimerContentSpan").innerHTML.includes('CONGESTION'))
      {
        $('#btx_TimerSpan_popup_msg').html('Call Failed - Possible Invalid Number');
      }
      $('#btx_TimerSpan').modal('show');
    }


    if ($('#blind_monitor_alert_span').css('visibility') == 'visible')
    {
      hideDiv('blind_monitor_alert_span');
    }

    if ($('#DeactivateDOlDSessioNSpan').css('visibility') == 'visible')
     {  $('#logoutwave').hide();
   $('#logouterror').show();
   $('#logout_reason').html('You have logged in with an already active user account. Both sessions have been disabled. Please log back in again')
   LogouT('DISABLED','');
   needToConfirmExit = false;
			//window.location.replace('https://dev.bluetelecoms.com:8443/agc/bluetelecoms/logged-out.php?logged-out=yes');
			$('body > :not(#logout-div)').hide(); //hide all nodes directly under the body
			$('#logout-div').appendTo('body');
			$("#return_to_login").attr("href","../agent/bluetelecoms/login.php?VD_login=" + user + "&VD_pass=" + orig_pass + "&phone_login=" +phone_login + '&phone_pass='+phone_pass);

      window.setTimeout(function(){
        // Move to a new location or you can do something else
        window.location.href = "../agent/bluetelecoms/login.php?VD_login=" + user + "&VD_pass=" + orig_pass + "&phone_login=" +phone_login + '&phone_pass='+phone_pass;
      }, 15000);
    }


    if ($('#InvalidOpenerSpan').css('visibility') == 'visible')
    {
      $('#loadingscreen').show();
      $('#welcome_msg').html('This agent screen was not opened properly. Please close the browser and try again')
    }



    if ($('#NoneInSessionBox').css('visibility') == 'visible')
    {

      if (is_webphone=='Y')
      {

        NoneInSessionCalL('LOGIN');hideDiv('NoneInSessionBox');
      }
      else
      {
        $('#no-one-in-your-session').modal('show');
      }
    }


    if (document.getElementById("MainStatuSSpan").innerHTML.includes('Dial Alt Phone Number:'))
    {
     $('.btx_call_control_buttons').hide();
     $('.Alt_number_dialling_opts').show();
     $('#btx_RecorDControl_div').hide();
     $('.ParkControl123').hide();

     if (document.getElementById("MainStatuSSpan").innerHTML.includes("ManualDialOnly('MaiNPhonE','YES')"))
     {
      $('.btx_DIAL_Main_NUMber').show();
    }
    else
    {
      $('.btx_DIAL_Main_NUMber').hide();
    }

    if (document.getElementById("MainStatuSSpan").innerHTML.includes("ManualDialOnly('ALTPhonE','YES')") && ($('#btx_input_alt_phone').val() !='') && 	($('#btx_input_alt_phone').val() !='Alt. Phone'))
    {
      $('.btx_DIAL_Alt_NUMber').show();
    }
    else
    {
      $('.btx_DIAL_Alt_NUMber').hide();
    }
  }
  else
  {
   $('.btx_call_control_buttons').show();
   $('.Alt_number_dialling_opts').hide();
   $('#btx_RecorDControl_div').show();
   $('.ParkControl123').show();
 }
// Agent Is Paused
//	else if(VDRP_stage != "READY" && VD_live_customer_call == 0 && XD_live_customer_call == 0){
	if((document.getElementById("DiaLControl").innerHTML.includes('vdc_LB_paused.gif'))  || (document.getElementById("DiaLControl").innerHTML.includes('vdc_LB_dialnextnumber.gif') && (dial_method != 'INBOUND_MAN') && (!document.getElementById("DiaLControl").innerHTML.includes('vdc_LB_active.gif')  || !document.getElementById("DiaLControl").innerHTML.includes('vdc_LB_paused.gif'))) && (AgentDispoing == 0)){
		if (prev_status != 'PAUSED')
		{
      $('#hotkey_span').hide();
        $('#clientVOLup').html('');$('#clientVOLdown').html('');
      $('.blue-brand').attr('style', 'background-color: #0E2F44 !important');


//console.log("Agent is in a PAUSED!");
//console.log('Prev_status: '+ prev_status + ' STATUS: PAUSED');
////Any events which should happen when a status changes to Pause should be placed here
DisableorHideWhenNotPaused('Paused');
DisableorHideWhenNotInCall('hide');

////////console.log("Agent is PAUSED!");
$(".btx_agent_status_buttons").hide();
$("#btx_agent_is_paused_button").show();
$("#btx_pause_dispo_button").html('');
//$("#btx_pause_dispo_button").html('Paused - ');
//$(".hangup_button").hide();
$//(".btx_pause_button").hide();
//$("#start_button").show();
//$('#dial_next_button123').show();
prev_status = 'PAUSED'; 
}


if ((($('#btx_input_MDPhonENumbeR').val().length > 5) && $('#btx_input_MDPhonENumbeR').val() != 'Phone Number'))
{
  $(".man_dial_buttons").prop('disabled', false);
}
else
{
  $(".man_dial_buttons").prop('disabled', true);
}

btx_pause_timer_counter++;
//////////console.log(btx_pause_timer_counter);
if(btx_pause_timer_counter != 0){
	var btx_current_pause_time = formatSeconds(btx_pause_timer_counter/4);
	$("#btx_pause_timer").html(btx_current_pause_time);
	
	if ((pause_time_limt_value != 0) && (pause_time_limt_value < (btx_pause_timer_counter/4)))
	{
		$(".btx_agent_status_buttons").hide();
		$('#btx_agent_is_paused_exceed_button').show();	
		$('.blue-brand').attr('style', 'background-color: #dc3545 !important');
		$("#btx_pause_timer_exceed").html(btx_current_pause_time);
		
		
	}

}


}




// Manual Dial in Progress
//	else if((VD_live_call_secondS < 1) &&  (MD_ring_secondS > 0 )){
	if ((((document.getElementById("MainStatuSSpan").innerHTML.includes('Waiting for Ring..')) && !document.getElementById("DiaLControl").innerHTML.includes('vdc_LB_dialnextnumber.gif') && (AgentDispoing == 0)) && (!document.getElementById("DiaLControl").innerHTML.includes('vdc_LB_paused.gif')) && (!document.getElementById("DiaLControl").innerHTML.includes('vdc_LB_active.gif'))) && (document.getElementById("TransferMain").style.visibility != 'visible'))   {
		if (prev_status != 'MANUAL')
		{
			$('.blue-brand').attr('style', 'background-color: #0E2F44 !important');
      if (document.getElementById('hotkeysdisplay')) {$('#hotkey_span').show();}
//console.log("Agent is in a MANUAL!");
//console.log('Prev_status: '+ prev_status + ' STATUS: MANUAL');
////Any events which should happen when a status changes to manual dial should be placed here
if ((form_check == 1) && (custom_fields_enabled > 0)){update_form_first_time();}
DisableorHideWhenNotPaused('hide');
DisableorHideWhenNotInCall('hide');

btx_pause_timer_counter = 0;
btx_dispo_timer_counter = 0;
////////console.log("Agent has started a manual dial!");
$(".btx_agent_status_buttons").hide();
$("#btx_agent_is_manual_dial_in_progress_button").show();
//$(".hangup_button").show();
//$("#start_button").hide();
//$(".btx_pause_button").hide();
//$('#dial_next_button123').hide();

		//btx_get_script_contents();

			//get_call_launch_function();

      prev_status = 'MANUAL'; 

    }	

    if (MD_ring_secondS != 0)
    {
     $("#btx_mandial_timer").html(formatSeconds(MD_ring_secondS));	
   }

 }





//DISPO
if(  (AgentDispoing > 0) || (waiting_on_dispo == 1) || (document.getElementById("MainStatuSSpan").innerHTML.includes('Dial Alt Phone Number:'))) {

	if (prev_status != 'DISPO')
	{
      $('#clientVOLup').html('');$('#clientVOLdown').html('');
    $('#hotkey_span').hide();
    $('.blue-brand').attr('style', 'background-color: #0E2F44 !important');
//console.log("Agent is in a DISPO!");
//console.log('Prev_status: '+ prev_status + ' STATUS: DISPO');
////Any events which should happen when a status changes to dispo should be placed here					
////////console.log('AGENT IS IN DISPO');
DisableorHideWhenNotPaused('hide');
DisableorHideWhenNotInCall('hide');
btx_pause_timer_counter = 0;

$(".btx_agent_status_buttons").hide();
$("#btx_agent_is_in_dispo_button").show();
//$('#dial_next_button123').hide();
prev_status = 'DISPO'; 
}


btx_dispo_timer_counter++;
//////////console.log(btx_pause_timer_counter);
if(btx_dispo_timer_counter != 0){
	var btx_current_dispo_time = formatSeconds(btx_dispo_timer_counter/4);
	$("#btx_dispo_timer").html(btx_current_dispo_time);
}




}

if ($('#CustomerGoneBox').css('visibility') == 'visible')
{
  $('#btx_CustomerGoneBox').modal('show');
}


//DEAD
//	else if ( (CheckDEADcall > 0) && (VD_live_customer_call==1) ) {	

	if ((document.images['livecall'].src.includes('agc_live_call_DEAD.gif')) && (AgentDispoing == 0)){



		if ((prev_status != 'DEAD') && (prev_status != 'LOGIN'))  
		{
      if (document.getElementById('hotkeysdisplay')) {$('#hotkey_span').show();}
      $('.blue-brand').attr('style', 'background-color: #0E2F44 !important');
//console.log("Agent is DEAD!");
//console.log('Prev_status: '+ prev_status + ' STATUS: DEAD');
////Any events which should happen when a status changes to dead should be placed here
DisableorHideWhenNotPaused('hide');
DisableorHideWhenNotInCall('hide');
////////console.log("AGENT IS IN DEAD");

btx_pause_timer_counter = 0;
btx_dispo_timer_counter = 0;
$(".btx_agent_status_buttons").hide();
$("#btx_agent_is_dead_button").show();
//$(".hangup_button").show();
//$("#start_button").hide();
//$('#dial_next_button123').hide();
prev_status = 'DEAD'; 
}
}





if (in_lead_preview_state > 0) 
{
 if (prev_status != 'MANPREV')
 {
  $('#hotkey_span').hide();
  $('.blue-brand').attr('style', 'background-color: #0E2F44 !important');
					//console.log("Agent is in PREVIEW!");
				//console.log('Prev_status: '+ prev_status + ' STATUS: PAUSED');
				$('#btx_agent_is_in_preview').show();
				prev_status = 'MANPREV';
			}
		}

// Agent Is Ready
//	else if(VDRP_stage == "READY" && VD_live_customer_call == 0 && XD_live_customer_call == 0){

	if((document.getElementById("DiaLControl").innerHTML.includes('vdc_LB_active.gif')) && (AgentDispoing == 0)){

		if (prev_status != 'READY')
		{
        $('#clientVOLup').html('');$('#clientVOLdown').html('');
			$('.blue-brand').attr('style', 'background-color: #0E2F44 !important'); 
      $('#hotkey_span').hide();
//console.log("Agent is READY!");
//console.log('Prev_status: '+ prev_status + ' STATUS: READY');
////Any events which should happen when a status changes to ready should be placed here
DisableorHideWhenNotPaused();
DisableorHideWhenNotInCall();
btx_pause_timer_counter = 0;
btx_dispo_timer_counter = 0;
////////console.log("Agent is READY!");
$(".btx_agent_status_buttons").hide();
$("#btx_agent_is_ready_button").show();
$(".btx_pause_button").show();
//$("#start_button").hide();
//$('#dial_next_button123').show();
prev_status = 'READY'; 
}
}



      if (document.vicidial_form.MDDiaLCodE.value=='1')
      {

        $('#btx_input_postal_code').attr("placeholder", 'Zip Code');
        $('#citycol').removeClass('col-6').addClass('col-4');
        $('#pccol').removeClass('col-4').addClass('col-3');
        $('#statecol').show();
      }

// Agent Is In Call
// if((VDRP_stage == "PAUSED" && VD_live_customer_call == 1 || XD_live_customer_call == 1) && (VD_live_call_secondS > 0) && (CheckDEADcallON==0)){
  if ((document.images['livecall'].src.includes('agc_live_call_ON.gif'))&& (AgentDispoing == 0)){


  if ((prev_status !='INCALL') && (prev_status !='INBOUNDINCALL') )
    {
      get_call_launch_function();
    configureprecallbackwindow();
    if (document.getElementById('hotkeysdisplay')) {$('#hotkey_span').show();}
    $('#modal-pause-codes').modal('hide');
    hideDiv('PauseCodeSelectBox');
    $("#btx_call_timer").html('00:00:00'); 
    $('.blue-brand').attr('style', 'background-color: #0E2F44 !important');
    
    if (document.getElementById("MainStatuSSpan").innerHTML.includes('Fronter:') == true)
      {
      //console.log('INBOUND CALL!!!');
      $(".btx_agent_status_buttons").hide();
      $("#btx_agent_is_in_inbound_call_button").show();
      $('#btx_agent_is_in_inbound_call_button').css('background-color',document.getElementById("MainStatuSSpan").style.background);
      $('#btx_agent_is_in_inbound_call_button').css('border-color',document.getElementById("MainStatuSSpan").style.background);
      prev_status = 'INBOUNDINCALL'; 
    }
  else
    {
      //console.log("Agent is in a CALL!");
      $(".btx_agent_status_buttons").hide();
      $("#btx_agent_is_in_call_button").show();
      prev_status = 'INCALL'; 
    }
//console.log('Prev_status: '+ prev_status + ' STATUS: INCALL');
///Any events which should happen when a status changes to incall should be placed here
if ((form_check == 1) && (custom_fields_enabled > 0)){update_form_first_time();}
DisableorHideWhenNotPaused();
DisableorHideWhenNotInCall('Incall');
btx_pause_timer_counter = 0;
btx_dispo_timer_counter = 0;

//$(".btx_agent_status_buttons").hide();
//$("#btx_agent_is_in_call_button").show();
//$(".hangup_button").show();
//$("#start_button").hide();
//$('#dial_next_button123').hide();

btx_get_script_contents();

}

if ((prev_status =='INCALL') && (document.getElementById("MainStatuSSpan").innerHTML.includes('Fronter:') == true))

      {
      ////console.log('INBOUND CALL!!!');
      $(".btx_agent_status_buttons").hide();
      $("#btx_agent_is_in_inbound_call_button").show();
      $('#btx_agent_is_in_inbound_call_button').css('background-color',document.getElementById("MainStatuSSpan").style.background);
      $('#btx_agent_is_in_inbound_call_button').css('border-color',document.getElementById("MainStatuSSpan").style.background);
      prev_status = 'INBOUNDINCALL'; 
    }

if ((VD_live_call_secondS > 0) && (document.getElementById("MainStatuSSpan").innerHTML.includes('Fronter:') == false))
{
  $("#btx_call_timer").html(formatSeconds(VD_live_call_secondS));	
}
else
{
  $("#btx_call_timer_inbound").html(formatSeconds(VD_live_call_secondS));		
}

}


// Agent is in Dial Next mode
//	if(MD_channel_look){
//				//////console.log('AgentDispoing: '+AgentDispoing+' waiting_on_dispo: '+waiting_on_dispo+ ' AgentDispoing: '+AgentDispoing+' CheckDEADcall: '+CheckDEADcall+' VDRP_stage: '+VDRP_stage+' VD_live_customer_call: '+VD_live_customer_call+' XD_live_customer_call: '+XD_live_customer_call+' manual_dial_in_progress: '+manual_dial_in_progress+ ' MD_ring_secondS:'+MD_ring_secondS+' auto_dial_level: '+auto_dial_level+' VD_live_call_secondS: '+VD_live_call_secondS+' MD_channel_look: '+MD_channel_look+ ' prev_status: '+ prev_status + ' STATUS: Man Next');
// enable hangup button
//		$(".hangup_button").show();
//	}
}
}, 250);



							////////////////////////////////////////////////////////////////////////////////////////////////////////
					  //////////////////////////////////////////////////////////////////////////////////////////////////////////////
		   /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////LOOP SECTION THAT HANDLES STATUS AND POPUPS/////////////
		   /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			   		   /////////////////////////////////////////////////////////////////////////////////////////////////////////////
						   /////////////////////////////////////////////////////////////////////////////////////////////////////////








		//////////////////////////////////////////////////////////////////////////////////////
		/////////////////////// - END: Agent Status and Handler - ////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////
		


		//////////////////////////////////////////////////////////////////////////////////////
		///////////////// - START: Expanding and Reducing the Script section - ///////////////
		//////////////////////////////////////////////////////////////////////////////////////

		// hide the reduce button initialy
		$("#btx_reduce_script_button").hide();



		// function to expand the script section
		function btx_expand_script_section(){
			// remove the customer section
			$("#my_card").hide();
			// expand the script section to class 12
			// first we need to add the class col-12 and then remove the class col-7
			$("#btx-script").addClass("col-12");
			$("#btx-script").removeClass("col-5");
      $('#script_box_container').css("height", "calc(100vh - 200px)");
			// now copy the buttons from the customer section to the script section
			// first check if the buttons are there already if so don't append them
			if($("#btx-script .card-header").has("#btx_call_control_buttons").length){
				////////console.log("the div head has the call controls already");
			} else {
				$("#my_card .btn-group:first").clone(true).appendTo("#btx-script .card-header");
			}
			// hide button Expand
			$("#btx_expand_script_button").hide();
			// show button Reduce
			$("#btx_reduce_script_button").show();
			// move call buttons to left
			$("#btx-script .btn-group").css("float", "left");
			// move the script buttons to the right
			$("#btx_script_controls").css({"float" : "right", "left" : "-46%", "position" : "relative"});
		}
		
		// function to reduce the script section
		function btx_reduce_script_section(){
			// show the customer section
			$("#my_card").show();
			// reduce the script section to class 5
			// first we need to add the class col-5 and then remove the class col-12
			$("#btx-script").addClass("col-5");
			$("#btx-script").removeClass("col-12");
      $('#script_box_container').css("height", "550px");
			// now remove the buttons that belong to the customer section from the script head
			$("#btx-script .btn-group").remove();
			// hide button Reduce
			$("#btx_reduce_script_button").hide();
			// show button Expand
			$("#btx_expand_script_button").show();
			// move the script buttons to their initial place
			$("#btx_script_controls").css({"float" : "", "left" : "", "position" : ""});
		}

		// event handler for the expantion of the script
		$("#btx_expand_script_button").on("click", function(){
			btx_to_expand_or_not = 1;
			btx_expand_script_section();
		});
		// event handler for the reducing of the script
		$("body").on("click", "#btx_reduce_script_button", function(){
			btx_to_expand_or_not = 0;
			btx_reduce_script_section();
		});

		//////////////////////////////////////////////////////////////////////////////////////
		///////////////// - END: Expanding and Reducing the Script section - /////////////////
		//////////////////////////////////////////////////////////////////////////////////////

		function get_call_launch_function()
		{
			$("#btx_script_head_customer_name").html("&nbsp;<b>Client: </b>" +document.vicidial_form.title.value+" "+document.vicidial_form.first_name.value+" "+document.vicidial_form.last_name.value);
     if (get_call_launch == 'SCRIPT')
     {
       if(btx_to_expand_or_not)
       {
        btx_expand_script_section();
      }
      $(".stuff").addClass('hidden');
      $('#btx-leads').hide();
      $("#btx-script").removeClass('hidden');
    }

    if (get_call_launch == 'FORM')
    {
     btx_reduce_script_section();
     $(".stuff").addClass('hidden');
     $('#btx-leads').hide();
     $("#btx-form").removeClass('hidden');
   }
 }

		//////////////////////////////////////////////////////////////////////////////////////
		//////////////////////// - START: Make a Manual Dial Call - //////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////

		// on click of DIAL NOW button: call the dial function
		$("body").on("click", "#btx_dial_now_button", function(){
			if ($('#btx_input_MDPhonENumbeR').val().length > 5 )
			{
			// get the script contents
			btx_get_script_contents();
			NeWManuaLDiaLCalLSubmiT('NOW','YES');
			get_call_launch_function();
			//////////console.log("maual dial");
			return false;
   }
 });


		if (manual_dial_preview > 0) 
		{

      $('#btx_preview_man_dial_button').show();

    }

    $("body").on("click", "#btx_preview_man_dial_button", function(){
     if ($('#btx_input_MDPhonENumbeR').val().length > 5)
     {
			// get the script contents
			btx_get_script_contents();
			NeWManuaLDiaLCalLSubmiT('PREVIEW','YES');
			get_call_launch_function();
			//////////console.log("maual dial");
			return false;
		}
  });
		//////////////////////////////////////////////////////////////////////////////////////
		//////////////////////// - END: Make a Manual Dial Call - ////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////


		//////////////////////////////////////////////////////////////////////////////////////
		///////////////////// - START: Pause Screen Dinamically Created - ////////////////////
		//////////////////////////////////////////////////////////////////////////////////////
		$("#open_pause_modal").on("click", function(){
			
			btx_open_pause_menu();
		});



		function btx_open_pause_menu(){
      $('#modal-pause-codes').modal('toggle');
			// get the total number of selectable dispos
			// at the same time populate the dispo array with the selectable dispos
			var btx_pause_array = {};
			var btx_total_count_pause_codes = 0;
			while(btx_total_count_pause_codes < VD_pause_codes_ct){
				
				btx_pause_array[btx_total_count_pause_codes] = { "pause_name" : VARpause_code_names[btx_total_count_pause_codes], "pause_code" : VARpause_codes[btx_total_count_pause_codes] };
				btx_total_count_pause_codes++;
			}

			btx_pause_creation = btx_get_columns(btx_total_count_pause_codes, "#pause_width");

			var btx_pause_codes = '';

			btx_current_pause = 0;
			for(var x = 0; x<btx_pause_creation.length; x++){
				btx_pause_codes += '<div class="col"><div class="btn-group-outcome">';
				for(var y = 0; y<btx_pause_creation[x]; y++){

					pause_name = btx_pause_array[btx_current_pause]['pause_name'];

					btx_pause_codes += '<button class="btn btn-success btn-block btx_pause_buttons" data-btx_pause_name="'+pause_name+'" data-btx_pause_code="'+btx_pause_array[btx_current_pause]['pause_code']+'" type="submit">'+pause_name+'</button>';
					btx_current_pause++;
					if(y+1==btx_pause_creation[x]){
						btx_pause_codes += '</div>';
					}
				}
				btx_pause_codes+='</div>';
			}

			$("#btx_pause_codes").html(btx_pause_codes);
		}

		//////////////////////////////////////////////////////////////////////////////////////
		/////////////////////// - END: Pause Screen Dinamically Created - ////////////////////
		//////////////////////////////////////////////////////////////////////////////////////



		//////////////////////////////////////////////////////////////////////////////////////
		///////////////////// - START: Dispo Screen Dinamically Created - ////////////////////
		//////////////////////////////////////////////////////////////////////////////////////

		// on hangup build and show the dispo screen
		$(".hangup_and_show_dispo").on("click", function(){
      hide_dial_next_button = 1;
			// clear the manual dial phone number input field
			$("#btx_input_MDPhonENumbeR").val('');
			// clear the Full name of the customer from the head of the script section
      $('#btx_input_call_notes_dispo').val(document.vicidial_form.call_notes_dispo.value);

      $('#btx_transfer_restart_button').show();
      $('.hide_transfers').hide();
      $('#btx_transfer_extra_info').html('Please Select a Transfer Destination');
      $('#btx_transfer_main').show();
      $(".hangup_and_show_dispo").not( "#btx_transfer_leave" ).prop('disabled', false);
			// clear the script section body
			
			// get the total number of selectable dispos
			// at the same time populate the dispo array with the selectable dispos
			var btx_dispo_array = {};
			var btx_loop_ct = 0;
			var btx_total_count_dispos = 0;
			while(btx_loop_ct < VD_statuses_ct){
       if (( ( (VARMINstatuses[btx_loop_ct] > 0) && (customer_sec < VARMINstatuses[btx_loop_ct]) ) || ( (VARMAXstatuses[btx_loop_ct] > 0) && (customer_sec > VARMAXstatuses[btx_loop_ct]) ) )) {} else {
				//////////console.log("VD_statuses_ct: "+VD_statuses_ct);
				if (VARSELstatuses[btx_loop_ct] == 'Y'){

					btx_dispo_array[btx_total_count_dispos] = { "status_name" : VARstatusnames[btx_loop_ct], "status_code" : VARstatuses[btx_loop_ct] };
					btx_total_count_dispos++;
					//alert(VARstatusnames[btx_loop_ct]); 
				}}
				btx_loop_ct++;
			}

			//////////console.log(btx_dispo_array);
			
			btx_dispo_creation = btx_get_columns(btx_total_count_dispos, "#dispos_width");
			
			var btx_the_dispos = '';
      var btx_the_dispos_green="";
      var btx_the_dispos_blue="";
      var btx_the_dispos_red="";
      var btx_the_dispos_purple="";
      btx_current_dispo = 0;
      for(var x = 0; x<btx_dispo_creation.length; x++){

        btx_the_dispos += '';
				//ruchita
				////////console.log("column: "+x);
				//~ alert(btx_dispo_array[btx_current_dispo]['status_code']);
				
				for(var y = 0; y<btx_dispo_creation[x]; y++){
					
					btn_color="";
					
					if(sale_dispo_cat.includes(btx_dispo_array[btx_current_dispo]['status_code'].toLowerCase())){
						btn_color="2";	
						//~ btx_the_dispos += '<button data-toggle="modal" data-target="#modal-default-callback" class="btn btn-success btn-block btx_dispo_buttons btx_dispo_colors_' +btn_color+'</button>';
						btx_the_dispos_green += '<button class="btn btn-success btn-block btx_dispo_buttons btx_dispo_colors_'  +btn_color+'" data-btx_dispo_name="'+btx_dispo_array[btx_current_dispo]['status_name']+'" data-btx_dispo_code="'+btx_dispo_array[btx_current_dispo]['status_code']+'" type="submit" >'+btx_dispo_array[btx_current_dispo]['status_name']+'</button>';	
					}


					else if(cbk_dispo_cat.includes(btx_dispo_array[btx_current_dispo]['status_code'].toLowerCase())){

						
           btn_color="2";	
						//~ btx_the_dispos += '<button data-toggle="modal" data-target="#modal-default-callback" class="btn btn-success btn-block btx_dispo_buttons btx_dispo_colors_' +btn_color+'</button>';
						btx_the_dispos_green += '<button class="btn btn-success btn-block btx_dispo_buttons btx_dispo_colors_'  +btn_color+'" data-btx_dispo_name="'+btx_dispo_array[btx_current_dispo]['status_name']+'" data-btx_dispo_code="'+btx_dispo_array[btx_current_dispo]['status_code']+'" type="submit" > <i class="fas fa-user-clock"></i> '+btx_dispo_array[btx_current_dispo]['status_name']+'</button>';
						

					}
					else if (bad_dispo_cat.includes(btx_dispo_array[btx_current_dispo]['status_code'].toLowerCase())){
						btn_color="0";		
						btx_the_dispos_red += '<button class="btn btn-success btn-block btx_dispo_buttons btx_dispo_colors_'  +btn_color+'" data-btx_dispo_name="'+btx_dispo_array[btx_current_dispo]['status_name']+'" data-btx_dispo_code="'+btx_dispo_array[btx_current_dispo]['status_code']+'" type="submit" >'+btx_dispo_array[btx_current_dispo]['status_name']+'</button>';
					}
					else if (contact_dispo_cat.includes(btx_dispo_array[btx_current_dispo]['status_code'].toLowerCase())){
						btn_color="4";		
						btx_the_dispos_purple += '<button class="btn btn-success btn-block btx_dispo_buttons btx_dispo_colors_'  +btn_color+'" data-btx_dispo_name="'+btx_dispo_array[btx_current_dispo]['status_name']+'" data-btx_dispo_code="'+btx_dispo_array[btx_current_dispo]['status_code']+'" type="submit" >'+btx_dispo_array[btx_current_dispo]['status_name']+'</button>';
					}
					else{
						btn_color="3";		
						btx_the_dispos_blue += '<button class="btn btn-success btn-block btx_dispo_buttons btx_dispo_colors_'  +btn_color+'" data-btx_dispo_name="'+btx_dispo_array[btx_current_dispo]['status_name']+'" data-btx_dispo_code="'+btx_dispo_array[btx_current_dispo]['status_code']+'" type="submit" >'+btx_dispo_array[btx_current_dispo]['status_name']+'</button>';
					}
					//btx_the_dispos += '<button class="btn btn-success btn-block btx_dispo_buttons btx_dispo_colors_'  +btn_color+'" data-btx_dispo_name="'+btx_dispo_array[btx_current_dispo]['status_name']+'" data-btx_dispo_code="'+btx_dispo_array[btx_current_dispo]['status_code']+'" type="submit" >'+btx_dispo_array[btx_current_dispo]['status_name']+'</button>';
					
					//ruchita
					////////console.log(" row: " + y);
					btx_current_dispo++;
					/*if(y+1==btx_dispo_creation[x]){
						btx_the_dispos += '</div>';
					}*/
				}
				
			}
			btx_the_dispos+='<div class="col"><div class="btn-group-outcome">'+btx_the_dispos_blue+"</div></div>";
      btx_the_dispos+='<div class="col"><div class="btn-group-outcome">'+btx_the_dispos_red+"</div></div>";
      btx_the_dispos+='<div class="col"><div class="btn-group-outcome">'+btx_the_dispos_purple+"</div></div>";
      btx_the_dispos+='<div class="col"><div class="btn-group-outcome">'+btx_the_dispos_green+"</div></div>";
      btx_the_dispos+='</div>';
      $("#btx_the_dispos").html(btx_the_dispos);

    });


$("#LocalCloser").on("click", function(){
			// clear the manual dial phone number input field
			$("#btx_input_MDPhonENumbeR").val('');
			// clear the Full name of the customer from the head of the script section

			// get the total number of selectable dispos
			// at the same time populate the dispo array with the selectable dispos
			var btx_dispo_array = {};
			var btx_loop_ct = 0;
			var btx_total_count_dispos = 0;
			while(btx_loop_ct < VD_statuses_ct){
       if (( ( (VARMINstatuses[btx_loop_ct] > 0) && (customer_sec < VARMINstatuses[btx_loop_ct]) ) || ( (VARMAXstatuses[btx_loop_ct] > 0) && (customer_sec > VARMAXstatuses[btx_loop_ct]) ) )) {} else {
				//////////console.log("VD_statuses_ct: "+VD_statuses_ct);
				if (VARSELstatuses[btx_loop_ct] == 'Y'){

					btx_dispo_array[btx_total_count_dispos] = { "status_name" : VARstatusnames[btx_loop_ct], "status_code" : VARstatuses[btx_loop_ct] };

					btx_total_count_dispos++;
					//alert(VARstatusnames[btx_loop_ct]); 
				}}
				btx_loop_ct++;
			}

			//////////console.log(btx_dispo_array);
			
			btx_dispo_creation = btx_get_columns(btx_total_count_dispos, "#dispos_width");
			
			var btx_the_dispos = '';
      var btx_the_dispos_green="";
      var btx_the_dispos_blue="";
      var btx_the_dispos_red="";
      var btx_the_dispos_purple="";
      btx_current_dispo = 0;
      for(var x = 0; x<btx_dispo_creation.length; x++){

        btx_the_dispos += '';
				//ruchita
				////////console.log("column: "+x);
				//~ alert(btx_dispo_array[btx_current_dispo]['status_code']);
				
				for(var y = 0; y<btx_dispo_creation[x]; y++){
					
					btn_color="";
					
					if(sale_dispo_cat.includes(btx_dispo_array[btx_current_dispo]['status_code'].toLowerCase())){
						btn_color="2";	
						//~ btx_the_dispos += '<button data-toggle="modal" data-target="#modal-default-callback" class="btn btn-success btn-block btx_dispo_buttons btx_dispo_colors_' +btn_color+'</button>';
						btx_the_dispos_green += '<button class="btn btn-success btn-block btx_dispo_buttons btx_dispo_colors_'  +btn_color+'" data-btx_dispo_name="'+btx_dispo_array[btx_current_dispo]['status_name']+'" data-btx_dispo_code="'+btx_dispo_array[btx_current_dispo]['status_code']+'" type="submit" >'+btx_dispo_array[btx_current_dispo]['status_name']+'</button>';	
					}
					else if(cbk_dispo_cat.includes(btx_dispo_array[btx_current_dispo]['status_code'].toLowerCase())){
						//ishwari
						//2018-07-28
						btn_color="2";

						btx_the_dispos_green += '<button data-toggle="modal" data-dismiss="modal" data-target="#modal-default-callback" class="btn btn-success btn-block btx_dispo_buttons btx_dispo_colors_' +btn_color+'</button>';
						btx_the_dispos_green += '<button class="btn btn-success btn-block btx_dispo_buttons btx_dispo_colors_'  +btn_color+'" data-btx_dispo_name="'+btx_dispo_array[btx_current_dispo]['status_name']+'" data-btx_dispo_code="'+btx_dispo_array[btx_current_dispo]['status_code']+'" type="submit" >'+btx_dispo_array[btx_current_dispo]['status_name']+'</button>';
					}
					else if (bad_dispo_cat.includes(btx_dispo_array[btx_current_dispo]['status_code'].toLowerCase())){
						btn_color="0";		
						btx_the_dispos_red += '<button class="btn btn-success btn-block btx_dispo_buttons btx_dispo_colors_'  +btn_color+'" data-btx_dispo_name="'+btx_dispo_array[btx_current_dispo]['status_name']+'" data-btx_dispo_code="'+btx_dispo_array[btx_current_dispo]['status_code']+'" type="submit" >'+btx_dispo_array[btx_current_dispo]['status_name']+'</button>';
					}
					else if (contact_dispo_cat.includes(btx_dispo_array[btx_current_dispo]['status_code'].toLowerCase())){
						btn_color="4";		
						btx_the_dispos_purple += '<button class="btn btn-success btn-block btx_dispo_buttons btx_dispo_colors_'  +btn_color+'" data-btx_dispo_name="'+btx_dispo_array[btx_current_dispo]['status_name']+'" data-btx_dispo_code="'+btx_dispo_array[btx_current_dispo]['status_code']+'" type="submit" >'+btx_dispo_array[btx_current_dispo]['status_name']+'</button>';
					}
					else{
						btn_color="3";		
						btx_the_dispos_blue += '<button class="btn btn-success btn-block btx_dispo_buttons btx_dispo_colors_'  +btn_color+'" data-btx_dispo_name="'+btx_dispo_array[btx_current_dispo]['status_name']+'" data-btx_dispo_code="'+btx_dispo_array[btx_current_dispo]['status_code']+'" type="submit" >'+btx_dispo_array[btx_current_dispo]['status_name']+'</button>';
					}
					//btx_the_dispos += '<button class="btn btn-success btn-block btx_dispo_buttons btx_dispo_colors_'  +btn_color+'" data-btx_dispo_name="'+btx_dispo_array[btx_current_dispo]['status_name']+'" data-btx_dispo_code="'+btx_dispo_array[btx_current_dispo]['status_code']+'" type="submit" >'+btx_dispo_array[btx_current_dispo]['status_name']+'</button>';
					
					//ruchita
					////////console.log(" row: " + y);
					btx_current_dispo++;
					/*if(y+1==btx_dispo_creation[x]){
						btx_the_dispos += '</div>';
					}*/
				}
				
			}
			
      btx_the_dispos+='<div class="col"><div class="btn-group-outcome">'+btx_the_dispos_blue+"</div></div>";
      btx_the_dispos+='<div class="col"><div class="btn-group-outcome">'+btx_the_dispos_red+"</div></div>";
      btx_the_dispos+='<div class="col"><div class="btn-group-outcome">'+btx_the_dispos_purple+"</div></div>";
      btx_the_dispos+='<div class="col"><div class="btn-group-outcome">'+btx_the_dispos_green+"</div></div>";
      btx_the_dispos+='</div>';
      $("#btx_the_dispos").html(btx_the_dispos);

    });



		//////////////////////////////////////////////////////////////////////////////////////
		///////////////////// - END: Dispo Screen Dinamically Created - //////////////////////
		//////////////////////////////////////////////////////////////////////////////////////


		//////////////////////////////////////////////////////////////////////////////////////
		////// - START: Disable/Enable Hangup Button Based on the Agent Status - /////////////
		//////////////////////////////////////////////////////////////////////////////////////

		// check every 0.01 seconds what the current state of current_status_of_agent is and enable/disable hangup button
		// setInterval(function(){
		// 	// check if logged out if not run code below
		// 	if(getParameterByName('logged-out') != "yes"){
		// 		// disable the hangup button
		// 		$(".hangup_button").prop('disabled', true);
		// 		// if current state of agent is Paused, then disable the hangup button
		// 		if(current_status_of_agent == "Paused"){
		// 			$(".hangup_button").prop('disabled', true);
		// 		}
		// 	}
		// }, 100);

		//////////////////////////////////////////////////////////////////////////////////////
		/////// - END: Disable/Enable Hangup Button Based on the Agent Status - //////////////
		//////////////////////////////////////////////////////////////////////////////////////


		//////////////////////////////////////////////////////////////////////////////////////
		////////////////////////// - START: Get Script Contents - ////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////

		// copy script from the old interface into the new interface, do this every 0.5 seconds after a call has been made
		// and then stop once the script has been populated
		function btx_get_script_contents(){
////console.log('function run');
			// set a variable to hold the initial script contents, which should be empty or some kind of sample.
			// this variable must be outside of the interval function
			var initial_script_contents = $("#btx-script .card-body").html();
			// try every 0.5 seconds to get the script contents from the old interface and append it to the new interface
			var script_interval =  setInterval(function(){

				// now set a variable that will hold the script contents that we shall get every 0.5 seconds and we shall
				// compare the two variables for differences and once there is a difference we shall stop the interval
				var current_script_contents = $("#NewScriptContents").html();
				if(current_script_contents !== initial_script_contents){
					clearInterval(script_interval);
////console.log('change of contents');
$('#btx-script .card .card-body').css({'background-color': $('#ScriptContents').css('background-color')});

					// show the script name in the script head section
					// first remove the plus sign from the script name string
					//~ var btx_script_name = scriptnames[campaign_script].replace(/\+/g, ' ');
					//~ $("#btx_script_name").html(btx_script_name);
					// show the customer full name in the script head section
					$("#btx_script_head_customer_name").html("&nbsp;<b>Client: </b>" +document.vicidial_form.title.value+" "+document.vicidial_form.first_name.value+" "+document.vicidial_form.last_name.value);
					// now that the script has been copied over to the new interface, it is time to change the ID's of the 
					// input, textarea and select elements by appending a prefix: "btx_input_"
					$("#NewScriptContents input, #NewScriptContents select, #NewScriptContents textarea").each(function(){
						this.id = "btx_input_"+this.id;
						this.name = "btx_input_"+this.name;
					});
				}
				$("#btx-script .card-body").html($("#NewScriptContents").html() + ' ');
			},500);
		}

		//////////////////////////////////////////////////////////////////////////////////////
		/////////////////////////// - END: Get Script Contents - /////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////


		// the function bellow will change any input field in the background that has an ID of: "btx_input_XXXXX" minus the "btx_input_"
		// in order for this function to work with other inputs in the new Agent UI, they all have to have a name of: btx_input
		$("input[name=btx_input]").on("input", function(){
			var current_value = this.value;
			//cut out the btx_input_ part of the current id in order to get the ID of the vicidial form input
			var current_id = this.id.substring(10);
			//////////console.log(current_id);
			$("#"+current_id).val(current_value);
		});

		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		///////////// - START: Detect any change in the input fields on the New Interface and assign the values to the old interface - //////////////
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		$("input").on("input", function(){
			var current_input_id = this.id;
			var old_input_id = current_input_id.substring(10);
			$("#"+old_input_id).val(this.value);
		});

		$("select").on("change", function(){
			var current_select_id = this.id;
			var old_interface_id = current_select_id.substring(10);
			$("#"+old_interface_id).val(this.value);
		});

		$("textarea").on("change input", function(){
			var current_textarea_id = this.id;
			var old_interface_id = current_textarea_id.substring(10);
			$("#"+old_interface_id).val(this.value);
		});

    $("#btx_input_phone_numberDISP").on("input", function(){
      $("#phone_number").val(this.value);
    });
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		////////////// - END: Detect any change in the input fields on the New Interface and assign the values to the old interface - ///////////////
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		// the function bellow will check all the inputs in the whole document for any changes and as soon as there is a change the inputs in the new agent interface will change accordingly
		// get the value of the old interface
		setInterval(function() {
			// for each input in the document
			$("input").each(function(){
				if(this.id.substring(0, 10) !== "btx_input_"){
					$("#btx_input_"+this.id).val(this.value);
				}
			});
			// get the phone number of the customer from the span element
			$("#btx_input_phone_numberDISP").val( document.getElementById('phone_number').value);

			// for each select in the document
			$("select").each(function(){
				if(this.id.substring(0, 10) !== "btx_input_"){
					$("#btx_input_"+this.id).val(this.value);
				}
			});

			// for each textarea in the document
			$("textarea").each(function(){
				if(this.id.substring(0, 10) !== "btx_input_"){
					$("#btx_input_"+this.id).val(this.value);
				}
			});

		}, 10);


		//////////////////////////////////////////////////////////////////////////////////////
		/////////////////////////////// - START: Logout - ////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////


    $("#dnc_add").on("click", function(){
      $('#DNC_phone_number1').val($('#DNC_phone_number1').val().replace(/[^0-9]+/g, ''));	
      var phone_number_dnc = $('#DNC_phone_number1').val(); 
      if ((phone_number_dnc.length < 15) && (phone_number_dnc.length > 9)) {

var url = "bluetelecoms/get_data/data.php"; // This is the file that handles the request
$.ajax({
  url: url,
  type: 'post',
  data: {"query":"add_to_dispo","phone_number_dnc":phone_number_dnc,"user":user},
  success: function(data_)
  {
                                if(data_)  //This is returned from the PHP request
                                {
                                	////////console.log(data_);
                                  $('#DNC-result').addClass("text-success").removeClass("text-danger").html('PHONE NUMBER ADDED');          
                                }

                               // $('#campaign_dropdown').html(data);
                             }

                           });

}
else
{

  $('#DNC-result').addClass("text-danger").removeClass("text-success").html('INVALID PHONE NUMBER');
}
});





		// on click of Sign Out button, redirect user to logged-out.php
		$("#signOutButton").on("click", function(){
			////////console.log("campaign: "+ campaign + " - original_phone_login: " + original_phone_login);
			NormalLogout();
			needToConfirmExit = false;
			//window.location.replace('https://dev.bluetelecoms.com:8443/agc/bluetelecoms/logged-out.php?logged-out=yes');
			$('body > :not(#logout-div)').hide(); //hide all nodes directly under the body
			$('#logout-div').appendTo('body');
			pause_time_limt_value =0;
			$('.blue-brand').hide();
			$("#return_to_login").attr("href","../agent/bluetelecoms/login.php?VD_login=" + user + "&VD_pass=" + orig_pass + "&phone_login=" +phone_login + '&phone_pass='+phone_pass);

      window.setTimeout(function(){
        // Move to a new location or you can do something else
        window.location.href = "../agent/bluetelecoms/login.php?VD_login=" + user + "&VD_pass=" + orig_pass + "&phone_login=" +phone_login + '&phone_pass='+phone_pass;
      }, 15000);

    });

		//////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////// - END: Logout - ////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////


		//////////////////////////////////////////////////////////////////////////////////////
		//////////////// - START: handle the disposition choice here - ///////////////////////
		//////////////////////////////////////////////////////////////////////////////////////

		// add functions with return false; for each function call for hanging up
		function btx_dispo_selection(btx_dispo_code){
			
			DispoSelectContent_create(btx_dispo_code,'ADD','YES');
			return false;
		}
		function btx_dispo_select_submit(){
			DispoSelect_submit('','','YES');
			return false;
		}
		function btx_dispo_select_submit_continue(){
			DispoSelect_submit_and_continue('','','YES');
			return false;
		}
		function btx_autodial_resume_pause(){
			AutoDial_ReSume_PauSe('VDADpause','','','','','','','YES');
			return false;
		}
		function btx_pausecodeselect_submit(){
			dispo_check_all_pause = 1;
			PausENotifYCounTer = 11;
			PauseCodeSelect_submit(btx_pause_code,'YES');
			return false;
		}

		// set global variables for this scope for the dispo codes and names
		// the reason we do this is to have the ability to access them in all other functions within this scope
		var btx_dispo_code = '';
		var btx_dispo_name = '';
		// set global variables for the Pause code and name chosen by the agent
		var btx_pause_code = '';
		var btx_pause_name = '';

		$("body").on("click", ".btx_dispo_buttons", function(){

			btx_dispo_code = $(this).data("btx_dispo_code");
			btx_dispo_name = $(this).data("btx_dispo_name");
			//////console.log('click '+btx_dispo_code +' : '+btx_dispo_name )
			document.vicidial_form.DispoSelection.value = $(this).data("btx_dispo_code");
			$('#submit_and_pause_button').prop("disabled", false);
			$('#btx_submit_and_continue').prop("disabled", false);
			
		});


		$("body").on("dblclick", ".btx_dispo_buttons", function(){
			//////console.log('double click');
			btx_dispo_code = $(this).data("btx_dispo_code");
			btx_dispo_name = $(this).data("btx_dispo_name");
			document.vicidial_form.DispoSelection.value = $(this).data("btx_dispo_code");
			
      if (document.vicidial_form.DispoSelection.value!='')
      {

			if ((cbk_dispo_cat.includes(btx_dispo_code.toLowerCase())) && (scheduled_callbacks == '1'))
     {
       configurecallbackwindow();
       $('#call_back_submit_and_pause_button').hide();
       $('#call_back_submit_button').show();
       showDiv('CallBackSelectBox');						
     }
     else
     {
						//////console.log('vicidial '+document.vicidial_form.DispoSelection.value);
						//////console.log('btx_dispo_code  ' + btx_dispo_code )
						DispoSelect_submit('','','YES');	
					}

         $('#submit_and_pause_button').prop("disabled", true);
         $('#btx_submit_and_continue').prop("disabled", true);	
         $('#modal-outcome').modal('hide');
         poplulate_agent_sales(targetsales,SPH);

         $("#btx_script_head_customer_name").html("");
         if (per_call_notes == 'ENABLED')
         {
          $('#btx_show_call_log_button').addClass('btn-secondary').removeClass('btn-success');
          $('#btx_show_comments_button').removeClass('btn-secondary').addClass('btn-success');
          $('#btx_input_call_notes').hide().val('');;
          $('#btx_input_comments').show();
        } 
      }

      });


		$("body").on("click", ".btx_pause_buttons", function(){
			btx_pause_code = $(this).data("btx_pause_code");
			btx_pause_name = $(this).data("btx_pause_name");
			$('#btx_submit_pause_button').prop("disabled",false);
			////////console.log(btx_pause_name);
			// set the Pause name in the Pause status button, for example - Paused - Break
			btx_last_pause_chosen = btx_pause_name;
		});


		$("body").on("dblclick", ".btx_pause_buttons", function(){
			btx_pause_code = $(this).data("btx_pause_code");
			btx_pause_name = $(this).data("btx_pause_name");
			$('#btx_submit_pause_button').prop("disabled",false);
			////////console.log(btx_pause_name);
			// set the Pause name in the Pause status button, for example - Paused - Break
			btx_last_pause_chosen = btx_pause_name;
			$('#btx_submit_pause_button').prop("disabled",true);

			if (AgentDispoing > 0)	
			{
				dispo_check_all_pause = 1;
			}

			//AutoDial_ReSume_PauSe('VDADpause','','','','','','','YES');

			PauseCodeSelect_submit(btx_pause_code,'YES');


      pause_time_limt_value = 0;
      if (btx_pause_limit =='1')
      {

			var url = "bluetelecoms/get_data/data.php"; // This is the file that handles the request
      $.ajax({
        url: url,
        type: 'post',
        data: {"query":"find_pause_limit","pause":btx_pause_code,"camp":campaign},
        success: function(data_)
        {

                                if(data_)  //This is returned from the PHP request
                                {
                                	
                                 var listJson = JSON.parse(data_);

                                 pause_time_limt_value = listJson.pause_time_limit;


                               }


                             }

                           });

    }






			// hide the pause button as the agent is in Pause state already
			$(".btx_pause_button").hide();
			$('#modal-pause-codes').modal('hide');
			$("#btx_pause_dispo_button").html(btx_last_pause_chosen);
		});

		// a function that will be called for the selection of the dispo
		function btx_chosen_dispo_call(){
			btx_dispo_selection(btx_dispo_code);
			btx_dispo_select_submit();
		}
	//	function btx_chosen_dispo_call_continue(){
	//		btx_dispo_selection(btx_dispo_code);
	//		btx_dispo_select_submit_continue();
	//	}

		// on click of the Submit and Pause button open the Pause Dispo
		$("body").on("click", "#submit_and_pause_button", function(){
			document.vicidial_form.DispoSelectStop.checked = true;
      if (document.vicidial_form.DispoSelection.value!='')
      {
      if ((cbk_dispo_cat.includes(btx_dispo_code.toLowerCase())) && (scheduled_callbacks == '1'))
      {
       configurecallbackwindow();
       $('#call_back_submit_and_pause_button').show();
       $('#call_back_submit_button').hide();
       showDiv('CallBackSelectBox');						
     }
     else
     {
      DispoSelect_submit('','','YES');


      if ( auto_dial_level > 0 )
      {
							////////console.log('auto_dial_level' + auto_dial_level);
							AutoDial_ReSume_PauSe("VDADpause");
						}
           if ((agent_pause_codes_active=='Y') || (agent_pause_codes_active=='FORCE'))
           {
							//btx_autodial_resume_pause();
							btx_open_pause_menu();
						}

					}
         $('#submit_and_pause_button').prop("disabled", true);
         $('#btx_submit_and_continue').prop("disabled", true);	
         $('#modal-outcome').modal('hide');
         poplulate_agent_sales(targetsales,SPH);
         $("#btx_script_head_customer_name").html("");
         if (per_call_notes == 'ENABLED')
         {
          $('#btx_show_call_log_button').addClass('btn-secondary').removeClass('btn-success');
          $('#btx_show_comments_button').removeClass('btn-secondary').addClass('btn-success');
          $('#btx_input_call_notes').hide().val('');;
          $('#btx_input_comments').show();
        } 


      }
      });

		$("body").on("click", ".btx_pause_button", function(){
			AutoDial_ReSume_PauSe("VDADpause");
			$("#btx_pause_dispo_button").html('Paused');
			if ((agent_pause_codes_active=='Y') || (agent_pause_codes_active=='FORCE'))
			{
				//btx_autodial_resume_pause();
				btx_open_pause_menu();
			}
		});

		// on click of the submit button from the pause dispo, run all the code to place the agent in the pause code they have chosen
		$("body").on("click", "#btx_submit_pause_button", function(){
			if (AgentDispoing > 0)	
			{
				dispo_check_all_pause = 1;
			}

			//AutoDial_ReSume_PauSe('VDADpause','','','','','','','YES');

			PauseCodeSelect_submit(btx_pause_code,'YES');
      pause_time_limt_value = 0;
      if (btx_pause_limit =='1')
      {

			var url = "bluetelecoms/get_data/data.php"; // This is the file that handles the request
      $.ajax({
        url: url,
        type: 'post',
        data: {"query":"find_pause_limit","pause":btx_pause_code,"camp":campaign},
        success: function(data_)
        {

                                if(data_)  //This is returned from the PHP request
                                {
                                	
                                 var listJson = JSON.parse(data_);

                                 pause_time_limt_value = listJson.pause_time_limit;


                               }


                             }

                           });

    }








			// hide the pause button as the agent is in Pause state already
			$(".btx_pause_button").hide();
			$('#btx_submit_pause_button').prop("disabled",true);
			$("#btx_pause_dispo_button").html(btx_last_pause_chosen);
		});
		
		//////////////////////////////////////////////////////////////////////////////////////
		/////pause///////////// - END: handle the disposition choice here - ///////////////////////
		//////////////////////////////////////////////////////////////////////////////////////
		
		//////////////////////////////////////////////////////////////////////////////////////
		////////////////// - Submit and Continue button for direct hangup - //////////////////
		//////////////////////////////////////////////////////////////////////////////////////
		
		$("body").on("click", "#btx_submit_and_continue", function(){
            //////console.log('clicked on submit and continue '+btx_dispo_code);
            document.vicidial_form.DispoSelectStop.checked = false;
                  if (document.vicidial_form.DispoSelection.value!='')
      {
            if ((cbk_dispo_cat.includes(btx_dispo_code.toLowerCase())) && (scheduled_callbacks == '1'))
            {

             configurecallbackwindow();
             $('#call_back_submit_and_pause_button').hide();
             $('#call_back_submit_button').show();
             showDiv('CallBackSelectBox');						
           }
           else
           {
					//////console.log('got to correct section'); 	
					
					DispoSelect_submit('','','YES');	
       }

       $('#submit_and_pause_button').prop("disabled", true);
       $('#btx_submit_and_continue').prop("disabled", true);	
       $('#modal-outcome').modal('hide');

       $("#btx_script_head_customer_name").html("");
       if (per_call_notes == 'ENABLED')
       {
        $('#btx_show_call_log_button').addClass('btn-secondary').removeClass('btn-success');
        $('#btx_show_comments_button').removeClass('btn-secondary').addClass('btn-success');
        $('#btx_input_call_notes').hide().val('');;
        $('#btx_input_comments').show();
      } 

      poplulate_agent_sales(targetsales,SPH);
			//btx_chosen_dispo_call_continue();
    }
		});



		//////////////////////////////////////////////////////////////////////////////////////
		////////////////// End - Submit and Continue button for direct hangup - //////////////////
		//////////////////////////////////////////////////////////////////////////////////////

		$("#viewScript").click(function () 
		{
			if(btx_to_expand_or_not){
				btx_expand_script_section();
			}
			$(".stuff").addClass('hidden');
			$('#btx-leads').hide();
			$("#btx-script").removeClass('hidden');
		});
		$("#viewForm").click(function () 
		{
			btx_reduce_script_section();
			$(".stuff").addClass('hidden');
			$('#btx-leads').hide();
			$("#btx-form").removeClass('hidden');
		});
		$("#viewLeads").click(function () 
		{
			btx_reduce_script_section();
			$(".stuff").addClass('hidden');
			//ishwari
			//02-aug-2018
			$('#btx-leads').show();
			$("#btx-leads").removeClass('hidden');
			CalLBacKsLisTCheck("yes","","");
			
		});
		$("#viewLog").click(function () 
		{
			VieWCalLLoG_custom();
			btx_reduce_script_section();
			$(".stuff").addClass('hidden');
			//ishwari
			//02-aug-2018
			$('#btx-leads').hide();
			$("#btx-log").removeClass('hidden');
			$('#call_log').html();

			
		});
		
		$("#btx_dtmf_button").click(function () 
    {
      btx_reduce_script_section();
      $(".stuff").addClass('hidden');
      $('#btx-leads').hide();
      conf_channels_detail('SHOW');
      $("#btx-dtmf").removeClass('hidden');
    });
		


		$("#viewSearch").click(function () 
		{
			btx_reduce_script_section();
			$(".stuff").addClass('hidden');
			$('#btx-leads').hide();
			$("#btx-search").removeClass('hidden');
       $('#btx_search_res').html('')
       $('#btx_search_phone').val("");
       $('#btx_search_lead_id').val("");
       $('#btx_search_vlc').val("");

		});
		
		
		
		$("#viewDial").click(function () 
		{
			
			$('#btx-leads').hide();
			btx_reduce_script_section();
			//document.vicidial_form.MDDiaLCodE.value = "1";
      document.vicidial_form.MDPhonENumbeR.value = "";
      document.vicidial_form.MDPhonENumbeRHiddeN.value = "";
      document.vicidial_form.MDLeadID.value = "";
      document.vicidial_form.MDType.value = "";
      $(".stuff").addClass('hidden');
      $("#btx-dial").removeClass('hidden');
      $("#btx_input_MDPhonENumbeR").val("");
    });
		$("#viewDNC").click(function () 
		{
			btx_reduce_script_section();
			$(".stuff").addClass('hidden');
			$('#btx-leads').hide();
			$("#btx-dnc").removeClass('hidden');
		});
		$("#viewSearch").click(function () 
		{
			btx_reduce_script_section();
			$(".stuff").addClass('hidden');
			$('#btx-leads').hide();
			$("#btx-search-lead").removeClass('hidden');
		});
		$("#btx-company_button").click(function () 
		{
			btx_reduce_script_section();
			$(".stuff").addClass('hidden');
			$('#btx-leads').hide();
      $("#btx-company").removeClass('hidden');

		});


    $('#btx-internal_chat_button').click(function()
    {
      btx_InternalChatContentsLoad('YES');
      $('#sidebaroverlaychat').show();
    }
    );
    

    $("#btx-view-agents").click(function () 
    {
      $('#sidebaroverlayagents').show();
      AgentsViewOpen('AgentViewSpan','open');
    });


    $("#btx-tech-info_button").click(function () 
    {
      btx_reduce_script_section();
      $(".stuff").addClass('hidden');
      $('#btx-leads').hide();
      $("#btx-tech-info").removeClass('hidden');
    });


    $("#btx-view-agent-notes").click(function () 
    {
      btx_reduce_script_section();
      $(".stuff").addClass('hidden');
      $('#btx-leads').hide();
      $("#btx-agent-notes").removeClass('hidden');
      populate_agent_notes();
    });


    $(".btx_transfer_button").click(function () 
    {
     btx_reduce_script_section();
     ShoWTransferMain('ON','YES','YES');
     $(".stuff").addClass('hidden');
     $('#btx-leads').hide();
     $("#btx_transfer_options").removeClass('hidden');

   });

    $(".btx-stats_button").click(function () 
    {
     poplulate_agent_stats()
     btx_reduce_script_section();
     $(".stuff").addClass('hidden');
     $('#btx-leads').hide();
     $("#btx-stats").removeClass('hidden');
   });
    $("#viewMap").click(function () 
    {
     btx_reduce_script_section();
     $(".stuff").addClass('hidden');
     $('#btx-leads').hide();
     $("#btx-map").removeClass('hidden');
   });
    $("#viewStats").click(function () 
    {
     btx_reduce_script_section();
     $(".stuff").addClass('hidden');
     $('#btx-leads').hide();
     $("#btx-stats").removeClass('hidden');
   });		
    $("#viewCompany").click(function () 
    {
     btx_reduce_script_section();
     $(".stuff").addClass('hidden');
     $('#btx-leads').hide();
     $("#btx-company").removeClass('hidden');
   });
    $("#viewChat").click(function () 
    {
     btx_reduce_script_section();
     $(".stuff").addClass('hidden');
     $('#btx-leads').hide();
     $("#btx-chat").removeClass('hidden');
   });
  });


function DispoFromScript(dispo) 
{
  dialedcall_send_hangup('','','','','YES');
  $('#normal-modal-outcome').hide();
  $('#autodispo-modal-outcome').show();
  setTimeout(() => {  
    hide_dial_next_button = 1;
    $("#btx_input_MDPhonENumbeR").val('');
    $('#btx_input_call_notes_dispo').val(document.vicidial_form.call_notes_dispo.value);
    $('#btx_transfer_restart_button').show();
    $('.hide_transfers').hide();
    $('#btx_transfer_extra_info').html('Please Select a Transfer Destination');
    $('#btx_transfer_main').show();
    $(".hangup_and_show_dispo").not( "#btx_transfer_leave" ).prop('disabled', false);
    document.vicidial_form.DispoSelection.value = dispo;
    document.vicidial_form.DispoSelectStop.checked = false;
    DispoSelect_submit('','','YES');  
    $('#submit_and_pause_button').prop("disabled", true);
    $('#btx_submit_and_continue').prop("disabled", true); 
    
    $("#btx_script_head_customer_name").html("");
        if (per_call_notes == 'ENABLED')
        {
            $('#btx_show_call_log_button').addClass('btn-secondary').removeClass('btn-success');
            $('#btx_show_comments_button').removeClass('btn-secondary').addClass('btn-success');
            $('#btx_input_call_notes').hide().val('');;
        } 
    $('#modal-outcome').modal('hide');
    $('#normal-modal-outcome').show();
    $('#autodispo-modal-outcome').hide();
    poplulate_agent_sales(targetsales,SPH);
  }, 2000);
}



function DispoPauseFromScript(dispo) 
{
  dialedcall_send_hangup('','','','','YES');
  $('#normal-modal-outcome').hide();
  $('#autodispo-modal-outcome').show();
  $("#btx_api_button_1").addClass("disabled");
  $("#btx_api_button_2").addClass("disabled");
  document.vicidial_form.DispoSelectStop.checked = true;
  setTimeout(() => {  
    hide_dial_next_button = 1;
    $("#btx_input_MDPhonENumbeR").val('');
    $('#btx_input_call_notes_dispo').val(document.vicidial_form.call_notes_dispo.value);
    $('#btx_transfer_restart_button').show();
    $('.hide_transfers').hide();
    $('#btx_transfer_extra_info').html('Please Select a Transfer Destination');
    $('#btx_transfer_main').show();
    $(".hangup_and_show_dispo").not( "#btx_transfer_leave" ).prop('disabled', false);
    document.vicidial_form.DispoSelection.value = dispo;
    document.vicidial_form.DispoSelectStop.checked = true;
    DispoSelect_submit('','','YES');  

      if ( auto_dial_level > 0 )
      {
      AutoDial_ReSume_PauSe("VDADpause");
    }
      if ((agent_pause_codes_active=='Y') || (agent_pause_codes_active=='FORCE'))
        {
           $('#modal-pause-codes').modal('toggle');
      // get the total number of selectable dispos
      // at the same time populate the dispo array with the selectable dispos
      var btx_pause_array = {};
      var btx_total_count_pause_codes = 0;
      while(btx_total_count_pause_codes < VD_pause_codes_ct){
        
        btx_pause_array[btx_total_count_pause_codes] = { "pause_name" : VARpause_code_names[btx_total_count_pause_codes], "pause_code" : VARpause_codes[btx_total_count_pause_codes] };
        btx_total_count_pause_codes++;
      }

      btx_pause_creation = btx_get_columns2(btx_total_count_pause_codes, "#pause_width");

      var btx_pause_codes = '';

      btx_current_pause = 0;
      for(var x = 0; x<btx_pause_creation.length; x++){
        btx_pause_codes += '<div class="col"><div class="btn-group-outcome">';
        for(var y = 0; y<btx_pause_creation[x]; y++){

          pause_name = btx_pause_array[btx_current_pause]['pause_name'];

          btx_pause_codes += '<button class="btn btn-success btn-block btx_pause_buttons" data-btx_pause_name="'+pause_name+'" data-btx_pause_code="'+btx_pause_array[btx_current_pause]['pause_code']+'" type="submit">'+pause_name+'</button>';
          btx_current_pause++;
          if(y+1==btx_pause_creation[x]){
            btx_pause_codes += '</div>';
          }
        }
        btx_pause_codes+='</div>';
      }

      $("#btx_pause_codes").html(btx_pause_codes);
    }
    $('#submit_and_pause_button').prop("disabled", true);
    $('#btx_submit_and_continue').prop("disabled", true); 
    
    $("#btx_script_head_customer_name").html("");
        if (per_call_notes == 'ENABLED')
        {
            $('#btx_show_call_log_button').addClass('btn-secondary').removeClass('btn-success');
            $('#btx_show_comments_button').removeClass('btn-secondary').addClass('btn-success');
            $('#btx_input_call_notes').hide().val('');;
        } 
    $('#modal-outcome').modal('hide');
    $('#normal-modal-outcome').show();
    $('#autodispo-modal-outcome').hide();
    poplulate_agent_sales(targetsales,SPH);
  }, 2000);
}

    // get the number of columns that need to be build for the dispo or pause or any other screen using this function
    function btx_get_columns2(count, id){
      // check the count and based on it decide which class to assign to the dispo content for the width
      // from 0 to 20
      if(count > 0 && count < 15){
        $(id).addClass("dispos_0_14");
      }
      // from 15 to 30
      if(count > 14 && count < 31){
        $(id).addClass("dispos_15_30");
      }
      // from 31 to 89 - after 89 it is very hard to represent dispos because of the viewable area, unless the dispos are two tiered
      if(count > 30){
        $(id).addClass("dispos_31_89");
      }

      var myArray = [];
      if(count > 20){
        
        var result = Math.floor(count/1);
        var i = 1;
        while(result>9){
          i++;
          result = Math.floor(count/i);
        }
        for(var x=0; x<i; x++){
          myArray[x] = result;
        }
        var left_over = count - (i*result);
        for(var y=0; y<left_over; y++){
          myArray[y]+=1;
        }
      }
      if(count <= 20){
        var result = Math.floor(count/1);
        var i = 1;
        while(result>4){
          i++;
          result = Math.floor(count/i);
        }
        for(var x=0; x<i; x++){
          myArray[x] = result;
        }
        var left_over = count - (i*result);
        for(var y=0; y<left_over; y++){
          myArray[y]+=1;
        }
      }
      return myArray;
    }

	//~ function Load_external_content()
//~ {
      //~ $('#btx-log').load('#call_log').hide().fadeIn(3000);
//~ }
//~ setInterval('Load_external_content()', 5000);


//~ var timeout = setInterval(reloadChat, 5000);    
		//~ function reloadChat () {
			 //~ $('#call_log').load('#call_log');
		//~ }

//~ put function's from vicidial to make seprate file from vicidial.php
// ################################################################################
// View Customer lead information
function VieWLeaDInfO_btx(VLI_lead_id,VLI_cb_id,VLI_inbound_lead_search)
{
	button_click_log = button_click_log + "" + SQLdate + "-----VieWLeaDInfO---" + VLI_lead_id + " " + VLI_cb_id + " " + VLI_inbound_lead_search + "|";
	showDiv('LeaDInfOBox');
 $('#LeaDInfOSpan_btx').html('');
 $('#modal-default-info').modal('show');
  ////console.log('run '+VLI_lead_id);
  var xmlhttp=false;
  /*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		 @end @*/

    if (VLI_lead_id) {var lead_id_to_view = VLI_lead_id;} else {var lead_id_to_view=document.vicidial_form.lead_id.value;} 
    if (!xmlhttp && typeof XMLHttpRequest!='undefined')
    {
      xmlhttp = new XMLHttpRequest();
    }
    else
    {
      //console.log('error!!!!!')
    }
    if (xmlhttp) 
    { 
      RAview_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=LEADINFOview&format=text&user=" + user + "&pass=" + pass + "&conf_exten=" + session_id + "&extension=" + extension + "&protocol=" + protocol + "&lead_id=" + lead_id_to_view + "&disable_alter_custphone=" + disable_alter_custphone + "&campaign=" + campaign + "&callback_id=" + VLI_cb_id + "&inbound_lead_search=" + VLI_inbound_lead_search + "&manual_dial_filter=" + agentcall_manual + "&stage=<?php echo $HCwidth ?>";

		 	//~ alert(RAview_query);
		 	xmlhttp.open('POST', 'vdc_db_query_btx.php'); 
		 	xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		 	xmlhttp.send(RAview_query); 
		 	xmlhttp.onreadystatechange = function() 
		 	{ 
		 		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
		 		{
         document.getElementById('LeaDInfOSpan_btx').innerHTML = xmlhttp.responseText + "\n";
       }
     }
     delete xmlhttp;
   }
   else
   {
    //console.log('error 2 !!!!!')
  }
}

function VieWLeaDInfO_log(VLI_lead_id,VLI_cb_id,VLI_inbound_lead_search)
{
	
	button_click_log = button_click_log + "" + SQLdate + "-----VieWLeaDInfO---" + VLI_lead_id + " " + VLI_cb_id + " " + VLI_inbound_lead_search + "|";
	showDiv('LeaDInfOBox_log');
  $('#LeaDInfOSpan_btx').html('');
  var xmlhttp=false;
  /*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		 @end @*/
		 if (!xmlhttp && typeof XMLHttpRequest!='undefined')
		 {
		 	xmlhttp = new XMLHttpRequest();
		 }
		 if (xmlhttp) 
		 { 
		 	RAview_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=LEADINFOview&format=text&user=" + user + "&pass=" + pass + "&conf_exten=" + session_id + "&extension=" + extension + "&protocol=" + protocol + "&lead_id=" + VLI_lead_id + "&disable_alter_custphone=" + disable_alter_custphone + "&campaign=" + campaign + "&callback_id=" + VLI_cb_id + "&inbound_lead_search=" + VLI_inbound_lead_search + "&manual_dial_filter=" + agentcall_manual + "&stage=<?php echo $HCwidth ?>";
		 	xmlhttp.open('POST', 'vdc_db_query_btx.php'); 
		 	xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		 	xmlhttp.send(RAview_query); 
		 	xmlhttp.onreadystatechange = function() 
		 	{ 
		 		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
		 		{
				//	alert(xmlhttp.responseText);
				document.getElementById('LeaDInfOSpan_log').innerHTML = xmlhttp.responseText + "\n";
      }
    }
    delete xmlhttp;
  }
}

//ishwari
//19-july-2018
function VieWLeaDEdit(VLI_lead_id,VLI_cb_id,CB_callback_time,VLI_inbound_lead_search)
{


  $(".stuff").addClass('hidden');
  $('#btx-leads').hide();
  $("#lead_edit").removeClass('hidden'); 
  var edit = document.getElementById('lead_edit');
  var remove = document.getElementById('btx-leads');
	//remove.style.display = "none";
	//edit.style.display = "block";
  var cb_date_time = CB_callback_time;
  var original_selected_date =moment(cb_date_time, dateFormat);
  cb_date_time = cb_date_time.substring(0, cb_date_time.length-3); 


  var dateFormat = "DD-MM-YYYY";
  var CurrDate = new Date();


  
  dateCurr = moment(CurrDate, dateFormat);

  if (callback_days_limit == 0)
  {
    dateMax = moment(CurrDate, dateFormat).add(999, 'days');
  }
  else
  {
    dateMax = moment(CurrDate, dateFormat).add(callback_days_limit, 'days');  
  }


//////console.log(original_selected_date);
//////console.log(dateCurr);
//////console.log(dateMax);

$("#cb_time").datetimepicker({
  date: original_selected_date,
  minDate: dateCurr,
  maxDate: dateMax,
  stepping: 5,
  format: 'YYYY-MM-DD HH:mm' 
});


  //////console.log(cb_date_time);
//	var cb_date = cb_date_time.split(" ");
	//var cb_dates=cb_date[0];
	//var cb_time=cb_date[1];
	var id = VLI_cb_id;
//	$(function () {
	//	$('.datepicker').datepicker();
    //    $('.datepicker').on("change",function(){

		//	var selected = $(this).val();
	//		$('#CallBackDatEPrinT').html(selected);
	//		});
		//});

   edit.innerHTML =  "<div class=\"card\"><div class=\"card-header\"><i class=\"fas fa-building\"></i>&nbsp;Callback Time Edit</div><div class=\"card-body\"><input id='VLI_inbound_lead_search' type='hidden' value="+ VLI_inbound_lead_search +"><input id='VLI_lead_id' type='hidden' value=" + VLI_lead_id +"><input id='cb_id' type='hidden' value=" + id + "><div class=\"row form-group\"> <label class=\"col-5\">Current Callback Date:</label><div class=\"col-6\">"+cb_date_time+"</div></div><div class='row form-group'><label class=\"col-5\">New Callback Date / Time:</label><div class=\"col-6\"><div class='input-group'><input id='cb_time' type='text'  class=\"form-control\"><span class='input-group-addon'><i class='glyphicon glyphicon-time'></i></span></div></div></div><div class=\"row form-group\"><label  class=\"col-5\">My Callback Only:</label><div class=\"col-5\"><input id='CallBackOnlyMe54659' type='checkbox' value='1' checked></div></div><div class=\"row form-group\"><table class=\"table table-sm\" id=\"Current_callbacks_booked_span\"></table></div><center><button type='submit' onclick='edit_cb()' class='btn btn-success'>Confirm Change</button></center></div></div>";
	//~ alert(document.getElementById("CallBackDatESelectioE").value);
	//~ var callback_date=document.getElementById("CallBackDatESelectioE").value+" "+document.getElementById("CBT_hours").value+":"+document.getElementById("CBH_minutes").value;
	
 $("#cb_time").datetimepicker({
  date: original_selected_date,
  minDate: dateCurr,
  maxDate: dateMax,
  stepping: 5,
  format: 'YYYY-MM-DD HH:mm' 
});


 $('#cb_time').on('blur', function(){


      var url = "bluetelecoms/get_data/data.php"; // This is the file that handles the request
      $.ajax({
        url: url,
        type: 'post',
        data: {"query":"callbacks_set","user":user,"newcallbacktime":this.value},
        success: function(data_)
        {
          data = '';
                                if(data_)  //This is returned from the PHP request
                                {
                                  var c = 1;
                                  var listJson = JSON.parse(data_);
                                  $.each(listJson, function(i, item)
                                  {
                                    if (item == 0){
                                      data += '<tr class="table-success">';
                                    }
                                    else
                                    {
                                      data += '<tr class="table-danger">';
                                    }

                                    if (c==3)
                                    {
                                      data += '<td><b>><b></td><td><b>'+i+'</b></td>';
                                    }
                                    else
                                    {
                                      data += '<td><b><b></td><td>'+i+'</td>';
                                    }                                             

                                    if (item == 0){
                                      data += '<td>FREE</td></tr>';
                                    }
                                    else
                                    {
                                      data += '<td>CALLBACKS SET: '+item+'</td></tr>';
                                    }                                          

                                    c++;
                                  });  

                                }

                                $('#Current_callbacks_booked_span').html(data);
                              }

                            });


      
      if ($("#CallBackOnlyMe54659").prop('checked') == false)
      {
        $('#Current_callbacks_booked_span').html('');  
      }

    });

	 //~ var mycallback=document.getElementById("CBH_ampms").value;
  button_click_log = button_click_log + "" + SQLdate + "-----VieWLeaDInfO---" + VLI_lead_id + " " + VLI_cb_id + " " + VLI_inbound_lead_search + "|";



	//~ alert(document.vicidial_form.CallBackDatESelectioE.value);
	 //CallBackDatEForM = document.vicidial_form.CallBackDatESelectioE.value;
	 //~ callback_date=document.vicidial_form.callback_date.value;


	//~ showDiv('LeaDEditBox');
	
	
	//~ /*@cc_on @*/
		//~ /*@if (@_jscript_version >= 5)
		//~ // JScript gives us Conditional compilation, we can cope with old IE versions.
		//~ // and security blocked creation of the objects.
		 //~ try {
		  //~ xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 //~ } catch (e) {
		  //~ try {
		   //~ xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  //~ } catch (E) {
		   //~ xmlhttp = false;
		  //~ }
		 //~ }
		 //~ @end @*/

	//~ var xmlhttp=false;
	
		 //~ if (!xmlhttp && typeof XMLHttpRequest!='undefined')
		 //~ {
		 	//~ xmlhttp = new XMLHttpRequest();
		 //~ }
		 //~ if (xmlhttp) 
		 //~ { 

		 	//~ RAview_query1 = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=LEADEditview&format=text&user=" + user + "&pass=" + pass + "&conf_exten=" + session_id + "&extension=" + extension + "&protocol=" + protocol + "&lead_id=" + VLI_lead_id + "&disable_alter_custphone=" + disable_alter_custphone + "&campaign=" + campaign + "&callback_id=" + VLI_cb_id + "&inbound_lead_search=" + VLI_inbound_lead_search + "&manual_dial_filter=" + agentcall_manual + "&stage=<?php echo $HCwidth ?>&callback_date="+callback_date;
		 	//~ xmlhttp.open('POST', 'vdc_db_query.php'); 
		 	//~ xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		 	//~ xmlhttp.send(RAview_query1); 
		 	//~ xmlhttp.onreadystatechange = function() 
		 	//~ { 
		 		//~ if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
		 		//~ {
				//~ //	alert(xmlhttp.responseText);
				//~ document.getElementById('LeaDInfOSpan').innerHTML = xmlhttp.responseText + "\n";
			//~ }
		//~ }
		//~ delete xmlhttp;
	//~ }

}
function edit_cb(){
	


	var VLI_inbound_lead_search = document.getElementById('VLI_inbound_lead_search').value;
	var VLI_lead_id = document.getElementById('VLI_lead_id').value;
	var cb_id = document.getElementById('cb_id').value;
	var cb_time = document.getElementById('cb_time').value;
	
	if ($("#CallBackOnlyMe54659").prop('checked') == true){ var recipient='USERONLY';} else {var recipient='ANYONE';}
	var xmlhttp=false;
	
 if (!xmlhttp && typeof XMLHttpRequest!='undefined')
 {
  xmlhttp = new XMLHttpRequest();
}
if (xmlhttp) 
{ 

  RAview_query1 = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=LEADEditview&format=text&user=" + user + "&pass=" + pass + "&conf_exten=" + session_id + "&extension=" + extension + "&protocol=" + protocol + "&lead_id=" + VLI_lead_id + "&disable_alter_custphone=" + disable_alter_custphone + "&campaign=" + campaign + "&callback_id=" + cb_id + "&inbound_lead_search=" + VLI_inbound_lead_search + "&manual_dial_filter=" + agentcall_manual + "&stage=<?php echo $HCwidth ?>&callback_date="+cb_time+":00&recipient="+recipient;
  xmlhttp.open('POST', 'vdc_db_query_btx.php'); 
  xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
  xmlhttp.send(RAview_query1); 
  xmlhttp.onreadystatechange = function() 
  { 
   if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
   {
     var edit1 = document.getElementById('lead_edit');
     var remove1 = document.getElementById('btx-leads');
				//	//~ alert(xmlhttp.responseText);
					//remove1.style.display = "block";
					//edit1.style.display = "none";

          $(".stuff").addClass('hidden');
      //ishwari
      //02-aug-2018
      $('#btx-leads').show();
      $("#btx-leads").removeClass('hidden');
      CalLBacKsLisTCheck("yes","","");
					//~ var l = document.getElementById('future');
					//~ for(var i=0; i<5; i++){
					//~ l.click();
					//~ }
					
					if ($("#overdue").hasClass("active")) {
           CalLBacKsLisTCheck('','yes','');
         }
         else if($("#today").hasClass("active")){
          CalLBacKsLisTCheck('yes','','');
        }
        else{
          CalLBacKsLisTCheck('','','yes');
        }
      }

    }

    delete xmlhttp;
  }


}

$( document ).ready(function() {
	
  $("#queue_call").draggable({
    handle: ".modal-header"
  });
  $("#search_lead").draggable({
    handle: ".modal-header"
  });
  $("#modal-outcome").draggable({
    handle: ".modal-body"
  });

  $('#pills-profile-tab').click(function() {
   $('#pills-home').hide();
   $('#pills-profile').show();
 });
  $('#pills-home-tab').click(function() {

   $('#pills-home').show();
   $('#pills-profile').hide();
 });
  $('#pills-profile-tab2').click(function() {
   $('#pills-home').hide();
   $('#pills-profile').show();
 });
  $('#pills-home-tab2').click(function() {

   $('#pills-home').show();
   $('#pills-profile').hide();
 });
});

//end
// ################################################################################
// Request list of USERONLY callbacks for this agent
//ishwari
//18-july-2018



function CalLBacKsLisTCheck(today,overdue,future)
{
	
	if(today=="yes"){
		$("#today").addClass('active');
		$("#overdue").removeClass('active');
		$("#future").removeClass('active');
	}
	else if(overdue=="yes"){
		$("#overdue").addClass('active');
		$("#today").removeClass('active');
		$("#future").removeClass('active');
	}
	else{
		
		$("#future").addClass('active');
		$("#today").removeClass('active');
		$("#overdue").removeClass('active');
	}
	
	button_click_log = button_click_log + "" + SQLdate + "-----CalLBacKsLisTCheck---|";
	var move_on=1;
	if ( (AutoDialWaiting == 1) || (VD_live_customer_call==1) || (alt_dial_active==1) || (MD_channel_look==1) || (in_lead_preview_state==1) )
	{
		auto_pause_precall = "Y";
		if ( (auto_pause_precall == 'Y') && ( (agent_pause_codes_active=='Y') || (agent_pause_codes_active=='FORCE') ) && (AutoDialWaiting == 1) && (VD_live_customer_call!=1) && (alt_dial_active!=1) && (MD_channel_look!=1) && (in_lead_preview_state!=1) )
		{
			agent_log_id = AutoDial_ReSume_PauSe("VDADpause",'','','','','1',auto_pause_precall_code);
		}
		else
		{
			move_on=0;
			alert_box("<?php echo _QXZ("YOU MUST BE PAUSED TO CHECK CALLBACKS IN AUTO-DIAL MODE"); ?>");
			button_click_log = button_click_log + "" + SQLdate + "-----CheckCallbacksFailed---" + VDRP_stage + "|";
		}
	}
	if (move_on == 1)
	{
		LastCallbackViewed=1;

		showDiv('CallBacKsLisTBox');

		var xmlhttp=false;
		/*@cc_on @*/
			/*@if (@_jscript_version >= 5)
			// JScript gives us Conditional compilation, we can cope with old IE versions.
			// and security blocked creation of the objects.
			 try {
			  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
			  try {
			   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			  } catch (E) {
			   xmlhttp = false;
			  }
			 }
			 @end @*/
			 if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			 {
			 	xmlhttp = new XMLHttpRequest();
			 }
			 if (xmlhttp) 
			 { 
				  //ishwari
				 //31-july-2018
        var CBlist_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=CalLBacKLisT_today&campaign=" + campaign + "&format=text";

        if(today =='yes'){

         var CBlist_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=CalLBacKLisT_today&campaign=" + campaign + "&format=text";

       }
			//end
			else if(overdue=='yes'){
				
				var CBlist_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=CalLBacKLisT2&campaign=" + campaign + "&format=text";
				
			}
			else if(future=='yes'){
				
				var CBlist_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=CalLBacKLisT_future&campaign=" + campaign + "&format=text";
				
			}
			//	document.getElementById("debugbottomspan").innerHTML = "DEBUG OUTPUT: |" + CBlist_query + "|";
			xmlhttp.open('POST', 'vdc_db_query_btx.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(CBlist_query); 
			xmlhttp.onreadystatechange = function() 
			{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
				{
					//	alert(xmlhttp.responseText);
					var all_CBs = null;
					all_CBs = xmlhttp.responseText;
					var all_CBs_array=all_CBs.split("\n");
					var CB_calls = all_CBs_array[0];
					
					var loop_ct=0;
					var conv_start=0;
					var CB_HTML = "<table class=\"table table-sm\"><tr style='display:none;'><td><font class=\"log_title\">#</font></td><td align=\"center\"><font class=\"log_title\"> <?php echo _QXZ("CALLBACK DATE/TIME"); ?> </font></td><td align=\"center\"><font class=\"log_title\"> <?php echo _QXZ("NUMBER"); ?> </font></td><td align=\"center\"><font class=\"log_title\"> <?php echo _QXZ("INFO"); ?> </font></td><td align=\"center\"><font class=\"log_title\"> <?php echo _QXZ("FULL NAME"); ?> </font></td><td align=\"center\"><font class=\"log_title\">  <?php echo _QXZ("STATUS"); ?> </font></td><td align=\"center\"><font class=\"log_title\"> <?php echo _QXZ("CAMPAIGN"); ?> </font></td><td align=\"center\"><font class=\"log_title\"> <?php echo _QXZ("LAST CALL DATE/TIME"); ?> </font></td><td align=\"center\"><font class=\"log_title\"> <?php echo _QXZ("DIAL"); ?></font></td><td align=\"center\"><font class=\"log_title\"> <?php echo _QXZ("ALT"); ?> </font></td></tr>"
					
					while (loop_ct < CB_calls)
					{
						loop_ct++;
						loop_s = loop_ct.toString();
						if (loop_s.match(/1$|3$|5$|7$|9$/)) 
							{var row_color = '';}
						else
							{var row_color = '';}

						var conv_ct = (loop_ct + conv_start);
						var call_array = all_CBs_array[conv_ct].split("-!T-");
						var CB_name = call_array[0] + " " + call_array[1];
						var CB_phone = call_array[2];
						var CB_id = call_array[3];
						var CB_lead_id = call_array[4];
						var CB_campaign = call_array[5];
						var CB_status = call_array[6];
						var CB_lastcall_time = call_array[7];
						var CB_callback_time = call_array[8];
            var lead_status = call_array[11];
						
						var CB_comments = call_array[9];
            var callbackpriorityblob = 'text-warning';
            if (CB_comments.charAt(1) == '>') 
            {
              if (CB_comments.charAt(0) == '1') {var callbackpriorityblob = 'text-success';}
              if (CB_comments.charAt(0) == '3') {var callbackpriorityblob = 'text-danger';}
              CB_comments = CB_comments.substring(2);
            }

            var CB_dialable = call_array[10];
            var CB_comments_ten = CB_comments;
            if (CB_comments_ten.length > 10)
            {
             CB_comments_ten = CB_comments_ten.substr(0,10);
             CB_comments_ten = CB_comments_ten + '...';
           }

            var CB_comments_50 = CB_comments;
            if (CB_comments_50.length > 50)
            {
             CB_comments_50 = CB_comments_50.substr(0,50);
             CB_comments_50 = CB_comments_50 + '...';
           }

           if (CB_dialable > 0)
           {



if (btx_extend_callback_display=='YES')

            {
              CB_HTML = CB_HTML + "<tr><td style='font-size:14px;text-align:right; width:5%;'><i class=\"fas fa-dot-circle "+callbackpriorityblob+" \"></i></td><td style='font-size:14px;text-align:right;width:25%'><b>" + CB_callback_time + "</b></td><td style='font-size:14px;text-align:right;width:20%'>" + CB_campaign + "</td><td style='font-size:14px;text-align:left;width:30%'>&nbsp;&nbsp;" + CB_name + "</td><td style='width:5%;'><font class=\"log_text\"><a data-toggle='modal' data-target='#modal-default-previous' title='Call' class=\"btn btn-sm btn-success\"  href=\"#\" onclick=\"new_callback_call('" + CB_id + "','" + CB_lead_id + "','MAIN');return false;\"><i class=\"fas fa-phone fa-fw DisableWhenNotPaused\"></i></a></font></td> <td style='width:5%;'><font class=\"log_text\"> <a data-toggle='modal' data-target='#modal-default-info' title='Info' class=\"btn btn-sm btn-primary\"  href=\"#\" onclick=\"VieWLeaDInfO_btx('" + CB_lead_id + "','" + CB_id + "');return false;\"><i class=\"fas fa-search fa-fw\"></i></a></font></td> <td style='width:5%;'><font class=\"log_text\"><a  title='Edit' class=\"btn btn-sm btn-success\"  href=\"#\" onclick=\"VieWLeaDEdit('" + CB_lead_id + "','" + CB_id + "','" + CB_callback_time + "');return false;\"return false;\"><i class=\"fas fa-edit fa-fw\"></i></a></font></td><td style='width:5%;' ><font class=\"log_text\"><a class=\"btn btn-sm btn-danger\" href=\"#\"  title='Delete' onclick=\"$('#confirm_callback_remove').modal('show'); Delete_callback_call_set_button('" + CB_lead_id + "','" + CB_id + "'); \"><i class=\"fas fa-trash fa-fw\"></i></a></font></td><td align=\"right\" style='display:none;'><font class=\"log_text\"><a href=\"#\" onclick=\"new_callback_call('" + CB_id + "','" + CB_lead_id + "','ALT');return false;\"><?php echo _QXZ("ALT"); ?></a>&nbsp;</font></td></tr>";

              CB_HTML = CB_HTML + "<tr><td style='font-size:10px;text-align:right; width:5%;'></td><td style='font-size:10px;text-align:right;width:10%'> <button type=\"button\" class=\"btn btn-primary btn-sm\">"+lead_status+"</button></td><td style='font-size:14px;text-align:left;width:70%' colspan='6'>"+CB_comments_50+"</td></tr>";
            }
            else {					
            //ishwari
							//add info
							//-july-2018
							CB_HTML = CB_HTML + "<tr><td style='font-size:14px;text-align:right; width:5%;'><i class=\"fas fa-dot-circle "+callbackpriorityblob+" \"></i></td><td style='font-size:14px;text-align:right;width:25%'><b>" + CB_callback_time + "</b></td><td style='font-size:14px;text-align:right;width:20%'>" + CB_campaign + "</td><td style='font-size:14px;text-align:left;width:30%'>&nbsp;&nbsp;" + CB_name + "</td><td style='width:5%;'><font class=\"log_text\"><a data-toggle='modal' data-target='#modal-default-previous' title='Call' class=\"btn btn-sm btn-success\"  href=\"#\" onclick=\"new_callback_call('" + CB_id + "','" + CB_lead_id + "','MAIN');return false;\"><i class=\"fas fa-phone fa-fw DisableWhenNotPaused\"></i></a></font></td> <td style='width:5%;'><font class=\"log_text\"> <a data-toggle='modal' data-target='#modal-default-info' title='Info' class=\"btn btn-sm btn-primary\"  href=\"#\" onclick=\"VieWLeaDInfO_btx('" + CB_lead_id + "','" + CB_id + "');return false;\"><i class=\"fas fa-search fa-fw\"></i></a></font></td> <td style='width:5%;'><font class=\"log_text\"><a  title='Edit' class=\"btn btn-sm btn-success\"  href=\"#\" onclick=\"VieWLeaDEdit('" + CB_lead_id + "','" + CB_id + "','" + CB_callback_time + "');return false;\"return false;\"><i class=\"fas fa-edit fa-fw\"></i></a></font></td><td style='width:5%;' ><font class=\"log_text\"><a class=\"btn btn-sm btn-danger\" href=\"#\"  title='Delete' onclick=\"$('#confirm_callback_remove').modal('show'); Delete_callback_call_set_button('" + CB_lead_id + "','" + CB_id + "'); \"><i class=\"fas fa-trash fa-fw\"></i></a></font></td><td align=\"right\" style='display:none;'><font class=\"log_text\"><a href=\"#\" onclick=\"new_callback_call('" + CB_id + "','" + CB_lead_id + "','ALT');return false;\"><?php echo _QXZ("ALT"); ?></a>&nbsp;</font></td></tr>";
              }


              ///<td style='width:10%;'><font class=\"log_text\"><a data-toggle='modal' data-target='#modal-default-agent' title='Tarnsfer Agent' class=\"btn btn-sm btn-success\"  href=\"#\" onclick=\"XferAgentSelectLaunch();return false;\"><i class=\"fas fa-exchange-alt fa-fw\"></i></a></font></td><td style='width:10%;'><font class=\"log_text\"><a class=\"btn btn-sm btn-info\"  href=\"#\" title='Recall'  onclick=\"Re_callback_call('" + CB_lead_id + "','" + CB_id + "');return false;\"><i class=\"fas fa-phone fa-fw DisableWhenNotPaused\"></i></a></font></td> - removed by mike
            }
            else
            {
             CB_HTML = CB_HTML + "<tr bgcolor=\"" + row_color + "\"><td style='font-size:14px;text-align:right; width:5%;'><i class=\"fas fa-dot-circle "+callbackpriorityblob+" \"></i></td><td style='font-size:14px;text-align:right;width:25%'><b>" + CB_callback_time + "</b></td><td style='font-size:14px;text-align:right;width:20%'>" + CB_campaign + "</td><td style='font-size:14px;text-align:left;width:30%'>&nbsp;&nbsp;" + CB_name + "</td><td style='width:20%;'><font class=\"log_text\"></font>&nbsp;</td><td align=\"right\" style='display:none;'><font class=\"log_text\"><a href=\"#\" onclick=\"new_callback_call('" + CB_id + "','" + CB_lead_id + "','ALT');return false;\"><?php echo _QXZ("ALT"); ?></a>&nbsp;</font></td></tr>";
							//end
						}
					}
					
					CB_HTML = CB_HTML + "</table>";
					document.getElementById("CallBacKsLisT123").innerHTML = CB_HTML;
				}
			}
			delete xmlhttp;
		}
	}
	
}
//ishwari
//31-july-2018
function Delete_callback_call(VLI_lead_id,VLI_cb_id,VLI_inbound_lead_search)
{
	button_click_log = button_click_log + "" + SQLdate + "-----VieWLeaDInfO---" + VLI_lead_id + " " + VLI_cb_id + " " + VLI_inbound_lead_search + "|";
	$(document).ready(function(){

   $.ajax({
    url: 'bluetelecoms/delete.php',
    type: 'POST',
    dataType: 'html',
    data:{cb_id :VLI_cb_id,user:user},
    success: function(result) {
			//~ alert(result);			
			if ($("#overdue").hasClass("active")) {
       CalLBacKsLisTCheck('','yes','');
     }
     else if($("#today").hasClass("active")){
       CalLBacKsLisTCheck('yes','','');
     }
     else{
       CalLBacKsLisTCheck('','','yes');
     }

			//~ $("#callbacklist_refresh").hide().html(data).fadeIn('fast');
			//~ $('#callbacklist_refresh').load(document.URL + ' #callbacklist_refresh');
				//$("#callbacklist_refresh").refresh(" #callbacklist_refresh");
			}
    });

 });
	
	
}

//ishwari
//30-july-2018
function Re_callback_call(VLI_lead_id,VLI_cb_id,VLI_inbound_lead_search)
{
	//~ alert(VLI_cb_id);
	button_click_log = button_click_log + "" + SQLdate + "-----VieWLeaDInfO---" + VLI_lead_id + " " + VLI_cb_id + " " + VLI_inbound_lead_search + "|";
	$(document).ready(function(){
   $.ajax({
    url: 'recall.php',
    type: 'POST',
    dataType: 'html',
    data:{cb_id :VLI_cb_id,user:user},
    success: function(result) {
      $("#CallBacKsLisT").load(location.href + " #CallBacKsLisT");
      if ($("#overdue").hasClass("active")) {
       CalLBacKsLisTCheck('','yes','');
     }
     else if($("#today").hasClass("active")){
       CalLBacKsLisTCheck('yes','','');
     }
     else{
       CalLBacKsLisTCheck('','','yes');
     }
   }
 });
 });
	//~ showDiv('LeaDEditBox');

	var xmlhttp=false;
	
}
//end


function test_mode(on){


	if (on =='on')
	{	
		$('.bt-content').css({opacity: 0.5});
	}
	else if (on =='full')
  { 
    $('.bt-content').css({opacity: 0});
  }
  else
  {
    $('.bt-content').css({opacity: 1});
  }
}
// ################################################################################
// filter manual dialstring and pass on to originate call

function SendManualDial(taskFromConf,SMDclick)
{
	conf_dialed=1;
	var sending_group_alias = 0;
		// Dial With Customer button
		if (taskFromConf == 'YES')
		{
			xfer_in_call=1;
			agent_dialed_number='1';
			agent_dialed_type='XFER_3WAY';

			if (three_way_record_stop == 'Y')
			{
				conf_send_recording('StopMonitorConf', session_id, recording_filename,'','','');
        api_logout_flag			}

        document.getElementById("DialWithCustomer").innerHTML ="<i class=\"fas fa-hashtag fa-5x\"></i><br><br><button class=\"btn btn-default btn-sm\" style=\"padding:0px;\" disabled>External Number</button></a>";

        document.getElementById("ParkCustomerDial").innerHTML ="<img src=\"./images/<?php echo _QXZ("vdc_XB_parkcustomerdial_OFF.gif") ?>\" border=\"0\" alt=\"Park Customer Dial\" style=\"vertical-align:middle\" /></a>";

			//~ var manual_number = document.vicidial_form.xfernumber.value;
			var manual_number = document.getElementById('xfernumber').value;
			
			var manual_number_hidden = document.vicidial_form.xfernumhidden.value;
			if ( (manual_number.length < 1) && (manual_number_hidden.length > 0) )
				{manual_number=manual_number_hidden;}
			var manual_string = manual_number.toString();
			var dial_conf_exten = session_id;
			threeway_cid = '';
			if (three_way_call_cid == 'CAMPAIGN')
				{threeway_cid = campaign_cid;}
			if (three_way_call_cid == 'AGENT_PHONE')
			{
				cid_lock=1;
				threeway_cid = outbound_cid;
			}
			if (three_way_call_cid == 'CUSTOMER')
			{
				cid_lock=1;
				threeway_cid = document.vicidial_form.phone_number.value;
			}
			if (three_way_call_cid == 'CUSTOM_CID')
				{threeway_cid = document.vicidial_form.security_phrase.value;}
			if (three_way_call_cid == 'AGENT_CHOOSE')
			{
				cid_lock=1;
				threeway_cid = cid_choice;
				if (active_group_alias.length > 1)
					{var sending_group_alias = 1;}
			}
		}
		else
		{
			//~ var manual_number = document.vicidial_form.xfernumber.value;
			var manual_number = document.getElementById('xfernumber').value;
			var manual_string = manual_number.toString();
			var threeway_cid='1';
			if (manual_dial_cid == 'AGENT_PHONE')
			{
				cid_lock=1;
				threeway_cid = outbound_cid;
			}
		}

		var regXFvars = new RegExp("XFER","g");
		if (manual_string.match(regXFvars))
		{
			var donothing=1;
		}
		else
		{
			if ( (document.vicidial_form.xferoverride.checked==false) || (manual_dial_override_field == 'DISABLED') )
			{
				if (three_way_dial_prefix == 'X') {var temp_dial_prefix = '';}
				else {var temp_dial_prefix = three_way_dial_prefix;}
				if (omit_phone_code == 'Y') {var temp_phone_code = '';}
				else {var temp_phone_code = document.vicidial_form.phone_code.value;}

				// append dial prefix if phone number is greater than 7 digits on non-AGENTDIRECT calls
				if ( (manual_string.length > 7) && (xfer_agent_selected < 1) )
					{manual_string = temp_dial_prefix + "" + temp_phone_code + "" + manual_string;}
			}
			else
				{agent_dialed_type='XFER_OVERRIDE';}
			// due to a bug in Asterisk, these call variables do not actually work
			call_variables = '__vendor_lead_code=' + document.vicidial_form.vendor_lead_code.value + ',__lead_id=' + document.vicidial_form.lead_id.value;
		}
		var sending_preset_name = document.vicidial_form.xfername.value;

		if (SMDclick=='YES')
			{button_click_log = button_click_log + "" + SQLdate + "-----SendManualDial---" + taskFromConf + " " + agent_dialed_type + " " + manual_string + " " + three_way_call_cid + " " + threeway_cid + " " + dial_conf_exten + " " + sending_preset_name + " ";}

		agent_events('3way_start', agent_dialed_type + ' ' + manual_string);

		if (taskFromConf == 'YES')
		{
			// give extra time for custom fields to commit before consultative transfers
			if ( (document.vicidial_form.consultativexfer.checked==true) && (custom_fields_enabled > 0) && (consult_custom_delay > 0) )
			{
				if (consult_custom_wait >= consult_custom_delay)
				{
					consult_custom_go = 1;
					consult_custom_wait = 0;
				}
				else
				{
					CustomerData_update('NO');
					consult_custom_wait++;
					consult_custom_sent++;
				}
			}
			else
			{
				consult_custom_go = 1;
				consult_custom_wait = 0;
			}

			if (consult_custom_go > 0)
			{
				basic_originate_call(manual_string,'NO','YES',dial_conf_exten,'NO',taskFromConf,threeway_cid,sending_group_alias,'',sending_preset_name,call_variables);
			}
		}
		else
			{basic_originate_call(manual_string,'NO','NO','','','',threeway_cid,sending_group_alias,sending_preset_name,call_variables);}
		
		MD_ring_secondS=0;
		
	//	var targetElement = document.getElementById("modal-transfer");
	//	addClass(targetElement,"hide");
	//	removeClass(targetElement,"show");

  var xfernumber = document.getElementById("xfernumber");
  xfernumber.value = '';
		//~ var transfer_call = document.getElementById('modal-transfer');
		//~ transfer_call.style.display = 'none';
		
	}


  function addClass(element,className) {
    var currentClassName = element.getAttribute("class");
    if (typeof currentClassName!== "undefined" && currentClassName) {
      element.setAttribute("class",currentClassName + " "+ className);
    }
    else {
      element.setAttribute("class",className); 
    }
  }

  function removeClass(element,className) {
    var currentClassName = element.getAttribute("class");
    if (typeof currentClassName!== "undefined" && currentClassName) {

      var class2RemoveIndex = currentClassName.indexOf(className);
      var class2Remove = currentClassName.substr(class2RemoveIndex, className.length);

      var updatedClassName = currentClassName.replace(class2Remove,"").trim();

      element.setAttribute("class",updatedClassName);
    }
    else {
      element.removeAttribute("class");   
    } 
  }
    // Refresh the call log display
    function VieWCalLLoG_custom(logdate,formdate)
    {
     button_click_log = button_click_log + "" + SQLdate + "-----VieWCalLLoG---" + logdate + " " + formdate + "|";
     var move_on=1;
     if ( (AutoDialWaiting == 1) || (VD_live_customer_call==1) || (alt_dial_active==1) || (MD_channel_look==1) || (in_lead_preview_state==1) )
     {
      VDRP_stage = "PAUSED";
      auto_pause_precall = "Y";
      if ((auto_pause_precall == 'Y') && ( (agent_pause_codes_active=='Y') || (agent_pause_codes_active=='FORCE') ) && (AutoDialWaiting == 1) && (VD_live_customer_call!=1) && (alt_dial_active!=1) && (MD_channel_look!=1) && (in_lead_preview_state!=1) )
      {
       agent_log_id = AutoDial_ReSume_PauSe("VDADpause",'','','','','1',auto_pause_precall_code);
     }
     else
     {
       move_on=0;
       alert_box("<?php echo _QXZ("YOU MUST BE PAUSED TO VIEW YOUR CALL LOG"); ?>");
       button_click_log = button_click_log + "" + SQLdate + "-----LogViewFailed---" + VDRP_stage + "|";
			//	alert("debug: " + AutoDialWaiting + "|" + VD_live_customer_call + "|" + alt_dial_active + "|" + MD_channel_look + "|" + in_lead_preview_state);
		}
	}

	if (formdate=='form')
		{logdate = document.vicidial_form.calllogdate.value;}

	if (typeof logdate != 'undefined')
	{
			var validformat=/^\d{4}\-\d{2}\-\d{2}$/ //Basic check for format validity YYYY-MM-DD
			var returnval=false
			if (!validformat.test(logdate))
			{
				move_on=0;
				alert_box("<?php echo _QXZ("Invalid Date Format. Please correct and submit again."); ?>")
				button_click_log = button_click_log + "" + SQLdate + "-----LogViewInvalid---" + logdate + "|";
			}
			else
				{ //Detailed check for valid date ranges
					var monthfield=logdate.split("-")[1]
					var dayfield=logdate.split("-")[2]
					var yearfield=logdate.split("-")[0]
					var dayobj = new Date(yearfield, monthfield-1, dayfield)
					if ((dayobj.getMonth()+1!=monthfield)||(dayobj.getDate()!=dayfield)||(dayobj.getFullYear()!=yearfield))
					{
						move_on=0;
						alert_box("<?php echo _QXZ("Invalid Day, Month, or Year range detected. Please correct and submit again."); ?>")
						button_click_log = button_click_log + "" + SQLdate + "-----LogViewInvalid2---" + logdate + "|";
					}
				}
			}

			if (move_on == 1)
			{
				showDiv('CalLLoGDisplaYBox');

				var xmlhttp=false;
				/*@cc_on @*/
			/*@if (@_jscript_version >= 5)
			// JScript gives us Conditional compilation, we can cope with old IE versions.
			// and security blocked creation of the objects.
			 try {
			  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
			  try {
			   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			  } catch (E) {
			   xmlhttp = false;
			  }
			 }
			 @end @*/
			 if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			 {
			 	xmlhttp = new XMLHttpRequest();
			 }
			 if (xmlhttp) 
			 { 
			 	RAview_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=CALLLOGview&format=text&user=" + user + "&pass=" + pass + "&conf_exten=" + session_id + "&extension=" + extension + "&protocol=" + protocol + "&date=" + logdate + "&disable_alter_custphone=" + disable_alter_custphone +"&campaign=" + campaign + "&manual_dial_filter=" + agentcall_manual + "&stage=<?php echo $HCwidth ?>";
			 	xmlhttp.open('POST', 'callback.php'); 
			 	xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			 	xmlhttp.send(RAview_query); 
			 	xmlhttp.onreadystatechange = function() 
			 	{ 
			 		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			 		{
					//	alert(xmlhttp.responseText);
					document.getElementById('CallLogSpancustom').innerHTML = xmlhttp.responseText + "\n";
          $('#btx-log td').attr('style','vertical-align: middle').addClass('text-small');
        }
      }
      delete xmlhttp;
    }
  }
}

function start_all_refresh()
{
  if (VICIDiaL_closer_login_checked==0)
  {
   hideDiv('NothingBox');
   hideDiv('AlertBox');
		//	hideDiv('NothingBox2');
   hideDiv('ScriptTopBGspan');
   hideDiv('CBcommentsBox');
   hideDiv('EAcommentsBox');
   hideDiv('EAcommentsMinBox');
   hideDiv('HotKeyActionBox');
   hideDiv('HotKeyEntriesBox');
   hideDiv('ViewCommentsBox');
   hideDiv('MainPanel');
   hideDiv('MainCommit');
   hideDiv('ScriptPanel');
   hideDiv('ScriptRefresH');
   hideDiv('EmailPanel');
   hideDiv('EmailRefresH');
   hideDiv('CustomerChatPanel');
   hideDiv('CustomerChatRefresH');
   hideDiv('InternalChatPanel');
   hideDiv('FormPanel');
   hideDiv('FormRefresH');
   hideDiv('DispoSelectBox');
   hideDiv('LogouTBox');
   hideDiv('AgenTDisablEBoX');
   hideDiv('SysteMDisablEBoX');
   hideDiv('CustomerGoneBox');
   hideDiv('NoneInSessionBox');
   hideDiv('WrapupBox');
   hideDiv('FSCREENWrapupBox');
   hideDiv('TransferMain');
   hideDiv('WelcomeBoxA');
   hideDiv('CallBackSelectBox');
   hideDiv('SBC_timezone_span');
   hideDiv('DispoButtonHideA');
   hideDiv('DispoButtonHideB');
   hideDiv('DispoButtonHideC');
   hideDiv('CallBacKsLisTBox');
   hideDiv('NeWManuaLDiaLBox');
   hideDiv('PauseCodeSelectBox');
   hideDiv('PauseCodeMgrAprBox');
   hideDiv('PresetsSelectBox');
   hideDiv('GroupAliasSelectBox');
   hideDiv('DiaLInGrouPSelectBox');
   hideDiv('AgentViewSpan');
   hideDiv('AgentXferViewSpan');
   hideDiv('TimerSpan');
   hideDiv('CalLLoGDisplaYBox');
   hideDiv('CalLNotesDisplaYBox');
   hideDiv('SearcHForMDisplaYBox');
   hideDiv('SearcHResultSDisplaYBox');
   hideDiv('SearcHContactsDisplaYBox');
   hideDiv('SearcHResultSContactsBox');
   hideDiv('LeaDInfOBox');
   hideDiv('agentdirectlink');
   hideDiv('blind_monitor_notice_span');
   hideDiv('post_phone_time_diff_span');
   hideDiv('ivrParkControl');
   hideDiv('InvalidOpenerSpan');
   hideDiv('OtherTabCommentsSpan');
   hideDiv('AgentTimeDisplayBox');
   if (launch_scb_force_dial < 1)
    {hideDiv('SCForceDialBox');}
  else
    {VieWCBForcedDialInfO();}
  if (deactivated_old_session < 1)
    {hideDiv('DeactivateDOlDSessioNSpan');}
  if (is_webphone!='Y')
    {hideDiv('webphoneSpan');}
  if (view_calls_in_queue_launch != '1')
    {hideDiv('callsinqueuedisplay');}
  if ('x'=='x')
    {hideDiv('CallbacksButtons');}
  if (email_enabled < 1)
    {hideDiv('AgentStatusEmails');}
  if (allow_alerts < 1)
    {hideDiv('AgentAlertSpan');}
  if (allow_alerts < 1)
    {hideDiv('AgentAlertSpan');}
		//	if ( (agentcall_manual != '1') && (starting_dial_level > 0) )
   if (agentcall_manual != '1')
    {hideDiv('ManuaLDiaLButtons');}
  if (agent_call_log_view != '1')
  {
    hideDiv('CallNotesButtons');
    hideDiv('CallLogButtons');
  }
  if (callholdstatus != '1')
    {hideDiv('AgentStatusCalls');}
  if (agentcallsstatus != '1')
    {hideDiv('AgentStatusSpan');}
  if ( ( (auto_dial_level > 0) && (dial_method != "INBOUND_MAN") ) || (manual_dial_preview < 1) )
    {clearDiv('DiaLLeaDPrevieW');}
  if (alt_phone_dialing != 1)
    {clearDiv('DiaLDiaLAltPhonE');}
  if (pause_after_next_call != 'ENABLED')
    {clearDiv('NexTCalLPausE');}
  if (volumecontrol_active != '1')
    {hideDiv('VolumeControlSpan');}
  if ( (DefaulTAlTDiaL == '1') || (alt_number_dialing == 'SELECTED') || (alt_number_dialing == 'SELECTED_TIMER_ALT') || (alt_number_dialing == 'SELECTED_TIMER_ADDR3') )
    {document.vicidial_form.DiaLAltPhonE.checked=true;}
  if (agent_status_view != '1')
    {document.getElementById("AgentViewLink").innerHTML = "";}
  if (dispo_check_all_pause == '1')
    {document.vicidial_form.DispoSelectStop.checked=true;}
  if (agent_xfer_consultative < 1)
    {hideDiv('consultative_checkbox');}
  if (agent_xfer_dial_override < 1)
    {hideDiv('dialoverride_checkbox');}
  if (agent_xfer_vm_transfer < 1)
    {hideDiv('DialBlindVMail');}
  if (agent_xfer_blind_transfer < 1)
    {hideDiv('DialBlindTransfer');}
  if (agent_xfer_dial_with_customer < 1)
    {hideDiv('DialWithCustomer');}
  if (agent_xfer_park_customer_dial < 1)
    {hideDiv('ParkCustomerDial');}
  if (agent_xfer_park_3way < 1)
    {hideDiv('ParkXferLine');}
  if (agent_screen_time_display == 'DISABLED')
    {hideDiv('AgentTimeSpan');}
  if (AllowManualQueueCallsChoice == '1')
    {document.getElementById("ManualQueueChoice").innerHTML = "<a href=\"#\" onclick=\"ManualQueueChoiceChange('1');return false;\"><?php echo _QXZ("Manual Queue is Off"); ?></a><br />";}
  if (qc_enabled < 1)
    {document.getElementById("viewcommentsdisplay").innerHTML = "";}

  if ( (manual_dial_search_checkbox == 'SELECTED') || (manual_dial_search_checkbox == 'SELECTED_RESET') || (manual_dial_search_checkbox == 'SELECTED_LOCK') )
    {document.vicidial_form.LeadLookuP.checked=true;}
  else
    {document.vicidial_form.LeadLookuP.checked=false;}

  if ( (agent_pause_codes_active=='Y') || (agent_pause_codes_active=='FORCE') )
  {
    document.getElementById("PauseCodeLinkSpan").innerHTML = "<a href=\"#\" onclick=\"PauseCodeSelectContent_create('YES');return false;\"><?php echo _QXZ("ENTER A PAUSE CODE"); ?></a>";
  }
  if (VICIDiaL_allow_closers < 1)
  {
    document.getElementById("LocalCloser").style.visibility = 'hidden';
  }
  document.getElementById("sessionIDspan").innerHTML = session_id;
  if ( (LIVE_campaign_recording == 'NEVER') || (LIVE_campaign_recording == 'ALLFORCE') )
  {
    document.getElementById("RecorDControl").innerHTML = "<img src=\"./images/<?php echo _QXZ("vdc_LB_startrecording_OFF.gif"); ?>\" border=\"0\" alt=\"Start Recording\" />";
  }
  if (INgroupCOUNT > 0)
  {
    if (VU_closer_default_blended == 1)
     {document.vicidial_form.CloserSelectBlended.checked=true;
      $("#btx_CloserSelectBlended").prop('checked', true); }
      CloserSelectContent_create();
      showDiv('CloserSelectBox_btx');
      var CloserSelecting = 1;
      CloserSelectContent_create();
      $('#CloserSelectContent table td').width('50%');
      $("#CloserSelectContent table td").addClass('table-success');
      $("#CloserSelectContent table").addClass('table table-sm table-responsive');
      $("#CloserSelectContent table td:contains(GROUPS NOT SELECTED)").removeClass('table-success').text('Available Queues:').css('background-color','#dc3545');
      $("#CloserSelectContent table td:contains(-- ADD ALL --)").removeClass('table-success').addClass('table-danger');
      $("#CloserSelectContent table td:contains(SELECTED GROUPS)").removeClass('table-success').text('Active Queues:').css('background-color','#28a745');
      if (VU_agent_choose_ingroups_DV == "MGRLOCK")
       {

if ($('#CloserSelectContent').html().includes('Manager has selected groups for you') == true)
{
$('#CloserSelectContent').css('color', 'white');
}

        VU_agent_choose_ingroups_skip_count = mrglock_ig_select_ct;}
     agent_events('ingroup_screen_open', '', aec);   aec++;
   }
   else
   {
    hideDiv('CloserSelectBox_btx'); hideDiv('CloserSelectBox');
    agent_events('ingroup_screen_closed', '', aec);   aec++;
    MainPanelToFront();
    var CloserSelecting = 0;
    if ( (dial_method == "INBOUND_MAN") && (MI_PAUSE != '1') )
    {
     dial_method = "MANUAL";
     auto_dial_level=0;
     starting_dial_level=0;
     document.getElementById("DiaLControl").innerHTML = DiaLControl_manual_HTML;
   }
 }
 if (territoryCOUNT > 0)
 {
  showDiv('TerritorySelectBox');
  var TerritorySelecting = 1;
  TerritorySelectContent_create();
  if (agent_select_territories == "MGRLOCK")
   {agent_select_territories_skip_count=4;}
 agent_events('territory_screen_open', '', aec);   aec++;
}
else
{
  hideDiv('TerritorySelectBox');
  agent_events('territory_screen_closed', '', aec);   aec++;
  MainPanelToFront();
  var TerritorySelecting = 0;
}
if ( (VtigeRLogiNScripT == 'Y') && (VtigeREnableD > 0) )
{
  document.getElementById("ScriptContents").innerHTML = "<iframe src=\"" + VtigeRurl + "/index.php?module=Users&action=Authenticate&return_module=Users&return_action=Login&user_name=" + user + "&user_password=" + orig_pass + "&login_theme=softed&login_language=en_us\" style=\"background-color:transparent;z-index:17;\" scrolling=\"auto\" frameborder=\"0\" allowtransparency=\"true\" id=\"popupFrame\" name=\"popupFrame\" width=\"" + script_width + "px\" height=\"" + script_height + "px\"> </iframe> ";
}
if ( (VtigeRLogiNScripT == 'NEW_WINDOW') && (VtigeREnableD > 0) )
{
  var VtigeRall = VtigeRurl + "/index.php?module=Users&action=Authenticate&return_module=Users&return_action=Login&user_name=" + user + "&user_password=" + orig_pass + "&login_theme=softed&login_language=en_us";

  VtigeRwin =window.open(VtigeRall, web_form_target,'toolbar=1,location=1,directories=1,status=1,menubar=1,scrollbars=1,resizable=1,width=700,height=480');

  VtigeRwin.blur();
}
if ( (crm_popup_login == 'Y') && (crm_login_address.length > 4) )
{
  var regWFAcustom = new RegExp("^VAR","ig");
  var TEMP_crm_login_address = URLDecode(crm_login_address,'YES');
  TEMP_crm_login_address = TEMP_crm_login_address.replace(regWFAcustom, '');
  TEMP_crm_login_address = TEMP_crm_login_address.replace(regLOCALFQDN, FQDN);

  var CRMwin = 'CRMwin';
  CRMwin = window.open(TEMP_crm_login_address, CRMwin,'toolbar=1,location=1,directories=1,status=1,menubar=1,scrollbars=1,resizable=1,width=700,height=480');

  CRMwin.blur();
}
if (INgroupCOUNT > 0)
{
  HidEGenDerPulldown();
}
if (is_webphone=='Y')
{
  NoneInSession();
  document.getElementById("NoneInSessionLink").innerHTML = "<a href=\"#\" onclick=\"NoneInSessionCalL('LOGIN');return false;\"><?php echo _QXZ("Call Agent Webphone"); ?> -></a>";

  var WebPhonEtarget = 'webphonewindow';

			//	WebPhonEwin =window.open(WebPhonEurl, WebPhonEtarget,'toolbar=1,location=1,directories=1,status=1,menubar=1,scrollbars=1,resizable=1,width=180,height=270');

			//	WebPhonEwin.blur();
    }

    if ( (ivr_park_call=='ENABLED') || (ivr_park_call=='ENABLED_PARK_ONLY') )
    {
      showDiv('ivrParkControl');
    }
    if (manual_dial_override_field == 'DISABLED')
      {document.getElementById("xferoverride").disabled = true;}

    <?php	echo $INSERT_window_onload; ?>

    VICIDiaL_closer_login_checked = 1;
  }
  else
  {
   var WaitingForNextStep=0;
   if ( (CloserSelecting==1) || (TerritorySelecting==1) )	{WaitingForNextStep=1;}
   if (open_dispo_screen==1)
   {
    wrapup_counter=0;
    if (wrapup_seconds > 0)	
    {
     if (wrapup_message.match(regWFS))
      {showDiv('FSCREENWrapupBox');  FSCREENup=1;}
    else
      {showDiv('WrapupBox');}
    document.getElementById("WrapupTimer").innerHTML = wrapup_seconds;
    wrapup_waiting=1;
  }
  CustomerData_update('NO');
  if (hide_gender < 1)
  {
   document.getElementById("GENDERhideFORie").innerHTML = '';
   document.getElementById("GENDERhideFORieALT").innerHTML = "<select size=\"1\" name=\"gender_list\" class=\"cust_form\" id=\"gender_list\"><option value=\"U\"><?php echo _QXZ("U - Undefined"); ?></option><option value=\"M\"><?php echo _QXZ("M - Male"); ?></option><option value=\"F\"><?php echo _QXZ("F - Female"); ?></option></select>";
 }
 ViewComments('OFF','OFF');

 if (script_top_dispo == 'Y')
 {
   script_span_zindex = document.getElementById("ScriptPanel").style.zIndex;
   showDiv('ScriptTopBGspan');
   document.getElementById("ScriptPanel").style.zIndex = 100;
 }
 showDiv('DispoSelectBox');
 DispoSelectContent_create('','ReSET');
 WaitingForNextStep=1;
 open_dispo_screen=0;
 LIVE_default_xfer_group = default_xfer_group;
 LIVE_campaign_recording = campaign_recording;
 LIVE_campaign_rec_filename = campaign_rec_filename;
 if (disable_alter_custphone!='HIDE')
   {document.getElementById("DispoSelectPhonE").innerHTML = dialed_number;}
 else
   {document.getElementById("DispoSelectPhonE").innerHTML = '';}
 if (auto_dial_level == 0)
 {
   if (document.vicidial_form.DiaLAltPhonE.checked==true)
   {
    reselect_alt_dial = 1;
    document.getElementById("DiaLControl").innerHTML = "<a href=\"#\" onclick=\"ManualDialNext('','','','','','0','','','YES');\"><img src=\"./images/<?php echo _QXZ("vdc_LB_dialnextnumber.gif"); ?>\" border=\"0\" alt=\"Dial Next Number\" /></a>";

    document.getElementById("MainStatuSSpan").innerHTML = "<?php echo _QXZ("Dial Next Call"); ?>";
  }
  else
  {
    reselect_alt_dial = 0;
  }
}

				// Submit custom form if it is custom_fields_enabled
				if (custom_fields_enabled > 0)
       {
				//	alert("IFRAME submitting!");
       customsubmit_trigger=1;
     }
     agent_events('dispo_screen_open', '', aec);   aec++;
   }
			// trigger custom form submit if standard form has already been submitted or 3 seconds have gone by
			if (customsubmit_trigger > 0)
      {
        if ( (updatelead_complete > 0) || (customsubmit_trigger > 2) )
        {
         button_click_log = button_click_log + "" + SQLdate + "-----CustomFormSubmit---" + updatelead_complete + " " + customsubmit_trigger + "|";
         customsubmit_trigger=0;
         vcFormIFrame.document.form_custom_fields.submit();
       }
       else
       {
         customsubmit_trigger++;
         button_click_log = button_click_log + "" + SQLdate + "-----CustomFormWait---" + updatelead_complete + " " + customsubmit_trigger + "|";
       }
     }

     if (UpdatESettingSChecK > 0)
     {
      UpdatESettingSChecK=0;
      UpdatESettingS();
    }
    if (AgentDispoing > 0)	
    {
      WaitingForNextStep=1;
      check_for_conf_calls(session_id, '0');
      AgentDispoing++;
			//	document.getElementById("debugbottomspan").innerHTML = "DISPO SECONDS " + AgentDispoing;

      if ( (dispo_max > 0) && (AgentDispoing > dispo_max) )
      {
       button_click_log = button_click_log + "" + SQLdate + "-----DispoMax---" + dispo_max + " " + dispo_max_dispo + "|";

       document.vicidial_form.DispoSelectStop.checked=true;
       document.vicidial_form.DispoSelection.value = dispo_max_dispo;
       DispoSelect_submit('1',dispo_max_dispo);
     }
   }
   if (VU_agent_choose_ingroups_skip_count > 0)
   {
    VU_agent_choose_ingroups_skip_count--;
    if (VU_agent_choose_ingroups_skip_count == 0)
     {CloserSelect_submit();
       hideDiv('CloserSelectBox_btx'); hideDiv('CloserSelectBox');}
     }
     if (agent_select_territories_skip_count > 0)
     {
      agent_select_territories_skip_count--;
      if (agent_select_territories_skip_count == 0)
       {TerritorySelect_submit();}
   }
   if (logout_stop_timeouts==1)	{WaitingForNextStep=1;}
   if ( (custchannellive < customer_gone_seconds) && (lastcustchannel.length > 3) && (no_empty_session_warnings < 1) && (document.vicidial_form.lead_id.value != '') && (currently_in_email_or_chat==0) ) 
    {CustomerChanneLGone();}
		//	document.getElementById("debugbottomspan").innerHTML = "custchannellive: " + custchannellive + " lastcustchannel.length: " + lastcustchannel.length + " no_empty_AGLogiN_warnings: " + no_empty_session_warnings + " lead_id: |" + document.vicidial_form.lead_id.value + "|";
   if ( (custchannellive < -10) && (lastcustchannel.length > 3) ) {ReChecKCustoMerChaN();}
   if ( (nochannelinsession > 16) && (check_n > 15) && (no_empty_session_warnings < 1) ) {NoneInSession();}
   if (external_transferconf_count > 0) {external_transferconf_count = (external_transferconf_count - 1);}

   if (WaitingForNextStep==0)
   {
    if (trigger_ready > 0)
    {
     trigger_ready=0;
     if (auto_resume_precall == 'Y')
      {AutoDial_ReSume_PauSe("VDADready");}
  }
				// check for live channels in conference room and get current datetime
				check_for_conf_calls(session_id, '0');
				// refresh agent status view
				if (agent_status_view_active > 0)
       {
         refresh_agents_view_btx('AgentViewStatus',agent_status_view);
       }
       if (view_calls_in_queue_active > 0)
       {
         refresh_calls_in_queue(view_calls_in_queue);
       }
       if (xfer_select_agents_active > 0)
       {
         refresh_agents_view_btx('AgentXferViewSelect',agent_status_view,agent_xfer_group_selected,agent_xfer_validation);
       }
				if (agentonly_callbacks == '1')
					{CB_count_check++;}

      if ( (AutoDialWaiting == 1) || (safe_pause_counter > 0) )
      {
       check_for_auto_incoming();
       safe_pause_counter=(safe_pause_counter - 1);
     }
				// look for a channel name for the manually dialed call
				if (MD_channel_look==1)
       {
         ManualDialCheckChanneL(XDcheck);
       }
       if ( (CB_count_check > 19) && (agentonly_callbacks == '1') )
       {
         CalLBacKsCounTCheck();
         CB_count_check=0;
       }
				if (chat_enabled=='1') // JOEJ - if chat is enabled, check if manager has sent message.
       {
         InternalChatsCheck();
       }
       if ( (even > 0) && (agent_display_dialable_leads > 0) )
       {
         DiaLableLeaDsCounT();
       }
       if (timer_alt_trigger > 0)
       {
         if (timer_alt_count < 1)
         {
          timer_alt_trigger=0;
          timer_alt_count=timer_alt_seconds;
          document.getElementById("timer_alt_display").innerHTML = '';
          if (alt_number_dialing == 'SELECTED_TIMER_ALT')
           {ManualDialOnly('ALTPhonE');}
         if (alt_number_dialing == 'SELECTED_TIMER_ADDR3')
           {ManualDialOnly('AddresS3');}
       }
       else
       {
        document.getElementById("timer_alt_display").innerHTML = " <?php echo _QXZ("Dial Countdown:"); ?> " + timer_alt_count + " &nbsp; " + last_mdtype;
        timer_alt_count--;
      }
    }


    if ( (manual_auto_next > 0) && (manual_auto_next_trigger > 0) && (document.getElementById("WrapupBox").style.visibility != 'visible') && (VD_live_customer_call!=1) && (alt_dial_active!=1) && (MD_channel_look!=1) && (in_lead_preview_state!=1) )
    {
     if ( (manual_auto_next_options == 'DEFAULT') || ( (manual_auto_next_options == 'PAUSE_NO_COUNT') && (VDRP_stage != 'PAUSED') ) )
     {
      if (manual_auto_next_count < 1)
      {
       manual_auto_next_trigger=0;
       manual_auto_next_count=manual_auto_next;
       document.getElementById("manual_auto_next_display").innerHTML = '';

       button_click_log = button_click_log + "" + SQLdate + "-----ManualAutoNext---" + manual_auto_next + " " + manual_auto_show + "|";

       ManualDialNext('','','','','','0','','','YES');
     }
     else
     {
       if (manual_auto_show == 'Y')
       {
        document.getElementById("manual_auto_next_display").innerHTML = " <?php echo _QXZ("Dial Next Countdown:"); ?> " + manual_auto_next_count + " &nbsp; ";
      }
      manual_auto_next_count--;
    }
  }
}				
if (VD_live_customer_call==1)
{
 VD_live_call_secondS++;
 document.vicidial_form.SecondS.value		= VD_live_call_secondS;
 document.getElementById("SecondSDISP").innerHTML = VD_live_call_secondS;
 if (CheckDEADcallON > 0 && currently_in_email_or_chat < 1)
 {
  CheckDEADcallCOUNT++;
  dead_trigger_count++;
					//	document.getElementById("debugbottomspan").innerHTML = "DEAD CALL SECONDS " + CheckDEADcallCOUNT + " " + dead_trigger_count;

          if ( (dead_trigger_seconds > 0) && (dead_trigger_count >= dead_trigger_seconds) && (dead_trigger_action != 'DISABLED') )
          {
           dead_trigger_first_ran++;

           if ( (dead_trigger_filename.length > 0) && ( (dead_trigger_action == 'AUDIO') || (dead_trigger_action == 'AUDIO_AND_URL') ) )
           {
            if ( (dead_trigger_first_ran < 2) || ( (dead_trigger_first_ran > 1) && ( (dead_trigger_repeat=='REPEAT_ALL') || (dead_trigger_repeat=='REPEAT_AUDIO') ) ) )
            {
             basic_originate_call(dead_trigger_filename,'NO','YES',session_id,'YES','','1','0','1');
             agent_events('dead_trigger_audio', CheckDEADcallCOUNT, aec);   aec++;
             button_click_log = button_click_log + "" + SQLdate + "-----DeadTriggerAudio---" + dead_trigger_action + " " + dead_trigger_count + " " + dead_trigger_first_ran + " " + CheckDEADcallCOUNT + "|";
           }
         }

         if ( (dead_trigger_action == 'URL') || (dead_trigger_action == 'AUDIO_AND_URL') )
         {
          if ( (dead_trigger_first_ran < 2) || ( (dead_trigger_first_ran > 1) && ( (dead_trigger_repeat=='REPEAT_ALL') || (dead_trigger_repeat=='REPEAT_URL') ) ) )
          {
           dead_trigger_url_send();

           agent_events('dead_trigger_url', CheckDEADcallCOUNT, aec);   aec++;
           button_click_log = button_click_log + "" + SQLdate + "-----DeadTriggerURL---" + dead_trigger_action + " " + dead_trigger_count + " " + dead_trigger_first_ran + " " + CheckDEADcallCOUNT + "|";
         }
       }
       dead_trigger_count=0;
     }

     if ( (dead_max > 0) && (CheckDEADcallCOUNT > dead_max) )
     {
       if (dead_to_dispo > 0)
       {
        button_click_log = button_click_log + "" + SQLdate + "-----DeadMaxOnly---" + dead_max + " " + dead_to_dispo + "|";
        dialedcall_send_hangup();
      }
      else
      {
        CustomerData_update('NO');
        if ( (per_call_notes == 'ENABLED') && (comments_dispo_screen != 'REPLACE_CALL_NOTES') )
        {
         var test_notesDE = document.vicidial_form.call_notes.value;
         if (test_notesDE.length > 0)
          {document.vicidial_form.call_notes_dispo.value = document.vicidial_form.call_notes.value}
      }
      button_click_log = button_click_log + "" + SQLdate + "-----DeadMaxDispo---" + dead_max + " " + dead_max_dispo + "|";

      dead_auto_dispo_count=4;
      dead_auto_dispo_finish=1;
      alt_phone_dialing=starting_alt_phone_dialing;
      alt_dial_active = 0;
      alt_dial_status_display = 0;
      document.vicidial_form.DispoSelection.value = dead_max_dispo;
      document.vicidial_form.DispoSelectStop.checked=true;
      dialedcall_send_hangup('NO', 'NO', dead_max_dispo);
      if (custom_fields_enabled > 0)
      {
       customsubmit_trigger=1;
     }
   }
 }
}
}
if (XD_live_customer_call==1)
{
 XD_live_call_secondS++;
 document.vicidial_form.xferlength.value		= XD_live_call_secondS;
}
if (customerparked==1)
{
 customerparkedcounter++;
					var parked_mm = Math.floor(customerparkedcounter/60);  // The minutes
					var parked_ss = customerparkedcounter % 60;              // The balance of seconds
					if (parked_ss < 10)
						{parked_ss = "0" + parked_ss;}
					var parked_mmss = parked_mm + ":" + parked_ss;
					document.getElementById("ParkCounterSpan").innerHTML = "<?php echo _QXZ("Time On Park:"); ?> " + parked_mmss;
       }
       if (customer_3way_hangup_counter_trigger > 0)
       {
         if (customer_3way_hangup_counter > customer_3way_hangup_seconds)
         {
          var customer_3way_timer_seconds = (XD_live_call_secondS - customer_3way_hangup_counter);
          customer_3way_hangup_process('DURING_CALL',customer_3way_timer_seconds);

          customer_3way_hangup_counter=0;
          customer_3way_hangup_counter_trigger=0;

          if (customer_3way_hangup_action=='DISPO')
          {
           customer_3way_hangup_dispo_message="<?php echo _QXZ("Customer Hung-up, 3-way Call Ended Automatically"); ?>";
           bothcall_send_hangup();
         }
       }
       else
       {
        customer_3way_hangup_counter++;
        document.getElementById("debugbottomspan").innerHTML = "<?php echo _QXZ("CUSTOMER 3WAY HANGUP"); ?> " + customer_3way_hangup_counter;
      }
    }
    if ( (update_fields > 0) && (update_fields_data.length > 2) )
    {
     UpdateFieldsData();
   }
   if ( (timer_action != 'NONE') && (timer_action.length > 3) && (timer_action_seconds <= VD_live_call_secondS) && (timer_action_seconds >= 0) )
   {
     TimerActionRun('','');
   }
   if (HKdispo_display > 0)
   {
     if ( (HKdispo_display <= 2) && (HKfinish==1) )
     {
      HKfinish=0;
      manual_auto_hotkey_wait=0;
      DispoSelect_submit();
					//	AutoDialWaiting = 1;
					//	AutoDial_ReSume_PauSe("VDADready");
        }
        if (HKdispo_display == 1)
        {
          if (hot_keys_active==1)
           {showDiv('HotKeyEntriesBox');}
         if (HKFSCREENup > 0)
           {hideDiv('FSCREENWrapupBox');   HKFSCREENup=0;}
         else
           {hideDiv('HotKeyActionBox');}
       }
       HKdispo_display--;
       if ( (wrapup_after_hotkey == 'ENABLED') && (wrapup_seconds > 0) )
       {
        document.getElementById("HKWrapupTimer").innerHTML = "<br /><?php echo _QXZ("Call Wrapup:"); ?> " + HKdispo_display + " <?php echo _QXZ("seconds remaining in wrapup"); ?>";
      }
    }
    if (dead_auto_dispo_count > 0)
    {
     if ( (dead_auto_dispo_count == 3) && (dead_auto_dispo_finish==1) )
     {
      dead_auto_dispo_finish=0;
      DispoSelect_submit('1',dead_max_dispo);
    }
    dead_auto_dispo_count--;
  }

  if ((all_record == 'YES') && (document.vicidial_form.lead_id.value > 0))
{
   if (all_record_count < allcalls_delay)
    {all_record_count++;}
  else
  {
    conf_send_recording('MonitorConf',session_id ,'','','');
    all_record = 'NO';
    all_record_count=0;
  }
}


if (active_display==1)
{
 check_s = check_n.toString();
 if ( (check_s.match(/00$/)) || (check_n<2) ) 
 {
						//	check_for_conf_calls();
         }
       }
       if (check_n<2) 
       {
       }
       else
       {
				//	check_for_live_calls();
       check_s = check_n.toString();
     }
     if ( (blind_monitoring_now > 0) && ( (blind_monitor_warning=='ALERT') || (blind_monitor_warning=='NOTICE') ||  (blind_monitor_warning=='AUDIO') || (blind_monitor_warning=='ALERT_NOTICE') || (blind_monitor_warning=='ALERT_AUDIO') || (blind_monitor_warning=='NOTICE_AUDIO') || (blind_monitor_warning=='ALL') ) )
     {
       if ( (blind_monitor_warning=='NOTICE') || (blind_monitor_warning=='ALERT_NOTICE') || (blind_monitor_warning=='NOTICE_AUDIO') || (blind_monitor_warning=='ALL') )
       {
        document.getElementById("blind_monitor_notice_span_contents").innerHTML = blind_monitor_message + "<br />";
        showDiv('blind_monitor_notice_span');
      }
      if (blind_monitoring_now_trigger > 0)
      {
        if ( (blind_monitor_warning=='ALERT') || (blind_monitor_warning=='ALERT_NOTICE')|| (blind_monitor_warning=='ALERT_AUDIO') || (blind_monitor_warning=='ALL') )
        {
         document.getElementById("blind_monitor_alert_span_contents").innerHTML = blind_monitor_message;
         showDiv('blind_monitor_alert_span');
         agent_events('blind_monitor_alert', '', aec);   aec++;
       }
       if ( (blind_monitor_filename.length > 0) && ( (blind_monitor_warning=='AUDIO') || (blind_monitor_warning=='ALERT_AUDIO')|| (blind_monitor_warning=='NOTICE_AUDIO') || (blind_monitor_warning=='ALL') ) )
       {
         basic_originate_call(blind_monitor_filename,'NO','YES',session_id,'YES','','1','0','1');
       }
       blind_monitoring_now_trigger=0;
     }
   }
   else
   {
     hideDiv('blind_monitor_notice_span');
     document.getElementById("blind_monitor_notice_span_contents").innerHTML = '';
     hideDiv('blind_monitor_alert_span');
   }
   if (wrapup_seconds > 0)	
   {
     document.getElementById("WrapupTimer").innerHTML = (wrapup_seconds - wrapup_counter);
     wrapup_counter++;
     if ( (wrapup_counter > wrapup_seconds) && ( (document.getElementById("WrapupBox").style.visibility == 'visible') || (FSCREENup > 0) ) )
     {
      wrapup_waiting=0;
      if (FSCREENup > 0)
       {hideDiv('FSCREENWrapupBox');   FSCREENup=0;}
     else
       {hideDiv('WrapupBox');}
     if (document.vicidial_form.DispoSelectStop.checked==true)
     {
       if (auto_dial_level != '0')
       {
        AutoDialWaiting = 0;
						//		alert('wrapup pause');
            AutoDial_ReSume_PauSe("VDADpause");
						//		document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML;
          }
          VICIDiaL_pause_calling = 1;
          if (dispo_check_all_pause != '1')
          {
            document.vicidial_form.DispoSelectStop.checked=false;
						//		alert("unchecking PAUSE");
          }
        }
        else
        {
         if (auto_dial_level != '0')
         {
          AutoDialWaiting = 1;
						//		alert('wrapup ready');
            AutoDial_ReSume_PauSe("VDADready","NEW_ID","WRAPUP");
						//		document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML_ready;
          }
        }
      }
    }
  }
  else
  {
    if (safe_pause_counter > 0)
    {
     check_for_auto_incoming();
     safe_pause_counter=(safe_pause_counter - 1);
   }
 }
 if (consult_custom_wait > 0)
 {
  if (consult_custom_wait == '1')
   {vcFormIFrame.document.form_custom_fields.submit();}
 if (consult_custom_wait >= consult_custom_delay)
   {SendManualDial('YES');}
 else
   {consult_custom_wait++;}
}
if (HKdispo_display < 1)
{
  if (manual_auto_hotkey == "1")
  {
   if ( (waiting_on_dispo > 0) && (manual_auto_hotkey_wait < 10) )
   {
    manual_auto_hotkey_wait++;
					//	document.getElementById("debugbottomspan").innerHTML = "trigger next manual dial delay: " + manual_auto_hotkey_wait + "|" + waiting_on_dispo;
        }
        else
        {
          manual_auto_hotkey = 0;
          if ( (dial_method == "INBOUND_MAN") || (dial_method == "MANUAL") )
           {ManualDialNext('','','','','','0');}
       }
     }
     if (manual_auto_hotkey > 1) {manual_auto_hotkey = (manual_auto_hotkey - 1);}
   }

			// resume after updatedispo received
			if (updatedispo_resume_trigger == "1")
      {
        if (waiting_on_dispo == "0")
        {
         updatedispo_resume_trigger=0;
         agent_log_id = AutoDial_ReSume_PauSe("VDADready","NEW_ID");
         AutoDialWaiting = 1;
       }
       else
       {
				//	document.getElementById("debugbottomspan").innerHTML = "waiting on dispo response to resume: " + waiting_on_dispo + "|" + updatedispo_resume_trigger;
     }
   }
   if (alert_box_close_counter > 0)
   {
    alert_box_close_counter = (alert_box_close_counter - 1);
    if (alert_box_close_counter < 1)
     {hideDiv('AlertBox');}
 }
 if (left_3way_timeout > 0)
  {left_3way_timeout = (left_3way_timeout - 1);}
}
setTimeout("all_refresh()", refresh_interval);
}

// ################################################################################
// RefresH the calls in queue bottombar
function refresh_calls_in_queue_blah(CQcount)
{
  if (CQcount > 0)
  {
   if (even > 0)
   {
    var xmlhttp=false;
    /*@cc_on @*/
				/*@if (@_jscript_version >= 5)
				// JScript gives us Conditional compilation, we can cope with old IE versions.
				// and security blocked creation of the objects.
				 try {
				  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				 } catch (e) {
				  try {
				   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				  } catch (E) {
				   xmlhttp = false;
				  }
				 }
         @end @*/
         if (!xmlhttp && typeof XMLHttpRequest!='undefined')
         {
           xmlhttp = new XMLHttpRequest();
         }
         if (xmlhttp) 
         { 
           RAview_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=CALLSINQUEUEview&format=text&user=" + user + "&pass=" + pass + "&conf_exten=" + session_id + "&extension=" + extension + "&protocol=" + protocol + "&campaign=" + campaign + "&stage=<?php echo $CQwidth ?>";
           xmlhttp.open('POST', 'vdc_db_query_btx.php'); 
           xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
           xmlhttp.send(RAview_query); 
           xmlhttp.onreadystatechange = function() 
           { 
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
            {
						//	alert(xmlhttp.responseText);
           document.getElementById('callsinqueuelist').innerHTML = xmlhttp.responseText + "\n";
         }
       }
       delete xmlhttp;
     }

   }
 }
}

// ################################################################################
// Open page to enter details for a new manual dial lead
function NeWManuaLDiaLCalL(TVfast,TVphone_code,TVphone_number,TVlead_id,TVtype,NMCclick)
{
	$(".stuff").addClass('hidden');
 $("#btx-dial").removeClass('hidden');
 if (NMCclick=='YES')
  {button_click_log = button_click_log + "" + SQLdate + "-----NeWManuaLDiaLCalL---" + TVfast + " " + TVphone_code + " " + TVphone_number + " " + TVlead_id + " " + TVtype + "|";}
var move_on=1;
if ( (starting_dial_level != 0) && (dial_next_failed < 1) && ( (AutoDialWaiting == 1) || (VD_live_customer_call==1) || (alt_dial_active==1) || (MD_channel_look==1) || (in_lead_preview_state==1) ) )
{
  if ((auto_pause_precall == 'Y') && ( (agent_pause_codes_active=='Y') || (agent_pause_codes_active=='FORCE') ) && (AutoDialWaiting == 1) && (VD_live_customer_call!=1) && (alt_dial_active!=1) && (MD_channel_look!=1) && (in_lead_preview_state!=1) )
  {
   agent_log_id = AutoDial_ReSume_PauSe("VDADpause",'','','','','1',auto_pause_precall_code);
 }
 else
 {
   move_on=0;
   alert_box("<?php echo _QXZ("YOU MUST BE PAUSED TO MANUAL DIAL A NEW LEAD IN AUTO-DIAL MODE"); ?>");
   button_click_log = button_click_log + "" + SQLdate + "-----ManualDialFailed---" + VDRP_stage + "|";
 }
}
if (move_on == 1)
{
  if (TVfast=='FAST')
  {
   NeWManuaLDiaLCalLSubmiTfast();
 }
 else
 {
   if (TVfast=='CALLLOG')
   {
    hideDiv('CalLLoGDisplaYBox');
    hideDiv('SearcHForMDisplaYBox');
    hideDiv('SearcHResultSDisplaYBox');
    hideDiv('LeaDInfOBox');
    document.getElementById('MDDiaLCodE_prefix').value = TVphone_code;
    document.vicidial_form.MDPhonENumbeR.value = TVphone_number;
    document.vicidial_form.MDPhonENumbeRHiddeN.value = TVphone_number;
    document.vicidial_form.MDLeadID.value = TVlead_id;
    document.vicidial_form.MDType.value = TVtype;
    if (disable_alter_custphone == 'HIDE')
     {document.vicidial_form.MDPhonENumbeR.value = 'XXXXXXXXXX';}
 }
 if (TVfast=='LEADSEARCH')
 {
  hideDiv('SearcHForMDisplaYBox');
  hideDiv('SearcHResultSDisplaYBox');
  hideDiv('LeaDInfOBox');
  document.getElementById('MDDiaLCodE_prefix').value = TVphone_code;
  document.vicidial_form.MDPhonENumbeR.value = TVphone_number;
  document.vicidial_form.MDLeadID.value = TVlead_id;
  document.vicidial_form.MDType.value = TVtype;
}
if (agent_allow_group_alias == 'Y')
{
  document.getElementById("ManuaLDiaLGrouPSelecteD").innerHTML = "<font size=\"2\" face=\"Arial,Helvetica\"><?php echo _QXZ("Group Alias:"); ?> " + active_group_alias + "</font>";
  document.getElementById("ManuaLDiaLGrouP").innerHTML = "<a href=\"#\" onclick=\"GroupAliasSelectContent_create('0');\"><font size=\"1\" face=\"Arial,Helvetica\"><?php echo _QXZ("Click Here to Choose a Group Alias"); ?></font></a>";
}
if (in_group_dial_display > 0)
{
  document.getElementById("ManuaLDiaLInGrouPSelecteD").innerHTML = "<font size=\"2\" face=\"Arial,Helvetica\"><?php echo _QXZ("Dial In-Group:"); ?> " + active_ingroup_dial + "</font>";
  document.getElementById("ManuaLDiaLInGrouP").innerHTML = "<a href=\"#\" onclick=\"ManuaLDiaLInGrouPSelectContent_create('0');\"><font size=\"1\" face=\"Arial,Helvetica\"><?php echo _QXZ("Click Here to Choose a Dial In-Group"); ?></font></a>";
}
if ( (in_group_dial == 'BOTH') || (in_group_dial == 'NO_DIAL') )
{
  nocall_dial_flag = 'DISABLED';
  document.getElementById("NoDiaLSelecteD").innerHTML = "<font size=\"2\" face=\"Arial,Helvetica\"><?php echo _QXZ("No-Call Dial:"); ?> " + nocall_dial_flag + " &nbsp; &nbsp; </font><a href=\"#\" onclick=\"NoDiaLSwitcH('');\"><font size=\"1\" face=\"Arial,Helvetica\"><?php echo _QXZ("Click Here to Activate"); ?></font></a>";
}
showDiv('NeWManuaLDiaLBox');

agent_events('manual_dial_open', '');

document.vicidial_form.search_phone_number.value='';
document.vicidial_form.search_lead_id.value='';
document.vicidial_form.search_vendor_lead_code.value='';
document.vicidial_form.search_first_name.value='';
document.vicidial_form.search_last_name.value='';
document.vicidial_form.search_city.value='';
document.vicidial_form.search_state.value='';
document.vicidial_form.search_postal_code.value='';
}
}
}

// ################################################################################


// ################################################################################
// Show the groups selection span
function OpeNGrouPSelectioN()
{
  button_click_log = button_click_log + "" + SQLdate + "-----OpeNGrouPSelectioN---|";
  var move_on=1;
  if ( (AutoDialWaiting == 1) || (VD_live_customer_call==1) || (alt_dial_active==1) || (MD_channel_look==1) || (in_lead_preview_state==1) )
  {
   if ((auto_pause_precall == 'Y') && ( (agent_pause_codes_active=='Y') || (agent_pause_codes_active=='FORCE') ) && (AutoDialWaiting == 1) && (VD_live_customer_call!=1) && (alt_dial_active!=1) && (MD_channel_look!=1) && (in_lead_preview_state!=1) )
   {
    agent_log_id = AutoDial_ReSume_PauSe("VDADpause",'','','','','1',auto_pause_precall_code);
  }
  else
  {
    move_on=0;
    alert_box("<?php echo _QXZ("YOU MUST BE PAUSED TO CHANGE GROUPS"); ?>");
    button_click_log = button_click_log + "" + SQLdate + "-----GroupSelectFailed---" + VDRP_stage + "|";
  }
}
if (move_on == 1)
{
 if (manager_ingroups_set > 0)
 {
  alert_box("<?php echo _QXZ("Manager"); ?> " + external_igb_set_name + " <?php echo _QXZ("has selected your in-group choices"); ?>");
  button_click_log = button_click_log + "" + SQLdate + "-----GroupSelectManager---" + external_igb_set_name + "|";
}
else
{
  HidEGenDerPulldown();
  showDiv('CloserSelectBox_btx');
  agent_events('ingroup_screen_open', '', aec);   aec++;
}
}
}
// ################################################################################
// Set the client to READY and start looking for calls (VDADready, VDADpause)
function AutoDial_ReSume_PauSe(taskaction,taskagentlog,taskwrapup,taskstatuschange,temp_reason,temp_auto,temp_auto_code,APRclick)
{
	
	//~ document.getElementById("hangup_call").innerHTML = '<button style="margin-left:5px;" id="hangup_button" type="button" class="btn btn-sm btn-danger control-buttons hangup_button" onclick="dialedcall_send_hangup('','','','','YES');" data-toggle="modal" href="#modal-outcome"><i class="fas fa-times"></i>&nbsp;Hangup</button>';
	
	if (APRclick=='YES')
		{button_click_log = button_click_log + "" + SQLdate + "-----AutoDial_ReSume_PauSe---" + taskaction + " " + taskagentlog + " " + taskstatuschange + " " + temp_reason + " " + temp_auto + " " + temp_auto_code + "|";}
	if (VD_live_customer_call==1)
	{
		
		alert_box("<?php echo _QXZ("STILL A LIVE CALL! You must hang it up first."); ?>\n" + VD_live_customer_call + "\n" + VDRP_stage);
		button_click_log = button_click_log + "" + SQLdate + "-----ON_CALL_pause_resume_stopped---" + VD_live_customer_call + " " + VDRP_stage + "|";
	}
	else
	{
		CFAI_sent = 0;
		if ( (CFAI_sent > 0) && (APRclick=='YES') )
		{
			alert_box_close_counter=10;
			alert_box("<?php echo _QXZ("CHECK-FOR-CALL RUNNING, PLEASE WAIT");?>: " + CFAI_sent);
			button_click_log = button_click_log + "" + SQLdate + "-----CFAI_stopped_pause_click---" + CFAI_sent + " " + taskaction + " " + agent_log_id + "|";
			
		}
		else
		{
			var add_pause_code='';
			if (taskaction == 'VDADready')
			{
				VDRP_stage = 'READY';
				VDRP_stage_seconds=0;
				safe_pause_counter=0;
				if (INgroupCOUNT > 0)
				{
					VICIDiaL_closer_blended = 1;
					if (VICIDiaL_closer_blended == 0)
						{VDRP_stage = 'PAUSED';}
					else 
						{VDRP_stage = 'READY';}
				}
				agent_events('state_ready', VDRP_stage);
				AutoDialReady = 1;
				AutoDialWaiting = 1;
				if (dial_method == "INBOUND_MAN")
				{
					auto_dial_level=starting_dial_level;
         document.getElementById("DiaLControl").innerHTML = "<a href=\"#\" onclick=\"AutoDial_ReSume_PauSe('VDADpause','','','','','','','YES');\"><img src=\"./images/<?php echo _QXZ("vdc_LB_active.gif"); ?>\" border=\"0\" alt=\"You are active\" /></a><br /><a href=\"#\" onclick=\"ManualDialNext('','','','','','0','','','YES');\"><img src=\"./images/<?php echo _QXZ("vdc_LB_dialnextnumber.gif"); ?>\" border=\"0\" alt=\"Dial Next Number\" /></a>";

       }
       else
       {
         document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML_ready;
       }
     }
     else
     {
      VDRP_stage = 'PAUSED';
      agent_events('state_paused', VDRP_stage);
      VDRP_stage_seconds=0;
      AutoDialReady = 0;
      AutoDialWaiting = 0;
      pause_code_counter = 0;
      dial_next_failed=0;
      safe_pause_counter=5;
      if (dial_method == "INBOUND_MAN")
      {
       auto_dial_level=starting_dial_level;

       document.getElementById("DiaLControl").innerHTML = "<a href=\"#\" onclick=\"AutoDial_ReSume_PauSe('VDADready','','','','','','','YES');\"><img src=\"./images/<?php echo _QXZ("vdc_LB_paused.gif"); ?>\" border=\"0\" alt=\"You are paused\" /></a><br /><a href=\"#\" onclick=\"ManualDialNext('','','','','','0','','','YES');\"><img src=\"./images/<?php echo _QXZ("vdc_LB_dialnextnumber.gif"); ?>\" border=\"0\" alt=\"Dial Next Number\" /></a>";
     }
     else
     {
       document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML;
     }

     if ( (agent_pause_codes_active=='FORCE') && (temp_reason != 'LOGOUT') && (temp_reason != 'REQUEUE') && (temp_reason != 'DIALNEXT') && (temp_auto != '1') )
     {
       PauseCodeSelectContent_create();
     }
     if (temp_auto == '1')
     {
       add_pause_code = "&sub_status=" + temp_auto_code;
     }
   }

   var xmlhttp=false;
   /*@cc_on @*/
				/*@if (@_jscript_version >= 5)
				// JScript gives us Conditional compilation, we can cope with old IE versions.
				// and security blocked creation of the objects.
				 try {
				  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				 } catch (e) {
				  try {
				   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				  } catch (E) {
				   xmlhttp = false;
				  }
				 }
				 @end @*/
				 if (!xmlhttp && typeof XMLHttpRequest!='undefined')
				 {
				 	xmlhttp = new XMLHttpRequest();
				 }
				 if (xmlhttp) 
				 { 
				 	autoDiaLready_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=" + taskaction + "&user=" + user + "&pass=" + pass + "&stage=" + VDRP_stage + "&agent_log_id=" + agent_log_id + "&agent_log=" + taskagentlog + "&wrapup=" + taskwrapup + "&campaign=" + campaign + "&dial_method=" + dial_method + "&comments=" + taskstatuschange + add_pause_code + "&qm_extension=" + qm_extension;
				 	xmlhttp.open('POST', 'vdc_db_query.php'); 
				 	xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
				 	xmlhttp.send(autoDiaLready_query); 
				 	xmlhttp.onreadystatechange = function()
				 	{ 
				 		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
				 		{
				 			var check_dispo = null;
				 			check_dispo = xmlhttp.responseText;
				 			var check_DS_array=check_dispo.split("\n");
						//	alert(xmlhttp.responseText + "\n|" + check_DS_array[1] + "\n|" + check_DS_array[2] + "|");
						if (check_DS_array[1] == 'Next agent_log_id:')
						{
							if (agent_log_id.length > 0) {previous_agent_log_id = agent_log_id;}
							var temp_agent_log_id = check_DS_array[2];
							if (temp_agent_log_id === undefined)
								{button_click_log = button_click_log + "" + SQLdate + "-----AJAX_pause_resume_undefined---" + temp_agent_log_id + " " + taskaction + " " + agent_log_id + "|";}
							else
								{agent_log_id = temp_agent_log_id;}
						}
					}
				}
				delete xmlhttp;
			}
			waiting_on_dispo=0;
		}
	}
	return agent_log_id;
}


function btx_LeadSearchSubmit()
{
  $('#btx_search_res').html('');
  document.vicidial_form.search_phone_number.value = $('#btx_search_phone').val();
  document.vicidial_form.search_lead_id.value =  $('#btx_search_lead_id').val();
  document.vicidial_form.search_vendor_lead_code.value =$('#btx_search_vlc').val();
  button_click_log = button_click_log + "" + SQLdate + "-----LeadSearchSubmit---|";
  if (( ( (AutoDialWaiting == 1) || (VD_live_customer_call==1) || (alt_dial_active==1) || (MD_channel_look==1) || (in_lead_preview_state==1) ) && (inbound_lead_search < 1) ) && ( (inOUT=='IN') && ( (agent_lead_search!='LIVE_CALL_INBOUND') && (agent_lead_search!='LIVE_CALL_INBOUND_AND_MANUAL') ) ))
  {
    alert_box("<?php echo _QXZ("YOU MUST BE PAUSED TO SEARCH FOR A LEAD"); ?>");
    button_click_log = button_click_log + "" + SQLdate + "-----LeadSearchFailed---" + VDRP_stage + "|";
  }
  else
  {
    //  showDiv('SearcHResultSDisplaYBox');

    if ( (inOUT=='IN') && ( (agent_lead_search=='LIVE_CALL_INBOUND') || (agent_lead_search=='LIVE_CALL_INBOUND_AND_MANUAL') ) )
    {
    inbound_lead_search=1;
    }

    document.getElementById('SearcHResultSSpan').innerHTML = "<?php echo _QXZ("Searching..."); ?>\n";

    var phone_search_fields = '';
    if (document.vicidial_form.search_main_phone.checked==true)
      {phone_search_fields = phone_search_fields + "MAIN_";}
    if (document.vicidial_form.search_alt_phone.checked==true)
      {phone_search_fields = phone_search_fields + "ALT_";}
    if (document.vicidial_form.search_addr3_phone.checked==true)
      {phone_search_fields = phone_search_fields + "ADDR3_";}

    var xmlhttp=false;
    /*@cc_on @*/
      /*@if (@_jscript_version >= 5)
      // JScript gives us Conditional compilation, we can cope with old IE versions.
      // and security blocked creation of the objects.
       try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
       } catch (e) {
        try {
         xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
         xmlhttp = false;
        }
       }
       @end @*/
       if (!xmlhttp && typeof XMLHttpRequest!='undefined')
       {
        xmlhttp = new XMLHttpRequest();
      }
      if (xmlhttp)
      { 
        LSview_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=SEARCHRESULTSview&format=text&user=" + user + "&pass=" + pass + "&conf_exten=" + session_id + "&extension=" + extension + "&protocol=" + protocol + "&phone_number=" + document.vicidial_form.search_phone_number.value + "&lead_id=" + document.vicidial_form.search_lead_id.value + "&vendor_lead_code=" + document.vicidial_form.search_vendor_lead_code.value + "&first_name=" + document.vicidial_form.search_first_name.value + "&last_name=" + document.vicidial_form.search_last_name.value + "&city=" + document.vicidial_form.search_city.value + "&state=" + document.vicidial_form.search_state.value + "&postal_code=" + document.vicidial_form.search_postal_code.value + "&search=" + phone_search_fields + "&campaign=" + campaign + "&inbound_lead_search=" + inbound_lead_search + "search&manual_dial_filter=" + agentcall_manual + "&stage=<?php echo $HCwidth ?>";
        xmlhttp.open('POST', 'vdc_db_query_btx.php'); 
        xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
        xmlhttp.send(LSview_query); 
        xmlhttp.onreadystatechange = function() 
        { 
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
          {



            if (xmlhttp.responseText.includes('ERROR:'))
              { var search_content = '<div class="row" >';
            search_content += "<div class='col text-center text-danger' >";
            search_content += xmlhttp.responseText;
            search_content += "</div></div>";

            $('#btx_search_res').html(search_content)}
            else
            {          //  alert(xmlhttp.responseText);
           // document.getElementById('SearcHResultSSpan').innerHTML = xmlhttp.responseText + "\n";
           $('#btx_search_res').html(xmlhttp.responseText);
         }
       }
     }
     delete xmlhttp;
   }
 }
}




// ################################################################################
// Update vicidial_list lead record with disposition selection
function DispoSelect_submit_and_continue(temp_use_pause_code,temp_dispo_pause_code,DSPclick)
{
	$(".hangup_and_show_dispo").not( "#btx_transfer_leave" ).hide();
	
	//~ AutoDial_ReSume_PauSe("VDADready",'','','','',"1",temp_dispo_pause_code);
	if (DSPclick=='YES')
		{button_click_log = button_click_log + "" + SQLdate + "-----DispoSelect_submit---|";}
	if (VDCL_group_id.length > 1)
		{group = VDCL_group_id;}
	else
		{group = campaign;}
	leaving_threeway=0;
	blind_transfer=0;
	CheckDEADcallON=0;
	CheckDEADcallCOUNT=0;
	customer_sec=0;
	currently_in_email_or_chat=0;
	customer_3way_hangup_counter=0;
	customer_3way_hangup_counter_trigger=0;
	waiting_on_dispo=1;
	var VDDCU_recording_id=document.getElementById("RecorDID").innerHTML;
	var VDDCU_recording_filename=last_recording_filename;
	var dispo_urls='';
	document.getElementById("callchannel").innerHTML = '';
	document.vicidial_form.callserverip.value = '';
	document.vicidial_form.xferchannel.value = '';
	document.getElementById("DialWithCustomer").innerHTML ="<a href=\"#\" onclick=\"SendManualDial('YES','YES');return false;\"><i  style='color:#212529'class=\"fas fa-hashtag fa-5x\"></i><br><br><button class=\"btn btn-default btn-sm\" style=\"padding:0px;\">External Number</button></a>";
	document.getElementById("ParkCustomerDial").innerHTML ="<a href=\"#\" onclick=\"xfer_park_dial('YES');return false;\"><img src=\"./images/<?php echo _QXZ("vdc_XB_parkcustomerdial.gif"); ?>\" border=\"0\" alt=\"Park Customer Dial\" style=\"vertical-align:middle\" /></a>";
	document.getElementById("HangupBothLines").innerHTML ="<a href=\"#\" onclick=\"bothcall_send_hangup('YES');return false;\"><img src=\"./images/<?php echo _QXZ("vdc_XB_hangupbothlines.gif"); ?>\" border=\"0\" alt=\"Hangup Both Lines\" style=\"vertical-align:middle\" /></a>";

	var DispoChoice = document.vicidial_form.DispoSelection.value;
	if (DispoChoice.length < 1) 
	{
		alert_box("<?php echo _QXZ("You Must Select a Disposition"); ?>");
		button_click_log = button_click_log + "" + SQLdate + "-----EmptyDispoAlert2---" + DispoChoice + " " + "|";
	}
	else
	{
		if (document.vicidial_form.lead_id.value == '') 
		{
			//	alert_box("<?php echo _QXZ("You can only disposition a call once"); ?>");
			waiting_on_dispo=0;
			AgentDispoing = 0;
			hideDiv('DispoSelectBox');
			hideDiv('DispoButtonHideA');
			hideDiv('DispoButtonHideB');
			hideDiv('DispoButtonHideC');
			document.getElementById("debugbottomspan").innerHTML =  "<?php echo _QXZ("Disposition set twice: "); ?>" + document.vicidial_form.lead_id.value + "|" + DispoChoice + "\n"
		}
		else
		{
			if (document.vicidial_form.DiaLAltPhonE.checked==true)
			{
				var man_status = ""; 
				document.getElementById("MainStatuSSpan").innerHTML = man_status;
				alt_dial_status_display = 0;
			}
			document.getElementById("CusTInfOSpaN").innerHTML = "";
			document.getElementById("CusTInfOSpaN").style.background = panel_bgcolor;
			var regCBstatus = new RegExp(' ' + DispoChoice + ' ',"ig");
			if ( (VARCBstatusesLIST.match(regCBstatus)) && (DispoChoice.length > 0) && (scheduled_callbacks > 0) && (DispoChoice != 'CBHOLD') )
			{
				var INTLastCallbackCount = parseInt(LastCallbackCount);
				var INTcallback_active_limit = parseInt(callback_active_limit);
				if ( (INTcallback_active_limit > 0) && (INTLastCallbackCount >= INTcallback_active_limit) )
				{
					document.getElementById("CallBackOnlyMe").checked = false;
					document.getElementById("CallBackOnlyMe").disabled = true;
				}
				else
				{
					document.getElementById("CallBackOnlyMe").disabled = false;
				}

				if ( (comments_callback_screen == 'ENABLED') || (comments_callback_screen == 'REPLACE_CB_NOTES') )
				{
					var cb_comment_output = "<table cellspacing=4 cellpadding=0><tr><td align=\"right\"><font class=\"body_text\"><?php echo $label_comments ?>: <br><span id='cbviewcommentsdisplay'><input type='button' id='CBViewCommentButton' onClick=\"ViewComments('ON','','cb','YES')\" value='-<?php _QXZ("History"); ?>-'/></span></font></td><td align=\"left\"><font class=\"body_text\">";
					cb_comment_output = cb_comment_output + "<textarea name=\"cbcomment_comments\" id=\"cbcomment_comments\" rows=\"2\" cols=\"100\" class=\"form-control_text\" value=\"\">" + document.vicidial_form.dispo_comments.value + "</textarea>\n";
					cb_comment_output = cb_comment_output + "</td></tr></table>\n";
					document.getElementById("CBCommentsContent").innerHTML = cb_comment_output;
				}
				else
				{
					document.getElementById("CBCommentsContent").innerHTML = "<input type=\"hidden\" name=\"cbcomment_comments\" id=\"cbcomment_comments\" value=\"" + document.vicidial_form.dispo_comments.value + "\" />";
				}

				showDiv('CallBackSelectBox');

				agent_events('callback_select_open', '');
			}
			else
			{
				var xmlhttp=false;
				/*@cc_on @*/
					/*@if (@_jscript_version >= 5)
					// JScript gives us Conditional compilation, we can cope with old IE versions.
					// and security blocked creation of the objects.
					 try {
					  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
					 } catch (e) {
					  try {
					   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					  } catch (E) {
					   xmlhttp = false;
					  }
					 }
					 @end @*/
					 if (!xmlhttp && typeof XMLHttpRequest!='undefined')
					 {
					 	xmlhttp = new XMLHttpRequest();
					 }
					 if (xmlhttp) 
					 {
					 	DSupdate_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=updateDISPO&format=text&user=" + user + "&pass=" + pass + "&orig_pass=" + orig_pass + "&dispo_choice=" + DispoChoice + "&lead_id=" + document.vicidial_form.lead_id.value + "&campaign=" + campaign + "&auto_dial_level=" + auto_dial_level + "&agent_log_id=" + agent_log_id + "&CallBackDatETimE=" + CallBackDatETimE + "&list_id=" + document.vicidial_form.list_id.value + "&recipient=" + CallBackrecipient + "&use_internal_dnc=" + use_internal_dnc + "&use_campaign_dnc=" + use_campaign_dnc + "&MDnextCID=" + LasTCID + "&stage=" + group + "&vtiger_callback_id=" + vtiger_callback_id + "&phone_number=" + document.vicidial_form.phone_number.value + "&phone_code=" + document.vicidial_form.phone_code.value + "&dial_method=" + dial_method + "&uniqueid=" + document.vicidial_form.uniqueid.value + "&CallBackLeadStatus=" + CallBackLeadStatus + "&comments=" + encodeURIComponent(CallBackCommenTs) + "&custom_field_names=" + custom_field_names + "&call_notes=" + encodeURIComponent(document.vicidial_form.call_notes_dispo.value) + "&dispo_comments=" + encodeURIComponent(document.vicidial_form.dispo_comments.value) + "&cbcomment_comments=" + encodeURIComponent(document.vicidial_form.cbcomment_comments.value) + "&qm_dispo_code=" + DispoQMcsCODE + "&email_enabled=" + email_enabled + "&recording_id=" + VDDCU_recording_id + "&recording_filename=" + VDDCU_recording_filename + "&called_count=" + document.vicidial_form.called_count.value + "&parked_hangup=" + parked_hangup + "&phone_login=" + phone_login + "&agent_email=" + LOGemail + "&conf_exten=" + session_id + "&camp_script=" + campaign_script + '' + "&in_script=" + CalL_ScripT_id + "&customer_server_ip=" + lastcustserverip + "&exten=" + extension + "&original_phone_login=" + original_phone_login + "&phone_pass=" + phone_pass;
					 	xmlhttp.open('POST', 'vdc_db_query.php');
					 	xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
					 	xmlhttp.send(DSupdate_query); 
					 	xmlhttp.onreadystatechange = function() 
					 	{ 
						//	alert(DSupdate_query + "\n" +xmlhttp.responseText);

						if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
						{
							//	alert(xmlhttp.responseText);
							var check_dispo = null;
							check_dispo = xmlhttp.responseText;
							var check_DS_array=check_dispo.split("\n");
							if (auto_dial_level < 1)
							{
								if (check_DS_array[1] == 'Next agent_log_id:')
								{
									if (agent_log_id.length > 0) {previous_agent_log_id = agent_log_id;}
									agent_log_id = check_DS_array[2];
								}
							}
							if (check_DS_array[3] == 'Dispo URLs:')
							{
								dispo_urls = check_DS_array[4];

								SendURLs(dispo_urls,"dispo");
							}
							waiting_on_dispo=0;

							agent_events('dispo_set', DispoChoice);
						}
					}
					delete xmlhttp;
				}
					// CLEAR ALL FORM VARIABLES
					document.vicidial_form.lead_id.value		='';
					document.vicidial_form.vendor_lead_code.value='';
					document.vicidial_form.list_id.value		='';
					document.vicidial_form.list_name.value		='';
					document.vicidial_form.list_description.value='';
					document.vicidial_form.entry_list_id.value	='';
					document.vicidial_form.gmt_offset_now.value	='';
					document.vicidial_form.phone_code.value		='';
					if (disable_alter_custphone=='HIDE') 
					{
						var tmp_pn = document.getElementById("phone_numberDISP");
						tmp_pn.innerHTML			= ' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ';
					}
					document.vicidial_form.phone_number.value	='';
					document.vicidial_form.title.value			='';
					document.vicidial_form.first_name.value		='';
					document.vicidial_form.middle_initial.value	='';
					document.vicidial_form.last_name.value		='';
					document.vicidial_form.address1.value		='';
					document.vicidial_form.address2.value		='';
					document.vicidial_form.address3.value		='';
					document.vicidial_form.city.value			='';
					document.vicidial_form.state.value			='';
					document.vicidial_form.province.value		='';
					document.vicidial_form.postal_code.value	='';
					document.vicidial_form.country_code.value	='';
					document.vicidial_form.gender.value			='';
					document.vicidial_form.date_of_birth.value	='';
					document.vicidial_form.alt_phone.value		='';
					document.vicidial_form.email.value			='';
					document.vicidial_form.security_phrase.value='';
					document.vicidial_form.comments.value		='';
					document.vicidial_form.other_tab_comments.value		='';
					document.getElementById("audit_comments").innerHTML		='';
					if (qc_enabled > 0)
					{
						document.vicidial_form.ViewCommentButton.value		='';
						document.vicidial_form.audit_comments_button.value	='';
						if (comments_all_tabs == 'ENABLED')
							{document.vicidial_form.OtherViewCommentButton.value ='';}
					}
					document.vicidial_form.called_count.value	='';
					document.vicidial_form.call_notes.value		='';
					document.vicidial_form.call_notes_dispo.value ='';
					document.vicidial_form.email_row_id.value		='';
					document.vicidial_form.chat_id.value		='';
					document.vicidial_form.customer_chat_id.value		='';
					document.vicidial_form.dispo_comments.value ='';
					document.vicidial_form.cbcomment_comments.value ='';
					VDCL_group_id = '';
					fronter = '';
					inOUT = 'OUT';
					vtiger_callback_id='0';
					recording_filename='';
					recording_id='';
					document.vicidial_form.uniqueid.value='';
					MDuniqueid='';
					XDuniqueid='';
					tmp_vicidial_id='';
					EAphone_code='';
					EAphone_number='';
					EAalt_phone_notes='';
					EAalt_phone_active='';
					EAalt_phone_count='';
					XDnextCID='';
					XDcheck = '';
					MDnextCID='';
					XD_live_customer_call = 0;
					XD_live_call_secondS = 0;
					xfer_in_call=0;
					MD_channel_look=0;
					MD_ring_secondS=0;
					uniqueid_status_display='';
					uniqueid_status_prefix='';
					custom_call_id='';
					API_selected_xfergroup='';
					API_selected_callmenu='';
					timer_action='';
					timer_action_seconds='';
					timer_action_mesage='';
					timer_action_destination='';
					did_pattern='';
					did_id='';
					did_extension='';
					did_description='';
					did_custom_one='';
					did_custom_two='';
					did_custom_three='';
					did_custom_four='';
					did_custom_five='';
					closecallid='';
					xfercallid='';
					custom_field_names='';
					custom_field_values='';
					custom_field_types='';
					customerparked=0;
					customerparkedcounter=0;
					consult_custom_wait=0;
					consult_custom_go=0;
					consult_custom_sent=0;
					document.getElementById("ParkCounterSpan").innerHTML = '';
					document.vicidial_form.xfername.value='';
					document.vicidial_form.xfernumhidden.value='';
					document.getElementById("debugbottomspan").innerHTML = '';
					customer_3way_hangup_dispo_message='';
					document.getElementById("Dispo3wayMessage").innerHTML = '';
					document.getElementById("DispoManualQueueMessage").innerHTML = '';
					document.getElementById("ManualQueueNotice").innerHTML = '';
					APIManualDialQueue_last=0;
					document.vicidial_form.FORM_LOADED.value = '0';
					CallBackLeadStatus = '';
					CallBackDatETimE='';
					CallBackrecipient='';
					CallBackCommenTs='';
					DispoQMcsCODE='';
					active_ingroup_dial='';
					CalL_ScripT_id='';
					CalL_ScripT_color='';
					nocall_dial_flag='DISABLED';
					document.vicidial_form.CallBackDatESelectioN.value = '';
					document.vicidial_form.CallBackCommenTsField.value = '';

					document.vicidial_form.search_phone_number.value='';
					document.vicidial_form.search_lead_id.value='';
					document.vicidial_form.search_vendor_lead_code.value='';
					document.vicidial_form.search_first_name.value='';
					document.vicidial_form.search_last_name.value='';
					document.vicidial_form.search_city.value='';
					document.vicidial_form.search_state.value='';
					document.vicidial_form.search_postal_code.value='';
					document.vicidial_form.MDPhonENumbeR.value = '';
					document.vicidial_form.MDDiaLOverridE.value = '';
					document.vicidial_form.MDLeadID.value = '';
					document.vicidial_form.MDLeadIDEntry.value='';
					document.vicidial_form.MDType.value = '';
					document.vicidial_form.MDPhonENumbeRHiddeN.value = '';
					inbound_lead_search=0;
					cid_lock=0;
					timer_alt_trigger=0;
					last_mdtype='';
					document.getElementById("timer_alt_display").innerHTML = '';
					document.getElementById("manual_auto_next_display").innerHTML = '';
					document.getElementById("RecorDID").innerHTML = '';
					dial_next_failed=0;
					xfer_agent_selected=0;
					hangup_both=0;
					source_id='';
					entry_date='';
					last_call_date='';
					if (manual_auto_next > 0)
						{manual_auto_next_trigger=1;   manual_auto_next_count=manual_auto_next;}
					if (agent_display_fields.match(adfREGentry_date))
						{document.getElementById("entry_dateDISP").innerHTML = ' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ';}
					if (agent_display_fields.match(adfREGsource_id))
						{document.getElementById("source_idDISP").innerHTML = ' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ';}
					if (agent_display_fields.match(adfREGdate_of_birth))
						{document.getElementById("date_of_birthDISP").innerHTML = ' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ';}
					if (agent_display_fields.match(adfREGrank))
						{document.getElementById("rankDISP").innerHTML = ' &nbsp; &nbsp; ';}
					if (agent_display_fields.match(adfREGowner))
						{document.getElementById("ownerDISP").innerHTML = ' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ';}
					if (agent_display_fields.match(adfREGlast_local_call_time))
						{document.getElementById("last_local_call_timeDISP").innerHTML = ' &nbsp; ';}

					if ( (manual_dial_search_checkbox == 'SELECTED_RESET') || (manual_dial_search_checkbox == 'SELECTED_LOCK') )
						{document.vicidial_form.LeadLookuP.checked=true;}
					if ( (manual_dial_search_checkbox == 'UNSELECTED_RESET') || (manual_dial_search_checkbox == 'UNSELECTED_LOCK') )
						{document.vicidial_form.LeadLookuP.checked=false;}

					if (post_phone_time_diff_alert_message.length > 10)
					{
						document.getElementById("post_phone_time_diff_span_contents").innerHTML = "";
						hideDiv('post_phone_time_diff_span');
						post_phone_time_diff_alert_message='';
					}

					if (manual_dial_in_progress==1)
					{
						manual_dial_finished();
					}
					if (hide_gender < 1)
					{
						document.getElementById("GENDERhideFORieALT").innerHTML = '';
						document.getElementById("GENDERhideFORie").innerHTML = "<select size=\"1\" name=\"gender_list\" class=\"form-control\" id=\"gender_list\"><option value=\"U\"><?php echo _QXZ("U - Undefined"); ?></option><option value=\"M\"><?php echo _QXZ("M - Male"); ?></option><option value=\"F\"><?php echo _QXZ("F - Female"); ?></option></select>";
					}
					hideDiv('DispoSelectBox');
					hideDiv('DispoButtonHideA');
					hideDiv('DispoButtonHideB');
					hideDiv('DispoButtonHideC');
					document.getElementById("DispoSelectBox").style.top = '1px';  // Firefox error on this line for some reason
					document.getElementById("DispoSelectMaxMin").innerHTML = "<a href=\"#\" onclick=\"DispoMinimize()\"> <?php echo _QXZ("minimize"); ?> </a>";
					document.getElementById("DispoSelectHAspan").innerHTML = "<a href=\"#\" onclick=\"DispoHanguPAgaiN()\"><?php echo _QXZ("Hangup Again"); ?></a>";
					if (pause_after_next_call == 'ENABLED')
					{
						document.getElementById("NexTCalLPausE").innerHTML = "<a href=\"#\" onclick=\"next_call_pause_click();return false;\"><?php echo _QXZ("Next Call Pause"); ?></a>";
					}
					CBcommentsBoxhide();
					EAcommentsBoxhide();
					ContactSearchReset();
					ViewComments('OFF','OFF');
					if (clear_script == 'ENABLED')
						{document.getElementById("ScriptContents").innerHTML = '';}
					parked_hangup='0';

					// Set customer chat tab to OFF, just to be sure
					if (chat_enabled > 0)
					{
						document.images['CustomerChatImg'].src=image_customer_chat_OFF.src;
					}
					CustomerChatContentsLoad();
					EmailContentsLoad();

					AgentDispoing = 0;

					if ( (alt_number_dialing == 'SELECTED') || (alt_number_dialing == 'SELECTED_TIMER_ALT') || (alt_number_dialing == 'SELECTED_TIMER_ADDR3') )
					{
						document.vicidial_form.DiaLAltPhonE.checked=true;
					}



					if ( (shift_logout_flag < 1) && (api_logout_flag < 1) )
					{
						if (wrapup_waiting == 0)
						{
							 //~ = false;
              if ((document.vicidial_form.DispoSelectStop.checked==true) || ( (liveCBcounT > 0) && (scheduled_callbacks_force_dial == 'Y') ) )
                {

                if ( (liveCBcounT > 0) && (scheduled_callbacks_force_dial == 'Y') )
                  {
                  VieWCBForcedDialInfO();
                  temp_dispo_pause_code = auto_pause_precall_code;
                  temp_use_pause_code=1;
                  }
                if (auto_dial_level != '0')
                {
                 AutoDialWaiting = 0;
                 QUEUEpadding = 0;

                 if (temp_use_pause_code==1)
                 {
                  AutoDial_ReSume_PauSe("VDADpause",'','','','',"1",temp_dispo_pause_code);
                }
                else
                {
                  AutoDial_ReSume_PauSe("VDADpause");
                }
              }
              VICIDiaL_pause_calling = 1;
              if (dispo_check_all_pause != '1')
              {
               document.vicidial_form.DispoSelectStop.checked=false;
             }
           }
           else
           {
            if (auto_dial_level != '0')
            {
             updatedispo_resume_trigger=1;
								//	AutoDialWaiting = 1;
								//	if (temp_use_pause_code==1)
								//		{
								//		agent_log_id = AutoDial_ReSume_PauSe("VDADready","NEW_ID",'','','',"1",temp_dispo_pause_code);
								//		}
								//	else
								//		{
								//		agent_log_id = AutoDial_ReSume_PauSe("VDADready","NEW_ID");
								//		}
							}
							else
							{
									// trigger HotKeys manual dial automatically go to next lead
								//	if (manual_auto_hotkey > 0)
								//		{
								//		manual_auto_hotkey = 0;
								//		ManualDialNext('','','','','','0');
								//		}
							}
						}
					}
				}
				else
				{
					if (shift_logout_flag > 0)
						{LogouT('SHIFT','');}
					else
						{LogouT('API','');}
				}
				if (focus_blur_enabled==1)
				{
					document.inert_form.inert_button.focus();
					document.inert_form.inert_button.blur();
				}
			}
				// scroll back to the top of the page
				scroll(0,0);
			}
		}
	}
	
// ################################################################################
// Insert the new manual dial as a lead and go to manual dial screen
function NeWManuaLDiaLCalLSubmiT(tempDiaLnow,NMDclick)
{
	if (NMDclick=='YES')
		{button_click_log = button_click_log + "" + SQLdate + "-----NeWManuaLDiaLCalLSubmiT---" + tempDiaLnow + "|";}
	if (waiting_on_dispo > 0)
	{
		alert_box("<?php echo _QXZ("System Delay, Please try again"); ?><BR><font size=1><?php echo _QXZ("code:"); ?>" + agent_log_id + " - " + waiting_on_dispo + "</font>");
		button_click_log = button_click_log + "" + SQLdate + "-----ManDialSystemDelay---" + agent_log_id + " " + waiting_on_dispo + "|";
	}
	else
	{
		hideDiv('NeWManuaLDiaLBox');
		//	document.getElementById("debugbottomspan").innerHTML = "DEBUG OUTPUT" + document.vicidial_form.MDPhonENumbeR.value + "|" + active_group_alias;

		var sending_group_alias = 0;
		var MDDiaLCodEform = document.getElementById('MDDiaLCodE_prefix').value;
		var MDPhonENumbeRform = document.vicidial_form.MDPhonENumbeR.value;
		var MDLeadIDform = document.vicidial_form.MDLeadID.value;
		var MDLeadIDEntryform = document.vicidial_form.MDLeadIDEntry.value;
		var MDTypeform = document.vicidial_form.MDType.value;
		var MDDiaLOverridEform = document.vicidial_form.MDDiaLOverridE.value;
		var MDVendorLeadCode = document.vicidial_form.vendor_lead_code.value;
		var MDLookuPLeaD = 'new';
		if ( (document.vicidial_form.LeadLookuP.checked==true) || (manual_dial_search_checkbox == 'SELECTED_LOCK') )
			{MDLookuPLeaD = 'lookup';}

		if (MDPhonENumbeRform == 'XXXXXXXXXX')
			{MDPhonENumbeRform = document.vicidial_form.MDPhonENumbeRHiddeN.value;}

		if (MDDiaLCodEform.length < 1)
			{MDDiaLCodEform = document.vicidial_form.phone_code.value;}

		if (MDLeadIDEntryform.length > 0)
			{MDLeadIDform = document.vicidial_form.MDLeadIDEntry.value;}

		if ( (MDDiaLOverridEform.length > 0) && (active_ingroup_dial.length < 1) && (manual_dial_override_field == 'ENABLED') )
		{
			agent_dialed_number=1;
			agent_dialed_type='MANUAL_OVERRIDE';
			basic_originate_call(session_id,'NO','YES',MDDiaLOverridEform,'YES','','1','0');
		}
		else
		{
			if (active_ingroup_dial.length < 1)
			{
				auto_dial_level=0;
				manual_dial_in_progress=1;
				agent_dialed_number=1;
			}
			MainPanelToFront();

			if ( (tempDiaLnow == 'PREVIEW') && (active_ingroup_dial.length < 1) )
			{
				//	alt_phone_dialing=1;
				agent_dialed_type='MANUAL_PREVIEW';
				buildDiv('DiaLLeaDPrevieW');
				if (alt_phone_dialing == 1)
					{buildDiv('DiaLDiaLAltPhonE');}
				document.vicidial_form.LeadPreview.checked=true;
				//	document.vicidial_form.DiaLAltPhonE.checked=true;
			}
			else
			{
				agent_dialed_type='MANUAL_DIALNOW';
				if ( (alt_number_dialing == 'SELECTED') || (alt_number_dialing == 'SELECTED_TIMER_ALT') || (alt_number_dialing == 'SELECTED_TIMER_ADDR3') )
				{
					document.vicidial_form.DiaLAltPhonE.checked=true;
				}
				else
				{
					document.vicidial_form.LeadPreview.checked=false;
					document.vicidial_form.DiaLAltPhonE.checked=false;
				}
			}
			if (active_group_alias.length > 1)
				{var sending_group_alias = 1;}
     // //console.log('XXXXXXXXXX'+MDDiaLCodEform);
			ManualDialNext("",MDLeadIDform,MDDiaLCodEform,MDPhonENumbeRform,MDLookuPLeaD,MDVendorLeadCode,sending_group_alias,MDTypeform);
		}

		document.vicidial_form.MDPhonENumbeR.value = '';
		document.vicidial_form.MDDiaLOverridE.value = '';
		document.vicidial_form.MDLeadID.value = '';
		document.vicidial_form.MDLeadIDEntry.value='';
		document.vicidial_form.MDType.value = '';
		document.vicidial_form.MDPhonENumbeRHiddeN.value = '';
	}
}


  function btx_InternalChatContentsLoad(ICHrefresh)
    {
    if (ICHrefresh=='YES')
      {button_click_log = button_click_log + "" + SQLdate + "-----InternalChatContentsLoad---|";}   var form_list_id = document.vicidial_form.list_id.value;
    var form_list_id = document.vicidial_form.list_id.value;
    var form_entry_list_id = document.vicidial_form.entry_list_id.value;
    var form_chat_id = document.vicidial_form.chat_id.value;
    if (form_entry_list_id.length > 2)
      {form_list_id = form_entry_list_id}
    document.getElementById('btx_InternalChatIFrame').src='./btx_agc_agent_manager_chat_interface.php?lead_id=' + document.vicidial_form.lead_id.value + '&list_id=' + form_list_id + '&user=' + user + '&pass=' + orig_pass;
    form_list_id = '';
    form_chat_id = '';
    form_entry_list_id = '';
    InternalChatPanelToFront();
    }

function refresh_agents_view_btx(RAlocation,RAcount,RAgroupselected,RAvalidation)
{
  if (RAcount > 0)
  {
    if (even > 0)
    {
      var xmlhttp=false;
      /*@cc_on @*/
        /*@if (@_jscript_version >= 5)
        // JScript gives us Conditional compilation, we can cope with old IE versions.
        // and security blocked creation of the objects.
         try {
          xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
         } catch (e) {
          try {
           xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          } catch (E) {
           xmlhttp = false;
          }
         }
         @end @*/
         if (!xmlhttp && typeof XMLHttpRequest!='undefined')
         {
          xmlhttp = new XMLHttpRequest();
        }
        if (xmlhttp) 
        { 
          RAview_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=AGENTSview&format=text&user=" + user + "&pass=" + pass + "&user_group=" + VU_user_group + "&conf_exten=" + session_id + "&extension=" + extension + "&protocol=" + protocol + "&stage=" + agent_status_view_time + "&campaign=" + campaign + "&comments=" + RAlocation + "&group_name=" + RAgroupselected + "&status=" + RAvalidation;
          xmlhttp.open('POST', 'vdc_db_query_btx.php'); 
          xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
          xmlhttp.send(RAview_query); 
          xmlhttp.onreadystatechange = function() 
          { 
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
            {
              var newRAlocationHTML = xmlhttp.responseText;
            //  alert(newRAlocationHTML);

            if (RAlocation == 'AgentXferViewSelect') 
            {
              document.getElementById(RAlocation).innerHTML = newRAlocationHTML + "\n<br /><br /><a href=\"#\" onclick=\"AgentsXferSelect('0','AgentXferViewSelect');return false;\><?php echo _QXZ("Close Window"); ?></a>&nbsp;";
            }
            else
            {

              $('#otheragentsstatuses').html(newRAlocationHTML);
            }
          }
        }
        delete xmlhttp;
      }
    }
  }
}



/////

</script>
