
{{--<script src="https://cdn.ckeditor.com/4.14.0/basic/ckeditor.js"></script>--}}
{{--<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>--}}
<script src="https://cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
{{--<script src="https://cdn.ckeditor.com/4.14.0/customize/ckeditor.js"></script>--}}

<script>

    function setCkeditor(element) {

        CKEDITOR.replace(element,
            toolbarGroups = [
                { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
                {name: 'clipboard', groups: ['clipboard', 'undo']},
                {name: 'editing', groups: ['find', 'selection', 'spellchecker', 'editing']},
                {name: 'forms', groups: ['forms']},
                '/',
                {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
                {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']},
                {name: 'links', groups: ['links']},
                {name: 'insert', groups: ['insert']},
                '/',
                {name: 'styles', groups: ['styles']},
                {name: 'colors', groups: ['colors']},
                {name: 'tools', groups: ['tools']},
                {name: 'others', groups: ['others']},
            ]
        );

        config['placeholder'] = 'Write your message here';
        CKEDITOR.replace(element, config );
    }

    {{--<script src="https://cdn.ckeditor.com/ckeditor5/17.0.0/classic/ckeditor.js"></script>--}}
    /*ClassicEditor
        .create(document.querySelector('#content'), {

            toolbar: {
                items: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'indent',
                    'outdent',
                    '|',
                    'blockQuote',
                    'insertTable',
                    'undo',
                    'redo'
                ],

            },

            language: 'en',
            height: 300,
            table: {
                contentToolbar: [
                    'tableColumn',
                    'tableRow',
                    'mergeTableCells'
                ]
            },
            licenseKey: '',

        })
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });*/
</script>
