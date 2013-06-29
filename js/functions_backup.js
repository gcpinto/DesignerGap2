

$(window).focus(function (){
 $("ul.tabul").css("margin-left","0px");
 $('.scroll-pane').jScrollPane();
 });

$(document).ready(function(){
	var widthTabul=0;
	$('jp-container').jScrollPane();
	test = $("div.container").width();
	$("ul.tabul > li").each(function(){
		//widthTabul += $(this).width();
		widthTabul += 582;
	});
	$("ul.tabul").css("width",widthTabul+50);
	
	$(window).resize(function (){
 				$("ul.tabul").css("margin-left","0px");
 				$('.scroll-pane').jScrollPane();
 		});
});


$(document).ready(function() {
    // Optimalisation: Store the references outside the event handler:
    var $window = $(window);
    var $pane = $('div#tabli');

    function checkWidth() {
        var windowsize = $window.width();
        if (windowsize > 440) {
            //if the window is greater than 440px wide then turn on jScrollPane..
            $pane.jScrollPane({
               scrollbarWidth:15, 
               scrollbarMargin:52
            });
        }
    }
    // Execute on load
    checkWidth();
    // Bind event listener
    $(window).resize(checkWidth);
});

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
		$("ul.tabul").css("margin-left","-1165px");
	}
	else if (type=="alltime")
	{
		$("ul.tabul").css("margin-left","-1747px");
	}
}



