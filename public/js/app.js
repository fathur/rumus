function editAnswer(e){
    var $this = $(e)
        $body = $this.parent().parent().next();

    $body.find('.text').toggle();
    $body.find('.editor').toggle();

    $body.find(".answer-textarea").markdown({
        autofocus:false,
        savable:false,
        onShow: function (e) {
            $(".btn-toolbar").remove();
        }
    })
}

function generatePreviewOnTheFly(e) {
    var $this = $(e),
        id = $this.data('id'),
        $content = $this.parent().parent().next().find('.answer-textarea'),
        $parsedContent = $this.parent().parent().next().find('#parsed_content-'+id);

    $.post('/example/preview/ajax', {
        _token: config._token,
        answer: $content.val()
    }, function(resp) {
        console.log('parsed_content-'+id);

        $parsedContent.html(resp);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, document.getElementById('parsed_content-'+id)]);

    });
}

function saveAnswer(e) {
    var $this   = $(e),
        $form   = $this.parent(),
        id      = $form.data('id'),
        content = $form.find('#content').val(),
        url     = $form.attr('action');

    $.ajax({
        url: url,
        method: 'PUT',
        data: {
            id: id,
            content: content,
            redirect: false,
            _token: config._token
        },
        success: function(resp) {

            if (resp == 1) {
                $.post('/example/preview/ajax', {
                    _token: config._token,
                    answer: content
                }, function(resp) {

                    var $body = $form.parent().parent();

                    $('#text-'+id).html(resp);
                    MathJax.Hub.Queue(["Typeset", MathJax.Hub, document.getElementById('text-'+id)]);

                    $body.find('.text').toggle();
                    $body.find('.editor').toggle();
                });
            }
        }
    });

}