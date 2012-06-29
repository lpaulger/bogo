jQuery(function($){
				
		   $('.datepicker').datepicker();
		   Cufon.replace('h3, h1, .karmaPoints, .morePlus, .vcVendorName');
		   
		   $('.signupButton').click(function(){
		   		var toLoad = $(this).attr('href')+'#content';

		   	});


		   $('#container').masonry({
			  itemSelector: '.item',
			  columnWidth: 240,
			  animationOptions: {
			    duration: 400
			  }
			});
});


jQuery(function($){
				$(".moreTriangle").click(function(){


				$(this).closest(".vendorNameContainer").animate({
    marginTop: '+=248',
  }, 1000, function() {
    // Animation complete.
  });



				});
		   
});