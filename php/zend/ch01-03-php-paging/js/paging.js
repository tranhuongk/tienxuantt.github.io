var itemsPerPage	= 5;
var pages			= 0;
var totalItems		= 0;
var currentPage		= 1;

function init(){
	$.ajax({
		url		: 'load-data.php',
		data	: {type: 'count', items: itemsPerPage },
		type	: 'POST',
		dataType: 'json'
	}).done(function(data){
		pages		= data.pages;
		totalItems	= data.totals;
		
		setPageInfo();

		for(var i = 1; i <= pages; i++){
			$('#slbPages').append('<option value="' + i + '">Page ' + i +'</option>');
		}
		
		loadData();
	});
}

function setPageInfo(){
	$('.pageInfo').text('Page ' + currentPage + ' of ' + pages);
	
	$('#slbPages').val(currentPage);
	
	if(currentPage == 1){
		$('.goPrevious').attr('disabled','disabled');
	}else{
		$('.goPrevious').removeAttr('disabled');
	}
	
	if(currentPage == pages){
		$('.goNext').attr('disabled','disabled');
	}else{
		$('.goNext').removeAttr('disabled');
	}
}


function loadData(){
	$.ajax({
		url		: 'load-data.php',
		data	: {type: 'list', page: currentPage, items: itemsPerPage },
		type	: 'POST',
		dataType: 'json'
	}).done(function(data){
		if(data.length > 0){
			$('.content-course').empty();
			var xhtml = '';
			$.each(data, function(i, val){
				xhtml += '<div class="media">';
				xhtml += 	'<a class="pull-left" href="#">';
				xhtml += 		'<img class="media-object"; src="data/'+ val.image + '">';
				xhtml += 	'</a>';
				xhtml += 	'<div class="media-body">';
				xhtml += 		'<h4 class="media-heading">'+ val.name + '</h4>' + val.description;
				xhtml += 	'</div>';
				xhtml += '</div>';
			});
			$('.content-course').append(xhtml);
		}
	});
}

$(document).ready(function(){

	init();
	
	$('#slbPages').on('change',function(){
		currentPage	= parseInt($(this).val());
		setPageInfo();
		loadData();
	});
	
	$('.goPrevious').on('click',function(){
		if(currentPage != 1){
			currentPage = currentPage - 1;	
			setPageInfo();
			loadData();
		}
	});
	
	$('.goNext').on('click',function(){
		if(currentPage != pages){
			currentPage = currentPage + 1;	
			setPageInfo();
			loadData();
		}
	});	
})