
var debugXml = false;
var debugKeywords = false;
var showHighlightOccurs = false;
var showHighlightSlowOccurs = true;

var threadId = Math.random();


var xmlParser = new function() {

	/*##### Private Function #################*/

	function getChildNodes(xmlNode, tag) {
		if (xmlNode.children !=  null && tag == undefined) {
			return xmlNode.children;
		}
		else {
			return dojo.filter(xmlNode.childNodes, function(node) { return node.nodeType == 1 && !(tag != undefined && tag != node.nodeName); });
			// 1 Element 2 Attribute 3 Text 8 Comments 9 Document
		}
	}

	function getAttributes(xmlNode, name) {
		if (xmlNode.attributes != null && xmlNode.attributes.getNamedItem(name) != null) {
			return xmlNode.attributes.getNamedItem(name).value;
		}
		else {
			return '';
		}
	}

	/*##### Object ###########################*/

	function highlightNode(xmlNode) {
		var highlightNodes = getChildNodes(xmlNode, 'highlight');
		this.keywords = new Array();

		for (var i = 0; i < highlightNodes.length; i++) {
			var highlightNode = highlightNodes[i];
			var keywordNodes = getChildNodes(highlightNode, 'keyword');
			//console.debug(keywordNodes);
			var type = 'over_' + getAttributes(highlightNode, 'type');
			var subtype = getAttributes(highlightNode, 'subtype').replace(/^(?!$)|( +)/, '$1over_');
			var separate = getAttributes(highlightNode, 'separate') == 'true';
			var disable = getAttributes(highlightNode, 'disable') == 'true';
			var _keywords = new Array(keywordNodes.length);

			/* DEBUG XML */ if (debugXml) console.debug('\t\t<' + highlightNode.tagName + ' type="' + type + ' subtype="' + subtype + ' separate="' + separate + ' disable="' + disable + '">');

			if (disable)
				continue;

			for (var _i = 0; _i < _keywords.length; _i++) {
				_keywords[_i] = new keywordNode(keywordNodes[_i], type, subtype, separate);
			}

			this.keywords = this.keywords.concat(_keywords);

			/* DEBUG XML */ if (debugXml) console.debug('\t\t</' + highlightNode.tagName + '>');
		}

		this.hasKeywords = this.keywords.length > 0;
		this.isParse = false;

		function clone() {
			return new highlightNode(xmlNode);
		}
		this.clone = clone;
	}
	this.highlightNode = highlightNode;

	function keywordNode(xmlNode, type, subtype, separate) {
		//console.debug(xmlNode);

		this.type = (type != undefined) ? type : '';
		this.subtype = (subtype != undefined) ? subtype : '';
		this.separate = getAttributes(xmlNode, 'separate') ? getAttributes(xmlNode, 'separate') == 'true' : (separate != undefined) ? separate : '';
		//this.key = (xmlNode.childNodes.length > 0) ? xmlNode.childNodes[0].nodeValue : '';
		this.key = getAttributes(xmlNode, 'key');
		this.alias = getAttributes(xmlNode, 'alias');
		this.desc = getAttributes(xmlNode, 'desc');
		this.thumb = getAttributes(xmlNode, 'thumb');
		this.tmbnb = getAttributes(xmlNode, 'tmbnb') == 'true';
		this.tmbft = getAttributes(xmlNode, 'tmbft');
		this.replace = getAttributes(xmlNode, 'replace');
		this.regexp = getAttributes(xmlNode, 'regexp');
		this.regcap = getAttributes(xmlNode, 'regcap') == 'true';
		this.disable = getAttributes(xmlNode, 'disable') == 'true';

		/* DEBUG XML */ if (debugXml && debugKeywords) console.debug('\t\t\t<' + xmlNode.tagName + ' type="' + this.type + '" subtype="' + this.subtype + '" separate="' + this.separate + '" key="' + this.key + '" alias="' + this.alias + '" replace="' + this.replace + '" regexp="' + this.regexp + '" regcap="' + this.regcap + '" />');


		function clone() {
			return new keywordNode(xmlNode, type, subtype);
		}
		this.clone = clone;
	}
	this.keywordNode = keywordNode;

	/*##### Function #########################*/

	function parseList(xmlRoot) {
		var childNodes = getChildNodes(xmlRoot);

		/* DEBUG XML */ if (debugXml) console.debug('<' + xmlRoot.tagName + '>');

		this.novels = new Array(childNodes.length);

		for (var i = 0; i < this.novels.length; i++) {
			this.novels[i] = new novel(childNodes[i]);
		}

		/* DEBUG XML */ if (debugXml) console.debug('</' + xmlRoot.tagName + '>');

		//console.dir(this.novels);

		return this.novels;
	}
	this.parseList = parseList;
}


