var app = (function($) {
    var viewModels = {};

    function init() {
        initViewModels();
        bindjQueryElements();
    }

    function initViewModels() {
        viewModels.hotels = {};
        viewModels.hotels.searchForm = new Vue({
            el: '#hotels--search-form',
            data: {
                children: 0,
                childrenAges: []
            },
            watch: {

            },
            methods: {

            }
        });
    }

    function bindjQueryElements() {
        // Datepicker
        $('.js-datepicker').datepicker({
            todayHighlight: true,
            autoclose: true
        });

        // Typeaheads
        var regions = new Bloodhound({
            remote: {
                url: '/ajax/autosuggest/regions?query=%QUERY%',
                wildcard: '%QUERY%',
                filter: function(response) {
                    return response.results;
                }
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            datumTokenizer: function(datum) {
                return Bloodhound.tokenizers.whitespace(datum.d);
            }
        });

        $('.js-typeahead-region').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            source: regions.ttAdapter(),
            display: function(datum) {
                return datum.d;
            },
            templates: {
                empty: [
                    '<div>Nothing Found.</div>'
                ],
                suggestion: function (data) {
                    return ['<a href="#">', data.d, '</a>'].join('');
                }
            }
        }).on('typeahead:selected', function (obj, datum) {
            var el = $(this);
            $(el.data('bind-field-region-id')).val(datum.id);
            $(el.data('bind-field-region-airport-code')).val(datum.a);
        }).on('change', function() {
            var el = $(this);
            $(el.data('bind-field-region-id')).val('');
            $(el.data('bind-field-region-airport-code')).val('');
        });
    }

    return {
        init: init
    };
}($));

app.init();
