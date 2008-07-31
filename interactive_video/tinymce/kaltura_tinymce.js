/**
 * $Id: editor_plugin_src.js 201 2007-02-12 15:56:56Z spocke $
 *
 * @author Moxiecode
 * @copyright Copyright © 2004-2008, Moxiecode Systems AB, All rights reserved.
 */

(function() {
	// Load plugin specific language pack
	//tinymce.PluginManager.requireLangPack('kaltura');

	tinymce.create('tinymce.plugins.Kaltura', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
			this._url = url

			ed.onInit.add(function() {
				ed.dom.loadCSS(url + "/css/tinymce.css");
			});
			
			var onBeforeSetContentDelegate = Kaltura.Delegate.create(this, this._onBeforeSetContent);
			ed.onBeforeSetContent.add(onBeforeSetContentDelegate);
			
			var onGetContentDelegate = Kaltura.Delegate.create(this, this._onGetContent);
			ed.onGetContent.add(onGetContentDelegate);
		},

		/**
		 * Creates control instances based in the incomming name. This method is normally not
		 * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
		 * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
		 * method can be used to create those.
		 *
		 * @param {String} n Name of the control to create.
		 * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
		 * @return {tinymce.ui.Control} New control instance or null if no control was created.
		 */
		createControl : function(n, cm) {
			return null;
		},

		/**
		 * Returns information about the plugin as a name/value array.
		 * The current keys are longname, author, authorurl, infourl and version.
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo : function() {
			return {
				longname : 'Interactive Video',
				author : 'Kaltura',
				authorurl : 'http://www.kaltura.com',
				infourl : 'http://www.kaltura.com/index.php/corp/wordpress_plugin',
				version : "1.0"
			};
		},
		
		_tagStart : '[kaltura-widget',
		
		_tagEnd : '/]',
		
		_replaceTagStart : '<img',
		
		_replaceTagEnd : '/>',
		
		_onBeforeSetContent : function(ed, obj) {
			if (!obj.content)
				return;
				
			var contentData = obj.content;
			var startPos = 0;

			while ((startPos = contentData.indexOf(this._tagStart, startPos)) != -1) {
				var endPos = contentData.indexOf(this._tagEnd, startPos);
				var attribs = this._parseAttributes(contentData.substring(startPos + this._tagStart.length, endPos));
				var kalturaAlign = "left";
				if (attribs["align"]) {
					if (attribs["align"] == "r")
						kalturaAlign = "right";
					else if (attribs["align"] == "m")
						kalturaAlign = "middle";
				}
				
				endPos += this._tagEnd.length;
				var contentDataEnd = contentData.substr(endPos);
				contentData = contentData.substr(0, startPos);

				contentData += '<img ';
				contentData += 'id="wid' + attribs["wid"] + '" ';
				contentData += 'src="' + (this._url + '/images/spacer.gif') + '" ';
				contentData += 'title="Kaltura" ';
				contentData += 'alt="Kaltura" '; 
				contentData += 'class="kaltura_item kaltura_size_' + attribs["size"] + '" ';
				contentData += 'align="' + kalturaAlign + '" ';
				contentData += 'name="mce_plugin_kaltura_desc" ';
				
				if (attribs["size"] == "large")
					contentData += 'style="background-image: url(\'' + this._url + '/../thumbnail_redirect.php?widget_id=' + attribs["wid"] + '&width=400&height=300\')" ';
				else if (attribs["size"] == "large_wide_screen")
					contentData += 'style="background-image: url(\'' + this._url + '/../thumbnail_redirect.php?widget_id=' + attribs["wid"] + '&width=400&height=225\')" ';
				else
					contentData += 'style="background-image: url(\'' + this._url + '/../thumbnail_redirect.php?widget_id=' + attribs["wid"] + '&width=240&height=180\')" ';
				contentData += '/>';
				contentData += contentDataEnd;
			}
			
			obj.content = contentData;
		},
		
		_onGetContent : function(ed, obj) {
			//alert('_onGetContent');
			if (!obj.content)
				return;
			//return;
			var contentData = obj.content;
			var startPos = 0;
			while ((startPos = contentData.indexOf(this._replaceTagStart, startPos)) != -1) {
				var endPos = contentData.indexOf(this._replaceTagEnd, startPos);
				if (endPos > -1) {
					var attribs = this._parseAttributes(contentData.substring(startPos + this._replaceTagStart.length, endPos));
				
					var className = attribs['class'];
					if (!className || className.indexOf('kaltura_item') == -1) {
						startPos++;
						continue;
					}
					
					endPos += this._replaceTagEnd.length;
					var contentDataEnd = contentData.substr(endPos);
					contentData = contentData.substr(0, startPos);
					
					var sizeRegex = new RegExp("kaltura_size_(.*)");
					
					var sizeResult = sizeRegex.exec(className);
					if (sizeResult && sizeResult.length >= 2)
						kalturasize = sizeResult[1];
					else
						kalturasize = "small";
					var wid = attribs['id'].replace('wid', '');
					var kalturaalign = "l" // its the default
					if (attribs['align']) {
						if (attribs['align'] == "right")
							kalturaalign = "r"
						else if (attribs['align'] == "middle")
							kalturaalign = "m"
					}

					contentData += this._tagStart + ' ';
					contentData += 'wid="' + wid + '" ';
					contentData += 'size="' + kalturasize + '" ';
					contentData += 'align="' + kalturaalign + '" ';
					contentData += this._tagEnd;
					contentData += contentDataEnd;
				}
				else { 
					startPos++;
				}
			}
			
			obj.content = contentData;
		},
		
		_parseAttributes : function(attribute_string) {
			var attributeName = '';
			var attributeValue = '';
			var withInName;
			var withInValue;
			var attributes = new Array();
			var whiteSpaceRegExp = new RegExp('^[ \n\r\t]+', 'g');
	
			if (attribute_string == null || attribute_string.length < 2)
				return null;
	
			withInName = withInValue = false;
	
			for (var i=0; i<attribute_string.length; i++) {
				var chr = attribute_string.charAt(i);
	
				if ((chr == '"' || chr == "'") && !withInValue)
					withInValue = true;
				else if ((chr == '"' || chr == "'") && withInValue) {
					withInValue = false;
	
					var pos = attributeName.lastIndexOf(' ');
					if (pos != -1)
						attributeName = attributeName.substring(pos+1);
	
					attributes[attributeName.toLowerCase()] = attributeValue.substring(1);
	
					attributeName = '';
					attributeValue = '';
				} else if (!whiteSpaceRegExp.test(chr) && !withInName && !withInValue)
					withInName = true;
	
				if (chr == '=' && withInName)
					withInName = false;
	
				if (withInName)
					attributeName += chr;
	
				if (withInValue)
					attributeValue += chr;
			}
			return attributes;
		}
	});
	
	// Register plugin
	tinymce.PluginManager.add('kaltura', tinymce.plugins.Kaltura);
})();