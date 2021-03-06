<script>
	var queryString  = "<?= $this->config->item('admin_url') ?>/<?= $this->name ?>/";
	
	function submitForm(){
		var formdata = $('form').serialize();
		resetOutline();
		console.log(queryString+"submitAnswer/?"+formdata);
		$.post(queryString+"submitAnswer/", formdata, function(datas) {  
			console.log(datas);
				var obj = $.parseJSON(datas);
				
				if(obj.status == "error"){ 
					$(".error_message").show();
					$.each(obj.error_code, function(idx, objs) {    
						$("."+objs.question).css('outline','1px solid #ff0000');
					});
						$(".error_message").html("Please check the form below :");
				}else{
					//success and redirection
					noty({"text":"Form submitted successfully","layout":"center","type":"success","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":2000,"closeButton":false,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":false});
					setTimeout(function() {location.href=queryString},2000);	 		 
				}
		});
		
		return false;
	}
	
	function resetOutline(){
		$(".error_message").hide();
		$(".required").css('outline','');
	}
	
</script>
<div class="container_header">
	<div class="header_title"><a class="separator" href="<?= $this->config->item('domain') ?>">Home</a> <a class="separator" href="#"><?= ucwords($this->name) ?></a> <?= ucwords($this->name) ?></div>
	<div style="clear:both"></div>
</div>
<?= $template['partials']['message']; ?>
<div id="submenu">
	<ul>
        <li><a href="<?php echo $this->config->item('admin_url').'/'?><?= $this->name ?>/">Back</a></li>
    </ul>
</div>
<div id="the_list">
    <form>
    <?php
    $submitButton = 1;
    if(!empty($result['data'])) {  
            echo form_hidden('isCustomerForm', set_value('isCustomerForm',$result['data']['isCustomerForm']));
            if($result['data']['isCustomerForm'] == "1"){?>
                <div class="header_title">Personal Details</div> 
                <div style="background-color:<?= $result['data']['background'] ?>;width:100%;margin-top:10px;margin-bottom:10px;clear: both;">
                    <div style="padding:10px;font-size:14px;">Full Name</div>
                    <div style="padding-left:10px;padding-bottom:5px;">
                        <?=  form_input('name', '','class="required" placeholder="Please fill in customer name" style="width:50%;"') ?>
                    </div>
                    
                    <div style="padding:10px;font-size:14px;">I/C</div>
                    <div style="padding-left:10px;padding-bottom:5px;">
                        <?=  form_input('ic', '','class="required" placeholder="Please fill in identity card number" style="width:50%;"') ?>
                    </div>
                    
                    <div style="padding:10px;font-size:14px;">Email Address</div>
                    <div style="padding-left:10px;padding-bottom:5px;">
                        <?=  form_input('email', '','class="required" placeholder="Please fill in email address" style="width:50%;"') ?>
                    </div>
                    
                    <div style="padding:10px;font-size:14px;">Contact Home</div>
                    <div style="padding-left:10px;padding-bottom:5px;">
                        <?=  form_input('contact_home', '','class="required" placeholder="Please fill in home contact number" style="width:50%;"') ?>
                    </div>
                    
                    <div style="padding:10px;font-size:14px;">Contact Mobile</div>
                    <div style="padding-left:10px;padding-bottom:5px;">
                        <?=  form_input('contact_mobile', '','class="required" placeholder="Please fill in mobile contact number" style="width:50%;"') ?>
                    </div>
                    
                    <div style="padding:10px;font-size:14px;">Contact Office</div>
                    <div style="padding-left:10px;padding-bottom:5px;">
                        <?=  form_input('contact_office', '','class="required" placeholder="Please fill in office contact number" style="width:50%;"') ?>
                    </div>
                    
                    <div style="padding:10px;font-size:14px;">Age</div>
                    <div style="padding-left:10px;padding-bottom:5px;">
                        <?=  form_input('age', '','class="required" placeholder="Please fill in customer age" style="width:50%;"') ?>
                    </div>
                    <div style="padding:10px;font-size:14px;">Address(Mail)</div>
                    <div style="padding-left:10px;padding-bottom:5px;">
                        <textarea name="mail_address" row="4" placeholder="Mailing address" ></textarea>
                    </div>
                    
                    <div style="padding:10px;font-size:14px;">Address(Home)</div>
                    <div style="padding-left:10px;padding-bottom:5px;">
                        <textarea name="home_address" row="4" placeholder="Mailing address"></textarea>
                    </div>
                </div>
    <?php 		} ?>
            <div style="font-size:14px;"><?= $result['data']['name'] ?></div>
            <div style="font-size:10px;color: #A4A4A4;"><?= $result['data']['description'] ?></div>
            <div class="error_message" style="display:none;"></div>
            <div style="background-color:<?= $result['data']['background'] ?>;width:100%;margin-top:10px;">
    <?php		
            echo form_hidden('t_id', set_value('t_id',$result['data']['id']));
            
            if(!empty($result['data']['questions'])){
            $index = 1;
            foreach($result['data']['questions'] as $k => $val){
                $showIndex = "";
                if($result['data']['isIndex'] == "1"){
                    $showIndex = "1";
                }
        ?>
            <div class="header_title"><?= !empty($showIndex) ? $index.".  " : "" ?><?= $val['question'] ?></div>
            <div style="padding-left:20px;padding-bottom:10px;clear: both;">
                
            <?php
                
                switch($val['type']) {
                    case 1: // TEXT INPUT
                        echo   form_input('q_'. $val['id'], '','class="required '.$val['id'].'" placeholder="Please fill in '.$val['question'] .'" style="width:50%;"'); 
                    break;	
                    case 2: // TEXT AREA
                        echo   form_textarea('q_'. $val['id'], '','class="required '.$val['id'].'" placeholder="Please fill in '.$val['question'] .'" style="width:50%;"'); 
                    break;	
                    case 3: //RADIO BUTTON
                        echo	form_hidden('q_'. $val['id'], "");
                        foreach($val['answer'] as $sk => $ans){
                            
                            $radioValue = array(
                                'name'    => 'q_'. $val['id'],
                                'id'          => 'q_'. $val['id'],
                                'value'       => $sk,
                                'class'         => "required ".  $val['id'],
                                'checked'     => FALSE, 
                            );
                            echo   form_radio($radioValue) . "<span style='margin-right:20px;'>".$ans."</span>"; 
                        }
                    break;	
                    case 4: //CHECKBOX
                        echo	form_hidden('q_'. $val['id'], "");
                        foreach($val['answer'] as $sk => $ans){
                            $radioValue = array(
                                'name'    => 'q_'. $val['id']."[]",
                                'id'          => 'q_'. $val['id'],
                                'value'       => $sk,
                                 'class'         => "required ". $val['id'],
                                'checked'     => FALSE, 
                            );
                            echo   form_checkbox($radioValue) . "<span style='margin-right:20px;'>".$ans."</span>"; 
                        }
                    break;	
                }
                $index++; 
                ?>
                </div>
        <?php	}
                }else{
                    $submitButton  = 0;
                    echo "<div class='error_message'>No question available at the moment.</div>";
                }
         } ?> 
    </div>
    <div style="clear:both"></div>
    </form>
    <div style="width:100%;text-align:center;padding-top:10px;">
        <button class="gold_button" onclick="location.href='<?=$this->config->item('admin_url')?>/<?= $this->name ?>/';">Back</button>
        <?php if($submitButton  == 1){  ?>
            <button type="submit"  value="Submit" onClick="return submitForm();">Submit</button>  
        <?php }  ?>
    </div>
</div>

