$(document).ready(function() {
			
		$(window).resize(function(){
			LoadGlobal();
		});
		LoadGlobal();
		//alert($("div#jp-container-lnews").parent('li').height());
		
		$('#confirm').jqm({overlay: 88, modal: true, trigger: false});
 		 // trigger a confirm whenever links of class alert are pressed.
  		$('submit').click(function(email) { 
  		 $.ajax({
  		 	type:"POST", url: 'Ajax.php', data:"op=subscriptions&email=email",
  		 	success: alert('REGISTADO COM SUCESSO')
  		 })
  		});
		
		$("div.searchicon").click(function()
			{ $("div.searchtext").show("slide", { direction: "left" }, 1000); 
			//alert("ola");
			//this.css("display: none;");
			});
		
		$('div#jp-container-lnews').scroll(function(){
			var val = $("div.jspDrag", this).css("top");
			var val2 = $("div.jspDrag", this).css("height");
			//alert( -(parseInt(val))) ;
			if (((parseInt(val2))+(parseInt(val))) == 1150)
			{
				//var target = $("div.jspContainer > div.jspPane > div#targetdiv");
				var target = $("div#targetdiv",this);
				var val = true;
				//alert ("... Ajax...")
				$.ajax({  
                type: "POST", url: 'Ajax.php', data: "op=GetData&id=16",
                beforeSend: function(){
                	while (val){
                	target.last().after('<img class="img" src="images/ajax-loader.gif" />')
                    val = false;
                	}
                },
                success: function(data){  
                //	alert(data);
                    //print results as appended   
                    target.last().after(data); 
                    $("img","div.jspContainer").remove();
                    refreshPane();
                  //  stop;
                   // alert("ResponseDATA")
                    //print result in targetDiv  
                  //   $("div.jspContainer > div.jspPane > div#targetdiv").html(data.responseText);  
                }
                });  
			}
		})
		$('div#jp-container-ptoday').scroll(function(){
			var val = $("div.jspDrag", this).css("top");
			var val2 = $("div.jspDrag", this).css("height");
			//alert( -(parseInt(val))) ;
			if (((parseInt(val2))+(parseInt(val))) == 1150)
			{
				//var target = $("div.jspContainer > div.jspPane > div#targetdiv");
				var target = $("div#targetdiv",this);
				var val = true;
				//alert ("... Ajax...")
				$.ajax({  
                type: "POST", url: 'Ajax.php', data: "op=Getptoday&id=16",
                beforeSend: function(){
                	while (val){
                	target.last().after('<img class="img" src="images/ajax-loader.gif" />')
                    val = false;
                	}
                },
                success: function(data){  
                //	alert(data);
                    //print results as appended   
                    target.last().after(data); 
                    $("img","div.jspContainer").remove();
                    refreshPane();
                  //  stop;
                   // alert("ResponseDATA")
                    //print result in targetDiv  
                  //   $("div.jspContainer > div.jspPane > div#targetdiv").html(data.responseText);  
                }
                });  
			}
		})
		$('div#jp-container-pweek').scroll(function(){
			var val = $("div.jspDrag", this).css("top");
			var val2 = $("div.jspDrag", this).css("height");
			//alert( -(parseInt(val))) ;
			if (((parseInt(val2))+(parseInt(val))) == 1150)
			{
				//var target = $("div.jspContainer > div.jspPane > div#targetdiv");
				var target = $("div#targetdiv",this);
				var val = true;
				//alert ("... Ajax...")
				$.ajax({  
                type: "POST", url: 'Ajax.php', data: "op=Getpweek&id=16",
                beforeSend: function(){
                	while (val){
                	target.last().after('<img class="img" src="images/ajax-loader.gif" />')
                    val = false;
                	}
                },
                success: function(data){  
                //	alert(data);
                    //print results as appended   
                    target.last().after(data); 
                    $("img","div.jspContainer").remove();
                    refreshPane();
                  //  stop;
                   // alert("ResponseDATA")
                    //print result in targetDiv  
                  //   $("div.jspContainer > div.jspPane > div#targetdiv").html(data.responseText);  
                }
                });  
			}
		})
		$('div#jp-container-alltime').scroll(function(){
			var val = $("div.jspDrag", this).css("top");
			var val2 = $("div.jspDrag", this).css("height");
			//alert( -(parseInt(val))) ;
			if (((parseInt(val2))+(parseInt(val))) == 1150)
			{
				//var target = $("div.jspContainer > div.jspPane > div#targetdiv");
				var target = $("div#targetdiv",this);
				var val = true;
				//alert ("... Ajax...")
				$.ajax({  
                type: "POST", url: 'Ajax.php', data: "op=GetAllTime&id=16",
                beforeSend: function(){
                	while (val){
                	target.last().after('<img class="img" src="images/ajax-loader.gif" />')
                    val = false;
                	}
                },
                success: function(data){  
                //	alert(data);
                    //print results as appended   
                    target.last().after(data); 
                    $("img","div.jspContainer").remove();
                    refreshPane();
                  //  stop;
                   // alert("ResponseDATA")
                    //print result in targetDiv  
                  //   $("div.jspContainer > div.jspPane > div#targetdiv").html(data.responseText);  
                }
                });  
			}
		})

});

