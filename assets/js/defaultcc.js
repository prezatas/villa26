/*$.ajaxLoad=true;
$.defaultPage='main.html';
$.subPagesDirectory='views/';
$.page404='views/pages/404.html';
$.mainContent=$('#ui-view');*/
$.navigation=$('nav > ul.nav');
$.panelIconOpened='icon-arrow-up';
$.panelIconClosed='icon-arrow-down';
$.brandPrimary='#20a8d8';
$.brandSuccess='#4dbd74';
$.brandInfo='#63c2de';
$.brandWarning='#f8cb00';
$.brandDanger='#f86c6b';
$.grayDark='#2a2c36';
$.gray='#55595c';
$.grayLight='#818a91';
$.grayLighter='#d1d4d7';
$.grayLightest='#f8f9fa';
'use strict';

function loadJS(jsFiles,pageScript){
	var body=document.getElementsByTagName('body')[0];
	for(var i=0;i<jsFiles.length;i++){
		appendScript(body,jsFiles[i])
	}
	if(pageScript){
		appendScript(body,pageScript)
	}
	init();
}

function appendScript(element,src){var async=(src.substring(0,4)==='http');var script=document.createElement('script');script.type='text/javascript';script.async=async;script.defer=async;script.src=src;async?appendOnce(element,script):element.appendChild(script);}
function appendOnce(element,script){var scripts=Array.from(document.querySelectorAll('script')).map(function(scr){return scr.src;});if(!scripts.includes(script.src)){element.appendChild(script)}}

