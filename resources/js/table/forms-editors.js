/**
 * Form Editors
 */

'use strict';

(function () {
    const content = document.querySelector('#editor-content');

    if (content) {
        const fullToolbar = [
            [
                {
                    font: []
                },
                {
                    size: []
                }
            ],
            ['bold', 'italic', 'underline', 'strike'],
            [
                {
                    color: []
                },
                {
                    background: []
                }
            ],
            [
                {
                    script: 'super'
                },
                {
                    script: 'sub'
                }
            ],
            [
                {
                    header: '1'
                },
                {
                    header: '2'
                },
                'blockquote',
                'code-block'
            ],
            [
                {
                    list: 'ordered'
                },
                {
                    list: 'bullet'
                },
                {
                    indent: '-1'
                },
                {
                    indent: '+1'
                }
            ],
            [{direction: 'rtl'}],
            ['link'],
            ['clean']
        ];
        const fullEditor = new Quill('#full-editor', {
            bounds: '#full-editor',
            placeholder: '...',
            modules: {
                formula: true,
                toolbar: fullToolbar
            },
            theme: 'snow'
        });
        fullEditor.on("text-change", function (delta, oldDelta, source) {
            content.value = fullEditor.container.firstElementChild.innerHTML ?? "";
        })
    }

})();
