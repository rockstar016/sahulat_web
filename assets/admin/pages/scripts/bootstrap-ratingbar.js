/**
 * Created by rock on 3/15/17.
 */
var BootStrapRatingBar = function(){
    return {
        //main function to initiate the module

        init: function() {
            $('#user_ratingbar').barrating('show',{
                theme: 'bootstrap-stars',
                showSelectedRating: true,
                allowEmpty:true,
                readonly:true
            });
        },

    };
}();