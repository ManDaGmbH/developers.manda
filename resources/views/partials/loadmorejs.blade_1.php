<div class="container">
    <div class="row">
        <div class="col text-center">
            <a href="javascript:" class="btn btn-warning d-md-none m-t-10" onClick="loadMoreMobile()">Load More</a>
        </div>
    </div>
</div>
<script>
    function loadMoreData(page, freshData) {

        if (typeof freshData == 'undefined') {
            freshData = 0;
        }

        var method = "get";
        if ($('#searchform').length > 0) {
            var data = $('#searchform').serializeArray();
            data.push({name: '_token', value: '{{ csrf_token() }}'});
            data.push({name: 'page', value: page});
            data.push({name: 'is_fresh_data', value: freshData});
            method = "post";
        }
        $.ajax({
            url: '?page=' + page,
            type: method,
            data: data,
            beforeSend: function () {
                $(".ajax-loader").show();
            }
        }).done(function (data) {
            if (data.html == "") {
                $(".ajax-loader").html("<p class='text-center semi-bold' style='padding:10px;'>No More Record</p>");
                return;
            }
            $(".ajax-loader").hide();
            if (freshData == 1) {
                $("#appenddata").html(data.html);
            } else {
                $("#appenddata").append(data.html);
            }
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
    }
    var page = 1;
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            loadMoreData(page);
        }
    });
    function loadFreshData() {
        page = 1;
        loadMoreData(page, 1);
    }
    function loadMoreMobile() {
        page++;
        loadMoreData(page);
    }
</script>