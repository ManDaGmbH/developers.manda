/*
 * sorttable.js
 *
 * Requires: jQuery (tested with v 1.11)
 *
 * jQuery plug-in that allows you to sort table by any column
 */
var baseurl = $('meta[name="base-url"]').attr('content');

jQuery.fn.addSortWidget = function (options) {
    var defaults = {
        img_asc: baseurl + "/img/asc_sort.gif",
        img_desc: baseurl + "img/desc_sort.gif",
        img_nosort: baseurl + "img/no_sort.gif",
    };

    var options = $.extend({}, defaults, options),
            $destElement = $(this),
            is_asc = true;

    $("th", $destElement).each(function (index) { // to each header cell (index is useful while sorting)
        $("<img>")                              // create image that allows you to sort by specific column 
                .attr('src', options.img_nosort)
                .addClass('sorttable_img')
                .css({
                    cursor: 'pointer',
                    'margin-left': '10px',
                })
                .on('click', function () {

                    $(".sorttable_img", $destElement).attr('src', options.img_nosort);
                    $(this).attr('src', (is_asc) ? options.img_desc : options.img_asc);
                    is_asc = !is_asc;

                    var $field = $(this).parent('th').attr('sort-by');
                    if ($field != '') {
                        $('.sort_field').val($field);
                        if (is_asc) {
                            $('.sort_order').val('asc');
                        } else {
                            $('.sort_order').val('desc');
                        }

                    }
                    var rows = $("tr", $destElement).not(":has(th)").get(); // save all rows (tr) into array (.get())
                    rows.sort(function (a, b) {
                        // sort array with table rows
                        var m = $("td:eq(" + index + ")", a).text(); // get column you needed by using index of th element (closure)
                        var n = $("td:eq(" + index + ")", b).text();

                        // if elements are numbers
                        if (!isNaN(m) && !isNaN(n))
                            return (is_asc) ? (m - n) : (n - m);

                        // if elements are strings
                        if (is_asc)
                            return m.localeCompare(n); // asc
                        else
                            return n.localeCompare(m); // desc
                    });

                    var tbody = ($destElement.has("tbody")) ? "tbody" : ""; // check if table has tbody
                    for (var i = 0; i < rows.length; i++) {
                        $(tbody, $destElement).append(rows[i]); // add each row to table (elements do not duplicate, just place to new position)
                    }
                })
                .appendTo(this); // add created sort image with click event handler to current th element
    });

    return $destElement;

}
