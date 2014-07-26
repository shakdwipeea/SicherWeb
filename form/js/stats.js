(function() {
	//alert('Hello');
	var data,
		noOfUsers,
		d,
		softwares = [];
	var request = $.post('http://sicherstats-20743.onmodulus.net/',function (Data) {
			data = JSON.parse(Data);
			console.log('Data' , data);
			//alert(data.punchcard);
	})
	.fail(function  () {
		// body...
		console.log('Request failed');
	});

	request.done( function () {
		//console.log(typeof data);
		
		for(var k in data) {
			softwares.push(k);
		}
		softwares.forEach(function(sname) {
			if(sname != 'noUsers')
			$('.gb_8').append('<button>'+ sname + '</button>');
		});
		noOfUsers = data.noUsers;
		var d = data['punchcard'];
		console.log('i',d[0].user);
		graph();
		console.log(noOfUsers);
	});

	function graph () {
		var d = [],
			temp = [];
		for (var i = 0; i < (softwares.length-1); i++) {
			d.push([noOfUsers[i],softwares[i],'#330066']);
			console.log(d);
		};
		console.log(d);
		$('#graph').jqBarGraph({
			data:d
		});
	}	


var d = {};

	$('.drop').on('click','button', function () {
		$('#details').slideUp();
		$('h2').remove();	
		$('#det').remove();
		var $but = $(this);
		var text = $but.text();
		var d = data[text];
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
	

	$('#direct').on('click','button',function(){
		var $but = $(this);
		console.log($but);
		if($but.text() == 'Home') {
			window.location.replace ('http://kyaji.in/form/index.php');
		} else if($but.text() == 'Overview'){
			$('#details').slideUp();
			$('#graph').slideDown();
		}
	});
	var down = false;

	$('#menu')
		
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