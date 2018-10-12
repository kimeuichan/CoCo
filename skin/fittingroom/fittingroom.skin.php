<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);

// 목록헤드
if(isset($wset['chead']) && $wset['chead']) {
	add_stylesheet('<link rel="stylesheet" href="'.G5_CSS_URL.'/head/'.$wset['chead'].'.css" media="screen">', 0);
	$head_class = 'list-head';
} else {
	$head_class = (isset($wset['ccolor']) && $wset['ccolor']) ? 'tr-head border-'.$wset['ccolor'] : 'tr-head border-black';
}
include_once(G5_LIB_PATH.'/coco.lib.php');

// 헤더 출력
if($header_skin)
	include_once('./header.php');

$coco_photo = $member['coco_photo'];
// $coco_photo = getEncPath($member['coco_photo']);

$item_url = Array();

?>


<form name="frmcartlist" id="sod_bsk_list" method="post" action="/shop/cartupdate.php" class="form" role="form">
	
	<div class="row">
		<div class="col-xs-6">
			<div class="fit_wrapper">
				<?php if($pre_codi_url != NULL) { ?>
					<img id="coco" src="<?php echo ($pre_codi_url);?>" width="100%" height="100%"/>
				<?php } else { ?>
					<img id="coco" src="<?php echo ($coco_photo);?>" width="100%" height="100%"/>
				<?php } ?>
				<div class="back_modal" id="loader">
					<div class="loader"></div>
				</div>
			</div>
		</div>
		<div class="col-xs-6">


			<a class="btn btn-default" role="button" onclick="show_item_list()">아이템 목록</a>
			<a class="btn btn-default" role="button" onclick="show_codi_list()">코디</a>
			<div class="row" id="item_list">
				<?php 

				for($i=0; $i < count($list);$i++) { 

					$list[$i]['img'] = apms_it_thumbnail($list[$i], 40, 40, false, true);
					$item_url[$list[$i]['it_id']] = $list[$i]['img']['src'];
				?>
				<div class="col-xs-6">
					<a onclick="request_fitting(<?php echo(strval($list[$i]['it_id']).",".strval($list[$i]['ca_id2']));?>)">
					<img width="75" height="75" src="<?php echo($list[$i]['img']['src']);?>" alt="<?php echo $list[$i]['img']['alt'];?>">
					</a>
					<input type="hidden" name="it_name[<?php echo $i; ?>]" value="<?php echo get_text($list[$i]['it_name']); ?>">
					<input type="hidden" name="io_type[<?php echo $list[$i]['it_id']; ?>][]" value="0">
					<input type="hidden" name="io_id[<?php echo $list[$i]['it_id']; ?>][]" value="">
					<input type="hidden" name="io_value[<?php echo $list[$i]['it_id']; ?>][]" value="<?php get_text($list[$i]['it_name']); ?>">
					<input type="hidden" name="ct_qty[<?php echo  $list[$i]['it_id']; ?>][]" value="1" id="ct_qty_<?php echo $i; ?>">
					<input type="hidden" name="ct_chk[<?php echo $i; ?>]" value="1" id="ct_chk_<?php echo $i; ?>" checked="checked"/>
				</div>

				<?php } ?>
			</div>
			<!-- Codi List -->
			<div class="wishlist-skin" id="codi_list" style="display:none;">
			</div>
			
					</div>
	</div>
	<input type="hidden" name="url" value="./orderform.php"/>
	<input type="hidden" name="records" value="<?php echo $i; ?>"/>
	<input type="hidden" name="act" value="">
	<input type="hidden" name="sw_direct" value="1">
	
</form>
<br/>
<div class="row">
	<div class="col-xs-6">
		<div class="text-center">
			<a class="btn btn-default btn-block" role="button" width="100%" height="100%" onclick="request_save_cody();">코디 저장</a>
			<a class="btn btn-default btn-block" role="button" width="100%" height="100%" href="/bbs/myphoto.php"  target="_blank">사진 수정</a>
		</div>
	</div>
	<div class="col-xs-6">
		<div class="text-center">
			<div class="col-xs-6" style="
    padding-right: 1px;
    padding-left: 1px;
">
				<a class="btn btn-default fitting-button" role="button" onclick="request_buy()">바로구매</a>
			</div>
			<div class="col-xs-6" style="
    padding-right: 1px;
    padding-left: 1px;
