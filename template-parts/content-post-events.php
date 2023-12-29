<?php $post = get_query_var('post'); ?>

<div id="popupContent" class="popup-content">
    <span id="closePopupButton" class="close-popup">&times;</span>
    <div id='event_container'>
        
        <span>Event - </span> 
        <?php echo esc_html(get_the_title($post)); ?>
        <div> 
            <span> Start : <?php echo esc_html(get_field('start_event', $post->id))?>;<span>
            </br>
            <span>End : <?php echo esc_html(get_field('end_event', $post->id))?>;<span>
        </div>
        <div>
            <label for="event_name">Name:</label>
            <input type="text" id="event_name" name="event_name" required>
            </br>
            <label for="event_phone">Phone:</label>
            <input type="tel" id="event_phone" name="event_phone" required>
            </br>
            <label for="event_email">Email:</label>
            <input type="email" id="event_email" name="event_email" required>
            </br>
            <button id="button_anton">Button</button>
        </div>
    </div>
</div>