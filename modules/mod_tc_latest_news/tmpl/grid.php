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
<div class="tc_latestnews <?php echo $moduleclass_sfx; ?>">
<?php 
$class='tc_column_'.$per_row;
foreach ($list as $item) :  ?>
	<div class="<?php echo $class; ?> news-item grid" itemscope itemtype="http://schema.org/Article">
        <?php if($show_title):?>
		<h2><a href="<?php echo $item->link; ?>" itemprop="url">
			<span itemprop="name">
				<?php echo $item->title; ?>
			</span>
		</a>
        </h2>
        <?php endif; ?>
         <?php 
			    $pattern = '/<img\b[^>]+?src\s*=\s*[\'"]?([^\s\'"?#>]+)/'; 
				preg_match($pattern, $item->introtext, $matches ); 
				$strip_string=strip_tags($item->introtext); 
          ?>
 		<?php if($show_image): ?>
         <div class="introimage comfort-radial-out"> 

				<?php if(!empty($matches[1])):?>
					<img src="<?php echo $matches[1] ?>" alt="<?php echo $item->title; ?>" class="pull-left img-left" />
                    <?php else: ?>
					<img src="<?php echo JPATH_SITE.'/modules/mod_tc_latest_news/assets/images/no-image.jpg' ?>" alt="<?php echo $item->title; ?>" class="pull-left img-left" />
					<?php
					endif;
					?>
                    <?php if($show_category): ?>
                    <div class="hover_after"> 
						<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($item->catid, $item->catid))?>"><?php  echo ModTCLatestNewsHelper::getCategoryName($item->catid);?></a>
                    </div>
                    <?php endif;?>
        </div>
        <?php else: ?>
	    	<?php if($show_category): ?>
                <div class="post_category"> 
                    <a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($item->catid, $item->catid))?>">
                        <i class="fa fa-folder-o"></i> <?php  echo ModTCLatestNewsHelper::getCategoryName($item->catid);?>
                    </a>
                </div>
            <?php endif;?>
        <?php endif; ?>

        <?php if($show_date):?>
        <div class="post_date">
                <i class="fa fa-calendar"></i> <small><?php echo JHtml::_('date', $item->created, JText::_('DATE_FORMAT_LC3')); ?></small> 
		 </div>
         <?php endif; ?>
        <?php if($show_desc):?>
        <div class="introtext">
        	 <?php echo substr($strip_string,0,$char_limit).'...';?>
        </div>
        <?php endif; ?>

        <div class="more">
        	<a href="<?php echo $item->link; ?>" class="read_more" itemprop="url">
			<span itemprop="name">
				<i class="fa fa-plus-square-o"></i> <?php echo JText::_('MOD_TC_LATEST_NEWS_READ_MORE'); ?>
			</span>
		</a>
        </div>

	</div>
<?php endforeach; ?>
</div>
