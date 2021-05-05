(function () {
    var client = algoliasearch(
        "HEX1MVKAVJ",
        "1434922ed0c5647c3be5e56cc21ce36f"
    );
    var index = client.initIndex("example_products");
    var enterPressed = false;
    //initialize autocomplete on search input (ID selector must match)
    autocomplete(
        "#aa-search-input-algolia",
        { hint: false },
        {
            source: autocomplete.sources.hits(index, { hitsPerPage: 10 }),
            //value to be displayed in input control after user's suggestion selection
            displayKey: "title",
            //hash of templates used when rendering dataset
            templates: {
                //'suggestion' templating function used to render a single suggestion
                suggestion: function (suggestion) {
                    const markup = `
                        <div class="algolia-result">
                            <span>
                                ${suggestion._highlightResult.title.value}
                            </span>

                        </div>
                    `;

                    return markup;
                },
                empty: function (result) {
                    return (
                        'Sorry, we did not find any results for "' +
                        result.query +
                        '"'
                    );
                },
            },
        }
    ).on("autocomplete:selected", function (event, suggestion, dataset) {
        window.location.href =
            window.location.origin + "/search/" + suggestion.slug;
        enterPressed = true;
    });
})();
