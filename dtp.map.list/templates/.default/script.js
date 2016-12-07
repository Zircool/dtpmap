BX.ready(function(){
	UpdateDate();
	
}); 

var timerId = setInterval(function() {
	UpdateDate();
}, 60000);

function UpdateDate(){
		var fields = BX.findChild(BX('dtp-list'), {class: 'search-results-date'}, true, true);
			fields.forEach(function(element){
				var date = Number(element.getAttribute('date'));
				element.innerHTML = BX.date.format('x', date);
		});
}

function SetView(type){
	if(type == 'list'){
		BX.addClass(BX('dtp-list'),'display-as-list');
		BX.addClass(BX('li-list'),'active');
		
		BX.removeClass(BX('li-map'),'active');
		BX.removeClass(BX('li-tile'),'active');
		
		SetCookie('list_type', 'list', 365);
	}else if(type == 'tile'){
		BX.removeClass(BX('dtp-list'),'display-as-list');
		BX.addClass(BX('li-tile'),'active');
		
		BX.removeClass(BX('li-map'),'active');
		BX.removeClass(BX('li-list'),'active');
		
		SetCookie('list_type', 'tile', 365);
	}
}


function SetCookie(cookieName, cookieValue, nDays) {
	var today = new Date();
	var expire = new Date();
	cookieName = BX.message.COOKIE_PREFIX + '_' + cookieName;
	if (nDays == null || nDays == 0) {
		nDays = 1;
	}
	expire.setTime(today.getTime() + 3600000 * 24 * nDays);
	document.cookie = cookieName + '=' + escape(cookieValue) + ';path=/;expires=' + expire.toGMTString();
};

function GetCookie(name) {
	name = BX.message.COOKIE_PREFIX + '_' + name;
	var matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"));
	return matches ? decodeURIComponent(matches[1]) : undefined;
};
 