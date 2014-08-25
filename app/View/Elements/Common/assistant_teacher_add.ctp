<script>
    $(function() {
        $('.assistant-teacher-add').on('click', function() {
            var i = $('.answer-holder').length;
            $('<div class="answer-holder form-group">' +
                    '<label for="AssistantTeacher' + i +
                    "class="col col - sm - 3 control - label required">' +
                    'Trợ giảng ' + i +
                    '</label>' +
                    '<div class="input-append  form-group col col-sm-7">' +
                    '<input class="form-control input-sm" name="data[AssistantTeacher][' + i + '][user_id]" id="answer_user_id' + i + '">' +
                    '<input class="form-control input-sm" name="data[AssistantTeacher][' + i + '][lecture_hours]" id="answer_lecture_hours' + i + '">' +
                    '</div>' +
                    '<button class="answer-delete btn btn-warning">Xóa</button>' +
                    '</div>').appendTo($('#answers'));
            i++;
            return false;
        });

        $(document).on('click', '.answer-delete', function() {
            $(this).parent('.answer-holder').remove();
            return false;
        });
    });

</script>
<div class="form-group">
    <label for="AssistantTeacher0" class="col col-sm-3 control-label required">Trợ giảng</label>

    <div class="col col-sm-7">
        <div class=" answer-holder input-append form-group">
            <input class="form-control" name="data[AssistantTeacher][0][user_id]" id="answer_user_id[]">
            <input class="form-control" name="data[AssistantTeacher][0][lecture_hours]" id="answer_lecture_hours[]">

        </div>

    </div>
    <button class="btn btn-success assistant-teacher-add"><i class="icon-plus"></i>Thêm trợ giảng</button>

</div>
<div id="answers">

</div>