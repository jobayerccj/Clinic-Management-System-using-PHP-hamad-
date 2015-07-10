$(function(){
$.ajax({
	    url:"index.php",
        type:"POST",
        data:"actionfunction=getClientRecords&page=1",
        cache: false,
        success: function(response){   
		  $('#pagination').html(response); 
		}
	   });
    $('#pagination').on('click','.page-numbers',function(){
       $page = $(this).attr('href');
	   $pageind = $page.indexOf('page=');
	   $page = $page.substring(($pageind+5));     
	   $.ajax({
	     url:"index.php",
                  type:"POST",
                  data:"actionfunction=getClientRecords&page="+$page,
        cache: false,
        success: function(response){   
		  $('#pagination').html(response); 
		}
	   });
	return false;
	});
});

	   

