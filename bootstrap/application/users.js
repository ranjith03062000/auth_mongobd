var baseUrl= $('#baseUrl').val();
$('.alert-danger').hide();
$(document).ready(function(){
var rowcount=0;
     $('#vendorsTable').DataTable({
     "processing": false,
      //"serverSide": true,
      "paging": true,
      "pageLength": 10  ,
      "searching": true,
     "bSort" : false,
      "info": true,
      orderCellsTop: true,
        fixedHeader: true,
        "lengthChange": false,
      ajax:{url:baseUrl+"/getusersList",dataSrc:""},
      "columns": [
          { "data": null,"sortable": false, 
              render: function (data, type, row, meta)
			  { 
               return  rowcount=rowcount+1;
              }  
            },
		{ "data": "full_name" },
		{ "data": "father_name" },
         { "data": "mother_name" },
		 { "data": "email" },
		 { "data": "phone_number" },
        {        
                 data: null,
                 "render": function ( data, type, row ) {
					var buttonHtml ='';
						buttonHtml+='<button id="tooltip" class="btn btn-primary" onclick="viewUser('+row.id +')" style="background-color: #158df7;border: #FF9770;"><span class="tooltiptext" style="margin-top:-3%;margin-left:-20px;font-size:13px;width:84px;">View User</span><i class=" ri-grid-fill"></i></button>&nbsp;';
						buttonHtml+='<button id="tooltip" class="btn btn-success btn-fw" onclick="editUser('+row.id +')"><span class="tooltiptext" style="margin-top:-3%;margin-left:-20px;font-size:13px;width:73px;">Edit User</span><i class="ri-pencil-line mr-0" style="font-size:15px;"></i></button>&nbsp;'
						buttonHtml+='<button id="tooltip" class="btn btn-danger" onclick="deleteUser('+row.id +')" style="background-color: #FF9770;border: #FF9770;"><span class="tooltiptext" style="margin-top:-3%;margin-left:-15px;width:96px;font-size:13px;">Delete User</span><i class="ri-delete-bin-line mr-0"></i></button>';
                   return buttonHtml;
				 }   
            }
      ]
    });
$('#vendors_form').validate({
    rules: {
        first_name: 
        {
            required: true,
        },
		middle_name: 
        {
            required: true,
        },
		last_name: 
        {
            required: true,
        },
		father_name: 
        {
			 required: true,
        },
		mother_name: 
        {
			 required: true,
        },
		email: 
        {
			email: true,
            required: true,
        },
		mobile_number: 
        {
            number:true,
            maxlength: 10,
            minlength: 10,
            required: true,
        },
		whatsapp_number: 
        {
            number:true,
            maxlength: 10,
            minlength: 10,
            required: true,
        },
		
    },
messages : {
	user_image: {
    required: "Enter First Name"
    },
    first_name: {
    required: "Enter First Name"
    },
	middle_name: {
    required: "Enter Middle Name"
    },
	last_name: {
    required: "Enter Last Name"
    },
	father_name: {
    required: "Enter Father Name"
    },
	mother_name: {
    required: "Enter Mother Name"
    },
	email: {
    required:"Enter Eamil Id"
    },
	mobile_number: {
    required: "Enter Mobile Number"
    },
	whatsapp_number: {
    required: "Enter Whatsapp Number"
    },
 },
  
    highlight: function(element) {
        $(element).closest('.form-control').addClass('error');
    },
    unhighlight: function(element) {
        $(element).closest('.form-control').removeClass('error');
    },
    submitHandler: function (form) {
            
     
      var formdata=$("#vendors_form").serialize();
      var id=$("#id").val();
    if(id!=""){
       
           var url=baseUrl+"/updateUsers";
    }
    else{
           var url=baseUrl+"/addUsers";
    }

    $.ajax({
			type: "POST",
            url:url,
			data: formdata,
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
           success: function(data)
           {
				   location.reload(); 
			   
           }
         });
  
      }
 });    


  });
