<div class="wrapper-active"<?php echo $index%4==0? 'style="clear: both;"':''?>>
    <div class="span2 product-content fix-content  <?php echo ($index%4 == 3)?' last-column':''?>">
        <div class="product-image">
            <a href="/productsshop/detail/<?php echo $data->shop_id ?>/<?php echo $data->id; ?>"><?php if($data->image != null){ ?>
            <img <?php echo 'src="/uploads/product_shop/'.$data->image.'"'?> title="<?php echo $data->name?>" alt="<?php echo $data->name; ?>"/>
        <?php }else{ ?>
            <img <?php echo 'src="/uploads/product_shop/no-images.jpg"'?>/>
        <?php } ?></a>
        </div>
        <p class="fix-title"><a href="/productsshop/detail/<?php echo $data->shop_id ?>/<?php echo $data->id; ?>" title="<?php echo $data->name?>"><?php echo strlen($data->name)>20?substr($data->name, 0, 20)."...":$data->name?></a></p>
       <div class="text_shipping">
            <?php if ($data->shipping_immediately ==1){
                echo "<div class='delivery_im'>".Yii::t('global','Delivery immediately')."</div>";
            } if($data->shipping_cost ==''||$data->shipping_cost ==0  ) {
                echo "<div class='delivery_im'>".Yii::t('global','Shipping cost free')."</div>";
            }?>
        </div>
        <div class="clearfix"></div>
        <div class="contain-price">
         <p class="nur"><strong><?php echo Yii::t('global', 'only')?> <span class="big"><?php echo Utils::number_format($data->price_purchase)?> &euro;</span></strong></p>
        <?php if($data->discount_percent>0){ ?>
        <p class="statt">(<?php echo Yii::t('global', 'instead')?> <?php echo Utils::number_format($data->price)?> &euro;)</p>
        <div class="sales_cat"><?php echo '-'.$data->discount_percent.'%'?></div>
        <?php }?>
        </div>
       
            <div class="rating_new_shop">
             <div class="rating-label">
                 <span class="rating_new_shop_label">
                   <?php 
                      $this->widget('ext.dzRaty.DzRaty', array(
                            'name' => 'my_rating_field_label_product_shop_'.$data->id,
                            'value' => Ratings::model()->getRating($data->id),
                            'options' => array(
                                    'half' => TRUE,
                                    	'click' => "js:function(score, evt){ ratings(score,".$data->id.") }",
                             ),
                            'htmlOptions' => array(
                            'class' => 'new-half-class'
                            ),
                        ));
                        $this->renderPartial('../elements/rate_product');
                    ?></span>
                    <span class="number_rating_category">( <?php Ratings::model()->totalRating( $data->id ); ?> ) </span>
                
            </div>
            </div> 
         <div class="clearfix"></div>
        <a href="/productsshop/detail/<?php echo $data->shop_id ?>/<?php echo $data->id; ?>" data-id="<?php echo $data->id?>" class="btn-kaufen"><?php echo Yii::t('global', 'Buy')?></a>
        <p><?php echo $data->quantity .' ' .Yii::t('global','Product'); ?></p>
    </div>
</div>