/***************************************************************************************
 * **********************************************************************************
 */
 /* Overriding Javascript's Confirm Dialog */

// NOTE; A callback must be passed. It is executed on "cotinue". 
//  This differs from the standard confirm() function, which returns
//   only true or false!

// If the callback is a string, it will be considered a "URL", and
//  followed.

// If the callback is a function, it will be executed.


function confirm(msg,callback) {
  $('#confirm')
    .jqmShow()
    .find('p.jqmConfirmMsg')
      .html(msg)
    .end()
    .find(':submit:visible')
      .click(function(){
        if(this.value == 'yes')
          (typeof callback == 'string') ?
            window.location.href = callback :
            callback();
        $('#confirm').jqmHide();
      });
}
/****************************************************************************************/

 
function refreshPane() {
   			var pane = $('div#jp-container-lnews').each(function(){
	    			var api = $(this).data('jsp');
	   				api.reinitialise();
   				}); 
   			var pane = $('div#jp-container-pweek').each(function(){
		    		var api = $(this).data('jsp');
		   			api.reinitialise();
   				}); 
   			var pane = $('div#jp-container-ptoday').each(function(){
		    		var api = $(this).data('jsp');
		   			api.reinitialise();
		 		});    
		} 
 

function twitter(d,s,id)
	{
		var js,fjs=d.getElementsByTagName(s)[0];
		if(!d.getElementById(id))
			{
				js=d.createElement(s);
				js.id=id;js.src="//platform.twitter.com/widgets.js";
				fjs.parentNode.insertBefore(js,fjs);
			}
	}
	




function history(id)
{
	$.ajax(
		{
			type: "POST", url: 'Ajax.php', data: "op=UpdateHistory&id="+id,
			//success: alert("id="+id+" foi actualizado com sucesso")
		}
	)
}
			
