<?= $this->extend('templates/head'); ?>
<?= $this->section('content'); ?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Form Editors</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">Editors</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">

            <div class="col-lg-12">

                <meta charset="UTF-8">
                <title>Demo TinyMCE</title>
                <script src="/public/tinymce/js/tinymce/tinymce.min.js"></script>
                <script>
                    tinymce.init({
                        selector: "textarea",
                        plugins: [
                            "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                            "table contextmenu directionality emoticons template textcolor paste fullpage textcolor codesample"
                        ],

                        toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
                        toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | inserttime preview | forecolor backcolor",
                        toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft codesample",

                        menubar: false,
                        toolbar_items_size: 'small',

                        style_formats: [
                            { title: 'Bold text', inline: 'b' },
                            { title: 'Red text', inline: 'span', styles: { color: '#ff0000' } },
                            { title: 'Red header', block: 'h1', styles: { color: '#ff0000' } },
                            { title: 'Example 1', inline: 'span', classes: 'example1' },
                            { title: 'Example 2', inline: 'span', classes: 'example2' },
                            { title: 'Table styles' },
                            { title: 'Table row 1', selector: 'tr', classes: 'tablerow1' }
                        ],

                        templates: [
                            { title: 'Test template 1', content: 'Test 1' },
                            { title: 'Test template 2', content: 'Test 2' }
                        ]
                    });
                </script>

                <style>
                    .wrapper {
                        width: 840px;
                    }
                </style>
                </head>

                <body>
                    <h1>Ini Halaman Contoh Menggunakan editor tinymce</h1>
                    <div class="wrapper">
                        <form action="">
                            <textarea name="" id="" cols="30" rows="10"></textarea>
                        </form>
                    </div>
                </body><!-- End TinyMCE Editor -->

            </div>
        </div>

        </div>
        </div>
    </section>

</main><!-- End #main -->
<?= $this->endSection(); ?>