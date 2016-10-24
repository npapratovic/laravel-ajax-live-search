<!-- Compatibillity issues -->
<script type="text/javascript">
jQuery.fn.extend({
    live: function (event, callback) {
       if (this.selector) {
            jQuery(document).on(event, this.selector, callback);
        }
    }
});
</script>





<div class="row">

    <div class="col-md-2">
        <div class="icon"></div>
    </div>
    <div class="col-md-10">
        <input type="text" id="search" autocomplete="off">
    </div>
  	<ul id="results"></ul>                       

</div>
 



<script type="text/javascript">
             
// Search  
$(document).ready(function() {  

	// Icon Click Focus
	$('div.icon').click(function(){
		$('input#search').focus();
	});

	// Live Search
	// On Search Submit and Get Results
	function search() {
		var query_value = $('input#search').val();
 		$('b#search-string').text(query_value);
		if(query_value !== ''){
			$.ajax({
				type: "POST",
				url: "/search/",
				data: { query: query_value}, //this can be more complex if needed
				cache: false,
				success: function(data){
					//at each request - every written letter is request, firstly we delete old results, and fetch new ones.
                    $('#results').empty();
                    $.each(data.result, function(index, item) {
                        //now you can access properties using dot notation
                        //  console.log(data.result[index].first_name);
                        // Here I am fetching users names from users table, and echoing ther profile url
                          $('#results').append("<li><a href='" + data.result[index].permalink + "'>" + data.result[index].first_name + "</a></li>");
                    });
				}
			});
		}return false;    
	}

	$("input#search").live("keyup", function(e) {
		// Set Timeout
		clearTimeout($.data(this, 'timer'));

		// Set Search String
		var search_string = $(this).val();

		// Do Search
		if (search_string == '') {
			$("ul#results").fadeOut();
			$('h4#results-text').fadeOut();
		}else{
			$("ul#results").fadeIn();
			$('h4#results-text').fadeIn();
			$(this).data('timer', setTimeout(search, 100));
		};
	});

});
</script>