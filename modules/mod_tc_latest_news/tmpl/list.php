<?php
/**
* @version	 $Id$
* @package   TC Latest News
* @author    ThemeChoice.com http://www.themechoice.com
* @copyright Copyright (C) 2015 ThemeChoice.com. All rights reserved.
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;
require_once JPATH_SITE.'/components/com_content/helpers/route.php'
?>

<div id="" class=" <?php echo $moduleclass_sfx; ?>">
<?php 
$str='';
//$class='tc_column_'.$per_row;
foreach ($list as $item) :  ?>

        <?php if($show_title):?> 
<?php $str = $str.	'&nbsp;&nbsp; *    <a href="'. $item->link.'" itemprop="url">';
$str=$str.'';
$str=$str.$item->title.' &nbsp;* ';
?>
        <?php endif; ?>
	
<?php endforeach; ?>

<marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();" >
<h2>
<?php echo $str.''; ?>
</h2>
</marquee>


</div>
<style scoped="scoped">

#tc-news-carousel .owl-controls .owl-prev{
	position:absolute;
	left:15px !important;
	float: left;
	background: rgba(0, 0, 0, 0.8);
    padding:10px 8px 10px !important;
}
#tc-news-carousel .owl-controls .owl-next{
	position:absolute;
	right:15px !important;
	float: right;
	background: rgba(0, 0, 0, 0.8);
    padding:10px 8px 10px !important;
}

#tc-news-carousel .owl-prev, #tc-news-carousel .owl-next {
    position: absolute;
    top: 50%;
    margin-top: -50px;
    width: 46px;
    text-align: center;
    color: #fff;
    filter: Alpha(Opacity=50);/*IE7 fix*/
    opacity: 0.5;
}
#tc-news-carousel .owl-prev:hover, .owl-next:hover {
    filter: Alpha(Opacity=100);/*IE7 fix*/
    opacity: 1;
}
/*
.marquee-item {
		margin:0px 0px 0px 0px;
	padding:0px 0px 0px 0px;
	}
.marquee-item ul{
		margin:0px 0px 0px 0px;
	padding:0px 0px 0px 0px;
	}
.marquee-item ul li{
	display:inline-block;
	list-style:none;
	    margin: 0px 25px 0px 0px;
	padding:0px 0px 0px 0px;
	    float: left;
	}
*/
.marquee {
  margin: auto;
  position: relative;
overflow:hidden;
  max-width: 100%;
}

.marquee ul li {
  position: relative;
  display:inline-block;
  float: left;
}

</style>
<!-- <script>
jQuery(document).ready(function() {
   var owl = jQuery("#tc-news-carousel");
   owl.owlCarousel({
		loop:true,
		pagination: <?php echo $params->get('pagination'); ?>,
		navigation:<?php echo $params->get('nav'); ?>,
		navigationText: [
      "<i class='fa fa-arrow-left'></i>",
      "<i class='fa fa-arrow-right'></i>"
      ],
		autoPlay:<?php echo $params->get('autoplay'); ?>,
		slideSpeed: <?php echo $params->get('slide_speed'); ?>,
		items:<?php echo $per_row; ?>,
	})
});
</script> -->



