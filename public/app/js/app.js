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

            if (self.data('value-field')) {
                jquery(self.data('value-field')).val(datum.id);
            }

            if (self.data('label-field')) {
                jquery(self.data('label-field')).val(datum.d);
            }
        });
    }

    function setSelectors() {
        selectors.regionsTypeaheadInput = jquery('[data-typeahead-regions]');
        selectors.datePickerInput = jquery('[data-datepicker]');
    }

    init();
}($));
