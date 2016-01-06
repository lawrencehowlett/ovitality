(function($) {
    $(document).ready(function(){
		$('#ex1').slider({
			formatter: function(value) {
				return 'Current value: ' + value;
			}
		});

        $(".knob").knob({
            draw : function () {

                if(this.$.data('skin') == 'tron') {
                    this.cursorExt = 0.3;
                    var a = this.arc(this.cv)  // Arc
                        , pa                   // Previous arc
                        , r = 1;

                    this.g.lineWidth = this.lineWidth;

                    if (this.o.displayPrevious) {
                        pa = this.arc(this.v);
                        this.g.beginPath();
                        this.g.strokeStyle = this.pColor;
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, pa.s, pa.e, pa.d);
                        this.g.stroke();
                    }

                    this.g.beginPath();
                    this.g.strokeStyle = r ? this.o.fgColor : this.fgColor ;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, a.s, a.e, a.d);
                    this.g.stroke();

                    this.g.lineWidth = 2;
                    this.g.beginPath();
                    this.g.strokeStyle = this.o.fgColor;
                    this.g.arc( this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                    this.g.stroke();

                    return false;
                }
            }
        });

		/**
		 * Line charts
		 */
		var lineChartData = {
			labels : ["January","February","March","April","May","June","July"],
			datasets : [
				{
					label: "My First dataset",
					fillColor : "rgba(151,187,205,0.2)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : [10,50,40,30,1,65,90]
				}
			]
		}

		window.onload = function(){
			var ctx = document.getElementById("canvas").getContext("2d");
			window.myLine = new Chart(ctx).Line(lineChartData, {
				responsive: true
			});
		}

		/**
		 * Modal form submission
		 */
		if ($('.foundry_modal').length > 0) {
			var modal = $('.foundry_modal');
			modal.prepend($('<i class="ti-close close-modal">'));
			modal.addClass('reveal-modal');
			$('.modal-screen').addClass('reveal-modal');

			jQuery('.close-modal:not(.modal-strip .close-modal)').unbind('click').click(function(){
				var modal = jQuery(this).closest('.foundry_modal');
			    modal.toggleClass('reveal-modal');
			    jQuery('.modal-screen').removeClass('reveal-modal');
			});			
		};
		
    });
})(jQuery);