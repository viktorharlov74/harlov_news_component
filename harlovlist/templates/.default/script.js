$(document).ready(function(){
	$('.next_pagination').on('click', function(){
		var curent=$(this).attr('curentLast');
		var max=$(this).attr('allPage');
		if (max==curent)
		{
			$(this).hide();
		}
		else
		{
			if (curent>=5)
			{
				var hideEl=$(".visible-paginathion[number='"+(parseInt(curent)-4)+"']");
				hideEl.removeClass('visible-paginathion');
				hideEl.addClass(' hide-paginathion ');
				var curent=parseInt(curent)+1;
				$(this).attr('curentLast',curent);
				console.log(curent)
				var showEl=$(".hide-paginathion[number='"+(curent)+"']");
				showEl.removeClass(' hide-paginathion ');
				showEl.addClass(' visible-paginathion ');

			}
			
		}

	});
});