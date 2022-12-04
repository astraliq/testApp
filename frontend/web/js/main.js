'use strict';

class JsonForm {
    constructor() {
        this.form = $('#json-form');
        this.authTokenInput = $('#jsonform-authtoken');
        this.requestTypeInput = $('#jsonform-requesttype');
        this.jsonFileInput = $('#jsonform-jsondata');
        this.submitBtn = $('#send-json-data');
    }

    _ajax(url, type, data, authToken) {
        return $.ajax({
            url: url,
            type: type,
            beforeSend: (request) => {
                request.setRequestHeader("authorizationToken", authToken);
            },
            data: data,
            success: (data) => {
                if (data.result !== true) {
                    console.log('ERROR_POST_DATA');
                }
            },
            error: (jqXHR, errMsg) => {
                console.log(errMsg);
            },
        })
    }

    init() {
        this.form.on('beforeSubmit', (e) => {
            const formData = this.form.serializeArray();
            const authToken = this.authTokenInput.val();
            const requestType = this.requestTypeInput.val() == 1 ? 'GET' : 'POST';
            let jsonData = this.jsonFileInput[0].files[0];
            const reader = new FileReader();
            reader.readAsText(jsonData, "UTF-8");
            reader.onload = (e) => {
                jsonData = JSON.parse(e.target.result);
                this._ajax('/index.php?r=site/add-json', requestType, {'json': jsonData}, authToken);
            };
            reader.onerror = () => {
                console.log(reader.error);
            };
            return false;
        });
    }
}
const jsonForm = new JsonForm();
jsonForm.init();