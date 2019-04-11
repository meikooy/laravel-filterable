
window.projectVersion = 'master';

(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '        <ul>                <li data-name="namespace:Meiko" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Meiko.html">Meiko</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:Meiko_Filterable" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Meiko/Filterable.html">Filterable</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:Meiko_Filterable_Groups" >                    <div style="padding-left:36px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Meiko/Filterable/Groups.html">Groups</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Meiko_Filterable_Groups_AndGroup" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Meiko/Filterable/Groups/AndGroup.html">AndGroup</a>                    </div>                </li>                            <li data-name="class:Meiko_Filterable_Groups_Group" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Meiko/Filterable/Groups/Group.html">Group</a>                    </div>                </li>                            <li data-name="class:Meiko_Filterable_Groups_OrGroup" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Meiko/Filterable/Groups/OrGroup.html">OrGroup</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:Meiko_Filterable_Field" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Meiko/Filterable/Field.html">Field</a>                    </div>                </li>                            <li data-name="class:Meiko_Filterable_Filterable" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Meiko/Filterable/Filterable.html">Filterable</a>                    </div>                </li>                            <li data-name="class:Meiko_Filterable_Filterer" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Meiko/Filterable/Filterer.html">Filterer</a>                    </div>                </li>                            <li data-name="class:Meiko_Filterable_Sort" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Meiko/Filterable/Sort.html">Sort</a>                    </div>                </li>                </ul></div>                </li>                </ul></div>                </li>                </ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                    
            {"type": "Namespace", "link": "Meiko.html", "name": "Meiko", "doc": "Namespace Meiko"},{"type": "Namespace", "link": "Meiko/Filterable.html", "name": "Meiko\\Filterable", "doc": "Namespace Meiko\\Filterable"},{"type": "Namespace", "link": "Meiko/Filterable/Groups.html", "name": "Meiko\\Filterable\\Groups", "doc": "Namespace Meiko\\Filterable\\Groups"},
            
            {"type": "Class", "fromName": "Meiko\\Filterable", "fromLink": "Meiko/Filterable.html", "link": "Meiko/Filterable/Field.html", "name": "Meiko\\Filterable\\Field", "doc": "&quot;Filter field&quot;"},
                                                        {"type": "Method", "fromName": "Meiko\\Filterable\\Field", "fromLink": "Meiko/Filterable/Field.html", "link": "Meiko/Filterable/Field.html#method___construct", "name": "Meiko\\Filterable\\Field::__construct", "doc": "&quot;Create a new field instance&quot;"},
                    {"type": "Method", "fromName": "Meiko\\Filterable\\Field", "fromLink": "Meiko/Filterable/Field.html", "link": "Meiko/Filterable/Field.html#method_getKey", "name": "Meiko\\Filterable\\Field::getKey", "doc": "&quot;Get field key&quot;"},
                    {"type": "Method", "fromName": "Meiko\\Filterable\\Field", "fromLink": "Meiko/Filterable/Field.html", "link": "Meiko/Filterable/Field.html#method_getType", "name": "Meiko\\Filterable\\Field::getType", "doc": "&quot;Get field comparison type based on field value&quot;"},
                    {"type": "Method", "fromName": "Meiko\\Filterable\\Field", "fromLink": "Meiko/Filterable/Field.html", "link": "Meiko/Filterable/Field.html#method_isIdKey", "name": "Meiko\\Filterable\\Field::isIdKey", "doc": "&quot;Is filter key an id key&quot;"},
                    {"type": "Method", "fromName": "Meiko\\Filterable\\Field", "fromLink": "Meiko/Filterable/Field.html", "link": "Meiko/Filterable/Field.html#method_getModelId", "name": "Meiko\\Filterable\\Field::getModelId", "doc": "&quot;Resolve model id from key&quot;"},
                    {"type": "Method", "fromName": "Meiko\\Filterable\\Field", "fromLink": "Meiko/Filterable/Field.html", "link": "Meiko/Filterable/Field.html#method_getValue", "name": "Meiko\\Filterable\\Field::getValue", "doc": "&quot;Get field value&quot;"},
                    {"type": "Method", "fromName": "Meiko\\Filterable\\Field", "fromLink": "Meiko/Filterable/Field.html", "link": "Meiko/Filterable/Field.html#method_apply", "name": "Meiko\\Filterable\\Field::apply", "doc": "&quot;Apply filter to query&quot;"},
                    {"type": "Method", "fromName": "Meiko\\Filterable\\Field", "fromLink": "Meiko/Filterable/Field.html", "link": "Meiko/Filterable/Field.html#method_setBaseClassname", "name": "Meiko\\Filterable\\Field::setBaseClassname", "doc": "&quot;Set base classname to use against id-filters&quot;"},
            
            {"type": "Trait", "fromName": "Meiko\\Filterable", "fromLink": "Meiko/Filterable.html", "link": "Meiko/Filterable/Filterable.html", "name": "Meiko\\Filterable\\Filterable", "doc": "&quot;Filterable trait class&quot;"},
                                                        {"type": "Method", "fromName": "Meiko\\Filterable\\Filterable", "fromLink": "Meiko/Filterable/Filterable.html", "link": "Meiko/Filterable/Filterable.html#method_scopeFilters", "name": "Meiko\\Filterable\\Filterable::scopeFilters", "doc": "&quot;Apply filterer to query&quot;"},
            
            {"type": "Class", "fromName": "Meiko\\Filterable", "fromLink": "Meiko/Filterable.html", "link": "Meiko/Filterable/Filterer.html", "name": "Meiko\\Filterable\\Filterer", "doc": "&quot;Main filterer class&quot;"},
                                                        {"type": "Method", "fromName": "Meiko\\Filterable\\Filterer", "fromLink": "Meiko/Filterable/Filterer.html", "link": "Meiko/Filterable/Filterer.html#method_parseSortable", "name": "Meiko\\Filterable\\Filterer::parseSortable", "doc": "&quot;Parse sortable strings&quot;"},
                    {"type": "Method", "fromName": "Meiko\\Filterable\\Filterer", "fromLink": "Meiko/Filterable/Filterer.html", "link": "Meiko/Filterable/Filterer.html#method_getSearchQuery", "name": "Meiko\\Filterable\\Filterer::getSearchQuery", "doc": "&quot;Get search query&quot;"},
                    {"type": "Method", "fromName": "Meiko\\Filterable\\Filterer", "fromLink": "Meiko/Filterable/Filterer.html", "link": "Meiko/Filterable/Filterer.html#method_getSortables", "name": "Meiko\\Filterable\\Filterer::getSortables", "doc": "&quot;Get sortables&quot;"},
                    {"type": "Method", "fromName": "Meiko\\Filterable\\Filterer", "fromLink": "Meiko/Filterable/Filterer.html", "link": "Meiko/Filterable/Filterer.html#method_getGroups", "name": "Meiko\\Filterable\\Filterer::getGroups", "doc": "&quot;Get filter groups&quot;"},
                    {"type": "Method", "fromName": "Meiko\\Filterable\\Filterer", "fromLink": "Meiko/Filterable/Filterer.html", "link": "Meiko/Filterable/Filterer.html#method_setSearchableColumns", "name": "Meiko\\Filterable\\Filterer::setSearchableColumns", "doc": "&quot;Set searchable columns&quot;"},
                    {"type": "Method", "fromName": "Meiko\\Filterable\\Filterer", "fromLink": "Meiko/Filterable/Filterer.html", "link": "Meiko/Filterable/Filterer.html#method_setSortableColumns", "name": "Meiko\\Filterable\\Filterer::setSortableColumns", "doc": "&quot;Set sortable columns&quot;"},
                    {"type": "Method", "fromName": "Meiko\\Filterable\\Filterer", "fromLink": "Meiko/Filterable/Filterer.html", "link": "Meiko/Filterable/Filterer.html#method_addSortable", "name": "Meiko\\Filterable\\Filterer::addSortable", "doc": "&quot;Add sortable column&quot;"},
                    {"type": "Method", "fromName": "Meiko\\Filterable\\Filterer", "fromLink": "Meiko/Filterable/Filterer.html", "link": "Meiko/Filterable/Filterer.html#method_addFilterColumn", "name": "Meiko\\Filterable\\Filterer::addFilterColumn", "doc": "&quot;Add filter column with a callback&quot;"},
                    {"type": "Method", "fromName": "Meiko\\Filterable\\Filterer", "fromLink": "Meiko/Filterable/Filterer.html", "link": "Meiko/Filterable/Filterer.html#method_addIdColumn", "name": "Meiko\\Filterable\\Filterer::addIdColumn", "doc": "&quot;Add ID column&quot;"},
                    {"type": "Method", "fromName": "Meiko\\Filterable\\Filterer", "fromLink": "Meiko/Filterable/Filterer.html", "link": "Meiko/Filterable/Filterer.html#method_parseRequest", "name": "Meiko\\Filterable\\Filterer::parseRequest", "doc": "&quot;Parse HTTP request&quot;"},
                    {"type": "Method", "fromName": "Meiko\\Filterable\\Filterer", "fromLink": "Meiko/Filterable/Filterer.html", "link": "Meiko/Filterable/Filterer.html#method_getSearchGroup", "name": "Meiko\\Filterable\\Filterer::getSearchGroup", "doc": "&quot;Get search filter group&quot;"},
                    {"type": "Method", "fromName": "Meiko\\Filterable\\Filterer", "fromLink": "Meiko/Filterable/Filterer.html", "link": "Meiko/Filterable/Filterer.html#method_checkForRequiredColumns", "name": "Meiko\\Filterable\\Filterer::checkForRequiredColumns", "doc": "&quot;Check for required columns in filter&quot;"},
                    {"type": "Method", "fromName": "Meiko\\Filterable\\Filterer", "fromLink": "Meiko/Filterable/Filterer.html", "link": "Meiko/Filterable/Filterer.html#method_requireColumn", "name": "Meiko\\Filterable\\Filterer::requireColumn", "doc": "&quot;Require specific column in filter&quot;"},
                    {"type": "Method", "fromName": "Meiko\\Filterable\\Filterer", "fromLink": "Meiko/Filterable/Filterer.html", "link": "Meiko/Filterable/Filterer.html#method_setBaseClassname", "name": "Meiko\\Filterable\\Filterer::setBaseClassname", "doc": "&quot;Set base classname to use against id-filters&quot;"},
            
            {"type": "Class", "fromName": "Meiko\\Filterable\\Groups", "fromLink": "Meiko/Filterable/Groups.html", "link": "Meiko/Filterable/Groups/AndGroup.html", "name": "Meiko\\Filterable\\Groups\\AndGroup", "doc": "&quot;AND Group&quot;"},
                                                        {"type": "Method", "fromName": "Meiko\\Filterable\\Groups\\AndGroup", "fromLink": "Meiko/Filterable/Groups/AndGroup.html", "link": "Meiko/Filterable/Groups/AndGroup.html#method_apply", "name": "Meiko\\Filterable\\Groups\\AndGroup::apply", "doc": "&quot;Apply fields to query&quot;"},
            
            {"type": "Class", "fromName": "Meiko\\Filterable\\Groups", "fromLink": "Meiko/Filterable/Groups.html", "link": "Meiko/Filterable/Groups/Group.html", "name": "Meiko\\Filterable\\Groups\\Group", "doc": "&quot;Abstract base group&quot;"},
                                                        {"type": "Method", "fromName": "Meiko\\Filterable\\Groups\\Group", "fromLink": "Meiko/Filterable/Groups/Group.html", "link": "Meiko/Filterable/Groups/Group.html#method_addField", "name": "Meiko\\Filterable\\Groups\\Group::addField", "doc": "&quot;Add new field to group&quot;"},
            
            {"type": "Class", "fromName": "Meiko\\Filterable\\Groups", "fromLink": "Meiko/Filterable/Groups.html", "link": "Meiko/Filterable/Groups/OrGroup.html", "name": "Meiko\\Filterable\\Groups\\OrGroup", "doc": "&quot;OR group&quot;"},
                                                        {"type": "Method", "fromName": "Meiko\\Filterable\\Groups\\OrGroup", "fromLink": "Meiko/Filterable/Groups/OrGroup.html", "link": "Meiko/Filterable/Groups/OrGroup.html#method_apply", "name": "Meiko\\Filterable\\Groups\\OrGroup::apply", "doc": "&quot;Apply fields to query&quot;"},
            
            {"type": "Class", "fromName": "Meiko\\Filterable", "fromLink": "Meiko/Filterable.html", "link": "Meiko/Filterable/Sort.html", "name": "Meiko\\Filterable\\Sort", "doc": "&quot;Sortable column&quot;"},
                                                        {"type": "Method", "fromName": "Meiko\\Filterable\\Sort", "fromLink": "Meiko/Filterable/Sort.html", "link": "Meiko/Filterable/Sort.html#method___construct", "name": "Meiko\\Filterable\\Sort::__construct", "doc": "&quot;Create new sortable column instance&quot;"},
                    {"type": "Method", "fromName": "Meiko\\Filterable\\Sort", "fromLink": "Meiko/Filterable/Sort.html", "link": "Meiko/Filterable/Sort.html#method_apply", "name": "Meiko\\Filterable\\Sort::apply", "doc": "&quot;Apply sort to query&quot;"},
            
            
                                        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Sami = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Sami.injectApiTree($('#api-tree'));
    });

    return root.Sami;
})(window);

$(function() {

    // Enable the version switcher
    $('#version-switcher').change(function() {
        window.location = $(this).val()
    });

    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').click(function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Sami.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


