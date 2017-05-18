var jshover = function()
{
	var menuDiv = document.getElementById("horizontal-multilevel-menu")
	if (!menuDiv)
		return;

	var sfEls = menuDiv.getElementsByTagName("li");
	for (var i=0; i<sfEls.length; i++) 
	{
		sfEls[i].onmouseover=function()
		{
			this.className+=" jshover";
		}
		sfEls[i].onmouseout=function() 
		{
			this.className=this.className.replace(new RegExp(" jshover\\b"), "");
		}
	}
}

$(document).ready( function() {
	$("#horizontal-multilevel-menu li:last-child a[href='/']").on("click", function() {
		document.location.href = 'http://www.sogrevay.ru';
		return false;
	});
});

if (window.attachEvent) 
	window.attachEvent("onload", jshover);