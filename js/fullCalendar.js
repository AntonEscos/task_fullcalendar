document.addEventListener('DOMContentLoaded', function() {

var calendarEl = document.getElementById('calendar');

var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    events: JSON.parse(acf_data),
    eventClick: function(info) {
        let customData = info.event.extendedProps.custom_data;
		jQuery(function($){ 
            $.ajax({
                url : array_params.ajaxurl, 
                data : {
                    action: 'events',
                    customData: customData
                },
                type : 'POST',
                success : function( res ){
                    $('#popupContainer').html(res);

                    var popupContainer = document.getElementById('popupContainer');
                    var closePopupButton = document.getElementById('closePopupButton');

                    // open popup
                        popupContainer.style.display = 'flex';
                    

                    // close popup
                    closePopupButton.addEventListener('click', function() {
                        popupContainer.style.display = 'none';
                    });
                    
                    popupContainer.addEventListener('click', function(event) {
                        if (event.target === popupContainer) {
                            popupContainer.style.display = 'none';
                        }
                    });

                    $('#button_anton').on('click', function(e){
                        var inputName = $('#event_name').val();
                        var inputPhone = $('#event_phone').val();
                        var inputEmail = $('#event_email').val();

                        $.ajax({
                            url : array_params.ajaxurl, 
                            data : {
                                action: 'events_cpt',
                                customDataCpt: customData,
                                name: inputName,
                                phone: inputPhone,
                                email: inputEmail
                            },
                            type : 'POST',
                            success : function( dat ){
                                $('#popupContent').html('Good!');

                                setTimeout(function() {
                                    popupContainer.style.display = 'none';
                                }, 1000);
                            }
                        });
                    })
                }
		    });
        });
    }
});
    calendar.render();
    
});