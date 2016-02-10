jQuery(document).ready(function($) {


	$( ".add_insurance").click(function(event) {

		//cancel the default button event
		event.preventDefault();

	 	jQuery.ajax({
			type: "POST",
			url: "../add-insurance-backend-page",
			dataType: "html",
			data: "insurance_id=" + $(this).attr("data-product-id") ,
			success: function (response) {
			    
			    //alert('yo')	


			    //trigger update cart button
				$( ".button" ).trigger( "click" );			    

				//$(location).attr('href','checkout');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr.status);
			    console.log(thrownError);
			}
		});
		

	});	

});	