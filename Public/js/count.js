/**
* 文章计数器动态更新
*/
var newsIds = {};
$('.news_count').each(function(i){
	newsIds[i] = $(this).attr('news-id');
});
//console.log(newsIds);
var url = SCOPE.count_url;
$.post(url,newsIds,function(result){
	if(result.status == 1){
		//console.log(result.data);
		var counts = result.data;
		$.each(counts,function(news_id,count){
			$('.node-'+news_id).html(count);
		});
	}
},'JSON');