function highlightText(highlight) {
	if (!highlight) {
		console.log('##### No Highlight #####################');
		return;
	}

	console.log('##### Highlight Text ###################');

	var startTime = new Date().getTime();

	var target = dojo.byId('text');
	//console.debug(target);
	var htmlLines = [target.innerHTML];
	var keywords = window.highlight.keywords;

	if (showHighlightOccurs) var occurs = new dojox.collections.Dictionary();


	highlightTextByKeywordsCallBack(window.threadId, keywords, 0, htmlLines, occurs, startTime,
		function(htmlLines, occurs, costTime) {
			if (window.threadId != threadId)
				console.log('##### Highlight Canceled ###############');

			target.innerHTML = unescape(unescape(htmlLines[0]));

			if (showHighlightOccurs)
				dojo.forEach(occurs.getKeyList(), function(item, idx) {
					if (occurs.item(item) > 0)
						console.debug('(' + (idx < 10 ? '00' + idx : idx < 100 ? '0' + idx : idx) + ') ' + item + '                    \t'.substring(item.length * 2) + occurs.item(item));
				});

			var costTime = new Date().getTime() - startTime;
			console.debug('cost time: ' + costTime + 'ms');

			console.log('##### Highlight End ####################');
			Shadowbox.clearCache();
			Shadowbox.setup();
		}
	);
}

function highlightTextByKeywordsCallBack(threadId, keywords, index, htmlLines, occurs, startTime, callback) {
	if (window.threadId != threadId) {
		console.log('##### Highlight Canceled ###############');
		return;
	}

	//console.debug(keywords[index]);
	setTimeout(function() {
		//console.debug(keywords[index].key);
		var _costTime;
		if (showHighlightSlowOccurs) _costTime = new Date().getTime();
		try {
			highlightTextByKeyword(keywords[index], htmlLines, occurs);
		}
		catch (err) {
			console.debug('##### Highlight Error: ' + err);
		}
		if (showHighlightSlowOccurs) _costTime = new Date().getTime() - _costTime;
		if (showHighlightSlowOccurs && _costTime >= 50) console.debug(keywords[index].key + ' (cost time: ' + _costTime + 'ms)');

		if (index + 1 < keywords.length) {
			highlightTextByKeywordsCallBack(threadId, keywords, index + 1, htmlLines, occurs, startTime, callback);
			callback = null;
		}

		if (dojo.isFunction(callback))
			callback(htmlLines, occurs, startTime);
	}, 1);
}

