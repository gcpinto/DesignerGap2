$(document).ready(function()
{
	$(window).resize(function(){
		LoadGlobal();
	});
	
	LoadGlobal();
		
});

function LoadGlobal()
{
	$('div#jp-container')
		.bind(
			'jsp-initialised',
			function(event, isScrollable)
			{
			console.log('Handle jsp-initialised', this,
						'isScrollable=', isScrollable);
		}
	)
		.bind(
			'jsp-scroll-y',
			function(event, scrollPositionY, isAtTop, isAtBottom)
			{
				console.log('Handle jsp-scroll-y', this,
							'scrollPositionY=', scrollPositionY,
							'isAtTop=', isAtTop,
							'isAtBottom=', isAtBottom);
			}
		)
	/*	.bind(
			'jsp-scroll-x',
			function(event, scrollPositionX, isAtLeft, isAtRight)
			{
				console.log('Handle jsp-scroll-x', this,
							'scrollPositionX=', scrollPositionX,
							'isAtLeft=', isAtLeft,
							'isAtRight=', isAtRight);
			}
		)*/
		.bind(
			'jsp-arrow-change',
			function(event, isAtTop, isAtBottom, isAtLeft, isAtRight)
			{
				console.log('Handle jsp-arrow-change', this,
							'isAtTop=', isAtTop,
							'isAtBottom=', isAtBottom,
							'isAtLeft=', isAtLeft,
							'isAtRight=', isAtRight);
			},
			function scrolly()
			{
				var value = $('div#jp.container').ScrollTo();
				alert(value);
			}
		)
		.jScrollPane();
}
			
function pageTabul(type)
{
	//alert('passa');
	if (type=="next")
	{
		$("ul.tabul").css("margin-left","-736px");
		//activate button styte
	}
	else if (type=="prev")
	{
		$("ul.tabul").css("margin-left","0px");
	}
}



function selTabul(type)
{
	//alert('passa');
	if (type=="lastest")
	{
		$("ul.tabul").css("margin-left","0px");
		//activate button styte
	}
	else if (type=="today")
	{
		$("ul.tabul").css("margin-left","-583px");
	}
	else if (type=="week")
	{
		$("ul.tabul").css("margin-left","-1166px");
	}
	else if (type=="alltime")
	{
		$("ul.tabul").css("margin-left","-1749px");
	}
}


