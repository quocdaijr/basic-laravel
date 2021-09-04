window.uploadAndPreviewImage = function (idName, idErrName = '') {
    return {
        previewUrl: "",
        init(url) {
            this.previewUrl = url
        },
        uploadFile() {
            let file = document.getElementById(idName).files[0];
            ajaxUpload(file, 'image').then(res => {
                if (res.data) {
                    this.previewUrl = res.data.url
                    document.getElementsByName(idName)[0].value = res.data.id;
                    if (idErrName !== '') {
                        document.getElementById(idErrName).style.display = "none"
                    }
                }
            }).catch(err => {
                let errTxt = 'Undefined Err';
                if (err.response.data) {
                    if (err.response.data.errors.upload[0])
                        errTxt = err.response.data.errors.upload[0]
                    else
                        errTxt = err.response.data.message
                }
                if (idErrName !== '') {
                    let errElement = document.getElementById(idErrName)
                    errElement.innerText = errTxt
                    errElement.style.display = "block"
                } else {
                    alert(errTxt)
                }
            });
        },
        clearPreview() {
            document.getElementsByName(idName)[0].value = '';
            this.previewUrl = "";
        }
    };
}
