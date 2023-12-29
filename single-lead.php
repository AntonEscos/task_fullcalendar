
<?php 
    get_header();
?>

<div class="container">
    <?php
        if( have_rows('list_repeater') ):
            $count = 0;
            while( have_rows('list_repeater') ) : the_row(); $count++?>
                <span> Application # <?php echo $count; ?>;</span>
                <ul>
                    <li>Event - <?php echo $sub_value = get_sub_field('event'); ?></li>
                    <li>Name - <?php echo $sub_value = get_sub_field('name'); ?></li>
                    <li>Phone - <?php echo $sub_value = get_sub_field('phone'); ?></li>
                    <li>Email - <?php echo $sub_value = get_sub_field('email'); ?></li>
                </ul>
            <?php endwhile;
        endif;
    ?>
</div>

<?php 
    get_footer();
?>