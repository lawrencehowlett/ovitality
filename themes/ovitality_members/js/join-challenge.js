(function($) {
    $(document).ready(function(){

        $('.checkbox-option').click(function(){
            if ($(this).find('input').attr('name') == 'JoinExistingTeam') {
                $('#Form_Form_AutoAssignTeam').val(0).parent('.checkbox-option').removeClass('checked');
                $('#Form_Form_SuggestTeam').attr('required', true);
            } else {
                $('#Form_Form_JoinExistingTeam').val(0).parent('.checkbox-option').removeClass('checked');
                $('#Form_Form_SuggestTeam').attr('required', false);
            };
        });

		$('#Form_Form_SuggestTeam').typeahead({
			autoSelect: true, 
			source:function(query, process){
				return $.getJSON('member-area/challenges/join-challenge/GetTeams/Competitive', function(data){
					return process(data);
				});
			}
		});

        $('#Form_Form_SuggestTeam').change(function() {
            var current = $(this).typeahead("getActive");
            $('#Form_Form_TeamID').val(current.id);
        });		
    });
})(jQuery);		