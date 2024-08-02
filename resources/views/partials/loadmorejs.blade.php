<div class="container">
    <div class="row">
        <div class="col text-center">
            <a href="javascript:" class="btn btn-warning d-md-none m-t-10" onClick="loadMoreMobile()">Load More</a>
        </div>
    </div>
</div>
<script>
    function loadMoreData(page) {
        var method = "get";
        if ($('#searchform').length > 0) {
            var data = $('#searchform').serializeArray();
            data.push({name: '_token', value: '{{ csrf_token() }}'});
            data.push({name: 'page', value: page});
            data.push({name: 'is_fresh_data'});
            method = "post";
        }
        $.ajax({
            url: '?page=' + page,
            type: method,
            data: data,
            beforeSend: function () {
//                $(".ajax-loader").show();
            }
        }).done(function (data) {
            if (data.html == "") {
                $(".ajax-loader").html("<p class='text-center semi-bold' style='padding:10px;'>No More Record</p>");
                return;
            }
//            $(".ajax-loader").hide();
            var sortingField = $('input[name="sort_field"]').val();
            var sortingOrder = $('input[name="sort_order"]').val();

            $("#no-more-tables").html(data.html);
            setIcons();
            $(".sortable").addSortWidget();
            // inline Edit
            $('.inline-edit').editable({
                combodate: {
                    minYear: 2015,
                    maxYear: 2045,
                    minuteStep: 1
                },
                params: function (params) {
                    params.model = $(this).editable().data('model');
                    params._token = "{{csrf_token()}}";
                    return params;
                },
                success: function (response, newValue) {
                    // notif({
                    // 	msg: "<i class='fas fa-check-circle'></i> Updated Successfully",
                    // 	type: "success"
                    // });
                    //if(response['success']) return response['msg'];
                },
                error: function (response, newValue) {
                    // notif({
                    // 	msg: "<b>Whoops! Something went Wrong</b> ",
                    // 	type: "error"
                    // });
                }
            });
        }).fail(function (jqXHR, ajaxOptions, throwError) {
            alert("Server Not Responding....");
        });
        return false;
    }
    /*    var page = 1;
     $(window).scroll(function () {
     if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
     page++;
     loadMoreData(page);
     }
     });*/
    function setFieldValues($this) {
        var sortField = $($this).attr('sort-by');
        $('input[name="sort_field"]').val(sortField);
        var sortOrder = $('input[name="sort_order"]');
        if (sortOrder.val() == '') {
            sortOrder.val('desc');
        } else {
            if (sortOrder.val() == 'desc') {
                sortOrder.val('asc');
            } else {
                sortOrder.val('desc');
            }
        }
    }
    function loadFreshData($this) {
        setFieldValues($this);
        var currentPage = $('ul.pagination li.page-item.active span').text();
        loadMoreData(currentPage);
    }
    function loadMoreMobile() {
        page++;
        loadMoreData(page);
    }
    function setIcons() {
        var sortFieldValue = $('.sort_field').val();
        var sortOrder = $('.sort_order').val();
        var addSpan = '';
        if (sortOrder == 'desc') {
            var addSpan = '<span class="fa fa-sort-amount-desc"></span>';
        }
        if (sortOrder == 'asc') {
            var addSpan = '<span class="fa fa-sort-amount-asc"></span>';
        }
        $('th[sort-by="' + sortFieldValue + '"]').append(addSpan);
//                alert();
    }
</script>