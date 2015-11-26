(function($) {
    $(document).ready(function(){
    	$('#Form_Form_TeamAssignment .radio-option').click(function(){
    		var option = $(this).find('input');
    		if (option.val() == 'JoinExistingTeam') {
    			$('#JoinExistingTeam').show();
    			$('#CreateNewTeam').hide();
    		} else if (option.val() == 'CreateNewTeam') {
    			$('#CreateNewTeam').show();
    			$('#JoinExistingTeam').hide();
    		} else {
    			$('#CreateNewTeam').hide();
    			$('#JoinExistingTeam').hide();
    		}
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