<?php
function list_staff() {

    wp_reset_query();

    // Only staff members
    $args = array(
        'post_type' => 'staff_member',
        'posts_per_page' => 9999 // Set to high number to override default posts limit
    );

    $query = new WP_Query( $args );

    if ($query->have_posts()) :
        // Specify this table is a dataTable and assign an ID
        echo '<table class="tablepress dataTable" id="staff_table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Image</th>';
        echo '<th>First Name</th>';
        echo '<th>Last Name</th>';
        echo '<th>Position</th>';
        echo '<th>Notes</th>';
        echo '</tr>';
        echo '</thead>';
        while( $query->have_posts() ) : $query->the_post();

            // Get meta if exists
            $thumbnail = get_the_post_thumbnail( get_the_ID(), 'thumbnail' );
            $first_name = get_post_meta( get_the_ID(), '_first_name', true);
            $last_name = get_post_meta( get_the_ID(), '_last_name', true);
            $position = get_post_meta( get_the_ID(), '_position', true);
            $notes = get_post_meta( get_the_ID(), '_notes', true);

            ?>
        <tr>
            <td>
                <?php
                if($thumbnail) {
                    echo $thumbnail;
                } else {
                    echo 'No Image';
                }
                ?>
            </td>
            <td><?php echo $first_name; ?></td>
            <td><?php echo $last_name; ?></td>
            <td><?php echo $position; ?></td>
            <td><?php echo $notes; ?>
                <?php if ( current_user_can('edit_post', get_the_ID()) ) {
                    // Edit button if current user can edit staff members
                    //echo '<span class="edit-link"><a class="post-edit-link" href="/wp-admin/post.php?post='.get_the_ID().'&action=edit">EDIT</a></span>';
					$admin_post_url=site_url('wp-admin/post.php?post=');
					echo '<span class="edit-link"><a class="post-edit-link" href="'.$admin_post_url.''.get_the_ID().'&action=edit">EDIT</a></span>';
                } ?>
            </td>
        </tr>
        <?php
        endwhile;
		 echo '<tfoot>';
        echo '<tr>';
        echo '<th>Image</th>';
        echo '<th>First Name</th>';
        echo '<th>Last Name</th>';
        echo '<th>Position</th>';
        echo '<th>Notes</th>';
        echo '</tr>';
        echo '</tfoot>';
        echo '</table>';
        ?>
    <script type="text/javascript">
        jQuery(document).ready(function(){
			// Setup - add a text input to each footer cell
			$('#staff_table tfoot th').each( function () {
				var title = $('#staff_table thead th').eq( $(this).index() ).text();
				$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
			} );
			
            // Init dataTable
            var table = jQuery('#staff_table').dataTable({
				//"processing": true,
				//"serverSide": true,
                "aaSorting":[],
                "bSortClasses":false,
                "asStripeClasses":['even','odd'],
                "bSort":true,
				
                aoColumnDefs: [
                    {
                        bSortable: false,
                        aTargets: [ 0,4 ]
                    }
                ],
				
				// custom added by me for search function obtain from original datatable.net
				initComplete: function(){
				this.api().columns().every( function () {
				var that = this;
 
				$( 'input', this.footer() ).on( 'keyup change clear', function () {
					if (that.search() !==this.value){
				
                //that.search( this.value ).draw();
				var filterTerm = this.value;
				var term = '^' + filterTerm +'.*$'; /*  '^' + filterTerm+'*';  '^((?!' + filterTerm + ').)*$'; */
				//var term = filterTerm;
				that.search(term , true, false, true ).draw(); // (term, regex=true/false, smart=true/false, case insensitive=true/false) 
                
					}
				} );
				} ); 
				} // initComplete
	
			// custom added by me for search function ends
				
            });
			// custom added by me for search function
			// custom added by me for search function ends
        });
    </script>
    <?php
    endif;

}

function list_staff_obj($atts, $content=null) {
    ob_start();
    list_staff($atts, $content=null);
    $output=ob_get_contents();
    ob_end_clean();
    return $output;
}

add_shortcode( 'list-staff', 'list_staff_obj' );
?>