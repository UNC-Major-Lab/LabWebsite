
(function() {
	var i = 0;
    alert("hi!");
	while (var input = document.getElementByID("entry_".str(i)) && input != null) {
	    if (input.value == "") {
		alert(input.id);
	    }
	}
	/*var divs = document.getElementById('ss-form').getElementsByTagName('div');
	var numDivs = divs.length;
	for (var j = 0; j < numDivs; j++) {
            if (divs[j].className == 'errorbox-bad') {
		divs[j].lastChild.firstChild.lastChild.focus();
		return;
            }
	}
	for (var i = 0; i < numDivs; i++) {
            var div = divs[i];
            if (div.className == 'ss-form-entry' && div.firstChild && div.firstChild.className == 'ss-q-title') {
		div.lastChild.focus();
		return;
            }
	}*/
    }
)();