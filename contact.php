// create contact template file of your theme folder
// wp-content/themes/your theme folder/contact.php
// Contact.php


<?php 
   $error = '';
	$success = '';
	// check if we're in mail form
	if( isset( $_POST['submit'] ) ){

		global $wpdb;
		date_default_timezone_set('Asia/Singapore');
		$name=$_POST['field-name'];
		$contactno=$_POST['field-contact'];
		$mes=$_POST['field-message'];
		$datetime=date('Y-m-d H:i:s');

		$to="yourmail@test.com";
		$admin_name='Admin';
		$subject="Enquiry";
		$headers='From: '. $admin_name .'  <'. $to .'>' . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
		$messages="<div>
				Full Name                 : $name <br/>
				Singapore Contact Number  : $contactno <br/>
				Message                   : $mes <br/>
				
            </div>";

		$mail=wp_mail($to,$subject,$messages,$headers);

		if ($mail) {
			$success="successfully send message";
		}else{
			$error="Error";
		}

		// Insert data in database table
        $wpdb->insert( 'wp_cf7database', array('fullname' =>$name,'contact_number' =>$contactno, 'message' =>$mes,'submitdatetime'=>$datetime) ); 
        $record_id = $wpdb->insert_id;

	}
?>

<?php
/**
 * Template Name: Contact Template
 */

get_header();
?>

<h2>Get In Touch</h2>


<?php if($success!=""){ echo $success;}else{echo $error;}?>

<form method="post">
				
		<label for="name" class="coblocks-label">Full Name <span class="required">*</span></label>
		<input type="text" id="name" name="field-name" class="" required="">
		<br/>		
		<label for="contact" class="coblocks-label">Singapur Contact Number <span class="required">*</span></label>		
		<input type="tel" id="contact" name="field-contact" maxlength="8" required="">
		<br/>
		<label for="message" class="coblocks-label">Message <span class="required">*</span></label>		
		<textarea name="field-message" id="message" class="" rows="3" required=""></textarea>
		<input type="submit" name="submit" value="Submit">

</form>


<style>
input[type=text], select, textarea {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=tel] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 20%;
  background-color: #4CAF50 !important;
  color: white !important;
  padding: 14px 20px !important;
  margin: 8px 0;
  border: none !important;
  border-radius: 4px;

}

input[type=submit]:hover {
   width: 20%;
  background-color: #4CAF50 !important;
  color: white !important;
  padding: 14px 20px !important;
  margin: 8px 0;
  border: none !important;
  border-radius: 4px;

}


</style>

<?php get_footer();?>

