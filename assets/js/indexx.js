$(document).ready(function() {
	$(".flexslider").flexslider({
		animation: "slide"
	});

	var $list = $('#list');
	$.getJSON('home.php', function(res) {
		var html = '';
		$.each(res.data,function(k, v) {
			if(k % 3 == 0) {
				html += '<div class="line-big">';
			}
			html += '<div class="x4"><div class="item">';
			html += '<div class="item-header clearfix"><h3><a href="/room/' + v.number + "/" + String.fromCharCode(v.tab) + "_" + v.id + '.html" target="_blank">' + v.title + "-" + String.fromCharCode(v.tab) + "房" + '</a></h3><span class="favorite"><i class="iconfont icon-heart"></i>'+ v.id +'</span></div>';
			html += '<div class="item-img"><a href="/room/' + v.number + "/" + String.fromCharCode(v.tab) + "_" + v.id + '.html" target="_blank"><img src="'+ v.titlepic +'" alt="' + v.title + "-" + String.fromCharCode(v.tab) + "房" + '"><span class="rent">出租</span></a></div>';
			html += '<div class="item-detail"><div class="float-left"><span>地址:'+ v.street +'</span></div><div class="float-right"><span class="price">'+ v.price +'元/月</span></div></div>';
			html += '</div></div>';
			if(k % 3 == 2) {
				html += '</div>';
			}
		});
		$list.append(html);
	});
});
