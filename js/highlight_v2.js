
// tooltip dev-notice
$(document).ready(function() {
	if ($('#dev-notice').css('display') == 'none')
		return;
	setTooltip('#dev-notice a', function(_this) {
		return 'Redirect to:<div style="font-size: 9px;">' + $(_this).attr("href") + '</div>';
	});
});

// tooltip item title
$(document).ready(function() {
	setTooltip('#font-resize .tooltip', function(_this) {
		return '<div class="_desc">' + $(_this).attr('desc') + '</div>';
	});
});

// tooltip all highlight
$(document).ready(function() {
	setTooltip('#text span.tooltip', function(_this) {
		return $(_this).attr('desc');
	});
});

// set tooltip with settings
function setTooltip(_select, _function) {
	$(_select).tooltip({
		track: true,
		delay: 0,
		showURL: false,
		bodyHandler: function() {
			return '<div class="body-bg"></div><div class="body-text">' + _function(this) + '</div>';
		},
		fade: 250,
		left: 25
	});
}
