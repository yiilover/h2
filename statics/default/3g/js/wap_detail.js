$(function(){
	/*��������js start*/
	$(".lp_cs p:gt(3)").hide();
	$("#info").parent().toggle(
			function () {
				$("#info").attr('class', 'num up');
				re=/(\d+)\/(\d+)/i;
				var arr = re.exec($("#info em").text());
				if(arr[2] > 4)
				{
					before = arr[2];
				}
				else
				{
					before = arr[1];
				}
				var content = "ȫ������ <em>(" + before + "/" + arr[2] + ")</em>";
				$("#info").html(content);
				$(".lp_cs p:gt(3)").fadeIn(100);
			},
			function () {
				$("#info").attr('class', 'num');
				re=/(\d+)\/(\d+)/i;
				var arr = re.exec($("#info em").text());
				if(arr[1] > 4)
				{
					before = 4;
				}
				else
				{
					before = arr[2];
				}
				var content = "������� <em>(" + before + "/" + arr[2] + ")</em>";
				$("#info").html(content);
				$(".lp_cs p:gt(3)").fadeOut(100);
				location.href = "#infomao";
			}
		); 
	/*��������js end*/
	
	/*��Ѷ����js start*/
	$(".new_list div a:gt(3)").hide();
	$("#quot").parent().toggle( 
			function () {
				$("#quot").attr('class', 'num up');
				re=/(\d+)\/(\d+)/i;
				var arr = re.exec($("#quot em").text());
				if(arr[2] > 4)
				{
					before = arr[2];
				}
				else
				{
					before = arr[1];
				}
				var content = "ȫ������ <em>(" + before + "/" + arr[2] + ")</em>";
				$("#quot").html(content);
				$(".new_list div a:gt(3)").fadeIn(100);
			},
			function () {
				$("#quot").attr('class', 'num');
				re=/(\d+)\/(\d+)/i;
				var arr = re.exec($("#quot em").text());
				if(arr[1] > 4)
				{
					before = 4;
				}
				else
				{
					before = arr[2];
				}
				var content = "������Ѷ <em>(" + before + "/" + arr[2] + ")</em>";
				$("#quot").html(content);
				$(".new_list div a:gt(3)").fadeOut(100);
				location.href = "#quotmao";
			}
		); 
	/*��Ѷ����js end*/
});
