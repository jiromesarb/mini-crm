

/*
* SELECT 2 Plugins
*/
$(document).ready(function() {

    $(".select2-tag").select2({
        width: '100%',
    });

    $(".select2-multiple-tags").select2({
        tags: true,
        tokenSeparators: [','],
        placeholder: "",
        width: '100%',
        closeOnSelect: false
    });

    $(".select2-multiple-tags-strict").select2({
        tags: true,
        tokenSeparators: [','],
        placeholder: "",
        width: '100%',
        closeOnSelect: false,
        createTag: function (params) {
            return null;
        },
    });
});
