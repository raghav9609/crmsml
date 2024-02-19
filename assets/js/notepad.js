$(document).ready(function(){
	$('#addnote').hide();
	$('#noteremarks').keypress(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		var remarks=$("#noteremarks").val()
		if($("#noteremarks").val().length>2)
        {
			$('#addnote').show();
        }
		if(keycode == '13'){
	// alert('gfg')		
	
	var level_id=$("#notelevel_id").val()
	var user=$("#noteuser").val()
	var level_type=$("#notelevel_type1").val()
	// alert(level_type)
	
	var data={"remarks":remarks,"level_id":level_id,"user":user,"level_type":level_type}      
	$.post( "../insert/add_notes.php", data,function(return_data,status){
		
		$.ajax({
			type: "POST",
			url: "../insert/lastfivenotes.php",
			data: "userid="+user,
			success: function(msg) {
				// console.log(msg);
				$("#lastfive").html(msg);
			}
		});
		$('#addnote').hide();
		$("#noteremarks").val('')
															}); 
		}
	});

    // $("#remarks").keyup(function(){
    //     if($("#remarks").val().length>2)
    //     {
	// 		$('#addnote').show();
    //     }
	// 	});
		$("#addnote").click(function(){
			var remarks=$("#noteremarks").val()
			var level_id=$("#notelevel_id").val()
			var user=$("#noteuser").val()
			var level_type=$("#notelevel_type1").val()
			// alert(level_type)
			var data={"remarks":remarks,"level_id":level_id,"user":user,"level_type":level_type}      
			$.post( "../insert/add_notes.php", data,function(return_data,status){
				// alert(return_data)
													$("#msg").html(return_data);
													// $(".header").removeClass("open");
		// $(".header").slideUp(400);
				// $(".menu-btn").find("i").removeClass().addClass("fa fa-file-text-o");
				$.ajax({
					type: "POST",
					url: "../insert/lastfivenotes.php",
					data: "userid="+user,
					success: function(msg) {
						// console.log(msg);
						$("#lastfive").html(msg);
					}
				});
				$('#addnote').hide();
				$("#noteremarks").val('')
																	});   
})

  $(".menu-btn").on('click',function(e){
	  e.preventDefault();
		
		//Check this block is open or not..
	  if(!$(this).prev().hasClass("open")) {
		  $(".header").slideDown(400);
		  $(".header").addClass("open");
		  $(this).find("i").removeClass().addClass("fa fa-times");
	  }
	  
	  else if($(this).prev().hasClass("open")) {
		  $(".header").removeClass("open");
		  $(".header").slideUp(400);
		  $(this).find("i").removeClass().addClass("fa fa-file-text-o");
	  }
  });
  var user=$("#note-user").val()

  $.ajax({
	type: "POST",
	url: "../insert/lastfivenotes.php",
	data: "userid="+user,
	success: function(msg) {
		console.log(msg);
		$("#lastfive").html(msg);
	}
});

}); 
