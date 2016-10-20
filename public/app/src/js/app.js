var app = (function($) {
    var selectors = {
        typeahead: {
            region: null
        },
        datepicker: {
            generic: null
        }
    };

    function init() {
        setSelectors();
        bindDatepickers();
        bindTypeaheads();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    function setSelectors() {
        selectors.typeahead.region = $('.js-typeahead-region');
        selectors.datepicker.generic = $('.js-datepicker');
    }

    function bindDatepickers() {
        selectors.datepicker.generic.datepicker({
            todayHighlight: true,
            autoclose: true
        });
    }

    function bindTypeaheads() {
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

        selectors.typeahead.region.typeahead({
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
            var $this = $(this);

            if ($this.data('bind-field-region-id')) {
                $($this.data('bind-field-region-id')).val(datum.id);
            }

            if ($this.data('bind-field-region-airport-code')) {
                $($this.data('bind-field-region-airport-code')).val(datum.a);
            }
        });
    }

    return {
        init: init
    };
}($));

app.init();
