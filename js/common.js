
var basePath = $('base').attr('href');
var cookiePath = basePath.substring(location.protocol.length + location.host.length + 2, basePath.length);


if (!window.console) {
	var console = { log:function(s){}, debug:function(s){} };
}

function isIE() {
	return $.browser.msie ? true : false;
}

function isIE9() {
	return (isIE() && $.browser.version == 9);
}

function isLtIE(n) {
	return (isIE() && $.browser.version < n);
}

function forceRefresh() {
	$.cookie('force_refresh', true, { expires: 1, path: cookiePath, domain: location.hostname });
	refresh();
	return false;
}

function refresh() {
	location.reload();
	return false;
}

function jumpPage(e) {
	if (e.keyCode == 37 && prevPage.length > 0)
		location.href = $('base').attr('href') + prevPage;
	if (e.keyCode == 39 && nextPage.length > 0)
		location.href = $('base').attr('href') + nextPage;
}