function LoadGlobal ()
{
	var $el = $('div#jp-container-lnews').jScrollPane({
		verticalGutter 	: -16
	}),
		
				
				// the extension functions and options
    extensionPlugin     = {
 
        extPluginOpts   : {
            // speed for the fadeOut animation
            mouseLeaveFadeSpeed : 500,
 
            // scrollbar fades out after
            // hovertimeout_t milliseconds
            hovertimeout_t      : 1000,
 
            // if set to false, the scrollbar will
            // be shown on mouseenter and hidden on
            // mouseleave
            // if set to true, the same will happen,
            // but the scrollbar will be also hidden
            // on mouseenter after "hovertimeout_t" ms
            // also, it will be shown when we start to
            // scroll and hidden when stopping
            useTimeout          : false,
 
            // the extension only applies for devices
            // with width > deviceWidth
            deviceWidth         : 980
        },
        hovertimeout    : null,
        // timeout to hide the scrollbar
 
        isScrollbarHover: false,
        // true if the mouse is over the scrollbar
 
        elementtimeout  : null,
        // avoids showing the scrollbar when moving
        // from inside the element to outside, passing
        // over the scrollbar
 
        isScrolling     : false,
        // true if scrolling
 
        addHoverFunc    : function() {
 
            // run only if the window has a width bigger than deviceWidth
            if( $(window).width() <= this.extPluginOpts.deviceWidth ) return false;
 
            var instance        = this;
 
            // functions to show / hide the scrollbar
            $.fn.jspmouseenter  = $.fn.show;
            $.fn.jspmouseleave  = $.fn.fadeOut;
 
            // hide the jScrollPane vertical bar
            var $vBar           = this.getContentPane().siblings('.jspVerticalBar').hide();
 			/*  **/          
 
 
  
  
 			/*   **/
            /*
             * mouseenter / mouseleave events on the main element
             * also scrollstart / scrollstop
             * @James Padolsey : http://james.padolsey.com/javascript/special-scroll-events-for-jquery/
             */
            $el.bind('mouseenter.jsp',function() {
 
                // show the scrollbar
                $vBar.stop( true, true ).jspmouseenter();
 
                if( !instance.extPluginOpts.useTimeout ) return false;
 
                // hide the scrollbar after hovertimeout_t ms
                clearTimeout( instance.hovertimeout );
                instance.hovertimeout   = setTimeout(function() {
                    // if scrolling at the moment don't hide it
                    if( !instance.isScrolling )
                        $vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
                }, instance.extPluginOpts.hovertimeout_t );
 
            }).bind('mouseleave.jsp',function() {
 
                // hide the scrollbar
                if( !instance.extPluginOpts.useTimeout )
                    $vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
                else {
                clearTimeout( instance.elementtimeout );
                if( !instance.isScrolling )
                        $vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
                }
 
            });
 
            if( this.extPluginOpts.useTimeout ) {
 
                $el.bind('scrollstart.jsp', function() {
 
                    // when scrolling show the scrollbar
                    clearTimeout( instance.hovertimeout );
                    instance.isScrolling    = true;
                    $vBar.stop( true, true ).jspmouseenter();
 
                }).bind('scrollstop.jsp', function() {
 
                    // when stop scrolling hide the
                    // scrollbar (if not hovering it at the moment)
                    clearTimeout( instance.hovertimeout );
                    instance.isScrolling    = false;
                    instance.hovertimeout   = setTimeout(function() {
                        if( !instance.isScrollbarHover )
                            $vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
                    }, instance.extPluginOpts.hovertimeout_t );
 
                });
 
                // wrap the scrollbar
                // we need this to be able to add
                // the mouseenter / mouseleave events
                // to the scrollbar
                var $vBarWrapper    = $('<div/>').css({
                    position    : 'absolute',
                    left        : $vBar.css('left'),
                    top         : $vBar.css('top'),
                    right       : $vBar.css('right'),
                    bottom      : $vBar.css('bottom'),
                    width       : $vBar.width(),
                    height      : $vBar.height()
                }).bind('mouseenter.jsp',function() {
 
                    clearTimeout( instance.hovertimeout );
                    clearTimeout( instance.elementtimeout );
 
                    instance.isScrollbarHover   = true;
 
                    // show the scrollbar after 100 ms.
                    // avoids showing the scrollbar when moving
                    // from inside the element to outside,
                    // passing over the scrollbar
                    instance.elementtimeout = setTimeout(function() {
                        $vBar.stop( true, true ).jspmouseenter();
                    }, 100 );   
 
                }).bind('mouseleave.jsp',function() {
 
                    // hide the scrollbar after hovertimeout_t
                    clearTimeout( instance.hovertimeout );
                    instance.isScrollbarHover   = false;
                    instance.hovertimeout = setTimeout(function() {
                        // if scrolling at the moment
                        // don't hide it
                        if( !instance.isScrolling )
                            $vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
                    }, instance.extPluginOpts.hovertimeout_t );
 
                });
 
                $vBar.wrap( $vBarWrapper );
 
            }
 
        }
 
    },
 
    // the jScrollPane instance
    jspapi          = $el.data('jsp');
 
// extend the jScollPane by merging
$.extend( true, jspapi, extensionPlugin );
jspapi.addHoverFunc();

//////////////////////////////////////////////

var $el2 = $('div#jp-container-ptoday').jScrollPane({
				//var $el = $('.'+elem).jScrollPane({
					verticalGutter 	: -16
				}),
						
				// the extension functions and options
    extensionPlugin     = {
 
        extPluginOpts   : {
            // speed for the fadeOut animation
            mouseLeaveFadeSpeed : 500,
 
            // scrollbar fades out after
            // hovertimeout_t milliseconds
            hovertimeout_t      : 1000,
 
            // if set to false, the scrollbar will
            // be shown on mouseenter and hidden on
            // mouseleave
            // if set to true, the same will happen,
            // but the scrollbar will be also hidden
            // on mouseenter after "hovertimeout_t" ms
            // also, it will be shown when we start to
            // scroll and hidden when stopping
            useTimeout          : false,
 
            // the extension only applies for devices
            // with width > deviceWidth
            deviceWidth         : 980
        },
        hovertimeout    : null,
        // timeout to hide the scrollbar
 
        isScrollbarHover: false,
        // true if the mouse is over the scrollbar
 
        elementtimeout  : null,
        // avoids showing the scrollbar when moving
        // from inside the element to outside, passing
        // over the scrollbar
 
        isScrolling     : false,
        // true if scrolling
 
        addHoverFunc    : function() {
 
            // run only if the window has a width bigger than deviceWidth
            if( $(window).width() <= this.extPluginOpts.deviceWidth ) return false;
 
            var instance        = this;
 
            // functions to show / hide the scrollbar
            $.fn.jspmouseenter  = $.fn.show;
            $.fn.jspmouseleave  = $.fn.fadeOut;
 
            // hide the jScrollPane vertical bar
            var $vBar           = this.getContentPane().siblings('.jspVerticalBar').hide();
 			/*  **/          
 
 
  
  
 			/*   **/
            /*
             * mouseenter / mouseleave events on the main element
             * also scrollstart / scrollstop
             * @James Padolsey : http://james.padolsey.com/javascript/special-scroll-events-for-jquery/
             */
            $el2.bind('mouseenter.jsp',function() {
 
                // show the scrollbar
                $vBar.stop( true, true ).jspmouseenter();
 
                if( !instance.extPluginOpts.useTimeout ) return false;
 
                // hide the scrollbar after hovertimeout_t ms
                clearTimeout( instance.hovertimeout );
                instance.hovertimeout   = setTimeout(function() {
                    // if scrolling at the moment don't hide it
                    if( !instance.isScrolling )
                        $vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
                }, instance.extPluginOpts.hovertimeout_t );
 
            }).bind('mouseleave.jsp',function() {
 
                // hide the scrollbar
                if( !instance.extPluginOpts.useTimeout )
                    $vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
                else {
                clearTimeout( instance.elementtimeout );
                if( !instance.isScrolling )
                        $vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
                }
 
            });
 
            if( this.extPluginOpts.useTimeout ) {
 
                $el2.bind('scrollstart.jsp', function() {
 
                    // when scrolling show the scrollbar
                    clearTimeout( instance.hovertimeout );
                    instance.isScrolling    = true;
                    $vBar.stop( true, true ).jspmouseenter();
 
                }).bind('scrollstop.jsp', function() {
 
                    // when stop scrolling hide the
                    // scrollbar (if not hovering it at the moment)
                    clearTimeout( instance.hovertimeout );
                    instance.isScrolling    = false;
                    instance.hovertimeout   = setTimeout(function() {
                        if( !instance.isScrollbarHover )
                            $vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
                    }, instance.extPluginOpts.hovertimeout_t );
 
                });
 
                // wrap the scrollbar
                // we need this to be able to add
                // the mouseenter / mouseleave events
                // to the scrollbar
                var $vBarWrapper    = $('<div/>').css({
                    position    : 'absolute',
                    left        : $vBar.css('left'),
                    top         : $vBar.css('top'),
                    right       : $vBar.css('right'),
                    bottom      : $vBar.css('bottom'),
                    width       : $vBar.width(),
                    height      : $vBar.height()
                }).bind('mouseenter.jsp',function() {
 
                    clearTimeout( instance.hovertimeout );
                    clearTimeout( instance.elementtimeout );
 
                    instance.isScrollbarHover   = true;
 
                    // show the scrollbar after 100 ms.
                    // avoids showing the scrollbar when moving
                    // from inside the element to outside,
                    // passing over the scrollbar
                    instance.elementtimeout = setTimeout(function() {
                        $vBar.stop( true, true ).jspmouseenter();
                    }, 100 );   
 
                }).bind('mouseleave.jsp',function() {
 
                    // hide the scrollbar after hovertimeout_t
                    clearTimeout( instance.hovertimeout );
                    instance.isScrollbarHover   = false;
                    instance.hovertimeout = setTimeout(function() {
                        // if scrolling at the moment
                        // don't hide it
                        if( !instance.isScrolling )
                            $vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
                    }, instance.extPluginOpts.hovertimeout_t );
 
                });
 
                $vBar.wrap( $vBarWrapper );
 
            }
 
        }
 
    },
 
    // the jScrollPane instance
    jspapi          = $el2.data('jsp');
 
// extend the jScollPane by merging
$.extend( true, jspapi, extensionPlugin );
jspapi.addHoverFunc();
	
	
	
/////////////////////////////////////////////

var $el3 = $('div#jp-container-pweek').jScrollPane({
				//var $el = $('.'+elem).jScrollPane({
					verticalGutter 	: -16
				}),
						
				// the extension functions and options
    extensionPlugin     = {
 
        extPluginOpts   : {
            // speed for the fadeOut animation
            mouseLeaveFadeSpeed : 500,
 
            // scrollbar fades out after
            // hovertimeout_t milliseconds
            hovertimeout_t      : 1000,
 
            // if set to false, the scrollbar will
            // be shown on mouseenter and hidden on
            // mouseleave
            // if set to true, the same will happen,
            // but the scrollbar will be also hidden
            // on mouseenter after "hovertimeout_t" ms
            // also, it will be shown when we start to
            // scroll and hidden when stopping
            useTimeout          : false,
 
            // the extension only applies for devices
            // with width > deviceWidth
            deviceWidth         : 980
        },
        hovertimeout    : null,
        // timeout to hide the scrollbar
 
        isScrollbarHover: false,
        // true if the mouse is over the scrollbar
 
        elementtimeout  : null,
        // avoids showing the scrollbar when moving
        // from inside the element to outside, passing
        // over the scrollbar
 
        isScrolling     : false,
        // true if scrolling
 
        addHoverFunc    : function() {
 
            // run only if the window has a width bigger than deviceWidth
            if( $(window).width() <= this.extPluginOpts.deviceWidth ) return false;
 
            var instance        = this;
 
            // functions to show / hide the scrollbar
            $.fn.jspmouseenter  = $.fn.show;
            $.fn.jspmouseleave  = $.fn.fadeOut;
 
            // hide the jScrollPane vertical bar
            var $vBar           = this.getContentPane().siblings('.jspVerticalBar').hide();
 			/*  **/          
 
 
  
  
 			/*   **/
            /*
             * mouseenter / mouseleave events on the main element
             * also scrollstart / scrollstop
             * @James Padolsey : http://james.padolsey.com/javascript/special-scroll-events-for-jquery/
             */
            $el3.bind('mouseenter.jsp',function() {
 
                // show the scrollbar
                $vBar.stop( true, true ).jspmouseenter();
 
                if( !instance.extPluginOpts.useTimeout ) return false;
 
                // hide the scrollbar after hovertimeout_t ms
                clearTimeout( instance.hovertimeout );
                instance.hovertimeout   = setTimeout(function() {
                    // if scrolling at the moment don't hide it
                    if( !instance.isScrolling )
                        $vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
                }, instance.extPluginOpts.hovertimeout_t );
 
            }).bind('mouseleave.jsp',function() {
 
                // hide the scrollbar
                if( !instance.extPluginOpts.useTimeout )
                    $vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
                else {
                clearTimeout( instance.elementtimeout );
                if( !instance.isScrolling )
                        $vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
                }
 
            });
 
            if( this.extPluginOpts.useTimeout ) {
 
                $el3.bind('scrollstart.jsp', function() {
 
                    // when scrolling show the scrollbar
                    clearTimeout( instance.hovertimeout );
                    instance.isScrolling    = true;
                    $vBar.stop( true, true ).jspmouseenter();
 
                }).bind('scrollstop.jsp', function() {
 
                    // when stop scrolling hide the
                    // scrollbar (if not hovering it at the moment)
                    clearTimeout( instance.hovertimeout );
                    instance.isScrolling    = false;
                    instance.hovertimeout   = setTimeout(function() {
                        if( !instance.isScrollbarHover )
                            $vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
                    }, instance.extPluginOpts.hovertimeout_t );
 
                });
 
                // wrap the scrollbar
                // we need this to be able to add
                // the mouseenter / mouseleave events
                // to the scrollbar
                var $vBarWrapper    = $('<div/>').css({
                    position    : 'absolute',
                    left        : $vBar.css('left'),
                    top         : $vBar.css('top'),
                    right       : $vBar.css('right'),
                    bottom      : $vBar.css('bottom'),
                    width       : $vBar.width(),
                    height      : $vBar.height()
                }).bind('mouseenter.jsp',function() {
 
                    clearTimeout( instance.hovertimeout );
                    clearTimeout( instance.elementtimeout );
 
                    instance.isScrollbarHover   = true;
 
                    // show the scrollbar after 100 ms.
                    // avoids showing the scrollbar when moving
                    // from inside the element to outside,
                    // passing over the scrollbar
                    instance.elementtimeout = setTimeout(function() {
                        $vBar.stop( true, true ).jspmouseenter();
                    }, 100 );   
 
                }).bind('mouseleave.jsp',function() {
 
                    // hide the scrollbar after hovertimeout_t
                    clearTimeout( instance.hovertimeout );
                    instance.isScrollbarHover   = false;
                    instance.hovertimeout = setTimeout(function() {
                        // if scrolling at the moment
                        // don't hide it
                        if( !instance.isScrolling )
                            $vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
                    }, instance.extPluginOpts.hovertimeout_t );
 
                });
 
                $vBar.wrap( $vBarWrapper );
 
            }
 
        }
 
    },
 
    // the jScrollPane instance
    jspapi          = $el3.data('jsp');
 
// extend the jScollPane by merging
$.extend( true, jspapi, extensionPlugin );
jspapi.addHoverFunc();	


/////////////////////////////////////////////

var $el4 = $('div#jp-container-alltime').jScrollPane({
				//var $el = $('.'+elem).jScrollPane({
					verticalGutter 	: -16
				}),
						
				// the extension functions and options
    extensionPlugin     = {
 
        extPluginOpts   : {
            // speed for the fadeOut animation
            mouseLeaveFadeSpeed : 500,
 
            // scrollbar fades out after
            // hovertimeout_t milliseconds
            hovertimeout_t      : 1000,
 
            // if set to false, the scrollbar will
            // be shown on mouseenter and hidden on
            // mouseleave
            // if set to true, the same will happen,
            // but the scrollbar will be also hidden
            // on mouseenter after "hovertimeout_t" ms
            // also, it will be shown when we start to
            // scroll and hidden when stopping
            useTimeout          : false,
 
            // the extension only applies for devices
            // with width > deviceWidth
            deviceWidth         : 980
        },
        hovertimeout    : null,
        // timeout to hide the scrollbar
 
        isScrollbarHover: false,
        // true if the mouse is over the scrollbar
 
        elementtimeout  : null,
        // avoids showing the scrollbar when moving
        // from inside the element to outside, passing
        // over the scrollbar
 
        isScrolling     : false,
        // true if scrolling
 
        addHoverFunc    : function() {
 
            // run only if the window has a width bigger than deviceWidth
            if( $(window).width() <= this.extPluginOpts.deviceWidth ) return false;
 
            var instance        = this;
 
            // functions to show / hide the scrollbar
            $.fn.jspmouseenter  = $.fn.show;
            $.fn.jspmouseleave  = $.fn.fadeOut;
 
            // hide the jScrollPane vertical bar
            var $vBar           = this.getContentPane().siblings('.jspVerticalBar').hide();
 			/*  **/          
 
 
  
  
 			/*   **/
            /*
             * mouseenter / mouseleave events on the main element
             * also scrollstart / scrollstop
             * @James Padolsey : http://james.padolsey.com/javascript/special-scroll-events-for-jquery/
             */
            $el4.bind('mouseenter.jsp',function() {
 
                // show the scrollbar
                $vBar.stop( true, true ).jspmouseenter();
 
                if( !instance.extPluginOpts.useTimeout ) return false;
 
                // hide the scrollbar after hovertimeout_t ms
                clearTimeout( instance.hovertimeout );
                instance.hovertimeout   = setTimeout(function() {
                    // if scrolling at the moment don't hide it
                    if( !instance.isScrolling )
                        $vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
                }, instance.extPluginOpts.hovertimeout_t );
 
            }).bind('mouseleave.jsp',function() {
 
                // hide the scrollbar
                if( !instance.extPluginOpts.useTimeout )
                    $vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
                else {
                clearTimeout( instance.elementtimeout );
                if( !instance.isScrolling )
                        $vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
                }
 
            });
 
            if( this.extPluginOpts.useTimeout ) {
 
                $el4.bind('scrollstart.jsp', function() {
 
                    // when scrolling show the scrollbar
                    clearTimeout( instance.hovertimeout );
                    instance.isScrolling    = true;
                    $vBar.stop( true, true ).jspmouseenter();
 
                }).bind('scrollstop.jsp', function() {
 
                    // when stop scrolling hide the
                    // scrollbar (if not hovering it at the moment)
                    clearTimeout( instance.hovertimeout );
                    instance.isScrolling    = false;
                    instance.hovertimeout   = setTimeout(function() {
                        if( !instance.isScrollbarHover )
                            $vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
                    }, instance.extPluginOpts.hovertimeout_t );
 
                });
 
                // wrap the scrollbar
                // we need this to be able to add
                // the mouseenter / mouseleave events
                // to the scrollbar
                var $vBarWrapper    = $('<div/>').css({
                    position    : 'absolute',
                    left        : $vBar.css('left'),
                    top         : $vBar.css('top'),
                    right       : $vBar.css('right'),
                    bottom      : $vBar.css('bottom'),
                    width       : $vBar.width(),
                    height      : $vBar.height()
                }).bind('mouseenter.jsp',function() {
 
                    clearTimeout( instance.hovertimeout );
                    clearTimeout( instance.elementtimeout );
 
                    instance.isScrollbarHover   = true;
 
                    // show the scrollbar after 100 ms.
                    // avoids showing the scrollbar when moving
                    // from inside the element to outside,
                    // passing over the scrollbar
                    instance.elementtimeout = setTimeout(function() {
                        $vBar.stop( true, true ).jspmouseenter();
                    }, 100 );   
 
                }).bind('mouseleave.jsp',function() {
 
                    // hide the scrollbar after hovertimeout_t
                    clearTimeout( instance.hovertimeout );
                    instance.isScrollbarHover   = false;
                    instance.hovertimeout = setTimeout(function() {
                        // if scrolling at the moment
                        // don't hide it
                        if( !instance.isScrolling )
                            $vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
                    }, instance.extPluginOpts.hovertimeout_t );
 
                });
 
                $vBar.wrap( $vBarWrapper );
 
            }
 
        }
 
    },
 
    // the jScrollPane instance
    jspapi          = $el4.data('jsp');
 
// extend the jScollPane by merging
$.extend( true, jspapi, extensionPlugin );
jspapi.addHoverFunc();	
}
		
		

		
			
