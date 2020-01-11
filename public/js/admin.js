
/**
 * Allows you to add data-method="METHOD to links to automatically inject a form
 * with the method on click
 *
 * Example: <a href="{{route('customers.destroy', $customer->id)}}"
 * data-method="delete" name="delete_item">Delete</a>
 *
 * Injects a form with that's fired on click of the link with a DELETE request.
 * Good because you don't have to dirty your HTML with delete forms everywhere.
 */

function addDeleteForms() {
    $('[data-method]').append(function () {
            if (! $(this).find('form').length > 0)
                return "\n" +
                    "<form action='" + $(this).attr('href') + "' method='POST' name='delete_item' style='display:none'>\n" +
                    "   <input type='hidden' name='_method' value='" + $(this).attr('data-method') + "'>\n" +
                    "   <input type='hidden' name='_token' value='" + $('meta[name="csrf-token"]').attr('content') + "'>\n" +
                    "</form>\n";
            else
                return "";
        })
        .removeAttr('href')
        .attr('style', 'cursor:pointer;')
        .attr('onclick', '$(this).find("form").submit();');
}

/**
 * Place any jQuery/helper plugins in here.
 */
$(function(){
    /**
     * Place the CSRF token as a header on all pages for access in AJAX requests
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /**
     * Add the data-method="delete" forms to all delete links
     */
    addDeleteForms();

    /**
     * This is for delete buttons that are loaded via AJAX in datatables, they will not work right
     * without this block of code
     */
    $(document).ajaxComplete(function(){
        addDeleteForms();
    });

    /**
     * Generic confirm form delete using Sweet Alert
     */
    $('body').on('submit', 'form[name=delete_item]', function(e) {
        e.preventDefault();
        var form = this;
        var link = $('a[data-method="delete"]');
        var cancel = (link.attr('data-trans-button-cancel')) ? link.attr('data-trans-button-cancel') : "Cancel";
        var confirm = (link.attr('data-trans-button-confirm')) ? link.attr('data-trans-button-confirm') : "Yes, delete";
        var title = (link.attr('data-trans-title')) ? link.attr('data-trans-title') : "Warning";
        var text = (link.attr('data-trans-text')) ? link.attr('data-trans-text') : "Are you sure you want to delete this item?";

        swal.fire({
            title: title,
            text: text,
            type: "warning",
            showCancelButton: true,
            cancelButtonText: '取消',
            confirmButtonColor: "#DD6B55",
            confirmButtonText: '删除',

            focusCancel: true, // 是否聚焦 取消按钮
            reverseButtons: true  // 是否 反转 两个按钮的位置 默认是  左边 确定  右边 取消
        }).then((isConfirm) => {
            // form.submit();
            try {
                //判断 是否 点击的 确定按钮
                if (isConfirm.value) {
                    // Swal.fire("成功", "点击了确定", "success");
                    form.submit();
                } else {
                    // Swal.fire("取消", "点击了取消", "error");
                }
            } catch (e) {
                alert(e);
            }
        });
    });

    /**
     * Generic 'are you sure' confirm box
     */
    $('body').on('click', 'a[name=confirm_item]', function(e){
        e.preventDefault();
        var link = $(this);
        var title = (link.attr('data-trans-title')) ? link.attr('data-trans-title') : "Are you sure you want to do this?";
        var text = (link.attr('data-trans-text')) ? link.attr('data-trans-text') : "";
        var type = (link.attr('data-trans-type')) ? (link.attr('data-trans-type')) : "info";
        var cancel = (link.attr('data-trans-button-cancel')) ? link.attr('data-trans-button-cancel') : "Cancel";
        var confirm = (link.attr('data-trans-button-confirm')) ? link.attr('data-trans-button-confirm') : "Continue";

        swal.fire({
            title: title,
            text: text,
            type: type,
            showCancelButton: true,
            cancelButtonText: cancel,
            confirmButtonColor: "#3C8DBC",
            confirmButtonText: confirm,
            // closeOnConfirm: true
        }).then((isConfirm) => {
            // window.location = link.attr('href');
            try {
                //判断 是否 点击的 确定按钮
                if (isConfirm.value) {
                    // Swal.fire("成功", "点击了确定", "success");
                    window.location = link.attr('href');
                } else {
                    // Swal.fire("取消", "点击了取消", "error");
                }
            } catch (e) {
                alert(e);
            }
        });
    });

    /**
     * Bind all bootstrap tooltips
     */
    $("[data-toggle=\"tooltip\"]").tooltip();

    /**
     * Bind all bootstrap popovers
     */
    $("[data-toggle=\"popover\"]").popover();

    /**
     * This closes the popover when its clicked away from
     */
    $('body').on('click', function (e) {
        $('[data-toggle="popover"]').each(function () {
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('hide');
            }
        });
    });

    $('table').on('draw.dt', function() {
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover();
    });

    // topLeftNav  导航选中时  active
    var url = window.location;
    // Will only work if string in href matches with location
    $('ul.navbar-nav a[href="'+ url +'"]').parent().addClass('active');

    // Will also work for relative and absolute hrefs
    $('ul.navbar-nav a').filter(function() {
        return this.href == url;
    }).parent().addClass('active');


});

