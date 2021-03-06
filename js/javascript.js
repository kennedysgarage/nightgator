$('table tr:odd').addClass('even');

/* TABLESORT.JS http://mitya.co.uk/scripts/Animated-table-sort-REGEXP-friendly-111) */
jQuery.fn.sortTable = function(params) {
	if ($(this).find(':animated').length > 0) return;
	var error = null;
	var complain = null;
	if (!params.onCol) { error = "No column specified to search on"; complain = true; }
	else if ($(this).find('td:nth-child('+params.onCol+')').length == 0) { error = "The requested column wasn't found in the table"; complain = true; }
	if (error) { if (complain) alert(error); return; }
	if (!params.sortType || params.sortType != 'numeric') params.sortType = 'ascii';
	var valuesToSort = [];
	$(this).css('position', 'relative');
	var doneAnimating = 0;
	var tdSelectorText = 'td'+(!params.onCol ? '' : ':nth-child('+params.onCol+')');
	$(this).find('td:nth-child('+params.onCol+')').addClass('sortOnThisCol');
	var thiss = this;
	var counter = 0;
	$(this).find('td').each(function() {
		if ($(this).is('.sortOnThisCol') || (!params.onCol && !params.keepRelationships)) {
			var valForSort = !params.child ? $(this).text() : (params.child != 'input' ? $(this).find(params.child).text() : $(this).find(params.child).val());
			if (params.regexp) {
				valForSort = valForSort.match(new RegExp(params.regexp))[!params.regexpIndex ? 0 : params.regexpIndex];
			}
			valuesToSort.push(valForSort);
		}
		var thisTDHTMLHolder = document.createElement('div');
		with($(thisTDHTMLHolder)) {
			html($(this).html());
			if (params.child && params.child == 'input') html(html().replace(/<input /, "<input value='"+$(this).find(params.child).val()+"'", html()));
			css({position: 'relative', left: 0, top: 0});
		}
		$(this).html('');
		$(this).append(thisTDHTMLHolder);
		counter++;
	});
	if (params.sortType == 'numeric') {
	       valuesToSort.sort( function(a, b) {
	              a.replace(/[^\d\.]/g, '');
	              b.replace(/[^\d\.]/g, '');
	              return a - b;
	              });
	       } else { valuesToSort.sort(); }
	if (params.sortDesc) { valuesToSort.reverse(); }

	       var thisTD = $(this).find('th a:eq(' + (params.onCol - 1) + ')');
	       if ( thisTD.hasClass('tableSort_toggled')) {
	              valuesToSort.reverse();
	              }
	       thisTD.toggleClass('tableSort_toggled');
	for(var k in valuesToSort) {
		var currTD = $($(this).find(tdSelectorText).filter(function() {
			return (
				(
					!params.regexp
					&&
					(
						(
							params.child
							&&
							(
								(
									params.child != 'input'
									&&
									valuesToSort[k] == $(this).find(params.child).text()
								)
								||
								params.child == 'input'
								&&
								valuesToSort[k] == $(this).find(params.child).val()
							)
						)
						||
						(
							!params.child
							&&
							valuesToSort[k] == $(this).children('div').html()
						)
					)
				)
				||
				(
					params.regexp
					&&
					$(this).children('div').html().match(new RegExp(params.regexp))[!params.regexpIndex ? 0 : params.regexpIndex] == valuesToSort[k]
				)
			)
			&&
			!$(this).hasClass('tableSort_TDRepopulated');
		}).get(0));
		currTD.addClass('tableSort_TDRepopulated');
		var targetTD = $($(this).find(tdSelectorText).get(k));
		currTD.get(0).toTD = targetTD;
		if (params.keepRelationships) {
			var counter = 0;
			$(currTD).parent().children('td').each(function() {
				$(this).get(0).toTD = $(targetTD.parent().children().get(counter));
				counter++;
			});
		}
		var currPos = currTD.position();
		var targetPos = targetTD.position();
		var moveBy_top = targetPos.top - currPos.top;
		if (targetPos.top > currPos.top) moveBy_top = Math.abs(moveBy_top);
		var animateOn = params.keepRelationships ? currTD.add(currTD.siblings()) : currTD;
		var done = 0;
		animateOn.children('div').animate({top: moveBy_top}, !params.noAnim ? 500 : 0, null, function() {
			if ($(this).parent().is('.sortOnThisCol') || !params.keepRelationships) {
				done++;
				if (done == valuesToSort.length-1) thiss.tableSort_cleanUp();
			}
		});

	}
};
jQuery.fn.tableSort_cleanUp = function() {
	$(this).find('td').each(function() {
		if($(this).get(0).toTD) $($(this).get(0).toTD).get(0).newHTML = $(this).children('div').html();
	});
	$(this).find('td').each(function() { $(this).html($(this).get(0).newHTML); });
	$('td.tableSort_TDRepopulated').removeClass('tableSort_TDRepopulated');
	$(this).find('.sortOnThisCol').removeClass('sortOnThisCol');
	$(this).find('td[newHTML]').attr('newHTML', '');
	$(this).find('td[toTD]').attr('toTD', '');

};
