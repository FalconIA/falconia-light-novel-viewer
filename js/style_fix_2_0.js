
function fixThumbTitleWidth() {
	var lineHeight = $.browser.msie ? 20 : parseInt($('.thumbWrapper .thumbTitle').css('line-height')); // 19
	//console.log('Line height : ' +  lineHeight + 'px');

	$('.thumbWrapper').each(function (i) {
		var thumb  = $(this);
		var id     = thumb.attr('id');
		var height = thumb.find('.thumbTitle').height();

		if (height > lineHeight) {
			var thumbTitle  = thumb.find('.thumbTitle');
			var titleHeight = thumbTitle.find('._title').height();

			if (height > titleHeight)
				var mode = 1; // Mode 1: only wrap subtitle to new line
			else
				var mode = 2; // Mode 2: title is too long, and wrap to new line

			var _title    = thumbTitle.find('._title');
			var _subtitle = thumbTitle.find('._subtitle');
			var maxWidth = '' + Math.max(_title.width(), _subtitle.width() + _subtitle.position().left - _title.position().left + ($.browser.msie ? 1 : 0)) + 'px';
			//console.log(id + ' (Mode ' + mode + ') : ' + maxWidth);
			thumbTitle.css('max-width', maxWidth);
		}
	});
}

function setPagelinkPosition() {
	var fixed = ($('#pagelink').css('position') == 'fixed');
	var id = (fixed ? '#pagelink-location' : '#pagelink');

	var right = $(document).width() - $(id).offset().left - $(id).outerWidth() - ($.browser.msie ? 18 : 0);
	var bottom = $(document).height() - $(id).offset().top - $(id).outerHeight();
	var css = 'position: fixed; right: ' + right + 'px; bottom: ' + bottom + 'px;';

	if (!fixed)
		$('#pagelink').appendTo($('#main'));

	$('#pagelink').css({right: '' + right + 'px', bottom: '' + bottom + 'px', position: 'fixed'});
}

function intialFontResize() {
	window.text_font_size = parseInt($('#text').css('font-size').replace('px', ''));

	var size = $.cookie('text_font_size');
	if (size && size > text_font_size && text_font_size <= text_font_size * 2)
		$('#text').css('font-size', size + 'px');

	$('#font-resize .tooltip').click(function() {
		var size = $.cookie('text_font_size');
		if (!size || size < text_font_size || text_font_size > text_font_size * 2)
			size = text_font_size
		else
			size = parseInt(size);

		var id = $(this).attr('id');
		if (id == '_font0') {
			size = text_font_size;
			$.cookie('text_font_size', 0, { expires: 0, path: cookiePath, domain: location.hostname });
		} else {
			if (id =='_font+')
				size += 2;
			else if (id == '_font-')
				size -= 2;

			if (size < text_font_size)
				size = text_font_size;
			else if (size > text_font_size * 2)
				size = text_font_size * 2;

			$.cookie('text_font_size', size, { expires: 30, path: cookiePath, domain: location.hostname });
		}

		$('#text').css('font-size','' + size + 'px');

		return false;
	});
}
