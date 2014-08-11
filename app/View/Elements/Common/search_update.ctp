<script>
    $(function() {
        $("<?php echo $search_form;?>").on("eldarion-ajax:success", function(e, $el, data) {

            $("<?php echo $update_div?>").html(data.responseText);
        }).
            on("eldarion-ajax:error", function(e) {
                toastr.error('Có lỗi xảy ra.', 'Thông báo!');
            });
    });
</script>