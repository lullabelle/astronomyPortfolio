//jQuery for hero div on home page

jQuery(document).ready(function($){

// fade the header in 
	 jQuery('#hero_header').fadeIn(5000);
 // Defining a function to set size for #hero 
	function fullscreen(){
		jQuery('#hero').css({
            width: jQuery(window).width(),
            height: jQuery(window).height()
        });
	}
  
	fullscreen();

  // Run the function in case of window resize
  jQuery(window).resize(function() {
       fullscreen();         
    });


    
 
        
    	
	
	

});