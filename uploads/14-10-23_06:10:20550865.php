           <?php
/*
Template Name: Mortage Calculator
*/
global $themeple_config;
    
    do_action( 'themeple_routing_template' , 'page' );
    $themeple_config['current_view'] = 'page';
    $meta = themeple_post_meta(themeple_get_post_id());


    if(!isset($themeple_config['current_sidebar']) ){
        $themeple_config['current_sidebar'] = 'fullsize';
    }

    if(isset($meta['layout']))
        $themeple_config['current_sidebar'] = $meta['layout'];
    $spancontent = 12;
    if(isset($themeple_config['current_sidebar']) && $themeple_config['current_sidebar'] == 'fullsize')
        $spancontent = 12;
    elseif(isset($themeple_config['current_sidebar']) && ($themeple_config['current_sidebar'] == 'sidebar_left' || $themeple_config['current_sidebar'] == 'sidebar_right'))
        $spancontent = 9;

    get_header();
    
    
    ?>
    
        <?php
            
            $title = get_the_title();
            $page_parents = page_parents();
            $subtitle = themeple_post_meta(themeple_get_post_id(), 'page_header_desc');
        ?>

    <?php get_template_part('template_inc/page_header'); ?>

  <?php 
    
    $left_nav_bg = themeple_get_option('left_nav_bg');
    $left_nav_bg_color = themeple_get_option('left_nav_bg_color');

    if(!empty($left_nav_bg)){


   $bg = 'style="background:'.$left_nav_bg_color.' url('.$left_nav_bg.') no-repeat";'; 
   
   }else{

    $bg = 'style="background:'.$left_nav_bg_color.'";'; 

   }
  ?>
  
<section id="content" class="left-navigation" <?php echo $bg; ?>>
 
        <div class="container" id="page">
            <div class="row">
                    <div class="span3">
                            <ul class="side-nav">
                                <?php if(is_page('$post->post_parent')): ?><?php endif; ?>
                                <li <?php if(is_page($post->post_parent)): ?>class="current_page_item"<?php endif; ?>><a href="<?php echo get_permalink($post->post_parent); ?>" title="Back to Parent Page"><?php echo get_the_title($post->post_parent); ?></a></li>
                               
                            <?php
                                  if($post->post_parent) {
                                  $children = wp_list_pages("title_li=&child_of=".themeple_get_post_top_ancestor_id()."&echo=0");
                              
                                  }else{
                                  $children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
                                 
                                  }
                                  if ($children) { ?>

                               
                                  <ul>
                                  <?php echo $children; ?>
                                  </ul>

                            <?php } ?>
                                                       
                           
                    </div>

                    <div class="span9">
                    
        <!--Mortage Calculator-->
               
             <div class="form_bg">
	<div class="form_left">
		<form action="" method="post">
			
			<div class="form_row">
				<label>The Amount you'd like to borrow</label>
				<input type="text" name="num1" value="<?php if(isset($_POST['num1'])) echo $_POST['num1'];?>" />
			</div>
			<div class="form_row">
				<label>Loan Term ( Years )</label>
				<input type="text" name="num2" value="<?php if(isset($_POST['num2'])) echo $_POST['num2'];?>" />
			</div>
			<div class="form_row">
				<label>Interest Rate</label>
				<input type="text" name="num3" value="<?php if(isset($_POST['num3'])) echo $_POST['num3'];?>" />
			</div>
			
			<div class="form_row">
				<select name="plan">
  <option value="">Select Plan</option>  
  <option name="num4" value="Fortnightly" <?php // if(isset($_POST['plan']) == "Fortnightly") echo "selected = selected"?> >Fortnightly</option>
  <option name="num4" value="Monthly"  <?php // if(isset($_POST['plan']) == "Monthly") echo "selected = selected"?> >Monthly</option>
  <option name="num4" value="Quartterly"  <?php // if(isset($_POST['plan']) == "Quartterly") echo "selected = selected"?> >Quartterly</option>

</select>
			</div>
			
			<div class="form_row">
				<label>Repayment Type</label>
				<input type="submit" name="btn_submit" id="" value="Principal and Interest"/>
				<input type="submit" name="btn_submit1" id="" value="Interest Only"/>
			</div>
			
			
		</form>
	</div>
	<?php
    if(isset($_POST['btn_submit']))
    {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $num3 = $_POST['num3'];
        $frequency = $_POST['num4'];
        
        
        $p=$num1;
         $n=$num2 * 12;
         $i= ($num3/100)/12;
     $temp2=(1+$i);
     
     $temp1=1;
     for($k=0;$k<$n;$k++)
     {
     $temp1=$temp1*$temp2;
     }
        
        $MonthyPayment = $p*(($i*$temp1)/($temp1-1));
               
        if(isset($_REQUEST['plan']))
        {
        $val=$_REQUEST['plan'];
        switch($val)
        {
        case "Fortnightly":
        {
	           $payment=intval($MonthyPayment/2);
	           $freq="Fortnightly";
	           break;
	   }
	        
	   case "Monthly":
	       { $payment=intval($MonthyPayment);
	       $freq="monthly";
	       break;
	       }
	    case "Quartterly":
	       {
	        $payment=intval($MonthyPayment*3);
	        $freq="Quartterly";
	        break;
	        }
	        default :
	        {}

        }}
        
        $pr = $payment;
       
        //  echo "Your repayment would be: ".$payment."per".$freq;

        $loan = intval($MonthyPayment * $n);
        
         
        $totalInterest = intval($loan - $p);
    
        
    }
    else
    {
    $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $num3 = $_POST['num3'];
        $yinterest=($num1*$num3)/100;
        
        $interset=$yinterest;
        
        if(isset($_REQUEST['plan']))
        {
        $val=$_REQUEST['plan'];
        switch($val)
        {
        case "Fortnightly":
        {
	           $payment=intval($interset/24);
	           $freq="Fortnightly";
	           break;
	   }
	        
	   case "Monthly":
	       { $payment=intval($interset/12);
	       $freq="monthly";
	       break;
	       }
	    case "Quartterly":
	       {
	        $payment=intval($interset/3);
	        $freq="Quartterly";
	        break;
	        }
	        default :
	        {}

        }}
          
           $pr = $payment;
        $loan=$yinterest*$num2;
                  
              $totalInterest=$num1-$loan;
        
        }
	?>

	
	<div class="form_right">
		<div class="form_right_inner">
			<div class="payment_details">
				<div class="form_row">
				<label>Your replayment would be:</label>
					<label><h1>$ <?php if(isset($pr)){ echo $pr; }else{ echo "0"; }?><span class="heading_small">per <?php echo $freq;?> </span></h1></label>
					</div>
				        <div class="form_row">
					<label>Total Loan Repayment</label>
					<label><h2>$ <?php if(isset($loan)){ echo $loan ; }else{ echo "0"; }?></h2></label>
					</div>
					<div class="form_row">
				       <label>Total Interest Charged</label>
					<label><h2>$ <?php if(isset($totalInterest)){ echo $totalInterest ; }else{ echo "0"; }?></h2></label>"</div>
					
				</div>
			</div>
		</div>	
	</div>
	        
			   <?php if(isset($genDynamic))	
            				$genDynamic->display();
        			  else
                        		the_content() 
			   ?>
                    </div>

            </div>
        </div>
</section>
<?php
    get_footer();


?>
                            
                            
                            
                            
                            