function pageTabul(type)
{
	//alert('passa');
	if (type=="next")
	{
		$("ul.tabul").css("margin-left","-736px");
		//activate button styte
		$("div.movebutton ul li").last().addClass("active");
		$("div.movebutton ul li").first().removeClass("active");
	}
	else if (type=="prev")
	{
		$("ul.tabul").css("margin-left","0px");
		$("div.movebutton ul li").first().addClass("active");
		$("div.movebutton ul li").last().removeClass("active");
	}
	
	
}





function selTabul(type)
{
	//alert('passa');
	if (type=="lastest")
	{
		$("ul.tabul").css("margin-left","0px");
		//activate button styte
		$("div.selbutton  ul li").first().addClass("active");
		$("div.selbutton  ul li:nth-child(2)").removeClass("active");
		$("div.selbutton  ul li:nth-child(3)").removeClass("active");
		$("div.selbutton ul li").last().removeClass("active");
		
	}
	else if (type=="today")
	{
		$("ul.tabul").css("margin-left","-583px");
		//activate button styte
		$("div.selbutton  ul li").first().removeClass("active");
		$("div.selbutton  ul li:nth-child(2)").addClass("active");
		$("div.selbutton  ul li:nth-child(3)").removeClass("active");
		$("div.selbutton ul li").last().removeClass("active");
	}
	else if (type=="week")
	{
		$("ul.tabul").css("margin-left","-1166px");
		//activate button styte
		$("div.selbutton  ul li").first().removeClass("active");
		$("div.selbutton  ul li:nth-child(2)").removeClass("active");
		$("div.selbutton  ul li:nth-child(3)").addClass("active");
		$("div.selbutton ul li").last().removeClass("active");
	}
	else if (type=="alltime")
	{
		$("ul.tabul").css("margin-left","-1749px");
		//activate button styte
		$("div.selbutton  ul li").first().removeClass("active");
		$("div.selbutton  ul li:nth-child(2)").removeClass("active");
		$("div.selbutton  ul li:nth-child(3)").removeClass("active");
		$("div.selbutton ul li").last().addClass("active");
	}
}
