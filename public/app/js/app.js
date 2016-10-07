var app = (function(jquery) {
    var selectors = {
        regionsTypeaheadInput: null,
        datePickerInput: null,
    };

    function init() {
        setSelectors();
        bindDatePickerInputs();
        bindTypeaheadInputs();
    }

    function bindDatePickerInputs() {
        selectors.datePickerInput.datepicker({
            todayHighlight: true,
            autoclose: true
        });
    }

    function bindTypeaheadInputs() {
        var regionsEngine = new Bloodhound({
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

        selectors.regionsTypeaheadInput.typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            }, {
                source: regionsEngine.ttAdapter(),
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
            var self = jquery(this);

            if (self.data('field-region-id')) {
                jquery(self.data('field-region-id')).val(datum.id);
            }

            if (self.data('field-region-name')) {
                jquery(self.data('field-region-name')).val(datum.d);
            }

            if (self.data('field-region-airport-code')) {
                jquery(self.data('field-region-airport-code')).val(datum.a);
            }
        });
    }

    function setSelectors() {
        selectors.regionsTypeaheadInput = jquery('[data-typeahead-regions]');
        selectors.datePickerInput = jquery('[data-datepicker]');
    }

    init();
}($));
