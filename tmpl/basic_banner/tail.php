<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
    </div>
</div>

<!-- } 콘텐츠 끝 -->

<hr>

<!-- 하단 시작 { -->
<div id="ft">
    <?php echo popular('basic_old'); // 인기검색어  ?>
    <?php echo visit('basic_old'); // 접속자집계 ?>
    <?php echo connect('basic_old'); // 현재 접속자 ?>
    <?php if($config2w['cf_use_common_logo']) { ?>
    <div id="ft_catch"><img src="<?php echo G5_IMG_URL; ?>/ft.png" alt="<?php echo GB_VERSION ?>"></div>
    <?php } else { ?>
    <div id="ft_catch"><img src="<?php echo $g5['tmpl_url']; ?>/images/ft.png" alt="<?php echo GB_VERSION ?>"></div>
    <?php } ?>
    <div id="ft_company">
    </div>
    <div id="ft_copy">
        <div>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company"><?php echo _t('회사소개'); ?></a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy"><?php echo _t('개인정보처리방침'); ?></a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision"><?php echo _t('서비스이용약관'); ?></a>
            Copyright &copy; <b><?php echo $config['cf_title']?></b>. <?php echo _t('All rights reserved.'); ?><br>
            <a href="#hd" id="ft_totop"><?php echo _t('상단으로'); ?></a>
        </div>
    </div>
</div>

<?php
if(G5_DEVICE_BUTTON_DISPLAY && !G5_IS_MOBILE) { ?>
<a href="<?php echo get_device_change_url(); ?>" id="device_change"><?php echo _t('모바일 버전으로 보기'); ?></a>
<?php
}
?>

<?php if(defined('POWERED_BY') && POWERED_BY) { ?>
<div id="powered_by">
    Powered by <a href="<?php echo BUILDER_HOME?>" target="_blank">Goodbuilder</a> 
    <?php if(defined('DESIGNED_BY') && DESIGNED_BY) { ?>
    / Designed by <a href="<?php echo BUILDER_HOME?>" target="_blank">Goodbuilder</a>
    <?php } ?>
</div>
<?php } ?>

<?php
if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<!-- } 하단 끝 -->

<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_TMPL_PATH."/tail.sub.php");
?>
