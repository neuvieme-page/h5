(function(global) {
    "use strict";

    var kffaderStyleElems = {},
        kffaderNextUnique = 0;
    $.fn.kffader = function() {
    	this.each(function() {
    		var elem = $(this),
    			opts = JSON.parse(elem.attr('data-kffader') || '{}'),
    			sel = opts.sel || 'img',
    			allImgs = elem.find(sel),
    			imgs,
    			count,
    			name = opts.name,
    			time = opts.time,
    			fade = opts.fade,
    			showTime = time - fade,
    			fadePercent = 100 * fade / time,
    			totalTime,
    			rules,
    			style,
    			old,
    			firstNotLoaded;
			
			allImgs.toArray().some(function(img, i) {
			    var elem = $(img),
			        complete = elem.prop('complete');
			    if (complete !== undefined && !complete) {
			        firstNotLoaded = i;
			        return true;
			    }
			});
			
			if (firstNotLoaded !== undefined) {
			    console.log('cut off at', firstNotLoaded, 'of', allImgs.length);
			    allImgs = allImgs.slice(0, firstNotLoaded);
			}
			
			imgs = allImgs.filter(function() {
			    var c = $(this).prop('complete');
			    return c === undefined || c;
			});
			count = imgs.length;
			totalTime = time * count;
			
			name = makeUnique(name);
    		
    		imgs.each(function(i) {
    			var img = $(this);
    			img.css({
    				'animation-delay': (i * time) + 's',
    				'animation-duration': totalTime + 's',
    				'animation-name': name
    			});
    		});
    		
    		var fis = 0,
    			fie = fis + fadePercent,
    			fos = 100 / count,
    			foe = fos + fadePercent;
			if (count > 1) {
        		rules = [[
        			'@keyframes ', name, ' {',
        			'from {opacity: 0;}',
        			fis, '% {opacity: 0;}',
        			fie, '% {opacity: 1;}',
        			fos, '% {opacity: 1;}',
        			foe, '% {opacity: 0;}',
        			'to {opacity: 0;}',
        			'}'
        		].join('')];
			} else {
			    rules = [[
        			'@keyframes ', name, ' {',
        			'from {opacity: 1;}',
        			'to {opacity: 1;}',
        			'}'
        		].join('')];
			}
    		rules.push(rules[0].replace('@keyframes', '@-webkit-keyframes'));
    		
    		rules = rules.join('\n');
    		
    		if (Object.prototype.hasOwnProperty.call(kffaderStyleElems, name))
    		    kffaderStyleElems[name].remove();
    		kffaderStyleElems[name] = $('<style/>', { 
    			html: rules,
    			appendTo: 'head'
    		});
    		
	        function makeUnique(name) {
	            return name + '-' +
	                ('0000' + (kffaderNextUnique++)).substr(-4);
            }
    	});
    };
}(this));
