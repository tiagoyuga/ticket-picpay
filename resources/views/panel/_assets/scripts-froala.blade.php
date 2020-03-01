<!-- Include CSS for icons. -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
      type="text/css"/>

<!-- Include Editor style. -->
<link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.0/css/froala_editor.pkgd.min.css" rel="stylesheet"
      type="text/css"/>
<link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.0/css/froala_style.min.css" rel="stylesheet"
      type="text/css"/>

<style>
    .fr-box.fr-basic .fr-insert-helper.fr-visible {
        display: none;
    }
</style>

<!-- Include Editor JS files. -->
<script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/froala-editor@2.9.0/js/froala_editor.pkgd.min.js"></script>

<!-- Initialize the editor. -->
<script>
    $(function () {
        $('.froalaEditor').froalaEditor({
            requestHeaders: {
                Authorization: '{{ csrf_token() }}'
            },
            linkAutoPrefix: 'http://',
            // pastePlain: true, // Removes text formatting when pasting content into the rich text editor.
            toolbarSticky: false,
            toolbarStickyOffset: 40,  // pixels
            toolbarButtons: ['undo', 'redo', '|', 'paragraphFormat', 'bold', 'italic', 'underline', 'strikeThrough', '|', 'formatUL', 'formatOL', 'align', 'outdent', 'indent', 'insertLink', 'insertHR', '|', 'clearFormatting', 'insertTable', 'specialCharacters', 'html'],
            quickInsertTags: [],
            height: 250


        })
    });
</script>
