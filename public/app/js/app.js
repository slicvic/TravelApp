var app = (function(jquery) {
    function init() {
        bindDatepicker();
    }

    function bindDatepicker() {
        jquery('[data-datepicker]').datepicker({
            todayHighlight: true,
            autoclose: true
        });

        jquery('[data-datepicker]').datepicker({
            todayHighlight: true,
            autoclose: true
        });
    }

    init();

    $('[data-typeahead-cities]').typeahead(
      { hint: true,
        highlight: true,
        minLength: 1
      },
      {
      display: function(item) {
        return item.f;
      },
      source: function(query, syncResults, asyncResults) {
       $.get('/ajax/autosuggest/cities?query=' + query, function(data) {
         asyncResults(data.results);
       });
     }
    });

}($));