function editUser(id) {
$("#first_name-error").hide();
$("#middle_name-error").hide();
$("#last_name-error").hide();
$("#father_name-error").hide();
$("#email-error").hide();
$("#mother_name-error").hide();
$("#mobile_number-error").hide();
$('#whatsapp_number-error').hide();
$.ajax({
        url:baseUrl+"/editUser",
        type: "post",
        data:{id:id,_token: $('meta[name="_token"]').attr('content')},
		dataType: "JSON",
        cache: false,
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data)
        {
            $('#id').val(data.id);
			$('#first_name').val(data.first_name);	
            $('#middle_name').val(data.middle_name);  
			$('#last_name').val(data.last_name);
			$('#father_name').val(data.father_name);
			$('#mother_name').val(data.mother_name);
			$('#email').val(data.email);
			$('#mobile_number').val(data.phone_number);
			$('#whatsapp_number').val(data.whatsapp_number);			
            $("#modal_form").modal("show");
            $('.modal-title').text('Edit User'); 
			$('#warehouse').prop('disabled', false);
            $('#modal_form input').attr('disabled', false);
			$("#modal_form").modal({
    		backdrop: 'static',
    		keyboard: false
		});
            $('#submit').show();
			$('#buttons').show();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

  
}
function viewUser(id) {
$('.alert-danger').hide();
$("#first_name-error").hide();
$("#middle_name-error").hide();
$("#last_name-error").hide();
$("#father_name-error").hide();
$("#email-error").hide();
$("#mother_name-error").hide();
$("#mobile_number-error").hide();
$('#whatsapp_number-error').hide();
$('.error').css("color:#382e2e;");
   $.ajax({
      url:baseUrl+"/editUser",
        type: "post",
        data:{id:id,_token: $('meta[name="_token"]').attr('content')},
		dataType: "JSON",
        cache: false,
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },     
        success: function(data)
        {
            $('#id').val(data.id);
			$('#id').val(data.id);
			$('#first_name').val(data.first_name);	
            $('#middle_name').val(data.middle_name);  
			$('#last_name').val(data.last_name);
			$('#father_name').val(data.father_name);
			$('#mother_name').val(data.mother_name);
			$('#email').val(data.email);
			$('#mobile_number').val(data.phone_number);
			$('#whatsapp_number').val(data.whatsapp_number);			
            $("#modal_form").modal("show");
            $('.modal-title').text('View User'); 
            $('#modal_form input').attr('disabled', true);
			$("#modal_form").modal({
    		backdrop: 'static',
    		keyboard: false
		});
			$('#buttons').hide();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

  
}
   
function deleteUser(id)
{
   $(".fades").modal({
    		backdrop: 'static',
    		keyboard: false
		});
	$(".fades").modal("show");
    $("#delete_id").val(id);
	$('.modal-title').text('Delete'); 
}
   
function deleteUserList(id){
	var id=$("#delete_id").val();
      $.ajax({
        url:baseUrl+"/deleteUserList",
        type: "post",
        data:{id:id,_token: $('meta[name="_token"]').attr('content')},
        dataType: "JSON",
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },	
        success: function(data)
        {
          if(data="success"){
           location.reload();
          }
          else{

          }

        },
        
    });
  }  
function modalView() {
$('.alert-danger').hide();
$('.alert-danger').hide();	
$("#first_name-error").hide();
$("#middle_name-error").hide();
$("#last_name-error").hide();
$("#father_name-error").hide();
$("#email-error").hide();
$("#mother_name-error").hide();
$("#mobile_number-error").hide();
$('#whatsapp_number-error').hide();
$('#vendors_form')[0].reset();
$('.modal-title').text('Add User'); 
$('#modal_form input').attr('disabled', false);
$("#modal_form").modal({
	backdrop: 'static',
    keyboard: false
});
$('#warehouse').prop('disabled', false);
$('#buttons').show();
}
function closeform(){
	$('#vendors_form')[0].reset();
}