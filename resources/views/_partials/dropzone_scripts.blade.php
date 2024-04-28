<script src="{{ asset('assets/vendor/libs/dropzone/dropzone-min.js') }}"></script>

<script>
    var dz = $('#dz-preview-template').html();
    var currentFile = null;
    Dropzone.autoDiscover = false;
    $("div#myDropzone").dropzone({ 

        url:"{{ $ajaxUrl }}",
        
        method: "post",

        addRemoveLinks: true,

        /**
         * A string that contains the template used for each dropped
         * file. Change it to fulfill your needs but make sure to properly
         * provide all elements.
         */
        previewTemplate: dz,
        
        parallelUploads: 1,

        filesizeBase: 1024,

        maxFilesize: 2,

        paramName: "file",

        renameFile: "updd",
        
        maxFiles: 1,
        
        /**
         * The default implementation of `accept` checks the file's mime type or
         * extension against this list. This is a comma separated list of mime
         * types or file extensions.
         * Eg.: `image/*,application/pdf,.psd`
         */
        acceptedFiles: '.bin',

        /**
         * Sends the file as binary blob in body instead of form data.
         */
        binaryBody: false,

        /**
         * The text used before any files are dropped.
         */
        dictDefaultMessage: "Drop files here to upload",

        /**
         * The text that replaces the default message text it the browser is not supported.
         */
        dictFallbackMessage:
        "Your browser does not support drag'n'drop file uploads.",

        /**
         * The text that will be added before the fallback form.
         * If you provide a  fallback element yourself, or if this option is `null` this will
         * be ignored.
         */
        dictFallbackText:
        "Please use the fallback form below to upload your files like in the olden days.",

        /**
         * If the filesize is too big.
         * `filesize` and `maxFilesize` will be replaced with the respective configuration values.
         */
        dictFileTooBig:
        "File is too big (filesize MiB). Max filesize: maxFilesize}}MiB.",

        /**
         * If the file doesn't match the file type.
         */
        dictInvalidFileType: "You can't upload files of this type.",

        /**
         * If the server response was invalid.
         * `statusCode` will be replaced with the servers status code.
         */
        dictResponseError: "Server responded with statusCode}} code.",

        /**
         * If `addRemoveLinks` is true, the text to be used for the cancel upload link.
         */
        dictCancelUpload: "Cancel upload",

        /**
         * The text that is displayed if an upload was manually canceled
         */
        dictUploadCanceled: "Upload canceled.",

        /**
         * If `addRemoveLinks` is true, the text to be used for confirmation when cancelling upload.
         */
        dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",

        /**
         * If `addRemoveLinks` is true, the text to be used to remove a file.
         */
        dictRemoveFile: "Remove file",

        /**
         * If this is not null, then the user will be prompted before removing a file.
         */
        dictRemoveFileConfirmation: "Uploaded file will be removed, are you sure?",

        /**
         * Displayed if `maxFiles` is st and exceeded.
         * The string `maxFiles}}` will be replaced by the configuration value.
         */
        dictMaxFilesExceeded: "You can not upload any more files.",

        /**
         * Allows you to translate the different units. Starting with `tb` for terabytes and going down to
         * `b` for bytes.
         */
        dictFileSizeUnits: { tb: "TB", gb: "GB", mb: "MB", kb: "KB", b: "b" },

        /*
            * Add Listener here
            *
            */
        init: function() {
            this.on('addedfile', function(file){
                if (currentFile) {
                    this.removeFile(currentFile);
                }
                currentFile = file;
            });
            this.on('error', function(file, errorMessage) {
                var errorDisplay = $('[data-dz-errormessage]');
                console.log(errorMessage.message);
                errorDisplay.text(errorMessage.message);
            });
            this.on('sending', function(file, xhr, formData){
                formData.append("_token", "{{ csrf_token() }}");
            });
            this.on('complete', function(file){
            });
            this.on('success', function(file, response){
                $('#uploaded_file').val(response['fileName']);
                console.log($('#uploaded_file').val());
            });
            this.on('removedfile', function(file){
                $('#uploaded_file').val(null);
            });
        }
    });
</script>
