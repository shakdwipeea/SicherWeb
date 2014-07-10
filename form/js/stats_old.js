(function () {
	var noOfUsers,
		snames,
		req1 = false,
		req2 = false,
		d;
	//alert('hello');
	var request = $.post('http://127.0.0.1:8000/userList',function (data) {
		console.log(data);
		 noOfUsers = data.split(',');
		console.log(noOfUsers[1]);
	})
	.fail (function () {
		console.log('Request failed');
	});



	function graph () {
		var data = [],
			temp = [];
		for (var i = 0; i < (snames.length-1); i++) {
			data.push([noOfUsers[i],snames[i],'#330066']);
			console.log(data);
		};
		console.log(data);
		$('#graph').jqBarGraph({
			data:data
		});
	}	



	request.done(function () {
		req1 = true;
		var request2 = $.post('http://127.0.0.1:8000/sname',function (data) {
		console.log(data);
		snames = data.split(',');
		console.log('It is' , snames[1]);
		delete snames[snames.length-1];

		snames.forEach(function(sname) {$('.gb_8').append('<button>'+ sname + '</button>');});

		})
		.fail (function () {
		console.log('Request failed');
		});
		request2.done(function () {
		req2 = true;
		if(req1){
			graph();
		}
		});

	});

	
/*
	$('.drop').on('click','button', function () {
		$('#details').slideUp();
		$('h2').remove();	
		$('#det').remove();
		var $but = $(this);
		var text = $but.text();
		var req3 = $.post('http://127.0.0.1:8000/details',{sname: text},function (data) {
			 d = JSON.parse(data);
				//console.log(d[0].user);
		})

		.done(function () {
			var html = "<h2>Total users " + d.length + "<h2>" +
					"<table id = 'det'>" +
						"<tr>" +
							"<th>" + "Users" + "</th>" +
						"</tr>" +
					"</table>";
			$('#graph').slideUp();
			setTimeout(function(){
				$('#details').append(html);
				d.forEach(function(d) {
					if(d.user)
					$('#det').append("<tr class = 'cont'><td>" + d.user + "</td></tr>");
					
				});
				$('#details').slideDown();
			},600);
		});
	});*/


	$('#direct').on('click','button',function(){
		var $but = $(this);
		console.log($but);
		if($but.text() == 'Home') {
			window.location.replace ('http://127.0.0.1/CloudSecure/form/index.php');
		} else if($but.text() == 'Overview'){
			$('#details').slideUp();
			$('#graph').slideDown();
		}
	});
	var down = false;

	$('#menu')
		/*.on('mouseenter',function() {
			var $img = $(this);
			$img.attr('src','./images/m.png');
			//$img.css('border','1px solid #ffffff');
		})
		.on('mouseleave',function() {
			var $img = $(this);
			//$img.attr('src','./images/menu_hove.png');
			$img.css('backgroundColor','#00ffff')
		})*/
		.on('click',function(){
			var drop = $('.drop');
			var b = $('.gb_8');
			if(down) {
				b.slideUp();
				setTimeout(function () {drop.slideUp();},600);

				down = false;
			}	else {
				drop.slideDown();
				setTimeout(function () {b.slideDown();},600);
				down=true;
			}
			
		});
	
})();