function highlightTextByKeyword(keyword, htmlLines, occurs) {

	var lookBehindPattern = '<span(?:[^>])*>[^<]*|<[^>]+ \\w+="[^"]*';
	var lookBeforePattern = '';
	var pattern = '(' + (keyword.regexp ? keyword.regexp :  keyword.key) + ')' + lookBeforePattern;

	var className = keyword.type + (keyword.type && keyword.subtype ? ' ' : '') + keyword.subtype;

	if (keyword.key)
		keyword.key = keyword.key.replace(/\\e/g, '<!' + '----' + '>');
	if (keyword.alias)
		keyword.alias = keyword.alias.replace(/ *(\\r)?\\n/g, '<br />').replace(/\\e/g, '<!' + '----' + '>').escapeHTML();
	if (keyword.desc)
		keyword.desc = keyword.desc.replace(/ *(\\r)?\\n/g, '<br />').replace(/\\e/g, '<!' + '----' + '>').escapeHTML();
	if (keyword.thumb) {
		keyword.desc = ('<img src="' + escape(encodeURI('data/highlight/images/' + keyword.thumb).replace('\'', '&amp;#39;')) + '"' + (keyword.alias || keyword.desc ? (keyword.tmbnb || keyword.tmbft.match(/^left|right$/) != null ? ' class="' + (keyword.tmbnb ? 'nb' : '') + ' ' + (keyword.tmbft.match(/^left|right$/) != null ? keyword.tmbft : '') + '"' : '' ) : ' class="avatar"') + ' />').escapeHTML() + (keyword.desc && keyword.tmbft.match(/^left|right$/) == null ? '<br />': '') + (keyword.desc ? keyword.desc : '');
		keyword.thumb = '';
	}

	if (keyword.replace)
		var replaceString = '<span class="over_replace" onmouseover="return overlib(\'' + escape('<cite>Replace:&nbsp;</cite><span class=&quot;' + className + '&quot;>' + keyword.replace + '</span>' + (keyword.alias ? '<br /><span class=&quot;' + className + '&quot;>' + keyword.alias + '</span>' : '') + (keyword.desc ? '<br />' + keyword.desc : '')) + '\');" onmouseout="return nd();"><div class="' + escape(className) + '"></div><del>' + keyword.key + '</del></span>';
	else if (keyword.alias || keyword.desc) {
		var replaceString = '<span class="' + escape(className) + (keyword.alias ? ' over_alias' : '') + (keyword.desc ? ' over_desc' : '') + '"'
			+ ' onmouseover="return overlib(\'' + escape((keyword.alias ? '<span class=&quot;over_alias ' + className + '&quot;>' + keyword.alias + '</span>' : '') + (keyword.alias && keyword.desc ? '<hr />' : '') + (keyword.desc ? keyword.desc : '')) + '\');" '
			+ ' onmouseout="return nd();">' + keyword.key + '</span>';
	}
	else
		var replaceString = '<span' + (className ? ' class="' + escape(className) + '"' : '') + '>' + keyword.key + '</span>';

	var attributes = 'g';
	var isMatchOrNot = false;

	var matches;


	if (keyword.regcap) {
		function getReplaceString(key) {
			if (!key)
				return '';
			if (keyword.alias || keyword.desc)
				return '<span' + (className || keyword.alias || keyword.desc ? ' class="' + escape(className) + (keyword.alias ? ' over_alias' : '') + (keyword.desc ? ' over_desc' : '') + '"' : '') + ' onmouseover="return overlib(\'' + escape((keyword.alias ? '<span class=&quot;over_alias ' + className + '&quot;>' + keyword.alias + '</span>' : '') + (keyword.alias && keyword.desc ? '<hr />' : '') + keyword.desc).replace(/%5C/gi, '\\') + '\');" onmouseout="return nd();">' + /*escape(key)*/key.replace(/%5c(?=\d)/gi, '\\') + '</span>';
			else
				return '<span' + (className ? ' class="' + escape(className) + '"' : '') + '>' + /*escape(key)*/key.replace(/%5c(?=\d)/gi, '\\') + '</span>';
		}
		pattern = '(?:' + keyword.regexp + ')' + lookBeforePattern;

		var hasKeyChar = false;
		var keys = keyword.key.split(/\[(?:\/)?key\]/gi);
		if (keys.length >= 3 && keys.length % 2 == 1){
			var key = '';
			for (var i = 0; i < keys.length; i++) {
				if (i % 2 == 0)
					key += keys[i];
				else
					key += '[key]' + keys[i] + '[/key]';
			}
			if (key == keyword.key) {
				hasKeyChar = true;
			}
		}

		if (hasKeyChar) {
			replaceString = '';
			for (var i = 0; i < keys.length; i++) {
				if (i % 2 == 0)
					replaceString += keys[i];
				else
					replaceString += getReplaceString(keys[i]);
			}
		}
		else {
			replaceString = getReplaceString(keyword.key);
		}
		//console.debug(replaceString);

		for (var i = 0; i < htmlLines.length; i++) {
			htmlLines[i] = regexpext.replaceCaption(htmlLines[i], pattern, replaceString, attributes, keyword.alias + keyword.desc, /*keyword.key +*/ keyword.alias + keyword.desc);
		}
		return;
	}


	for (var i = 0; i < htmlLines.length; i++) {
		if (!showHighlightOccurs || (matches = regexpext.matchExtLookBehind(htmlLines[i], pattern, attributes, lookBehindPattern, isMatchOrNot)) != null && matches.length > 0) {
			//console.debug(keyword);
			if (showHighlightOccurs) { console.debug((keyword.regexp ? keyword.regexp : keyword.key) + ': ' + matches.length); if (occurs.containsKey(keyword.regexp ? keyword.regexp : keyword.key)) { occurs.add(keyword.key, occurs.item(keyword.key) + matches.length); } else { occurs.add(keyword.key, matches.length); } }

			htmlLines[i] = regexpext.replaceExtLookBehind(htmlLines[i], pattern, replaceString, attributes, lookBehindPattern, isMatchOrNot);
		}
	}
}


