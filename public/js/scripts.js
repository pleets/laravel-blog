$(function(){

    hljs.initHighlightingOnLoad();

    if ($('#content').length)
    {
        CKEDITOR.replace('content');
    }
});