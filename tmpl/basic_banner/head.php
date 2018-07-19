<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_TMPL_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/good_group.lib.php'); /// New
include_once(G5_LIB_PATH.'/good_guide.lib.php'); /// New
include_once(G5_LIB_PATH.'/good_outnew.lib.php'); /// New
include_once(G5_LIB_PATH.'/good_outsearch.lib.php'); /// New
include_once(G5_LIB_PATH.'/good_sidemenu.lib.php'); /// New
?>

<!-- 상단 시작 { -->
<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container"><?php echo _t('본문 바로가기'); ?></a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>

    <?php
        if(defined('_INDEX_')) echo latest('good_basic_popup', 'notice'); /// popup
    ?>

    <div id="hd_wrapper">

        <div id="logo">
            <?php if($config2w['cf_use_common_logo']) { ?>
            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_IMG_URL ?>/logo.png" alt="<?php echo $config['cf_title']; ?>"></a>
            <?php } else { ?>
            <a href="<?php echo G5_URL ?>"><img src="<?php echo $g5['tmpl_url'] ?>/images/logo.png" alt="<?php echo $config['cf_title']; ?>"></a>
            <?php } ?>
        </div>

        <!--<fieldset id="hd_sch">
            <legend>사이트 내 전체검색</legend>
            <form name="fsearchbox" method="get" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return fsearchbox_submit(this);">
            <input type="hidden" name="sfl" value="wr_subject||wr_content">
            <input type="hidden" name="sop" value="and">
            <label for="sch_stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
            <input type="text" name="stx" id="sch_stx" maxlength="20">
            <input type="submit" id="sch_submit" value="검색">
            </form>

            <script>
            function fsearchbox_submit(f)
            {
                if (f.stx.value.length < 2) {
                    alert("검색어는 두글자 이상 입력하십시오.");
                    f.stx.select();
                    f.stx.focus();
                    return false;
                }

                // 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
                var cnt = 0;
                for (var i=0; i<f.stx.value.length; i++) {
                    if (f.stx.value.charAt(i) == ' ')
                        cnt++;
                }

                if (cnt > 1) {
                    alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
                    f.stx.select();
                    f.stx.focus();
                    return false;
                }

                return true;
            }
            </script>
        </fieldset>-->

        <div id="text_size">
            <!-- font_resize('엘리먼트id', '제거할 class', '추가할 class'); -->
            <button id="size_down" onclick="font_resize('container', 'ts_up ts_up2', '');"><img src="<?php echo G5_URL; ?>/img/ts01.gif" alt="<?php echo _t('기본'); ?>"></button>
            <button id="size_def" onclick="font_resize('container', 'ts_up ts_up2', 'ts_up');"><img src="<?php echo G5_URL; ?>/img/ts02.gif" alt="<?php echo _t('크게'); ?>"></button>
            <button id="size_up" onclick="font_resize('container', 'ts_up ts_up2', 'ts_up2');"><img src="<?php echo G5_URL; ?>/img/ts03.gif" alt="<?php echo _t('더크게'); ?>"></button>
        </div>

        <ul id="tnb">
            <?php if ($is_member) {  ?>
            <?php if ($is_admin) {  ?>
            <li><a href="<?php echo G5_ADMIN_URL ?>"><b><?php echo _t('관리자'); ?></b></a></li>
            <li><a href="<?php echo G5_ADMIN_URL ?>/builder/basic_tmpl_config_form.php"><b><?php echo _t('빌더관리'); ?></b></a></li>
            <?php }  ?>
            <li><a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php"><?php echo _t('정보수정'); ?></a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/logout.php"><?php echo _t('로그아웃'); ?></a></li>
            <?php } else {  ?>
            <li><a href="<?php echo G5_BBS_URL ?>/register.php"><?php echo _t('회원가입'); ?></a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/login.php"><b><?php echo _t('로그인'); ?></b></a></li>
            <?php }  ?>

            <li><a href="<?php echo G5_BBS_URL ?>/faq.php"><?php echo _t('FAQ'); ?></a></li>

            <li><a href="<?php echo G5_BBS_URL ?>/qalist.php"><?php echo _t('1:1문의'); ?></a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/current_connect.php"><?php echo _t('접속자'); ?> <?php echo connect(); // 현재 접속자수  ?></a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/new.php"><?php echo _t('새글'); ?></a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/group.php?gr_id=board"><?php echo _t('커뮤니티'); ?></a></li>
        </ul>
    </div>

    <hr>

    <?php $use_navimenu = 1; ?>
    <?php if($g5['use_builder_menu'] and $use_navimenu) {
    // 메뉴설정파일
    include_once("$g5[tmpl_path]/menu/menu.php");
    include_once("$g5[tmpl_path]/menu/menu_aux.php");
    ?>
    <div id="navimenu">
        <ul>
        <?php for($i = 0; $i < count($menu_list); $i++) { ?>
            <li<?php echo $class[$i]?>>
                <a href="<?php echo $menu_list[$i][1]?>"><?php echo _t($menu_list[$i][0])?></a>
                <?php if($i > 0) { ?>
                <?php if(count($menu[$i]) > 0) { ?>
                <ul>
                <?php for($j = 0; $j < count($menu[$i]); $j++) { ?>
                    <li>
                        <a href="<?php echo $menu[$i][$j][1]?>"><?php echo _t($menu[$i][$j][0])?></a>
                    </li>
                <?php } ?>
                </ul>
                <?php } ?>
                <?php } ?>
            </li>
        <?php } ?>
        </ul>
    </div>
    <?php } else if($g5['use_builder_menu']) { ?>
    <?php
    // 메뉴설정파일
    include_once("$g5[tmpl_path]/menu/menu.php");
    include_once("$g5[tmpl_path]/menu/menu_aux.php");
    ?>
    <nav id="gnb">
        <h2><?php echo _t('메인메뉴'); ?></h2>
        <ul id="gnb_1dul">
        <?php $gnb_zindex = 999; // gnb_1dli z-index 값 설정용 ?>
        <?php for($i = 0; $i < count($menu_list); $i++) { ?>
                <li class="gnb_1dli" style="z-index:<?php echo $gnb_zindex--; ?>">
                        <a href="<?php echo $menu_list[$i][1]?>" class="gnb_1da"><?php echo _t($menu_list[$i][0])?></a>
                        <?php if($i > 0) { ?>
                        <?php if(count($menu[$i]) > 0) { ?>
                        <ul class="gnb_2dul">
                        <?php for($j = 0; $j < count($menu[$i]); $j++) { ?>
                                <li class="gnb_2dli">
                                        <a href="<?php echo $menu[$i][$j][1]?>" class="gnb_2da"><?php echo _t($menu[$i][$j][0])?></a>
                                </li>
                        <?php } ?>
                        </ul>
                        <?php } ?>
                        <?php } ?>
                </li>
        <?php } ?>
        </ul>
    </nav>
    <?php } else { ?>
    <nav id="gnb">
        <h2><?php echo _t('메인메뉴'); ?></h2>
        <ul id="gnb_1dul">
            <?php
            $sql = " select *
                        from {$g5['menu_table']}
                        where me_use = '1'
                          and length(me_code) = '2'
                        order by me_order, me_id ";
            $result = sql_query($sql, false);
            $gnb_zindex = 999; // gnb_1dli z-index 값 설정용

            for ($i=0; $row=sql_fetch_array($result); $i++) {
                if(!preg_match('|^http://|', $row['me_link'])) $row['me_link'] = G5_URL.$row['me_link'];
            ?>
            <li class="gnb_1dli" style="z-index:<?php echo $gnb_zindex--; ?>">
                <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo _t($row['me_name']) ?></a>
                <?php
                $sql2 = " select *
                            from {$g5['menu_table']}
                            where me_use = '1'
                              and length(me_code) = '4'
                              and substring(me_code, 1, 2) = '{$row['me_code']}'
                            order by me_order, me_id ";
                $result2 = sql_query($sql2);

                for ($k=0; $row2=sql_fetch_array($result2); $k++) {
                    if(!preg_match('|^http://|', $row2['me_link'])) $row2['me_link'] = G5_URL.$row2['me_link'];
                    if($k == 0)
                        echo '<ul class="gnb_2dul">'.PHP_EOL;
                ?>
                    <li class="gnb_2dli"><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><?php echo _t($row2['me_name']) ?></a></li>
                <?php
                }

                if($k > 0)
                    echo '</ul>'.PHP_EOL;
                ?>
            </li>
            <?php
            }

            if ($i == 0) {  ?>
                <li id="gnb_empty"><?php echo _t('메뉴 준비 중입니다.'); ?><?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php"><?php echo _t('관리자모드'); ?> &gt; <?php echo _t('환경설정'); ?> &gt; <?php echo _t('메뉴설정'); ?></a><?php echo _t('에서 설정하실 수 있습니다.'); ?><?php } ?></li>
            <?php } ?>
        </ul>
    </nav>
    <?php } /// if else ?>
</div>
<!-- } 상단 끝 -->

<hr>

<!-- 콘텐츠 시작 { -->
<div id="wrapper">
    <?php if(0) { ?>
    <div id="aside">
        <?php echo outlogin('basic_old'); // 외부 로그인  ?>
        <?php echo poll('basic_old'); // 설문조사  ?>
    </div>
    <?php } ?>
    <div id="aside">
<?php
for($i = 0; $i < $config2w['cf_max_main_right']; $i++) {

	if($config2w['cf_main_right_nouse_'.$i] == "checked") continue;

	if($config2w['cf_main_right_admin_'.$i] == "checked") {
		if ($is_admin != "super") continue;
	}

	if($config2w['cf_main_right_name_'.$i]) {
		echo "
<div class=\"{$config2w['cf_main_right_style_'.$i]}\">".call_name($config2w['cf_main_right_name_'.$i])."</div>
";
	}
}
?>
    </div>
    <div id="container">
        <?php if ((!$bo_table || $w == 's' ) && !defined("_INDEX_")) { ?><div id="container_title"><?php echo $g5['title'] ?></div><?php } ?>