">
				<a class="btn btn-default fitting-button" role="button">장바구니</a>
			</div>
		</div>
	</div>
</div>


<script>
	var my_codi = '<?php echo($codi);?>';
	var t_codi = {};
	var image = '<?php echo(json_encode($item_url)); ?>';
	var user_id = '<?php echo($member['mb_id']) ?>';
	var MD5 = function(d){result = M(V(Y(X(d),8*d.length)));return result.toLowerCase()};function M(d){for(var _,m="0123456789ABCDEF",f="",r=0;r<d.length;r++)_=d.charCodeAt(r),f+=m.charAt(_>>>4&15)+m.charAt(15&_);return f}function X(d){for(var _=Array(d.length>>2),m=0;m<_.length;m++)_[m]=0;for(m=0;m<8*d.length;m+=8)_[m>>5]|=(255&d.charCodeAt(m/8))<<m%32;return _}function V(d){for(var _="",m=0;m<32*d.length;m+=8)_+=String.fromCharCode(d[m>>5]>>>m%32&255);return _}function Y(d,_){d[_>>5]|=128<<_%32,d[14+(_+64>>>9<<4)]=_;for(var m=1732584193,f=-271733879,r=-1732584194,i=271733878,n=0;n<d.length;n+=16){var h=m,t=f,g=r,e=i;f=md5_ii(f=md5_ii(f=md5_ii(f=md5_ii(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_ff(f=md5_ff(f=md5_ff(f=md5_ff(f,r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+0],7,-680876936),f,r,d[n+1],12,-389564586),m,f,d[n+2],17,606105819),i,m,d[n+3],22,-1044525330),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+4],7,-176418897),f,r,d[n+5],12,1200080426),m,f,d[n+6],17,-1473231341),i,m,d[n+7],22,-45705983),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+8],7,1770035416),f,r,d[n+9],12,-1958414417),m,f,d[n+10],17,-42063),i,m,d[n+11],22,-1990404162),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+12],7,1804603682),f,r,d[n+13],12,-40341101),m,f,d[n+14],17,-1502002290),i,m,d[n+15],22,1236535329),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+1],5,-165796510),f,r,d[n+6],9,-1069501632),m,f,d[n+11],14,643717713),i,m,d[n+0],20,-373897302),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+5],5,-701558691),f,r,d[n+10],9,38016083),m,f,d[n+15],14,-660478335),i,m,d[n+4],20,-405537848),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+9],5,568446438),f,r,d[n+14],9,-1019803690),m,f,d[n+3],14,-187363961),i,m,d[n+8],20,1163531501),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+13],5,-1444681467),f,r,d[n+2],9,-51403784),m,f,d[n+7],14,1735328473),i,m,d[n+12],20,-1926607734),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+5],4,-378558),f,r,d[n+8],11,-2022574463),m,f,d[n+11],16,1839030562),i,m,d[n+14],23,-35309556),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+1],4,-1530992060),f,r,d[n+4],11,1272893353),m,f,d[n+7],16,-155497632),i,m,d[n+10],23,-1094730640),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+13],4,681279174),f,r,d[n+0],11,-358537222),m,f,d[n+3],16,-722521979),i,m,d[n+6],23,76029189),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+9],4,-640364487),f,r,d[n+12],11,-421815835),m,f,d[n+15],16,530742520),i,m,d[n+2],23,-995338651),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+0],6,-198630844),f,r,d[n+7],10,1126891415),m,f,d[n+14],15,-1416354905),i,m,d[n+5],21,-57434055),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+12],6,1700485571),f,r,d[n+3],10,-1894986606),m,f,d[n+10],15,-1051523),i,m,d[n+1],21,-2054922799),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+8],6,1873313359),f,r,d[n+15],10,-30611744),m,f,d[n+6],15,-1560198380),i,m,d[n+13],21,1309151649),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+4],6,-145523070),f,r,d[n+11],10,-1120210379),m,f,d[n+2],15,718787259),i,m,d[n+9],21,-343485551),m=safe_add(m,h),f=safe_add(f,t),r=safe_add(r,g),i=safe_add(i,e)}return Array(m,f,r,i)}function md5_cmn(d,_,m,f,r,i){return safe_add(bit_rol(safe_add(safe_add(_,d),safe_add(f,i)),r),m)}function md5_ff(d,_,m,f,r,i,n){return md5_cmn(_&m|~_&f,d,_,r,i,n)}function md5_gg(d,_,m,f,r,i,n){return md5_cmn(_&f|m&~f,d,_,r,i,n)}function md5_hh(d,_,m,f,r,i,n){return md5_cmn(_^m^f,d,_,r,i,n)}function md5_ii(d,_,m,f,r,i,n){return md5_cmn(m^(_|~f),d,_,r,i,n)}function safe_add(d,_){var m=(65535&d)+(65535&_);return(d>>16)+(_>>16)+(m>>16)<<16|65535&m}function bit_rol(d,_){return d<<_|d>>>32-_}


	if(my_codi.length == 0){
		my_codi = [];
	}
	else{
		my_codi = JSON.parse(my_codi);
		image = JSON.parse(image);
	}


	function sleep(ms) {
	  return new Promise(resolve => setTimeout(resolve, ms));
	}

	function isEmpty(obj) {
		for(var prop in obj) {
			if(obj.hasOwnProperty(prop))
				return false;
		}

		return JSON.stringify(obj) === JSON.stringify({});
	}


	async function request_fitting(it_id, ca_id){
		if(!it_id) {
			alert("코드가 올바르지 않습니다.");
			return false;
		}


		$('#loader').css("display", "block");  

		t_codi[ca_id] = it_id.toString();

		var test ={};
		test[ca_id] = it_id;

		console.log(test);

		// $.post("/shop/fitting_request.php", { it_id : JSON.stringify(t_codi)}, function(res) {
		$.post("/shop/fitting_request.php", { it_id : JSON.stringify(test)}, function(res) {
			console.log(res);
			var result = JSON.parse(res);
			if(result['result']){
				// var src = result['result'];
				var src = "/res/" + user_id + "/" + MD5(user_id + it_id) + ".png";
				console.log(src);
				// $('#coco').attr('src', result['src']);
				$('#coco').attr('src', src);
				// my_codi['codi_url'] = result['src'];
			}
		});

		await sleep(1000);
		
		
		$('#loader').hide();  

		return true;
	}

	function request_buy() {
		var f = document.frmcartlist;
		var cnt = f.records.value;

		if($("input[name^=ct_chk]:checked").size() < 1) {
			alert("주문하실 상품을 하나이상 선택해 주십시오.");
			return false;
		}

		// f.act.value = "buy";
		console.log(f);
		f.submit();

		return true;
	}

	function request_save_cody(){
		var flag = true;

		if(isEmpty(t_codi)){
			alert("코디가 없습니다.");
			return false;
		}

		for(var i in my_codi){
			if(JSON.stringify(my_codi[i]) == JSON.stringify(t_codi)){
				flag = false;
			}
		}

		if(!flag){
			alert("중복된 코디입니다.");
			return;
		}
			
		my_codi.push($.extend({}, t_codi));

		$.post("/shop/fitting_save_codi.php", { codi: JSON.stringify(my_codi)}, function(res) {
			// var result = JSON.parse(res);
			// console.log(res);
			alert("코디 저장 완료");
		});
	}

	function show_codi_list(){
		$('#item_list').hide();
		$('#codi_list').show();

		for(var i in my_codi){
			var wrapper_div = $('<div class="fitting-wrapper"/>');
			for(var j in my_codi[i]){
				var item_id = my_codi[i][j];
				wrapper_div.prepend('<img class="theImg" src="'+image[item_id]+'" />');
			}
			var index = Number(i) + 1;
			wrapper_div.prepend('<h3>'+ index +'번째 코디</h3>');
			wrapper_div = wrapper_div.wrap('<a onclick="select_codi(' + i +')"></a>"').parent();
			$('#codi_list').append(wrapper_div);
		}
	}

	function show_item_list(){
		$('#item_list').show();
		$('#codi_list').hide();
		$('#codi_list').empty();
	}

	function select_codi(index){
		console.log(index);
		$('#coco').attr('src', my_codi[index]['codi_url']);
	}

	function delete_codi(index){
		my_codi.splice(index, 1);
		request_buy();
	}
	

</script>