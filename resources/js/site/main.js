$(document).ready(function(){
	//Data table
		 $('.data-table').DataTable();

		


		 $('#userType').on('change', '', function (e) {
		 	if($(this).val()=="Institution"){
		 		$(".userSub").show();
		 	}else{
		 		$(".userSub").hide();
		 		$(".userSub input").val("");
		 	}
		 });


		 if($("#userType").length){
		 	if($("#userType").val()=="Institution"){
		 		$(".userSub").show();
		 	}else{
		 		$(".userSub").hide();
		 		$(".userSub input").val("");
		 	}
		 }



		 $("#monthly_sub_chk").change(function() {
	       
	        if($(this).is(":checked")) // "this" refers to the element that fired the event
	        {
	        	var cost = $(this).attr('data-cost');
	            swal({
		            title: "Thank You",
		            text: "Thanks for subscribing to our program. You will be charged monthly "+cost+"/child", 
		            icon: "success",
		            showCancelButton: false,
  					showConfirmButton: false,
		            dangerMode: false,
		        });
	        }

	    });

	 $("#monthly_subscribed").change(function() {
		       
	       var cost = $(this).attr('data-cost');
            var href = $(this).attr('data-url');

	        if($(this).is(":checked")) // "this" refers to the element that fired the event
	        {	
		        swal({
		            title: "Thank You",
		            text: "Thanks for subscribing to our program. You will be charged monthly "+cost+"/child", 
		            icon: "success",
		            buttons: true,
		            dangerMode: true,
		        })
		        .then((willDelete) => {
		          if (willDelete) {
		            window.location.href = href;
		          }
		        });
	        }else{
	        	swal({
		            title: "Are you sure ?",
		            text: "You will lose monthly benefits of this program", 
		            icon: "warning",
		            buttons: true,
		            dangerMode: true,
		        })
		        .then((willDelete) => {
		          if (willDelete) {
		            window.location.href = href;
		          }
		        });
	        }

	    });



	 	$(".waiting-list").hover(
		    function() {
		        $(this).text("Unsubscribe");
		        $(this).removeClass("btn-info").addClass('btn-danger');
		    },
		    function() {
		        $(this).text("Waiting List");
		        $(this).removeClass("btn-danger").addClass('btn-info');
		    }
		 );

		  $('.confirm').click(function(e){

			  	 e.preventDefault(); //cancel default action
		        //Recuperate href value
		        var href = $(this).attr('href');
		        var message = $(this).attr('data-msg');

		        //pop up
		        swal({
		            title: "Are you sure ?",
		            text: message, 
		            icon: "warning",
		            buttons: true,
		            dangerMode: true,
		        })
		        .then((willDelete) => {
		          if (willDelete) {
		            window.location.href = href;
		          }
		        });

		    });
});