$(document).ready(function(){
    let html = $('#post-content').html();
    $('#content').empty();
    $('#content').trumbowyg({
        //btns: ['strong', 'em', '|', 'link'],
        autogrow: true,
        svgPath: '/svg/trumbowyg-icons.svg'
    });
    $('#content').trumbowyg('toggle');
    $('#content').val(html);
});
