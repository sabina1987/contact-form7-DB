//add submenu CF7DB under by admin tools menu and show contact lists

add_action('admin_menu', 'tool_submenu_page');
 
function tool_submenu_page() {
    add_submenu_page(
        'tools.php',
        'CF7 DB',
        'CF7 DB',
        'manage_options',
        'cf7-db',
        'cf7_db_submenu_page_callback' );
}
 
function cf7_db_submenu_page_callback() {
    echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
        echo '<h2>Contact Lists</h2>';
    echo '</div>';

    global $wpdb;
    $table_name = $wpdb->prefix . "cf7database";	    
	$contactlist = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY id DESC" );
	   //print_r($customerlist);
	    $i=1;
?>

	<table>
	    <tr>
    		<th>ID.</th>
    		<th>Full Name</th>
    		<th>Contact Number</th>
    		<th>Message</th>
    		<th>Submit Date</th>
    	</tr>
    	
    	<?php foreach($contactlist as $contacts){ ?>

    	<tr>
		    <td><?php echo $contacts->id ;?></td>
		    <td><?php echo $contacts->fullname ;?></td>
		    <td><?php echo $contacts->contact_number;?></td>
		    <td><?php echo $contacts->message;?></td>
		    <!-- <td> <?php $pubdate=$contacts->submitdatetime;echo date('Y-m-d h:m:s', strtotime($pubdate));?></td> -->
		     <td> <?php echo $contacts->submitdatetime;?></td>
		</tr>
		<?php }?>			
	</table>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<?php }
