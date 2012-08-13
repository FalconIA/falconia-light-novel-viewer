String.prototype.escapeHTML = function () {
	return(
		this.replace(/&(?!([a-z]{2,4}|#\d{1,3});)/g,'&amp;').replace(/>/g,'&gt;').replace(/</g,'&lt;').replace(/"/g,'&quot;').replace(/'/g,'&amp;#39;')//.replace(/&/g,'&amp;')
	);
};

var regexpext = new function() {
	console.warn("Not perfect when 'isMatchOrNot = false'.");//http://getfirebug.com/console.html

	function replaceCaption(originalString, pattern, replaceString, attributes, htmlEscapeMatch, escapeMatch) {
		if (pattern == undefined || pattern == null || pattern == '') {
			console.warning("No Pattern!");
			return originalString;
		}
		return replaceCaption2(originalString, new RegExp(pattern, attributes), replaceString, htmlEscapeMatch, escapeMatch);
	}
	this.replaceCaption = replaceCaption;

	function replaceCaption2(originalString, patternRegExp, replaceString, htmlEscapeMatch, escapeMatch) {
//		console.debug('##### Replace Caption ##################');
//		console.debug(patternRegExp);
		return originalString.replace(patternRegExp, function($0, $1, $2, $3, $4, $5, $6, $7, $8, $9) {
			//return $0;
//			console.debug('$0: ' + $0.substring(0,60).replace(/\r/g, '\\r').replace(/\n/g, '\\n')
//							+ '\r\n$1: ' + new String($1).substring(0,60).replace(/\r/g, '\\r').replace(/\n/g, '\\n')
//							+ '\r\n$2: ' + new String($2).substring(0,60).replace(/\r/g, '\\r').replace(/\n/g, '\\n')
//							+ '\r\n$3: ' + new String($3).substring(0,60).replace(/\r/g, '\\r').replace(/\n/g, '\\n')
//							+ '\r\n$4: ' + new String($4).substring(0,60).replace(/\r/g, '\\r').replace(/\n/g, '\\n')
//							+ '\r\n$5: ' + new String($5).substring(0,60).replace(/\r/g, '\\r').replace(/\n/g, '\\n')
//							+ '\r\n$6: ' + new String($6).substring(0,60).replace(/\r/g, '\\r').replace(/\n/g, '\\n')
//							+ '\r\n$7: ' + new String($7).substring(0,60).replace(/\r/g, '\\r').replace(/\n/g, '\\n')
//							+ '\r\n$8: ' + new String($8).substring(0,60).replace(/\r/g, '\\r').replace(/\n/g, '\\n'));
			//if ($1 == '圣女之锁') console.debug('##### Caption ##### ' + $1 + ' ## ' + htmlEscapeMatch + ' ## ' + escapeMatch + ' ## ' + $4);
			if (typeof(htmlEscapeMatch) == 'string' && htmlEscapeMatch.length > 0) {
				if (htmlEscapeMatch.indexOf('\\0') != -1) $0 = ($0 || '').escapeHTML();
				if (htmlEscapeMatch.indexOf('\\1') != -1) $1 = ($1 || '').escapeHTML();
				if (htmlEscapeMatch.indexOf('\\2') != -1) $2 = ($2 || '').escapeHTML();
				if (htmlEscapeMatch.indexOf('\\3') != -1) $3 = ($3 || '').escapeHTML();
				if (htmlEscapeMatch.indexOf('\\4') != -1) $4 = ($4 || '').escapeHTML();
				if (htmlEscapeMatch.indexOf('\\5') != -1) $5 = ($5 || '').escapeHTML();
				if (htmlEscapeMatch.indexOf('\\6') != -1) $6 = ($6 || '').escapeHTML();
				if (htmlEscapeMatch.indexOf('\\7') != -1) $7 = ($7 || '').escapeHTML();
				if (htmlEscapeMatch.indexOf('\\8') != -1) $8 = ($8 || '').escapeHTML();
				if (htmlEscapeMatch.indexOf('\\9') != -1) $9 = ($9 || '').escapeHTML();
			}
			if (typeof(escapeMatch) == 'string' && escapeMatch.length > 0) {
				if (escapeMatch.indexOf('\\0') != -1) $0 = escape($0 || '');
				if (escapeMatch.indexOf('\\1') != -1) $1 = escape($1 || '');
				if (escapeMatch.indexOf('\\2') != -1) $2 = escape($2 || '');
				if (escapeMatch.indexOf('\\3') != -1) $3 = escape($3 || '');
				if (escapeMatch.indexOf('\\4') != -1) $4 = escape($4 || '');
				if (escapeMatch.indexOf('\\5') != -1) $5 = escape($5 || '');
				if (escapeMatch.indexOf('\\6') != -1) $6 = escape($6 || '');
				if (escapeMatch.indexOf('\\7') != -1) $7 = escape($7 || '');
				if (escapeMatch.indexOf('\\8') != -1) $8 = escape($8 || '');
				if (escapeMatch.indexOf('\\9') != -1) $9 = escape($9 || '');
			}

			var replaceString2 = replaceString;
			if (typeof($0) != 'number') { replaceString2 = replaceString2.replace(/\\0/g, $0 || '');
			if (typeof($1) != 'number') { replaceString2 = replaceString2.replace(/\\1/g, $1 || '');
			if (typeof($2) != 'number') { replaceString2 = replaceString2.replace(/\\2/g, $2 || '');
			if (typeof($3) != 'number') { replaceString2 = replaceString2.replace(/\\3/g, $3 || '');
			if (typeof($4) != 'number') { replaceString2 = replaceString2.replace(/\\4/g, $4 || '');
			if (typeof($5) != 'number') { replaceString2 = replaceString2.replace(/\\5/g, $5 || '');
			if (typeof($6) != 'number') { replaceString2 = replaceString2.replace(/\\6/g, $6 || '');
			if (typeof($7) != 'number') { replaceString2 = replaceString2.replace(/\\7/g, $7 || '');
			if (typeof($8) != 'number') { replaceString2 = replaceString2.replace(/\\8/g, $8 || '');
			if (typeof($9) != 'number') { replaceString2 = replaceString2.replace(/\\9/g, $9 || '');
			}}}}}}}}}};
			//console.debug(replaceString2);
			return replaceString2;
		});
	}
	this.replaceCaption2 = replaceCaption2;

	function matchExtLookBehind(originalString, pattern, attributes, lookBehindPattern, isMatchOrNot) {
		if (pattern == undefined || pattern == null || pattern == '') {
			console.warning("No Pattern!");
			return new Array();
		}

		attributes = (attributes != undefined && attributes != null) ? attributes : '';
		lookBehindPattern = (lookBehindPattern != undefined && lookBehindPattern != null) ? lookBehindPattern : '';
		isMatchOrNot = (isMatchOrNot != undefined) ? new Boolean(isMatchOrNot).valueOf() : true;

		//console.debug('RUN 1');

		if (lookBehindPattern == '') {
			return originalString.match(new RegExp(pattern, attributes));
		}
		else {
			var r = new RegExp('(' + lookBehindPattern + ')?' + pattern, attributes);

			var matches = originalString.match(r);
			var matchesFix = Array();

			if (matches == null) {
				return null;
			}

			//console.debug('RUN 2');

			for (var i = 0; i < matches.length; i++) {
				var match = matches[i];
				//console.debug(match);
				if (isMatchOrNot) {
					if (match.search(new RegExp(lookBehindPattern, attributes)) != 0)
						continue;
					var _matches = match.match(new RegExp(lookBehindPattern, attributes));
					var _match = match.substring(_matches[0].length);
					//console.debug('behind: ' + _match);
					_matches = _match.match(new RegExp(pattern, attributes));
					if (_matches == null || _matches.length == 0)
						continue;
					matchesFix = matchesFix.concat([ _match ]);
					//console.debug('match');
				}
				else {
					//console.debug(match.search(new RegExp(lookBehindPattern, attributes)));
					if (match.search(new RegExp(lookBehindPattern, attributes)) == 0) {
						if (match.search(new RegExp(pattern, attributes)) != 0)
							continue;
						var _matches = match.match(new RegExp(pattern, attributes))
						if (_matches.length > 1 || _matches[0] != match)
							continue;
					}
					matchesFix = matchesFix.concat([ match ]);
					//console.debug('match');
				}
			}

			if (matchesFix.length == 0)
				return null;
			else
				return matchesFix;
		}
	}
	this.matchExtLookBehind = matchExtLookBehind;

	function isMatchExtLookBehind(originalString, pattern, attributes, lookBehindPattern, isMatchOrNot) {
		var matches = matchExtLookBehind(originalString, pattern, attributes, lookBehindPattern, isMatchOrNot);

		return (matches != null && matches.length > 0);
	}
	this.isMatchExtLookBehind = isMatchExtLookBehind;

	function replaceExtLookBehind(originalString, pattern, replaceString, attributes, lookBehindPattern, isMatchOrNot) {
		if (pattern == undefined || pattern == null || pattern == '') {
			console.warning("No Pattern!");
			return originalString;
		}

		replaceString = (replaceString != undefined && replaceString != null) ? replaceString : '';
		attributes = (attributes != undefined && attributes != null) ? attributes : '';
		lookBehindPattern = (lookBehindPattern != undefined && lookBehindPattern != null) ? lookBehindPattern : '';
		isMatchOrNot = (isMatchOrNot != undefined) ? new Boolean(isMatchOrNot).valueOf() : true;

		if (lookBehindPattern == '') {
			return originalString.replace(new RegExp(pattern, attributes), replaceString);
		}
		else {
			var r = new RegExp('(' + lookBehindPattern + ')?' + pattern, attributes);

			originalString = originalString.replace(r, function($0, $1, $2, $3) {
				//if (pattern.substr(1,4) == '最终信号') console.debug(r);
				//if (pattern.substr(1,4) == '最终信号') console.debug($0);
				//if (pattern.substr(1,4) == '最终信号') console.debug($1);
				if (isMatchOrNot) {
					return $1 ? $1 + replaceString : $0;
				}
				else {
					return $1 ? $0 : replaceString;
				}
			});

			return originalString;
		}
	}
	this.replaceExtLookBehind = replaceExtLookBehind;

}

String.prototype.replaceCaption = function (patternRegExp, replaceString) {
	return(
		regexpext.replaceCaption2(this, patternRegExp, replaceString)
	);
};