function readHighlight(highlight_xml) {
	console.log('##### Read HighLight ###################');
	console.debug('filename: ' + highlight_xml);
	dojo.xhrGet({
		url: highlight_xml,
		load: function(response, ioArgs) {
			//console.debug(response);
			xmlRoot = response.getElementsByTagName("highlights")[0];
			highlight = new xmlParser.highlightNode(xmlRoot);
			//highlight.novelId = novelId;
			/* DEBUG KEYWORDS */ if (debugKeywords) console.debug(highlight);
			parseHighlight(highlight, true);
			/* DEBUG KEYWORDS */ if (debugKeywords) console.debug(highlight);
		},
		handle: function(loadOrError, response, ioArgs) {
		},
		error: function(response, ioArgs) {
			console.debug("An unexpected error occurred: " + response);
		},
		handleAs: "xml",
		preventCache: true
	});
}


function parseHighlight(highlight, highlightNow) {
	console.log('##### Parse Highlight ##################');
	//console.debug('novelId: ' + highlight.novelId);

	var keywordsList = new dojox.collections.ArrayList();
	for (var i = 0; i < highlight.keywords.length; i++) {
		var splitKeywords = splitKeywordNode(highlight.keywords[i]);

		for (var j = 0; j < splitKeywords.count; j++) {
			if (j >= keywordsList.count)
				keywordsList.add(new dojox.collections.ArrayList());
			keywordsList.item(j).add(splitKeywords.item(j));
			//console.debug(splitKeywords.item(j));
		}
	}
	//console.debug(keywordsList);

	var joinKeywords = new dojox.collections.Dictionary();
	for (var i = 0; i < keywordsList.count; i++) {
		for (var j = 0; j < keywordsList.item(i).count; j++) {
			var keyword = keywordsList.item(i).item(j);
			//keyword.key = unescape(keyword.key);
			var _dicKey = keyword.regcap ? keyword.regexp : keyword.regexp ? keyword.key + '::REGEXP::' + keyword.regexp : keyword.key;
			if (!keyword.disable && !joinKeywords.containsKey(_dicKey)) {
				joinKeywords.add(_dicKey, keyword);
				//console.debug(keyword);
			}
			else {
				var _joinedKeyword = joinKeywords.item(_dicKey);
				//console.debug('key=' + _joinedKeyword.key + ', regexp=' + _joinedKeyword.regexp + ', regcap=' + _joinedKeyword.regcap
				//	+ ', alias=' + _joinedKeyword.alias + ', desc=' + _joinedKeyword.desc
				//	+ '\r\n' + 'key=' + keyword.key + ', regexp=' + keyword.regexp + ', regcap=' + keyword.regcap
				//	+ ', alias=' + keyword.alias + ', desc=' + keyword.desc
				//);
			}
		}
	}
	//console.debug(joinKeywords);

	highlight.keywords = joinKeywords.getValueList();
	//console.dir(highlight.keywords);
	highlight.isParsed = true;
	console.debug('keywords: ' + highlight.keywords.length);

	if (highlightNow)
		highlightText(highlight);
}

function splitKeywordNode(keywordNode) {
	//console.log('##### Split Keyword ####################');
	var keywords = new dojox.collections.ArrayList();
	var key = keywordNode.key;

	if (keywordNode.disable) {
	}
	else if (key == '') {
		if (keywordNode.regcap && keywordNode.regexp != '') {
			var keywordNode2 = keywordNode.clone();
			keywordNode2.key = keywordNode.regexp;
			keywords.add(keywordNode2);
		}
	}
	else if (keywordNode.separate/* || keywordNode.type == 'character'*/) {
		var keys = key.split(/ |　|·|・/g);
		if (keys.length == 1) {
			keywords.add(keywordNode.clone());
		}
		else {
			key = key.replace(/・/g, '·').replace(/ |　/g, '');
			var keywordNode2 = keywordNode.clone();
			if (keywordNode.key.match(/^ .+$/)) {
				keywordNode2.disable = true;
			}
			keywordNode2.key = key;
			keywords.add(keywordNode2);
			if (keys.length == 3) {
				key = keys[0] + '·' + keys[2];
				keywordNode2 = keywordNode.clone();
				keywordNode2.key = key;
				keywords.add(keywordNode2);
			}
			for (var i = 0; i < keys.length; i++) {
				keywordNode2 = keywordNode.clone();
				if (!keys[i]) {
					keywordNode2.disable = true;
				}
				keywordNode2.key = keys[i];
				keywords.add(keywordNode2);
			}
			//console.debug(keywords.toArray());
		}
	}
	else {
			var keywordNode2 = keywordNode.clone();
			keywordNode2.key = key.replace(/・/g, '·');
			keywords.add(keywordNode2);
	}
	//console.debug(keywordNode.key + ': ' + keywords.count);

	return keywords;
}