if($.ajaxLoad){
	var paceOptions={elements:false,restartOnRequestAfter:false};
	var url=location.hash.replace(/^#/,'');
	
	if(url!=''){
		setUpUrl(url);
	}else{
		setUpUrl($.defaultPage);
	}
	
	$(document).on('click','.nav a[href!="#"]',
		function(e){
			var thisNav=$(this).parent().parent();
			if(thisNav.hasClass('nav-tabs')||thisNav.hasClass('nav-pills')){
				e.preventDefault();
			}else if($(this).attr('target')=='_top'){
				e.preventDefault();var target=$(e.currentTarget);
				window.location=(target.attr('href'));
			}else if($(this).attr('target')=='_blank'){
				e.preventDefault();
				var target=$(e.currentTarget);
				window.open(target.attr('href'));
			}else{
				e.preventDefault();
				var target=$(e.currentTarget);
				setUpUrl(target.attr('href'));
			}
		});
	
	
		$(document).on('click','a[href="#"]',function(e){
			e.preventDefault();
		});
		
		$(document).on('click','.sidebar .nav a[href!="#"]',
		function(e){
			if(document.body.classList.contains('sidebar-mobile-show')){
				document.body.classList.toggle('sidebar-mobile-show')
			}
		});
	}
	
	function setUpUrl(url){
		$('nav .nav li .nav-link').removeClass('active');
		$('nav .nav li.nav-dropdown').removeClass('open');
		$('nav .nav li:has(a[href!=""])').addClass('open');
		$('nav .nav a[href!=""]').addClass('active');
		loadPage(url);
	}
	
	function loadPage(url){
		$.ajax({
			type:'GET',
			url: base_url,
			dataType:'php',
			cache:false,
			async:false,
			beforeSend:function(){
				$.mainContent.css({opacity:0});
			},
			success:function(){
				Pace.restart();
				$('html, body').animate({scrollTop:0},0);
				$.mainContent.load($.url,null,function(responseText){
					window.location.hash=url;
				}).delay(250).animate({opacity:1},0);
			},
		});
	}

$(document).ready(function($){
	$.navigation.find('a').each(function(){
		var cUrl=String(window.location).split('?')[0];
		if(cUrl.substr(cUrl.length-1)=='#'){
			cUrl=cUrl.slice(0,-1);
		}
		if($($(this))[0].href==cUrl){
			$(this).addClass('active');
			$(this).parents('ul').add(this).each(function(){
				$(this).parent().addClass('open');
			});
		}
	});
	
	$.navigation.on('click','a',function(e){
		if($.ajaxLoad){
			e.preventDefault();
		}
		if($(this).hasClass('nav-dropdown-toggle')){
			$(this).parent().toggleClass('open');resizeBroadcast();
		}
	});
	
	function resizeBroadcast(){
		var timesRun=0;var interval=setInterval(function(){
			timesRun+=1;
			if(timesRun===5){
				clearInterval(interval);
			}
			if(navigator.userAgent.indexOf('MSIE')!==-1||navigator.appVersion.indexOf('Trident/')>0){
				var evt=document.createEvent('UIEvents');evt.initUIEvent('resize',true,false,window,0);window.dispatchEvent(evt);
			}else{
				window.dispatchEvent(new Event('resize'));
			}
		},62.5);
	}

	$('.sidebar-toggler').click(function(){
		$('body').toggleClass('sidebar-hidden');
		resizeBroadcast();
	});
	
	$('.sidebar-minimizer').click(function(){
		$('body').toggleClass('sidebar-minimized');
		resizeBroadcast();
	});
	
	$('.brand-minimizer').click(function(){
		$('body').toggleClass('brand-minimized');
	});
	
	$('.aside-menu-toggler').click(function(){
		$('body').toggleClass('aside-menu-hidden');
		resizeBroadcast();
	});
	
	$('.mobile-sidebar-toggler').click(function(){
		$('body').toggleClass('sidebar-mobile-show');
		resizeBroadcast();
	});
	
	$('.sidebar-close').click(function(){
		$('body').toggleClass('sidebar-opened').parent().toggleClass('sidebar-opened');
	});
	
	$('a[href="#"][data-top!=true]').click(function(e){
		e.preventDefault();
	});
	
});

	$('.card-actions').on('click','a, button',function(e){
		e.preventDefault();
		
		if($(this).hasClass('btn-close')){
			$(this).parent().parent().parent().fadeOut();
		}else if($(this).hasClass('btn-minimize')){
			if($(this).hasClass('collapsed')){
				$('i',$(this)).removeClass($.panelIconOpened).addClass($.panelIconClosed);
			}else{
				$('i',$(this)).removeClass($.panelIconClosed).addClass($.panelIconOpened);
			}
		}else if($(this).hasClass('btn-setting')){
			$('#myModal').modal('show');
		}
	});
	
	function capitalizeFirstLetter(string){
		return string.charAt(0).toUpperCase()+string.slice(1);
	}
	
	function init(url){
		$('[rel="tooltip"],[data-rel="tooltip"]').tooltip({"placement":"bottom",delay:{show:400,hide:200}});
		$('[rel="popover"],[data-rel="popover"],[data-toggle="popover"]').popover();
	}
	
	if(!Array.from){
		
		Array.from=(function(){
			
			var toStr=Object.prototype.toString;
			var isCallable=function(fn){
				return typeof fn==='function'||toStr.call(fn)==='[object Function]';
			};
			var toInteger=function(value){
				var number=Number(value);
				if(isNaN(number)){
					return 0;
				}
				if(number===0||!isFinite(number)){
					return number;
				}
				return(number>0?1:-1)*Math.floor(Math.abs(number));
			};
			
			var maxSafeInteger=Math.pow(2,53)-1;var toLength=function(value){
				var len=toInteger(value);return Math.min(Math.max(len,0),maxSafeInteger);
			};
			return function from(arrayLike){
				var C=this;
				var items=Object(arrayLike);
				
				if(arrayLike==null){
					throw new TypeError('Array.from requires an array-like object - not null or undefined');
				}
				
				var mapFn=arguments.length>1?arguments[1]:void undefined;var T;
				if(typeof mapFn!=='undefined'){
					if(!isCallable(mapFn)){
						throw new TypeError('Array.from: when provided, the second argument must be a function');
					}
					if(arguments.length>2){
						T=arguments[2];
					}
				}
				
				var len=toLength(items.length);
				var A=isCallable(C)?Object(new C(len)):new Array(len);
				var k=0;
				var kValue;
				while(k<len){
					kValue=items[k];
					if(mapFn){
						A[k]=typeof T==='undefined'?mapFn(kValue,k):mapFn.call(T,kValue,k);
					}else{
						A[k]=kValue;
					}
					k+=1;
				}
				A.length=len;return A;
			};
		}());
	}
	
	if(!Array.prototype.includes){
		Object.defineProperty(Array.prototype,'includes',{
			value:function(searchElement,fromIndex){
				if(this==null){
					throw new TypeError('"this" is null or not defined');
				}
				var o=Object(this);var len=o.length>>>0;
				
				if(len===0){
					return false;
				}
				var n=fromIndex|0;
				var k=Math.max(n>=0?n:len-Math.abs(n),0);
				
				function sameValueZero(x,y){
					return x===y||(typeof x==='number'&&typeof y==='number'&&isNaN(x)&&isNaN(y));
				}
				while(k<len){
					if(sameValueZero(o[k],searchElement)){return true;
				}
				k++;
			}
			return false;
			}});
	}
	

   /*function getSelectPhotos(){
      var arr = [];
      var inp = document.getElementById('fileupload');
for (var i = 0; i < inp.files.length; ++i) {
  var name = inp.files.item(i).name;
  arr.push(name);
}

var Len = arr.length;
var str=arr.toString();
$('#progress .progress-bar').css('width',100 + '%');
$("#files").text(str);
      } */
    
     function clickPhotos(){
         $('#progress .progress-bar').css('width',0 + '%');
        $('div.gallery').text("");
        $('div#files').text("");
     
     }
     
	 
	 $(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
                        var arr = [];

            for (var i = 0; i < input.files.length; ++i) {
                var filei=input.files.item(i);
              var name = input.files.item(i).name;
              
              var fileType=filei["type"];
              var res = fileType.split("/");
              var ValidImageTypes = ["image/gif", "image/jpg", "image/jpeg", "image/png"];
                        if ($.inArray(fileType, ValidImageTypes) < 0) {
                        alert("Invalid File Extention : "+ res[1]+" of "+name);
                        }else{
                            arr.push(name);
                                //var str1=input.files;
                                var reader = new FileReader();

                                reader.onload = function(event) {
                                    $($.parseHTML('<img id="f">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);

                                }

                                reader.readAsDataURL(input.files[i]);
                            
                            
                        }
                        
                        
                       
            }
            
            var filesAmount = arr.length;
                            if(filesAmount!=0){
                            $('#progress .progress-bar').css('width',100 + '%');
                            }
                            $("#files").text("No of images : "+filesAmount);
                            
             
        
        }

    };


    $('#fileupload').on('change', function() {
        imagesPreview(this, 'div.gallery');
    });
});
     
	 
	 
	 $(function() {
			$('.sortable').sortable();
			$('.handles').sortable({
				handle: 'span'
			});
			$('.connected').sortable({
				connectWith: '.connected'
			});
			$('.exclude').sortable({
				items: ':not(.disabled)'
			});
		});
		
function showhide()
 {
       var div = document.getElementById("newpost");
if (div.style.display !== "none") {
    div.style.display = "none";
}
else {
    div.style.display = "block";
}
 }



