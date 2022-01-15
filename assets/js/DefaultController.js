class DefaultController {
    fileInput = $('#file-input');
    dataTable = $('#data-table');
    confirmButton = $('input.button');
    loader = $('.loader');
    apiUrl;

    constructor(apiUrl) {
        this.apiUrl = apiUrl;
        this.registerEvents();
    }

    registerEvents() {
        $('.js-select-file').on('click', () => this.fileInput.click());
        this.fileInput.on('change', () => {
            let files = this.fileInput.prop('files'), message;
            if (!files || !files.length) {
                message = 'Select some csv file';
            } else {
                message = "Selected file: " + files[0].name;
            }
            $('.js-selected-file').text(message);
        });
        $('#file-form').on('submit', e => {
            e.preventDefault();
            let files = this.fileInput.prop('files');
            if (!files || !files.length) {
                alert('Please, select some csv file');
                return;
            }
            let data = new FormData();
            data.append('file', files[0]);
            this.loading(true);

            $.ajax({
                url: this.apiUrl,
                type: 'POST',
                data: data,
                contentType: false,
                processData: false,
                success: response => this.dataTable.html(typeof response === 'object' ? response.html : response),
                error: () => alert('Something went wrong while processing request'),
                complete: () => this.loading(false)
            });
        })
    }

    loading(state) {
        if (state) {
            this.confirmButton.attr('disabled', true);
            this.dataTable.html('');
            this.loader.show();
        } else {
            this.loader.hide();
            this.confirmButton.attr('disabled', false);
        }
    }
}